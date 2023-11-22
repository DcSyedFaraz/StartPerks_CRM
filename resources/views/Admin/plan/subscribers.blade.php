@extends('Admin.layouts.master')
@section('title', 'Subscribers')
@section('style')
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/plugins/forms/form-validation.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/app-user.css') }}">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/plugins/forms/form-wizard.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/pickers/pickadate/pickadate.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/plugins/forms/pickers/form-flat-pickr.css">
    <style>
        @media (min-width: 576px) {
            .modal-dialog {
                max-width: 900px !important;
                margin: 6.75rem auto !important;
            }
        }

        .bs-stepper {
            box-shadow: none !important;
        }
    </style>
@endsection
@section('content')
    <!-- BEGIN: Content-->
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
        </div>
        <div class="row mt-4">
            <div class="col-md-12">
                <h2>Teams</h2>
                <table class="table " id="dataTable">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Package</th>

                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($subscribers as $team)
                            <tr>
                                <td>{{ $team->name ?? '' }}</td>
                                <td>{{ $team->plans->name ?? '' }}</td>
                                {{-- @dd($team->plans->items) --}}
                                <td class="d-flex">
                                    <a href="{{ route('plan.edit', $team->id) }}" class="btn btn-primary ">Manage
                                        Team</a>
                                    <form action="{{ route('plan.destroy', $team->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="mx-2 btn btn-danger "
                                            onclick="return confirm('Are you sure you want to Delete this?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Modal to add new user starts-->
    <div class="modal-size-lg d-inline-block">
        <!--Add Modal -->
        <div class="modal fade text-start" id="add_modal" tabindex="-1" aria-labelledby="myModalLabel17"
            aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel17">Add Subscriber</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Horizontal Wizard -->
                        <section class="horizontal-wizard">
                            <form action="{{ route('plan.store') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="player">Select Company:</label>
                                    <select class="form-control" id="player" name="user_id" required>
                                        <option value="" hidden disabled selected>Select
                                            Company</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">
                                                {{ $user->name }}</option>
                                        @endforeach
                                    </select>
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
                                <button type="submit" class="btn btn-primary mt-2">Save changes</button>
                    </div>
                </div>
                <div class="modal-footer">
                </div>
                </form>
                </section>
                <!-- /Horizontal Wizard -->
            </div>
        </div>
    </div>
    </div>
    <!--End Add Modal -->

    </div>
    <!-- END: Content-->
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                "pagingType": "full_numbers",
                "paging": true,
                "responsive": true,
                "ordering": false,
                "dom": '<"card-header border-bottom p-1"<"head-label"><"dt-action-buttons text-end"B>><"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                "displayLength": 10,
                "lengthMenu": [10, 25, 50, 75, 100],
                "buttons": [{
                        extend: 'collection',
                        className: 'btn btn-outline-secondary dropdown-toggle me-2',
                        text: feather.icons['share'].toSvg({
                            class: 'font-small-4 me-50'
                        }) + 'Export',
                        buttons: [{
                                extend: 'print',
                                text: feather.icons['printer'].toSvg({
                                    class: 'font-small-4 me-50'
                                }) + 'Print',
                                className: 'dropdown-item',
                                exportOptions: {
                                    columns: [0, 1]
                                }
                            },
                            {
                                extend: 'csv',
                                text: feather.icons['file-text'].toSvg({
                                    class: 'font-small-4 me-50'
                                }) + 'Csv',
                                className: 'dropdown-item',
                                exportOptions: {
                                    columns: [0, 1]
                                }
                            },
                            {
                                extend: 'excel',
                                text: feather.icons['file'].toSvg({
                                    class: 'font-small-4 me-50'
                                }) + 'Excel',
                                className: 'dropdown-item',
                                exportOptions: {
                                    columns: [0, 1]
                                }
                            },
                            {
                                extend: 'pdf',
                                text: feather.icons['clipboard'].toSvg({
                                    class: 'font-small-4 me-50'
                                }) + 'Pdf',
                                className: 'dropdown-item',
                                exportOptions: {
                                    columns: [0, 1]
                                }
                            },
                            {
                                extend: 'copy',
                                text: feather.icons['copy'].toSvg({
                                    class: 'font-small-4 me-50'
                                }) + 'Copy',
                                className: 'dropdown-item',
                                exportOptions: {
                                    columns: [0, 1]
                                }
                            }
                        ],
                        init: function(api, node, config) {
                            $(node).removeClass('btn-secondary');
                            $(node).parent().removeClass('btn-group');
                            setTimeout(function() {
                                $(node).closest('.dt-buttons').removeClass('btn-group')
                                    .addClass('d-inline-flex');
                            }, 50);
                        }
                    },
                    {
                        text: feather.icons['plus'].toSvg({
                            class: 'me-50 font-small-4'
                        }) + 'Add Subscriber',
                        className: 'create-new btn btn-primary',
                        attr: {
                            'data-bs-toggle': 'modal',
                            'data-bs-target': '#add_modal'
                        },
                        init: function(api, node, config) {
                            $(node).removeClass('btn-secondary');
                        }
                    }
                ],
                "language": {
                    "paginate": {
                        "previous": '&nbsp;',
                        "next": '&nbsp;'
                    }
                }
            });
        });
    </script>
@endsection
