@extends('Admin.layouts.master')
@section('title', 'Create Salesmen')
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
   .modal-dialog-scrollable {
        height: calc(100% - 8.5rem);
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
    <div class="alert alert-warning" role="alert">
            <h4 class="alert-heading"><i data-feather='alert-triangle'></i>  Attention</h4>
            <div class="alert-body">
                <p>
                Our  <b>5 Star Processing Business </b>Credit Card has a One-time, Non-Refundable, Setup Fee of <b>$99.00</b> .Upon completion of your application, if approved, you will be redirected to a submit payment for the set up of the card. Minimum Requirements for Approval:
                </p>
                <ul>
                    <li>Real Business</li>
                    <li>US Bank Account</li>
                    <li>Social Security Number (for identification purposes only)</li>
                </ul>
                <p>Features Include:</p>
                <ul>
                    <li> No Credit Check</li>
                    <li>No Personal Guarantee </li>
                    <li>Can be used to purchase 5 Star Products</li>
                </ul>
            <i>"If you're not going to invest in your own business, who will ?"</i> - Uknown
            </div>
        </div>
        <section class="card bs-validation">
            <div class="card-content">
                <div id="rootwizard">

                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="card-body">
                                    <form id="addSalesman" class="needs-validation"  novalidate="novalidate"  >
                                        @csrf
                                        @method('POST')
                                        <!-- Step 1 -->
                                        <div class="my-2">
                                        <h4 class="heading my-1 h4">Company  Details</h4>
                                            <div class="row my-1">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="company_name">Company's Legal Name</label>
                                                        <input type="text" class="form-control" id="company_name" name="company_name" placeholder="Company Name" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="dba_name">Doing business as (DBA)</label>
                                                        <input type="text" class="form-control" id="dba_name" name="dba_name" placeholder="Doing business As" >
                                                        <small> If different from Legal Name</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Step 2 -->

                                        <div class="my-2">
                                        <h4 class="heading my-1 h4">Business Address</h4>
                                            <div class="row my-1">
                                                <div class="col-12">
                                                    <div class="mb-1">
                                                        <label class="form-label" for="businessaddress">Street Address</label>
                                                        <textarea class="form-control" id="businessaddress" name="businessaddress" rows="3" placeholder="Street Address"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row my-1">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="businesscity">City</label>
                                                        <input type="text" class="form-control" id="businesscity" name="businesscity" placeholder="City" >
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="businessstate">State/Province</label>
                                                        <input type="text" class="form-control" id="businessstate" name="businessstate" placeholder="State" >
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="businesspostal">Postal Code</label>
                                                        <input type="text" class="form-control" id="businesspostal" name="businesspostal" placeholder="Postal Code" >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Step 3 -->

                                        <div class="my-2">
                                        <h4 class="heading my-1 h4">Business Contact</h4>
                                            <div class="row my-1">
                                            <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="email">Email</label>
                                                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="phone">Phone Number</label>
                                                        <input type="phone" class="form-control" id="phone" name="phone" placeholder="Phone Number" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="phone">Business Start Date</label>
                                                        <input type="text"  id="businessstartdate" name="businessstartdate" class="form-control flatpickr-basic" placeholder="DD-MM-YYYY" required/>
                                                    </div>
                                                </div>
                                                <div class="row my-1">
                                                    <div class="col-md-4 my-1">
                                                        <div class="form-group">
                                                            <label for="phone">Type Of Entity</label>
                                                            <div style=" display: flex; flex-direction: column; ">
                                                                <div class="form-check form-check-inline">
                                                                        <input class="form-check-input" type="radio" name="entity" id="corporation" value="corporation" checked="">
                                                                        <label class="form-check-label" for="corporation">Corporation</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                        <input class="form-check-input" type="radio" name="entity" id="Government" value="Government" checked="">
                                                                        <label class="form-check-label" for="Government">Government   </label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                        <input class="form-check-input" type="radio" name="entity" id="LLC/Limited" value="LLC/Limited Liability Partnership" checked="">
                                                                        <label class="form-check-label" for="LLC/Limited">LLC/Limited Liability Partnership</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                        <input class="form-check-input" type="radio" name="entity" id="GeneralPartnership" value="General Partnership" checked="">
                                                                        <label class="form-check-label" for="GeneralPartnership">General Partnership</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                        <input class="form-check-input" type="radio" name="entity" id="proprietorship" value="proprietorship" checked="">
                                                                        <label class="form-check-label" for="proprietorship">Sole Proprietorship</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                        <input class="form-check-input" type="radio" name="entity" id="other" value="" checked="">
                                                                        <label class="form-check-label" for="other">  <input type="text" Placeholder="Other" id="otheroption" for="other" class="form-control" name="otheroption" > </label>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Step 4 -->
                                        <div class="my-2">
                                        <h4 class="heading my-1 h4">Principals/Ownership</h4>
                                        <p>Includes Officers, Partners, Directors, or Proprietor</p>
                                        <div class="form-control-repeater">
                                            <div class="invoice-repeater">
                                            <div data-repeater-list="invoice">
                                            <div data-repeater-item>
                                                <div class="row d-flex align-items-end my-1">
                                                    <div class="col-md-3 col-12">
                                                        <div class="mb-1">
                                                            <label class="form-label" for="itemname">Name</label>
                                                            <input type="text" class="form-control" id="itemname" name="PartnerName[]" aria-describedby="itemname" placeholder=""  required/>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3 col-12">
                                                        <div class="mb-1">
                                                            <label class="form-label" for="itemcost">Title</label>
                                                            <input type="text" class="form-control" id="title" name="PartnerPosition[]" aria-describedby="title" placeholder="Title" required />
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3 col-12">
                                                        <div class="mb-1">
                                                            <label class="form-label" for="itemquantity">Ownership</label>
                                                            <input type="number" class="form-control" id="itemquantity" name="ownership[]" aria-describedby="itemquantity" placeholder="1" required />
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3 col-12 mb-50">
                                                        <div class="mb-1">
                                                            <button class="btn btn-outline-danger text-nowrap px-1" data-repeater-delete type="button">
                                                                <i data-feather="x" class="me-25"></i>
                                                                <span>Delete</span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row my-1">
                                            <div class="col-12">
                                                <button class="btn btn-icon btn-primary" type="button" data-repeater-create>
                                                    <i data-feather="plus" class="me-25"></i>
                                                    <span>Add New</span>
                                                </button>
                                            </div>
                                        </div>
                                            </div>
                                        </div>

                                        </div>
                                        <!-- Step 5 -->
                                        <div class="my-2">
                                            <h4 class="heading my-1 h4">Public Filings</h4>
                                            <div class="row my-1">
                                                <div class="col-md-12">
                                                    <p>
                                                    Has the Applicant, or any principals involved in the company, ever filed for protection under bankruptcy laws?
                                                    </p>

                                                    <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="islawverify" id="allowlawsVerify" value="yes" checked="" checked>
                                                            <label class="form-check-label" for="allowlawsVerify">Yes</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="islawverify" id="denylawsVerify" value="no" checked="">
                                                            <label class="form-check-label" for="denylawsVerify">No   </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row my-1">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label" for="db"> D & B # </label>
                                                        <input type="text" class="form-control" id="db" aria-describedby="db" placeholder="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Step 6 -->
                                        <div class="my-2">
                                            <h4 class="heading my-1 h4">Personal information</h4>
                                            <div class="row my-1">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label" for="firstname">First Name</label>
                                                        <input type="text" class="form-control" id="firstname" aria-describedby="firstname" placeholder="First Name" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label" for="lastname">Last Name</label>
                                                        <input type="text" class="form-control" id="lastname" aria-describedby="lastname" placeholder="Last Name" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label" for="dateofbirth">Date of Birth</label>
                                                        <input type="date" class="form-control flatpickr-basic" id="dateofbirth" name="dateofbirth" aria-describedby="dateofbirth" placeholder="DD-MM-YYYY">

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row my-1">
                                                <!-- Address -->
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="form-label" for="address">Address</label>
                                                        <textarea  class="form-control" id="address" aria-describedby="address" placeholder="Address" ></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row my-1">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label" for="city">City</label>
                                                        <input type="text" class="form-control" id="city" aria-describedby="city" placeholder="City">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label" for="state">State</label>
                                                        <input type="text" class="form-control" id="state" aria-describedby="state" placeholder="State">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label" for="postalcode">Postal Code</label>
                                                        <input type="text" class="form-control" id="postalcode" aria-describedby="postalcode" placeholder="Postal Code">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row my-1">

                                                <!-- PASSWORD  -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label" for="password">Password</label>
                                                        <input type="password" class="form-control" id="password" aria-describedby="password" placeholder="Password" required>
                                                    </div>
                                                </div>
                                                <!-- Confirm Password  -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label" for="confirmpassword">Confirm Password</label>
                                                        <input type="password" class="form-control" id="confirmpassword" aria-describedby="confirmpassword" placeholder="Confirm Password" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- signature -->
                                            <div class="row my-1">
                                                <div class="col-md-12">
                                                    <div class="form-group" style="width:100%;">
                                                        <div style="float: right;position:relative;width:100%;">
                                                            <label class="form-label" for="signature">Signature</label>
                                                            <div id="signature" style="border-radius: 10px;width:100%;margin-top: 0 !important; "  class="border border-primary my-1 "></div>
                                                            <button class="btn btn-danger" data-toggle="tooltip"  title="Clear Signature" style="position: absolute;top: 47px;right: 10px;" id="clear-signature"> <i data-feather="x" class="me-25"></i></button>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <!-- Step 7 -->
                                        <div class="my-2">
                                            <!-- term & condtition -->
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <div class="form-check">
                                                            <input class="form-check-input"  data-bs-toggle="modal" data-bs-target="#exampleModalScrollable" type="checkbox" value="" id="termcondition">
                                                            <label class="form-check-label" for="termcondition">
                                                                I agree to the <b >Terms and Conditions</b>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal fade" id="exampleModalScrollable" tabindex="-1" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-scrollable">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalScrollableTitle">Terms and Conditionsv</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>
                                                            Interest Rates and Interest Charges Annual Percentage Rate (APR) for Purchases 0% based on creditworthiness.Default APR 0% Paying Interest
                                                            Your due date is at least 30 days after the close of each billing cycle. We will not charge you any interest on purchases if you pay your entire balance by the due date each month.
                                                            </p>
                                                            <ul>
                                                                <li>
                                                                    <p> Minimum finance charge <b>$2.00.</b></p>
                                                                </li>

                                                            </ul>
                                                            <h4>
                                                                Fees
                                                            </h4>
                                                                <ul>
                                                                    <li>
                                                                        <p>
                                                                            Annual fees : <b>0$</b>
                                                                        </p>
                                                                    </li>
                                                                    <li>
                                                                        <p>$ 99 Account Set up Fee Once approved for Net 30 account</p>
                                                                    </li>
                                                                </ul>
                                                            <h4>
                                                                Other fees
                                                            </h4>
                                                            <h4>
                                                                Late Fee:
                                                            </h4>
                                                                <ul>
                                                                    <li><p>$15 on balances up to $100</p></li>
                                                                    <li><p>$29 on balances of $100 up to $250</p></li>
                                                                    <li><p>$39 on balances of $250 and over</p></li>
                                                                    <li><p>Returned payment fee: $39</p></li>

                                                                </ul>

                                                            <p>

                                                            Method of computing the balance for purchases
                                                            <br/>
                                                            Daily balance. This includes new purchases.
                                                            <br/>
                                                            </p>
                                                            <h4>How do we apply your payment?</h4>
                                                             We apply your payments in a way that is most favorable or convenient for us. This may include applying such payments to low APR balances before higher APR balances. When can we change the rates, fees, and terms of your card agreement? We may change the rates, fees, and terms of your card agreement at any time, for any reason. These reasons may be based on information in your credit report or general market conditions. If the change will cause a rate or fee to increase, you will receive advance notice and a right to opt out. If you opt out, we will close your account. You can then pay the remaining balance under the old rates, fees, and terms. The information about the cost of the card described in this application is accurate as of November 1, 2019. This information may have changed after that date.

                                                            <h4>TERMS AND CONDITIONS OF OFFER</h4>
                                                            <p>
                                                            This offer is only valid for new accounts. You must be at least 18 years of age. If you are married, you may apply for a separate account. Techy Live Inc (“we” or “us”) is the issuer of your 5 Star Processing Business Credit Card Net 30 Account. Techy Live INC is located in Bentwood, CA. Credit offers are intended for residents of, and this is not an offer for the credit card to individuals outside of, the United States and its Territories.
                                                            To help the government fight the funding of terrorism and money laundering activities, federal law requires all financial institutions to obtain, verify, and record information that identifies each person who opens an account. This means that we will ask for your name, address, date of birth, and other information that will allow us to identify you when you open an account. In addition, the bank must obtain the business’ legal name, its street address, and its taxpayer identification number. We may also ask to see your driver’s license or other identifying documents; and obtain identification information about you or any employees you add to your account.
                                                            Federal law requires us to obtain, verify and record information that identifies each person who opens an account, in order to help the government fight the funding of terrorism and money laundering activities. To process the application, we must have the Business’ legal name, its street address, and its taxpayer identification number. Also, we must have the Authorized Officer’s name, home address, date of birth and other identifying information. We may ask for additional identifying documents from you as well.
                                                            We may gather information about you including from an employer, bank, credit bureau, and others to verify your identity and to determine your eligibility for credit, the renewal of credit and future extension of credit. If you ask us, we will tell you whether or not we requested a credit bureau report, and the names and addresses of any credit bureaus that provided us with such reports.
                                                            You authorize us to share with the retailer for whom this card is issued, and its affiliates, experiential and transactional information regarding you and your account.
                                                            To receive a 5 Star Processing Business Card NET 30 Account, you must meet our credit qualification criteria. Your credit limit will be determined by a review of your business credit report, and in some instances, a review of such other financial information as we may ask you or the business to provide. You will be informed of the amount of your credit line when your account is opened.
                                                            INITIAL DISCLOSURE STATEMENT FOR THE 5 Star Processing ACCOUNT
                                                            <br/>
                                                            Please read this Initial Disclosure Statement (“Statement”) and keep it for your records.
                                                            </p>
                                                            <h4>
                                                            Other Fees
                                                            </h4>
                                                            <br />
                                                            <h4> Late Fee</h4>
                                                            <p>
                                                            We add a late fee for each billing period you do not pay the Minimum Payment Due by the payment due date. This fee is based on your account balance as of the Transaction Date shown on your statement for the late fee. The fee is $15 on balances up to $100; $29 on balances of $100 up to $250; and $39 on balances of $250 and over. We add this fee to the regular purchase balance. Returned Payment Fee. We add a $39 fee if a payment check or similar instrument is not honored or if it is returned because it cannot be processed. We also add this fee if an automatic debit is returned unpaid. We assess this fee the first time your check or payment is not honored, even if it is honored upon resubmission. We add this fee to the regular purchase balance.

                                                            </p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Accept</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="submit" class="btn btn-primary" id="addNewSalesman" value="Submit" />
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

@endsection

@section('scripts')
  <!-- BEGIN: Vendor JS-->
  <script src="../../../app-assets/vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->
    <script  src="../../../app-assets/js/scripts/signature/jquery.js"></script>
    <script  src="../../../app-assets/js/scripts/signature/flashcanvas.min.js"></script>
	<script src="../../../app-assets/js/scripts/signature/jSignature.min.js"></script>


   <!-- BEGIN: Page Vendor JS-->
   <script src="../../../app-assets/vendors/js/forms/repeater/jquery.repeater.min.js"></script>
    <!-- END: Page Vendor JS-->
    <!-- BEGIN: Page JS-->
    <script src="../../../app-assets/js/scripts/forms/form-repeater.js"></script>
    <!-- END: Page JS-->
    <!-- BEGIN: Page Vendor JS-->
    <script src="../../../app-assets/vendors/js/forms/select/select2.full.min.js"></script>
    <script src="../../../app-assets/vendors/js/forms/validation/jquery.validate.min.js"></script>
    <script src="../../../app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Page JS-->
    <script src="../../../app-assets/js/scripts/pages/app-user-edit.js"></script>
    <!-- END: Page JS-->




    <script>

        $(document).ready(function() {
                    $("#signature").jSignature()
                    $('#clear-signature').on('click', function(){
                        $("#signature").jSignature("reset");
                    });
                })

        // $(window).on('load', function() {
        //     if (feather) {
        //         feather.replace({
        //             width: 14,
        //             height: 14
        //         });
        //     }
        // })
        $("#otheroption").keyup(function() {
            let otheroption = $(this).val();
            $("#other").val(otheroption);
        });

        $( "#otheroption" ).focus(function() {
            if($("#otheroption").hasClass("focus-visible")){
                $("#other").attr("checked", true);
            }
        });
        $("#addNewSalesman").click(function(e){
            e.preventDefault();
            var isValid = $('#addSalesman').valid();
          
            if(!Boolean(isValid )){
                $("#addSalesman").addClass("was-validated");
                $("#addSalesman").addClass("invalid");
                return false;
            }
            password = $("#password").val();
            confirmpassword = $("#confirmpassword").val();
            if(password != confirmpassword){
                $("#password").addClass("invalid");
                $("#confirmpassword").addClass("invalid");
                Toast.fire({
                    icon: 'error',
                    title: 'Password and Confirm Password does not match'
                });
                return false;
            }
            dba_name = $("#dba_name").val();
            company_name = $("#company_name").val();
          
            email = $("#email").val();
            phone = $("#phone").val();
            businessstartdate = $("#businessstartdate").val();
            businessaddress = $("#businessaddress").val();
            businesscity = $("#businesscity").val();
            businessstate = $("#businessstate").val();
            businesspostal = $("#businesspostal").val();
            entity = $("input[name='entity']:checked").val();
            ownership = [];
              $("input[name*='ownership']").each(function(){ ownership.push($(this).val());});
          
            PartnerPosition = [];
             $("input[name*='PartnerPosition']").each(function(){ PartnerPosition.push($(this).val());});
        
            token = $("input[name='_token']").val();
            PartnerName = [];
            $("input[name*='PartnerName']").each(function(){ PartnerName.push($(this).val());});
            islawverify = $("input[name='islawverify']:checked").val();
            dandb = $("#db").val();
            first_name = $("#firstname").val();
            last_name = $("#lastname").val();
            dateofbirth = $("#dateofbirth").val();
            address = $("#address").val();
            city = $("#city").val();
            state = $("#state").val();
            postalcode = $("#postalcode").val();
            signature = $("#signature").jSignature("getData", "svgbase64");
            var i = new Image()
            i.src = "data:" + signature[0] + "," + signature[1];
            signature = i.src;
            termsandconditions = $("#termcondition").is(':checked');
            var form = new FormData();
            form.append("company",company_name);
            form.append("company_dba", dba_name);
            form.append("email", email);
            form.append("phone", phone);
            form.append("businessstartdate", businessstartdate);
            form.append("businessaddress", businessaddress);
            form.append("businesscity", businesscity);
            form.append("businessstate", businessstate);
            form.append("businesspostal", businesspostal);
            form.append("entity", entity);
            form.append("ownership[]", ownership);
            form.append("PartnerPosition[]", PartnerPosition);
            form.append("PartnerName[]", PartnerName);
            form.append("islawverify", islawverify);
            form.append("_token", token);
            form.append("db", dandb);
            form.append("first_name", first_name);
            form.append("last_name", last_name);
            form.append("dateofbirth", dateofbirth);
            form.append("address", address);
            form.append("city", city);
            form.append("state", state);
            form.append("postalcode", postalcode);
            form.append("password", password);
            form.append("confirmpassword", confirmpassword);
            form.append("signature", signature);
            form.append("termsandconditions", termsandconditions);
              var settings = {
                    "url": "/addNewSalesman",
                    "type": "POST",
                     "header" : {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     },
                    "processData": false,
                    "contentType": false,
                    "data": form,
                }
                    $.ajax(settings).done(function (response) {
                        if(response.code == "500"){
                            $("#addSalesman").removeClass("was-validated");
                            $("#addSalesman").removeClass("valid");
                            $("#addSalesman").addClass("was-validated");
                            $("#addSalesman").addClass("invalid");
                            Toast.fire({
                                icon: 'error',
                                title: response.error_message
                            });
                        }
                        else{
                            $("#addSalesman").removeClass("was-validated");
                            $("#addSalesman").removeClass("invalid");
                            $("#addSalesman").addClass("was-validated");
                            $("#addSalesman").addClass("valid");
                              Toast.fire({
                                icon: 'success',
                                title: 'Salesman is sucessfully Added!'
                            })
                            setTimeout(() => {
                                window.location.href = "/salesmen";
                                          
                               }, 4000);
                        }

                     
                    });
        });


        // $(document).ready(()=>{
        //     var canvas = document.getElementById("signature");
        //     var signaturePad = new SignaturePad(canvas);
        //     $('#clear-signature').on('click', function(){
        //         signaturePad.clear();
        //     });
        // })

    </script>
@endsection
