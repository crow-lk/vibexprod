<?php

namespace App\Http\Controllers;

use App\Models\MembershipSubscriptions;
use Illuminate\Http\Request;

class membership_subscriptionsController extends Controller
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
    public function show(MembershipSubscriptions $membershipSubscriptions)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MembershipSubscriptions $membershipSubscriptions)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MembershipSubscriptions $membershipSubscriptions)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MembershipSubscriptions $membershipSubscriptions)
    {
        //
    }
}
