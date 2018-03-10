@extends('layouts.employer')
@section('content')
    <div class="page-title" style="background: #FFECB3;">
       {{trans('labels.my_job')}}&nbsp;&nbsp;
        <a href="{{url('/employer/job/create')}}" class="btn btn-warning btn-sm">{{trans('labels.post_new_job')}}</a>
    </div>
    <div class="panel-body">
        <div class="applications-content">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>&numero;</th>
                    <th>{{trans('labels.job_title')}}</th>
                    <th>{{trans('labels.posting_date')}}</th>
                    <th>{{trans('labels.closing_date')}}</th>
                    <th>{{trans('labels.category')}}</th>
                    <th>{{trans('labels.location')}}</th>
                    <th>{{trans('labels.action')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($jobs as $job)
                    <tr>
                        <td>{{$job->id}}</td>
                        <td><a href="{{url('/employer/job/detail/'.$job->id)}}">{{$job->job_title}}</a></td>
                        <td>{{date_format(date_create($job->create_at), "Y-m-d" )}}</td>
                        <td>{{$job->closing_date}}</td>
                        <td>{{$job->name}}</td>
                        <td>{{$job->location}}</td>
                        <td>
                            <a class="btn btn-sm btn-success" href="{{url('/employer/job/edit/'.$job->id)}}" title="Edit">Edit</a>&nbsp;&nbsp;
                            <a class="btn btn-sm btn-danger" href="{{url('/employer/job/delete/'.$job->id)}}" onclick="return confirm('Do you want to delete?')" title="Delete">Delete</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection