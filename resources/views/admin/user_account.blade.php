@extends('layouts.admin_style')
@section('content')
    <div class="col-md-2"></div>
    <div class="col-md-6">
        <table class="table table-striped"> 
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>John</td>
                    <td>Doe</td>
                    <td>
                        <button type="button" class="btn btn-info">Update</button>
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger">Delete</button>
                    </td>
                </tr>
                <tr>
                    <td>Mary</td>
                    <td>Moe</td>
                    <td>
                        <button type="button" class="btn btn-info">Update</button>
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger">Delete</button>
                    </td>
                </tr>
                <tr>
                    <td>July</td>
                    <td>Dooley</td>
                    <td>
                        <button type="button" class="btn btn-info">Update</button>
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection