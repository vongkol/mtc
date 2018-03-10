<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use File;
use Auth;
class CvListController extends Controller
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
    public function index(Request $r)
    {
        if(!Right::check('CV List', 'l'))
        {
            return view('permissions.no');
        }
        $q = "";
        if($r->category!=null)
        {
            $q = $r->category;
            $data['q'] = $q;
            $data['cvs'] = DB::table('resume')
            ->join('employees', 'resume.employee_id', '=', 'employees.id')
            ->select('resume.*', 'employees.first_name', 'employees.last_name')
            ->where('resume.active', 1)
            ->where(function($query) use ($q) {
                $query->where("resume.favorite_job1", "like", "%{$q}%")
                ->orWhere("resume.favorite_job2", "like", "%{$q}%")
                ->orWhere("resume.favorite_job3", "like", "%{$q}%");
            })
            ->orderBy('resume.id','desc')
            ->paginate(18);
            $data['total'] = DB::table("resume")
            ->where("active", 1)
            ->where(function($query) use ($q) {
                $query->where("favorite_job1", "like", "%{$q}%")
                ->orWhere("favorite_job2", "like", "%{$q}%")
                ->orWhere("favorite_job3", "like", "%{$q}%");
            })
            ->count();
            $data['male'] = DB::table("resume")
            ->where("active", 1)
            ->where("gender","Male")
            ->where(function($query) use ($q) {
                $query->where("favorite_job1", "like", "%{$q}%")
                ->orWhere("favorite_job2", "like", "%{$q}%")
                ->orWhere("favorite_job3", "like", "%{$q}%");
            })
            ->count();
            $data['female'] = DB::table("resume")
            ->where("active", 1)
            ->where("gender", "Female")
            ->where(function($query) use ($q) {
                $query->where("favorite_job1", "like", "%{$q}%")
                ->orWhere("favorite_job2", "like", "%{$q}%")
                ->orWhere("favorite_job3", "like", "%{$q}%");
            })
            ->count();
            $data['categories'] = DB::table("categories")->where("active",1)->orderBy("name")->get();
            return view('cvs.index', $data);
        }
        else{
            $data['q'] = $q;
            $data['cvs'] = DB::table('resume')
            ->join('employees', 'resume.employee_id', '=', 'employees.id')
            ->select('resume.*', 'employees.first_name', 'employees.last_name')
            ->where('resume.active', 1)
            ->orderBy('resume.id','desc')
            ->paginate(18);
            $data['total'] = DB::table("resume")->where("active", 1)->count();
            $data['male'] = DB::table("resume")->where("active", 1)->where("gender","Male")->count();
            $data['female'] = DB::table("resume")->where("active", 1)->where("gender", "Female")->count();
            $data['categories'] = DB::table("categories")->where("active",1)->orderBy("name")->get();
            return view('cvs.index', $data);
        }
       
    }
    public function create()
    {
        if(!Right::check('CV List', 'i'))
        {
            return view('permissions.no');
        }
        $data['categories'] = DB::table('categories')
        ->where('active',1)
        ->orderBy("name")
        ->get();
        $data['nationalities'] = DB::table('nationalities')->where('active',1)->orderBy('order_number')->get();
        return view('cvs.create', $data);
    }
    // delete resume
    public function delete($id)
    {
        if(!Right::check('CV List', 'd'))
        {
            return view('permissions.no');
        }

        $file = DB::table('documents')->where('seeker_id', $id)->first();
        if ($file!=null)
        {
            $file_path = public_path("uploads/docs/".$file->name);
            $i=0;
            if(File::exists($file_path))
            {
                File::delete($file_path);
                $i = DB::table('documents')->where('seeker_id', $id)->delete();
            }
            else{
                $i = DB::table('documents')->where('seeker_id', $id)->delete();
            }
        }

        // delete resume
        DB::table('resume')->where('id', $id)->update(['active'=>0]);
        DB::table('educations')->where('seeker_id', $id)->update(['active'=>0]);
        DB::table('experiences')->where('seeker_id', $id)->update(['active'=>0]);
        DB::table('skills')->where('seeker_id', $id)->update(['active'=>0]);
        DB::table('training')->where('seeker_id', $id)->update(['active'=>0]);
        DB::table('languages')->where('seeker_id', $id)->update(['active'=>0]);
        DB::table('hobbies')->where('seeker_id', $id)->update(['active'=>0]);
        
        return redirect('cvlist');
    }

    // job detail
    public function detail($id)
    {

        $data['cv'] = DB::table('resume')
        ->join('employees', 'resume.employee_id', 'employees.id')
        ->where('resume.active', 1)
        ->where('resume.id', $id)
        ->select('resume.*', 'employees.first_name', 'employees.last_name', 'employees.email', 'employees.phone', 'employees.profile_photo', 'employees.gender as sex', 'resume.id as id')
        ->first();
        $emp_id = $data['cv']->employee_id;
        $data['educations'] = DB::table('educations')
            ->where("seeker_id", $emp_id)
            ->where('active', 1)
            ->orderBy("order_number")
            ->get();
        $data['experiences'] = DB::table('experiences')
            ->where('seeker_id', $emp_id)
            ->where('active', 1)
            ->orderBy("order_number")
            ->get();
        $data['trainings'] = DB::table('training')
            ->where('seeker_id', $emp_id)
            ->where('active', 1)
            ->orderBy("order_number")
            ->get();
        $data['languages'] = DB::table('languages')
            ->where('seeker_id', $emp_id)
            ->where('active', 1)
            ->orderBy("order_number")
            ->get();
        $data['skills'] = DB::table('skills')
            ->where('seeker_id', $emp_id)
            ->where('active', 1)
            ->orderBy("order_number")
            ->get();
        $data['hobbies'] = DB::table('hobbies')
            ->where('seeker_id', $emp_id)
            ->where('active', 1)
            ->orderBy("order_number")
            ->get();
        $data['logo'] = DB::table('logos')
            ->get();
        $data['documents'] = DB::table('documents')
            ->where('seeker_id', $emp_id)
            ->get();
        return view('cvs.detail', $data);
    }
    public function save(Request $r)
    {
        $info = json_encode($r->personal_info);
        $info = json_decode($info);
        $emp = json_encode($r->emp);
        $emp = json_decode($emp);
        // save employee basic info
        $emp = array(
            "first_name" => $emp->first_name,
            "last_name" => $emp->last_name,
            "gender" => $emp->gender,
            "dob" => $emp->dob,
            "phone" => $emp->phone,
            "email" => $emp->email,
            "username" => $emp->first_name,
            "password" => bcrypt($emp->first_name)
        );
        $emp_id = DB::table("employees")->insertGetId($emp);

        $data = array(
            "employee_id" => $emp_id,
            "address" => $info->address,
            "dob" => $info->dob,
            "pob" => $info->pob,
            "gender" => $info->gender,
            "nationality" => $info->nationality,
            "permanent_address" => $info->paddress,
            "favorite_job1" => $info->favorite_job1,
            "favorite_job2" => $info->favorite_job2,
            "favorite_job3" => $info->favorite_job3
        );
        // get education
        $edu = json_encode($r->education);
        $edu = json_decode($edu);
        $educations = array();
        for($i=0;$i<count($edu);$i++)
        {
            if($edu[$i]->name!="")
            {
                $x = array(
                    "year" => $edu[$i]->name,
                    "description" => $edu[$i]->description,
                    "seeker_id" => $emp_id,
                    "order_number" => $edu[$i]->order
                );
                $educations[] = $x;
            }
           
        }
        // get experience
        $exp = json_encode($r->experience);
        $exp = json_decode($exp);
        $experiences = array();
        for($i=0;$i<count($exp); $i++)
        {
            if($exp[$i]->name!="")
            {
                $x = array(
                    "year" => $exp[$i]->name,
                    "description" => $exp[$i]->description,
                    "seeker_id" => $emp_id,
                    "order_number" => $exp[$i]->order
                );
                $experiences[] = $x;
            }
           
        }
        // get training
        $train = json_encode($r->training);
        $train = json_decode($train);
        $trainings = array();
        for($i=0;$i<count($train); $i++)
        {
            if($train[$i]->name!="")
            {
                $x = array(
                    "training_date" => $train[$i]->name,
                    "description" => $train[$i]->description,
                    "seeker_id" => $emp_id,
                    "order_number" => $train[$i]->order
                );
                $trainings[] = $x;
            }
           
        }
        // get skill
        $skill = json_encode($r->skill);
        $skill = json_decode($skill);
        $skills = array();
        for($i=0;$i<count($skill); $i++)
        {
            if($skill[$i]->name!="")
            {
                $x = array(
                    "name" => $skill[$i]->name,
                    "description" => $skill[$i]->description,
                    "seeker_id" => $emp_id,
                    "order_number" => $skill[$i]->order
                );
                $skills[] = $x;
            }
           
        }
        // get language
        $lang = json_encode($r->language);
        $lang = json_decode($lang);
        $languages = array();
        for($i=0;$i<count($lang); $i++)
        {
            if($lang[$i]->name!="")
            {
                $x = array(
                    "name" => $lang[$i]->name,
                    "description" => $lang[$i]->description,
                    "seeker_id" => $emp_id,
                    "order_number" => $lang[$i]->order
                );
                $languages[] = $x;
            }
            
        }
        // get hobbies
        $hob = json_encode($r->hobbies);
        $hob = json_decode($hob);
        $hobbies = array();
        for($i=0;$i<count($hob); $i++)
        {
            if($hob[$i]->name!="")
            {
                $x = array(
                    "name" => $hob[$i]->name,
                    "seeker_id" => $emp_id,
                    "order_number" => $hob[$i]->order
                );
                $hobbies[] = $x;
            }
           
        }
        if($emp_id>0)
        {
            $i = DB::table('resume')->insertGetId($data);
            if($i>0)
            {
                // insert edu
                if(count($educations)>0)
                {
                    DB::table("educations")->insert($educations);
                }
                if(count($experiences)>0)
                {
                    DB::table("experiences")->insert($experiences);
                }
                if(count($trainings)>0)
                {
                    DB::table("training")->insert($trainings);
                }
                if(count($skills)>0)
                {
                    DB::table("skills")->insert($skills);
                }
                if(count($languages)>0)
                {
                    DB::table("languages")->insert($languages);
                }
                if(count($hobbies)>0)
                {
                    DB::table("hobbies")->insert($hobbies);
                }
               
            }
                    
        return $i;
        }
        else{
            return 0;
        }
    }
    public function edit_photo($id)
    {
        $cv = DB::table("resume")->where("id", $id)->first();
        $data['employee'] = DB::table("employees")->where("id",$cv->employee_id)->first();
        $data['cv'] = $cv;
        return view("cvs.edit-photo", $data);
    }
    public function upload_photo(Request $r)
    {
        if($r->hasFile("photo")) {
            $file = $r->file('photo');
            $file_name = $r->employee_id . "-" .$file->getClientOriginalName();
            $destinationPath = 'uploads/photo/';
            $file->move($destinationPath, $file_name);
            DB::table("employees")->where("id", $r->employee_id)->update(["profile_photo"=>$file_name]);
        }
        return redirect("/cvlist/detail/".$r->cv_id);
    }
    // load attach file form
    public function attach($id)
    {
        $cv = DB::table("resume")->where("id", $id)->first();
        $data['employee'] = DB::table("employees")->where("id",$cv->employee_id)->first();
        $data['cv'] = $cv;
        return view("cvs.attach", $data);
    }
    public function upload_file(Request $r)
    {
        if($r->hasFile("name"))
        {

            $r->session()->flash('sms', "Your file has been uploaded successfully!");
            $data = array(
                'name' => "",
                'description' => $r->description,
                'seeker_id' => $r->employee_id
            );
            $i = DB::table('documents')->insertGetId($data);
            if($i)
            {
                // upload file
                $file = $r->file('name');
                $file_name = $i . "-" .$file->getClientOriginalName();
                $destinationPath = 'uploads/docs/';
                $file->move($destinationPath, $file_name);
                $data = array(
                    'name' => $file_name
                );
                DB::table('documents')->where('id', $i)->update($data);
            }
            return redirect("/cvlist/attach/".$r->cv_id);
        }
        else{
            $r->session()->flash('sms1', "Please select a file to upload!");
            return redirect("/cvlist/attach/".$r->cv_id);
        }
    }
    public function delete_file($id)
    {
        $i = DB::table("documents")->where("id", $id)->delete();
        return $i;
    }
    public function edit_cv($id)
    {
        if(!Right::check('CV List', 'u'))
        {
            return view('permissions.no');
        }
        $data['cv'] = DB::table('resume')->where("id", $id)->first();
        $seeker = DB::table("employees")->where("id", $data['cv']->employee_id)->first();
        $data['employee'] = $seeker;

        $data['educations'] = DB::table('educations')
            ->where("seeker_id", $seeker->id)
            ->where('active', 1)
            ->orderBy("order_number")
            ->get();
        $data['experiences'] = DB::table('experiences')
            ->where('seeker_id', $seeker->id)
            ->where('active', 1)
            ->orderBy("order_number")
            ->get();
        $data['trainings'] = DB::table('training')
            ->where('seeker_id', $seeker->id)
            ->where('active', 1)
            ->orderBy("order_number")
            ->get();
        $data['languages'] = DB::table('languages')
            ->where('seeker_id', $seeker->id)
            ->where('active', 1)
            ->orderBy("order_number")
            ->get();
        $data['skills'] = DB::table('skills')
            ->where('seeker_id', $seeker->id)
            ->where('active', 1)
            ->orderBy("order_number")
            ->get();
        $data['hobbies'] = DB::table('hobbies')
            ->where('seeker_id', $seeker->id)
            ->where('active', 1)
            ->orderBy("order_number")
            ->get();
        $data['categories'] = DB::table('categories')
            ->where('active',1)
            ->orderBy('name')
            ->get();
        $data['nationalities'] = DB::table('nationalities')->where('active',1)->orderBy('order_number')->get();
        return view('cvs.edit-cv', $data);
    }
    public function update_cv(Request $r)
    {
        
        $info = json_encode($r->personal_info);
        $info = json_decode($info);
        $emp = json_encode($r->emp);
        $emp = json_decode($emp);
       
        // update employee first
        $data = array(
            "first_name" => $emp->first_name,
            "last_name" => $emp->last_name,
            "gender" => $emp->gender,
            "dob" => $emp->dob,
            "phone" => $emp->phone,
            "email" => $emp->email,
            "username" => $emp->first_name
        );
       
       if($emp->password!=null)
       {
            $data["password"] = bcrypt($emp->password);
       }
        $emp_id = $emp->employee_id;
        $cv_id = $info->cv_id;
        $i = DB::table("employees")->where("id", $emp_id)->update($data);
       // update resume
       $data = array(
            "address" => $info->address,
            "dob" => $info->dob,
            "pob" => $info->pob,
            "gender" => $info->gender,
            "nationality" => $info->nationality,
            "permanent_address" => $info->paddress,
            "favorite_job1" => $info->favorite_job1,
            "favorite_job2" => $info->favorite_job2,
            "favorite_job3" => $info->favorite_job3
        );
        $i = DB::table("resume")->where("id", $cv_id)->update($data);

        // get education
        $edu = json_encode($r->education);
        $edu = json_decode($edu);
        $educations = array();
        for($i=0;$i<count($edu);$i++)
        {
            $x = array(
                "year" => $edu[$i]->name,
                "description" => $edu[$i]->description,
                "seeker_id" => $emp_id,
                "order_number" => $edu[$i]->order
            );
            $educations[] = $x;
        }
        // get experience
        $exp = json_encode($r->experience);
        $exp = json_decode($exp);
        $experiences = array();
        for($i=0;$i<count($exp); $i++)
        {
            $x = array(
                "year" => $exp[$i]->name,
                "description" => $exp[$i]->description,
                "seeker_id" => $emp_id,
                "order_number" => $exp[$i]->order
            );
            $experiences[] = $x;
        }
        // get training
        $train = json_encode($r->training);
        $train = json_decode($train);
        $trainings = array();
        for($i=0;$i<count($train); $i++)
        {
            $x = array(
                "training_date" => $train[$i]->name,
                "description" => $train[$i]->description,
                "seeker_id" => $emp_id,
                "order_number" => $train[$i]->order
            );
            $trainings[] = $x;
        }
        // get skill
        $skill = json_encode($r->skill);
        $skill = json_decode($skill);
        $skills = array();
        for($i=0;$i<count($skill); $i++)
        {
            $x = array(
                "name" => $skill[$i]->name,
                "description" => $skill[$i]->description,
                "seeker_id" => $emp_id,
                "order_number" => $skill[$i]->order
            );
            $skills[] = $x;
        }
        // get language
        $lang = json_encode($r->language);
        $lang = json_decode($lang);
        $languages = array();
        for($i=0;$i<count($lang); $i++)
        {
            $x = array(
                "name" => $lang[$i]->name,
                "description" => $lang[$i]->description,
                "seeker_id" => $emp_id,
                "order_number" => $lang[$i]->order
            );
            $languages[] = $x;
        }
        // get hobbies
        $hob = json_encode($r->hobbies);
        $hob = json_decode($hob);
        $hobbies = array();
        for($i=0;$i<count($hob); $i++)
        {
            $x = array(
                "name" => $hob[$i]->name,
                "seeker_id" => $emp_id,
                "order_number" => $hob[$i]->order
            );
            $hobbies[] = $x;
        }
        // insert edu
        DB::table("educations")->where("seeker_id", $emp_id)->delete();
        DB::table("experiences")->where("seeker_id", $emp_id)->delete();
        DB::table("training")->where("seeker_id", $emp_id)->delete();
        DB::table("skills")->where("seeker_id", $emp_id)->delete();
        DB::table("languages")->where("seeker_id", $emp_id)->delete();
        DB::table("hobbies")->where("seeker_id", $emp_id)->delete();

        DB::table("educations")->insert($educations);
        DB::table("experiences")->insert($experiences);
        DB::table("training")->insert($trainings);
        DB::table("skills")->insert($skills);
        DB::table("languages")->insert($languages);
        DB::table("hobbies")->insert($hobbies);
        return $cv_id;
    }
}