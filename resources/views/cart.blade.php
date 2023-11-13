@extends('layouts.app')
@section('content')
<div style="font-size: 1.3rem" class="mt-3 p-2 ml-4 d-flex justify-center bg-slate-400 text-white font-extrabold w-56 mx-auto rounded-md">Cart</div>
<div class="row" style="margin-top: 5rem;">
    @if($cars != null)
    @foreach ($cars as $car)
    <div class="col-sm-3 d-flex justify-center">
        <div class="car-card">
            <img src="{{ asset('car.png') }}" alt="Car Image" class="car-image mx-auto">
            <div class="card-body">
                <h5 class="car-title">{{ $car->brand }}</h5>
                <p class="car-details">{{ $car->model }}</p>
                <p class="car-details">{{ $car->registrationDate }}</p>
                <p class="car-details">{{ $car->engineSize }}</p>
                <p class="car-price">${{ $car->price }}</p>
                <?php
                    $tags = json_decode($car->tags);
                ?>
                <div>
                    @foreach ($tags as $data)
                        <div class="btn bg-fuchsia-300 mt-1" style="font-size: 0.7rem;">{{ $data->subcategory}}</div>
                    @endforeach
                </div>
                <form action="{{ route('cart.remove', $car->id) }}" method="post" class="addCart">
                    @csrf
                    <button style="background-color: #fa8383;" class="buy-button mt-2" type="submit">Remove from cart</button>
                </form>
              
            </div>
        </div>
    </div>
    @endforeach
    <div class="d-flex justify-center">
        <form action="{{ route('checkout') }}" method="post">
            @csrf
            <button style="background-color: #4b72ff;" class="buy-button" type="submit">Checkout</button>
        </form>
    </div>
    @else
    <div style="padding: 2rem;
    justify-content: center;
    display: flex;
    font-weight: bold;
    font-size: 1.4rem;">No cars in the cart!</div>
    @endif
</div>
@endsection