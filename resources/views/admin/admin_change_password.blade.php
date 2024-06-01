@extends('admin.admin_master')

@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 mx-auto">
                <div class="card">
                    <div class="card-body">
    
                        <h6 class="card-title text-center mb-4">Change Password </h6>

                        @if (count($errors))
                         @foreach ($errors->all() as $error )
                             <p class="alert alert-danger alert-dismissable fade show">{{ $error }}</p>
                         @endforeach
                            
                        @endif
    
                            <form method="POST" action="{{ route('admin.updatePassword') }}" >
                                 @csrf
    
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Old Password</label>
                                        <div class="col-sm-10">
                                            <input name="oldPassword" class="form-control" type="password" value=""  id="oldpassword">
                                        </div>
                                </div>
                                {{-- new Password --}}
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">New Password</label>
                                        <div class="col-sm-10">
                                            <input name="newPassword" class="form-control" type="password" value=""  id="newpassword">
                                        </div>
                                </div>
                                {{-- confirm password --}}
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Confirm Password</label>
                                        <div class="col-sm-10">
                                            <input name="confirmPassword" class="form-control" type="password" value=""  id="confirmpassword">
                                        </div>
                                </div>
                                
                                <!-- end row -->
                                    <input type="submit" class="btn btn-info waves-effect waves-light" value="change password">
                            </form>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div>

{{-- <script type="text/javascript">
    $(document).ready(function(){
        $('#image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        })
    })
</script> --}}
    
@endsection