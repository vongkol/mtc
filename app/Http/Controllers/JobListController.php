<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Auth;
class JobListController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::user()==null)
            {
                return redirect("/login");
            }
            return $next($request);
        });
    }
   // index
    public function index()
    {
        if(!Right::check('Job List', 'l'))
        {
            return view('permissions.no');
        }
        $data['jobs'] = DB::table('jobs')
            ->join('categories', 'jobs.category_id','=','categories.id')
            ->select('jobs.*', 'categories.name as name')
            ->where('jobs.active', 1)
            ->orderBy('id','desc')
            ->paginate(18);
        return view('joblist.index', $data);
    }

    // delete job
    public function delete($id)
    {
        if(!Right::check('Job List', 'd'))
        {
            return view('permissions.no');
        }
        // delete employer
        $i = DB::table('jobs')->where('id', $id)->update(['active'=>0]);
     
        return redirect('joblist');
    }
    // job detail
    public function detail($id)
    {
        $data['categories'] = DB::table('categories')->where('active',1)
            ->orderBy('name')
            ->get();
        $data['job'] = DB::table("jobs")
            ->join("employers", "jobs.employer_id", "employers.id")
            ->join("job_types", "jobs.job_type", "job_types.id")
            ->join("categories", "jobs.category_id", "categories.id")
            ->join("companies", "jobs.employer_id", "companies.employer_id")
            ->where("jobs.id", $id)
            ->select("jobs.*", "employers.first_name", "job_types.name as job_type", "employers.last_name", "employers.email", "employers.phone", "companies.name as cname", "categories.name as catname", "companies.address")
            ->first();
        return view("joblist.detail", $data);
    }
}