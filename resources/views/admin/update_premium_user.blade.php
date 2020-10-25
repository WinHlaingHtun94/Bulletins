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
        @if(Session::has('validation_error'))
            <div class="alert alert-danger">{{Session::get('validation_error')}}</div>
        @endif
        <form action="{{ route('update_premium_user_info') }}" method="POST">
            @csrf
            <legend><strong>Update Premium Info</strong></legend>
            <input type="hidden" name="id" value="{{ $data->id }}">
            <div class="form-group">
                <label for="">Name</label>
                <input type="text" class="form-control" name="name" value="{{ $data->name }}">
            </div>
            <div class="form-group">
                <label for="">Email</label>
                <input type="email" class="form-control" name="email" value="{{ $data->email }}">
            </div>
            <div class="form-group">
                <label for="">isAdmin</label>
                <input type="text" class="form-control" name="Admin" value="{{ $data->isAdmin }}">
            </div>
            <div class="form-group">
                <label for="">isPremium</label>
                <input type="text" class="form-control" name="Premium" value="{{ $data->isPremium }}">
            </div>
            <button type="submit" class="btn btn-info">Update</button>
        </form> <br>
        <a href="{{ route('manage_premium') }}"><button class="btn btn-warning" style="width: 70px;">Back</button></a>
    </div>
@endsection