@extends('layouts.bootstrap_style')
@section('content')
    <div class="container">
       <div class="col-md-7">
           @foreach($errors->all() as $error)
                <div class="alert alert-danger">{{$error}}</div>
           @endforeach
            <form action="{{route('update_account')}}" method="POST">
            @csrf
            @if(Session::has('success'))
                <div class="alert alert-success">
                    <strong>{{Session::get('success')}}</strong>
                </div>
            @endif
            @if(Session::has('update'))
                <div class="alert alert-success">
                    <strong>{{Session::get('update')}}</strong>
                </div>
            @endif
            @if(Session::has('password'))
                <div class="alert alert-danger">
                    <strong>{{Session::get('password')}}</strong>
                </div>
            @endif
            @if(Session::has('Pass_change'))
                <div class="alert alert-success">
                    <strong>{{Session::get('Pass_change')}}</strong>
                </div>
            @endif
                <legend>User Account</legend>
                <input type="hidden" name="id" value="{{$data->id}}">
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Your Name" value="{{$data->name}}">
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="email" class="form-control" name="email" placeholder="Your Email" value="{{$data->email}}">
                </div>
                <a href="#" data-toggle="modal" data-target="#mypassword">Change Password</a> <br> <br>
                <button type="submit" class="btn btn-info">Change Account Info</button>
            </form>
       </div>
       <div class="col-md-3">

       </div>
       <div class="col-md-2">
            <!-- Button to Open the Modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
            Add News
            </button>

            <!-- The Modal -->
            <div class="modal" id="myModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Create News</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <!-- Modal body -->
                        <div class="modal-body">
                            <form action="{{route('insert_news')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <legend>User Account</legend>
                                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                <div class="form-group">
                                    <label for="">Title</label>
                                    <input type="text" class="form-control"  placeholder="Your title" name="title">
                                </div>
                                <div class="form-group">
                                    <label for="">Photo</label>
                                    <input type="file" class="form-control" placeholder="Your photo" name="photo">
                                </div>
                                <div class="form-group">
                                    <label for="">Contact</label>
                                    <input type="text" class="form-control" placeholder="Your contact" name="content">
                                </div>
                                <button type="submit" class="btn btn-info">Create</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
       </div>
       <!-- for change password -->
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
                            <form action="{{route('change_password')}}" method="POST">
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