@extends('layouts.seeker')
@section('content')
    <style>
        .photo{
            position: absolute;
            right: 18px;
            top: 0;
        }
    </style>
    <div class="page-title">
        {{trans('labels.manage_my_resume')}}
    </div>
    <div class="border">
            @if($cv==NULL)
                <div class="row">
                    <div class="col-sm-12">
                        <p class="text-center text-success"><strong>{{trans('labels.you_dont_have_cv')}}</strong></p>
                        <p class="text-center">
                            <a href="{{url('/seeker/create/cv')}}" class="btn btn-info">{{trans('labels.create_new_resume')}}</a>
                        </p>
                    </div>
                </div>
            @else
            @if(Session::has('sms'))
                <div class="alert alert-success border-radius-none" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div>
                        {{session('sms')}}
                    </div>
                </div>
            @endif
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
                        <p><strong>{{trans('labels.education_background')}}</strong></p>
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
                        <p><strong>{{trans('labels.contact_info')}}</strong></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-2">{{trans('labels.contact_name')}}</div>
                    <div class="col-sm-9">: {{$cv->first_name . ' ' . $cv->last_name}}</div>
                </div>
                <div class="row">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-2">{{trans('labels.email')}}</div>
                    <div class="col-sm-9">: {{$cv->email}}</div>
                </div>
                <div class="row">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-2">{{trans('labels.phone')}}</div>
                    <div class="col-sm-9">: {{$cv->phone}}</div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <br>
                        <p><strong>{{trans('labels.attached_document')}}</strong></p>
                    </div>
                </div>
            <div class="row">
                <div class="col-sm-12">
                    <table class="table table-condensed">
                        <thead>
                        <tr>
                            <th>&numero;</th>
                            <th>{{trans('labels.file_name')}}</th>
                            <th>{{trans('labels.description')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=1;?>
                        @foreach($documents as $doc)
                            <tr id="{{$doc->id}}">
                                <td>{{$i++}}</td>
                                <td><a href="{{asset('uploads/docs/'.$doc->name)}}" target="_blank">{{$doc->name}}</a></td>
                                <td>{{$doc->description}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <br>
                    <a href="{{url('/seeker/edit_cv/'.$cv->id)}}" class="btn btn-primary">{{trans('labels.update_cv')}}</a>
                </div>
            </div>
        @endif
@endsection