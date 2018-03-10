@extends('layouts.front')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="page-title" style="background: #FFECB3;">{{trans('labels.set_new_password')}}</div>
        <div class="border">
            <form action="{{url('/service/update1')}}" id="register" class="form-horizontal" method="post" onsubmit="check(event)">
                {{csrf_field()}}
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
                <div class="form-group row">
                    <label class="control-label col-sm-3">{{trans('labels.new_password')}} <span class="text-danger">*</span></label>
                    <div class="col-sm-6">
                        <input type="password" id="password" name="password" class="form-control" required autofocus>
                        <input type="hidden" id="id" name="id" value="{{$id}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-sm-3">{{trans('labels.confirm_password')}} <span class="text-danger">*</span></label>
                    <div class="col-sm-6">
                        <input type="password" id="cpassword" name="cpassword" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-sm-3">&nbsp;</label>
                    <div class="col-sm-6">
                        <button class="btn btn-warning" type="submit">{{trans('labels.submit')}}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div><br>    
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