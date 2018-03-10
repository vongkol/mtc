<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Download CV</title>
    <link rel="stylesheet" href="{{asset('front/css/bootstrap.min.css')}}">
</head>
<body>
   <div class="container" style="position: relative;">
       <img src="{{asset('uploads/photo/'. $cv->profile_photo)}}" alt="" style="width: 72px; position: absolute; right: 18px;top: 27px">
       <table style="width: 100%" align="center">
           <tr>
               <td style="width: 200px; text-align: center;">

                   <img src="{{URL::asset('/img/').'/'.$logo->photo}}" style="margin-top: 18px">
                   <h3>{{$logo->name}}</h3>
                   <hr>

               </td>

           </tr>
       </table>
       <h4>{{$cv->first_name . ' ' . $cv->last_name}}</h4>
       <table>
           <tr>
               <td style="width: 36px"></td>
               <td colspan="2"><p>{{$cv->address}}</p></td>
           </tr>
           <tr>
               <td style="width: 36px"></td>
               <td style="width: 127px">{{trans('labels.dob')}}</td>
               <td>: {{$cv->dob}}</td>
           </tr>
           <tr>
               <td></td>
               <td>{{trans('labels.pob')}}</td>
               <td>: {{$cv->pob}}</td>
           </tr>
           <tr>
               <td></td>
               <td>{{trans('labels.gender')}}</td>
               <td>: {{$cv->gender}}</td>
           </tr>
           <tr>
               <td></td>
               <td>{{trans('labels.nationality')}}</td>
               <td>: {{$cv->nationality}}</td>
           </tr>
           <tr>
               <td></td>
               <td>{{trans('labels.permanent_address')}}</td>
               <td>: {{$cv->permanent_address}}</td>
           </tr>
           <tr>
               <td></td>
               <td>{{trans('labels.email')}}</td>
               <td>: {{$cv->email}}</td>
           </tr>
           <tr>
               <td></td>
               <td>{{trans('labels.phone')}}</td>
               <td>: {{$cv->phone}}
                @if($cv->phone1!=null)
                    / {{$cv->phone1}}
                @endif
               </td>
           </tr>
       </table>
       <h4>{{trans('labels.education_background')}}</h4>
       <table>
           @foreach($educations as $edu)
           <tr>
               <td style="width: 36px"></td>
               <td style="width: 127px">{{$edu->year}}</td>
               <td>: {{$edu->description}}</td>
           </tr>
           @endforeach
       </table>
       <h4>{{trans('labels.work_experience')}}</h4>
       <table>
           @foreach($experiences as $exp)
               <tr>
                   <td style="width: 36px"></td>
                   <td style="width: 127px">{{$exp->year}}</td>
                   <td>: {{$exp->description}}</td>
               </tr>
           @endforeach
       </table>
       <h4>{{trans('labels.training_course')}}</h4>
       <table>
           @foreach($trainings as $tr)
               <tr>
                   <td style="width: 36px"></td>
                   <td style="width: 127px">{{$tr->training_date}}</td>
                   <td>: {{$tr->description}}</td>
               </tr>
           @endforeach
       </table>
       <h4>{{trans('labels.knowledge_language')}}</h4>
       <table>
           @foreach($languages as $lang)
               <tr>
                   <td style="width: 36px"></td>
                   <td style="width: 127px">{{$lang->name}}</td>
                   <td>: {{$lang->description}}</td>
               </tr>
           @endforeach
       </table>
       <h4>{{trans('labels.hobbies')}}</h4>
       <table>
           <tr>
               <td style="width: 36px"></td>
               <td>
                   <ul>
                       @foreach($hobbies as $h)
                           <li>{{$h->name}}</li>
                       @endforeach
                   </ul>
               </td>
           </tr>
       </table>
       <h4>{{trans('labels.favorite_job')}}</h4>
       <table>
           <tr>
               <td style="width: 36px"></td>
               <td>
                   <ul>
                      <li>#1: {{$cv->favorite_job1}}</li>
                      <li>#2: {{$cv->favorite_job2}}</li>
                      <li>#3: {{$cv->favorite_job3}}</li>
                   </ul>
               </td>
           </tr>
       </table>

   </div>
   <script>
       window.onload = function () {
           print();
       }
   </script>
</body>
</html>