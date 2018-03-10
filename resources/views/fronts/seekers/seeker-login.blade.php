@extends('layouts.front')
@section('content')
<div class="row">
    <div class="col-md-9" >  
        <div class="col-md-7 offset-md-3">  
            <div class="border">
            <h3 class="page-title">{{trans("labels.seeker_login")}}</h3>
                <form action="{{url('/seeker/dologin')}}" accept-charset="UTF-8" role="form" method="post">
                <fieldset>
                    {{csrf_field()}}
                    @if(Session::has('sms'))
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="alert alert-success border-radius-none" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                    {{session('sms')}}
                                </div>
                            </div>
                        </div>
                    @endif
                    @if(Session::has('sms1'))
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="alert alert-danger border-radius-none" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                    {{session('sms1')}}
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="form-group">
                        <input class="form-control" placeholder="{{trans('labels.username')}}" name="username" required autofocus type="text" value="{{old('username')}}">
                    </div>
                    <div class="form-group">
                        <input class="form-control" placeholder="{{trans('labels.password')}}" name="password" type="password" required value="{{old('password')}}">
                    </div>
                    <div class="form-group">
                        <p>
                            <a href="{{url('/seeker/forgot')}}" class="text-danger">{{trans('labels.forget_password')}}</a>
                        </p>
                    </div>
                    <input 
                        class="btn btn-lg btn-info btn-block" 
                        type="submit" 
                        value="{{trans('labels.login')}}"
                    >
                </fieldset>
                </div>
                </form><br>
                <a href="{{url('/seeker/register')}}">
                    <button class="btn btn-outline-info btn-block"> 
                            {{trans('labels.create_new_account')}}
                    </button>
                </a>
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
            <div class="blue"  align="center">{{trans('labels.video_training')}}</div>
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
</div><br>
@endsection