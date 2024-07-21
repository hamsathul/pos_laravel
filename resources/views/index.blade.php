@extends('admin_dashboard')
@section('admin')

@php

    $date = date('d-F-Y');
    $today_paid = App\Models\Order::where('order_date',$date)->sum('pay');

    $ordersByDate = App\Models\Order::select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as views'))
                    ->groupBy('date')
                    ->get();





    $total_paid = App\Models\order::sum('pay');
    $total_due = App\Models\order::sum('due');

    $completeorder = App\Models\order::where('order_status', 'complete')->get();
    $pendingorder = App\Models\order::where('order_status', 'pending')->get();
@endphp


    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <form class="d-flex align-items-center mb-3">
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control border-0" id="dash-daterange">
                                    <span class="input-group-text bg-blue border-blue text-white">
                                        <i class="mdi mdi-calendar-range"></i>
                                    </span>
                                </div>
                                <a href="javascript: void(0);" class="btn btn-blue btn-sm ms-2">
                                    <i class="mdi mdi-autorenew"></i>
                                </a>
                                <a href="javascript: void(0);" class="btn btn-blue btn-sm ms-1">
                                    <i class="mdi mdi-filter-variant"></i>
                                </a>
                            </form>
                        </div>
                        <h4 class="page-title">Dashboard</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-md-6 col-xl-3">
                    <div class="widget-rounded-circle card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="avatar-lg rounded-circle bg-primary border-primary border shadow">
                                        <i class="fe-heart font-22 avatar-title text-white"></i>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="text-end">
                                        <h3 class="text-dark mt-1">$<span data-plugin="counterup">{{$total_paid}}</span></h3>
                                        <p class="text-muted mb-1 text-truncate">Total Paid</p>
                                    </div>
                                </div>
                            </div> <!-- end row-->
                        </div>
                    </div> <!-- end widget-rounded-circle-->
                </div> <!-- end col-->

                <div class="col-md-6 col-xl-3">
                    <div class="widget-rounded-circle card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="avatar-lg rounded-circle bg-primary border-primary border shadow">
                                        <i class="fe-heart font-22 avatar-title text-white"></i>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="text-end">
                                        <h3 class="text-dark mt-1">$<span data-plugin="counterup">{{$total_due}}</span></h3>
                                        <p class="text-muted mb-1 text-truncate">Total Due</p>
                                    </div>
                                </div>
                            </div> <!-- end row-->
                        </div>
                    </div> <!-- end widget-rounded-circle-->
                </div> <!-- end col-->

                <div class="col-md-6 col-xl-3">
                    <div class="widget-rounded-circle card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="avatar-lg rounded-circle bg-info border-info border shadow">
                                        <i class="fe-bar-chart-line- font-22 avatar-title text-white"></i>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="text-end">
                                        <h3 class="text-dark mt-1"><span data-plugin="counterup">{{count($completeorder)}}</span></h3>
                                        <p class="text-muted mb-1 text-truncate">Completed Orders</p>
                                    </div>
                                </div>
                            </div> <!-- end row-->
                        </div>
                    </div> <!-- end widget-rounded-circle-->
                </div> <!-- end col-->

                <div class="col-md-6 col-xl-3">
                    <div class="widget-rounded-circle card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="avatar-lg rounded-circle bg-warning border-warning border shadow">
                                        <i class="fe-eye font-22 avatar-title text-white"></i>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="text-end">
                                        <h3 class="text-dark mt-1"><span data-plugin="counterup">{{count($pendingorder)}}</span></h3>
                                        <p class="text-muted mb-1 text-truncate">Pending Orders</p>
                                    </div>
                                </div>
                            </div> <!-- end row-->
                        </div>
                    </div> <!-- end widget-rounded-circle-->
                </div> <!-- end col-->
            </div>
            <!-- end row-->

            <div class="row">


                <div class="col-s-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-widgets">
                                <a href="javascript: void(0);" data-toggle="reload"><i class="mdi mdi-refresh"></i></a>
                                <a data-bs-toggle="collapse" href="#cardCollpase1" role="button" aria-expanded="false" aria-controls="cardCollpase1"><i class="mdi mdi-minus"></i></a>
                                <a href="javascript: void(0);" data-toggle="remove"><i class="mdi mdi-close"></i></a>
                            </div>
                               <div id="cardCollpase1" class="collapse show">


                                <h4 class="header-title mb-3">Sales Analytics</h4>

                                <div dir="ltr">
                                    <div id="sales-analytics" class="mt-4" data-colors="#1abc9c,#4a81d4"></div>
                                </div>
                            </div>


                               </div>
                            </div> <!-- collapsed end -->
                        </div> <!-- end card-body -->
                    </div> <!-- end card-->

{{-- @foreach ($ordersByDate as $item)
    {{$item->date}} <> {{$item->views}} ||
@endforeach --}}

<canvas id="myChart" height="100px"></canvas>



                </div>


            <!-- end row -->


            <!-- end row -->

        </div> <!-- container -->

    </div> <!-- content -->


    <body>

    </body>


</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>



    @endsection
