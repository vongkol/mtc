<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
class SeekerController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
           app()->setLocale(Session::get("lang"));
            return $next($request);
        });
    }
    public function index(Request $r)
    {
        // check if seeker login
        $seeker = $r->session()->get('seeker');
        if($seeker==NULL)
        {
            return redirect('/seeker/login');
        }
        return view('fronts.seekers.index');
    }
    // load seeker login view
    public function login(Request $request)
    {
        return view('fronts.seekers.seeker-login');
    }
    // load seeker register view
    public function register()
    {
        return view('fronts.seekers.seeker-register');
    }
    public function edit(Request $r)
    {
        $seeker = $r->session()->get('seeker');
        if($seeker==NULL)
        {
            return redirect('/seeker/login');
        }
        $data['seeker'] = DB::table('employees')->where('id', session('seeker')->id)->first();
        return view('fronts.seekers.edit-profile', $data);
    }
    // update seeker profile
    public function update(Request $r)
    {
        $data = [
            'first_name' => $r->first_name,
            'last_name' => $r->last_name,
            'gender' => $r->gender,
            'dob' => $r->dob,
            'phone' => $r->phone,
            'phone1' => $r->phone1,
            'email' => $r->email,
            'username' => $r->username
        ];
        // check if username or email already exist or not
        $count_username = DB::table('employees')->where('id',"!=", $r->id)
            ->where('username', $r->username)
            ->count();
        $count_email = DB::table('employees')->where('id', "!=", $r->id)
            ->where('email', $r->email)
            ->count();
        if($count_email>0)
        {
            if($r->session()->get('lang')=='en')
            {
                $r->session()->flash('sms1', "The email '{$r->email}' already exist. Change a new one!");
                
            }
            else{
                $r->session()->flash('sms1', "អុីម៉ែល '{$r->email}' មានគេប្រើរួចហើយ. សូមប្រើអុីម៉ែលផ្សេងទៀត!");                
            }
            return redirect('/seeker/edit/profile');
        }
        if($count_username>0)
        {
            if ($r->session()->get('lang')=='en') {
            $r->session()->flash('sms1', "The username '{$r->username}' already exist. Change a new one!");
            
            } else {
            $r->session()->flash('sms1', "ឈ្មេាះ '{$r->username}' មានគេប្រើរួចហើយ. សូមប្រើឈ្មេាះផ្សេង!");
            
            }
            
            return redirect('/seeker/edit/profile');
        }
        // upload photo
        if($r->hasFile("photo")) {
            $file = $r->file('photo');
            $file_name = $r->id . "-" .$file->getClientOriginalName();
            $destinationPath = 'uploads/photo/';
            $file->move($destinationPath, $file_name);
            $data["profile_photo"] = $file_name;
        }
        $i = DB::table('employees')->where('id', $r->id)->update($data);
        if($i)
        {
            if ($r->session()->get('lang')=='en') {
            $r->session()->flash('sms', "Your profile has been saved successfully!");
            
            } else {
            $r->session()->flash('sms', "ពត៌មានប្រូហ្វាល់របស់អ្នកត្រូវបានរក្សាទុកដោយជោគជ័យ!");
            
            }
            
             // save user to session
            $user = DB::table('employees')->where('id', $r->id)->first();
            $r->session()->put('seeker', $user);
            return redirect('/seeker');
        }
        else{
            if ($r->session()->get('lang')=='en') {
            $r->session()->flash('sms1', "Fail to save changes. You may not make any changes in your input!");
            
            } else {
            $r->session()->flash('sms1', "មិនអាចធ្វើការផ្លាស់ប្តូរពត៌មានបានទេ។ អ្នកប្រហែលជាមិនបានផ្លាស់ប្តូរអ្វីទេ!");
            
            }
            
            return redirect('/seeker/edit/profile');
        }
    }
    // load create cv form or cv view
    public function cv(Request $r)
    {
        $seeker = $r->session()->get('seeker');
        if($seeker==NULL)
        {
            return redirect('/seeker/login');
        }
        
        $data['cv'] = DB::table('resume')
            ->join('employees', 'resume.employee_id', 'employees.id')
            ->where('resume.active', 1)
            ->where('resume.employee_id', $seeker->id)
            ->select('resume.*', 'employees.first_name', 'employees.last_name', 'employees.email', 'employees.phone', 'employees.profile_photo', 'employees.gender as sex', 'resume.id as id')
            ->first();
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
        $data['logo'] = DB::table('logos')
            ->get();
        $data['documents'] = DB::table('documents')
            ->where('seeker_id', $seeker->id)
            ->get();
        return view('fronts.seekers.cv', $data);
    }
    // load create new cv form
    public function create_cv(Request $r)
    {
        $seeker = $r->session()->get('seeker');
        if($seeker==NULL)
        {
            return redirect('/seeker/login');
        }
        $data['seeker'] = DB::table('employees')
                        ->where('id', session('seeker')->id)
                        ->first();
        $data['categories'] = DB::table('categories')
            ->where('active',1)
            ->orderBy("name")
            ->get();
        $data['nationalities'] = DB::table('nationalities')->where('active',1)->orderBy('order_number')->get();
        return view('fronts.seekers.create-cv', $data);
    }
    // save seeker cv
    public function save_cv(Request $r)
    {
        $seeker = $r->session()->get('seeker');
        if($seeker==NULL)
        {
            return redirect('/seeker/login');
        }
        $employee_id = session('seeker')->id;
        $info = json_encode($r->personal_info);
        $info = json_decode($info);
        $data = array(
            "employee_id" => $employee_id,
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
                    "seeker_id" => $employee_id,
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
                    "seeker_id" => $employee_id,
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
                    "seeker_id" => $employee_id,
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
                    "seeker_id" => $employee_id,
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
                    "seeker_id" => $employee_id,
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
                    "seeker_id" => $employee_id,
                    "order_number" => $hob[$i]->order
                );
                $hobbies[] = $x;
            }
           
        }
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
    // edit seeker cv
    public function edit_cv(Request $r)
    {
        $seeker = $r->session()->get('seeker');
        if($seeker==NULL)
        {
            return redirect('/seeker/login');
        }

        $data['cv'] = DB::table('resume')
            ->join('employees', 'resume.employee_id', 'employees.id')
            ->where('resume.active', 1)
            ->where('resume.employee_id', $seeker->id)
            ->select('resume.*')
            ->first();
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
            ->get();
        $data['nationalities'] = DB::table('nationalities')->where('active',1)->orderBy('order_number')->get();
        return view('fronts.seekers.edit-cv', $data);
    }
    // update cv
    public function update_cv(Request $r)
    {
        $seeker = $r->session()->get('seeker');
        if($seeker==NULL)
        {
            return redirect('/seeker/login');
        }
        $employee_id = session('seeker')->id;
        $info = json_encode($r->personal_info);
        $info = json_decode($info);
        $data = array(
            "employee_id" => $employee_id,
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
        $id = $info->id;
        // get education
        $edu = json_encode($r->education);
        $edu = json_decode($edu);
        $educations = array();
        for($i=0;$i<count($edu);$i++)
        {
            $x = array(
                "year" => $edu[$i]->name,
                "description" => $edu[$i]->description,
                "seeker_id" => $employee_id,
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
                "seeker_id" => $employee_id,
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
                "seeker_id" => $employee_id,
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
                "seeker_id" => $employee_id,
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
                "seeker_id" => $employee_id,
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
                "seeker_id" => $employee_id,
                "order_number" => $hob[$i]->order
            );
            $hobbies[] = $x;
        }
        // insert edu
        DB::table("educations")->where("seeker_id", $employee_id)->delete();
        DB::table("experiences")->where("seeker_id", $employee_id)->delete();
        DB::table("training")->where("seeker_id", $employee_id)->delete();
        DB::table("skills")->where("seeker_id", $employee_id)->delete();
        DB::table("languages")->where("seeker_id", $employee_id)->delete();
        DB::table("hobbies")->where("seeker_id", $employee_id)->delete();

        DB::table("educations")->insert($educations);
        DB::table("experiences")->insert($experiences);
        DB::table("training")->insert($trainings);
        DB::table("skills")->insert($skills);
        DB::table("languages")->insert($languages);
        DB::table("hobbies")->insert($hobbies);
        $i = DB::table('resume')->where("id", $id)->update($data);
        return $i;
    }
    // load reset password form
    public function reset_password(Request $r)
    {
        $seeker = $r->session()->get('seeker');
        if($seeker==NULL)
        {
            return redirect('/seeker/login');
        }
        return view('fronts.seekers.reset-password');
    }
    // save new password
    public function save_password(Request $r)
    {
        $seeker = $r->session()->get('seeker');
        if($seeker==NULL)
        {
            return redirect('/seeker/login');
        }
        $employee_id = session('seeker')->id;
        $data = [
            'password' => password_hash($r->password, PASSWORD_BCRYPT)
        ];
        if($r->password!=$r->cpassword)
        {
            if ($r->session()->get('lang')=='en') {
            $r->session()->flash('sms1', "Your new password and confirm password is not match!");
            
            } else {
            $r->session()->flash('sms1', "លេខសម្ងាត់ និងបញ្ជាក់លេខសម្ងាត់ មិនត្រូវគ្នាទេ!");
            
            }
            
            return redirect('/seeker/reset-password');
        }
        $i = DB::table('employees')->where('id', $employee_id)->update($data);
        if($i)
        {
            if ($r->session()->get('lang')=='en') {
            $r->session()->flash('sms', "Your new password has been saved successfully!");
            
            } else {
            $r->session()->flash('sms', "លេខសម្ងាត់ថ្មីត្រូវបានរក្សាទុកដោយជោគជ័យ!");
            
            }
            
            return redirect('/seeker/reset-password');
        }
        else{
            if ($r->session()->get('lang')=='en') {
             $r->session()->flash('sms1', "Cannot reset your password!");
             
            } else {
             $r->session()->flash('sms1', "មិនអាចប្តូរលេខសម្ងាត់របស់អ្នកបានទេ!");
             
            }
            
            return redirect('/seeker/reset-password');
        }
    }

    public function print_cv($id) {
        $data['cv'] = DB::table('cvs')
                    ->join('employees', 'cvs.employee_id', 'employees.id')
                    ->where('cvs.active', 1)
                    ->where('cvs.employee_id', session('seeker')->id)
                    ->select('cvs.*', 'employees.*', 'cvs.id as id')
                    ->first();
        $data['logo'] = DB::table('logos')
                    ->get();
        return view('fronts.seekers.print-cv', $data);
    }

}
