@extends('layouts.front')
@section('content')
    <section>
        <div class="container">
            <div class="row">
                    <div class="col-md-9">
                            <div class="page-title"  style="background: #FFECB3;">
                              {{trans('labels.recovery_password')}}
                            </div>
                            <div class="border">
                                <p class="text-center text-danger">
                                    <strong>
                                        We are sorry, the mail service is not available!
                                        <br>
                                        Make sure you have published your website to hosting server correctly.
                                    </strong>
                                </p>
                                <p class="text-center">
                                    <a href="{{url('/')}}" class="btn btn-primary border-radius-none">{{trans('labels.back_home')}}</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="blue"  align="center">{{trans('labels.training_course')}}</div>
                        <?php 
                            $training_courses = DB::table('training_courses')
                            ->where('active',1)
                            ->orderBy('order_number', 'asc')
                            ->get();
                        ?>
                        @foreach($training_courses as $t)
                            <div class="photo">
                                    <img src="{{asset('ads/'.$t->photo)}}" width="100%">
                            </div>
                        @endforeach<br>
                        <?php   
                            $video_trainings = DB::table('video_trainings')
                            ->where('active',1)
                            ->orderBy('order_number', 'asc')
                            ->get();
                        ?>
                        @foreach($video_trainings as $vid)
                            <div class="photo">
                                <object data="{{$vid->url}}" width="100%"></object>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection