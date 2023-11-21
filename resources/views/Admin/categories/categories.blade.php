@extends('Admin.layouts.master')
@section('title', 'Categories')
@section('style')
<link rel="stylesheet" type="text/css" href="../../../app-assets/css/plugins/forms/form-validation.css">
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/pages/app-user.css')}}">
<link rel="stylesheet" type="text/css" href="../../../app-assets/css/plugins/forms/form-wizard.css">
<link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/pickers/pickadate/pickadate.css">
<link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css">
<link rel="stylesheet" type="text/css" href="../../../app-assets/css/plugins/forms/pickers/form-flat-pickr.css">
<style>
   @media (min-width: 576px){
   .modal-dialog {
   max-width: 900px !important;
   margin: 6.75rem auto !important;
   }
   }
   .bs-stepper{
   box-shadow:none !important;
   }
</style>
@endsection
@section('content')
<!-- BEGIN: Content-->
<div class="content-wrapper container-xxl p-0">
   <div class="content-header row">
   </div>
   <div class="content-body">
        <section id="default-breadcrumb">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Categories</h4>
                        </div>
                        <div class="card-body">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                                    <li class="breadcrumb-item"><a href="#">Categories</a></li>

                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <!-- users list start -->
        <section class="app-user-list">
        <div class="">
        <div class="modal" tabindex="-1" role="dialog" id="editCategoryModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Category</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-body">
                <div class="form-group">
                    <input type="text" name="name" class="form-control" value="" placeholder="Category Name" required>
                </div>
                </div>

                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
            </form>
        </div>
        </div>

        <div class="row">
        <div class="col-md-8">

        <div class="card">

            <div class="card-body">
            <table class="user-list-table table">
                  <thead class="table-light">
                     <tr>
                        <th></th>
                        <th>Category</th>
                        <th>Slug</th>
                        <th>Parent Category</th>
                        <th>Status</th>
                        <th>Actions</th>
                     </tr>
                  </thead>
               </table>
            </div>
        </div>
        </div>

        <div class="col-md-4">
        <div class="card">
            <div class="card-header">
            <h3>Create Category</h3>
            </div>

            <div class="card-body">
            <form action="{{ route('category.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Category Name</label>
                    <input type="text" name="name" class="form-control" value="" placeholder="Category Name" required>
                </div>
                <br/>
                <div class="form-group">
                <label for="parent_id">Parent Category</label>
                <select class="form-control" name="parent_id">
                    <option value="">Select Parent Category</option>

                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                </div>
                <br/>

                <label  class="form-label" for="select2-icons">Icons</label>
                <select data-placeholder="Select a state..." name="icon" class="select2-icons form-select" id="select2-icons">
                        <option value="facebook" data-icon="facebook" selected>Facebook</option>
                        <option value="twitter" data-icon="twitter">Twitter</option>
                        <option value="linkedin" data-icon="linkedin">LinkedIN</option>
                        <option value="github" data-icon="github">GitHub</option>
                        <option value="instagram" data-icon="instagram">Instagram</option>
                        <option value="dribbble" data-icon="dribbble">Dribbble</option>
                        <option value="gitlab" data-icon="gitlab">GitLab</option>
                        <option value="pdf" data-icon="file">PDF</option>
                        <option value="word" data-icon="file-text">Word</option>
                        <option value="image" data-icon="image">Image</option>
                        <option value="figma" data-icon="figma">Figma</option>
                        <option value="chrome" data-icon="chrome">Chrome</option>
                        <option value="safari" data-icon="command">Safari</option>
                        <option value="slack" data-icon="slack">Slack</option>
                        <option value="youtube" data-icon="youtube">YouTube</option>
                </select>
                <br/>
                <div class="form-group">
                <button type="submit" class="btn btn-primary w-100">Create Category</button>
                </div>
            </form>
            </div>
        </div>
        </div>
        </div>
        </div>

        </section>
      <!-- users list ends -->
   </div>
</div>
<!-- END: Content-->
@endsection
@section('scripts')
<script src="../../../app-assets/vendors/js/forms/validation/jquery.validate.min.js"></script>
<script src="../../../app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js"></script>
<script src="../../../app-assets/vendors/js/pickers/pickadate/picker.js"></script>
<script src="../../../app-assets/vendors/js/pickers/pickadate/picker.date.js"></script>
<script src="../../../app-assets/vendors/js/forms/cleave/cleave.min.js"></script>
<script src="../../../app-assets/vendors/js/forms/cleave/addons/cleave-phone.us.js"></script>
<script src="../../../app-assets/js/scripts/forms/form-input-mask.js"></script>
<script src="../../../app-assets/vendors/js/extensions/sweetalert2.all.min.js"></script>
<script src="../../../app-assets/vendors/js/extensions/polyfill.min.js"></script>
<script src="../../../app-assets/js/core/app-menu.js"></script>
<script src="../../../app-assets/js/scripts/extensions/ext-component-sweet-alerts.js"></script>
<script type="text/javascript">
          $('.edit-category').on('click', function() {
            var id = $(this).data('id');
            var name = $(this).data('name');
            var url = "{{ url('category') }}/" + id;

            $('#editCategoryModal form').attr('action', url);
            $('#editCategoryModal form input[name="name"]').val(name);
          });

$(document).ready(function() {




var dtUserTable = $('.user-list-table'),
    newUserSidebar = $('.new-user-modal'),
    newUserForm = $('.add-new-user'),
    statusObj = {
        1: {
            title: 'Active',
            class: 'badge-light-success'
        },
        0: {
            title: 'Inactive',
            class: 'badge-light-danger'
        }
    };
paymentObj = {
    1: {
        title: 'Pending',
        class: 'badge-light-success'
    },
    0: {
        title: 'Not Paid',
        class: 'badge-light-danger'
    }
};

var assetPath = '../../';
if ($('body').attr('data-framework') === 'laravel') {
    assetPath = $('body').attr('data-asset-path');
    //  userView = assetPath + 'app/user/view';
    // userEdit = assetPath + 'app/user/edit';
}
// Users List datatable

if (dtUserTable.length) {
    dtUserTable.DataTable({

        processing: true,
        serverSide: true,
        responsive: true,
        ordering: false,
        ajax: "{{ route('category.index') }}",
        columns: [
            // columns according to JSON
            {
                data: 'responsive_id'
            },
            {
                data: 'name'
            },
            {
                data: 'slug'
            },
            {
                data: 'parent_name'
            },

            {
                data: 'status'
            },
            {
                data: ''
            }
        ],
        columnDefs: [{
                // For Responsive
                className: 'control',
                defaultContent: "-",
                orderable: false,
                responsivePriority: 2,
                targets: 0
            },
            {
                // User full name and username
                targets: 1,
                responsivePriority: 4,
                render: function(data, type, full, meta) {
                    var $name = full['name']
                      var $icon = full['icon'];

                    var stateNum = Math.floor(Math.random() * 6) + 1;
                    var states = ['success', 'danger', 'warning', 'info', 'dark', 'primary', 'secondary'];
                    var $state = states[stateNum];
                    var colorClass = 'bg-light-' + $state + '';
                    // Creates full output for row
                    var $row_output =
                        '<div class="d-flex flex-column">' +
                        '<a href="#" class="user_name text-truncate">'+
                        feather.icons[$icon].toSvg({
                            class: 'font-medium-4  ' + colorClass + ' me-50',
                        }) +
                        '<span class="fw-bold">' +
                        $name +
                        '</span></a>'  +
                        '</div>' +
                        '</div>';
                    return $row_output;
                }
            },
            {
                // Actions
                targets: -1,
                title: 'Actions',
                orderable: false,
                render: function(data, type, full, meta) {
                    return (
                        '<a href="javascript:;" style="color:red;" onClick="delete_category('+full['id']+')" class="danger dropdown-item delete-record">' +
                        feather.icons['trash-2'].toSvg({
                            class: 'font-small-4 me-50'
                        }) +
                        '</a>'
                    );
                }
            }
        ],
        order: [
            [1, 'desc']
        ],
        dom: '<"d-flex justify-content-between align-items-center header-actions mx-1 row mt-75"' +
            '<"col-sm-12 col-md-4 col-lg-6" l>' +
            '<"col-sm-12 col-md-8 col-lg-6 ps-xl-75 ps-0"<"dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-md-end align-items-center flex-sm-nowrap flex-wrap me-1"<"me-1"f>B>>' +
            '>t' +
            '<"d-flex justify-content-between mx-2 row mb-1"' +
            '<"col-sm-12 col-md-6"i>' +
            '<"col-sm-12 col-md-6"p>' +
            '>',
        language: {
            sLengthMenu: 'Show _MENU_',
            search: 'Search',
            searchPlaceholder: 'Search..'
        },
        // Buttons with Dropdown
        buttons: [],
        // For responsive popup
        responsive: {
            details: {
                display: $.fn.dataTable.Responsive.display.modal({
                    header: function(row) {
                        var data = row.data();
                        return 'Details of ' + data['name'];
                    }
                }),
                type: 'column',
                renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                    tableClass: 'table',
                    columnDefs: [{
                            targets: 1,
                            visible: false
                        },
                        {
                            targets: 2,
                            visible: false
                        }
                    ]
                })
            }
        },
        language: {
            paginate: {
                // remove previous & next text from pagination
                previous: '&nbsp;',
                next: '&nbsp;'
            }
        },
        initComplete: function() {
            // Adding status filter once table initialized

        }
    });
}
$('div.head-label').html('<h6 class="mb-0">List of Categories</h6>');


});

function delete_category(id) {
    if (confirm("Are You sure want to Delete !")) {
        $.ajax({
            url: "category/" + id,
            type: "DELETE",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.error_message) {
                    Toast.fire({
                        icon: 'error',
                        title: 'An error has been occured! Please Contact Administrator.'
                    })

                } else {

                    $('.user-list-table').DataTable().ajax.reload();
                    Toast.fire({
                        icon: "success",
                        title: "Category is successfully deleted !"
                    })
                }
            }
        });
    }
}
    </script>
@endsection
