@extends('Salesman.layouts.master')

@section('title', 'Dasboard')
@section('content')
       <!-- Dashboard Ecommerce Starts -->
       <div class="row match-height">
                        <!-- Medal Card -->
                        <div class="col-xl-4 col-md-6 col-12">
                            <div class="card card-congratulation-medal">
                                <div class="card-body">
                                    <h5>Congratulations 🎉 John!</h5>
                                    <p class="card-text font-small-3">You have won gold medal</p>
                                    <h3 class="mb-75 mt-2 pt-50">
                                        <a href="#">230K</a>
                                    </h3>
                                    <button type="button" class="btn btn-primary">View Sales</button>
                                    <img src="../../../app-assets/images/illustration/badge.svg" class="congratulation-medal" alt="Medal Pic" />
                                </div>
                            </div>
                        </div>
                        <!--/ Medal Card -->

                        <!-- Statistics Card -->
                        <div class="col-xl-8 col-md-6 col-12">
                            <div class="card card-statistics">
                                <div class="card-header">
                                    <h4 class="card-title">Statistics</h4>
                                    <div class="d-flex align-items-center">
                                        <p class="card-text font-small-2 me-25 mb-0">Updated 1 month ago</p>
                                    </div>
                                </div>
                                <div class="card-body statistics-body">
                                    <div class="row">
                                        <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                                            <div class="d-flex flex-row">
                                                <div class="avatar bg-light-primary me-2">
                                                    <div class="avatar-content">
                                                        <i data-feather="trending-up" class="avatar-icon"></i>
                                                    </div>
                                                </div>
                                                <div class="my-auto">
                                                    <h4 class="fw-bolder mb-0">230k</h4>
                                                    <p class="card-text font-small-3 mb-0">Sales</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                                            <div class="d-flex flex-row">
                                                <div class="avatar bg-light-info me-2">
                                                    <div class="avatar-content">
                                                        <i data-feather="user" class="avatar-icon"></i>
                                                    </div>
                                                </div>
                                                <div class="my-auto">
                                                    <h4 class="fw-bolder mb-0">8.549k</h4>
                                                    <p class="card-text font-small-3 mb-0">Customers</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-sm-0">
                                            <div class="d-flex flex-row">
                                                <div class="avatar bg-light-danger me-2">
                                                    <div class="avatar-content">
                                                        <i data-feather="box" class="avatar-icon"></i>
                                                    </div>
                                                </div>
                                                <div class="my-auto">
                                                    <h4 class="fw-bolder mb-0">1.423k</h4>
                                                    <p class="card-text font-small-3 mb-0">Products</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-sm-6 col-12">
                                            <div class="d-flex flex-row">
                                                <div class="avatar bg-light-success me-2">
                                                    <div class="avatar-content">
                                                        <i data-feather="dollar-sign" class="avatar-icon"></i>
                                                    </div>
                                                </div>
                                                <div class="my-auto">
                                                    <h4 class="fw-bolder mb-0">10</h4>
                                                    <p class="card-text font-small-3 mb-0">Today Sales</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/ Statistics Card -->

                    </div>

                    <div class="row match-height">

                    <div class="col-lg-8 col-12">
                            <div class="row match-height">
                                <!-- Sales Line Chart Card -->
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header align-items-start">
                                            <div>
                                                <h4 class="card-title mb-25">Sales</h4>
                                                <p class="card-text mb-0">2020 Total Sales: 12.84k</p>
                                            </div>
                                            <i data-feather="settings" class="font-medium-3 text-muted cursor-pointer"></i>
                                        </div>
                                        <div class="card-body pb-0">
                                            <div id="sales-line-chart"></div>
                                        </div>
                                    </div>
                                </div>
                                <!--/ Sales Line Chart Card -->
                            </div>
                        </div>

                              <!-- Goal Overview Card -->
                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h4 class="card-title">Targets</h4>
                                    <i data-feather="help-circle" class="font-medium-3 text-muted cursor-pointer"></i>
                                </div>
                                <div class="card-body p-0">
                                    <div id="goal-overview-radial-bar-chart" class="my-2"></div>
                                    <div class="row border-top text-center mx-0">
                                        <div class="col-6 border-end py-1">
                                            <p class="card-text text-muted mb-0">Completed</p>
                                            <h3 class="fw-bolder mb-0">786,617</h3>
                                        </div>
                                        <div class="col-6 py-1">
                                            <p class="card-text text-muted mb-0">In Progress</p>
                                            <h3 class="fw-bolder mb-0">13,561</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/ Goal Overview Card -->

                    </div>
                    <div class="col-md-12">
                    <div class="row match-height">

                            <div class="col-lg-4 col-md-6 col-12">
                                <div class="card card-employee-task">
                                    <div class="card-header">
                                        <h4 class="card-title">Referals</h4>
                                        <i data-feather="more-vertical" class="font-medium-3 cursor-pointer"></i>
                                    </div>
                                    <div class="card-body">
                                        <div class="employee-task d-flex justify-content-between align-items-center">
                                            <div class="d-flex flex-row">
                                                <div class="avatar me-75">
                                                    <img src="../../../app-assets/images/portrait/small/avatar-s-9.jpg" class="rounded" width="42" height="42" alt="Avatar" />
                                                </div>
                                                <div class="my-auto">
                                                    <h6 class="mb-0">Ryan Harrington</h6>

                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <small class="text-muted me-75">9hr 20m</small>
                                                <div class="employee-task-chart-primary-1"></div>
                                            </div>
                                        </div>
                                        <div class="employee-task d-flex justify-content-between align-items-center">
                                            <div class="d-flex flex-row">
                                                <div class="avatar me-75">
                                                    <img src="../../../app-assets/images/portrait/small/avatar-s-20.jpg" class="rounded" width="42" height="42" alt="Avatar" />
                                                </div>
                                                <div class="my-auto">
                                                    <h6 class="mb-0">Louisa Norton</h6>

                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <small class="text-muted me-75">2 Days</small>
                                                <div class="employee-task-chart-danger"></div>
                                            </div>
                                        </div>
                                        <div class="employee-task d-flex justify-content-between align-items-center">
                                            <div class="d-flex flex-row">
                                                <div class="avatar me-75">
                                                    <img src="../../../app-assets/images/portrait/small/avatar-s-1.jpg" class="rounded" width="42" height="42" alt="Avatar" />
                                                </div>
                                                <div class="my-auto">
                                                    <h6 class="mb-0">Jayden Duncan</h6>

                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <small class="text-muted me-75">3 Days</small>
                                                <div class="employee-task-chart-success"></div>
                                            </div>
                                        </div>
                                        <div class="employee-task d-flex justify-content-between align-items-center">
                                            <div class="d-flex flex-row">
                                                <div class="avatar me-75">
                                                    <img src="../../../app-assets/images/portrait/small/avatar-s-20.jpg" class="rounded" width="42" height="42" alt="Avatar" />
                                                </div>
                                                <div class="my-auto">
                                                    <h6 class="mb-0">Cynthia Howell</h6>

                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <small class="text-muted me-75">10days</small>
                                                <div class="employee-task-chart-secondary"></div>
                                            </div>
                                        </div>
                                        <div class="employee-task d-flex justify-content-between align-items-center">
                                            <div class="d-flex flex-row">
                                                <div class="avatar me-75">
                                                    <img src="../../../app-assets/images/portrait/small/avatar-s-16.jpg" class="rounded" width="42" height="42" alt="Avatar" />
                                                </div>
                                                <div class="my-auto">
                                                    <h6 class="mb-0">Helena Payne</h6>

                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <small class="text-muted me-75">1 Months</small>
                                                <div class="employee-task-chart-warning"></div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8 col-md-6 col-12">
                                   <!-- Copy to clipboard -->
                                    <section id="copy-to-clipboard">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h4 class="card-title">Referal Link</h4>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-xl-8 col-md-8 col-sm-8 col-12 pe-sm-0">
                                                                <div class="mb-1">
                                                                    <input type="text" class="form-control" id="copy-to-clipboard-input" value="{{ config('app.url') }}/register?id=XHR123" />
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-2 col-12">
                                                                <button class="btn btn-outline-primary" id="btn-copy">Copy!</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                    <!--/ Copy to clipboard -->
                            </div>
                        </div>
                    </div>
                <!-- Dashboard Ecommerce ends -->
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
