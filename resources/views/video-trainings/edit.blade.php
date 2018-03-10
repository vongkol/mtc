@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-bold">
                    <i class="fa fa-align-justify"></i> Edit Training Course&nbsp;&nbsp;
                    <a href="{{url('/video-training')}}" class="btn btn-link btn-sm">Back To List</a>
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
                    <form 
                        action="{{url('/video-training/update')}}" 
                        class="form-horizontal" 
                        method="post"
                        enctype="multipart/form-data"  
                    >
                        {{csrf_field()}}
                        <input type="hidden" name="id" id="id" value="{{$video_training->id}}">
                        <div class="form-group row">
                            <label for="url" class="control-label col-lg-1 col-sm-2">URL</label>
                            <div class="col-lg-6 col-sm-8">
                                <input type="text" name="url" id="url" class="form-control" value="{{$video_training->url}}">
                            </div>
                        </div>
                         <div class="form-group row">
                            <label for="order_number" class="control-label col-sm-2 col-lg-1">Order</label>
                            <div class="col-lg-6 col-sm-8">
                                <input type="number" class="form-control" id="order_number" name="order_number" value="{{$video_training->order_number}}" min="0" step="1">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-lg-1 col-sm-2">&nbsp;</label>
                            <div class="col-lg-6 col-sm-8">
                                <button class="btn btn-primary" type="submit">Save Change</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection