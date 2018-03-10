@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-bold">
                    <i class="fa fa-align-justify"></i> Employer List&nbsp;&nbsp;
                    <a href="{{url('/provider/create')}}" class="btn btn-link btn-sm">New</a>
                    <div class="col-sm-4 col-lg-4 pull-right">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder='Search...'>
                            <input class="input-group-addon" type="submit" id="search" value="Search">
                        </div>
                    </div>
                </div>
                <div class="card-block">

                    <table class="tbl">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Company</th>
                            <th>Gender</th>
                            <th>Date of Birth</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Username</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($employers as $emp)
                            <tr>
                                <td>{{$emp->id}}</td>
                                <td>{{$emp->first_name}}</td>
                                <td>{{$emp->last_name}}</td>
                                <td>{{$emp->company_name}}</td>
                                <td>{{$emp->gender}}</td>
                                <td>{{$emp->dob}}</td>
                                <td>{{$emp->phone}}</td>
                                <td>{{$emp->email}}</td>
                                <td>{{$emp->username}}</td>
                                <td>
                                    <a href="{{url('/provider/edit/'.$emp->id)}}" title="Edit"><i class="fa fa-edit text-success"></i></a>&nbsp;&nbsp;
                                    <a href="{{url('/provider/delete/'.$emp->id)}}" onclick="return confirm('Do you want to delete?')" title="Delete"><i class="fa fa-remove text-danger"></i></a>
                                </td>
                            </tr>
                        @endforeach
                            <tr>
                                <td colspan="9">
                                    Total: {{$total}}, Male: {{$male}}, Female: {{$female}}
                                </td>
                            </tr>
                        </tbody>
                    </table><br>
                    {{ $employers->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection