@extends('admin_dashboard')
@section('admin')


<div class="content">

    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        @if(Auth::user()->can('add.employee'))
                        <ol class="breadcrumb m-0">
                            <a href="{{ route('add.employee')}}" class="btn btn-primary rounded-pill waves-effect waves-light">Add Employee</a>
                        </ol>
                        @endif
                    </div>
                    <h4 class="page-title">All Employees</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">All Employee</h4>

                        <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Salary</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($employee as $key=>$item)


                    <tr>
                        <td>{{$key+1}}</td>
                        <td><a id="photobutton" href="{{ asset($item->image)}}"
                            data-toggle="modal"
        data-target="#photoModal">

                            <img src="{{ asset($item->image)}}" style="width:50px; height: 40px;"></a></td>
                        <td>{{$item->name}}</td>
                        <td>{{ $item->email}}</td>
                        <td>{{$item->phone}}</td>
                        <td>{{$item->salary}}</td>
                        <td>

                            @if(Auth::user()->can('employee.edit'))
                            <a href="{{ route('edit.employee', $item->id)}}" class="btn btn-blue rounded-pill waves-effect waves-light">Edit</a>
                           @endif
                            @if(Auth::user()->can('employee.delete'))
                            <a href="{{ route('delete.employee', $item->id)}}"id="delete" class="btn btn-danger rounded-pill waves-effect waves-light">Delete</a>
                            @endif
                        </td>
                    </tr>

                                @endforeach
                            </tbody>
                        </table>

                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>

        <!-- end row-->

    </div> <!-- container -->

</div> <!-- content -->

<div class="modal fade" id="photoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">PHOTO</h5>
          <button type="button" class="close btn btn-danger" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <img id="pic" src="" alt="" width="100%" height="100%">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <script src=
  "https://code.jquery.com/jquery-3.3.1.slim.min.js"
          integrity=
  "sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
          crossorigin="anonymous">
      </script>
      <script src=
  "https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
          integrity=
  "sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
          crossorigin="anonymous">
      </script>
      <script src=
  "https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
          integrity=
  "sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
          crossorigin="anonymous">
      </script>

  <script type="text/javascript">

    $('document').ready(function(){

        $('.table #photobutton').on('click', function (event){
             event.preventDefault();
            var href = $(this).attr('href');
            $('#photoModal #pic').attr('src', href);
            $('#photoModal').modal();
        })
    })

  </script>
@endsection
