@extends('layouts.employer')
@section('content')
    <div class="page-title" style="background: #FFECB3;">
       {{trans('labels.my_subscription')}}
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
            @if($counter<=0)
                <div class="row">
                    <div class="col-sm-12">
                        <strong class="text-danger">
                        @if(session('lang')=='en')
                            You don't have a subscription yet. Please do subscribe one of the following packages to be able post jobs.
                        @else
                            លោកអ្នកមិនទាន់បានទិញគម្រោងណាមួយនៅឡើយទេ។ សូមទិញគម្រោងណាមួយនៅខាងក្រោមនេះ។                            
                        @endif
                        </strong>
                        <p></p>
                    </div>
                </div>
            @else
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-6">
                                <p>{{trans('labels.package_name')}}: <strong>{{$subscription->name}}</strong></p>
                                <p>{{trans('labels.price')}}: <strong>$ {{$subscription->price}}</strong></p>
                                <p>{{trans('labels.plan_type')}}: <strong>{{$subscription->type}}</strong></p>
                                <p>{{trans('labels.total_job')}}: <strong>{{$subscription->job_number}}</strong></p>
                                <p>{{trans('labels.status')}}: <strong>{{$subscription->status==0?'Pending':'Approved'}}</strong></p>
                            </div>
                            <div class="col-sm-6">
                                <p>{{trans('labels.duration')}}: <strong>{{$subscription->day_number}} days</strong></p>
                                <p>{{trans('labels.expired_on')}}: <strong>{{$subscription->expired_date}}</strong></p>
                                <p>{{trans('labels.job_remaining')}}: <strong>{{$subscription->job_number - $job_count}}</strong></p>
                                <p>{{trans('labels.download')}} #: <strong>{{$subscription->download}}</strong></p><hr>
                                <form action="{{url('/employer/unsubscribe')}}" onsubmit="return confirm('You want to unsubscribe?')" method="post">
                                    {{csrf_field()}}
                                    <input type="hidden" name="id" id="id" value="{{$subscription->id}}">
                                    <input type="submit" value="{{trans('labels.unsubscribe')}}" class="btn btn-danger form-control">
                                </form>
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>
            @endif
            <div class="row">
                    @foreach($packages as $package)
                    <div class="col-lg-3 col-sm-3 pd">
                        <div class="border">
                            <div class="orange">{{$package->name}} /  <b>$ {{$package->price}} </b></div><hr>
                                <aside>{{trans('labels.total_job')}}: {{$package->job_number}}</aside>
                                <asidep>{{trans('labels.duration')}}: {{$package->day_number}}</aside>
                                <aside>{{trans('labels.download')}} #: {{$package->download}}</aside>
                                <aside>{{trans('labels.plan_type')}}: <b class="text-danger">{{$package->type}}</b></aside><hr>
                            <div class="panel-footer panel-footer-custom">
                                @if($subscription)
                                    <form action="{{url('/employer/subscribe')}}" method="post" onsubmit="return confirm('You want to subscribe?')">
                                        {{csrf_field()}}
                                        <input type="hidden" id="package" name="package" value="{{$package->id}}">
                                        <input type="submit" class="btn btn-warning form-control" value="{{trans('labels.subscribe')}}" {{$package->id==$subscription->package_id?'disabled':''}}>
                                    </form>
                                @else
                                    <form action="{{url('/employer/subscribe')}}" method="post" onsubmit="return confirm('You want to subscribe?')">
                                        {{csrf_field()}}
                                        <input type="hidden" id="package" name="package" value="{{$package->id}}">
                                        <input type="submit" class="btn btn-warning form-control" value="{{trans('labels.subscribe')}}">
                                    </form>

                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>

@endsection