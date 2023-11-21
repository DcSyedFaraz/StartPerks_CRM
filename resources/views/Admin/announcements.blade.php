@extends('Admin.layouts.master')
@section('title', 'Announcements')
@section('style')

<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/file-uploaders/dropzone.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/pages/app-user.css')}}">
  <link rel="stylesheet" type="text/css" href="../../../app-assets/css/plugins/forms/form-file-uploader.css">
@endsection
@section('content')
<section id="dropzone-examples">
<div class="row col-12">
    <div class="col-lg-2 col-12" ></div>
    <div class="col-lg-8 col-12 ">
     <!-- multi file upload starts -->
     <!-- only access by admin  -->
     @if( Auth::user()->roles[0]->id == 1)
    <div class="row" >
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title"><i data-feather='plus'></i> Add Announcement</h2>
                </div>

                <div class="pt-0 card-body">

                        <div class="px-2 col-12">
                            <textarea id="description"  class="form-control" name="description" value="" placeholder="Write Some thing......" aria-describedby="basic-addon5" style="border: 0px; font-size: 14px; padding: 0px !important; box-shadow: none !important; min-height: 73px;overflow-x: hidden;" ></textarea>
                        </div>

                        <form action="{{ route('imagesupload') }}" class="dropzone" id="my-awesome-dropzone">@csrf</form>

                    <div class="mt-2 col-12">
                        <button id="addAnnoucements" class="btn btn-primary w-100" >Post New Announcements</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    <!-- multi file upload ends -->
        @foreach ($announcments as $post)
            <!-- post 1 -->
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-start align-items-center mb-1">
                        <!-- avatar -->
                        <div class="avatar me-1">
                            <img src="{{asset('/images/portrait/small/avatar-s-11.jpg')}}" alt="avatar img" height="50" width="50" />
                        </div>
                        <!--/ avatar -->
                        <div class="profile-user-info">
                            <h6 class="mb-0">Admin</h6>
                            <small class="text-muted">{{ date("d M, Y H:i ", strtotime($post->created_at)) }}</small>
                        </div>
                    </div>
                    <p class="card-text">
                        {{ $post->description}}
                    </p>

                    @if(isset($post->image) && $post->image != null && $post->image != '')
                    <!-- post img -->
                    <img style="display: flex; justify-content: center; align-items: center;max-height:500px " class="img-fluid rounded mb-75" src="{{ (strpos($post->image,'http') === 0 || strpos($post->image,'https') === 0)? $post->image:'/images/announcements/'.$post->image}}" alt="Announcemnts" />
                    <!--/ post img -->
                    @endif
                    <!-- Comment -->
                    @if(isset($post->comments) && $post->comments != null && $post->comments != '')
                    @foreach($post->comments as $comment)
                    <div class="d-flex align-items-start mb-1">
                                            <div class="avatar mt-25 me-75">


                                                @if(  $comment["profile_image"] != null &&  $comment["profile_image"] != '')
                                            <img src="{{ '../../../../images/profile/user-upload/'. $comment['profile_image']   }}" alt="Avatar" height="34" width="34" />
                                               @else
                                               <?php
                                                       $stateNum = rand(1,6);
                                                       $states = ['success', 'danger', 'warning', 'info', 'dark', 'primary', 'secondary'];
                                                       $state = $states[$stateNum] ;
                                                        $name =  $comment->name ;
                                                        $initials = array_values(array_filter(explode(" ", $name),function($x){
                                                            return $x != '' ;
                                                        }));
                                                  
                                                        $nameIdentifier = (($initials[0])?$initials[0][0]:'').((isset($initials[1])?$initials[1][0]:''));
                                                       $initials = strtoupper($nameIdentifier);
                                                ?>
                                                <span class="avatar-content"> {{ $initials }} </span>
                                                @endif

                                            </div>
                                            <div class="profile-user-info w-100">
                                                <div class="d-flex align-items-center ">
                                                    <h6 class="mb-0">{{  ($comment->name)?$comment->name:""  }}</h6>
                                                    <small class="text-left mx-1 text-muted">{{ date("d M, Y H:i ", strtotime($comment->created_at)) }}</small>
                                                </div>
                                                <small>{{ ($comment->body)?$comment->body:"" }}</small>
                                            </div>
                                        </div>
                    @endforeach
                    @endif
                                        <!--/ comments -->
<div post-id="{{ 'postid-'.$post->id}}">
                                        <!-- comment box -->
                                        <fieldset class="mb-75">
                                            <label class="form-label" for="label-textarea">Add Comment</label>
                                            <textarea class="form-control" id="label-textarea" rows="3" placeholder="Add Comment"></textarea>
                                        </fieldset>
                                        <!--/ comment box -->
                                        <button type="button" onClick="postComment(this)" class="btn btn-sm btn-primary">Post Comment</button>
                </div>
                </div>
            </div>
            <!--/ post 1 -->
        @endforeach

                    </div>
    <div class="col-lg-2 col-12" ></div>
</div>

</section>
@endsection
@section('scripts')
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
  
    <!-- BEGIN: Theme JS-->
    <script src="{{asset('app-assets/js/core/app-menu.js') }}"></script>
    <script src="{{asset('app-assets/js/core/app.js') }} "></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <!-- <script src="{{asset('app-assets/js/scripts/forms/form-file-uploader.js') }}"></script> -->


 <script type="text/javascript">
    var image ;
     Dropzone.options.myAwesomeDropzone = {
    url : '{{ route("imagesupload") }}', // camelized version of the `id`
    paramName: "file", // The name that will be used to transfer the file
    accept: function(file, done) {
      if (file.name == "justinbieber.jpg") {
        done("Naha, you don't.");
      }
      else { done(); }
    },
    sending : function(file, xhr, formData){
        image = file;
        console.log(image);
        // formData.append('description', $('#description').val());
    },

  };
        $('#addAnnoucements').on("click",function(){
            console.log("saad");
            var description = $('#description').val();
            console.log(description);
            console.log(image);
            var formData = new FormData();
            formData.append('description',description);
            formData.append('image',image);
            formData.append('_token',$('input[name=_token]').val());
            $.ajax({
                url: "{{ route('announcements.store') }}",
                type: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                success: function(data){
                    toastr['success'](
                    'You have successfully added new announcement.',
                    {
                        closeButton: true,
                        tapToDismiss: false
                    }
                    );
                    location.reload();

                },
                error: function(data){
                    toastr['error'](
                    'Something went wrong.',
                    {
                        closeButton: true,
                        tapToDismiss: false
                    }
                    );
                }
            });
            // console.log($("#dpz-single-file"));
        })
//comment function
function postComment(e){
    var postId = $(e).closest('.card').find('[post-id]').attr('post-id');
    var comment = $(e).closest('.card').find('[post-id]').find('textarea').val();
    var formData = new FormData();
    formData.append('comment',comment);
    formData.append('post_id',postId);
    formData.append('_token',$('input[name=_token]').val());
    console.log(comment);
    console.log(postId);
    console.table(formData);
    $.ajax({
        url: "{{ route('postcomment') }}",
        type: "POST",
        data: formData,
        contentType: false,
        cache: false,
        processData: false,
        success: function(data){
            toastr['success'](
            'You have successfully added new comment.',
            {
                closeButton: true,
                tapToDismiss: false
            }
            );
            location.reload();

        },
        error: function(data){
            toastr['error'](
            'Something went wrong.',
            {
                closeButton: true,
                tapToDismiss: false
            }
            );
        }
    });
}


</script>
@endsection
