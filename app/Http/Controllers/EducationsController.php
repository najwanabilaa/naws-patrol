<?php

namespace App\Http\Controllers;

use App\Models\Educations;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class EducationsController extends Controller
{
    public function index()
    {
        $educations = Educations::with('user')
            ->when(request('category'), function($query) {
                return $query->where('category', request('category'));
            })->latest()->paginate(9);
        return view('educations.index', compact('educations'));
    }

    public function show(Educations $education)
    {
        return view('educations.show', compact('education'));
    }

    public function create()
    {
        $this->authorize('create', Educations::class);

        $categories = [
            'health' => 'Kesehatan',
            'care' => 'Perawatan',
            'behavior' => 'Perilaku',
            'food' => 'Makanan',
            'others' => 'Lainnya'
        ];

        return view('educations.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', Educations::class);

        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category' => 'required|in:health,care,behavior,food,others',
            'image' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('educations', $imageName, 'public');
            $validated['image'] = 'educations/' . $imageName;
        }

        $validated['user_id'] = auth()->id();

        Educations::create($validated);

        return redirect()->route('educations.index')
            ->with('success', 'Artikel edukasi berhasil dibuat!');
    }

    public function edit(Educations $education)
    {
        $this->authorize('update', $education);

        $categories = [
            'health' => 'Kesehatan',
            'care' => 'Perawatan',
            'behavior' => 'Perilaku',
            'food' => 'Makanan',
            'others' => 'Lainnya'
        ];

        return view('educations.edit', compact('education', 'categories'));
    }

    public function update(Request $request, Educations $education)
    {
        $this->authorize('update', $education);

        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category' => 'required|in:health,care,behavior,food,others',
            'image' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('image')) {
            if ($education->image) {
                Storage::disk('public')->delete($education->image);
            }

            // Store new image
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('educations', $imageName, 'public');
            $validated['image'] = 'educations/' . $imageName;
        }

        $education->update($validated);

        return redirect()->route('educations.show', $education)
            ->with('success', 'Artikel edukasi berhasil diperbarui!');
    }

    public function destroy(Educations $education)
    {
        $this->authorize('delete', $education);

        if ($education->image) {
            Storage::disk('public')->delete($education->image);
        }

        $education->delete();

        return redirect()->route('educations.index')
            ->with('success', 'Artikel edukasi berhasil dihapus!');
    }
} 