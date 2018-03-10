@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header text-bold">
                    <i class="fa fa-align-justify"></i> Attach File&nbsp;&nbsp;
                    <a href="{{url('/cvlist/detail/'.$cv->id)}}" class="btn btn-link btn-sm">Back To CV</a>
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
                    <form action="{{url('/cvlist/uploadfile')}}" method="post" enctype="multipart/form-data" class="form-horizontal">
                    {{csrf_field()}}
                    <input type="hidden" name="cv_id" value="{{$cv->id}}">
                    <input type="hidden" name="employee_id" value="{{$employee->id}}">
                        <div class="row">
                            <div class="col-sm-7">
                             <div class="form-group row">
                                    <label for="name" class="control-label col-sm-3">File Name</label>
                                    <div class="col-sm-9">
                                        <input type="file" class="form-control" id="name" name="name">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="description" class="control-label col-sm-3">Description</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="description" name="description">
                                        <br>
                                        <br>
                                        <button type="submit" name="uploadPhoto" class="btn btn-primary">Attach</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection