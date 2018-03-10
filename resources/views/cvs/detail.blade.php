@extends('layouts.app')
@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-bold">
                    <i class="fa fa-align-justify"></i> CV Detail&nbsp;&nbsp;
                    <a href="{{url('/cvlist')}}" class="btn btn-link btn-sm">Back To List</a>
                </div>
                <div class="card-block">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="photo">
                                <img src="{{asset('uploads/photo/'. $cv->profile_photo)}}" alt="" style="width: 72px;">
                                <a href="{{url('/cvlist/editphoto/'.$cv->id)}}" id="editPhoto" name="editPhoto" class="btn btn-xs btn-success">Edit Photo</a>
                                <a href="{{url('/cvlist/edit/'.$cv->id)}}" class="btn btn-xs btn-primary">Edit CV</a>
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
                        <div class="col-sm-2">Date of Birth</div>
                        <div class="col-sm-9">: {{$cv->dob}}</div>
                    </div>
                        <div class="row">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-2">Place of Birth</div>
                            <div class="col-sm-9">: {{$cv->pob}}</div>
                        </div>
                        <div class="row">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-2">Gender</div>
                            <div class="col-sm-9">: {{$cv->gender}}</div>
                        </div>
                        <div class="row">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-2">Nationality</div>
                            <div class="col-sm-9">: {{$cv->nationality}}</div>
                        </div>
                        <div class="row">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-2">Permanent Add.</div>
                            <div class="col-sm-9">: {{$cv->permanent_address}}</div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <br>
                                <p><strong>Education Background</strong></p>
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
                                <p><strong>Work Experience</strong></p>
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
                                <p><strong>Training Course</strong></p>
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
                                <p><strong>Knowledge of Language</strong></p>
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
                                <p><strong>Other Skills</strong></p>
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
                                <p><strong>Hobbies</strong></p>
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
                                <p><strong>Contact Information</strong></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-2">Contact Name</div>
                            <div class="col-sm-9">: {{$cv->first_name . ' ' . $cv->last_name}}</div>
                        </div>
                        <div class="row">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-2">Email Address</div>
                            <div class="col-sm-9">: {{$cv->email}}</div>
                        </div>
                        <div class="row">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-2">Phone Number</div>
                            <div class="col-sm-9">: {{$cv->phone}}</div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <br>
                                <p><strong>Attached Documents</strong>
                                    &nbsp;&nbsp;
                                     <a href="{{url('/cvlist/attach/'.$cv->id)}}" class="btn btn-xs btn-primary">Attach File</a>
                                </p>
                            </div>
                        </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-condensed">
                                <thead>
                                <tr>
                                    <th>&numero;</th>
                                    <th>File Name</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i=1;?>
                                @foreach($documents as $doc)
                                    <tr id="{{$doc->id}}">
                                        <td>{{$i++}}</td>
                                        <td><a href="{{asset('uploads/docs/'.$doc->name)}}" target="_blank">{{$doc->name}}</a></td>
                                        <td>{{$doc->description}}</td>
                                        <td>
                                            <a href="#" onclick="rm(event,'{{$doc->id}}', this)"><i class="fa fa-remove text-danger"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        function rm(evt, id, obj)
        {
            evt.preventDefault();
            var o = confirm("You want to delete?");
            if(o)
            {
                $.ajax({
                    type: "GET",
                    url: burl + "/cvlist/deletefile/" + id,
                    success: function(sms)
                    {
                        if(sms>0)
                        {
                            $(obj).parent().parent().remove();
                        }
                    }
                });
            }
        }
    </script>
@endsection