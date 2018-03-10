@extends('layouts.front')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="page-title" style="background: #FFECB3;">{{trans('labels.recovery_password')}}</div>
        <div class="border">
            <h5 align="center">
                {{trans('labels.please_check')}}
            </h5>
            <p class="text-center">
                <a href="{{url('/')}}" class="btn btn-warning">{{trans('labels.back_home')}}</a>
            </p>
        </div>
    </div>
</div><br>        
@endsection