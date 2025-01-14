@extends('admin_dashboard')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<div class="content">

    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <a href="{{ route('all.product')}}" class="btn btn-primary rounded-pill waves-effect waves-light">Back</a>
                        </ol>
                    </div>
                    <h4 class="page-title">Barcode Product</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-body">
                            <!-- end about me section content -->

                            <div class="tab-pane" id="settings">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="firstname" class="form-label">Product Code</label>
                                                <h3> {{$product->product_code}}</h3>
                                            </div>
                                        </div>
                                @php

                                $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
                                @endphp
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="firstname" class="form-label">Product Barcode</label>
                                                <h3> {!! $generator->getBarcode($product->product_code, $generator::TYPE_CODE_128) !!}</h3>
                                          </div>
                                        </div>


                            </div>


                            <!-- end settings content-->

                        <!-- end tab-content -->
                    </div>
                </div> <!-- end card-->

            </div> <!-- end col -->
        </div>
        <!-- end row-->

    </div> <!-- container -->

</div> <!-- content -->



@endsection
