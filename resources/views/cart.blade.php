@extends('layouts.app')
@section('content')
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
                <form action="{{ route('cart.remove', $car->id) }}" method="post" class="addCart">
                    @csrf
                    <button style="background-color: #fa8383;" class="buy-button" type="submit">Remove from cart</button>
                </form>
              
            </div>
        </div>
    </div>
    @endforeach
    @else
    <div>No cars in the cart!</div>
    @endif
</div>
@endsection