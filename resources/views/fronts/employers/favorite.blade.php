@extends('layouts.employer')
@section('content')
    <div class="page-title" style="background: #FFECB3;">
       {{trans('labels.favorite_cv')}}
    </div>
    <div class="border">
        {{csrf_field()}}
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>{{trans('labels.name')}}</th>
                    <th>{{trans('labels.gender')}}</th>
                    <th>{{trans('labels.dob')}}</th>
                    <th>{{trans('labels.address')}}</th>
                    <th>{{trans('labels.action')}}</th>
                </tr>
            </thead>
            <tbody>
            @foreach($cvs as $cv)
                <tr cv-id="{{$cv->id}}" emp-id="{{$cv->employer_id}}">
                    <td>{{$cv->id}}</td>
                    <td>
                        <a href="{{url('/employer/showcv/'. $cv->id)}}">
                            {{$cv->last_name . " " . $cv->first_name}}
                        </a>
                    </td>
                    <td>{{$cv->gender}}</td>
                    <td>{{$cv->dob}}</td>
                    <td>{{$cv->address}}</td>
                    <td>
                        <a class="btn btn-sm btn-danger"  href="#" class="text-danger" onclick="rm(this,event)">Delete</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{$cvs->links()}}
    </div>
    <script>
        var burl = "{{url('/')}}";
        function rm(obj, evt) {
            evt.preventDefault();
            var tr = $(obj).parent().parent();
            var cv_id = $(tr).attr("cv-id");
            var emp_id = $(tr).attr("emp-id");
            var o = confirm("{{trans('labels.delete_sms')}}")
            if(o)
            {
                $.ajax({
                    type: "POST",
                    url: burl +"/favorite/delete",
                    data: {
                        id: cv_id,
                        emp: emp_id
                    },
                    beforeSend: function (request) {
                        return request.setRequestHeader('X-CSRF-Token', $("input[name='_token']").val());
                    },
                    success: function (sms) {
                        if(sms>=0)
                        {
                           tr.remove();
                        }
                    }
                });
            }
        }
    </script>
@endsection
