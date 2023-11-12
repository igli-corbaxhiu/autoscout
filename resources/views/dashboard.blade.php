@extends('layouts.app')
@extends('content')
{{ dd($cartItems) }}

    @foreach ($cartItems as $item)
        <div>{{ $item->brand }}</div>
    @endforeach
@endsection