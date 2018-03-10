@extends('layouts.front')
@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-3 pd-0">
                    <div class="panel-body panel-body-costum">
                        <h5>Jobs By Category</h5>
                        <ul class="list-group">
                            @foreach($categories as $cat)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <a href="{{url('/category/'.$cat->id)}}"><img src="{{asset('img/tag.jpg')}}" width="13"> &nbsp;{{$cat->name}}</a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-md-9">
                    <h5>{{trans('labels.job_detail')}}</h5>
                    <div class="border">
                        <div class="row">
                            <div class="col-sm-12">
                                <p>
                                    <span class="blue-job">{{$job->job_title}}</span>
                                </p><hr>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label class="control-label col-sm-3">{{trans('labels.category')}}</label>
                                    <div class="col-sm-9 stxt">
                                        : {{$job->catname}}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-3">{{trans('labels.company')}}</label>
                                    <div class="col-sm-9 stxt">
                                        : {{$job->cname}}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-3">{{trans('labels.location')}}</label>
                                    <div class="col-sm-9 stxt">
                                        : {{$job->location}}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-3">{{trans('labels.job_type')}}</label>
                                    <div class="col-sm-9 stxt">
                                        : {{$job->job_type}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label class="control-label col-sm-4">{{trans('labels.hiring')}}</label>
                                    <div class="col-sm-8 stxt text-info">
                                        : {{$job->hire}} Post(s)
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-4">{{trans('labels.gender')}}</label>
                                    <div class="col-sm-8 stxt">
                                        : {{$job->gender}}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-4">{{trans('labels.posting_date')}}</label>
                                    <div class="col-sm-8 stxt">
                                        : {{date_format(date_create($job->create_at), "Y-m-d")}}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-4">{{trans('labels.closing_date')}}</label>
                                    <div class="col-sm-8 stxt text-danger">
                                        : {{$job->closing_date}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <p class="job-title new-job">
                                    <br>
                                    <span class="text-info">
                                        <b>{{trans('labels.job_description')}}</b>
                                    </span>
                                <hr>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                {!! $job->description !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <p>
                                    <br>
                                    <span class="text-info"><b>{{trans('labels.job_requirement')}}</b></span>
                                </p><hr>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                {!! $job->requirement !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <p><br>
                                    <span class="text-info">
                                        <b>{{trans('labels.contact_info')}}</b>
                                    </span>
                                </p><hr>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group row">
                                    <label class="control-label col-sm-2">{{trans('labels.contact_person')}}</label>
                                    <div class="col-sm-8 stxt ">
                                        : {{$job->first_name . ' ' . $job->last_name}}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-2">{{trans('labels.email')}}</label>
                                    <div class="col-sm-8 stxt ">
                                        : {{$job->email}}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-2">{{trans('labels.phone')}}</label>
                                    <div class="col-sm-8 stxt ">
                                        : {{$job->phone}}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-2">{{trans('labels.address')}}</label>
                                    <div class="col-sm-8 stxt ">
                                        : {{$job->address}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <p class="job-title new-job">
                                    <br>
                                    <span class="text-info"><b>{{trans('labels.company_profile')}}</b></span>
                                </p><hr>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <strong>{{$job->cname}}</strong>
                                <p class="text-justify">
                                    {!! $job->profile !!}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><br>
@endsection
@section('customer')
    <div class="container">
        <div class="row">
            <div class="well-custom text-center bold orange our-partner">
                {{trans('labels.our_customer')}}
            </div>
            <div class="slide-partner-img">
                <div id="carousel0"  class="owl-carousel owl-theme">
                    <?php
                    // get customers
                    $customers = DB::table('partners')
                        ->where('type', 'customer')
                        ->where('active',1)
                        ->orderBy('sequence')
                        ->get();
                    ?>
                    @foreach($customers as $cus)
                        <div class="item text-center">
                            <img src="{{asset('partners/'.$cus->logo)}}" alt="{{$cus->name}}" class="img-responsive" />
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <section class="container well-custom">
        <div class="row">
            <div class="col-sm-12">
                <?php
                // get bottom advertisement
                $bottom_ads = DB::table('advertisements')
                    ->where('active', 1)
                    ->where('position','Bottom')
                    ->orderBy('order_number')
                    ->get();
                ?>
                @foreach($bottom_ads as $bads)
                    <div class="col-md-2 col-sm-2 padding-top-and-button">
                        <img src="{{asset('ads/'.$bads->photo)}}">
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection