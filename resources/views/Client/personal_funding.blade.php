@extends('Client.layouts.master')

@section('title', 'Dasboard')
@section('content')
     <style>
        .blur
        {
            opacity: 0.50;
            pointer-events: none;
        }
     </style>
<section class="section">
    <div class="section-body">
        <div class="card">
            <div class="card-header bg-primary  mb-3">
                <h1 class="text-light text-uppercase">Personal Funding</h1>
            </div>
            <div class="carcd-body">
                <div class="d-flex align-items-start">
                    <div class="nav flex-column nav-pills me-3 w-25" id="myTab" role="tablist" aria-orientation="vertical">
                        
                        <a class="nav-link active fs-5 p-1 border " step="prequailfer" href="#prequailfer">Prequailfer</a>
                        @if($form_stage->stage_1)
                            <a class="nav-link fs-5 border opacity-25" step="first_stage" href="#first_stage">First Stage</a>
                        @else
                        <a class="nav-link fs-5 border opacity-25 blur" href="javscript:;">First Stage</a>
                        @endif 
                        @if($form_stage->stage_2 == true)
                            <a class="nav-link fs-5 border" step="second_stage" href="#second_stage">Second Stage</a>
                        @else
                        <a class="nav-link fs-5 border opacity-25 blur" href="javscript:;">Second Stage</a>
                        
                        @endif 
                        @if($form_stage->stage_3)
                            <a class="nav-link fs-5 border" step="third_stage"  href="#third_stage">Third Stage</a>
                        @else
                         <a class="nav-link fs-5 border opacity-25 blur" href="javscript:;">Third Stage</a>
                        @endif
                        @if($form_stage->stage_4)
                            <a class="nav-link fs-5 border" step="last_stage" href="#last_stage">Last Stage</a>
                        @else
                        <a class="nav-link fs-5 border opacity-25 blur" href="javscript:;">Last Stage</a>
                        @endif
                      
                    </div>
                    <div class="tab-content" id="v-pills-tabContent">
                      <div class="tab-pane fade show active " id="prequailfer" role="tabpanel" aria-labelledby="v-pills-home-tab">
                        <section class="container">
                            <div class="section-header item-align-right">
                                <h1 class="text-uppercase">Prequailfer</h1>
                            </div>
                            <div class="section-body">
                                <div class="card">
                                    <div class="card-body">
                                             <form id="prequlifier" action="{{ route('prequailfer.document.upload') }}" enctype="multipart/form-data" method="post">
                                                @csrf
                                                <div class="row">
                                                   <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label">Driver licence</label>
                                                        <input class="form-control" type="file" name="driving_licence" id="formFile">
                                                    </div>
                                                   </div>
                                                   <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label">Proof Of Address</label>
                                                        <input class="form-control" name="proof_of_address" type="file" id="formFile1">
                                                    </div>
                                                   </div>
                                                   <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label class="form-label">Social sercuity card</label>
                                                            <input class="form-control" name="social_sercuity_card" type="file" id="formFile3">
                                                        </div>
                                                   </div>
                                                   @foreach($clientdocs as $cd):
                                                   <div class="row mb-1">
                                                        <div class="col-md-4">
                                                            <a href="{{ $cd->driving_licence }}" target="_blank" class="btn btn-lg btn-primary">Download</a>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <a href="{{ $cd->proof_of_address }}" target="_blank" class="btn btn-lg btn-primary">Download</a>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <a href="{{ $cd->social_sercuity_card }}" target="_blank" class="btn btn-lg btn-primary">Download</a>
                                                        </div>
                                                   </div>
                                                   @endforeach;
                                                   <div class="col-md-12">
                                                     <input type="submit" value="Start Funding" class="float-end btn btn-lg btn-primary">
                                                   </div>
                                            </div>
                                        </form>
                                     </div>
                                </div>
                            </div>
                        </section>
                      </div>


                      {{-- FIRST STAGE START --}}
                      <div class="tab-pane fade " id="first_stage" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                        <section class="container">
                             <div class="section-header item-align-right mb-2">
                                <h1 class="text-uppercase">First Stage</h1>
                             </div>
                            <div class="row">
                              @foreach($banks as $bank)
                                 <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">  
                                    <div class="card border" style="">
                                        <img src="{{$bank->image}}"  class="card-img-top h-100" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title fs-1">{{$bank->card_name}} <br>
                                                <small class="fw-bolder fs-5">{{$bank->bank_name}}</small>
                                            </h5>
                                         
                                            <div class="card-form">
                                                <form action="{{ route("client.card.upload") }}" class="card_form" method="post">
                                                    @csrf
                                                    <input type="hidden" value="{{ $bank->funding_detail->id ?? 0}}" name="card_id" />
                                                    <input type="hidden" value="{{ $bank->id}}" name="card_id" />
                                                    <input type="hidden" value="stage_1" name="stage" />
                                                    <input type="hidden" value="{{ $bank->bank_id}}" name="bank_id" />
                                                    <input type="hidden" value="{{ $bank->cat_id}}" name="cat_id" />
                                                    <div class="mb-1">
                                                        <select class="form-control" name="aprroval_status">
                                                            <option value="accept" {{
                                                        ( $bank->funding_detail->aprroval_status ?? "" == 'accept') ?"":"selected"  }}>Accept</option>
                                                            <option value="decline" {{
                                                                ( $bank->funding_detail &&$bank->funding_detail->aprroval_status  == 'accept') ?"":"selected"  }}>Decline</option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-1">
                                                        <input type="number" name="amount" id="" class="form-control" value="{{$bank->funding_detail->amount ?? 0}}" placeholder="Amount">
                                                    </div>
                                                    <div class="mb-1">
                                                        <input type="submit" class="btn-primary btn-lg btn w-100">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            
                            <div class="col-md-12">
                                <button type="button" data-stage="stage_1" data-stage-enabled="stage_2" data-type="{{ $form_stage->Type }}" class="step_btn btn btn-lg btn-default border float-end">Next Stage</button>
                            </div>
                            </div>
                        
                        </section>




                      </div>
                      <div class="tab-pane fade" id="second_stage" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                        <section class="container">
                            <div class="section-header item-align-right mb-2">
                               <h1 class="text-uppercase">Second Stage</h1>
                           </div>
                           <div class="row">
                             @foreach($banks_1 as $bank)
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">  
                                   <div class="card border" style="">
                                       <img src="{{$bank->image}}"  class="card-img-top h-100" alt="...">
                                       <div class="card-body">
                                           <h5 class="card-title fs-1">{{$bank->card_name}} <br>
                                               <small class="fw-bolder fs-5">{{$bank->bank_name}}</small>
                                           </h5>
                                        
                                           <div class="card-form">
                                               <form action="{{ route("client.card.upload") }}" class="card_form" method="post">
                                                   @csrf
                                                   <input type="hidden" value="{{ $bank->funding_detail->id ?? 0}}" name="card_id" />
                                                   <input type="hidden" value="{{ $bank->id}}" name="card_id" />
                                                   <input type="hidden" value="stage_2" name="stage" />
                                                   <input type="hidden" value="{{ $bank->bank_id}}" name="bank_id" />
                                                   <input type="hidden" value="{{ $bank->cat_id}}" name="cat_id" />
                                                   <div class="mb-1">
                                                       <select class="form-control" name="aprroval_status">
                                                           <option value="accept" {{
                                                       ( $bank->funding_detail->aprroval_status ?? "" == 'accept') ?"selected":""  }}>Accept</option>
                                                           <option value="decline" {{
                                                               ( $bank->funding_detail &&$bank->funding_detail->aprroval_status  == 'accept') ?"selected":""  }}>Decline</option>
                                                       </select>
                                                   </div>
                                                   <div class="mb-1">
                                                       <input type="number" name="amount" id="" class="form-control" value="{{$bank->funding_detail->amount ?? 0}}" placeholder="Amount">
                                                   </div>
                                                   <div class="mb-1">
                                                       <input type="submit" class="btn-primary btn-lg btn w-100">
                                                   </div>
                                               </form>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                           @endforeach
                              
                               <div class="col-md-12">
                                <button type="button" data-stage="stage_2" data-stage-enabled="stage_3" data-type="{{ $form_stage->Type }}" class="step_btn btn btn-lg btn-default border float-end">Next Stage</button>
                        
                               </div>
                           </div>
                       
                       </section>
                    </div>
                      <div class="tab-pane fade" id="third_stage" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                        

                        <section class="container">
                            <div class="section-header item-align-right mb-2">
                               <h1 class="text-uppercase">Third Stage</h1>
                           </div>
                           <div class="row">
                             @foreach($banks_2 as $bank)
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">  
                                   <div class="card border" style="">
                                       <img src="{{$bank->image}}"  class="card-img-top h-100" alt="...">
                                       <div class="card-body">
                                           <h5 class="card-title fs-1">{{$bank->card_name}} <br>
                                               <small class="fw-bolder fs-5">{{$bank->bank_name}}</small>
                                           </h5>
                                        
                                           <div class="card-form">
                                               <form action="{{ route("client.card.upload") }}" class="card_form" method="post">
                                                   @csrf
                                                   <input type="hidden" value="{{ $bank->funding_detail->id ?? 0}}" name="card_id" />
                                                   <input type="hidden" value="{{ $bank->id}}" name="card_id" />
                                                   <input type="hidden" value="stage_3" name="stage" />
                                                   <input type="hidden" value="{{ $bank->bank_id}}" name="bank_id" />
                                                   <input type="hidden" value="{{ $bank->cat_id}}" name="cat_id" />
                                                   <div class="mb-1">
                                                       <select class="form-control" name="aprroval_status">
                                                           <option value="accept" {{
                                                       ( $bank->funding_detail->aprroval_status ?? "" == 'accept') ?"selected":""  }}>Accept</option>
                                                           <option value="decline" {{
                                                               ( $bank->funding_detail &&$bank->funding_detail->aprroval_status  == 'accept') ?"selected":""  }}>Decline</option>
                                                       </select>
                                                   </div>
                                                   <div class="mb-1">
                                                       <input type="number" name="amount" id="" class="form-control" value="{{$bank->funding_detail->amount ?? 0}}" placeholder="Amount">
                                                   </div>
                                                   <div class="mb-1">
                                                       <input type="submit" class="btn-primary btn-lg btn w-100">
                                                   </div>
                                               </form>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                              @endforeach
                              
                               <div class="col-md-12">
                                <button type="button" data-stage="stage_3" data-stage-enabled="stage_4" data-type="{{ $form_stage->Type }}" class="step_btn btn btn-lg btn-default border float-end">Next Stage</button>
                            </div>
                           </div>     
                       </section>
                      </div>
                      <div class="tab-pane fade" id="last_stage" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                        
                        <section class="container">
                            <div class="section-header item-align-right mb-2">
                               <h1 class="text-uppercase">Last Stage</h1>
                           </div>   
                           <div class="row">
                             @foreach($banks_3 as $bank)
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">  
                                   <div class="card border" style="">
                                       <img src="{{$bank->image}}"  class="card-img-top h-100" alt="...">
                                       <div class="card-body">
                                           <h5 class="card-title fs-1">{{$bank->card_name}} <br>
                                               <small class="fw-bolder fs-5">{{$bank->bank_name}}</small>
                                           </h5>
                                        
                                           <div class="card-form">
                                               <form action="{{ route("client.card.upload") }}" class="card_form" method="post">
                                                   @csrf
                                                   <input type="hidden" value="{{ $bank->funding_detail->id ?? 0}}" name="card_id" />
                                                   <input type="hidden" value="{{ $bank->id}}" name="card_id" />
                                                   <input type="hidden" value="stage_4" name="stage" />
                                                   <input type="hidden" value="{{ $bank->bank_id}}" name="bank_id" />
                                                   <input type="hidden" value="{{ $bank->cat_id}}" name="cat_id" />
                                                   <div class="mb-1">
                                                       <select class="form-control" name="aprroval_status">
                                                           <option value="accept" {{
                                                       ( $bank->funding_detail->aprroval_status ?? "" == 'accept') ?"selected":""  }}>Accept</option>
                                                           <option value="decline" {{
                                                               ( $bank->funding_detail &&$bank->funding_detail->aprroval_status  == 'accept') ?"selected":""  }}>Decline</option>
                                                       </select>
                                                   </div>
                                                   <div class="mb-1">
                                                       <input type="number" name="amount" id="" class="form-control" value="{{$bank->funding_detail->amount ?? 0}}" placeholder="Amount">
                                                   </div>
                                                   <div class="mb-1">
                                                       <input type="submit" class="btn-primary btn-lg btn w-100">
                                                   </div>
                                               </form>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                              @endforeach
                              
                               <div class="col-md-12">
                                   <button class="btn btn-lg btn-default border float-end">Next Stage</button>
                               </div>
                           </div>
                       
                       </section>
                        
                      </div>
                     </div>
                  </div>
            </div>
        
        </div>
    </div>
</section>



@endsection
@section('scripts')
<script>
    $(function(e){
        $('#myTab a').on("click",function(e){
           
            $(this).tab("show");
        }); // show tab targeted by the selector
        $("#prequlifier").submit(function (e) {
            e.preventDefault();
            let action = e.target.action;
            $.ajax({
                url: action,
                type: "post",
                data: new FormData(this),
                processData: false,
                contentType: false,
                responsive: true,
                success: function (response) {
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
                        $('#prequlifier')[0].reset();
                        // $("#add_modal").modal("hide");
                        // $('#dataTable').DataTable().ajax.reload();
                        Toast.fire({
                            icon: 'success',
                            title: 'Your Document Submited.!'
                        })
                        window.location.reload(); 
                    }
                    
                }
            });
        });

        $(".step_btn").on("click",function(){
           var type = $(this).attr("data-type");
           var stage = $(this).attr("data-stage");
           var stage_enabled = $(this).attr("data-stage-enabled");
           var action = '{{route("client.card.stage_step")}}';
           var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
           var data = {stage:stage,stage_enabled:stage_enabled,type:type};
           $.ajax({
            url: action,
            type: "post",
            data: data, // Data to send in the request
            dataType: "json", // Expected data type of the response
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            success: function (response) {
               if(response.status){
                    Toast.fire({
                        icon: 'success',
                        title: response.message
                    })
                    setTimeout(() => {
                        window.location.reload;
                    }, 1500);
                }
                else{
                    Toast.fire({
                        icon: 'error',
                        title: response.error_message
                    })
                  
                }

            }
          })
        })
        $(".card_form").submit(function (e) {
                e.preventDefault();
                Swal.fire({
                title: 'Please Input Correct Detail it won`t be change after Saved',
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: 'Save',
                denyButtonText: `Don't save`,
                }).then((result) => {
                if (result.isConfirmed) { 
                  let action = e.target.action;
                    $.ajax({
                        url: action,
                        type: "post",
                        data: new FormData(this),
                        processData: false,
                        contentType: false,
                        responsive: true,
                        success: function (response) {
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
                                $(this)[0].reset();
                                $("#add_modal").modal("hide");
                                $('#dataTable').DataTable().ajax.reload();
                                Toast.fire({
                                    icon: 'success',
                                    title: 'Your Request Successully Saved.!'
                                })
                            }
                            
                        }
                    });

                } 
                else if (result.isDenied) {
                    Swal.fire('Changes are not saved', '', 'info')
                }
                /* Read more about isConfirmed, isDenied below */
            });
        })
  })
</script>
@endsection
