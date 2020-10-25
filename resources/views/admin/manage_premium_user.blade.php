@extends('layouts.admin_style')
@section('content')
    <div class="col-md-2"></div>
    <div class="col-md-6">
        @if(Session::has('delete_user_info'))
            <div class="alert alert-success">{{Session::get('delete_user_info')}}</div>
        @endif
        @if(Session::has('update_premium_user_success'))
            <div class="alert alert-success">{{Session::get('update_premium_user_success')}}</div>
        @endif
        <table class="table table-striped"> 
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Admin</th>
                    <th>Premium</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            @foreach($data as $item)
                <tbody>
                    <tr>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->isAdmin }}</td>
                        <td>{{ $item->isPremium }}</td>
                        <td>
                            <a href="{{ url('update_user_info/'.$item->id) }}"><button type="button" class="btn btn-info">Update</button></a>
                        </td>
                        <td>
                            <a href="{{ url('delete_user_info/'.$item->id) }}"><button type="button" class="btn btn-danger">Delete</button></a>
                        </td>
                    </tr>
                </tbody>
            @endforeach
        </table>
    </div>
@endsection