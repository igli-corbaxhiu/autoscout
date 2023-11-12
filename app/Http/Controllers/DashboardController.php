<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cars = Car::where('status', 1)->get();
        return view('welcome', compact('cars'));
    }

    public function adminDashboard()
    {
        $cars = Car::all();
        $categories = Category::all();
        $subcategories = Subcategory::all();
        
        return view('adminDashboard', compact('cars', 'categories', 'subcategories'));
    }

    public function dashboard(Request $request)
    {
        // get cars from session after logged in
        $cartItems = $request->session()->get('cart', []);

        return view('dashboard', compact('cartItems'));
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
