@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-bold">
                    <i class="fa fa-align-justify"></i> Job List&nbsp;&nbsp;
                </div>
                <div class="card-block">

                    <table class="tbl">
                        <thead>
                            <tr>
                            <th>&numero;</th>
                            <th>Job Title</th>
                            <th>Category</th>
                            <th>Posting Date</th>
                            <th>Closing Date</th>
                            <th>Location</th>
                            <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($i=1)
                            @foreach($jobs as $job)
                                <tr>
                                <td>{{$job->id}}</td>
                                <td><a href="{{url('/joblist/detail/'.$job->id)}}">{{$job->job_title}}</a></td>
                                <td>{{$job->name}}</td></td>
                                <td>{{date_format(date_create($job->create_at), "Y-m-d" )}}</td>
                                <td>{{$job->closing_date}}</td>
                                <td>{{$job->location}}</td>
                                <td>
                                    <a href="{{url('/joblist/delete/'.$job->id)}}" onclick="return confirm('Do you want to delete?')" title="Delete"><i class="fa fa-remove text-danger"></i></a>
                                </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table><br>
                    {{ $jobs->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
