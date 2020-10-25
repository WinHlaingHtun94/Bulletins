@extends('layouts.admin_style')
@section('content')
    <div class="col-md-2"></div>
        <div class="col-md-5">
            @foreach($errors->all() as $error)
                <div class="alert alert-danger">{{$error}}</div>
            @endforeach
            @if(Session::has('success'))
                <div class="alert alert-success">{{ Session::get('success') }}</div>
            @endif
            @if(Session::has('check'))
                <div class="alert alert-danger">{{ Session::get('check') }}</div>
            @endif
            @if(Session::has('pass_length'))
                <div class="alert alert-danger">{{ Session::get('pass_length') }}</div>
            @endif
            @if(Session::has('pass_check'))
                <div class="alert alert-danger">{{ Session::get('pass_check') }}</div>
            @endif
            @if(Session::has('change_success'))
                <div class="alert alert-success">{{ Session::get('change_success') }}</div>
            @endif
            <form action="{{ route('update_admin_profile') }}" method="POST">
                @csrf
                <legend>User Account</legend>
                <input type="hidden" name="user_id" value="{{ $data->id }}">
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" class="form-control" name="user_name" placeholder="Your Name" value="{{ $data->name }}">
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="email" class="form-control" name="user_email" placeholder="Your Email" value="{{ $data->email }}">
                </div>
                <a href="#" data-toggle="modal" data-target="#mypassword">Change Password</a> <br> <br>
                <button type="submit" class="btn btn-info">Update</button>
            </form>
       </div>
       <div class="modal" id="mypassword">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Change Password</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <!-- Modal body -->
                        <div class="modal-body">
                            <form action="{{ route('admin_profile_password_change') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="">Old Password</label>
                                    <input type="password" class="form-control" name="old_password" placeholder="Your old password">
                                </div>
                                <div class="form-group">
                                    <label for="">New Password</label>
                                    <input type="password" class="form-control" name="new_password" placeholder="Your new password">
                                </div>
                                <div class="form-group">
                                    <label for="">Confirm Password</label>
                                    <input type="password" class="form-control" name="confirm_password" placeholder="Your confirm password">
                                </div>
                                <button type="submit" class="btn btn-info">Change</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
       <!-- end change password -->
    </div>
@endsection