@extends('layouts.app')
@section('content')
<link href="{{asset('js/chosen/docsupport/style.css')}}" rel="stylesheet">
<link href="{{asset('js/chosen/docsupport/prism.css')}}" rel="stylesheet">
<link href="{{asset('js/chosen/chosen.css')}}" rel="stylesheet">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-bold">
                    <i class="fa fa-align-justify"></i> Edit Success Candidate&nbsp;&nbsp;
                    <a href="{{url('/success-candidate')}}" class="btn btn-link btn-sm">Back To List</a>
                </div>
                <div class="card-block">
                    @if(Session::has('sms'))
                        <div class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <div>
                                {{session('sms')}}
                            </div>
                        </div>
                    @endif
                    @if(Session::has('sms1'))
                        <div class="alert alert-danger" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <div>
                                {{session('sms1')}}
                            </div>
                        </div>
                    @endif
                    <form action="{{url('/success-candidate/update')}}" 
                        class="form-horizontal" 
                        method="post" 
                        id="form_success_candidate"
                        onsubmit="check(event)"
                    >
                        {{csrf_field()}}
                        <input type="hidden" name="id" id="id" value="{{$success_candidate->cadidate_id}}">
                        <div class="form-group row">
                            <label for="choose_candidate" class="control-label col-lg-2 col-sm-2">
                                Choose Candidate <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6 col-sm-8">
                                <select class="form-control chosen-select my_select_box chosen-rtl" id="choose_candidate" data-placeholder="Select Your Options" name="employee" id="employee"  id="exampleSelect1">
                                    @foreach($employees as $emp)
                                    <option value="{{$emp->id}}" {{$success_candidate->first_name==$emp->first_name && $success_candidate->last_name==$emp->last_name?'selected':''}} >{{$emp->first_name}} {{$emp->last_name}}</option> 
                                    @endforeach               
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description" class="control-label col-lg-2 col-sm-2">
                                Description
                            </label>
                            <div class="col-lg-4 col-sm-6">
                               <textarea class="form-control" name="description" id="description" rows="4">{{$success_candidate->description}}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-lg-2 col-sm-2">&nbsp;</label>
                            <div class="col-lg-6 col-sm-8">
                                <button class="btn btn-primary" type="submit">Save Change</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{asset('js/chosen/chosen.jquery.js')}}"></script>
    <script src="{{asset('js/chosen/docsupport/prism.js')}}"></script>
    <script src="{{asset('js/chosen/docsupport/init.js')}}"></script>
@endsection