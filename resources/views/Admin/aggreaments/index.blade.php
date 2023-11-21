@extends('Admin.layouts.master')
@section('title', 'Aggreament')
@section('style')
<link rel="stylesheet" type="text/css" href="../../../app-assets/css/plugins/forms/form-validation.css">
<link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css">
<link rel="stylesheet" type="text/css" href="../../../app-assets/css/plugins/forms/pickers/form-flat-pickr.css">
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/pages/app-user.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/pages/custom.css')}}">
<link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/tables/datatable/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/tables/datatable/responsive.bootstrap4.min.css">
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

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
                            <h4 class="card-title">Aggreaments</h4>
                        </div>
                        <div class="card-body">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                                    <li class="breadcrumb-item"><a href="#">Aggreaments</a></li>

                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <!-- users list start -->

        <section class="app-user-list">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                            <div class="card-header">
            <h3>Aggreaments List</h3>
            </div>
            <div class="card-body">
                                <table class="user-list-table table">
                                    <thead>
                                        <tr>

                                            <th></th>
                                            <th>Sr#</th>
                                            <th>Title</th>
                                            <th>Content</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                </table>
</div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="exampleModalScrollable" tabindex="-1" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                        <div class="modal-dialog aggreamentModal modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title viewagreamentheader" ></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body mt-1 viewagreamentbody">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="editAggreament" tabindex="-1" aria-labelledby="editAggreament" aria-hidden="true">
                        <div class="modal-dialog aggreamentModal  modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title viewagreamentheader" >Edit Aggreament</h5>

                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body mt-1 ">
                                    <form id="editAggreamentForm" action="" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group">
                                            <input type="hidden" name="id" id="aggreamentid" value="">
                                            <label for="title">Title</label>
                                            <input type="text" class="form-control agreamentTitle" id="title" name="title" placeholder="Title">
                                            <label for="aggreament"></label>
                                            <div id="editor" style="min-height:18em">
                                            </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" id="updateAggreament">Update</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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


<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script src="../../../app-assets/vendors/js/forms/validation/jquery.validate.min.js"></script>
<script src="../../../app-assets/vendors/js/pickers/pickadate/picker.js"></script>
<script src="../../../app-assets/js/core/app-menu.js"></script>
<script>



    ViewAgreament = (e) => {
    $(".viewagreamentheader").html("");
    $(".viewagreamentbody").html("");
    var header= $(e).attr('viewHeader');
    var data= $(e).attr('viewData');

    $('#exampleModalScrollable').modal('show');
    $(".viewagreamentheader").html(header);
    $(".viewagreamentbody").html(data);

}
$(document).ready(function() {

var dtUserTable = $('.user-list-table'),
    newUserSidebar = $('.new-user-modal'),
    newUserForm = $('.add-new-user'),
    assetPath = $('body').attr('data-asset-path');
// Users List datatable
if (dtUserTable.length) {
    dtUserTable.DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ordering: false,
        ajax: "{{ route('aggreament.index') }}",
        columns: [
            {
                data: 'responsive_id'
            },
            {
                data: 'id'
            },
            {
                data: 'title'
            },
            {
                data: 'body'
            },
            {
                data: '	is_applied'
            },
            {
                data: ''
            }
        ],
        columnDefs: [{
                // For Responsive
                targets: 0 ,
                className: 'control',
                defaultContent: "-",
                orderable: true,
                responsivePriority: 2,

            },
            {
                // For Content
                targets: 3,
                orderable: false,
                responsivePriority: 1,
                render: function(data, type, row, meta) {
                   data =  data.length > 50 ? data.substr(0, 50) + '...' : data;
                    return '<span onClick="ShowContent(this)" >'+data+'</span>';
                }


            },

            {
                // Actions
                targets: -1,
                title: 'Actions',
                orderable: false,
                render: function(data, type, full, meta) {
                    return (
                            '<div class="btn-group">' +
                            '<a class="btn btn-sm  dropdown-toggle hide-arrow"   data-bs-toggle="dropdown">' +
                            feather.icons['more-vertical'].toSvg({
                                class: 'font-small-4'
                            }) +
                            '</a>' +
                            '<div class="dropdown-menu viewagreamentAction dropdown-menu-end">' +
                            '<a  viewHeader="'+  full['title'] +'" viewData="'+ full['body'] +'" onClick="ViewAgreament(this)"  class="dropdown-item">' +
                            feather.icons['file-text'].toSvg({
                                class: 'font-small-4 me-50'
                            }) +
                            'Details</a>' +
                            '<a onClick="editAggreament(this)"  data-id="'+ full['id'] +'" class="dropdown-item">' +
                            feather.icons['archive'].toSvg({
                                class: 'font-small-4 me-50'
                            }) +
                            'Edit</a>' +
                            '<a href="javascript:;" onClick="delete_agreament('+full['id']+')" class="dropdown-item delete-record">' +
                            feather.icons['trash-2'].toSvg({
                                class: 'font-small-4 me-50'
                            }) +
                            'Delete</a></div>' +
                            '</div>' +
                            '</div>'
                        );
                }
            },

            {
                // For 	is_applied
                targets: 4,
                orderable: false,
                responsivePriority: 1,
                render: function(data, type, full, meta) {
                    if(full['is_applied'] == "1"){
                            return (
                                '<input  type="checkbox" data-id="'+full['id']+'" class="toggle-class" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-size="small" data-on="Applied" data-off="Disable" checked>'
                            );
                        }
                        else{
                            return (
                                '<input  type="checkbox" data-id="'+full['id']+'" class="toggle-class" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-size="small" data-on="Applied" data-off="Disable" >'
                            );
                        }
                    }
            }
        ],
        order: [
            [1, 'desc']
        ],
        "drawCallback": function() {
                    $('.toggle-class').bootstrapToggle();
                    changeStatus();
                },
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
$('div.head-label').html('<h6 class="mb-0">List of Aggreaments</h6>');


});
ShowContent = (e) => {

    console.log($(e).parent().parent().find(".viewagreamentAction").children().first("a").click());
// .click();
}
changeStatus = () => {
    $('.toggle-class').change(function() {
        var id = $(this).data('id');
        var status = $(this).prop('checked');
        status == true ? status = '1' : status = '0';
        var data = {
            id: id,
            status: status
        };
        $.ajax({
            url: "{{ route('changeStatus') }}",
            type: 'POST',
            data: data,
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
               Toast.fire({
                    icon: 'success',
                    title: 'Status changed successfully'
                });
                $('.user-list-table').DataTable().ajax.reload();
            }
        });
    });
}
editAggreament = (e) => {
    var dataSection =  $(e).parent().children().first("a");
    var id = $(e).attr("data-id");
    var header =  dataSection.attr('viewHeader');
    console.log("🚀 ~ file: index.blade.php ~ line 361 ~ header", header)
    var viewData =  dataSection.attr('viewData');
    $('#editAggreament').modal('show');
    $('#aggreamentid').val(id);
    $('.agreamentTitle').val(header);
    $('#editor').html(viewData);
    $('#editor').attr("contenteditable", "true");
    $('#editor').attr("data-gramm", "false");
}
$("#updateAggreament").click(function(e){
    e.preventDefault();
    var header = $('.agreamentTitle').val();
    var id = $('#aggreamentid').val();
    var content = $('#editor').html();
    var data = {
        title: header,
        body: content,
        id: id
    };
    $.ajax({
        url:"aggreament/update",
        type: 'POST',
        data: data,
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data) {
              Toast.fire({
                 icon: 'success',
                    title: 'Aggreament updated successfully'
                });
                $('#editAggreament').modal('hide');
                $('.user-list-table').DataTable().ajax.reload();
        }
    });
});
var toolbarOptions = [
    [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
    ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
    ['blockquote', 'code-block'],
    // custom button values
  [{ 'list': 'ordered'}, { 'list': 'bullet' }],
  [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
  [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
  [{ 'direction': 'rtl' }],                         // text direction

  [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
  [{ 'font': [] }],
  [{ 'align': [] }],
  ['link', 'image' , 'video'],
  ['clean']                                         // remove formatting button
];


var quill = new Quill('#editor', {
    theme: 'snow',
    modules: {
    toolbar: toolbarOptions
  }
});
delete_agreament = (id) => {

    $.ajax({
        url:"aggreament/destroy",
        type: 'DELETE',
        data: {id: id},
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data) {
            Toast.fire({
                icon: 'success',
                title: 'Aggreament deleted successfully'
            });
            $('.user-list-table').DataTable().ajax.reload();
        }
    });
}
</script>

@endsection
