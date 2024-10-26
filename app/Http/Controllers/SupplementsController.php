<?php

namespace App\Http\Controllers;

use App\Models\Supplements;
use Illuminate\Http\Request;

class SupplementsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return 'This your index page';
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplements $supplements)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supplements $supplements)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Supplements $supplements)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplements $supplements)
    {
        //
    }
}
