<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;

class DonationController extends Controller
{
    public function index()
    {
        // Auto update status for donations that are 1 minute old
        Donation::where('status', 'pending')
            ->where('created_at', '<=', Carbon::now()->subMinute())
            ->update(['status' => 'success']);

        $totalDonations = Donation::where('status', 'success')->sum('amount');
        $userDonations = auth()->user()->donations()->latest()->get();
        return view('donations.index', compact('totalDonations', 'userDonations'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'first_name' => 'required|string',
                'last_name' => 'nullable|string',
                'email' => 'required|email',
                'phone' => 'required|string',
                'amount' => 'required|numeric|min:1000',
                'payment_method' => 'required|in:bank_transfer,ewallet',
                'bank_type' => 'required_if:payment_method,bank_transfer|in:bca,bni,bri',
                'ewallet_type' => 'required_if:payment_method,ewallet|in:gopay,ovo,dana',
            ], [
                'bank_type.required_if' => 'Silakan pilih bank untuk pembayaran',
                'bank_type.in' => 'Bank yang dipilih tidak valid',
                'ewallet_type.required_if' => 'Silakan pilih e-wallet untuk pembayaran',
                'ewallet_type.in' => 'E-wallet yang dipilih tidak valid',
                'amount.min' => 'Jumlah donasi minimal Rp 1.000',
            ]);

            // Create donation record
            $donation = Donation::create([
                'user_id' => auth()->id(),
                'amount' => $request->amount,
                'payment_method' => $request->payment_method,
                'status' => 'pending',
                'transaction_id' => 'TRX-' . Str::random(10),
            ]);

            // Calculate when the payment will be confirmed (1 minute from now)
            $confirmationTime = Carbon::now()->addMinute()->format('Y-m-d H:i:s');

            // Store payment details in session
            if ($request->payment_method === 'bank_transfer') {
                $paymentDetails = [
                    'payment_type' => 'bank_transfer',
                    'bank' => $request->bank_type,
                    'virtual_account' => $this->generateDummyVA($request->bank_type),
                    'amount' => $request->amount,
                    'transaction_id' => $donation->transaction_id,
                    'confirmation_time' => $confirmationTime,
                    'donation_id' => $donation->id
                ];
            } else {
                $paymentDetails = [
                    'payment_type' => 'ewallet',
                    'provider' => $request->ewallet_type,
                    'qr_code' => $this->generateDummyQR($request->ewallet_type),
                    'amount' => $request->amount,
                    'transaction_id' => $donation->transaction_id,
                    'confirmation_time' => $confirmationTime,
                    'donation_id' => $donation->id
                ];
            }

            // Store payment details in session and redirect to payment page
            session(['payment_details' => $paymentDetails]);
            return redirect()->route('donations.payment', $donation);

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memproses pembayaran: ' . $e->getMessage())->withInput();
        }
    }

    public function payment(Donation $donation)
    {
        // Check if payment details exist in session
        if (!session()->has('payment_details')) {
            return redirect()->route('donations.index')->with('error', 'Detail pembayaran tidak ditemukan');
        }

        // Only allow viewing payment page for the donation owner
        if ($donation->user_id !== auth()->id()) {
            abort(403);
        }

        $paymentDetails = session('payment_details');
        return view('donations.payment', compact('donation', 'paymentDetails'));
    }

    public function success(Donation $donation)
    {
        // Only allow viewing success page for the donation owner
        if ($donation->user_id !== auth()->id()) {
            abort(403);
        }

        return view('donations.success', [
            'donation' => $donation,
            'totalDonations' => Donation::where('status', 'success')->sum('amount')
        ]);
    }

    private function generateDummyVA($bank)
    {
        $prefix = [
            'bca' => '8888',
            'bni' => '8877',
            'bri' => '8866'
        ];

        return $prefix[$bank] . rand(100000000, 999999999);
    }

    private function generateDummyQR($provider)
    {
        return "https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=DUMMY-" . Str::random(20);
    }
} 