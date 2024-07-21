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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Edit Advance Salary</a></li>

                        </ol>
                    </div>
                    <h4 class="page-title">Edit Advance Salary</h4>
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
                                <form method="post" action="{{ route('update.advance.salary')}}" >
                                    @csrf
                                    <input type="hidden" name="id" value="{{$salary->id}}">
                                    <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Add Advance Salary</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Select Employee</label>
                                                <select name = "employee_id" class="form-select @error('employee_id') is-invalid

                                                @enderror" id="example-select">
                                                <option selected disabled>Select employee </option>
                                                  @foreach ($employee as $item)
                                                            <option value ="{{$item->id}}" {{$item->id == $salary->employee_id ? 'selected':''}}>{{$item->name}}</option>
                                                  @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Salary Month</label>
                                                <select name = "month" class="form-select @error('month') is-invalid

                                                @enderror" id="example-select">

                                                    <option value ="january"{{ $salary->month == 'january' ? 'selected':''}}>january</option>
                                                    <option value ="february"{{ $salary->month == 'february' ? 'selected':''}}>february</option>
                                                    <option value ="march"{{ $salary->month == 'march' ? 'selected':''}}>march</option>
                                                    <option value ="april"{{ $salary->month == 'april' ? 'selected':''}}>april</option>
                                                    <option value ="may"{{ $salary->month == 'may' ? 'selected':''}}>may</option>
                                                    <option value ="june"{{ $salary->month == 'june' ? 'selected':''}}>june</option>
                                                    <option value ="july"{{ $salary->month == 'july' ? 'selected':''}}>july</option>
                                                    <option value ="august"{{ $salary->month == 'august' ? 'selected':''}}>august</option>
                                                    <option value ="september"{{ $salary->month == 'september' ? 'selected':''}}>september</option>
                                                    <option value ="october"{{ $salary->month == 'october' ? 'selected':''}}>october</option>
                                                    <option value ="november"{{ $salary->month == 'november' ? 'selected':''}}>november</option>
                                                    <option value ="december"{{ $salary->month == 'december' ? 'selected':''}}>december</option>
                                                </select>

                                                @error('month')
                                                <span class="text-danger"> {{ $message}}</span>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Salary Year</label>
                                                <select name = "year" class="form-select @error('year') is-invalid

                                                @enderror" id="example-select">
                                                <option selected disabled >Select Year </option>
                                                    <option value ="2023" {{ $salary->year == '2023' ? 'selected' : ''}}>2023</option>
                                                    <option value ="2024" {{ $salary->year == '2024' ? 'selected' : ''}}>2024</option>
                                                    <option value ="2025" {{ $salary->year == '2025' ? 'selected' : ''}}>2025</option>
                                                    <option value ="2026" {{ $salary->year == '2026' ? 'selected' : ''}}>2026</option>
                                                    <option value ="2027" {{ $salary->year == '2027' ? 'selected' : ''}}>2027</option>
                                                </select>

                                                @error('year')
                                                <span class="text-danger"> {{ $message}}</span>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Advance Salary</label>
                                                <input type="text" name="advance_salary" class="form-control @error('advance_salary') is-invalid

                                                @enderror" value="{{$salary->advance_salary }}">
                                                @error('advance_salary')
                                                <span class="text-danger"> {{ $message}}</span>
                                                @enderror
                                            </div>
                                        </div>





                                    <div class="text-end">
                                        <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i class="mdi mdi-content-save"></i> Save</button>
                                    </div>
                                </form>
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