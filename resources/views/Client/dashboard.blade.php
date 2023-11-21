@extends('Client.layouts.master')

@section('title', 'Dash board')
@section('content')
   
    <div class="container-fluid ">
        <div class="row">
            <div class="col-md-8">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" width="100%" height="400px" src="https://www.youtube.com/embed/sQD7kaZ5h0s" title="What Is CRM? | Introduction To CRM Software| CRM Projects For Beginners | CRM 2022 | Simplilearn" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <h2 class="card-header  fw-bolder">Total Funded</h2>
                    <div class="card-body">
                      <h5 class="card-text">${{ $total_funding->totalamount }}</h5>
                    </div>
                  </div>
                  <div class="card">
                    <h2 class="card-header fw-bolder fs-3">Amount Funded in the past 24 hours</h2>
                    <div class="card-body">
                      <h3 class="card-text">${{ $last_funding->totalamount }}</h5>
                    </div>
                  </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-4 col-lg-4 col-xl-4 col-sm-12 ">
                <div class="card card-statistic-2 d-total-three-border">
                    <div class="card-wrap">
                        <div class="card-header text-center bg-primary">
                            <h3 class="fs-4 text-light">The scribble center aka note pad</h3>
                        </div>
                        <div class="card-body p-2">
                           <textarea class="form-control w-100 h-100 " rows="8">

                           </textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-lg-4 col-xl-4 col-sm-12 ">
                <div class="card card-statistic-2 d-total-three-border">
                    <div class="card-wrap">
                        <div class="card-header text-center bg-primary">
                            <h3 class="bg-primar fs-4 fw-bold text-light">Task</h3>
                        </div>
                        <div class="card-body">
                           <table class="table table-bordered table-striped  text-center">
                                <tbody>
                                    <tr>
                                        <td>CHASE</td>
                                        <td>Completed</td>
                                    </tr>
                                    <tr>
                                        <td>CHASE</td>
                                       
                                        <td>Completed</td>
                                    </tr>
                                    <tr>
                                        <td>CHASE</td>
                                       
                                        <td>Pending</td>
                                    </tr>
                                    <tr>
                                        <td>CHASE</td>
                                       
                                        <td>Pending</td>
                                    </tr>
                                    <tr>
                                         <td>CHASE</td>
                                       
                                        <td>Rejected</td>
                                    </tr>
                                </tbody>
                           </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-lg-4 col-xl-4 col-sm-12 ">
                <div class="card card-statistic-2 d-total-three-border">
                    <div class="card-wrap">
                        <div class="card-header text-center bg-primary">
                            <h3 class="fs-4 fw-bold text-light">Total amount you have been approved for </h3>
                        </div>
                        <div class="card-body">
                           <table class="table table-bordered table-striped  text-center">
                                <thead>
                                    <tr>
                                        <td>Bank</td>
                                        <td>Amount</td>
                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach($approved_amounts as $approved_amount)
                                    <tr>
                                        <td>{{ $approved_amount->name }}</td>
                                        <td>{{ $approved_amount->amount }}</td>
                                    </tr>
                                  @endforeach
                                </tbody>
                           </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>   
@endsection
@section('scripts')
    <script>
        setTimeout(function () {
            toastr['success'](
            'You have successfully logged in to CRM App.',
            '👋 Welcome {{Auth::user()->name}}!',
            {
                closeButton: true,
                tapToDismiss: false
            }
            );
        }, 2000);
    </script>
@endsection
