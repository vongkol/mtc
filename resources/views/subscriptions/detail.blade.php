@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-bold">
                    <i class="fa fa-align-justify"></i> Subscription Detail
                    <a href="{{url('/subscription')}}" class="btn btn-link btn-sm">Back To List</a>
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
                    <form action="{{url('/subscription/approve')}}" class="form-horizontal" method="post">
                        {{csrf_field()}}
                        <div class="form-group row">
                            <div class="col-lg-6 col-sm-6">
                                <span class="text-primary">Subscription ID</span> :
                                {{$subscription->id}}
                                <input type="hidden" name="id" value="{{$subscription->id}}">
                                <input type="hidden" name="status" value="{{$subscription->status}}">
                            </div>
                            <div class="col-lg-2 col-sm-2">
                                <span class="text-primary">Employer ID</span> : 
                                {{$subscription->employer_id}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-6 col-sm-6">
                                <span class="text-primary">Employer Name</span> :
                                {{$subscription->first_name . ' ' . $subscription->last_name}}
                            </div>
                            <div class="col-lg-6 col-sm-6">
                                <span class="text-primary">Price</span> :
                                {{$subscription->price}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-6 col-sm-6">
                                <span class="text-primary">Number of Day</span> : 
                                {{$subscription->day_number}}
                            </div>
                            <div class="col-lg-6 col-sm-6">
                                <span class="text-primary">Number of Job</span>  : 
                                {{$subscription->job_number}}
                            </div>
                             
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-6 col-sm-6">
                                <span class="text-primary">Number of Download</span>  : 
                                {{$subscription->download}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-6 col-sm-6">
                                <span class="text-primary">Expired Date</span> : 
                                {{$subscription->expired_date}}
                            </div>
                            <div class="col-lg-6 col-sm-6">
                                <span class="text-primary">Status</span> : 
                                {{$subscription->status==0?'Pending':'Approved'}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-6 col-sm-8">
                                @if($subscription->status==0)
                                <button class="btn btn-primary" type="submit">Approve</button>
                                @else
                                    <button class="btn btn-warning" type="submit">De-Approve</button>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#expired_date").inputmask('9999-99-99');
        });
    </script>
@endsection