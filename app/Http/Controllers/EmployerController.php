<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use phpDocumentor\Reflection\Types\Null_;
use Session;
class EmployerController extends Controller
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
        // check if employer login
        $employer = $r->session()->get('employer');
        if($employer==NULL)
        {
            return redirect('/employer/login');
        }
        return view('fronts.employers.index');
    }
    // load employer login view
    public function login()
    {
        return view('fronts.employers.employer-login');
    }
        // job provider login
    public function do_login(Request $r)
    {
        if($r->session()->get('seeker')!=NULL)
        {
            $r->session()->forget('seeker');
            $r->session()->flush();
        }
        $username = $r->username;
        $pass = $r->password;
        $user = DB::table('employers')->where('active',1)->where('username', $username)->first();
        if($user!=null)
        {
            if(password_verify($pass, $user->password))
            {
                // save user to session
                $r->session()->put('employer', $user);
                return redirect('/employer');
            }
            else{
                if ($r->session()->get('lang')=='en') {
                    $r->session()->flash('sms1', "Invalid username or password. Try again!");
                    
                } else {
                    $r->session()->flash('sms1', "ឈ្មេាះឬលេខសម្ងាត់មិនត្រឹមត្រូវទេ។ សូមព្យាយាមម្តងទៀត!");
                    
                }
                
                return redirect('/employer/login')->withInput();
            }
        }
        else{
            if ($r->session()->get('lang')=='en') {
                $r->session()->flash('sms1', "Invalid username or password!");
            } else {
            $r->session()->flash('sms1', "ឈ្មេាះឬលេខសម្ងាត់មិនត្រឹមត្រូវទេ!");
            }
            
            return redirect('/employer/login')->withInput();
        }
    }
    // logout function
    public function logout(Request $request)
    {
        $lang = $request->session()->get('lang');
        $request->session()->forget('employer');
        $request->session()->flush();
        $request->session()->put('lang', $lang);
        return redirect('/employer/login');
    }
    // load seeker register view
    public function register()
    {
        return view('fronts.employers.employer-register');
    }
    // job provider register
    public function save(Request $r)
    {
        // check the email if it is valid or not
        if (!filter_var($r->email, FILTER_VALIDATE_EMAIL)) {
            if ($r->session()->get('lang')=='en') {
                $r->session()->flash('sms1', "Your email is invalid. Check it again!");
                
            } else {

                $r->session()->flash('sms1', "អុីម៉ែលរបស់អ្នកមិនត្រឹមត្រូវទេ។ សូមពិនិត្យម្តងទៀត!");
                
            }
            
            return redirect('/employer/register')->withInput();
        }
        $email = DB::table('employers')
            ->where('email', $r->email)
            ->where('active', 1)
            ->count();
        $username = DB::table('employers')
            ->where('username', $r->username)
            ->where('active', 1)
            ->count();

        if($email === 0 and $username === 0 ) {
            $data = array(
                'first_name' => $r->first_name,
                'last_name' => $r->last_name,
                'gender' => $r->gender,
                'dob' => $r->dob,
                'phone' => $r->phone,
                'email' => $r->email,
                'username' => $r->username,
                'password' => password_hash($r->password, PASSWORD_BCRYPT)
            );
            if ($r->session()->get('lang')=='en') {
                $sms = "You have registered successfully. Please Login!";
                $sms1 = "Cannot register your account. Please check your inputs again!";
            } else {
                
                $sms = "អ្នកបានចុះឈ្មេាះ ដោយជោគជ័យ។ សូមចូលក្នុងប្រព័ន្ធ";
                $sms1 = "អ្នកមិនអាចចុះឈ្មេាះបានទេ។ សូមពិនិត្យម្តងទៀត!";
            }
            
            $i = DB::table('employers')->insert($data);
            if ($i)
            {
                $r->session()->flash('sms', $sms);
                return redirect('/employer/login');
            }
            else
            {
                $r->session()->flash('sms1', $sms1);
                return redirect('/employer/register')->withInput();
            }
        } else {
            if ($email > 0) {
                if ($r->session()->get('lang')=='en') {

                    $sms1 = "Your email already exist. Please use a different one!";
                  
                } else {
                
                    $sms1 = "អុីម៉ែលរបស់អ្នកមានគេប្រើរួចហើយ។ សូមប្រើអុីម៉ែលផ្សេងទៀត!";
                   
                }
                
            } 
            if ($username > 0) {

                if ($r->session()->get('lang')=='en') {
                
                    $sms1 = "Your username already exit. Please use a different one!";
                
                } else {
                
                    $sms1 = "ឈ្មេាះរបស់អ្នកមានគេប្រើរួចហើយ។ សូមប្រើឈ្មេាះផ្សេង!";

                }
                
            }
            $r->session()->flash('sms1', $sms1);
            return redirect('/employer/register')->withInput();
        } 
    }

    // load edit profile form
    public function edit(Request $r)
    {
        $seeker = $r->session()->get('employer');
        if($seeker==NULL)
        {
            return redirect('/employer/login');
        }
        $data['employer'] = DB::table('employers')->where('id', session('employer')->id)->first();
        return view('fronts.employers.edit-profile', $data);
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
            'email' => $r->email,
            'username' => $r->username
        ];
        // check if username or email already exist or not
        $count_username = DB::table('employers')->where('id', "!=", $r->id)
            ->where('username', $r->username)
            ->count();
        $count_email = DB::table('employers')->where('id', "!=", $r->id)
            ->where('email', $r->email)
            ->count();
        if ($count_email > 0) {
            if ($r->session()->get('lang')=='en') {
            
                $r->session()->flash('sms1', "The email '{$r->email}' already exist. Change a new one!");
    
            } else {
           
                $r->session()->flash('sms1', "អុីម៉ែល '{$r->email}' មានគេប្រើរួចហើយ។ សូមប្រើអុីម៉ែលផ្សេងទៀត!");
            }
            
            return redirect('/employer/edit/profile');
        }
        if ($count_username > 0) {
            if ($r->session()->get('lang')=='en') {
            
                $r->session()->flash('sms1', "The username '{$r->username}' already exist. Change a new one!");
              
            } else {
            
                $r->session()->flash('sms1', "ឈ្មេាះអ្នកប្រើប្រាស់ '{$r->username}' មានគេប្រើរួចហើយ. សូមប្រើឈ្មេាះផ្សេងទៀត!");
                
            }
            
            return redirect('/employer/edit/profile');
        }
        $i = DB::table('employers')->where('id', $r->id)->update($data);

        if ($i) {
            if ($r->session()->get('lang')=='en') {

                $r->session()->flash('sms', "Your profile has been saved successfully!");
                # code...
            } else {

                $r->session()->flash('sms', "ពត៌មានប្រូហ្វាល់របស់អ្នក ត្រូវបានរក្សាទុកដោយជោគជ័យ!");
                # code...
            }
            
            // save user to session
            $user = DB::table('employers')->where('id', $r->id)->first();
            $r->session()->put('employer', $user);
            return redirect('/employer');
        } else {
            if ($r->session()->get('lang')=='en') {

                $r->session()->flash('sms1', "Fail to save changes. You may not make any changes in your input!");
                # code...
            } else {

                $r->session()->flash('sms1', "មិនអាចធ្វើការផ្លាស់ប្តូរបានទេ។ អ្នកប្រហែលមានមិនបានធ្វើការផ្លាស់ប្តូរអ្វីទេ!");
                # code...
            }
            
            return redirect('/employer/edit/profile');
        }
    }
    // load reset password form employer
    public function reset_password(Request $r)
    {
        $employer = $r->session()->get('employer');
        if($employer==NULL)
        {
            return redirect('/employer/login');
        }
        return view('fronts.employers.reset-password');
    }
    // save new password employer
    public function save_password(Request $r)
    {
        $employer = $r->session()->get('employer');
        if($employer==NULL)
        {
            return redirect('/employer/login');
        }
        $employer_id = session('employer')->id;
        $data = [
            'password' => password_hash($r->password, PASSWORD_BCRYPT)
        ];
        if($r->password!=$r->cpassword)
        {
            if ($r->session()->get('lang')=='en') {

                $r->session()->flash('sms1', "Your new password and confirm password is not match!");
                # code...
            } else {

                $r->session()->flash('sms1', "លេខសម្ងាត់ថ្មី និងលេខសម្ងាត់បញ្ជាក់ មិនត្រូវគ្នាទេ!");
                # code...
            }
            
            return redirect('/employer/reset-password');
        }
        $i = DB::table('employers')->where('id', $employer_id)->update($data);
        if($i)
        {
            if ($r->session()->get('lang')=='en') {

                $r->session()->flash('sms', "Your new password has been saved successfully!");
                # code...
            } else {

                $r->session()->flash('sms', "លេខសម្ងាត់ថ្មីរបស់អ្នក ត្រូវបានរក្សាទុកដោយជោគជ័យ!");
                # code...
            }
            
            return redirect('/employer/reset-password');
        }
        else{
             $r->session()->flash('sms1', "Cannot reset your password!");
            return redirect('/employer/reset-password');

        }
    }

    public function subscription(Request $r) {
        $employer = $r->session()->get('employer');
        if($employer==NULL)
        {
            return redirect('/employer/login');
        }
        $employer_id = session('employer')->id;
        $data['packages'] = DB::table('packages')->where('active', 1)->get();
        $data['counter'] = DB::table('subscriptions')->where('employer_id', $employer_id)
            ->where('active', 1)->count();
        $data['subscription'] = DB::table('subscriptions')
            ->join('packages', 'subscriptions.package_id', "packages.id")
            ->where('subscriptions.active', 1)
            ->where('subscriptions.employer_id', $employer_id)
            ->select('subscriptions.*', 'packages.name', 'packages.type')
            ->first();
        $data['job_count'] = DB::table('jobs')
            ->where('employer_id', $employer_id)
            ->where('active', 1)
            ->count();
        return view('fronts.employers.subscription', $data);
    }

    public function company(Request $r) {
        $employer = $r->session()->get('employer');
        if($employer==NULL)
        {
            return redirect('/employer/login');
        }
        $data['company'] = DB::table('companies')
        ->where('active', 1)->where('employer_id', $employer->id)
        ->first();
        return view('fronts.employers.company' , $data);
    }

    // load create form create company
    public function create_company(Request $r)
    {
        $employer = $r->session()->get('employer');
        if($employer==NULL)
        {
            return redirect('/employer/login');
        }
        return view('fronts.employers.create-company');
    }

     // save new company
     public function save_company(Request $r)
     {
        $employer = $r->session()->get('employer');
        if($employer==NULL)
        {
            return redirect('/employer/login');
        }
        $employer_id = session('employer')->id;
       
        $data = array(
            'name' => $r->name,
            'address' => $r->address,
            'contact_person' => $r->contact_person,
            'phone' => $r->phone,
            'email' => $r->email,
            'website' => $r->website,
            'employer_id' => $employer_id,
            "description" => $r->description
        );
        if($r->logo) {
            $file = $r->file('logo');
            $file_name = $file->getClientOriginalName();
            $destinationPath = 'company/';
            $file->move($destinationPath, $file_name);
            $data['logo'] = $file_name;
        }
        if ($r->session()->get('lang')=='en') {
            $sms = "The new company has been created successfully.";
            $sms1 = "Fail to create the new company, please check again!";
        } else {
            $sms = "ក្រុមហ៊ុនថ្មីត្រូវបានបង្កើតដោយជោគជ័យ!";
            $sms1 = "មិនអាចបង្កើតក្រុមហ៊ុនថ្មីទេ!";
        }
        

         $i = DB::table('companies')->insert($data);
         if ($i)
         {
             $r->session()->flash('sms', $sms);
             return redirect('/employer/company');
         }
         else
         {
             $r->session()->flash('sms1', $sms1);
             return redirect('/employer/create_company')->withInput();
         }
    }

    public function edit_company($id)
    {   
        $data['company'] = DB::table('companies')
            ->where('id',$id)->first();
        return view('fronts.employers.edit-company', $data);
    }
    
    public function update_company(Request $r)
    {
        $employer = $r->session()->get('employer');
        if($employer==NULL)
        {
            return redirect('/employer/login');
        }
        $data = array(
            'name' => $r->name,
            'address' => $r->address,
            'contact_person' => $r->contact_person,
            'phone' => $r->phone,
            'email' => $r->email,
            'website' => $r->website,
            "description" => $r->description
        );
        if($r->logo) {
            $file = $r->file('logo');
            $file_name = $file->getClientOriginalName();
            $destinationPath = 'company/';
            $file->move($destinationPath, $file_name);
            $data['logo'] = $file_name;
        }

        if ($r->session()->get('lang')=='en') {
            $sms = "All changes have been saved successfully.";
            $sms1 = "Fail to to save changes, please check again!";
        } else {
            $sms = "ទិន្នន័យត្រូវបានរក្សាទុកដោយជោគជ័យ!";
            $sms1 = "មិនអាចរក្សាទិន្នន័យបានទេ!";
        }
        
        $i = DB::table('companies')->where('id', $r->id)->update($data);
        if ($i)
        {
            $r->session()->flash('sms', $sms);
            return redirect('/employer/company');
        }
        else
        {
            $r->session()->flash('sms1', $sms1);
            return redirect('/employer/edit_company/'.$r->id)->withInput();
        }
    }
    public function unsubscribe(Request $r)
    {
        $employer = $r->session()->get('employer');
        if($employer==NULL)
        {
            return redirect('/employer/login');
        }
        $i = DB::table('subscriptions')->where('id', $r->id)->update(['active'=>0]);
        if($i)
        {
            DB::table("downloads")->where("employer_id", $employer->id)
                ->update(["download_number"=>0]);
            if ($r->session()->get('lang')=='en') {

                $r->session()->flash('sms', "You have unsubscribed successfully!");
                # code...
            } else {

                $r->session()->flash('sms', "អ្នកបានបញ្ឈប់គម្រោងដោយជោគជ័យ!");
                # code...
            }
            
            return redirect('/employer/subscription');
        }
    }
    // subscribe
    public function subscribe(Request $r)
    {
        $employer = $r->session()->get('employer');
        if($employer==NULL)
        {
            return redirect('/employer/login');
        }
        // check if employer has any subscription
        $counter = DB::table('subscriptions')
            ->where('active', 1)
            ->where('employer_id', $r->session()->get('employer')->id)
            ->count();
        if ($counter>0)
        {
            if ($r->session()->get('lang')=='en') {

                $r->session()->flash('sms1', "Please unsubscribe the current package first before you subscribe a new package!");
                # code...
            } else {

                $r->session()->flash('sms1', "មុននឹងទិញគម្រោងថ្មី សូមអ្នកបញ្ឈប់គម្រោងបច្ចុប្បន្នរបស់អ្នកជាមុនសិន!");
                # code...
            }
            
            return redirect('/employer/subscription');
        }
        $package = DB::table('packages')->where('id', $r->package)->first();
        $expired_date = date('Y-m-d', strtotime("+{$package->day_number} day"));
        $data = [
            'employer_id' => $r->session()->get('employer')->id,
            'package_id' => $r->package,
            'expired_date' => $expired_date,
            'price' => $package->price,
            'day_number' => $package->day_number,
            'job_number' => $package->job_number,
            'download' => $package->download
        ];
        $i = DB::table('subscriptions')->insert($data);
        if($i)
        {
            if ($r->session()->get('lang')=='en') {

                $r->session()->flash('sms', "You have subscribed successfully!");
                # code...
            } else {

                $r->session()->flash('sms', "អ្នកបានទិញគម្រោងថ្មីដោយជោគជ័យ!");
                # code...
            }
            
            $down = DB::table("downloads")->where("employer_id", $employer->id)->get();
            if(count($down)>0)
            {
                // already exist, just update
                DB::table("downloads")->where("employer_id", $employer->id)
                    ->update(["download_number"=>0]);
            }
            else{
                DB::table("downloads")->insert(["employer_id"=>$employer->id]);
            }

            return redirect('/employer/subscription');
        }
        else{
            if ($r->session()->get('lang')=='en') {

                $r->session()->flash('sms1', "Fail to make new subscription!");
                # code...
            } else {

                $r->session()->flash('sms1', "មិនអាចទិញគម្រោងថ្មីបានទេ!");
                # code...
            }
            
            return redirect('/employer/subscription');
        }

    }
    public function job(Request $r)
    {
        $employer = $r->session()->get('employer');
        if($employer==NULL)
        {
            return redirect('/employer/login');
        }
        $data['jobs'] = DB::table('jobs')
            ->join('categories', 'jobs.category_id', 'categories.id')
            ->where('jobs.employer_id', $r->session()->get('employer')->id)
            ->where('jobs.active', 1)
//            ->whereDate('jobs.closing_date', '>=', date('Y-m-d'))
            ->select('jobs.*', 'categories.name')
            ->get();
        return view('fronts.employers.job', $data);
    }
    public function nosub(Request $r)
    {
        $employer = $r->session()->get('employer');
        if($employer==NULL)
        {
            return redirect('/employer/login');
        }
        return view("fronts.employers.nosub");
    }
    public function nocom(Request $r)
    {
        $employer = $r->session()->get('employer');
        if($employer==NULL)
        {
            return redirect('/employer/login');
        }
        return view("fronts.employers.nocom");
    }
    public function create_job(Request $r)
    {
        $employer = $r->session()->get('employer');
        if($employer==NULL)
        {
            return redirect('/employer/login');
        }
        $sub = DB::table('subscriptions')
            ->where('active', 1)
            ->where('employer_id', $employer->id)
            ->first();
        $com = DB::table('companies')
            ->where('active',1)
            ->where('employer_id', $employer->id)
            ->first();
        if ($sub==null)
        {
            return redirect('/employer/job/nosub');
        }
        else if($com==null)
        {
            return redirect('/employer/job/nocom');
        }
        else
        {
            if($sub->status==0)
            {
                return redirect('/employer/job/pending');
            }
        }

        $data['job_types'] = DB::table('job_types')->where('active',1)->orderBy('name')->get();
        $data['locations'] = DB::table('locations')->where('active',1)->orderBy('name')->get();
        $data['categories'] = DB::table('categories')->where('active',1)->orderBy('name')->get();
        return view('fronts.employers.create_job', $data);
    }
    // delete job
    public function delete_job(Request $r)
    {
        $employer = $r->session()->get('employer');
        if($employer==NULL)
        {
            return redirect('/employer/login');
        }
        DB::table('jobs')->where('id', $r->id)->update(['active'=>0]);
        return redirect('/employer/job');
    }
    public function reach()
    {
        return view('fronts.employers.reach');
    }
    public function pending()
    {
        return view('fronts.employers.pending');
    }
    public function save_job(Request $r)
    {
        $employer = $r->session()->get('employer');
        if($employer==NULL)
        {
            return redirect('/employer/login');
        }
        // check if employer reach total job posting
        $sub = DB::table('subscriptions')
            ->where('active', 1)
            ->where('employer_id', $employer->id)
            ->first();
        $total_job = DB::table('jobs')
            ->where('active', 1)
            ->where('employer_id', $employer->id)
            ->count();
        // check if subscription is pending
        if($sub->status==0)
        {
            return redirect('/employer/job/pending');
        }
        if($sub->job_number<=$total_job)
        {
            return redirect('/employer/job/reach');
        }
        $data = [
            'job_title' => $r->job_title,
            'job_type' => $r->type,
            'category_id' => $r->category,
            'location' => $r->location,
            'closing_date' => $r->closing_date,
            'gender' => $r->gender,
            'hire' => $r->hire,
            'employer_id' => $employer->id,
            'description' => $r->description,
            'requirement' => $r->requirement
        ];
        $i = DB::table('jobs')->insert($data);
        if($i)
        {
            if ($r->session()->get('lang')=='en') {

                $r->session()->flash('sms', "Your new job has been saved successfully!");
                # code...
            } else {

                $r->session()->flash('sms', "ការងារថ្មីរបស់អ្នកត្រូវបានរក្សាទុកដោយជោគជ័យ!");
                # code...
            }
            
            return redirect('/employer/job/create');
        }
        else{
            if ($r->session()->get('lang')=='en') {

                $r->session()->flash('sms1', "Fail to create new job!");
                # code...
            } else {

                $r->session()->flash('sms1', "មិនអាចបង្កើតការងារថ្មីបានទេ!");
                # code...
            }
            
            return redirect('/employer/job/create')->withInput();
        }
    }
    // edit job
    public function edit_job(Request $r)
    {
        $data['job'] = DB::table('jobs')->where('id', $r->id)->first();
        $data['job_types'] = DB::table('job_types')->where('active',1)->orderBy('name')->get();
        $data['locations'] = DB::table('locations')->where('active',1)->orderBy('name')->get();
        $data['categories'] = DB::table('categories')->where('active',1)->orderBy('name')->get();
        return view('fronts.employers.edit_job', $data);
    }
    public function update_job(Request $r)
    {
        $employer = $r->session()->get('employer');
        if($employer==NULL)
        {
            return redirect('/employer/login');
        }
        $data = [
            'job_title' => $r->job_title,
            'job_type' => $r->type,
            'category_id' => $r->category,
            'location' => $r->location,
            'closing_date' => $r->closing_date,
            'gender' => $r->gender,
            'hire' => $r->hire,
            'employer_id' => $employer->id,
            'description' => $r->description,
            'requirement' => $r->requirement
        ];
        $i = DB::table('jobs')->where('id', $r->id)->update($data);
        if($i)
        {
            if ($r->session()->get('lang')=='en') {

                $r->session()->flash('sms', "All changes has been saved successfully!");
                # code...
            } else {

                $r->session()->flash('sms', "ទិន្នន័យត្រូវបានរក្សាទុកដោយជោគជ័យ!");
                # code...
            }
            
            return redirect('/employer/job/edit/'.$r->id);
        }
        else{
            if ($r->session()->get('lang')=='en') {

                $r->session()->flash('sms1', "Fail to save change, it seems you don't change anything!");
                # code...
            } else {

                $r->session()->flash('sms1', "មិនអាចផ្លាស់ប្តូរទិន្នន័យបានទេ!");
                # code...
            }
            
            return redirect('/employer/job/edit/'.$r->id);
        }
    }
    // job detail
    public function job_detail($id)
    {
        $data['job'] = DB::table('jobs')
            ->join('categories', 'jobs.category_id', 'categories.id')
            ->where('jobs.id', $id)
            ->select('jobs.*', 'categories.name')
            ->first();
        return view('fronts.employers.job_detail', $data);
    }
    public function search_cv(Request $r)
    {
        $employer = $r->session()->get('employer');
        if($employer==NULL)
        {
            return redirect('/employer/login');
        }
        $catid = @$_GET["id"];
        $data["sid"] = $catid;
        $data['categories'] = DB::table('categories')->where('active', 1)
            ->get();
        if ($catid==null)
        {
            $data['cvs'] = DB::table("resume")
                ->join("employees", "resume.employee_id", "employees.id")
                ->where('resume.active', 1)
                ->select("resume.*", "employees.first_name", "employees.last_name", "employees.email", "employees.phone", "employees.profile_photo")
                ->paginate(18);
            return view("fronts.employers.search-cv", $data);
        }
        else{
            $data['cvs'] = DB::table("resume")
                ->join("employees", "resume.employee_id", "employees.id")
                ->where('resume.active', 1)
                ->where(function ($q){
                    $q->orWhere("resume.favorite_job1", "like", "%{$_GET['id']}%")
                    ->orWhere("resume.favorite_job2", "like", "%{$_GET['id']}%")
                    ->orWhere("resume.favorite_job3", "like", "%{$_GET['id']}%");

                })
                ->select("resume.*", "employees.first_name", "employees.last_name", "employees.email", "employees.phone", "employees.profile_photo")
                ->paginate(18);
            return view("fronts.employers.search-cv", $data);
        }
    }
    public function show_cv(Request $r)
    {
        $employer = $r->session()->get('employer');
        if($employer==NULL)
        {
            return redirect('/employer/login');
        }
        $id = $r->id;
        $seeker_id = DB::table("resume")->where("id",$id)->first()->employee_id;
        $data['cv'] = DB::table('resume')
            ->join('employees', 'resume.employee_id', 'employees.id')
            ->where('resume.active', 1)
            ->where('resume.id', $id)
            ->select('resume.*', 'employees.first_name', 'employees.last_name', 'employees.profile_photo', 'employees.gender as sex', 'resume.id as id')
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
            ->get();
        $data['is_favorite'] = DB::table('favorite_cvs')
            ->where("cv_id", $id)
            ->where("employer_id", $employer->id)
            ->get();
        return view("fronts.employers.cvdetail", $data);
    }
    // book mark cv as favorite
    public function favorite(Request $r)
    {
        $employer = $r->session()->get('employer');
        if($employer==NULL)
        {
            return 0;
        }
        $data = array(
            "cv_id" => $r->id,
            "employer_id" => $employer->id
        );
        $i = DB::table("favorite_cvs")->insertGetId($data);
        return $i;
    }
    public function get_favorite(Request $r)
    {
        $employer = $r->session()->get('employer');
        if($employer==NULL)
        {
            return redirect('/employer/login');
        }
        $data['cvs'] = DB::table("favorite_cvs")
            ->join("resume", "favorite_cvs.cv_id", "resume.id")
            ->join("employees", "resume.employee_id", "employees.id")
            ->where("favorite_cvs.employer_id", $employer->id)
            ->select("resume.*", "employees.first_name", "employees.last_name", "favorite_cvs.employer_id")
            ->paginate(18);
        return view("fronts.employers.favorite", $data);


    }
    public function delete_favorite(Request $r)
    {
        $cv_id = $r->id;
        $employer_id = $r->emp;
        $i = DB::table("favorite_cvs")
            ->where("cv_id", $cv_id)
            ->where("employer_id", $employer_id)
            ->delete();
        return $i;
    }
}
