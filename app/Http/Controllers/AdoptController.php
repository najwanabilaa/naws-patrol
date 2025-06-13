<?php

namespace App\Http\Controllers;

use App\Models\Adoption;
use App\Models\Animal; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class AdoptController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('adopt.index');
    }

    public function getPets(Request $request)
    {
        $category = $request->get('category');
        $search = $request->get('search');

        $query = Animal::where('status', 'available');

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('breed', 'like', "%{$search}%");
            });
        }

        if ($category) {
            $query->where('type', $category);
        }

        $animals = $query->get()->map(function($animal) {
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

        return response()->json([
            'success' => true,
            'data' => $animals
        ]);
    }

    public function detail($id)
    {
        $animal = Animal::find($id);
        
        if (!$animal) {
            return redirect()->route('adopt.index')->with('error', 'Hewan tidak ditemukan.');
        }

        $pet = [
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

        return view('adopt.detail', compact('pet'));
    }

    public function form(Request $request)
    {
        $petId = $request->get('pet_id');
        $pet = null;
        
        if ($petId) {
            $animal = Animal::find($petId);
            if ($animal) {
                $pet = [
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
            }
        }

        return view('adopt.form', compact('pet'));
    }

    public function submitForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|string|max:255',
            'age' => 'required|integer|min:18|max:100',
            'address' => 'required|string|max:500',
            'house_type' => 'required|string|max:100',
            'daily_activity' => 'required|string|max:255',
            'reason' => 'required|string|max:1000',
            'pet_id' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $animal = Animal::find($request->pet_id);
        if (!$animal) {
            return redirect()->back()->with('error', 'Hewan tidak ditemukan.');
        }

        $pet = [
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

        session([
            'adoption_form_data' => $request->all(),
            'selected_pet_data' => $pet
        ]);

        return redirect()->route('adopt.confirm');
    }

    public function confirm()
    {
        if (!session()->has('adoption_form_data') || !session()->has('selected_pet_data')) {
            return redirect()->route('adopt.index')->with('error', 'Data tidak ditemukan. Silakan isi form kembali.');
        }

        return view('adopt.confirm');
    }

    public function confirmSubmit(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'age' => 'required|numeric|min:17',
            'address' => 'required|string',
            'house_type' => 'required|string',
            'daily_activity' => 'required|string',
            'reason' => 'required|string',
            'pet_id' => 'required',
            'pet_name' => 'required|string'
        ]);

        try {
            $animal = Animal::find($validated['pet_id']);
            
            if (!$animal) {
                return redirect()->back()->with('error', 'Data hewan tidak ditemukan.');
            }

            $adoption = Adoption::create([
                'user_id' => Auth::id(),
                'animal_id' => $animal->id, 
                'pet_name' => $validated['pet_name'],
                'pet_breed' => $animal->breed ?? '',
                'pet_location' => $animal->location ?? '',
                'pet_age' => $animal->age ?? '',
                'pet_color' => $animal->color ?? '',
                'pet_gender' => $animal->gender ?? '',
                'pet_description' => $animal->description ?? '',
                'pet_image' => $animal->image_path ?? '',
                'pet_category' => $animal->type ?? '',
                'full_name' => $validated['full_name'],
                'age' => $validated['age'],
                'address' => $validated['address'],
                'house_type' => $validated['house_type'],
                'daily_activity' => $validated['daily_activity'],
                'reason' => $validated['reason'],
                'status' => 'pending',
                'submitted_at' => now()
            ]);

            $animal->update(['status' => 'pending']);

            session()->forget(['adoption_form_data', 'selected_pet_data']);

            return redirect()->route('adopt.success')->with([
                'success' => 'Pengajuan adopsi berhasil dikirim!',
                'adoption_id' => $adoption->id,
                'pet_data' => [
                    'name' => $animal->name,
                    'breed' => $animal->breed,
                    'image' => $animal->image_path,
                    'gender' => $animal->gender,
                    'age' => $animal->age
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('Adoption submission error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memproses adopsi. Silakan coba lagi.');
        }
    }

    public function success()
    {
        if (!session()->has('success')) {
            return redirect()->route('adopt.index');
        }

        return view('adopt.success');
    }

    public function adoptStatus()
    {
        $adoptions = Adoption::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('adopt.status', compact('adoptions'));
    }

    public function getAdoptionStatus(Request $request)
    {
        $adoptions = Adoption::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        $data = $adoptions->map(function ($adoption) {
            return [
                'id' => $adoption->id,
                'pet_name' => $adoption->pet_name,
                'pet_image' => $adoption->pet_image,
                'pet_breed' => $adoption->pet_breed,
                'pet_gender' => $adoption->pet_gender,
                'pet_age' => $adoption->pet_age,
                'submitted_at' => $adoption->formatted_submitted_at,
                'approved_at' => $adoption->formatted_approved_at,
                'status' => $adoption->status,
                'status_badge' => $adoption->status_badge
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    public function help()
    {
        $helpPets = Animal::available()
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
        
        return view('adopt.help', compact('helpPets'));
    }


    public function cancel($id)
    {
        $adoption = Adoption::where('id', $id)
            ->where('user_id', Auth::id())
            ->where('status', 'pending')
            ->first();

        if (!$adoption) {
            return response()->json([
                'success' => false,
                'message' => 'Pengajuan adopsi tidak ditemukan atau tidak dapat dibatalkan.'
            ], 404);
        }

        if ($adoption->animal_id) {
            Animal::where('id', $adoption->animal_id)->update(['status' => 'available']);
        }

        $adoption->delete();

        return response()->json([
            'success' => true,
            'message' => 'Pengajuan adopsi berhasil dibatalkan.'
        ]);
    }

    public function getAdoptionDetail($id)
    {
        $adoption = Adoption::where('id', $id)
            ->where('user_id', Auth::id())
            ->first();

        if (!$adoption) {
            return response()->json([
                'success' => false,
                'message' => 'Pengajuan adopsi tidak ditemukan.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $adoption
        ]);
    }

   public function terms(Request $request)
    {
        $from = $request->get('from');
        $petId = $request->get('pet_id');
        
        return view('adopt.terms', compact('from', 'petId'));
    }
    
}
