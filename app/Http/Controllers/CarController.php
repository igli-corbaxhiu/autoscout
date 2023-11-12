<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Cart;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $id = decrypt($request->id);
        $car = Car::find($id);

        return response()->json($car);
    }

    public function addToCart(Request $request, $carId)
    {
        //check if the car is already in the cart
        $cart = $request->session()->get('cart', []);

        if (in_array($carId, $cart)) {
            return redirect()->back()->with('info', 'Car is already in the cart.');
        }

        // if not in the cart, add the car
        $cart[] = $carId;
        $request->session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Car added to the cart.');
    }

    public function showCart(Request $request)
    {
        // get cars from session
        $cartItems = $request->session()->get('cart');
        $cars = null;
        if($cartItems != null)
        {
            $cars = Car::whereIn('id', $cartItems)->get();
            return view('cart', compact('cars'));
        }else{
            return view('cart', compact('cars'));
        }

    }

    public function checkout(Request $request)
    {
        // Check if the user is logged in
        if (auth()->check()) {
            
            //create the checkout record
            $checkout = new Cart;
            $checkout->user_id = Auth::user()->id;
            $checkout->cars = json_encode($request->session()->get('cart'));
            $cars = Car::whereIn('id', $request->session()->get('cart'))->get();

            foreach($cars as $car)
            {
                $car->status = 0; //change status of checked out cars so they can not be visible again
                $car->save();
            }

            $checkout->save();

            // Clear the session or temporary storage
            $request->session()->forget('cart');

            return redirect()->route('cart.show')->with('success', 'Proceed to checkout.');
        } else {
            // Redirect the user to the login
            return redirect()->route('login')->with('info', 'Please log in to complete your purchase.');
        }
    }

    public function checkoutItems(Request $request)
    {
        $checkedout = Cart::where('user_id', Auth::user()->id)->first();

        $cars = Car::whereIn('id', json_decode($checkedout->cars))->get();

        return view('checkedout', compact('cars'));

    }

    public function removeFromCart(Request $request, $carIdRemove)
    {
        $cartItems = $request->session()->get('cart', []);

        // array_filter to create a new array without the car ID to remove
        $updatedCart = array_filter($cartItems, function ($carId) use ($carIdRemove) {
            return $carId != $carIdRemove;
        });

        // update the session with the new array
        $request->session()->put('cart', $updatedCart);

        return redirect()->back()->with('success', 'Car removed from cart.');
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
    public function update(Request $request)
    {
        $id = decrypt($request->carId);

        $car = Car::where('id', $id)->first();

        $car->brand = $request->brand;        
        $car->model = $request->model;
        $car->registrationDate = $request->registrationDate;
        $car->engineSize = $request->engineSize;
        $car->price = $request->price;
        $car->status = $request->input('status');

        $subcategories = $request->subcategories; // array of subcategories selected

        $categorySubcategoryPairs = [];
        foreach ($subcategories as $subcategoryId) { 
            $subcategory = Subcategory::where('name', $subcategoryId)->first();
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

        if ($car->update()) {

            $alert = array(
                'title' => 'Good Job!',
                'text' => 'Car updated successfully!',
                'type' => 'success',
            );

        } else {

            $alert = array(
                'title' => 'Error #102',
                'text' => 'Problem updating car, contact support!',
                'type' => 'warning',
            );
        }

        return json_encode($alert);
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
