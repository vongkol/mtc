@extends('layouts.front')
@section('content')
    <div class="row">
        <div class="col-md-9">
            <div class="page-title">
                {{$page->title}}
            </div>
            <div class="border">
                <p>{!!$page->description!!}</p>
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
    </div>

@endsection
