<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
class FrontController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
           app()->setLocale(Session::get("lang"));
            return $next($request);
        });
    }
    // index
    public function index()
    {
        $job_types = DB::table('job_types')
            ->where('active', 1)
            ->get();
        $cats = DB::table('categories')
            ->where('active',1)
            ->orderBy('name')
            ->get();
        $video_trainings = DB::table('video_trainings')
            ->where('active', 1)
            ->orderBy('order_number', 'asc')
            ->get();
        $training_courses = DB::table('training_courses')
            ->where('active', 1)
            ->orderBy('order_number', 'asc')
            ->get();
        $result = [];
        foreach ($cats as $cat)
        {
            $arr = [
                'id' => $cat->id,
                'name' => $cat->name,
                'total' => DB::table('jobs')
                ->join("companies", "jobs.employer_id", "companies.employer_id")
                ->where('jobs.active', 1)
                ->where('category_id', $cat->id)->where('jobs.closing_date', ">=", date('Y-m-d'))->count()
            ];
            $result[] = $arr;
        }
        return view('fronts.index', ['video_trainings'=>$video_trainings, 'result'=>$result, 'training_courses'=>$training_courses, "job_types"=>$job_types]);
    }
    public function category($id)
    {
        $data['categories'] = DB::table('categories')
            ->where('active',1)
            ->orderBy('name', 'asc')
            ->get();
        $data['jobs'] = DB::table('jobs')
            ->join("categories", "jobs.category_id", "categories.id")
            ->join("companies", "jobs.employer_id", "companies.employer_id")
            ->where('jobs.active', 1)
            ->where('jobs.category_id', $id)
            ->where('jobs.closing_date', ">=", date('Y-m-d'))
            ->select("jobs.id", "jobs.job_title", "jobs.create_at", "categories.name as catname", "jobs.closing_date", "companies.name as cname")
            ->orderBy("jobs.id", "desc")
            ->paginate(14);
        return view('fronts.job-by-category', $data);
    }
    public function job_list()
    {
        $data['categories'] = DB::table('categories')->where('active',1)
            ->orderBy('name')
            ->get();
        $data['jobs'] = DB::table('jobs')
            ->join("categories", "jobs.category_id", "categories.id")
            ->join("companies", "jobs.employer_id", "companies.employer_id")
            ->where('jobs.active', 1)
            ->where('jobs.closing_date', ">=", date('Y-m-d'))
            ->select("jobs.id", "jobs.job_title", "jobs.create_at", "categories.name as catname", "jobs.closing_date", "companies.name as cname")
            ->orderBy("jobs.id", "desc")
            ->paginate(14);
        return view('fronts.job-list', $data);
    }
    // job detail
    public function detail($id)
    {
        $data['categories'] = DB::table('categories')->where('active',1)
            ->orderBy('name')
            ->get();
        $data['job'] = DB::table("jobs")
            ->join("employers", "jobs.employer_id", "employers.id")
            ->join("categories", "jobs.category_id", "categories.id")
            ->join("companies", "jobs.employer_id", "companies.employer_id")
            ->where("jobs.id", $id)
            ->select("jobs.*", "employers.first_name", "employers.last_name", "employers.email", "employers.phone", "companies.name as cname", "categories.name as catname", "companies.address", "companies.description as profile")
            ->first();
        return view("fronts.job-detail", $data);
    }
    public function search(Request $r)
    {
        if($r->q)
        {
            $str = explode(" ", $r->q);
            $data['q'] = "";
            if (count($str)==1)
            {
                $data['jobs'] = DB::table('jobs')
                    ->join("categories", "jobs.category_id", "categories.id")
                    ->join("companies", "jobs.employer_id", "companies.employer_id")
                    ->where('jobs.active', 1)
                    ->where('jobs.closing_date', ">=", date('Y-m-d'))
                    ->Where(function ($query) use ($str){
                        $query->orWhere("jobs.job_title", "like", "%{$str[0]}%")
                            ->orWhere("jobs.job_type", "like", "%{$str[0]}%")
                            ->orWhere("jobs.location", "like", "%{$str[0]}%")
                            ->orWhere("jobs.description", "like", "%{$str[0]}%")
                            ->orWhere("jobs.requirement", "like", "%{$str[0]}%")
                            ->orWhere("categories.name", "like", "%{$str[0]}%")
                            ->orWhere("companies.name", "like", "%{$str[0]}%")
                            ->orWhere("companies.description", "like", "%{$str[0]}%");
                    })
                    ->select("jobs.id", "jobs.job_title", "jobs.create_at", "categories.name as catname", "jobs.closing_date", "companies.name as cname")
                    ->orderBy("jobs.id", "desc")
                    ->paginate(14);
            }
            else if(count($str)==2)
            {
                $data['jobs'] = DB::table('jobs')
                    ->join("categories", "jobs.category_id", "categories.id")
                    ->join("companies", "jobs.employer_id", "companies.employer_id")
                    ->where('jobs.active', 1)
                    ->where('jobs.closing_date', ">=", date('Y-m-d'))
                    ->Where(function ($query) use ($str){
                        $query->orWhere("jobs.job_title", "like", "%{$str[0]}%")
                            ->orWhere("jobs.job_title", "like", "%{$str[1]}%")
                            ->orWhere("jobs.job_type", "like", "%{$str[0]}%")
                            ->orWhere("jobs.job_type", "like", "%{$str[1]}%")
                            ->orWhere("jobs.location", "like", "%{$str[0]}%")
                            ->orWhere("jobs.location", "like", "%{$str[1]}%")
                            ->orWhere("jobs.description", "like", "%{$str[0]}%")
                            ->orWhere("jobs.description", "like", "%{$str[1]}%")
                            ->orWhere("jobs.requirement", "like", "%{$str[0]}%")
                            ->orWhere("jobs.requirement", "like", "%{$str[1]}%")
                            ->orWhere("categories.name", "like", "%{$str[0]}%")
                            ->orWhere("categories.name", "like", "%{$str[1]}%")
                            ->orWhere("companies.name", "like", "%{$str[0]}%")
                            ->orWhere("companies.name", "like", "%{$str[1]}%")
                            ->orWhere("companies.description", "like", "%{$str[0]}%")
                            ->orWhere("companies.description", "like", "%{$str[1]}%");
                    })
                    ->select("jobs.id", "jobs.job_title", "jobs.create_at", "categories.name as catname", "jobs.closing_date", "companies.name as cname")
                    ->orderBy("jobs.id", "desc")
                    ->paginate(14);
            }
            else{
                $data['jobs'] = DB::table('jobs')
                    ->join("categories", "jobs.category_id", "categories.id")
                    ->join("companies", "jobs.employer_id", "companies.employer_id")
                    ->where('jobs.active', 1)
                    ->where('jobs.closing_date', ">=", date('Y-m-d'))
                    ->Where(function ($query) use ($str){
                        $query->orWhere("jobs.job_title", "like", "%{$str[0]}%")
                            ->orWhere("jobs.job_title", "like", "%{$str[1]}%")
                            ->orWhere("jobs.job_title", "like", "%{$str[2]}%")
                            ->orWhere("jobs.job_type", "like", "%{$str[0]}%")
                            ->orWhere("jobs.job_type", "like", "%{$str[1]}%")
                            ->orWhere("jobs.job_type", "like", "%{$str[2]}%")
                            ->orWhere("jobs.location", "like", "%{$str[0]}%")
                            ->orWhere("jobs.location", "like", "%{$str[1]}%")
                            ->orWhere("jobs.location", "like", "%{$str[2]}%")
                            ->orWhere("jobs.description", "like", "%{$str[0]}%")
                            ->orWhere("jobs.description", "like", "%{$str[1]}%")
                            ->orWhere("jobs.description", "like", "%{$str[2]}%")
                            ->orWhere("jobs.requirement", "like", "%{$str[0]}%")
                            ->orWhere("jobs.requirement", "like", "%{$str[1]}%")
                            ->orWhere("jobs.requirement", "like", "%{$str[2]}%")
                            ->orWhere("categories.name", "like", "%{$str[0]}%")
                            ->orWhere("categories.name", "like", "%{$str[1]}%")
                            ->orWhere("categories.name", "like", "%{$str[2]}%")
                            ->orWhere("companies.name", "like", "%{$str[0]}%")
                            ->orWhere("companies.name", "like", "%{$str[1]}%")
                            ->orWhere("companies.name", "like", "%{$str[2]}%")
                            ->orWhere("companies.description", "like", "%{$str[0]}%")
                            ->orWhere("companies.description", "like", "%{$str[1]}%")
                            ->orWhere("companies.description", "like", "%{$str[2]}%");
                    })
                    ->select("jobs.id", "jobs.job_title", "jobs.create_at", "categories.name as catname", "jobs.closing_date", "companies.name as cname")
                    ->orderBy("jobs.id", "desc")
                    ->paginate(14);
            }
        }
        else{
            $data['jobs'] = DB::table('jobs')
                ->join("categories", "jobs.category_id", "categories.id")
                ->join("companies", "jobs.employer_id", "companies.employer_id")
                ->where('jobs.active', 1)
                ->where('jobs.closing_date', ">=", date('Y-m-d'))
                ->select("jobs.id", "jobs.job_title", "jobs.create_at", "categories.name as catname", "jobs.closing_date", "companies.name as cname")
                ->orderBy("jobs.id", "desc")
                ->paginate(14);
        }
        $data['q'] = $r->q;
        $data['categories'] = DB::table('categories')->where('active',1)
            ->orderBy('name')
            ->get();

        return view('fronts.search', $data);
    }
    public function by_job_type($id)
    {
        $data['categories'] = DB::table('categories')
        ->where('active',1)
        ->orderBy('name', 'asc')
        ->get();
        $data['companies'] = DB::table('companies')
            ->join('employers', 'companies.employer_id', '=', 'employers.id')
            ->where('companies.active', 1)
            ->select('companies.*', 'employers.first_name', 'employers.last_name')
            ->get();
        $data['partners'] = DB::table('partners')
            ->orderBy('sequence', "asc")
            ->where('active',1)
            ->get();
        $data['contact_us'] = DB::table('pages')
            ->where('id', 1)
            ->where('active', 1)
            ->first();
        $data['jobs'] = DB::table('jobs')
            ->join("employers", "jobs.employer_id", "employers.id")
            ->join("categories", "jobs.category_id", "categories.id")
            ->join('job_types', "jobs.job_type", "job_types.id")
            ->join("companies", "jobs.employer_id", "companies.employer_id")
            ->select("jobs.*", "employers.first_name", "job_types.name as job_type","employers.last_name", "employers.email", "employers.phone", "companies.name as cname", "categories.name as catname", "companies.address", "companies.description as profile")
            ->where('job_type', $id)
            ->where('jobs.active', 1)
            ->paginate(14);
        return view('fronts.job_type', $data);
    }
}
