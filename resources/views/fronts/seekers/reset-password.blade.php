@extends('layouts.seeker')
@section('content')
<div class="page-title">{{trans('labels.reset_my_password')}}</div>
    <div class="border">
        @if(Session::has('sms'))
            <div class="row">
                <div class="col-sm-12">
                    <div class="alert alert-success border-radius-none" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        {{session('sms')}}
                    </div>
                </div>
            </div>
        @endif
        @if(Session::has('sms1'))
            <div class="row">
                <div class="col-sm-12">
                    <div class="alert alert-danger border-radius-none" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        {{session('sms1')}}
                    </div>
                </div>
            </div>
        @endif
        <form action="{{url('/seeker/save-password')}}" class="form-horizontal" method="post" accept-charset="UTF-8" role="form" onsubmit="check(event)" >
            <div class="form-group row">
                <label class="control-label col-sm-4">{{trans('labels.new_password')}} <span class="text-danger">*</span></label>
                <div class="col-sm-8">
                    <input type="password" id="password" name="password" class="form-control" required autofocus>
                    {{csrf_field()}}
                </div>
            </div>
            <div class="form-group row">
                <label class="control-label col-sm-4">{{trans('labels.confirm_password')}} <span class="text-danger">*</span></label>
                <div class="col-sm-8">
                    <input type="password" id="cpassword" name="cpassword" class="form-control" required> 
                </div>
            </div>
            <div class="form-group row">
                <label class="control-label col-sm-4">&nbsp;</label>
                <div class="col-sm-8">
                    <button class="btn btn-primary" type="submit">{{trans('labels.save_change')}}</button>
                </div>
            </div>
        </form>
<script charset="utf-8" type="text/javascript">
    function check(event)
    {
        var password = document.getElementById("password").value;
        var confirm_password = document.getElementById("cpassword").value;

        if( password != confirm_password) {
            document.getElementById("cpassword").style.border="1px solid red";
            event.preventDefault();
        } 

        if( password === confirm_password){
            document.getElementById("register").submit();
        }
    }
</script>
@endsection