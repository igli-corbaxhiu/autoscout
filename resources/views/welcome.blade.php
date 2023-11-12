<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Carscout</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <!-- Styles -->
        <style>
            .relative.sm\:flex.sm\:justify-center.sm\:items-center.min-h-screen.bg-dots-darker.bg-center.bg-gray-100.dark\:bg-dots-lighter.dark\:bg-gray-900.selection\:bg-red-500.selection\:text-white {
                background-color: white;
            }
            .car-card {
                border: 1px solid #ccc;
                border-radius: 10px;
                margin-bottom: 20px;
                overflow: hidden;
                width: 16rem;
            }

            .car-image {
                width: 80%;
                height: 100px;
                object-fit: cover;
            }

            .card-body {
                padding: 20px;
            }

            .car-title {
                font-size: 1.25rem;
                font-weight: bold;
            }

            .car-details {
                color: #555;
            }

            .car-price {
                font-size: 1.5rem;
                font-weight: bold;
                color: #007bff;
            }

            .buy-button {
                background-color: #28a745;
                color: #fff;
                border: none;
                padding: 10px;
                border-radius: 5px;
                cursor: pointer;
            }

            .buy-button:hover {
                background-color: #218838;
            }
        </style>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <!-- Logo -->
                    <div class="shrink-0 flex items-center">
                        <a href="{{ url('/') }}">
                            <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                        </a>
                    </div>
                </div>
                <div class="sm:flex sm:items-center sm:ms-6">
                    @if (Auth::check())
                    <x-dropdown align="right" width="48">
                        
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>
    
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="https://cdn-icons-png.flaticon.com/512/2211/2211287.png" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>
    
                        <x-slot name="content">
                            <x-dropdown-link :href="url('/')">
                                {{ __('Dashboard') }}
                            </x-dropdown-link>
                            @if(Auth::user()->role == 'admin')
                            <x-dropdown-link :href="url('/admin-dashboard')">
                                {{ __('Admin Dashboard') }}
                            </x-dropdown-link>
                            @endif
                            <x-dropdown-link :href="url('/cart/show')">
                                {{ __('Cart') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="url('/checkout/items')">
                                {{ __('Checked out items') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>
    
                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
    
                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                    @else
                    <div class="space-x-8 sm:-my-px sm:ms-10 sm:flex justify-end">
                        <x-nav-link :href="url('/')">
                            {{ __('Dashboard') }}
                        </x-nav-link>
                        <x-nav-link :href="url('/cart/show')">
                            {{ __('Cart') }}
                        </x-nav-link>
                        <x-nav-link :href="url('/login')">
                            {{ __('Login') }}
                        </x-nav-link>
                        <x-nav-link :href="url('/register')">
                            {{ __('Register') }}
                        </x-nav-link>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="relative sm:flex sm:justify-center sm:items-center bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-white selection:bg-red-500 selection:text-white">
            <div class="row" style="margin-top: 5rem;">
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
                                @if(in_array($car->id, session('cart', [])))
                                    <button style="background-color: #eef275;" class="btn" disabled>Added to cart</button>
                                @else
                                    <form action="{{ route('cart.add', $car->id) }}" method="post" class="addCart">
                                        @csrf
                                        <button style="background-color: #218838;" class="buy-button" type="submit">Add to Cart</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </body>

    <script>
        //ajax to add to cart
        $(document).ready(function() {
            $(".addCart").submit(function(e) {

                e.preventDefault();

                var form = $(this);
                var actionUrl = form.attr('action');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "POST",
                    url: actionUrl,
                    data: form.serialize(),
                    success: function(data) {
                        Swal.fire({
                            title: "Added to cart",
                            icon: 'success',
                            showCancelButton: false, // Hide the cancel button
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'OK',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload(); // Reload the page after clicking OK
                            }
                        });
                    },

                    error: function(error) {

                        Swal.fire({
                            title: 'Error',
                            text: 'Problem with server',
                            icon: 'error'
                        });
                    }
                });
            });
        });
    </script>
</html>
