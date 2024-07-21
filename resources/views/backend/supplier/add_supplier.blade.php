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

                    </div>
                    <h4 class="page-title">Add Supplier</h4>
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
                                <form method="post" action="{{ route('supplier.store')}}" enctype="multipart/form-data">
                                    @csrf


                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Supplier Name</label>
                                                <input type="text"  name="name" class="form-control @error('name') is-invalid

                                                @enderror">
                                                @error('name')
                                                <span class="text-danger"> {{ $message}}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="email"  name="email" class="form-control @error('email') is-invalid

                                                @enderror">
                                                @error('email')
                                                <span class="text-danger"> {{ $message}}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Phone</label>
                                                <input type="text" name="phone" class="form-control @error('phone') is-invalid

                                                @enderror">
                                                @error('phone')
                                                <span class="text-danger"> {{ $message}}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Address</label>
                                                <input type="text" name="address" class="form-control @error('address') is-invalid

                                                @enderror">
                                                @error('address')
                                                <span class="text-danger"> {{ $message}}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Shop Name</label>
                                                <input type="text" name="shopname" class="form-control @error('shopname') is-invalid

                                                @enderror">
                                                @error('shopname')
                                                <span class="text-danger"> {{ $message}}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Supplier Type    </label>
                                               <select name="type" class="form-select @error('type') is-invalid @enderror" id="example-select">
                                                        <option selected disabled >Select Type </option>
                                                        <option value="Distributor">Distributor </option>
                                                        <option value="Whole Seller">Whole Seller </option>
                                                    </select>
                                                     @error('type')
                                          <span class="text-danger"> {{ $message }} </span>
                                                @enderror

                                            </div>
                                        </div>

                                       <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Account holder</label>
                                                <input type="text" name="account_holder" class="form-control @error('account_holder') is-invalid

                                                @enderror">
                                                @error('account_holder')
                                                <span class="text-danger"> {{ $message}}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Account Number</label>
                                                <input type="text" name="account_number" class="form-control @error('account_number') is-invalid

                                                @enderror">
                                                @error('account_number')
                                                <span class="text-danger"> {{ $message}}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Bank Name</label>
                                                <input type="text" name="bank_name" class="form-control @error('bank_name') is-invalid

                                                @enderror">
                                                @error('bank_name')
                                                <span class="text-danger"> {{ $message}}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Bank Branch</label>
                                                <input type="text" name="bank_branch" class="form-control @error('bank_branch') is-invalid

                                                @enderror">
                                                @error('bank_branch')
                                                <span class="text-danger"> {{ $message}}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">City</label>
                                                <input type="text" name="city" class="form-control @error('city') is-invalid

                                                @enderror">
                                                @error('city')
                                                <span class="text-danger"> {{ $message}}</span>
                                                @enderror
                                            </div>
                                        </div>


                                    <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="example-fileinput" class="form-label">Image</label>
                                        <input type="file" name="image" id="image" class="form-control @error('city') is-invalid

                                        @enderror">
                                        @error('image')
                                        <span class="text-danger"> {{ $message}}</span>
                                        @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                    <img id ="showImage" src="{{ url('upload/no_image.jpg')}}" class="rounded-circle avatar-lg img-thumbnail"
                                alt="profile-image">
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


<script type="text/javascript">

	$(document).ready(function(){
		$('#image').change(function(e){
			var reader = new FileReader();
			reader.onload =  function(e){
				$('#showImage').attr('src',e.target.result);
			}
			reader.readAsDataURL(e.target.files['0']);
		});
	});
</script>

@endsection