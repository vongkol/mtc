@extends('layouts.employer')
@section('content')
    <div class="page-title" style="background: #FFECB3;">
        {{trans('labels.manage_my_profile')}}
    </div>
    <div class="border">
        @if(Session::has('sms1'))
            <div class="row">
                <div class="col-sm-12">
                    <div class="alert alert-danger" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        {{session('sms1')}}
                    </div>
                </div>
            </div>
        @endif
        <form name="frm" action="{{url('/employer/update')}}" method="post" class="from-horizontal" onsubmit="return confirm('You want to save changes?')">
            {{csrf_field()}}
            <input type="hidden" name="id" value="{{$employer->id}}">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="form-group row">
                        <label for="first_name" class="control-label col-sm-4">{{trans('labels.first_name')}} <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" required name="first_name" id="first_name" value="{{$employer->first_name}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="last_name" class="control-label col-sm-4">{{trans('labels.last_name')}} <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="last_name" name="last_name" required value="{{$employer->last_name}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="gender" class="control-label col-sm-4">{{trans('labels.gender')}} <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <select name="gender" id="gender" class="form-control">
                                <option value="Male" {{$employer->gender=='Male'?'selected':''}}>{{trans('labels.male')}}</option>
                                <option value="Female"  {{$employer->gender=='Female'?'selected':''}}>{{trans('labels.female')}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="dob" class="control-label col-sm-4">{{trans('labels.dob')}}</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="dob" name="dob" 
                             value="{{$employer->dob}}" placeholder="{{trans('labels.dd')}}">
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group row">
                        <label for="phone" class="control-label col-sm-4">{{trans('labels.phone')}} <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="phone" required name="phone" value="{{$employer->phone}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="control-label col-sm-4">{{trans('labels.email')}} <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <input type="email" class="form-control" id="email" required name="email" value="{{$employer->email}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="username" class="control-label col-sm-4">{{trans('labels.username')}} <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="username" required name="username" value="{{$employer->username}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-4">&nbsp;</label>
                        <div class="col-sm-8">
                            <button type="submit" class="btn btn-warning">{{trans('labels.save_change')}}</button>
                            <a href="{{url('/employer')}}" class="btn btn-danger">{{trans('labels.cancel')}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function(){
            $("#dob").inputmask('99/99/9999');
        });
    </script>
@endsection