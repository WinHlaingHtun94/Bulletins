@extends('layouts.bootstrap_style')

@section('content')
<div class="container">
    <div class="col-md-5">
        @if(Session::has('update'))
            <div class="alert alert-success">{{Session::get('update')}}</div>
        @endif
        @foreach($errors->all() as $error)
            <div class="alert alert-danger">{{$error}}</div>
        @endforeach
        <img src="{{asset('photos/'.$data[0]->photo)}}" width="100%" height="auto" style="margin-top: 20px;">
    </div>
    <div class="col-md-5">
        <h1><strong>{{$data[0]->title}}</strong></h1>
        <h3>( Posted by {{ $data[0]-> name}} )</h3>
        <legend></legend>
        <p style="font-size:20px; text-align:justify;">{{$data[0]->content}}</p>
    </div>
    <div class="col-md-1">
        <a href="#"><button class="btn btn-info" style="width: 90px; font-size: 20px;" data-toggle="modal" data-target="#myedit">Edit</button></a> <br> <br>
        <a href="#"><button class="btn btn-danger" style="width: 90px; font-size: 20px;" data-toggle="modal" data-target="#mydelete">Delete</button></a> <br> <br>
        <a href="{{route('user_homepage')}}"><button class="btn btn-warning" style="width: 90px; font-size: 20px;">Back</button></a> <br> <br>
    </div>
    <!-- for delete_info -->
    <div class="modal" id="mydelete" style="margin:0 auto; padding:0 auto; width:250px;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Are You Sure!</h4>
                            <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                        </div>
                        <!-- Modal body -->
                        <div class="modal-body">
                           <a href="{{url('delete_info/'.$data[0]->id)}}"><button class="btn btn-primary" style="width: 100px; font-size: 20px;">Yes</button></a>
                           <button class="btn btn-success" style="width: 100px; font-size: 20px;" data-dismiss="modal">No</button>
                        </div>
                    </div>
                </div>
    </div>
    <!-- end delete info -->
     <!-- for edit info -->
     <div class="modal" id="myedit">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header" >
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <img src="{{asset('photos/'.$data[0]->photo)}}" style="width: 98%; height:auto; margin:10px;">   
                        </div>
                        <!-- Modal body -->
                        <div class="modal-body">
                            <form action="{{route('edit_info')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $data[0]->id}}">
                                <div class="form-group">
                                    <label for="">Title</label>
                                    <input type="text" class="form-control" value="{{ $data[0]->title }} " name="title">
                                </div>
                                <div class="form-group">
                                    <label for="">Photo</label>
                                    <input type="file" class="form-control" value="{{ $data[0]->photo }}" name="photo">
                                </div>
                                <div class="form-group">
                                    <label for="">Content</label>
                                    <input type="text" class="form-control" value="{{ $data[0]->content }}" name="content">
                                </div>
                                <button type="submit" class="btn btn-info">Change</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
       <!-- end edit info -->
</div>
@endsection