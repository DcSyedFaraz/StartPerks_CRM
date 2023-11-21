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
                                    <li class="breadcrumb-item"><a href="#">Create</a></li>
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
        <div class="col-md-2">
        </div>
        <div class="col-md-8">
        <div class="card">
            <div class="card-header">
            <h3>Create Aggreament</h3>
            </div>

            <div class="card-body">
            <form id="createAggreament">
                @csrf
                <div class="form-group">
                    <label for="name">Title</label>
                    <input type="text" name="title" class="form-control" value="" placeholder="Title" required>
                </div>
                <br/>
                <div id="editor" style="min-height:18em">
                </div>
                <br/>

                <div class="form-group">
                <button  class="btn btn-primary w-100">Create Aggreament</button>
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
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script src="../../../app-assets/vendors/js/forms/validation/jquery.validate.min.js"></script>
<script src="../../../app-assets/vendors/js/pickers/pickadate/picker.js"></script>
<script src="../../../app-assets/js/core/app-menu.js"></script>
<script>
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


$("#createAggreament").submit(function(e){
    e.preventDefault();

    var html = quill.root.innerHTML;
    console.log("🚀 ~ file: create.blade.php ~ line 114 ~ $ ~ html", html)
    $.ajax({
        url: "/aggreament",
        type: "POST",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            title: $("input[name='title']").val(),
            body: html
        },
        success: function(data){
            if(data.code == 200){
                Toast.fire({
                        icon: 'success',
                        title: data.message
                    })

                    // setTimeout(function(){
                    //     window.location.href = "/aggreament";
                    // }, 1000);
            }else{
                Toast.fire({
                        icon: 'error',
                        title: data.message
                    })
            }
        }

    });
});
</script>
@endsection
