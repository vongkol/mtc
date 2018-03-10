@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-bold">
                    <i class="fa fa-align-justify"></i> Cooperated Company List&nbsp;&nbsp;
                    <a href="{{url('/com/create')}}" class="btn btn-link btn-sm">New</a>
                </div>
                <div class="card-block">

                    <table class="tbl">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Contact Person</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Website</th>
                            <th>Logo</th>
                            <th>Owner</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($companies as $com)
                            <tr>
                                <td>{{$com->id}}</td>
                                <td>{{$com->name}}</td>
                                <td>{{$com->address}}</td>
                                <td>{{$com->contact_person}}</td>
                                <td>{{$com->phone}}</td>
                                <td>{{$com->email}}</td>
                                <td>{{$com->website}}</td>
                                <td><img src="{{asset('company/'. $com->logo)}}" alt="" width="45"></td>
                                <td>{{$com->first_name . ' ' . $com->last_name}}</td>
                                <td>
                                    <a href="{{url('/com/edit/'.$com->id)}}" title="Edit"><i class="fa fa-edit text-success"></i></a>&nbsp;&nbsp;
                                    <a href="{{url('/com/delete/'.$com->id)}}" onclick="return confirm('Do you want to delete?')" title="Delete"><i class="fa fa-remove text-danger"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table><br>
                    {{ $companies->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection