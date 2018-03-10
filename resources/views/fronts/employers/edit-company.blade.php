@extends('layouts.employer')
@section('content')
    <div class="page-title">
        {{trans('labels.my_company')}}
    </div>
    <div class="border">
        @if(Session::has('sms1'))
            <div class="alert alert-danger" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div>
                    {{session('sms1')}}
                </div>
            </div>
        @endif
        <form 
            action="{{url('/employer/update_company')}}" 
            class="form-horizontal" 
            method="post"
            enctype="multipart/form-data"  
        >
            {{csrf_field()}}
            <input type="hidden" id="id" name="id" value="{{$company->id}}">
            <div class="form-group row">
                <label for="name" required class="control-label col-lg-2 col-sm-2">
                    {{trans('labels.name')}} <span class="text-danger">*</span>
                </label>
                <div class="col-lg-6 col-sm-8">
                    <input type="text" required autofocus name="name" id="name" class="form-control" value="{{$company->name}}">
                </div>
            </div>
            <div class="form-group row">
                <label for="address" class="control-label col-lg-2 col-sm-2">
                    {{trans('labels.address')}}
                </label>
                <div class="col-lg-6 col-sm-8">
                    <input type="text" name="address" id="address" class="form-control" value="{{$company->address}}">
                </div>
            </div>
            <div class="form-group row">
                <label for="contact_person" class="control-label col-lg-2 col-sm-2">
                    {{trans('labels.contact_person')}}
                </label>
                <div class="col-lg-6 col-sm-8">
                    <input type="text" name="contact_person" id="contact_person" class="form-control" value="{{$company->contact_person}}">
                </div>
            </div>
            <div class="form-group row">
                <label for="name" class="control-label col-lg-2 col-sm-2">
                    {{trans('labels.phone')}}
                </label>
                <div class="col-lg-6 col-sm-8">
                    <input type="text" name="phone" id="phone" class="form-control" value="{{$company->phone}}">
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="control-label col-lg-2 col-sm-2">
                    {{trans('labels.email')}}
                </label>
                <div class="col-lg-6 col-sm-8">
                    <input type="email" name="email" id="email" class="form-control" value="{{$company->email}}">
                </div>
            </div>
            <div class="form-group row">
                <label for="website" class="control-label col-lg-2 col-sm-2">
                    {{trans('labels.website')}}
                </label>
                <div class="col-lg-6 col-sm-8">
                    <input type="text" name="website" id="website" class="form-control" placeholder='www.example.com' value="{{$company->website}}">
                </div>
            </div>
            <div class="form-group row">
                <label for="description" class="control-label col-lg-2 col-sm-2">{{trans('labels.description')}}</label>
                <div class="col-lg-6 col-sm-8">
                    <textarea name="description" id="description" cols="30" rows="4" class="form-control">{!! $company->description !!}</textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="logo" class="control-label col-lg-2 col-sm-2">{{trans('labels.logo')}}</label>
                <div class="col-lg-6 col-sm-8">
                    <input type="file" name="logo" id="logo" accept="image/*" onchange="loadFile(event)" value="{{$company->logo}}">
                </div>
            </div>
            <div class="form-group row">
                <label for="img" class="control-label col-lg-2 col-sm-2"></label>
                <div class="col-lg-6 col-sm-8">
                    <img src="{{URL::asset('/company/').'/'.$company->logo}}" style="width: 110px;" id="img">
                </div>
            </div>
            <div class="form-group row">
                <label class="control-label col-lg-2 col-sm-2">&nbsp;</label>
                <div class="col-lg-6 col-sm-8">
                    <button class="btn btn-warning" type="submit">{{trans('labels.save_change')}}</button>
                    <a href="{{url('/employer/company')}}" class="btn btn-danger">{{trans('labels.cancel')}}</a>
                </div>
                
            </div>
        </form>
    </div>
<script>
    function loadFile(e){
        var output = document.getElementById('img');
        output.width = 110;
        output.src = URL.createObjectURL(e.target.files[0]);
    }
</script>
@endsection