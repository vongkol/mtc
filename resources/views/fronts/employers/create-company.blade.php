@extends('layouts.employer')
@section('content')
    <div class="page-title" style="background: #FFECB3;">
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
                    action="{{url('/employer/save_company')}}" 
                    class="form-horizontal" 
                    method="post"
                    enctype="multipart/form-data"  
                >
                    {{csrf_field()}}
                    <div class="form-group row">
                        <label for="name" required class="control-label col-lg-2 col-sm-2">
                            {{trans('labels.name')}} <span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-6 col-sm-8">
                            <input type="text" required autofocus name="name" id="name" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="address" class="control-label col-lg-2 col-sm-2">
                            {{trans('labels.address')}}
                        </label>
                        <div class="col-lg-6 col-sm-8">
                            <input type="text" name="address" id="address" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="contact_person" class="control-label col-lg-2 col-sm-2">
                            {{trans('labels.contact_person')}}
                        </label>
                        <div class="col-lg-6 col-sm-8">
                            <input type="text" name="contact_person" id="contact_person" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="control-label col-lg-2 col-sm-2">
                            {{trans('labels.phone')}}
                        </label>
                        <div class="col-lg-6 col-sm-8">
                            <input type="text" name="phone" id="phone" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="control-label col-lg-2 col-sm-2">
                            {{trans('labels.email')}}
                        </label>
                        <div class="col-lg-6 col-sm-8">
                            <input type="email" name="email" id="email" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="website" class="control-label col-lg-2 col-sm-2">
                            {{trans('labels.website')}}
                        </label>
                        <div class="col-lg-6 col-sm-8">
                            <input type="text" name="website" id="website" class="form-control" placeholder='www.example.com'>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="description" class="control-label col-lg-2 col-sm-2">{{trans('labels.description')}}</label>
                        <div class="col-lg-6 col-sm-8">
                            <textarea name="description" id="description" cols="30" rows="4" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="logo" class="control-label col-lg-2 col-sm-2">{{trans('labels.logo')}}</label>
                        <div class="col-lg-6 col-sm-8">
                            <input type="file" name="logo" id="logo" accept="image/*" onchange="loadFile(event)">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="contact" class="control-label col-lg-2 col-sm-2"></label>
                        <div class="col-lg-6 col-sm-8">
                            <img src="" id="img"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-lg-2 col-sm-2">&nbsp;</label>
                        <div class="col-lg-6 col-sm-8">
                            <button class="btn btn-warning" type="submit">{{trans('labels.save')}}</button>
                            <button class="btn btn-danger" type="reset">{{trans('labels.cancel')}}</button>
                        </div>
                    </div>
                </form>
            </div>
                </div>
            </div>
        </div>
    </div>
<script>
    function loadFile(e){
        var output = document.getElementById('img');
        output.width = 150;
        output.src = URL.createObjectURL(e.target.files[0]);
    }
</script>
@endsection