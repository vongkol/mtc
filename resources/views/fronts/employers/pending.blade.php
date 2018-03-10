@extends('layouts.employer')
@section('content')
    <div class="page-title" style="background: #FFECB3;">
        {{trans('labels.create_new_job')}}&nbsp;&nbsp;
        <a href="{{url('/employer/job')}}"> < {{trans('labels.back_to_list')}}</a>
    </div>
    <div class="border">
        <div class="col-sm-12" align="center">
            <h5>Your subscription is in pending mode, please wait the administrator to approve!</h5>
        </div>
    </div>
@endsection