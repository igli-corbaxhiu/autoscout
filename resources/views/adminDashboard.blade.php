<x-app-layout>
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
                                    <td>{{ $car->active ? 'Active' : 'Not active' }}</td>
                                    <td>
                                        <div class="tag-container">
                                            @foreach (json_decode($car->tags, true) as $tag)
                                                <div class="tag-card">
                                                    <span class="tag-text">{{ $tag['subcategory'] }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </td>
                                    <td>
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
                    <form id="carForm" method="POST" action="{{ route('car.store') }}">
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

    <script>
        //ajax to store cars in database
        $(document).ready(function() {
            $("#carForm").submit(function(e) {

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
                            title: "Sukses",
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
    

</x-app-layout>
