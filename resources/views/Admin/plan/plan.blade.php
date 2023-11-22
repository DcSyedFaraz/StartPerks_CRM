@extends('Admin.layouts.master')

@section('title', 'Plans')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Add Plan
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Add Plan</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="modal-body">
                                            <form action="{{ route('plan.store') }}" method="post">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="name">Name:</label>
                                                    <input class="form-control" type="text" name="name" id="name">
                                                </div>
                                                <div class="form-group">
                                                    <label for="slug">Slug:</label>
                                                    <input class="form-control" type="text" name="slug" id="slug">
                                                </div>
                                                <div class="form-group">
                                                    <label for="stripe_plan">API ID:</label>
                                                    <input class="form-control" type="text" name="stripe_plan" id="stripe_plan">
                                                </div>
                                                <div class="form-group">
                                                    <label for="price">Price:</label>
                                                    <input class="form-control" type="number" name="price" id="price">
                                                </div>
                                                <div class="form-group">
                                                    <label for="description">Description:</label>
                                                    <input class="form-control" type="text" name="description" id="description">
                                                </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="card-body">

                    <div class="row">
                        @foreach ($plans as $plan)
                            <div class="col-md-6">
                                <div class="card mb-3">
                                    <div class="card-header">
                                        ${{ $plan->price }}/Mo
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $plan->name }}</h5>
                                        <p class="card-text">{{ $plan->description }}</p>

                                        <a href="{{ route('plan.show', $plan->slug) }}"
                                            class="btn btn-primary pull-right">Choose</a>
                                        <form action="{{ route('plan.destroy', $plan->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm mx-1 btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this plan?')">Delete</button>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>
    <style>
        /* Add your custom modal styles here */
        .custom-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 100%;
        }
    </style>

    <script>
        function openCustomModal() {
            document.getElementById('customModal').style.display = 'flex';
        }

        function closeCustomModal() {
            document.getElementById('customModal').style.display = 'none';
        }
    </script>
@endsection
