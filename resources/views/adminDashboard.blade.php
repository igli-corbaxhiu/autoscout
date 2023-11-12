@extends('layouts.app')
@section('content')
    <style>
        /* Style for the container that holds the tags */
        .tag-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        /* Style for each individual tag mini card */
        .tag-card {
            background-color: #c9c0da;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 5px 10px;
            color: #333;
            font-size: 14px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        /* Style for the tag text */
        .tag-text {
            margin-right: 5px;
        }

    </style>    
    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <button type="button" class="btn btn-primary mb-4 bg-primary float-right" data-bs-toggle="modal" data-bs-target="#carModal">+ Add Car</button>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                              <th scope="col">Brand</th>
                              <th scope="col">Model</th>
                              <th scope="col">Registration Date</th>
                              <th scope="col">Engine Size</th>
                              <th scope="col">Price</th>
                              <th scope="col">Activity</th>
                              <th scope="col">Tags</th>
                              <th scope="col"></th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($cars as $car)
                                <tr>
                                    <td>{{ $car->brand }}</td>
                                    <td>{{ $car->model }}</td>
                                    <td>{{ $car->registrationDate }}</td>
                                    <td>{{ $car->engineSize }}</td>
                                    <td>{{ $car->price }}</td>
                                    <td>{{ $car->status ? 'Active' : 'Not active' }}</td>
                                    <td>
                                        <div class="tag-container">
                                            @foreach (json_decode($car->tags, true) as $tag)
                                                <div class="tag-card">
                                                    <span class="tag-text">{{ $tag['subcategory'] }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </td>
                                    <td class="d-flex gap-2">
                                        <a href="#" data-bs-toggle="modal"
                                            data-toggle="tooltip" data-id=""
                                            data-original-title="Edit"
                                            onClick="car_edit('{{ encrypt($car->id) }}')"
                                            class="edit car_edit text-white btn bg-sky-300 btn-sky-300 d-flex">Edit &nbsp;<svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                width="16" height="16"
                                                fill="currentColor" class="bi bi-pencil"
                                                viewBox="0 0 16 16">
                                                <path
                                                    d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                            </svg>
                                        </a>
                                        <form method="POST" action="{{ route('car.destroy', $car->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn bg-danger btn-danger">Delete Car</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                          </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="carModal" tabindex="-1" role="dialog" aria-labelledby="carModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="carModalLabel">Add Car</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="carForm" method="POST" action="{{ route('car.store') }}">
                        @csrf
                        
                        <!-- Brand -->
                        <div class="form-group">
                            <label for="brand">Brand</label>
                            <input style="border-radius: 0.25rem;border: 1px solid #ced4da;" type="text" class="form-control" id="brand" name="brand" required>
                        </div>

                        <!-- Model -->
                        <div class="form-group mt-2">
                            <label for="model">Model</label>
                            <input style="border-radius: 0.25rem;border: 1px solid #ced4da;" type="text" class="form-control" id="model" name="model" required>
                        </div>

                        <!-- Registration Date -->
                        <div class="form-group mt-2">
                            <label for="registrationDate">Registration Date</label>
                            <input style="border-radius: 0.25rem;border: 1px solid #ced4da;" type="date" class="form-control" id="registrationDate" name="registrationDate" required>
                        </div>

                        <!-- Engine Size -->
                        <div class="form-group mt-2">
                            <label for="engineSize">Engine Size</label>
                            <input style="border-radius: 0.25rem;border: 1px solid #ced4da;" type="text" class="form-control" id="engineSize" name="engineSize" required>
                        </div>

                        <!-- Price -->
                        <div class="form-group mt-2">
                            <label for="price">Price</label>
                            <input style="border-radius: 0.25rem;border: 1px solid #ced4da;" type="number" class="form-control" id="price" name="price" required>
                        </div>

                        <!-- Activity -->
                        <div class="form-group mt-2">
                            <label for="status">Activity</label>
                            <select class="form-control" id="status" name="status">
                                <option value="1">Active</option>
                                <option value="0">Not Active</option>
                            </select>
                        </div>

                        @foreach ($categories as $category)
                            <div class="mt-2">{{ $category->name }}:</div>
                            <div class="d-flex ml-2">
                                @foreach ($category->subcategories as $subcategory)
                                    <input class="ml-3 form-check-input" type="checkbox" name="subcategories[]" value="{{ $subcategory->id }}"> &nbsp;{{ $subcategory->name }}<br>
                                @endforeach
                            </div>
                        @endforeach

                        <button type="submit" class="btn btn-success bg-success d-flex mx-auto mt-3">Create Car</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="carModalEdit" tabindex="-1" role="dialog" aria-labelledby="carModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="carModalLabel">Edit Car</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="carForm" method="POST" action="{{ route('car.update') }}">
                        @csrf
                        @method('PUT')
                        <input type="hidden" class="form-control" name="carId" id="car_id_val">
                        <!-- Brand -->
                        <div class="form-group">
                            <label for="brand">Brand</label>
                            <input style="border-radius: 0.25rem;border: 1px solid #ced4da;" type="text" class="form-control" id="brand_edit" name="brand" required>
                        </div>

                        <!-- Model -->
                        <div class="form-group mt-2">
                            <label for="model">Model</label>
                            <input style="border-radius: 0.25rem;border: 1px solid #ced4da;" type="text" class="form-control" id="model_edit" name="model" required>
                        </div>

                        <!-- Registration Date -->
                        <div class="form-group mt-2">
                            <label for="registrationDate">Registration Date</label>
                            <input style="border-radius: 0.25rem;border: 1px solid #ced4da;" type="date" class="form-control" id="registrationDate_edit" name="registrationDate" required>
                        </div>

                        <!-- Engine Size -->
                        <div class="form-group mt-2">
                            <label for="engineSize">Engine Size</label>
                            <input style="border-radius: 0.25rem;border: 1px solid #ced4da;" type="text" class="form-control" id="engineSize_edit" name="engineSize" required>
                        </div>

                        <!-- Price -->
                        <div class="form-group mt-2">
                            <label for="price">Price</label>
                            <input style="border-radius: 0.25rem;border: 1px solid #ced4da;" type="number" class="form-control" id="price_edit" name="price" required>
                        </div>

                        <!-- Activity -->
                        <div class="form-group mt-2">
                            <label for="status">Activity</label>
                            <select class="form-control" id="status" name="status">
                                <option value="1" {{ $car->status == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ $car->status == 0 ? 'selected' : '' }}>Not Active</option>
                            </select>
                        </div>

                        @foreach ($categories as $category)
                            <div class="mt-2">{{ $category->name }}:</div>
                            <div class="d-flex ml-2">
                                @foreach ($category->subcategories as $subcategory)
                                    <?php
                                        $tags = json_decode($car->tags, true);
                                        $isChecked = in_array(['category' => $category->id, 'subcategory' => $subcategory->name], $tags);
                                    ?>
                                    <input data-category="{{ $category->id }}" class="ml-3 form-check-input category-checkbox" type="checkbox" name="subcategories[]" value="{{ $subcategory->name }}" {{ $isChecked ? 'checked' : '' }}> &nbsp;{{ $subcategory->name }}<br>
                                @endforeach
                            </div>
                        @endforeach

                        <button type="submit" class="btn btn-success bg-success d-flex mx-auto mt-3">Update Car</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        //ajax to store cars in database
        $(document).ready(function() {
            $(".carForm").submit(function(e) {

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
                            title: "Added successfully",
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

        function car_edit(id) {

            if (id) {
                $('#car_id_val').val(id);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "{{ route('car.get') }}",
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function(res) { console.log(res);
                        $('#brand_edit').val(res.brand);
                        $('#model_edit').val(res.model);
                        $('#registrationDate_edit').val(res.registrationDate);
                        $('#engineSize_edit').val(res.engineSize);
                        $('#price_edit').val(res.price);
                
                        $('#carModalEdit').modal('show');
                    },
                    error: function(error) {
                        alert('error; ' + eval(error));
                    }
                });
            }
        }

        //do not allow to check multiple subcategories inside a category
        $(document).ready(function() {
            $('.category-checkbox').on('click', function() {
                var category = $(this).data('category');

                // Uncheck all checkboxes in the same category except the current one
                $('.category-checkbox[data-category="' + category + '"]').not(this).prop('checked', false);
            });
        });
    </script>
    

@endsection
