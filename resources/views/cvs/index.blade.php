@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-bold">
                    <form action="{{url('/cvlist')}}" method="get" class="form-horizontal">
                        <i class="fa fa-align-justify"></i> CV List&nbsp;&nbsp;
                        <a href="{{url('/cvlist/create')}}" class="btn btn-link btn-sm">New</a>
                        &nbsp;&nbsp;
                        <select id="category" name="category">
                        <option value="">Select a category</option>
                        @foreach($categories as $cat)
                            <option value="{{$cat->name}}" {{$cat->name==$q?'selected':''}}>{{$cat->name}}</option>
                        @endforeach
                        </select>
                        <button type="submit">Filter</button>
                    </form>
                </div>
                <div class="card-block">

                    <table class="tbl">
                        <thead>
                            <tr>
                            <th>&numero;</th>
                            <th>Employee Name</th>
                            <th>Address</th>
                            <th>Date of Birth</th>
                            <th>Gender</th>
                            <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($i=1)
                            @foreach($cvs as $cv)
                                <tr>
                                <td>{{$cv->id}}</td>
                                <td><a href="{{url('/cvlist/detail/'.$cv->id)}}">{{$cv->first_name}} &nbsp;{{$cv->last_name}}</a></td>
                                <td>{{$cv->address}}</td></td>
                                <td>{{$cv->dob}}</td>
                                <td>{{$cv->gender}}</td>
                                <td>
                                    <a href="{{url('/cvlist/delete/'.$cv->id)}}" onclick="return confirm('Do you want to delete?')" title="Delete"><i class="fa fa-remove text-danger"></i></a>
                                </td>
                                </tr>
                            @endforeach
                                <tr>
                                <td colspan="6">
                                    Total: {{$total}}, Male: {{$male}}, Female: {{$female}}
                                </td>
                            </tr>
                        </tbody>
                    </table><br>
                   {!! $cvs->appends(Illuminate\Support\Facades\Input::except('page'))->links() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
