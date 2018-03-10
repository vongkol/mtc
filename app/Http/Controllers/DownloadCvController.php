<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use Session;
class DownloadCvController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
           app()->setLocale(Session::get("lang"));
            return $next($request);
        });
    }
    // index
    public function download_cv(Request $r)
    {
        $employer = $r->session()->get('employer');
        if($employer==NULL)
        {
            return redirect('/employer/login');
        }
        $sub = DB::table("subscriptions")
            ->where("employer_id", $employer->id)
            ->where("active", 1)->first();
        $down = DB::table("downloads")->where("employer_id", $employer->id)
            ->first();
        if ($sub==null)
        {
            return view("fronts.employers.err");
        }
        $total = $sub->download;
        $curr = $down->download_number;
       if ($total>$curr && $sub->status>0)
       {
           DB::table("downloads")->where("employer_id", $employer->id)
               ->update(["download_number" => ($curr + 1)]);
           $id = $r->id;
           $seeker_id = DB::table("resume")->where("id",$id)->first()->employee_id;
           $data['cv'] = DB::table('resume')
               ->join('employees', 'resume.employee_id', 'employees.id')
               ->where('resume.active', 1)
               ->where('resume.id', $id)
               ->select('resume.*', 'employees.first_name', 'employees.last_name', 'employees.email', 'employees.phone', 'employees.phone1', 'employees.profile_photo', 'employees.gender as sex', 'resume.id as id')
               ->first();
           $data['educations'] = DB::table('educations')
               ->where("seeker_id", $seeker_id)
               ->where('active', 1)
               ->orderBy("order_number")
               ->get();
           $data['experiences'] = DB::table('experiences')
               ->where('seeker_id', $seeker_id)
               ->where('active', 1)
               ->orderBy("order_number")
               ->get();
           $data['trainings'] = DB::table('training')
               ->where('seeker_id', $seeker_id)
               ->where('active', 1)
               ->orderBy("order_number")
               ->get();
           $data['languages'] = DB::table('languages')
               ->where('seeker_id', $seeker_id)
               ->where('active', 1)
               ->orderBy("order_number")
               ->get();
           $data['skills'] = DB::table('skills')
               ->where('seeker_id', $seeker_id)
               ->where('active', 1)
               ->orderBy("order_number")
               ->get();
           $data['hobbies'] = DB::table('hobbies')
               ->where('seeker_id', $seeker_id)
               ->where('active', 1)
               ->orderBy("order_number")
               ->get();
           $data['logo'] = DB::table('logos')
               ->where("id",1)->first();
           $data['is_favorite'] = DB::table('favorite_cvs')
               ->where("cv_id", $id)
               ->where("employer_id", $employer->id)
               ->get();
           return view("fronts.employers.download-cv", $data);
       }
       else{
           return view("fronts.employers.err");
       }
    }
}
