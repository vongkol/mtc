@extends('layouts.employer')
@section('content')
    <style>
        .photo{
            position: absolute;
            right: 18px;
            top: 0;
        }
    </style>
    <div class="page-title" style="background: #FFECB3;">
       {{trans('labels.cv_detail')}}
    </div>
    <div class="border">
            {{csrf_field()}}
            <div class="row">
                <div class="col-sm-12">
                    @foreach($logo as $l)
                        <div class="col-md-3 col-lg-3">
                            <div class="navbar-brand navbar-b-cv">
                                <img src="{{URL::asset('/img/').'/'.$l->photo}}" style="margin-top: 18px">
                            </div>
                        </div>
                        <div class="col-sm-9 col-lg-9">
                            <div class="title-cp">
                                <h3 style="color: orange;">{{$l->name}}</h3>
                            </div>
                        </div>
                    @endforeach
                    <div class="photo">
                        <img src="{{asset('uploads/photo/'. $cv->profile_photo)}}" alt="" style="width: 72px;">
                    </div>
                </div>

            </div>
            <div class="row">
                <hr>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <p><strong>{{$cv->first_name . ' ' . $cv->last_name}}</strong></p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-11">
                    <p>{{$cv->address}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-2">{{trans('labels.dob')}}</div>
                <div class="col-sm-9">: {{$cv->dob}}</div>
            </div>
            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-2">{{trans('labels.pob')}}</div>
                <div class="col-sm-9">: {{$cv->pob}}</div>
            </div>
            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-2">{{trans('labels.gender')}}</div>
                <div class="col-sm-9">: {{$cv->gender}}</div>
            </div>
            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-2">{{trans('labels.nationality')}}</div>
                <div class="col-sm-9">: {{$cv->nationality}}</div>
            </div>
            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-2">{{trans('labels.permanent_address')}}</div>
                <div class="col-sm-9">: {{$cv->permanent_address}}</div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <br>
                    <p><strong>{{trans('labels.education_background')}} </strong></p>
                </div>
            </div>
            @foreach($educations as $edu)
                <div class="row">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-2">{{$edu->year}}</div>
                    <div class="col-sm-9">: {{$edu->description}}</div>
                </div>
            @endforeach
            <div class="row">
                <div class="col-sm-12">
                    <br>
                    <p><strong>{{trans('labels.work_experience')}}</strong></p>
                </div>
            </div>
            @foreach($experiences as $exp)
                <div class="row">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-2">{{$exp->year}}</div>
                    <div class="col-sm-9">: {{$exp->description}}</div>
                </div>
            @endforeach
            <div class="row">
                <div class="col-sm-12">
                    <br>
                    <p><strong>{{trans('labels.training_course')}}</strong></p>
                </div>
            </div>
            @foreach($trainings as $tr)
                <div class="row">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-2">{{$tr->training_date}}</div>
                    <div class="col-sm-9">: {{$tr->description}}</div>
                </div>
            @endforeach
            <div class="row">
                <div class="col-sm-12">
                    <br>
                    <p><strong>{{trans('labels.knowledge_language')}}</strong></p>
                </div>
            </div>
            @foreach($languages as $lang)
                <div class="row">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-2">{{$lang->name}}</div>
                    <div class="col-sm-9">: {{$lang->description}}</div>
                </div>
            @endforeach
            <div class="row">
                <div class="col-sm-12">
                    <br>
                    <p><strong>{{trans('labels.other_skill')}}</strong></p>
                </div>
            </div>
            @foreach($skills as $skill)
                <div class="row">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-2">{{$skill->name}}</div>
                    <div class="col-sm-9">: {{$skill->description}}</div>
                </div>
            @endforeach
            <div class="row">
                <div class="col-sm-12">
                    <br>
                    <p><strong>{{trans('labels.hobbies')}}</strong></p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-7">
                    <ul style="padding:12px">
                        @foreach($hobbies as $h)
                            <li>{{$h->name}}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        <div class="row">
            <div class="col-sm-12">
                <br>
                <p><strong>{{trans('labels.favorite_job')}}</strong></p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-7">
                <ul style="padding:12px">
                    <li>{{trans('labels.first_option')}}: {{$cv->favorite_job1}}</li>
                    <li>{{trans('labels.second_option')}}: {{$cv->favorite_job2}}</li>
                    <li>{{trans('labels.third_option')}}: {{$cv->favorite_job3}}</li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-7">
                <button class="btn btn-success" type="button" id="btn1" {{count($is_favorite)>0?"disabled":""}}>{{trans('labels.mark_as')}}</button>
                <a href="{{url('/employer/downloadcv/'.$cv->id)}}" class="btn btn-primary" target="_blank">{{trans('labels.download_this_cv')}}</a>
            </div>
        </div>
    </div>
    <script>
        var burl = "{{url('/')}}";
        var id = "{{$cv->id}}";
        $(document).ready(function () {
            $("#btn1").click(function () {
                $.ajax({
                    type: "GET",
                    url: burl +"/employer/make/favorite/" + id,
                    success: function (sms) {
                        if(sms>=0)
                        {
                            $("#btn1").attr("disabled", "disabled");
                        }
                    }
                });
            });
        });
    </script>
@endsection