@extends('Admin.layouts.master')
@section('title', 'Customers')
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
                            <h4 class="card-title">Customers</h4>
                        </div>
                        <div class="card-body">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                                    <li class="breadcrumb-item"><a href="#">Customers</a></li>

                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <!-- users list start -->
      <section class="app-user-list">

         <div class="card">
            <div class="card-datatable table-responsive pt-0">
               <table class="user-list-table table">
                  <thead class="table-light">
                     <tr>
                        <th></th>
                        <th>User</th>
                        <th>Email</th>
                        <th>Bio</th>
                        <th>Date Of Birth</th>
                        <th>Status</th>
                        <th>Actions</th>
                     </tr>
                  </thead>
               </table>
            </div>
            <!-- Modal to add new user starts-->
            <div class="modal-size-lg d-inline-block">
               <!--Add Modal -->
               <div class="modal fade text-start" id="add_modal" tabindex="-1" aria-labelledby="myModalLabel17" aria-hidden="true">
                  <div class="modal-dialog modal-md">
                     <div class="modal-content">
                        <div class="modal-header">
                           <h4 class="modal-title" id="myModalLabel17">Add Customers</h4>
                           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div  class="modal-body">
                           <!-- Horizontal Wizard -->
                           <section class="horizontal-wizard">
                              <div id="horizontal-wizard-example" class="bs-stepper horizontal-wizard-example">
                                 <div class="bs-stepper-header" role="tablist">
                                    <div class="step" data-target="#account-details" role="tab" id="account-details-trigger">
                                       <button type="button" class="step-trigger">
                                       <span class="bs-stepper-box">1</span>
                                       <span class="bs-stepper-label">
                                       <span class="bs-stepper-title">Account Details</span>
                                       <span class="bs-stepper-subtitle">Setup Account Details</span>
                                       </span>
                                       </button>
                                    </div>
                                    <div class="line">
                                       <i data-feather="chevron-right" class="font-medium-2"></i>
                                    </div>
                                    <div class="step" data-target="#personal-info" role="tab" id="personal-info-trigger">
                                       <button type="button" class="step-trigger">
                                       <span class="bs-stepper-box">2</span>
                                       <span class="bs-stepper-label">
                                       <span class="bs-stepper-title">Personal Info</span>
                                       <span class="bs-stepper-subtitle">Add Personal Info</span>
                                       </span>
                                       </button>
                                    </div>
                                    <div class="line">
                                       <i data-feather="chevron-right" class="font-medium-2"></i>
                                    </div>
                                    <div class="step" data-target="#address-step" role="tab" id="address-step-trigger">
                                       <button type="button" class="step-trigger">
                                       <span class="bs-stepper-box">3</span>
                                       <span class="bs-stepper-label">
                                       <span class="bs-stepper-title">Address</span>
                                       <span class="bs-stepper-subtitle">Add Address</span>
                                       </span>
                                       </button>
                                    </div>
                                    <div class="line">
                                       <i data-feather="chevron-right" class="font-medium-2"></i>
                                    </div>
                                    <div class="step" data-target="#social-links" role="tab" id="social-links-trigger">
                                       <button type="button" class="step-trigger">
                                       <span class="bs-stepper-box">4</span>
                                       <span class="bs-stepper-label">
                                       <span class="bs-stepper-title">Social Links</span>
                                       <span class="bs-stepper-subtitle">Add Social Links</span>
                                       </span>
                                       </button>
                                    </div>
                                 </div>
                                 <div class="bs-stepper-content">
                                    <div id="account-details" class="content" role="tabpanel" aria-labelledby="account-details-trigger">
                                       <div class="content-header">
                                          <h5 class="mb-0">Account Details</h5>
                                          <small class="text-muted">Enter Your Account Details.</small>
                                       </div>
                                       <form class="add_customer">
                                       @csrf
                                       @method('POST')
                                          <div class="row">
                                             <div class="mb-1 col-md-6">
                                                <label class="form-label" for="username">Username</label>
                                                <input type="text" name="username" id="username" class="form-control" placeholder="johndoe" />
                                             </div>
                                             <div class="mb-1 col-md-6">
                                                <label class="form-label" for="email">Email</label>
                                                <input type="email" name="email" id="email" class="form-control" placeholder="john.doe@email.com" aria-label="john.doe" />
                                             </div>
                                          </div>
                                          <div class="row">

                                             <div class="mb-1   col-md-6">
                                                <label class="form-label" for="password">Password</label>
                                                <input type="password" name="password" id="password" class="form-control " placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                                            </div>
                                             <div class="mb-1 form-password-toggle col-md-6">
                                                <label class="form-label" for="confirm-password">Confirm Password</label>
                                                <input type="password" name="confirmpassword" id="confirm-password" class="form-control" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                                             </div>
                                          </div>
                                          <div  style=" margin: 0 10px 10px 0; " class="form-check form-check-primary">
                                                <input  type="checkbox" class="form-check-input" id="showPassword">
                                                <label class="form-check-label" for="showPassword">Show Password</label>
                                            </div>

                                       </form>
                                       <div class="d-flex justify-content-between">
                                          <button class="btn btn-outline-secondary btn-prev" disabled>
                                          <i data-feather="arrow-left" class="align-middle me-sm-25 me-0"></i>
                                          <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                          </button>
                                          <button class="btn btn-primary btn-next">
                                          <span class="align-middle d-sm-inline-block d-none">Next</span>
                                          <i data-feather="arrow-right" class="align-middle ms-sm-25 ms-0"></i>
                                          </button>
                                       </div>
                                    </div>
                                    <div id="personal-info" class="content" role="tabpanel" aria-labelledby="personal-info-trigger">
                                       <div class="content-header">
                                          <h5 class="mb-0">Personal Info</h5>
                                          <small>Enter Your Personal Info.</small>
                                       </div>
                                       <form class="add_customer">
                                       @csrf
                                       @method('POST')
                                          <div class="row">
                                             <div class="mb-1 col-md-6">
                                                <label class="form-label" for="name">Full Name</label>
                                                <input type="text" name="name" id="name" class="form-control" placeholder="John Doe" />
                                             </div>
                                             <div class="mb-1 col-md-6" id="flatpickr">
                                                <label class="form-label" for="dob">Date Of Birth</label>
                                                <input type="text" id="dob" name="dob" class="form-control flatpickr-basic" placeholder="DD-MM-YYYY" />
                                             </div>
                                          </div>
                                          <div class="row">
                                             <div class="mb-1 col-md-6">
                                                <label class="form-label" for="profileImage">Profile Image</label>
                                                <input class="form-control" name="profileImage" type="file" id="profileImage" name="customFile">
                                             </div>
                                             <div class="mb-1 col-md-6">
                                                <label class="form-label" for="phone-number">Phone Number</label>
                                                <div class="input-group input-group-merge">
                                                   <span class="input-group-text">US (+1)</span>
                                                   <input type="text" name="phoneNumber" class="form-control phone-number-mask" placeholder="1 234 567 8900" id="phone-number" />
                                                </div>
                                             </div>
                                          </div>
                                          <div class="row">
                                             <div class="mb-1">
                                                <label class="d-block form-label mb-1">Gender</label>
                                                <div class="form-check form-check-inline">
                                                   <input type="radio"  value="male" name="gender" class="form-check-input" />
                                                   <label class="form-check-label" for="male">Male</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                   <input type="radio"  name="gender" value="female" class="form-check-input" checked />
                                                   <label class="form-check-label" for="female">Female</label>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="row">
                                             <div class="col-12">
                                                <div class="mb-1">
                                                   <label class="form-label" for="bio">Bio</label>
                                                   <textarea class="form-control" id="bio" name="bio"  rows="4" placeholder="Your Bio data here..."></textarea>
                                                </div>
                                             </div>
                                          </div>
                                       </form>
                                       <div class="d-flex justify-content-between">
                                          <button class="btn btn-primary btn-prev">
                                          <i data-feather="arrow-left" class="align-middle me-sm-25 me-0"></i>
                                          <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                          </button>
                                          <button class="btn btn-primary btn-next">
                                          <span class="align-middle d-sm-inline-block d-none">Next</span>
                                          <i data-feather="arrow-right" class="align-middle ms-sm-25 ms-0"></i>
                                          </button>
                                       </div>
                                    </div>
                                    <div id="address-step" class="content" role="tabpanel" aria-labelledby="address-step-trigger">
                                       <div class="content-header">
                                          <h5 class="mb-0">Address</h5>
                                          <small>Enter Your Address.</small>
                                       </div>
                                       <form class="add_customer">
                                       @csrf
                                       @method('POST')
                                          <div class="row">
                                             <div class="mb-1 col-md-6">
                                                <label class="form-label" for="country">Country</label>
                                                <select class="select2 w-100" name="country" id="country">
                                                   <option label=" "></option>
                                                   <option value="UK">UK</option>
                                                   <option value="USA">USA</option>
                                                   <option value="Spain">Spain</option>
                                                   <option value="France">France</option>
                                                   <option value="Italy">Italy</option>
                                                   <option value="Austrailia">Australia</option>
                                                </select>
                                             </div>
                                             <div class="mb-1 col-md-6">
                                                <label class="form-label" for="city">City</label>
                                                <input type="text" id="city" name="city" class="form-control" placeholder="Birmingham" />
                                             </div>
                                          </div>
                                          <div class="row">
                                             <div class="mb-1 col-md-6">
                                                <label class="form-label" for="pincode">Pincode</label>
                                                <input type="text" id="pincode" name="pincode" class="form-control" placeholder="658921" />
                                             </div>
                                          </div>
                                          <div class="row">
                                             <div class="mb-1 col-md-12">
                                                <label class="form-label" for="address">Address</label>
                                                <textarea class="form-control" id="address" name="address" rows="4" placeholder="Enter Your Address Here..."></textarea>
                                             </div>
                                          </div>
                                       </form>
                                       <div class="d-flex justify-content-between">
                                          <button class="btn btn-primary btn-prev">
                                          <i data-feather="arrow-left" class="align-middle me-sm-25 me-0"></i>
                                          <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                          </button>
                                          <button class="btn btn-primary btn-next">
                                          <span class="align-middle d-sm-inline-block d-none">Next</span>
                                          <i data-feather="arrow-right" class="align-middle ms-sm-25 ms-0"></i>
                                          </button>
                                       </div>
                                    </div>
                                    <div id="social-links" class="content" role="tabpanel" aria-labelledby="social-links-trigger">
                                       <div class="content-header">
                                          <h5 class="mb-0">Social Links</h5>
                                          <small>Enter Your Social Links.</small>
                                       </div>
                                       <form class="add_customer">
                                       @csrf
                                       @method('POST')
                                          <div class="row">
                                             <div class="mb-1 col-md-6">
                                                <label class="form-label" for="twitter">Twitter</label>
                                                <input type="text" id="twitter" name="twitter" class="form-control" placeholder="https://twitter.com/abc" />
                                             </div>
                                             <div class="mb-1 col-md-6">
                                                <label class="form-label" for="facebook">Facebook</label>
                                                <input type="text" id="facebook" name="facebook" class="form-control" placeholder="https://facebook.com/abc" />
                                             </div>
                                          </div>
                                          <div class="row">
                                             <div class="mb-1 col-md-6">
                                                <label class="form-label" for="google">Google+</label>
                                                <input type="text" id="google" name="google" class="form-control" placeholder="https://plus.google.com/abc" />
                                             </div>
                                             <div class="mb-1 col-md-6">
                                                <label class="form-label" for="linkedin">Linkedin</label>
                                                <input type="text" id="linkedin" name="linkedin" class="form-control" placeholder="https://linkedin.com/abc" />
                                             </div>
                                          </div>
                                       </form>
                                       <div class="d-flex justify-content-between">
                                          <button class="btn btn-primary btn-prev">
                                          <i data-feather="arrow-left" class="align-middle me-sm-25 me-0"></i>
                                          <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                          </button>
                                          <button class="btn btn-success btn-submit">Submit</button>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </section>
                           <!-- /Horizontal Wizard -->
                        </div>
                     </div>
                  </div>
               </div>
               <!--End Add Modal -->

            </div>
            <!-- Modal to add new user Ends-->
         </div>
         <!-- list section end -->
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


<script>
     $('#dob').flatpickr({
        dateFormat: "d-m-Y",
        maxDate: "today",
    });
    function delete_customer(id) {
    if (confirm("Are You sure want to Delete !")) {
        $.ajax({
            url: "customers/" + id,
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
                        title: "Customers is successfully deleted !"
                    })
                }
            }
        });
    }
}
 $(function() {
    'use strict';

    var bsStepper = document.querySelectorAll('.bs-stepper'),
        select = $('.select2'),
        horizontalWizard = document.querySelector('.horizontal-wizard-example'),
        verticalWizard = document.querySelector('.vertical-wizard-example'),
        modernWizard = document.querySelector('.modern-wizard-example'),
        modernVerticalWizard = document.querySelector('.modern-vertical-wizard-example');

    // Adds crossed class
    if (typeof bsStepper !== undefined && bsStepper !== null) {
        for (var el = 0; el < bsStepper.length; ++el) {
            bsStepper[el].addEventListener('show.bs-stepper', function(event) {
                var index = event.detail.indexStep;
                var numberOfSteps = $(event.target).find('.step').length - 1;
                var line = $(event.target).find('.step');



                for (var i = 0; i < index; i++) {
                    line[i].classList.add('crossed');

                    for (var j = index; j < numberOfSteps; j++) {
                        line[j].classList.remove('crossed');
                    }
                }
                if (event.detail.to == 0) {
                    for (var k = index; k < numberOfSteps; k++) {
                        line[k].classList.remove('crossed');
                    }
                    line[0].classList.remove('crossed');
                }
            });
        }
    }

    // select2
    select.each(function() {
        var $this = $(this);
        $this.wrap('<div class="position-relative"></div>');
        $this.select2({
            placeholder: 'Select value',
            dropdownParent: $this.parent()
        });
    });

    // Horizontal Wizard
    // --------------------------------------------------------------------
    if (typeof horizontalWizard !== undefined && horizontalWizard !== null) {
        var numberedStepper = new Stepper(horizontalWizard),
            $form = $(horizontalWizard).find('form');
        $form.each(function() {
            var $this = $(this);
            $this.validate({
                rules: {
                    username: {
                        required: true
                    },
                    email: {
                        required: true
                    },
                    password: {
                        required: true
                    },
                    'confirm-password': {
                        required: true,
                        equalTo: '#password'
                    },
                    name: {
                        required: true
                    },
                    'dob': {
                        required: false
                    },

                    'phone-number': {
                        required: false
                    },
                    bio: {
                        required: false
                    },
                    address: {
                        required: false
                    },
                    country: {
                        required: false
                    },
                    city: {
                        required: false
                    },
                    pincode: {
                        required: false
                    },

                    twitter: {
                        required: false,
                        url: true
                    },
                    facebook: {
                        required: false,
                        url: true
                    },
                    google: {
                        required: false,
                        url: true
                    },
                    linkedin: {
                        required: false,
                        url: true
                    }
                }
            });
        });

        $(horizontalWizard)
            .find('.btn-next')
            .each(function() {
                $(this).on('click', function(e) {
                    var isValid = $(this).parent().siblings('form').valid();
                    if (isValid) {
                        numberedStepper.next();
                    } else {
                        e.preventDefault();
                    }
                });
            });

        $(horizontalWizard)
            .find('.btn-prev')
            .on('click', function() {
                numberedStepper.previous();
            });

        $(horizontalWizard)
            .find('.btn-submit')
            .on('click', function() {
                var isValid = $(this).parent().siblings('form').valid();
                if (isValid) {
                    var {
                        username,
                        email,
                        password,
                        confirmpassword,
                        name,
                        dob,
                        phoneNumber,
                        gender,
                        phoneNumber,
                        bio,
                        address,
                        country,
                        city,
                        pincode,
                        twitter,
                        facebook,
                        google,
                        linkedin
                    } = $form.serializeArray().reduce(function(obj, item) {
                        obj[item.name] = item.value;
                        console.log(item);
                        return obj;
                    }, {});
                    var profileImage = $('#profileImage')[0].files;
                    console.log(profileImage);
                    var form = new FormData();
                    form.append("username", username);
                    form.append("email", email);
                    form.append("password", password);
                    form.append("confirmPassword",  confirmpassword);
                    form.append("dob", dob);
                    form.append("phoneNumber", phoneNumber);
                    form.append("name", name);
                    form.append("gender", gender);
                    form.append("address", address);
                    form.append("country", country);
                    form.append("city", city);
                    form.append(" pincode", pincode);
                    form.append("twitter", twitter);
                    form.append("facebook", facebook);
                    form.append("google", google);
                    form.append("linkedin", linkedin);
                    form.append("bio", bio);
                    form.append("profileImage", profileImage[0])
                    console.log(form);
                    var settings = {
                        "async": true,
                        url: "{{ url('customers') }}",
                        "method": "POST",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        "processData": false,
                        "contentType": false,
                        responsive: true,
                        data: form,
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
                            for(var i = 0; i < 4; i++){
                                $('.add_customer')[i].reset();
                            }
                            $("#add_modal").modal("hide");
                            $('.user-list-table').DataTable().ajax.reload();
                            Toast.fire({
                                icon: 'success',
                                title: 'Customers is sucessfully Added!'
                            })
                        }



                    });
                }
            });
    }



    // Modern Wizard
    // --------------------------------------------------------------------
    if (typeof modernWizard !== undefined && modernWizard !== null) {
        var modernStepper = new Stepper(modernWizard, {
            linear: false
        });
        $(modernWizard)
            .find('.btn-next')
            .on('click', function() {
                modernStepper.next();
            });
        $(modernWizard)
            .find('.btn-prev')
            .on('click', function() {
                modernStepper.previous();
            });

        $(modernWizard)
            .find('.btn-submit')
            .on('click', function() {
                alert('Submitted..!!');
            });
    }

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
console.log(assetPath);
    if (dtUserTable.length) {
        dtUserTable.DataTable({

            processing: true,
            serverSide: true,
            responsive: true,
            ordering: false,
            ajax: "{{ route('customers.index') }}",
            columns: [
                // columns according to JSON
                {
                    data: 'responsive_id'
                },
                {
                    data: 'name'
                },
                {
                    data: 'email'
                },
                {
                    data: ''
                },
                {
                    data: ''
                },
                {
                    data: 'is_active'
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
                        var $name = full['name'],
                            $uname = full['username'],
                            $image = full['profile_image'];
                        if ($image) {
                            // For Avatar image
                            var $output =
                                '<img src="' + assetPath + 'images/profile/user-upload/' + $image + '" alt="Avatar" height="32" width="32">';
                        } else {
                            // For Avatar badge
                            var stateNum = Math.floor(Math.random() * 6) + 1;
                            var states = ['success', 'danger', 'warning', 'info', 'dark', 'primary', 'secondary'];
                            var $state = states[stateNum],
                                $name = full['name'],
                                $initials = $name.match(/\b\w/g) || [];
                            $initials = (($initials.shift() || '') + ($initials.pop() || '')).toUpperCase();
                            $output = '<span class="avatar-content">' + $initials + '</span>';
                        }
                        var colorClass = $image === '' ? ' bg-light-' + $state + ' ' : '';
                        // Creates full output for row
                        var $row_output =
                            '<div class="d-flex justify-content-left align-items-center">' +
                            '<div class="avatar-wrapper">' +
                            '<div class="avatar ' +
                            colorClass +
                            ' me-1">' +
                            $output +
                            '</div>' +
                            '</div>' +
                            '<div class="d-flex flex-column">' +
                            '<a href="customers/'+full['id']+'" class="user_name text-truncate"><span class="fw-bold">' +
                            $name +
                            '</span></a>' +
                            '<small class="emp_post text-muted">@' +
                            $uname +
                            '</small>' +
                            '</div>' +
                            '</div>';
                        return $row_output;
                    }
                },
                {
                    // Refferals
                    targets: 3,
                    render: function(data, type, full, meta) {
                        var $bio = full['bio'];
                        if($bio != '' && $bio != null){
                            if( $bio.length > 30){
                                var $output = '<p>' + $bio.substring(0, 30) + '...</p>';
                            }
                            else{
                                if($bio.length === 0){
                                    var $output = '----';
                                }
                                else{
                                    var $output = '<p>' + $bio + '</p>';
                                }

                            }

                        } else{
                            var $output = '----';
                        }

                         return (
                            $output
                        );
                    }
                },
                {
                    // Date of Birth
                    targets: 4,
                    render: function(data, type, full, meta) {
                        var $dob = full['date_of_birth'];
                        if ($dob) {
                            var $output = $dob;
                        } else {
                            var $output = '----';
                        }
                        return (
                            $output
                        );
                    }
                },

                {
                    // User Status
                    targets: 5,
                    render: function(data, type, full, meta) {
                        var $status = full['is_active'];

                        return (
                            '<span class="badge rounded-pill ' +
                            statusObj[$status].class +
                            '" text-capitalized>' +
                            statusObj[$status].title +
                            '</span>'
                        );
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
                            '<a class="btn btn-sm dropdown-toggle hide-arrow" data-bs-toggle="dropdown">' +
                            feather.icons['more-vertical'].toSvg({
                                class: 'font-small-4'
                            }) +
                            '</a>' +
                            '<div class="dropdown-menu dropdown-menu-end">' +
                            '<a href="/customers/'+full['id']+'" class="dropdown-item">' +
                            feather.icons['file-text'].toSvg({
                                class: 'font-small-4 me-50'
                            }) +
                            'Details</a>' +
                            '<a href="/customers/'+full['id']+'/edit" class="dropdown-item">' +
                            feather.icons['archive'].toSvg({
                                class: 'font-small-4 me-50'
                            }) +
                            'Edit</a>' +
                            '<a href="javascript:;" onClick="delete_customer('+full['id']+')" class="dropdown-item delete-record">' +
                            feather.icons['trash-2'].toSvg({
                                class: 'font-small-4 me-50'
                            }) +
                            'Delete</a></div>' +
                            '</div>' +
                            '</div>'
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
            buttons: [{
                text: 'Add New User',
                className: 'add-new btn btn-primary mt-50',
                attr: {
                    'data-bs-toggle': 'modal',
                    'data-bs-target': '#add_modal'
                },
                init: function(api, node, config) {
                    $(node).removeClass('btn-secondary');
                }
            }],
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
    $('div.head-label').html('<h6 class="mb-0">List of Roles</h6>');


});

$('#showpassword').click(function() {
    var $password = $('#password');
    var $password_confirmation = $('#confirm-password');
    if ($password.attr('type') == 'password') {
        $password.attr('type', 'text');
        $password_confirmation.attr('type', 'text');

    } else {
        $password.attr('type', 'password');
        $password_confirmation.attr('type', 'password');

    }
});

</script>

<!-- <script src="../../../app-assets/js/scripts/forms/form-wizard.js"></script> -->
@endsection

