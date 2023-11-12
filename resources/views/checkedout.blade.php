@extends('layouts.app')
@section('content')
<div style="font-size: 1.3rem" class="p-2 ml-4 d-flex justify-center bg-slate-400 text-white font-extrabold w-56 mx-auto rounded-md">Checked out items</div>
<div class="row" style="margin-top: 2rem;">
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
            </div>
        </div>
    </div>
    @endforeach
    @else
    <div>No cars checked out!</div>
    @endif
</div>
@endsection