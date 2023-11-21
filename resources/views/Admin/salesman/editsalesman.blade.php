@extends('Admin.layouts.master')
@section('title', 'Salesmen')
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
<div class="content-wrapper container-xxl p-0">
    <div class="content-header row">
    </div>
    <div class="content-body">
        <!-- users edit start -->
        <section class="app-user-edit">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-pills" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center active" id="account-tab" data-bs-toggle="tab" href="#account" aria-controls="account" role="tab" aria-selected="true">
                                <i data-feather="user"></i><span class="d-none d-sm-block">Account</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center" id="information-tab" data-bs-toggle="tab" href="#information" aria-controls="information" role="tab" aria-selected="false">
                                <i data-feather="info"></i><span class="d-none d-sm-block">Information</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center" id="social-tab" data-bs-toggle="tab" href="#social" aria-controls="social" role="tab" aria-selected="false">
                                <i data-feather="share-2"></i><span class="d-none d-sm-block">Social</span>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content" id="edit_form_submit">
                        <!-- Account Tab starts -->
                        <div class="tab-pane active" id="account" aria-labelledby="account-tab" role="tabpanel">
                            <!-- users edit start -->
                            <div class="d-flex mb-2">
                                <img src="{{ asset('images/profile/user-upload/'.$data->profile_image) }}" id="profileimage" alt="users avatar" class="user-avatar users-avatar-shadow rounded me-2 my-25 cursor-pointer" height="90" width="90" />
                                <div class="mt-50">
                                    <h4>{{ $data->name; }} </h4>
                                    <div class="col-12 d-flex mt-1 px-0">
                                        <label class="btn btn-primary me-75 mb-0" for="changePicture">
                                            <span class="d-none d-sm-block">Change</span>
                                            <input class="form-control" type="file" id="changePicture" name="profileimage" hidden accept="image/png, image/jpeg, image/jpg" />
                                            <span class="d-block d-sm-none">
                                                <i class="me-0" data-feather="edit"></i>
                                            </span>
                                        </label>
                                        <button id="removeImage" class="btn btn-outline-secondary d-none d-sm-block">Remove</button>
                                        <button class="btn btn-outline-secondary d-block d-sm-none">
                                            <i class="me-0" data-feather="trash-2"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!-- users edit ends -->
                            <!-- users edit account form start -->
                            <form class="form-validate updatesalesman">
                            @method("PUT")
                                @csrf
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-1">
                                            <label class="form-label" for="username">Username</label>
                                            <input type="text" class="form-control" placeholder="Username" value="{{ $data->username }}" name="username" id="username" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-1">
                                            <label class="form-label" for="name">Name</label>
                                            <input type="text" class="form-control" placeholder="Name" value="{{ $data->name }}" name="name" id="name" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-1">
                                            <label class="form-label" for="email">E-mail</label>
                                            <input type="email" class="form-control" placeholder="Email" value="{{ $data->email}}" name="email" id="email" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-1">
                                            <label class="form-label" for="status">Status</label>
                                            <select class="form-select" name="isactive" id="status">
                                                <option value="0" {{ ($data->is_active == "0")?"selected":''  }}>InActive</option>
                                                <option value="1" {{ ($data->is_active == "1")?"selected":''  }} >Active</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-1">
                                            <label class="form-label" for="role">Role</label>
                                            <select class="form-select" id="role">
                                                <option value="salesman">Salesman</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-12 d-flex flex-sm-row flex-column mt-2">
                                        <button  class="btn btn-primary mb-1 mb-sm-0 me-0 me-sm-1 saveChanges">Save Changes</button>
                                        <button type="reset" class="btn btn-outline-secondary">Reset</button>
                                    </div>
                                </div>
                            </form>
                            <!-- users edit account form ends -->
                        </div>
                        <!-- Account Tab ends -->

                        <!-- Information Tab starts -->
                        <div class="tab-pane" id="information" aria-labelledby="information-tab" role="tabpanel">
                            <!-- users edit Info form start -->
                            <form class="form-validate updatesalesman">
                            @method("PUT")
                            @csrf
                                <div class="row mt-1">
                                    <div class="col-12">
                                        <h4 class="mb-1">
                                            <i data-feather="user" class="font-medium-4 me-25"></i>
                                            <span class="align-middle">Personal Information</span>
                                        </h4>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="mb-1">
                                            <label class="form-label"  for="birthdatex">Birth date</label>
                                            echo
                                            <input id="birthdatex" type="text" value="<?= isset($data->date_of_birth)?(date('d-m-Y', strtotime($data->date_of_birth))):''  ?>" class="form-control birthdate-picker" name="dob" placeholder="DD-MM-YYYY" />
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="mb-1">
                                            <label class="form-label" for="mobile">Mobile</label>
                                            <div class="input-group input-group-merge">
                                                   <span class="input-group-text">US (+1)</span>
                                            <input id="mobile" type="text" class="form-control" value="{{ isset($data->phone_no)?$data->phone_no:'' ; }}" name="phoneNumber" />
                                        </div>
                                        </div>
                                    </div>


                                    <div class="col-lg-4 col-md-6">
                                        <div class="mb-1">
                                            <label class="d-block form-label mb-1">Gender</label>
                                            <div class="form-check form-check-inline">
                                                <input type="radio" id="male"   name="gender" value="male" class="form-check-input" />
                                                <label class="form-check-label" for="male">Male</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input type="radio" id="female" value="female" name="gender"  class="form-check-input"  {{ ($data->gender == "male" )?'checked':"" }} />
                                                <label class="form-check-label" for="female">Female</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">

                                        <div class="col-lg-12 col-md-12">
                                        <label class="d-block form-label mb-1">Bio</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" name="bio" rows="3" placeholder="Bio"> {{ isset($data->bio)?$data->bio:'' }}
                                            </textarea>
                                        </div>

                                    </div>
                                    <div class="col-12">
                                        <h4 class="mb-1 mt-2">
                                            <i data-feather="map-pin" class="font-medium-4 me-25"></i>
                                            <span class="align-middle">Address</span>
                                        </h4>
                                    </div>
                                    <div class="col-lg-8 col-md-6">
                                        <div class="mb-1">
                                            <label class="form-label" for="address-1">Address </label>
                                            <input id="address-1"  type="text" class="form-control" value="{{ isset($data->address)?$data->address:''}}" name="address" />
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-6">
                                        <div class="mb-1">
                                            <label class="form-label" for="pincode">Postcode</label>
                                            <input id="pincode" type="text" value="{{ isset($data->postal_code)?$data->postal_code:''}}" class="form-control" placeholder="597626" name="pincode" />
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="mb-1">
                                            <label class="form-label" for="city">City</label>
                                            <input id="city" type="text" class="form-control" value="{{ isset($data->city)?$data->city:'' }}" name="city" />
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-6">
                                        <div class="mb-1">
                                            <label class="form-label" for="country">Country</label>
                                            <select class="select2 w-100" name="country" id="country">
                                                   <option label=" "></option>
                                                   <option {{ (isset($data->country) && ($data->country !="") &&  ($data->country == "UK") )?"selected":"" }} value="UK">UK</option>
                                                   <option {{ (isset($data->country) && ($data->country !="") &&  ($data->country == "USA") )?"selected":"" }} value="USA">USA</option>
                                                   <option {{ (isset($data->country) && ($data->country !="") &&  ($data->country == "Spain") )?"selected":"" }} value="Spain">Spain</option>
                                                   <option {{ (isset($data->country) && ($data->country !="") &&  ($data->country == "France") )?"selected":"" }} value="France">France</option>
                                                   <option {{ (isset($data->country) && ($data->country !="") &&  ($data->country == "Italy") )?"selected":"" }} value="Italy">Italy</option>
                                                   <option {{ (isset($data->country) && ($data->country !="") &&  ($data->country == "Austrailia") )?"selected":"" }} value="Austrailia">Australia</option>
                                                </select>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex flex-sm-row flex-column mt-2">
                                        <button class="btn btn-primary mb-1 mb-sm-0 me-0 me-sm-1 saveChanges">Save Changes</button>
                                        <button type="reset" class="btn btn-outline-secondary">Reset</button>
                                    </div>
                                </div>
                            </form>
                            <!-- users edit Info form ends -->
                        </div>
                        <!-- Information Tab ends -->

                        <!-- Social Tab starts -->
                        <div class="tab-pane" id="social" aria-labelledby="social-tab" role="tabpanel">
                            <!-- users edit social form start -->
                            <form class="form-validate updatesalesman">
                                @method("PUT")
                                 @csrf
                                <div class="row">
                                    <div class="col-lg-4 col-md-6 mb-1">
                                        <label class="form-label" for="twitter-input">Twitter</label>
                                        <div class="input-group input-group-merge">
                                            <span class="input-group-text" id="basic-addon3">
                                                <i data-feather="twitter" class="font-medium-2"></i>
                                            </span>
                                            <input id="twitter-input" type="text" name="twitter" class="form-control" value="{{ isset($data->twitter_url )?$data->twitter_url  :'' }}" placeholder="https://www.twitter.com/" aria-describedby="basic-addon3" />
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 mb-1">
                                        <label class="form-label" for="facebook-input">Facebook</label>
                                        <div class="input-group input-group-merge">
                                            <span class="input-group-text" id="basic-addon4">
                                                <i data-feather="facebook" class="font-medium-2"></i>
                                            </span>
                                            <input id="facebook-input" type="text" class="form-control" name="facebook" value="{{ isset($data->facebook_url )?$data->facebook_url  :'' }}" placeholder="https://www.facebook.com/" aria-describedby="basic-addon4" />
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 mb-1">
                                        <label class="form-label" for="google-input">Google+</label>
                                        <div class="input-group input-group-merge">
                                            <span class="input-group-text" id="basic-addon5">
                                                 <i class="fa fa-google font-medium-2"></i>
                                            </span>
                                            <input id="google-input" type="text" class="form-control" name="google" value="{{ isset($data->google_url )?$data->google_url  :'' }}" placeholder="https://www.gmail.com/" aria-describedby="basic-addon5" />
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 mb-1">
                                        <label class="form-label" for="linkedin-input">Linkedin</label>
                                        <div class="input-group input-group-merge">
                                            <span class="input-group-text" id="basic-addon9">
                                                <i data-feather="linkedin" class="font-medium-2"></i>
                                            </span>
                                            <input id="linkedin-input" type="text" class="form-control" name="linkedin" value="{{ isset($data->linkdin_url )?$data->linkdin_url  :'' }}" placeholder="https://www.linkedin.com/" aria-describedby="basic-addon9" />
                                        </div>
                                    </div>


                                    <div class="col-12 d-flex flex-sm-row flex-column mt-2">
                                        <button  class="btn btn-primary mb-1 mb-sm-0 me-0 me-sm-1 saveChanges">Save Changes</button>
                                        <button type="reset" class="btn btn-outline-secondary">Reset</button>
                                    </div>
                                </div>
                            </form>
                            <!-- users edit social form ends -->
                        </div>
                        <!-- Social Tab ends -->
                    </div>
                </div>
            </div>
        </section>
        <!-- users edit ends -->

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
$('#birthdatex').flatpickr({
        dateFormat: "d-m-Y",
        maxDate: "today",
    });
});
$(document).ready(()=>{
    $("#changePicture").change(function(){
            file = this.files[0];
        $('#profileimage').attr("src", URL.createObjectURL(file));
    });
    $('#removeImage').click(()=>{

        $('#profileimage').attr("src", "../../images/profile/user-upload/profile.png");
        $('#changePicture').val("");
    });
    });
    $('.saveChanges').click((e)=>{
        e.preventDefault();
        horizontalWizard = document.querySelector('#edit_form_submit'),
        $form = $(horizontalWizard).find('form');

        var {
            username,
            email,
            name,
            isactive,
            dob,
            phoneNumber,
            gender,
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
        var profileImage = $('#changePicture')[0].files;
        var updateForm = new FormData();
                    updateForm.append("username", username);
                    updateForm.append("email", email);
                    updateForm.append("dob", dob);
                    updateForm.append("phoneNumber", phoneNumber);
                    updateForm.append("name", name);
                    updateForm.append("gender", gender);
                    updateForm.append("address", address);
                    updateForm.append("country", country);
                    updateForm.append("city", city);
                    updateForm.append("isactive", isactive);
                    updateForm.append(" pincode", pincode);
                    updateForm.append("twitter", twitter);
                    updateForm.append("facebook", facebook);
                    updateForm.append("google", google);
                    updateForm.append("linkedin", linkedin);
                    updateForm.append("bio", bio);
                    updateForm.append("profileImage", profileImage[0]);
                    var settings = {
                        "async": true,
                        url: "{{ url('salesmen/updateSeller') }}/"+"{{$data->id}}",
                        "method": "post",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        "processData": false,
                        "contentType": false,
                        responsive: true,
                        data: updateForm,
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
                            for(var i = 0; i < 3; i++){

                                $('.updatesalesman')[i].reset();
                            }


                            Toast.fire({
                                icon: 'success',
                                title: 'Salesman is sucessfully Updated!'
                            })
                            window.location.replace('/salesmen');
                        }



                    });

    });


</script>

@endsection
