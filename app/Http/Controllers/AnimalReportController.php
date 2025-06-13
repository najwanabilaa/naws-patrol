<?php

namespace App\Http\Controllers;

use App\Models\AnimalReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AnimalReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index()
    {
        $reports = AnimalReport::latest()->paginate(10);
        return view('animal-report.index', compact('reports'));
    }

    public function create()
    {
        return view('animal-report.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nomor_hp' => 'required|string|max:20',
            'alamat' => 'required|string|max:255',
            'alasan_melapor' => 'required|string',
            'foto' => 'required|image|max:2048', 
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        if ($request->hasFile('foto')) {
            $image = $request->file('foto');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('animal-reports', $imageName, 'public');
            $validated['foto'] = 'animal-reports/' . $imageName;
        }

        $report = AnimalReport::create([
            ...$validated,
            'status' => 'pending',
            'user_id' => auth()->id()
        ]);

        return redirect()
            ->route('animal-report.show', $report)
            ->with('success', 'Laporan berhasil dibuat!');
    }

    public function show(AnimalReport $animalReport)
    {
        return view('animal-report.show', ['report' => $animalReport]);
    }

    public function updateStatus(Request $request, AnimalReport $animalReport)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,in_progress,completed'
        ]);

        $animalReport->update($validated);

        return back()->with('success', 'Status laporan berhasil diperbarui!');
    }
} 