@extends('Admin.layouts.master')

@section('title', 'Bank Cards')
@section('content')
<section class="content-wrapper container-xxl p-0">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">Bank Cards</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">Bank Cards
                            </li>
                            <li class="breadcrumb-item active">Add & Edit Bank Cards
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <div class="row">
            <div class="col-12">
                <div class="card pb-1">
                    <table class="table px-1" id="dataTable">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Bank</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal-size-lg d-inline-block">
                  <!--Add Modal -->
                  <div class="modal fade text-start" id="add_modal" tabindex="-1" aria-labelledby="myModalLabel17" aria-hidden="true">
                     <div class="modal-dialog modal-md">
                        <div class="modal-content">
                           <div class="modal-header">
                              <h4 class="modal-title" id="myModalLabel17">Add Banks Card</h4>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                           </div>
                           <form class="form" id="add_form">
                              @csrf
                              <div class="modal-body">
                                 <div class="row">
                                    <div class="col-md-12 col-12">
                                       <div class="mb-1">
                                            <label class="form-label" for="bank">Category</label>
                                            <select type="text"  class="form-control"name="category_id" required>
                                                <option>Select Category</option>
                                                @foreach($catogeries as $cat)
                                                 <option value="{{ $cat->id }}">{{ $cat->name}}</option>
                                                @endforeach
                                            </select>
                                       </div>
                                       <div class="mb-1">
                                            <label class="form-label" for="bank">Stage</label>
                                            <select type="text"  class="form-control"name="stage" required>
                                                <option>Select Stage</option>
                                                @foreach($stages as $stage)
                                                 <option value="{{ $stage["value"]}}">{{ $stage["text"]}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                       <div class="mb-1">
                                          <label class="form-label" for="bank">Bank</label>
                                          <select type="text"  class="form-control"name="bank_id" required>
                                            <option>Select Bank</option>
                                            @foreach($Banks as $bank)
                                             <option value="{{ $bank->id }}">{{ $bank->bank_name}}</option>
                                            @endforeach
                                          </select>
                                       </div>
                                       <div class="mb-1">
                                            <label class="form-label" for="bank">Card Name</label>
                                            <input type="text" class="form-control" placeholder="Enter Name..." name="card_name" required/>
                                       </div>
                                       <div class="mb-1">
                                        <label class="form-label" for="bank">Url</label>
                                        <input type="text" class="form-control" placeholder="Enter Url..." name="url" required/>
                                       </div>
                                       <div class="input-group mb-3">
                                        <label class="input-group-text" for="inputGroupFile01">Image </label>
                                        <input type="file" class="form-control" name="image" id="inputGroupFile01">
                                      </div>
                                    </div>
                                   
                                 </div>
                              </div>
                              <div class="modal-footer">
                                 <button type="reset" class="btn btn-outline-success">Reset</button>
                                 <button type="submit" class="btn btn-primary" id="save">Save</button>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
                  <!--End Add Modal -->
                  <!--Edit Modal -->
                  <div class="modal fade text-start" id="edit_modal" tabindex="-1" aria-labelledby="myModalLabel17" aria-hidden="true">
                     <div class="modal-dialog modal-md">
                        <div class="modal-content">
                           <div class="modal-header">
                              <h4 class="modal-title" id="myModalLabel17">Edit Banks</h4>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                           </div>
                           <form class="form" id="edit_form">
                              @csrf
                              @method('PUT')
                              <div class="modal-body">
                                 <div class="row">
                                    <div class="col-md-12 col-12">
                                        <div class="mb-1">
                                             <label class="form-label" for="cat_id">Category</label>
                                             <select type="text" id="cat_id"  class="form-control"name="category_id" required>
                                                 <option>Select Category</option>
                                                 @foreach($catogeries as $cat)
                                                  <option value="{{ $cat->id }}">{{ $cat->name}}</option>
                                                 @endforeach
                                             </select>
                                        </div>
                                        <div class="mb-1">
                                             <label class="form-label" for="stage">Stage</label>
                                             <select type="text" id="stage" class="form-control"name="stage" required>
                                                 <option>Select Stage</option>
                                                 @foreach($stages as $stage)
                                                  <option value="{{ $stage["value"]}}">{{ $stage["text"]}}</option>
                                                 @endforeach
                                             </select>
                                         </div>
                                        <div class="mb-1">
                                           <label class="form-label" for="babank_idnk">Bank</label>
                                           <select type="text" id="bank_id" class="form-control"name="bank_id" required>
                                             <option>Select Bank</option>
                                             @foreach($Banks as $bank)
                                              <option value="{{ $bank->id }}">{{ $bank->bank_name}}</option>
                                             @endforeach
                                           </select>
                                        </div>
                                        <div class="mb-1">
                                             <label class="form-label" for="card_name">Card Name</label>
                                             <input type="text" id="card_name" class="form-control" placeholder="Enter Name..." name="card_name" required/>
                                        </div>
                                        <div class="mb-1">
                                         <label class="form-label" for="url">Url</label>
                                         <input type="text" id="url" class="form-control" placeholder="Enter Url..." name="url" required/>
                                        </div>
                                        <div class="input-group mb-3">
                                         <label class="input-group-text" for="inputGroupFile01">Image </label>
                                         <input type="file" class="form-control" name="image" id="inputGroupFile01">
                                       </div>
                                     </div>
                                   
                                 </div>
                              </div>
                              <div class="modal-footer">
                                 <button type="reset" class="btn btn-outline-success">Reset</button>
                                 <button type="submit" class="btn btn-primary" id="save">Save</button>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
                  <!--End Edit Modal -->
               </div>
    </div>
</section>
@endsection
@section('scripts')
<script>
$(document).ready(function() {
            $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ordering : false,
                ajax: "{{ route('bank_cards.index') }}",
                columns: [
                    {
                        data : 'id'
                    },
                    {
                        data: 'card_name'
                    },
                    {
                        // Actions
                        data: 'image',
                        render: function (data, type, full, meta) {
                            return (
                                '<img src="'+data+'" width="150" />'
                            );
                        }
                    },
                    {
                        data: '',
                        searchable: false
                    },
                ],
                "columnDefs": [
                    {
                        // Actions
                        targets: -1,
                        title: 'Actions',
                        render: function (data, type, full, meta) {
                            return (
                                '<a href="javascript:;" class="item-edit" onclick=edit('+full.id+')>' +
                                feather.icons['edit'].toSvg({ class: 'font-medium-4' }) +
                                '</a>'
                            );
                        }
                    },
                    {
                        "defaultContent": "-",
                        "targets": "_all"
                    }
                ],
                "order": [[0, 'asc']],
                dom: '<"card-header border-bottom p-1"<"head-label"><"dt-action-buttons text-end"B>><"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                displayLength: 10,
                lengthMenu: [10, 25, 50, 75, 100],
                buttons: [
                  {
                        extend: 'collection',
                        className: 'btn btn-outline-secondary dropdown-toggle me-2',
                        text: feather.icons['share'].toSvg({ class: 'font-small-4 me-50' }) + 'Export',
                        buttons: [
                            {
                            extend: 'print',
                            text: feather.icons['printer'].toSvg({ class: 'font-small-4 me-50' }) + 'Print',
                            className: 'dropdown-item',
                            exportOptions: { columns: [0,1] }
                            },
                            {
                            extend: 'csv',
                            text: feather.icons['file-text'].toSvg({ class: 'font-small-4 me-50' }) + 'Csv',
                            className: 'dropdown-item',
                            exportOptions: { columns: [0,1] }
                            },
                            {
                            extend: 'excel',
                            text: feather.icons['file'].toSvg({ class: 'font-small-4 me-50' }) + 'Excel',
                            className: 'dropdown-item',
                            exportOptions: { columns: [0,1] }
                            },
                            {
                            extend: 'pdf',
                            text: feather.icons['clipboard'].toSvg({ class: 'font-small-4 me-50' }) + 'Pdf',
                            className: 'dropdown-item',
                            exportOptions: { columns: [0,1] }
                            },
                            {
                            extend: 'copy',
                            text: feather.icons['copy'].toSvg({ class: 'font-small-4 me-50' }) + 'Copy',
                            className: 'dropdown-item',
                            exportOptions: { columns: [0,1] }
                            }
                        ],
                        init: function (api, node, config) {
                            $(node).removeClass('btn-secondary');
                            $(node).parent().removeClass('btn-group');
                            setTimeout(function () {
                            $(node).closest('.dt-buttons').removeClass('btn-group').addClass('d-inline-flex');
                            }, 50);
                        }
                    },
                    // {
                    //     text: feather.icons['settings'].toSvg({ class: 'me-50 font-small-4' }) + 'Permissions',
                    //     className: 'create-new btn btn-danger me-2',
                    //     action: function (e, dt, node, config)
                    //     {
                    //         window.location.href = '{{route("permissions.index")}}';
                    //     }
                    // },
                    // {
                    //     text: feather.icons['user'].toSvg({ class: 'me-50 font-small-4' }) + 'Users',
                    //     className: 'create-new btn btn-success me-2',
                    //     action: function (e, dt, node, config)
                    //     {
                    //         window.location.href = '{{route("users.index")}}';
                    //     }
                    // },
                    {
                        text: feather.icons['plus'].toSvg({ class: 'me-50 font-small-4' }) + 'Add Card',
                        className: 'create-new btn btn-primary',
                        attr: {
                            'data-bs-toggle': 'modal',
                            'data-bs-target': '#add_modal'
                        },
                        init: function (api, node, config) {
                            $(node).removeClass('btn-secondary');
                        }
                    }
                ],
                language: {
                    paginate: {
                    // remove previous & next text from pagination
                    previous: '&nbsp;',
                    next: '&nbsp;'
                    }
                }
            });
           $('div.head-label').html('<h6 class="mb-0">List of Cards</h6>');

            $("#add_form").submit(function (e) {
                e.preventDefault();
                $.ajax({
                    url: "{{route('bank_cards.store')}}",
                    type: "post",
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    responsive: true,
                    success: function (response) {
                        console.log(response);
                        if(response.errors){
                            $.each( response.errors, function( index, value ){
                                Toast.fire({
                                    icon: 'error',
                                    title: value
                                })
                            });
                        }
                        else if(response.error_message){
                            Toast.fire({
                                icon: 'error',
                                title: 'An error has been occured! Please Contact Administrator.'
                            })
                        }
                        else{
                            $('#add_form')[0].reset();
                            $("#add_modal").modal("hide");
                            $('#dataTable').DataTable().ajax.reload();
                            Toast.fire({
                                icon: 'success',
                                title: 'Permission has been Added Successfully!'
                            })
                        }
                        
                    }
                });
            });
            $("#edit_form").on("submit", function(e){
                e.preventDefault();
                $.ajax({
                    url: "{{url('bank_cards')}}" + "/" + rowid,
                    type: "post",
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        if(response.errors){
                            $.each(response.errors, function ( index, value ) {
                                Toast.fire({
                                    icon: 'error',
                                    title: value
                                })
                            });
                        }
                        else if(response.error_message) {
                            Toast.fire({
                                icon: 'error',
                                title: 'An error has been occured! Please Contact Administrator.'
                            })
                        }
                        else{
                            $("#edit_modal").modal("hide");
                            $("#dataTable").DataTable().ajax.reload();
                            Toast.fire({
                                icon: 'success',
                                title: 'Permission has been Updated Successfully!'
                            })
                        }
                    }
                });
            });
        });
        function edit(id) {
                rowid = id;
                $.ajax({
                    url: "{{url('bank_cards')}}" + "/" + id + "/edit",
                    type: "get",
                    success: function (response) {
                       $("#cat_id").val(response.cat_id);
                       $("#stage").val(response.stage);
                       $("#bank_id").val(response.bank_id);
                       $("#card_name").val(response.card_name);
                       $("#url").val(response.url);
                       $("#edit_modal").modal("show");
                    },
                });
            }
</script>
@endsection