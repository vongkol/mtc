@extends('layouts.employer')
@section('content')
<div class="page-title" style="background: #FFECB3;">
      {{trans('labels.create_new_job')}}&nbsp;&nbsp;
        <a href="{{url('/employer/job')}}">< {{trans('labels.back_to_list')}}</a>
    </div>
    <div class="border" align="center">
            <h5>You don't have a company yet. Please create a new company before posting a job!</h5>
    </div>
@endsection