@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-bold">
                    <i class="fa fa-align-justify"></i> Edit Package&nbsp;&nbsp;
                    <a href="{{url('/package')}}" class="btn btn-link btn-sm">Back To List</a>
                </div>
                <div class="card-block">
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
                        <form action="{{url('/package/update')}}" class="form-horizontal" method="post">
                            {{csrf_field()}}
                            <div class="form-group row">
                                <label class="control-label col-sm-2">
                                    Name <span class="text-danger">*</span>
                                </label>
                                <div class="col-sm-5">
                                    <input type="text" required autofocus name="name" id="name" class="form-control" value="{{$package->name}}">
                                    <input type="hidden" name="id" value="{{$package->id}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-sm-2">Price</label>
                                <div class="col-sm-5">
                                    <input type="number" required name="price" id="price" class="form-control" value="{{$package->price}}" min="0" step="1">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-sm-2">Package Type</label>
                                <div class="col-sm-5">
                                    <select name="type" id="type" class="form-control">
                                        @foreach($package_types as $type)
                                            <option value="{{$type->name}}" {{$type->name===$package->type?'selected':''}}>{{$type->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-sm-2">Number of Job</label>
                                <div class="col-sm-5">
                                    <input type="number" name="job" id="job" class="form-control" value="{{$package->job_number}}" min="0" step="1">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-sm-2">Number of Day</label>
                                <div class="col-sm-5">
                                    <input type="number" name="day" id="day" class="form-control" value="{{$package->day_number}}" min="0" step="1">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-sm-2">Download CV</label>
                                <div class="col-sm-5">
                                    <input type="number" name="download" id="download" class="form-control" value="{{$package->download}}" min="0" step="1">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-sm-2">Description</label>
                                <div class="col-sm-5">
                                    <input type="text" name="description" id="description" class="form-control" value="{{$package->description}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-sm-2">&nbsp;</label>
                                <div class="col-sm-5">
                                    <button class="btn btn-primary" type="submit">Save Change</button>
                                </div>
                            </div>
                        </form>
                </div>
            </div>
        </div>
        <!--/.col-->
    </div>
@endsection