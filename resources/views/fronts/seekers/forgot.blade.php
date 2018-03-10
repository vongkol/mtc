@extends('layouts.front')
@section('content')
<div class="row">
    <div class="col-md-9">
        <div class="col-md-7 offset-md-3">
            <h3 class="page-title">{{trans('labels.recovery_password')}}</h3>
            <div class="border">
                        <form action="{{url('/seeker/forgot/recovery')}}" class="form-horizontal" method="post">
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
                            <div class="form-group row">
                                <p class="col-md-12">{{trans('labels.input_your_email')}}</p>
                                <div class="col-sm-12">
                                    <input type="email" id="email" id="email" name="email" class="form-control" required autofocus value="{{old("email")}}">
                                    {{csrf_field()}}
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-sm-4">&nbsp;</label>
                                <div class="col-sm-8">
                                    <button class="btn btn-primary" type="submit">{{trans('labels.submit')}}</button>
                                </div>
                            </div>
                        </form>
        </div></div></div>
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
@endsection