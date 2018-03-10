@extends('layouts.employer')
@section('content')
    <div class="page-title" style="background: #FFECB3;">
        {{trans('labels.find_cv')}}
    </div>
    <div class="border">
            <form action="{{url('/employer/search/cv')}}" method="get">
                <div class="form-group row">
                        <label for="category" class="control-label col-sm-2">{{trans('labels.category')}}</label>
                       <div class="col-sm-5">
                           <select name="id" id="id" class="form-control">
                                @foreach($categories as $cat)
                                   <option value="{{$cat->name}}" {{$cat->name==$sid?"selected":""}}>{{$cat->name}}</option>
                                @endforeach
                           </select>
                       </div>
                        <div class="col-sm-1">
                            <button class="btn btn-primary btn-sm" type="submit">{{trans('labels.search')}}</button>
                        </div>
                </div>
            </form>
            <div class="row">
                <div class="col-sm-12">
                    {{--@if(count($cvs==0))--}}
                        {{--<p class="text-center">--}}
                            {{--<strong>No result found!</strong>--}}
                        {{--</p>--}}
                    {{--@else--}}
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>{{trans('labels.photo')}}</th>
                                <th>{{trans('labels.name')}}</th>
                                <th>{{trans('labels.gender')}}</th>
                                <th>{{trans('labels.dob')}}</th>
                                <th>{{trans('labels.address')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($cvs as $cv)
                                <tr>
                                    <td><img src="{{asset('uploads/photo/'.$cv->profile_photo)}}" alt="" style="width: 36px;"></td>
                                    <td>
                                        <a href="{{url('/employer/showcv/'. $cv->id)}}">
                                            {{$cv->last_name . " " . $cv->first_name}}
                                        </a>

                                    </td>
                                    <td>{{$cv->gender}}</td>
                                    <td>{{$cv->dob}}</td>
                                    <td>{{$cv->address}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    {{--@endif--}}
                        {{$cvs->links()}}
                </div>
            </div>
@endsection
@section('js')
    <script src="{{asset('js/jquery.inputmask.bundle.min.js')}}"></script>
    <script src="{{asset('js/ckeditor/ckeditor.js')}}"></script>
    <script>
        $(document).ready(function () {
            $("#closing_date").inputmask('9999-99-99');
            CKEDITOR.replace('description');
            CKEDITOR.replace('requirement');
        });
    </script>
@endsection