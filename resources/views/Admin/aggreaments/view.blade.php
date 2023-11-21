@extends('Admin.layouts.master')
@section('title', 'Aggreament')
@section('style')
<link rel="stylesheet" type="text/css" href="../../../app-assets/css/plugins/forms/form-validation.css">
<link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css">
<link rel="stylesheet" type="text/css" href="../../../app-assets/css/plugins/forms/pickers/form-flat-pickr.css">
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
                                    <li class="breadcrumb-item"><a href="/aggreament">Aggreaments</a></li>
                                    <li class="breadcrumb-item"><a href="#">View</a></li>
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
        <div class="row">

        <div class="col-md-12">
        <div class="card">
            <div class="card-header">
            <h3>{{ $aggreament->title }}</h3>
            </div>

            <div class="card-body">
            {!! $aggreament->body !!}
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

@endsection
