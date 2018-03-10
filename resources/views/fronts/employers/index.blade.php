@extends('layouts.employer')
@section('content')
    <div class="page-title" style="background: #FFECB3;">
        {{trans('labels.manage_my_profile')}}
    </div>
    <div class="border">
        <div class="row">
        @if(Session::has('sms'))
            <div class="row">
                <div class="col-sm-12">
                    <div class="alert alert-success" role="alert">
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
                    <div class="alert alert-danger" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        {{session('sms1')}}
                    </div>
                </div>
            </div>
        @endif
        <div class="col-md-6 col-sm-12">
            <div class="form-group row">
                <label for="first_name" class="control-label col-sm-4">{{trans('labels.first_name')}}</label>
                <div class="col-sm-8">
                    <p id="first_name">{{session('employer')->first_name}}</p>
                </div>
            </div>
            <div class="form-group row">
                <label for="last_name" class="control-label col-sm-4">{{trans('labels.last_name')}}</label>
                <div class="col-sm-8">
                    <p id="last_name">{{session('employer')->last_name}}</p>
                </div>
            </div>
            <div class="form-group row">
                <label for="gender" class="control-label col-sm-4">{{trans('labels.gender')}}</label>
                <div class="col-sm-8">
                    <p id="gender">{{session('employer')->gender}}</p>
                </div>
            </div>
            <div class="form-group row">
                <label for="dob" class="control-label col-sm-4">{{trans('labels.dob')}}</label>
                <div class="col-sm-8">
                    <p id="dob">{{session('employer')->dob}}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-12">
            <div class="form-group row">
                <label for="phone" class="control-label col-sm-4">{{trans('labels.phone')}}</label>
                <div class="col-sm-8">
                    <p id="phone">{{session('employer')->phone}}</p>
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="control-label col-sm-4">{{trans('labels.email')}}</label>
                <div class="col-sm-8">
                    <p id="email">{{session('employer')->email}}</p>
                </div>
            </div>
            <div class="form-group row">
                <label for="username" class="control-label col-sm-4">{{trans('labels.username')}}</label>
                <div class="col-sm-8">
                    <p id="username">{{session('employer')->username}}</p>
                </div>
            </div>
            <div class="form-group row">
                <label class="control-label col-sm-4">&nbsp;</label>
                <div class="col-sm-7">
                    <a href="{{url('/employer/edit/profile')}}" class="btn btn-warning border-radius-none">{{trans('labels.edit_profile')}}</a>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection