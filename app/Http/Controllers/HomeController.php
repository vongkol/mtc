<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Right::check('Dashboard', 'l'))
        {
            return view('permissions.no');
        }
        // employee
        $data["total_employee"] = DB::table("employees")->where("active",1)->count();
        $data["male_employee"] = DB::table("employees")->where("active",1)->where("gender", "Male")->count();
        $data["female_employee"] = DB::table("employees")->where("active",1)->where("gender", "Female")->count();
        // employer
        $data["total_employer"] = DB::table("employers")->where("active",1)->count();
        $data["male_employer"] = DB::table("employers")->where("active",1)->where("gender", "Male")->count();
        $data["female_employer"] = DB::table("employers")->where("active",1)->where("gender", "Female")->count();
        // job
        $data['total_job'] = DB::table("jobs")->where("active",1)->count();
        // company
        $data['total_company'] = DB::table("companies")->where("active",1)->count();
        // resume
        $data['total_cv'] = DB::table("resume")->where("active",1)->count();
        $data['male_cv'] = DB::table("resume")->where("active",1)->where("gender","Male")->count();
        $data['female_cv'] = DB::table("resume")->where("active",1)->where("gender","Female")->count();
        return view('home', $data);
    }
}
