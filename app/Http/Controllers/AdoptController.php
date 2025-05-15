<?php

namespace App\Http\Controllers;

use App\Models\Adopt;
use App\Http\Requests\StoreAdoptRequest;
use App\Http\Requests\UpdateAdoptRequest;

class AdoptController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('adopt');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAdoptRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Adopt $adopt)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Adopt $adopt)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAdoptRequest $request, Adopt $adopt)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Adopt $adopt)
    {
        //
    }
}
