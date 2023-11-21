@extends('Admin.layouts.master')
@section('title', 'Products')
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
   #bs-stepper{
   box-shadow:none !important;
   }
    #product_link-error {
    position: absolute;
    bottom: -22px;
   }
</style>
@endsection
@section('content')
<div class="content-wrapper container-xxl p-0">
   <div class="content-header row">
   </div>
   <div class="content-body">
   <section id="default-breadcrumb">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Products</h4>
                        </div>
                        <div class="card-body">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                                    <li class="breadcrumb-item"><a href="#">Products</a></li>

                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </section>
      <div class="card">
         <div class="card-body">
            <form class="form-validate ">
               @csrf
               <div class="row mt-1">
                  <div class="col-12">
                     <h4 class="mb-1">
                        <i data-feather="codesandbox" class="font-medium-4 me-25"></i>
                        <span class="align-middle">Product Information</span>
                     </h4>
                  </div>
                  <div class="col-lg-4 col-md-6">
                     <div class="mb-1">
                        <label class="form-label"  for="Url">Url</label>
                        {{-- <div class="input-group form-password-toggle input-group-merge">
                            <input type="url" id="product_link" class="form-control" name="Url" placeholder="https://www.xyz.com" required />
                            <div class="input-group-text cursor-pointer" style="padding: 0px 8px ;">
                                <button class="btn btn-primary p-0" id="product_link_viewer" style="padding:6px 15px !important;" >
                                <i data-feather="link" class="font-medium-4 me-25"></i>
                                </button>
                            </div>
                        </div> --}}
                        <div class="input-group">
                            <input type="url" class="form-control"  id="product_link" placeholder="https://www.xyz.com" name="Url" aria-describedby="button-addon2" required/>
                            <button class="btn btn-outline-primary"  id="product_link_viewer" type="button"><i data-feather="link" class="font-medium-4 me-25"></i></button>
                        </div>
                        </div> 
                  </div>
                  <div class="col-lg-4 col-md-6">
                     <div class="mb-1">
                        <label class="form-label" for="catagory">Catagory</label>
                        <select class="select2 w-100" name="catagory" id="catagory">
                            <option value="">Select Catagory</option>
                            @foreach($Categories as $Category)
                            <option value="{{$Category->id}}">{{$Category->name}}</option>
                            @endforeach
                        </select>
                     </div>
                  </div>
                  <div class="col-lg-4 col-md-6">
                        <div class="mb-1">
                            <label class="form-label"  for="scheduled">Scheduled date</label>
                            <input id="scheduled" type="text"  class="form-control scheduled-picker" name="scheduled_date" placeholder="DD-MM-YYYY" />
                        </div>
                    </div>
                  <div class="col-lg-4 col-md-4 mt-1">
                        <div class="form-check form-check-primary">
                                <input type="checkbox" class="form-check-input " id="announcements" >
                                <label class="form-check-label" for="announcements">Add Announcements</label>
                        </div>
                  </div> 
                  <div class="col-lg-4 col-md-4  mt-1">
                        <div class="form-check form-check-primary">
                                <input type="checkbox" class="form-check-input " id="is_editor_choice" >
                                <label class="form-check-label" for="is_editor_choice">Editor Choice</label>
                        </div>
                  </div>

                  <div class="col-12 d-flex flex-sm-row flex-column mt-2">
                     <button id="btn-submit" class="btn btn-primary mb-1 mb-sm-0 me-0 me-sm-1 saveChanges">Add Product</button>
                     <button type="reset" class="btn btn-outline-secondary">Reset</button>
                  </div>
               </div>
            </form>
         </div>

      </div>
      <div class="row ">
        <div class="col-lg-4" ></div>
        <div class="col-md-12 col-lg-4">
                <div class="spinner-border" id="show_loader"  style="display: none;width: 7rem; margin: 29%; height: 7rem;" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <div class="card" id="show_product" style="display: none;" >
                    <img class="card-img-top" id="product_image" style=" background: #1c1b1b; " alt="Card image cap" />
                    <div class="card-body">
                        <h4 class="card-title" id="product_title">Card title</h4>
                        <p class="card-text"id="product_description" >
                        </p>
                        <a href="#" id="product_redirect" target="_blank" class="btn btn-outline-primary">Visit Website</a>
                    </div>
                </div>
            </div>
         </div>
   </div>
</div>
@endsection

@section('scripts')
    <!-- BEGIN: Vendor JS-->
    <script src="../../../app-assets/vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="../../../app-assets/vendors/js/forms/select/select2.full.min.js"></script>
    <script src="../../../app-assets/vendors/js/forms/validation/jquery.validate.min.js"></script>
    <script src="../../../app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../../../app-assets/js/core/app-menu.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="../../../app-assets/js/scripts/pages/app-user-edit.js"></script>
    <script src="../../../app-assets/js/scripts/components/components-navs.js"></script>
    <!-- END: Page JS-->

<script>

$(document).ready(()=>{
    $('.scheduled-picker').flatpickr({
        dateFormat: "d-m-Y",
        minDate: "today",

    });
$("#product_link_viewer").on('click',async function(e) {
    $('#show_product').hide();
    $('#show_loader').show();
    await scrapURL();   
});
  
    $('#btn-submit').click(async ()=>{

        $('#show_loader').show();
        $('#show_product').hide();
        await scrapURL();
         var formData = new FormData();
        catagory = $('#catagory').val();
       
        formData.append('catagory',catagory);
        console.log($('#product_link').val())
        formData.append('link',$('#product_link').val());
        formData.append('scheduled_date',$('#scheduled').val());
        console.log($('#scheduled').val())
        formData.append('announcements',$('#announcements').is(':checked'));
        formData.append('is_editor_choice',$('#is_editor_choice').is(':checked'));
        $product_image = $('#product_image').attr('src');
        if($product_image){
            formData.append('product_image', $product_image);
            console.log($product_image)
        }
        var product_title = $('#product_title').text();
        if(product_title){
            formData.append('product_title',product_title);
            console.log(product_title)
        }
        var product_description = $('#product_description').text();
        if(product_description){
            formData.append('product_description',product_description);
            console.log(product_description)
        }

        console.log(formData);

        var settings = {
                "async": true,
                url: "{{ url('/products') }}",
                "method": "post",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                "processData": false,
                "contentType": false,
                responsive: true,
                data: formData,

                }
            $.ajax(settings).done(function(response) {
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
                        title: response.error_message
                    })
                }
                else{
                   console.log("success");
                    window.location.replace('/products');
                    //sub str the length of description

                }
            });

    });
});
async function scrapURL() {
    console.log('enter pressed');
        console.log( $('#product_link').val());
        var url = $('#product_link').val();
        var scrapForm = new FormData();
        scrapForm.append("url", url );
        var settings = {
                "async": true,
                url: "{{ url('/scrapUrlData') }}",
                "method": "post",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                "processData": false,
                "contentType": false,
                responsive: true,
                data: scrapForm,

                }
           await $.ajax(settings).done(function(response) {
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
                        title: response.error_message
                    })
                }
                else{
                    $('#show_loader').hide();
                    $('#show_product').show();
                    //sub str the length of description
                    var description = response.data.description;
                    if(description.length > 200){
                        description = description.substr(0,200);
                    }
                    description = description + "...";
                    $('#product_image').attr('src',response.data.image);
                    $('#product_title').text(response.data.title);
                    $('#product_description').text(response.data.description);
                    $('#product_redirect').attr('href',response.data.url);
                }

            });
}
</script>

@endsection
