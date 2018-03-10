@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-bold">
                    <i class="fa fa-align-justify"></i> Employer Email List&nbsp;&nbsp;
                </div>
                <div class="card-block">
                    <table class="tbl">
                        <thead>
                            <tr>
                                <th>&numero;</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Gender</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($i=1)
                            @foreach($employer_emails as $emp)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$emp->first_name}}</td>
                                    <td>{{$emp->last_name}}</td>
                                    <td>{{$emp->gender}}</td>
                                    <td>{{$emp->email}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table><br>
                    {{ $employer_emails->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection