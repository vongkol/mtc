@extends('layouts.employer')
@section('content')
<div class="page-title" style="background: #FFECB3;">
        {{trans('labels.job_detail')}}&nbsp;&nbsp;
        <a href="{{url('/employer/job')}}"> < {{trans('labels.back_to_list')}}</a>
    </div>
    <div class="border">
        <div class="applications-content">
            <form action="#" method="post">
                <div class="row">
                    <div class="col-sm-2">
                        <p>{{trans('labels.job_title')}}:</p>
                    </div>
                    <div class="col-sm-4">
                        <b>{{$job->job_title}}</b>
                    </div>
                    <div class="col-sm-2">
                        <p>{{trans('labels.category')}}:</p>
                    </div>
                    <div class="col-sm-4">
                        <b>{{$job->name}}</b>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-2">
                        <p>{{trans('labels.job_type')}}:</p>
                    </div>
                    <div class="col-sm-4">
                        <b>{{$job->job_type}}</b>
                    </div>
        
                    <div class="col-sm-2">
                        <p>{{trans('labels.location')}}:</p>
                    </div>
                    <div class="col-sm-4">
                        <b>{{$job->location}}</b>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-2">
                        <p>{{trans('labels.posting_date')}}:</p>
                    </div>
                    <div class="col-sm-4">
                        <b>{{date_format(date_create($job->create_at), "Y-m-d" )}}</b>
                    </div>
                
                    <div class="col-sm-2">
                        <p>{{trans('labels.closing_date')}}:</p>
                    </div>
                    <div class="col-sm-4">
                        <b>{{$job->closing_date}}</b>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-2">
                        <p>{{trans('labels.gender')}}:</p>
                    </div>
                    <div class="col-sm-4">
                        <b>{{$job->gender}}</b>
                    </div>
                    <div class="col-sm-2">
                        <p>{{trans('labels.hiring')}}:</p>
                    </div>
                    <div class="col-sm-4">
                        <b>{{$job->hire}}</b>
                    </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <b>{{trans('labels.job_description')}}</b>
                        <div>
                            {!! $job->description !!}
                        </div>
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-sm-12">
                        <b>{{trans('labels.job_requirement')}}</b>
                       <div>{!! $job->requirement !!}</div>
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-sm-8">
                        <a href="{{url('/employer/job/edit/'.$job->id)}}" class="btn btn-warning">{{trans('labels.edit')}}</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{asset('js/jquery.inputmask.bundle.min.js')}}"></script>
    <script src="{{asset('js/ckeditor/ckeditor.js')}}"></script>
    <script>
        $(document).ready(function () {
            $("#closing_date").inputmask('9999-99-99');
            CKEDITOR.replace('description');
            CKEDITOR.replace('requirement');
        });
    </script>
@endsection