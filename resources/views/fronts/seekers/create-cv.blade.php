@extends('layouts.seeker')
@section('content')
<script src="{{asset('front/vendor/jquery/jquery.min.js')}}"></script>
    <div class="page-title">
        {{trans('labels.create_new_resume')}}
    </div>
    <div class="border">
            <form action="#" class="form-horizontal" method="post">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <strong class="blue">{{trans('labels.personal_background')}}</strong>
                        <hr>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="address" class="control-label col-sm-2" style="text-align: left;">{{trans('labels.address')}}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="address" id="address">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="dob" class="control-label col-sm-2" style="text-align: left;">{{trans('labels.dob')}}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="dob" id="dob" placeholder="{{trans('labels.dd')}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="pob" class="control-label col-sm-2" style="text-align: left;">{{trans('labels.pob')}}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="pob" id="pob">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="gender" class="control-label col-sm-2" style="text-align: left;">{{trans('labels.gender')}}</label>
                    <div class="col-sm-9">
                        <select name="gender" id="gender" class="form-control">
                            <option value="Male">{{trans('labels.male')}}</option>
                            <option value="Female">{{trans('labels.female')}}</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nationality" class="control-label col-sm-2" style="text-align: left;">{{trans('labels.nationality')}}</label>
                    <div class="col-sm-9">
                        <select name="nationality" id="nationality" class="form-control">
                            @foreach($nationalities as $n)
                                <option value="{{$n->name}}">{{$n->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="paddress" class="control-label col-sm-2" style="text-align: left;">{{trans('labels.permanent_address')}}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="paddress" id="paddress">
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
                                <tr>
                                    <td><input type="text" class="form-control yy" placeholder="yyyy - yyyy" order="0"></td>
                                    <td><input type="text" class="form-control" placeholder="{{trans('labels.lastest_education')}}"></td>
                                    <td><a href="#" class="btn btn-sm btn-danger" onclick='rmRow(this,event)'>{{trans('labels.delete')}}</a> </td>
                                </tr>
                                <tr>
                                    <td><input type="text" class="form-control yy" placeholder="yyyy - yyyy" order="1"></td>
                                    <td><input type="text" class="form-control"></td>
                                    <td><a href="#" class="btn btn-sm btn-danger" onclick='rmRow(this,event)'>{{trans('labels.delete')}}</a> </td>
                                </tr>
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
                            <tr>
                                <td><input type="text" class="form-control" order="0"></td>
                                <td><input type="text" class="form-control" placeholder="{{trans('labels.lastest_work')}}"></td>
                                <td><a href="#" class="btn btn-sm btn-danger" onclick='rmRow(this,event)'>{{trans('labels.delete')}}</a> </td>
                            </tr>
                            <tr>
                                <td><input type="text" class="form-control" order="1"></td>
                                <td><input type="text" class="form-control"></td>
                                <td><a href="#" class="btn btn-sm btn-danger" onclick='rmRow(this,event)'>{{trans('labels.delete')}}</a> </td>
                            </tr>
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
                            <tr>
                                <td><input type="text" class="form-control" order="0"></td>
                                <td><input type="text" class="form-control"></td>
                                <td><a href="#" class="btn btn-sm btn-danger" onclick='rmRow(this,event)'>{{trans('labels.delete')}}</a> </td>
                            </tr>
                            <tr>
                                <td><input type="text" class="form-control" order="1"></td>
                                <td><input type="text" class="form-control"></td>
                                <td><a href="#" class="btn btn-sm btn-danger" onclick='rmRow(this,event)'>{{trans('labels.delete')}}</a> </td>
                            </tr>
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
                            <tr>
                                <td><input type="text" class="form-control" value="Khmer" order="0"></td>
                                <td><input type="text" class="form-control"></td>
                                <td><a href="#" class="btn btn-sm btn-danger" onclick='rmRow(this,event)'>{{trans('labels.delete')}}</a> </td>
                            </tr>
                            <tr>
                                <td><input type="text" class="form-control" value="English" order="1"></td>
                                <td><input type="text" class="form-control"></td>
                                <td><a href="#" class="btn btn-sm btn-danger" onclick='rmRow(this,event)'>{{trans('labels.delete')}}</a> </td>
                            </tr>
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
                            <tr>
                                <td><input type="text" class="form-control" order="0"></td>
                                <td><input type="text" class="form-control"></td>
                                <td><a href="#" class="btn btn-sm btn-danger" onclick='rmRow(this,event)'>{{trans('labels.delete')}}</a> </td>
                            </tr>
                            <tr>
                                <td><input type="text" class="form-control" order="1"></td>
                                <td><input type="text" class="form-control"></td>
                                <td><a href="#" class="btn btn-sm btn-danger" onclick='rmRow(this,event)'>{{trans('labels.delete')}}</a> </td>
                            </tr>
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
                            <tr>
                                <td><input type="text" class="form-control" order="0"></td>
                                <td><a href="#" class="btn btn-sm btn-danger" onclick='rmRow(this,event)'>{{trans('labels.delete')}}</a> </td>
                            </tr>
                            <tr>
                                <td><input type="text" class="form-control" order="1"></td>
                                <td><a href="#" class="btn btn-sm btn-danger" onclick='rmRow(this,event)'>{{trans('labels.delete')}}</a> </td>
                            </tr>
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
                            <option value="" selected disabled>{{trans('labels.first_option')}}</option>
                            @foreach ($categories as $cat)
                            <option value="{{$cat->name}}">{{$cat->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-4 col-sm-4">
                        <select class="form-control border-radius-none" id="favorite_job2" name="favorite_job2">
                            <option value="" selected disabled>{{trans('labels.second_option')}}</option>
                            @foreach ($categories as $cat)
                            <option value="{{$cat->name}}">{{$cat->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-4 col-sm-4">
                        <select class="form-control border-radius-none" id="favorite_job3" name="favorite_job3">
                            <option value="" selected disabled>{{trans('labels.third_option')}}</option>
                            @foreach ($categories as $cat)
                            <option value="{{$cat->name}}">{{$cat->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-12 col-sm-12">
                        <button class="btn btn-primary border-radius-none" type="button" id="btnSave">{{trans('labels.save')}}</button>
                        <button class="btn btn-danger border-radius-none" type="reset">{{trans('labels.cancel')}}</button>
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
                    url: burl +"/seeker/save_cv",
                    data: data,
                    beforeSend: function (request) {
                        return request.setRequestHeader('X-CSRF-Token', $("input[name='_token']").val());
                    },
                    success: function (sms) {
                        location.href = burl + "/seeker/cv";
                    },
                    error: function(){
                        location.href = burl + "/seeker/cv";
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
