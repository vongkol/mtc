@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-bold">
                    <i class="fa fa-align-justify"></i> Job Type List&nbsp;&nbsp;
                    <a href="{{url('/job_type/create')}}" class="btn btn-link btn-sm">New</a>
                </div>
                <div class="card-block">

                   <table class="tbl">
                        <thead>
                            <tr>
                                <th>&numero;</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($i=1)
                            @foreach($job_types as $job)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$job->name}}</td>
                                    <td>
                                        <a href="{{url('/job_type/edit/'.$job->id)}}" title="Edit"><i class="fa fa-edit text-success"></i></a>&nbsp;&nbsp;
                                        <a href="{{url('/job_type/delete/'.$job->id)}}" onclick="return confirm('Do you want to delete?')" title="Delete"><i class="fa fa-remove text-danger"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table><br>
                    {{ $job_types->links() }}
                </div>
            </div>
        </div>
        <!--/.col-->
    </div>
@endsection