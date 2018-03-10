@extends('layouts.front')
@section('content')
    <!-- <div class="row">
        <div class="col-md-4 text-center"><div class="job-vdoo">Jobs Announcement: <span class="text-danger">103045</span></div></div>
        <div class="col-md-4  text-center"><div class="job-vdoo">Download CVs Free: <span class="text-danger">10145</span></div></div>
        <div class="col-md-4  text-center"><div class="job-vdoo">View: <span class="text-danger">10000045</span></div></div>
    </div><br> -->

    <div class="col-md-9">
        <div class="row">
            <div class="col-md-3">
                <h5>Jobs By Category</h5>
            </div>
            @foreach($job_types as $typ)
            <div class="col-md-2">
                <h6 class="txt-job"><a href="{{url('job-type/'.$typ->id)}}">{{$typ->name}}!</a></h6>
            </div>
            @endforeach
        </div>
    </div>
    <div class="row row-vdoo">
        <div class="border-job col-md-9">
           <div class="row">
                @foreach($result as $cat)
                    <div class="col-md-6">
                        <div class="border">
                            <div class="row">
                                <div class="col-md-10 col-sm-10 col-10">
                                    <a href="{{url('/category/'.$cat["id"])}}"><span class="gray">{{$cat['name']}}</span></a>
                                </div>
                                <div class="col-md-2 col-sm-2 col-2 pd-0">
                                    <span class="orange">{{$cat['total']}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="col-md-3 training-course">
            {{--  <aside align="center"><a href="#" class="blue">Training Course</a></aside>  --}}
            @foreach($training_courses as $tra)
                <div class="photo">
                    <img src="{{asset('ads/'.$tra->photo)}}" width="100%">
                </div>
            @endforeach
            <br>
            {{--  <aside align="center"><a href="#" class="blue">Traing Video</a></aside>  --}}
            @foreach($video_trainings as $vid)
                <div class="photo">
                    <object data="{{$vid->url}}" width="100%"></object>
                </div>
            @endforeach
        </div>
    </div><br>
@endsection