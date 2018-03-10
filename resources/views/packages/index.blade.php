@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-bold">
                    <i class="fa fa-align-justify"></i> Package List&nbsp;&nbsp;
                    <a href="{{url('/package/create')}}" class="btn btn-link btn-sm">New</a>
                </div>
                <div class="card-block">

                    <table class="tbl">
                        <thead>
                        <tr>
                            <th>&numero;</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Type</th>
                            <th>Number of Job</th>
                            <th>Number of Day</th>
                            <th>Download</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php($i=1)
                        @foreach($packages as $pac)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$pac->name}}</td>
                                <td>{{$pac->price}}</td>
                                <td>{{$pac->type}}</td>
                                <td>{{$pac->job_number}}</td>
                                <td>{{$pac->day_number}}</td>
                                <td>{{$pac->download}}</td>
                                <td>
                                    <a href="{{url('/package/edit/'.$pac->id)}}" title="Edit"><i class="fa fa-edit text-success"></i></a>&nbsp;&nbsp;
                                    <a href="{{url('/package/delete/'.$pac->id)}}" onclick="return confirm('Do you want to delete?')" title="Delete"><i class="fa fa-remove text-danger"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table><br>
                </div>
            </div>
        </div>
        <!--/.col-->
    </div>
@endsection