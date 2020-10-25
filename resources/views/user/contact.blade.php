@extends('layouts.bootstrap_style')
@section('content')
<div class="col-md-7">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d488797.79019538197!2d95.90136685846338!3d16.839609802811214!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30c1949e223e196b%3A0x56fbd271f8080bb4!2sYangon!5e0!3m2!1sen!2smm!4v1592901687571!5m2!1sen!2smm" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
</div>
<div class="col-md-4">
    @foreach($errors->all() as $error)
        <div class="alert alert-danger">{{$error}}</div>
    @endforeach
    <form action="{{route('insert_contact')}}" method="post">
        @if(Session::has('success'))
        <div class="alert alert-success">
            {{Session::get('success')}}
        </div>
        @endif
        @csrf
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Your Name" name="name">
        </div>
        <div class="form-group">
            <input type="email" class="form-control" placeholder="Your Email" name="email"> 
        </div>
        <div class="form-group">
            <textarea class="form-group" rows="5" cols="68" placeholder="Your Message" name="message"></textarea>
        </div>
        <button type="submit" class="btn btn-info">Submit</button>
    </form>
</div>
@endsection