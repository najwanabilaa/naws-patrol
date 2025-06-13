<?php

namespace App\Http\Controllers;

use App\Models\FosterHome;
use App\Models\FosterRequest;
use App\Models\Animal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class FosterHomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showForm()
    {
        return view('fosterHome.fosterHome');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:foster_homes,email', 
            'password' => 'required|string|min:6',
            'phone' => 'required|string|max:20'
        ]);

        try {
            $fosterHome = FosterHome::create([
                'user_id' => Auth::id(),
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'status' => 'approved'
            ]);

            return redirect()->route('foster.landing')->with('success', 'Registration successful!');
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Registration failed: ' . $e->getMessage());
        }
    }


    public function landing()
    {
            $user = Auth::user();
        $fosterHome = FosterHome::firstOrCreate(
            ['user_id' => $user->id],
            [
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone ?? '', 
                'status' => 'approved'
            ]
        );
        $fosterAnimals = Animal::where('status', 'available')->take(6)->get()->map(function($animal) {
            return [
                'id' => $animal->id,
                'name' => $animal->name,
                'breed' => $animal->breed,
                'location' => $animal->location ?? '-',
                'age' => $animal->age,
                'color' => $animal->color ?? '-',
                'gender' => $animal->gender,
                'description' => $animal->description,
                'image' => $animal->image_path,
                'category' => $animal->type
            ];
        });

        return view('fosterHome.fosterLanding', compact('fosterAnimals'));
    }

    public function info()
    {
        $user = Auth::user();

        $fosterHome = FosterHome::firstOrCreate(
            ['user_id' => $user->id],
            [
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone ?? '',
                'status' => 'approved'
            ]
        );

        $totalFosterRequests = FosterRequest::where('user_id', $user->id)->count();
        $approvedRequests = FosterRequest::where('user_id', $user->id)->where('status', 'approved')->count();
        $pendingRequests = FosterRequest::where('user_id', $user->id)->where('status', 'pending')->count();

        $joinedDate = $fosterHome->created_at;
        $now = now();
        $diffInMonths = $joinedDate->diffInMonths($now);
        $years = intval($diffInMonths / 12);
        $months = $diffInMonths % 12;
        
        $durationText = '';
        if ($years > 0) {
            $durationText .= $years . ' Year ';
        }
        if ($months > 0) {
            $durationText .= $months . ' Month';
        }
        if ($durationText === '') {
            $durationText = 'Just joined';
        }
        $fosterData = [
            'name' => $fosterHome->name,
            'email' => $fosterHome->email,
            'phone' => $fosterHome->phone,
            'joined_date' => $fosterHome->created_at->format('d M Y'),
            'duration_active' => trim($durationText),
            'animal_types' => $fosterHome->animal_types ? implode(', ', $fosterHome->animal_types) : 'Cats, Dogs',
            'total_requests' => $totalFosterRequests,
            'approved_requests' => $approvedRequests,
            'pending_requests' => $pendingRequests
        ];

        return view('fosterHome.fosterInfo', compact('fosterData'));
    }

    public function needs()
    {
        $fosterAnimals = Animal::where('status', 'available')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function($animal) {
                return [
                    'id' => $animal->id,
                    'name' => $animal->name,
                    'breed' => $animal->breed,
                    'location' => $animal->location ?? '-',
                    'age' => $animal->age,
                    'color' => $animal->color ?? '-',
                    'gender' => $animal->gender,
                    'description' => $animal->description,
                    'image' => $animal->image_path,
                    'category' => $animal->type
                ];
            });

        return view('fosterHome.fosterNeeds', compact('fosterAnimals'));
    }

    public function fosterForm($id)
    {
        try {
            $animal = Animal::findOrFail($id);
            $animalData = [
                'id' => $animal->id,
                'name' => $animal->name,
                'breed' => $animal->breed,
                'age' => $animal->age,
                'gender' => $animal->gender,
                'description' => $animal->description,
                'image_url' => $animal->image_path,
                'health_status' => '95'
            ];
            return view('fosterHome.fosterForm', ['animal' => (object)$animalData]);
            
        } catch (\Exception $e) {
            return redirect()->route('foster.needs')
                ->with('error', 'Tidak dapat memuat form foster. Silakan coba lagi.');
        }
    }

    public function accept(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'animal_id' => 'required|exists:animals,id',
            'duration' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'notes' => 'nullable|string|max:1000',
            'commitment' => 'required|array|min:3'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $fosterHome = FosterHome::where('user_id', Auth::id())->first();
            if (!$fosterHome) {
                return redirect()->route('fosterHome.form')->with('error', 'Please register as foster home first.');
            }
            $animal = Animal::find($request->animal_id);

            $fosterRequest = FosterRequest::create([
                'user_id' => Auth::id(),
                'animal_id' => $request->animal_id,
                'duration' => $request->duration,
                'location' => $request->location,
                'notes' => $request->notes,
                'commitments' => $request->commitment,
                'status' => 'pending',
                'submitted_at' => now()
            ]);

            $animal->update(['status' => 'pending']);

            return redirect()->route('foster.accepted')->with([
                'success' => true,
                'message' => "Permintaan kamu untuk menampung {$animal->name}! sedang diproses. Shelter akan menghubungi kamu dalam 1x24 jam melalui aplikasi atau WhatsApp.",
                'animal_name' => $animal->name,
                'animal_breed' => $animal->breed
            ]);

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memproses pengajuan foster. Silakan coba lagi.');
        }
    }
    public function accepted()
    {
        $message = session('message', 'Pengajuan foster Anda telah berhasil dikirim!');
        $animalName = session('animal_name', '');
        $animalBreed = session('animal_breed', '');
        
        return view('fosterHome.fosterAccept', compact('message', 'animalName', 'animalBreed'));
    }

    public function status()
    {
        $fosterRequests = FosterRequest::where('user_id', Auth::id())
            ->with('animal')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('fosterHome.status', compact('fosterRequests'));
    }

    public function cancel($id)
    {
        $fosterRequest = FosterRequest::where('id', $id)
            ->where('user_id', Auth::id())
            ->where('status', 'pending')
            ->first();

        if (!$fosterRequest) {
            return response()->json([
                'success' => false,
                'message' => 'Foster request not found or cannot be cancelled.'
            ], 404);
        }

        if ($fosterRequest->animal) {
            $fosterRequest->animal->update(['status' => 'available']);
        }

        $fosterRequest->delete();

        return response()->json([
            'success' => true,
            'message' => 'Foster request cancelled successfully.'
        ]);
    }
}
