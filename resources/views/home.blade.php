@extends('layouts.app')
@section('content')
    <div class="row" style="margin-top: 18px">
        <div class="col-sm-6 col-lg-3">
            <div class="card card-inverse card-primary">
                <div class="card-block pb-0">
                   <a href="{{url('/employee')}}" class="btn btn-xs btn-info pull-right">View</a>
                    <h4 class="mb-0">Employee </h4>
                    <hr>
                    <p>
                        <strong>Total: {{$total_employee}}</strong>
                        <br>
                        <strong>Male: {{$male_employee}}</strong>,&nbsp;&nbsp;
                        <strong>Female: {{$female_employee}}</strong>
                        
                    </p>
                  
                </div>
            </div>
        </div>
        <!--/.col-->

        <div class="col-sm-6 col-lg-3">
            <div class="card card-inverse card-info">
                <div class="card-block pb-0">
                <a href="{{url('/provider')}}" class="btn btn-xs btn-primary pull-right">View</a>
                    <h4 class="mb-0">Job Provider</h4>
                    <hr>
                    <p>
                        <strong>Total: {{$total_employer}}</strong>
                        <br>
                        <strong>Male: {{$male_employer}}</strong>,&nbsp;&nbsp;
                        <strong>Female: {{$female_employer}}</strong>
                    </p>
                </div>
            </div>
        </div>
        <!--/.col-->

        <div class="col-sm-6 col-lg-3">
            <div class="card card-inverse card-warning">
                <div class="card-block pb-0">
                    <a href="{{url('/joblist')}}" class="btn btn-xs btn-danger pull-right">View</a>
                    <h4 class="mb-0">Job Posting</h4>
                    <hr>
                    <p>
                        <strong>Total: {{$total_job}}</strong>
                        <br>
                        &nbsp;
                    </p>
                </div>
            </div>
        </div>
        <!--/.col-->

        <div class="col-sm-6 col-lg-3">
            <div class="card card-inverse card-danger">
                <div class="card-block pb-0">
                <a href="{{url('/com')}}" class="btn btn-xs btn-warning pull-right">View</a>
                    <h4 class="mb-0">Company</h4>
                    <hr>
                    <p>
                        <strong>Total: {{$total_company}}</strong>
                        <br>
                        &nbsp;
                    </p>
                </div>
            </div>
        </div>
        <!--/.col-->
    </div>
    <div class="row" style="">
        <div class="col-sm-6 col-lg-3">
            <div class="card card-inverse card-success">
                <div class="card-block pb-0">
                <a href="{{url('/cvlist')}}" class="btn btn-xs btn-primary pull-right">View</a>
                    <h4 class="mb-0">Resume</h4>
                    <hr>
                    <p>
                        <strong>Total: {{$total_cv}}</strong>
                        <br>
                        <strong>Male: {{$male_cv}}</strong>,&nbsp;&nbsp;
                        <strong>Female: {{$female_cv}}</strong>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
