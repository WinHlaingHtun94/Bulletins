@extends('layouts.bootstrap_style')

@section('content')
<div class="jumbotron text-center">
  <h1>HOME PAGE</h1>
</div>

<div class="container">
  @if(Session::has('delete'))
    <div class="alert alert-success">{{Session::get('delete')}}</div>
  @endif
  @if(Session::has('admin_error'))
    <div class="alert alert-danger">{{Session::get('admin_error')}}</div>
  @endif
  @if(Session::has('Premium_check'))
    <div class="alert alert-danger">{{ Session::get('Premium_check') }}</div>
  @endif
  <div class="row">
    @foreach($data as $item)
      <div class="col-sm-4">
        <img src="{{asset('photos/'.$item->photo)}}" width="300" height="250" style="margin-top:30px">
        <h3>{{$item->title}}</h3>
        <!-- <p>{{$item->content}}</p> -->
        <a href="{{url('look_content/'.$item->id)}}"><button type="button" class="btn btn-info">See more....</button></a>
      </div>
    @endforeach
  </div>
  <br> <br>  <br>
</div>
@endsection