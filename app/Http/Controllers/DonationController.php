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
        Donation::where('status', 'pending')
            ->where('payment_expiry', '<=', Carbon::now())
            ->update(['status' => 'expired']);

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
                'bank_type' => 'required_if:payment_method,bank_transfer|nullable|in:bca,bni,bri',
                'ewallet_type' => 'required_if:payment_method,ewallet|nullable|in:gopay,ovo,dana',
            ], [
                'bank_type.required_if' => 'Silakan pilih bank untuk pembayaran',
                'bank_type.in' => 'Bank yang dipilih tidak valid',
                'ewallet_type.required_if' => 'Silakan pilih e-wallet untuk pembayaran',
                'ewallet_type.in' => 'E-wallet yang dipilih tidak valid',
                'amount.min' => 'Jumlah donasi minimal Rp 1.000',
            ]);

            $paymentExpiry = Carbon::now()->addMinute();

            $qrCode = null;
            $virtualAccount = null;

            if ($request->payment_method === 'bank_transfer') {
                $virtualAccount = $this->generateDummyVA($request->bank_type);
                $qrCode = $this->generateDummyQR("bank-" . $request->bank_type . "-" . $virtualAccount);
            } else {
                $qrCode = $this->generateDummyQR("ewallet-" . $request->ewallet_type . "-" . Str::random(10));
            }

            $donation = Donation::create([
                'user_id' => auth()->id(),
                'amount' => $request->amount,
                'payment_method' => $request->payment_method,
                'payment_type' => $request->payment_method === 'bank_transfer' ? 'bank' : 'ewallet',
                'payment_provider' => $request->payment_method === 'bank_transfer' ? $request->bank_type : $request->ewallet_type,
                'virtual_account' => $virtualAccount,
                'qr_code' => $qrCode,
                'payment_expiry' => $paymentExpiry,
                'status' => 'pending',
                'transaction_id' => 'TRX-' . Str::random(10),
            ]);

            $paymentDetails = [
                'payment_type' => $donation->payment_type,
                'provider' => $donation->payment_provider,
                'virtual_account' => $donation->virtual_account,
                'qr_code' => $donation->qr_code,
                'amount' => $donation->amount,
                'transaction_id' => $donation->transaction_id,
                'confirmation_time' => $donation->payment_expiry->format('Y-m-d H:i:s'),
                'donation_id' => $donation->id,
                'bank' => $request->payment_method === 'bank_transfer' ? $request->bank_type : null
            ];

            session(['payment_details' => $paymentDetails]);
            return redirect()->route('donations.payment', $donation);

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memproses pembayaran: ' . $e->getMessage())->withInput();
        }
    }

    public function payment(Donation $donation)
    {
        if (!session()->has('payment_details')) {
            $paymentDetails = [
                'payment_type' => $donation->payment_type,
                'provider' => $donation->payment_provider,
                'virtual_account' => $donation->virtual_account,
                'qr_code' => $donation->qr_code,
                'amount' => $donation->amount,
                'transaction_id' => $donation->transaction_id,
                'confirmation_time' => $donation->payment_expiry->format('Y-m-d H:i:s'),
                'donation_id' => $donation->id
            ];
        } else {
            $paymentDetails = session('payment_details');
        }

        if ($donation->user_id !== auth()->id()) {
            abort(403);
        }

        if ($donation->payment_expiry <= Carbon::now()) {
            $donation->update(['status' => 'expired']);
            return redirect()->route('donations.index')->with('error', 'Waktu pembayaran telah berakhir');
        }

        return view('donations.payment', compact('donation', 'paymentDetails'));
    }

    public function success(Donation $donation)
    {
        if ($donation->user_id !== auth()->id()) {
            abort(403);
        }

        return view('donations.success', [
            'donation' => $donation,
            'totalDonations' => Donation::where('status', 'success')->sum('amount')
        ]);
    }

    public function checkStatus(Donation $donation)
    {
        if ($donation->user_id !== auth()->id()) {
            abort(403);
        }

        if ($donation->created_at->addMinute() <= now() && $donation->status === 'pending') {
            $donation->update(['status' => 'success']);
        }

        else if ($donation->payment_expiry <= now() && $donation->status === 'pending') {
            $donation->update(['status' => 'expired']);
        }

        return response()->json(['status' => $donation->status]);
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

    private function generateDummyQR($data)
    {
        return "https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=" . urlencode($data);
    }
} 