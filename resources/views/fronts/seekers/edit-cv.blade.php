@extends('layouts.seeker')
@section('content')
    <div class="page-title">
     {{trans('labels.edit_cv')}}
    </div>
    <div class="border">
            <form action="#" class="form-horizontal" method="post">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-sm-12">
                        <strong class="text-primary">{{trans('labels.personal_background')}}</strong>
                        <hr>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="address" class="control-label col-sm-2" style="text-align: left;">{{trans('labels.address')}}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="address" id="address" value="{{$cv->address}}">
                        <input type="hidden" id="cv_id" value="{{$cv->id}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="dob" class="control-label col-sm-2" style="text-align: left;">{{trans('labels.dob')}}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="dob" id="dob" value="{{$cv->dob}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="pob" class="control-label col-sm-2" style="text-align: left;">{{trans('labels.pob')}}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="pob" id="pob" placeholder="{{trans('labels.dd')}}" value="{{$cv->pob}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="gender" class="control-label col-sm-2" style="text-align: left;">{{trans('labels.gender')}}</label>
                    <div class="col-sm-9">
                        <select name="gender" id="gender" class="form-control">
                            <option value="Male" {{$cv->gender=="Male"?"selected":""}}>{{trans('labels.male')}}</option>
                            <option value="Female" {{$cv->gender=="Female"?"selected":""}}>{{trans('labels.female')}}</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nationality" class="control-label col-sm-2" style="text-align: left;">{{trans('labels.nationality')}}</label>
                    <div class="col-sm-9">
                        <select name="nationality" id="nationality" class="form-control">
                            @foreach($nationalities as $n)
                                <option value="{{$n->name}}" {{$n->name==$cv->nationality?"selected":""}}>{{$n->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="paddress" class="control-label col-sm-2" style="text-align: left;">{{trans('labels.permanent_address')}}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="paddress" id="paddress" value="{{$cv->permanent_address}}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <p>&nbsp;</p>
                        <strong class="text-primary">{{trans('labels.education_background')}}</strong>
                        <hr>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <table id="edu" class="table table-condensed">
                            <thead>
                            <tr>
                                <th style="width: 120px">{{trans('labels.year_of_study')}}</th>
                                <th>{{trans('labels.description')}}&nbsp;&nbsp;&nbsp;<a href="#" id="addMore" class="btn btn-xs btn-primary">{{trans('labels.add_more')}}</a></th>
                                <th style="width: 80px"></th>
                            </tr>
                            </thead>
                            <tbody id="data">
                            @foreach($educations as $edu)
                                <tr>
                                    <td><input type="text" class="form-control yy" placeholder="yyyy - yyyy" value="{{$edu->year}}" order="{{$edu->order_number}}"></td>
                                    <td><input type="text" class="form-control" value="{{$edu->description}}"></td>
                                    <td><a href="#" class="btn btn-sm btn-danger" onclick='rmRow(this,event)'>{{trans('labels.delete')}}</a> </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <p>&nbsp;</p>
                        <strong class="text-primary">{{trans('labels.work_experience')}}</strong>
                        <hr>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <table id="edu" class="table table-condensed">
                            <thead>
                            <tr>
                                <th style="width: 200px">{{trans('labels.year_of_work')}}</th>
                                <th>{{trans('labels.description')}}&nbsp;&nbsp;&nbsp;<a href="#" id="addMore1" class="btn btn-xs btn-primary">{{trans('labels.add_more')}}</a></th>
                                <th style="width: 80px"></th>
                            </tr>
                            </thead>
                            <tbody id="data1">
                            @foreach($experiences as $exp)
                                <tr>
                                    <td><input type="text" class="form-control" value="{{$exp->year}}" order="{{$exp->order_number}}"></td>
                                    <td><input type="text" class="form-control" value="{{$exp->description}}"></td>
                                    <td><a href="#" class="btn btn-sm btn-danger" onclick='rmRow(this,event)'>{{trans('labels.delete')}}</a> </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <p>&nbsp;</p>
                        <strong class="text-primary">{{trans('labels.training_course')}}</strong>
                        <hr>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <table id="edu" class="table table-condensed">
                            <thead>
                            <tr>
                                <th style="width: 200px">{{trans('labels.training_date')}}</th>
                                <th>{{trans('labels.description')}}&nbsp;&nbsp;&nbsp;<a href="#" id="addMore2" class="btn btn-xs btn-primary">{{trans('labels.add_more')}}</a></th>
                                <th style="width: 80px"></th>
                            </tr>
                            </thead>
                            <tbody id="data2">
                            @foreach($trainings as $training)
                                <tr>
                                    <td><input type="text" class="form-control" value="{{$training->training_date}}" order="{{$training->order_number}}"></td>
                                    <td><input type="text" class="form-control" value="{{$training->description}}"></td>
                                    <td><a href="#" class="btn btn-sm btn-danger" onclick='rmRow(this,event)'>{{trans('labels.delete')}}</a> </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <p>&nbsp;</p>
                        <strong class="text-primary">{{trans('labels.knowledge_language')}}</strong>
                        <hr>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <table id="edu" class="table table-condensed">
                            <thead>
                            <tr>
                                <th style="width: 200px">{{trans('labels.language')}}</th>
                                <th>{{trans('labels.description')}}&nbsp;&nbsp;&nbsp;<a href="#" id="addMore3" class="btn btn-xs btn-primary">{{trans('labels.add_more')}}</a></th>
                                <th style="width: 80px"></th>
                            </tr>
                            </thead>
                            <tbody id="data3">
                            @foreach($languages as $lang)
                                <tr>
                                    <td><input type="text" class="form-control" value="{{$lang->name}}" order="{{$lang->order_number}}"></td>
                                    <td><input type="text" class="form-control" value="{{$lang->description}}"></td>
                                    <td><a href="#" class="btn btn-sm btn-danger" onclick='rmRow(this,event)'>{{trans('labels.delete')}}</a> </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <p>&nbsp;</p>
                        <strong class="text-primary">{{trans('labels.other_skill')}}</strong>
                        <hr>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <table id="edu" class="table table-condensed">
                            <thead>
                            <tr>
                                <th style="width: 200px">{{trans('labels.skill_name')}}</th>
                                <th>{{trans('labels.description')}}&nbsp;&nbsp;&nbsp;<a href="#" id="addMore4" class="btn btn-xs btn-primary">{{trans('labels.add_more')}}</a></th>
                                <th style="width: 80px"></th>
                            </tr>
                            </thead>
                            <tbody id="data4">
                            @foreach($skills as $skill)
                                <tr>
                                    <td><input type="text" class="form-control" value="{{$skill->name}}" order="{{$skill->order_number}}"></td>
                                    <td><input type="text" class="form-control" value="{{$skill->description}}"></td>
                                    <td><a href="#" class="btn btn-sm btn-danger" onclick='rmRow(this,event)'>{{trans('labels.delete')}}</a> </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <p>&nbsp;</p>
                        <strong class="text-primary">{{trans('labels.hobbies')}}</strong>
                        <hr>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <table id="edu" class="table table-condensed">
                            <thead>
                            <tr>
                                <th>{{trans('labels.hobbies_name')}}&nbsp;&nbsp;&nbsp;<a href="#" id="addMore5" class="btn btn-xs btn-primary">{{trans('labels.add_more')}}</a></th>
                                <th style="width: 80px"></th>
                            </tr>
                            </thead>
                            <tbody id="data5">
                            @foreach($hobbies as $hob)
                                <tr>
                                    <td><input type="text" class="form-control" value="{{$hob->name}}" order="{{$hob->order_number}}"></td>
                                    <td><a href="#" class="btn btn-sm btn-danger" onclick='rmRow(this,event)'>{{trans('labels.delete')}}</a> </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="favorite" class="col-lg-12 col-sm-12 text-primary">
                        {{trans('labels.choose_top')}}
                    </label>
                    <div class="col-lg-4 col-sm-4">
                        <select class="form-control border-radius-none" id="favorite_job1" name="favorite_job1">
                            <option value="">{{trans('labels.first_option')}}</option>
                            @foreach ($categories as $cat)
                                <option value="{{$cat->name}}" {{$cat->name==$cv->favorite_job1?"selected":""}}>{{$cat->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-4 col-sm-4">
                        <select class="form-control border-radius-none" id="favorite_job2" name="favorite_job2">
                            <option value="">{{trans('labels.second_option')}}</option>
                            @foreach ($categories as $cat)
                                <option value="{{$cat->name}}" {{$cat->name==$cv->favorite_job2?"selected":""}}>{{$cat->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-4 col-sm-4">
                        <select class="form-control border-radius-none" id="favorite_job3" name="favorite_job3">
                                <option value="">{{trans('labels.third_option')}}</option>
                            @foreach ($categories as $cat)
                                <option value="{{$cat->name}}" {{$cat->name==$cv->favorite_job3?"selected":""}}>{{$cat->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-12 col-sm-12">
                        <button class="btn btn-primary border-radius-none" type="button" id="btnSave">{{trans('labels.save_change')}}</button>
                        <a href="{{url('/seeker/cv')}}" class="btn btn-danger border-radius-none">{{trans('labels.cancel')}}</a>
                    </div>
                </div>
            </form>
            <script>
        var burl = "{{url('/')}}";
        $(document).ready(function(){
            $("#dob").inputmask('99/99/9999');
            $(".yy").inputmask('9999 - 9999');
            // add more eduction record
            $("#addMore").click(function (event) {
                event.preventDefault();
                var counter = $("#data tr").length + 1;
                var tr = "";
                tr += "<tr>";
                tr += "<td>" + "<input type='text' class='form-control yy' placeholder='yyyy - yyyy' order='" + counter + "'>" + "</td>";
                tr += "<td>" + "<input type='text' class='form-control'>" + "</td>";
                tr += "<td>" + "<a href='#' class='btn btn-sm btn-danger' onclick='rmRow(this,event)'>{{trans('labels.delete')}}</a>" +"</td>";
                tr += "</tr>";
                if($("#data tr").length>0)
                {
                    $("#data tr:last-child").after(tr);
                    $(".yy").inputmask('9999 - 9999');
                }
                else{
                    $("#data").html(tr);
                    $(".yy").inputmask('9999 - 9999');
                }
            });
            $("#addMore1").click(function (event) {
                event.preventDefault();
                var counter = $("#data1 tr").length + 1;
                var tr = "";
                tr += "<tr>";
                tr += "<td>" + "<input type='text' class='form-control' order='" + counter + "'>" + "</td>";
                tr += "<td>" + "<input type='text' class='form-control'>" + "</td>";
                tr += "<td>" + "<a href='#' class='btn btn-sm btn-danger' onclick='rmRow(this,event)'>{{trans('labels.delete')}}</a>" +"</td>";
                tr += "</tr>";
                if($("#data1 tr").length>0)
                {
                    $("#data1 tr:last-child").after(tr);
                    $(".yy").inputmask('9999 - 9999');
                }
                else{
                    $("#data1").html(tr);
                    $(".yy").inputmask('9999 - 9999');
                }
            });
            $("#addMore2").click(function (event) {
                event.preventDefault();
                var counter = $("#data2 tr").length + 1;
                var tr = "";
                tr += "<tr>";
                tr += "<td>" + "<input type='text' class='form-control' order='" + counter + "'>" + "</td>";
                tr += "<td>" + "<input type='text' class='form-control'>" + "</td>";
                tr += "<td>" + "<a href='#' class='btn btn-sm btn-danger' onclick='rmRow(this,event)'>{{trans('labels.delete')}}</a>" +"</td>";
                tr += "</tr>";
                if($("#data2 tr").length>0)
                {
                    $("#data2 tr:last-child").after(tr);

                }
                else{
                    $("#data2").html(tr);
                }
            });
            $("#addMore3").click(function (event) {
                event.preventDefault();
                var counter = $("#data3 tr").length + 1;
                var tr = "";
                tr += "<tr>";
                tr += "<td>" + "<input type='text' class='form-control' order='" + counter + "'>" + "</td>";
                tr += "<td>" + "<input type='text' class='form-control'>" + "</td>";
                tr += "<td>" + "<a href='#' class='btn btn-sm btn-danger' onclick='rmRow(this,event)'>{{trans('labels.delete')}}</a>" +"</td>";
                tr += "</tr>";
                if($("#data3 tr").length>0)
                {
                    $("#data3 tr:last-child").after(tr);

                }
                else{
                    $("#data3").html(tr);
                }
            });
            $("#addMore4").click(function (event) {
                event.preventDefault();
                var counter = $("#data4 tr").length + 1;
                var tr = "";
                tr += "<tr>";
                tr += "<td>" + "<input type='text' class='form-control' order='" + counter + "'>" + "</td>";
                tr += "<td>" + "<input type='text' class='form-control'>" + "</td>";
                tr += "<td>" + "<a href='#' class='btn btn-sm btn-danger' onclick='rmRow(this,event)'>{{trans('labels.delete')}}</a>" +"</td>";
                tr += "</tr>";
                if($("#data4 tr").length>0)
                {
                    $("#data4 tr:last-child").after(tr);

                }
                else{
                    $("#data4").html(tr);
                }
            });
            $("#addMore5").click(function (event) {
                event.preventDefault();
                var counter = $("#data5 tr").length + 1;
                var tr = "";
                tr += "<tr>";
                tr += "<td>" + "<input type='text' class='form-control' order='" + counter + "'>" + "</td>";
                tr += "<td>" + "<a href='#' class='btn btn-sm btn-danger' onclick='rmRow(this,event)'>{{trans('labels.delete')}}</a>" +"</td>";
                tr += "</tr>";
                if($("#data5 tr").length>0)
                {
                    $("#data5 tr:last-child").after(tr);

                }
                else{
                    $("#data5").html(tr);
                }
            });
            // save cv
            $("#btnSave").click(function () {
                var info = {
                    id: $("#cv_id").val(),
                    address: $("#address").val(),
                    dob: $("#dob").val(),
                    pob: $("#pob").val(),
                    gender: $("#gender").val(),
                    nationality: $("#nationality").val(),
                    paddress: $("#paddress").val(),
                    favorite_job1: $("#favorite_job1").val(),
                    favorite_job2: $("#favorite_job2").val(),
                    favorite_job3: $("#favorite_job3").val()
                };
                var edu = [];
                var exp = [];
                var training = [];
                var lang = [];
                var skill = [];
                var hobbies = [];
                var tr = $("#data tr");
                for(var i=0; i<tr.length;i++)
                {
                    var tds = $(tr[i]).children("td");
                    var obj = {
                        name: $(tds[0]).children("input").val(),
                        description: $(tds[1]).children("input").val(),
                        order: $(tds[0]).children("input").attr("order")
                    };
                    edu.push(obj);
                }
                var tr1 = $("#data1 tr");
                for(var i=0;i<tr1.length;i++)
                {
                    var tds = $(tr1[i]).children("td");
                    var obj = {
                        name: $(tds[0]).children("input").val(),
                        description: $(tds[1]).children("input").val(),
                        order: $(tds[0]).children("input").attr("order")
                    };
                    exp.push(obj);
                }
                var tr2 = $("#data2 tr");
                for(var i=0;i<tr2.length;i++)
                {
                    var tds = $(tr2[i]).children("td");
                    var obj = {
                        name: $(tds[0]).children("input").val(),
                        description: $(tds[1]).children("input").val(),
                        order: $(tds[0]).children("input").attr("order")
                    };
                    training.push(obj);
                }
                var tr3 = $("#data3 tr");
                for(var i=0;i<tr3.length;i++)
                {
                    var tds = $(tr3[i]).children("td");
                    var obj = {
                        name: $(tds[0]).children("input").val(),
                        description: $(tds[1]).children("input").val(),
                        order: $(tds[0]).children("input").attr("order")
                    };
                    lang.push(obj);
                }
                var tr4 = $("#data4 tr");
                for(var i=0;i<tr4.length;i++)
                {
                    var tds = $(tr4[i]).children("td");
                    var obj = {
                        name: $(tds[0]).children("input").val(),
                        description: $(tds[1]).children("input").val(),
                        order: $(tds[0]).children("input").attr("order")
                    };
                    skill.push(obj);
                }
                var tr5 = $("#data5 tr");
                for(var i=0;i<tr5.length;i++)
                {
                    var tds = $(tr5[i]).children("td");
                    var obj = {
                        name: $(tds[0]).children("input").val(),
                        order: $(tds[0]).children("input").attr("order")
                    };
                    hobbies.push(obj);
                }
                // data to send
                var data = {
                    personal_info: info,
                    education: edu,
                    experience: exp,
                    training: training,
                    skill: skill,
                    language: lang,
                    hobbies: hobbies
                }
                // send data to server
                $.ajax({
                    type: "POST",
                    url: burl +"/seeker/update_cv",
                    data: data,
                    beforeSend: function (request) {
                        return request.setRequestHeader('X-CSRF-Token', $("input[name='_token']").val());
                    },
                    success: function (sms) {
                        if(sms>=0)
                        {
                            location.href = burl + "/seeker/cv";
                        }
                    }
                });
            });
        });
        // function to remove row
        function rmRow(obj, evt) {
            evt.preventDefault();
            var tr = $(obj).parent().parent();
            tr.remove();
        }
    </script>
@endsection
