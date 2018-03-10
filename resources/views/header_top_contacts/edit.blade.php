@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-bold">
                    <i class="fa fa-align-justify"></i> Header Top Contact&nbsp;&nbsp;
                    <a href="{{url('/header_top_contact')}}" class="btn btn-link btn-sm">Back To List</a>
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

                    <form action="{{url('/header_top_contact/update')}}" class="form-horizontal" method="post">
                        {{csrf_field()}}
                        <input type="hidden" name="id" id="id" value="{{$header_top_contact->id}}">
                        <div class="form-group row">
                            <label for="phone" class="control-label col-lg-2 col-sm-2">
                                Phone
                            </label>
                            <div class="col-lg-6 col-sm-8">
                                <input type="text" name="phone" id="phone" class="form-control" value="{{$header_top_contact->phone}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="control-label col-lg-2 col-sm-2">
                                Email
                            </label>
                            <div class="col-lg-6 col-sm-8">
                                <input type="text" name="email" id="email" class="form-control" value="{{$header_top_contact->email}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="work_time" class="control-label col-lg-2 col-sm-2">
                                Work Time
                            </label>
                            <div class="col-lg-6 col-sm-8">
                                <input type="text" name="work_time" id="work_time" class="form-control" value="{{$header_top_contact->work_time}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-lg-2 col-sm-2">&nbsp;</label>
                            <div class="col-lg-6 col-sm-8">
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
