<?php

namespace App\Http\Controllers;

use App\Charts\UsersByRoleChart;
use App\Models\Selling;
use App\Models\User;
use App\Models\Subdistrict;
use App\Models\Service;
use App\Models\City;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(UsersByRoleChart $userChart)
    {
        $cities = City::All();
        $subdistricts = Subdistrict::All();
        $services = Service::All();
        $user = User::count();
        $sellings = Selling::count();
        return view('dashboard', compact('user', 'sellings','services','cities','subdistricts'), ['chart' => $userChart->build()]);
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
