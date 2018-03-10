@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-bold">
                    <i class="fa fa-align-justify"></i> Job Detail&nbsp;&nbsp;
                    <a href="{{url('/joblist')}}" class="btn btn-link btn-sm">Back To List</a>
                </div>
                <div class="card-block">
                    <form 
                    >
                        {{csrf_field()}}
                        <div class="form-group row">
                            <div class="col-lg-6 col-sm-6">
                            	<span class="text-primary">Job Title</span> :
                                {{$job->job_title}}  
                            </div>
                            <div class="col-lg-6 col-sm-6">
                            	<span class="text-primary">Company</span> :
                                {{$job->cname}}  
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-6 col-sm-6">
                                <span class="text-primary">Job Category</span> :
                                {{$job->catname}}
                            </div>
                            <div class="col-lg-6 col-sm-6">
                            	<span class="text-primary">Job Location</span> :
                                {{$job->location}}  
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="control-label col-lg-6 col-sm-6">
                                <span class="text-primary">Job Type:</span> : 
                                {{$job->job_type}}
                            </div>
                            <div class="control-label col-lg-6 col-sm-6">
                            	<span class="text-primary">Gender</span> :
                                {{$job->gender}}  
                            </div>
                        </div>   
                        <div class="form-group row">
                            <div class="col-lg-6 col-sm-6">
                                <span class="text-primary">Posting Date</span> :
                                <span class="text-success">{{date_format(date_create($job->create_at), "Y-m-d")}}</span>
                            </div>
                            <div class="col-lg-6 col-sm-6">
                            	<span class="text-primary">Closing Date</span> :
                                <span class="text-danger">{{$job->closing_date}}</span>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <div class="col-lg-12 col-sm-12">
                                <p class="text-primary">Job Description</p>
                                {!! $job->description !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-12 col-sm-12">
                            	<p class="text-primary">Job Requirement</p>
                                {!! $job->requirement !!}
                            </div>
                        </div>
                        <div class="row">
                                <div class="col-sm-12">
                                    <h6>
                                        <br>
                                        Contact Information
                                        <hr>
                                    </h6>
                                </div>
                            </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group row">
                                    <div class="col-sm-6">Contact Person  : {{$job->first_name . ' ' . $job->last_name}}</div>
                                    <div class="col-sm-6">Email Address : {{$job->email}}</div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6">Phone Number : {{$job->phone}}</div>
                                    <div class="col-sm-6">Address : {{$job->address}}</div>
                                </div>
                            </div>
                        </div>        
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection