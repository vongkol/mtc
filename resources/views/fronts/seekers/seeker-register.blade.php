@extends('layouts.front')
@section('content')
<div class="row">
    <div class="col-md-9">
    <div class="col-md-7 offset-md-3">
        <h3 class="page-title">{{trans("labels.seeker_registration_form")}}</h3>
        <div class="border">
            <form action="{{url('/seeker/save')}}"  id="register" method="post" accept-charset="UTF-8" role="form" onsubmit="check(event)">
                {{csrf_field()}}
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
                    <label for="first_name" class="control-label col-sm-3">{{trans("labels.first_name")}}<span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input class="form-control" name="first_name" id="first_name" 
                        value="{{old('first_name')}}" type="text" required autofocus>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="last_name" class="control-label col-sm-3">{{trans("labels.last_name")}}<span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input class="form-control" name="last_name" id="last_name" 
                        value="{{old('last_name')}}" type="text" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="gender" class="control-label col-sm-3">{{trans("labels.gender")}}<span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <select name="gender" id="gender" class="form-control">
                            <option value="Male">{{trans("labels.male")}}</option>
                            <option value="Female">{{trans("labels.female")}}</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="dob" class="control-label col-sm-3">{{trans("labels.dob")}}</label>
                    <div class="col-sm-9">
                        <input class="form-control" name="dob" id="dob" type="text"
                            value="{{old('dob')}}" placeholder="{{trans('labels.dd')}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="control-label col-sm-3">{{trans("labels.email")}}<span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input class="form-control" name="email" id="email" type="email" 
                        value="{{old('email')}}" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="phone" class="control-label col-sm-3">{{trans("labels.phone1")}}<span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input class="form-control" name="phone" id="phone" type="text"
                        value="{{old('phone')}}" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="phone1" class="control-label col-sm-3">{{trans("labels.phone2")}}</label>
                    <div class="col-sm-9">
                        <input class="form-control" name="phone1" id="phone1" type="text"
                        value="{{old('phone')}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="username" class="control-label col-sm-3">{{trans("labels.username")}}<span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input class="form-control" name="username" id="username" type="text" 
                        value="{{old('username')}}" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password" class="control-label col-sm-3">{{trans("labels.password")}}<span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input class="form-control" name="password" id="password" type="password" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="cpassword" class="control-label col-sm-3">{{trans("labels.confirm_password")}}<span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input class="form-control" name="cpassword" id="cpassword" type="password" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <p class="text-danger">{{trans("labels.note")}}</p>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-sm-3">&nbsp;</label>
                    <div class="col-sm-9">
                        <button class="btn btn-primary border-radius-none" type="submit">{{trans("labels.register")}}</button>
                        <button class="btn btn-danger border-radius-none" type="reset">{{trans("labels.cancel")}}</button>
                    </div>
                </div>
            </form>
            </div>
        </div></div>
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
    <script src="{{asset('front/jquery.inputmask.bundle.min.js')}}"></script>
    <script src="{{asset('front/js/main.js')}}"></script>
    <script charset="utf-8" type="text/javascript">
        function check(event)
        {
            var password = document.getElementById("password").value;
            var confirm_password = document.getElementById("cpassword").value;

            if( password != confirm_password) {
                document.getElementById("cpassword").style.border="1px solid red";
                event.preventDefault();
            } 

            if( password === confirm_password){
                document.getElementById("register").submit();
            }
        }
        $(document).ready(function(){
            $("#dob").inputmask('99/99/9999');
           // $("#phone").inputmask('999 999 9999');
            // $("#phone1").inputmask('999 999 9999');
        });
    </script>
@endsection