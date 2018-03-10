@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-bold">
                    <i class="fa fa-align-justify"></i> Header Top Contact&nbsp;&nbsp;
                    @if (count($header_top_contact) == 0)
                        <a href="{{url('/header_top_contact/create')}}" class="btn btn-link btn-sm">
                             New
                        </a>
                    @endif
                </div>
                <div class="card-block">

                   <table class="tbl">
                        <thead>
                            <tr>
                                <th>&numero;</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Work Time</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($i=1)
                            @foreach($header_top_contact as $htc)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$htc->phone}}</td>
                                    <td>{{$htc->email}}</td>
                                    <td>{{$htc->work_time}}</td>
                                    <td>
                                        <a href="{{url('/header_top_contact/edit/'.$htc->id)}}" title="Edit"><i class="fa fa-edit text-success"></i></a>&nbsp;&nbsp;
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection