@extends('layouts.front')
@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-3">
                        <div id="trapezoid">
                            <div class="label-by-category bold orange">{{trans('labels.job_category')}}</div>
                        </div><br>
                        <ul class="nav-link">
                            @foreach($categories as $cat)
                                <li><a href="{{url('/category/'.$cat->id)}}">{{$cat->name}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-md-9">
                        <div class="panel-body panel-body-costum">
                            <div id="trapezoid">
                                <div class="label-by-category bold orange">{{trans('labels.job_list')}}</div>
                            </div><br>
                            @if(count($jobs)<=0)
                                <div class="row">
                                    <div class="col-sm-12 text-center">
                                        <br>
                                        <strong class="text-success">This category has no job posting!</strong>
                                    </div>
                                </div>
                            @endif
                            @foreach($jobs as $job)
                                <div class="row">
                                    <div class="col-sm-12">
                                        <p class="job-title new-job">
                                            <a href="{{url('/job/'.$job->id)}}">{{$job->job_title}}</a>
                                            @if($job->create_at>=date('Y-m-d', strtotime(date('Y-m-d') . '- 7 day')))
                                                <img src="{{asset('img/new.jpg')}}" alt="" style="width: 42px;margin-top: -7px;">
                                            @endif
                                        </p>

                                        <p>
                                            <span class="txt text-primary"><i class="fa fa-circle"></i> {{$job->catname}}</span>
                                            <span class="txt text-success"><i class="fa fa-map-marker"></i> {{$job->cname}}</span>
                                            <span class="txt text-danger"><i class="fa fa-info"></i> {{trans('labels.close_on')}} {{$job->closing_date}}</span>
                                        </p>
                                        <hr>
                                    </div>
                                </div>
                            @endforeach
                            {{$jobs->links()}}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
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