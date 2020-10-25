@extends('layouts.admin_style')
@section('content')
    <div class="col-md-2"></div>
    <div class="col-md-5">
        @if(Session::has('data'))
        {{Session::get('data')}}
        @endif
        @foreach($errors->all() as $error)
            <div class="alert alert-danger">{{$error}}</div>
        @endforeach
        <form action="{{url('contact_update/'.$data->id)}}" method="POST">
            @csrf
            <legend><strong>Contact Update</strong></legend>
            <input type="hidden" name="contact_id" value="{{ $data->id }}">
            <div class="form-group">
                <label for="">Name</label>
                <input type="text" class="form-control" name="contact_name" value="{{ $data->name }}">
            </div>
            <div class="form-group">
                <label for="">Email</label>
                <input type="email" class="form-control" name="contact_email" value="{{ $data->email }}">
            </div>
            <div class="form-group">
                <label for="">Message</label>
                <input type="text" class="form-control" name="contact_message" value="{{ $data->message }}">
            </div>
            <button type="submit" class="btn btn-info">Update</button>
        </form> <br>
        <a href="{{route('contact')}}"><button class="btn btn-warning" style="width: 70px;">Back</button></a>
    </div>
@endsection