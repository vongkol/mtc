@extends('layouts.employer')
@section('content')
    <div class="page-title" style="background: #FFECB3;">
        {{trans('labels.create_new_job')}}&nbsp;&nbsp;
        <a href="{{url('/employer/job')}}"> < {{trans('labels.back_to_list')}}</a>
    </div>
    <div class="border">
            @if(Session::has('sms'))
                <div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div>
                        {{session('sms')}}
                    </div>
                </div>
            @endif
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
            <form action="{{url('/employer/job/save')}}" method="post">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-sm-8">
                        <label for="job_title" class="control-label">{{trans('labels.job_title')}}</label>
                        <input type="text" name="job_title" id="job_title" required autofocus class="form-control" value="{{old('job_title')}}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-8">
                        <label for="category" class="control-label">{{trans('labels.category')}}</label>
                        <select name="category" id="category" class="form-control">
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-8">
                        <label for="type" class="control-label">{{trans('labels.job_type')}}</label>
                        <select name="type" id="type" class="form-control">
                            @foreach($job_types as $type)
                                <option value="{{$type->id}}">{{$type->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-8">
                        <label for="location" class="control-label">{{trans('labels.location')}}</label>
                        <select name="location" id="location" class="form-control">
                            @foreach($locations as $location)
                                <option value="{{$location->name}}">{{$location->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-8">
                        <label for="closing_date" class="control-label">{{trans('labels.closing_date')}}</label>
                        <input type="text" name="closing_date" id="closing_date" required class="form-control" placeholder="yyyy-mm-dd" value="{{old('closing_date')}}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-8">
                        <label for="gender" class="control-label">{{trans('labels.gender')}}</label>
                        <input type="text" name="gender" id="gender" class="form-control" placeholder="Male or Female" value="{{old('gender')}}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-8">
                        <label for="hire" class="control-label">{{trans('labels.hiring')}}</label>
                        <input type="number" name="hire" id="hire" class="form-control" value="1">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <label for="description" class="control-label">{{trans('labels.job_description')}}</label>
                        <textarea name="description" id="description" class="ckeditor" cols="30" rows="10">{{old('description')}}</textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <label for="requirement" class="control-label">{{trans('labels.job_requirement')}}</label>
                        <textarea name="requirement" id="requirement" class="ckeditor" cols="30" rows="10">{{old('requirement')}}</textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-8">
                        <p></p>
                        <button class="btn btn-warning" type="submit">{{trans('labels.save')}}</button>
                        <button class="btn btn-danger" type="reset">{{trans('labels.cancel')}}</button>
                    </div>
                </div>
            </form>
    </div>
    <script src="{{asset('front/jquery.inputmask.bundle.min.js')}}"></script>
    <script src="{{asset('front/ckeditor/ckeditor.js')}}"></script>
    <script>
        $(document).ready(function () {
            $("#closing_date").inputmask('9999-99-99');
            CKEDITOR.replace('description');
            CKEDITOR.replace('requirement');
        });
    </script>
@endsection