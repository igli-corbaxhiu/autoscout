<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $validatedData = $request->validate([
            'brand' => 'required',
            'model' => 'required',
            'registrationDate' => 'required|date',
            'engineSize' => 'required',
            'price' => 'required',
        ]);
    
        // Create a new car
        $car = new Car;
        $car->brand = $request->input('brand');
        $car->model = $request->input('model');
        $car->registrationDate = $request->input('registrationDate');
        $car->engineSize = $request->input('engineSize');
        $car->price = $request->input('price');
        $car->status = $request->input('status');

        $subcategories = $request->subcategories; // array of subcategories selected

        $categorySubcategoryPairs = [];
        foreach ($subcategories as $subcategoryId) {
            $subcategory = Subcategory::find($subcategoryId);
            if ($subcategory) {
                $categorySubcategoryPairs[] = [
                    'category' => $subcategory->category->id,
                    'subcategory' => $subcategory->name,
                ];
            }
        }
    
        // Convert the array to JSON
        $jsonPairs = json_encode($categorySubcategoryPairs);
    
        // Save the JSON pairs to the car
        $car->tags = $jsonPairs;
    
        // Save the car
        $car->save();
    
        // Redirect to a success page or return a response
        return redirect('/admin-dashboard')->with('success', 'Car added successfully');
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
    public function destroy(Car $car)
    {
        $car->delete();
        return redirect('/admin-dashboard')->with('success', 'Car deleted successfully');
    }
}
