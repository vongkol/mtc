<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Auth;
class EmployeeController extends Controller
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

        if (Auth::user()==null)
        {
            return redirect("/login");
        }
        if(!Right::check('Employee', 'l'))
        {
            return view('permissions.no');
        }
        $data['employees'] = DB::table('employees')
            ->where('active',1)
            ->paginate(18);
        $data['total'] = DB::table("employees")->where("active", 1)->count();
        $data['male'] = DB::table("employees")->where("active", 1)->where("gender","Male")->count();
        $data['female'] = DB::table("employees")->where("active", 1)->where("gender", "Female")->count();
        return view('employees.index', $data);
    }
    // load create form
    public function create()
    {
        if (Auth::user()==null)
        {
            return redirect("/login");
        }
        if(!Right::check('Employee', 'i'))
        {
            return view('permissions.no');
        }
        return view('employees.create');
    }
    // save new employee
    public function save(Request $r)
    {
        if (Auth::user()==null)
        {
            return redirect("/login");
        }
        $email = DB::table('employees')
            ->where('email', $r->email)
            ->where('active', 1)
            ->count();

        $username = DB::table('employees')
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
            $sms = "New job seeker has been registered successfully.";
            $sms1 = "Cannot register new job seeker.";
            $i = DB::table('employees')->insert($data);
            if ($i)
            {
                $r->session()->flash('sms', $sms);
                return redirect('/employee/create');
            }
            else
            {
                $r->session()->flash('sms1', $sms1);
                return redirect('/employee/create')->withInput();
            }
        } elseif ( $email > 0 or $username > 0) {
            if ($email > 0 and $username > 0) {
                $sms1 = "Your email and username already exit!";
            } elseif ($username) {
                $sms1 = "Your username already exit!";
            } else {
                $sms1 = "your email already exit!";
            }
            $r->session()->flash('sms1', $sms1);
            return redirect('/employee/create')->withInput();
        } 
    }
    // job seeker register
    public function register(Request $r)
    {
        // check the email if it is valid or not
        if (!filter_var($r->email, FILTER_VALIDATE_EMAIL)) {
            if($r->session()->get('lang')=="en")
            {
                $r->session()->flash('sms1', "Your email is invalid. Check it again!");
            }
            else{
                $r->session()->flash("sms1", "អុីម៉ែលមិនត្រឹមត្រូវទេ។ សូមពិនិត្យម្តងទៀត!");
            }
            return redirect('/seeker/register')->withInput();
        }
        $email = DB::table('employees')
            ->where('email', $r->email)
            ->where('active', 1)
            ->count();
        $username = DB::table('employees')
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
                'phone1' => $r->phone1,
                'email' => $r->email,
                'username' => $r->username,
                'password' => password_hash($r->password, PASSWORD_BCRYPT)
            );
            if($r->session()->get('lang')=="en")
            {
                $sms = "You have registered successfully. Please Login!";
                $sms1 = "Cannot register your account. Please check inputs again!";
            }
            else{
                $sms = "អ្នកបានចុះឈ្មេាះដោយជោគជ័យ។ សូមចូលក្នុងប្រព័ន្ធ!";
                $sms1 = "អ្នកមិនអាចចុះឈ្មេាះបានទេ។ សូមពិនិត្យទិន្នន័យម្តងទៀត!";
            }
            $i = DB::table('employees')->insertGetId($data);
            if ($i)
            {
                /*
                QrCode::format('png');
                QrCode::size(300);
                QrCode::generate("http://www.hrangkor.com", "../public/qrcode/{$i}.png");
                */
                $r->session()->flash('sms', $sms);
                return redirect('/seeker/login');
            }
            else
            {
                $r->session()->flash('sms1', $sms1);
                return redirect('/seeker/register')->withInput();
            }
        } else {
            if ($email > 0) {
                if($r->session()->get('lang')=="en")
                {
                    $sms1 = "Your email already exist. Please use a different one!";
                    
                }
                else{
                    $sms1 = "អុីម៉ែលនេះមានរួចហើយ។ សូមប្រើអុីម៉ែលផ្សេងទៀត!";
                    
                }
            } 
            if ($username > 0) {
                if($r->session()->get('lang')=="en")
                {
                    $sms1 = "Your username already exit. Please use a different one!";
                    
                }
                else{
                    $sms1 = "ឈ្មេាះអ្នកប្រើប្រាស់មានរួចហើយ។ សូមប្រើឈ្មេាះថ្មី!";
                    
                }
            }
            $r->session()->flash('sms1', $sms1);
            return redirect('/seeker/register')->withInput();
        } 
    }
    // job seeker login
    public function login(Request $r)
    {
        $username = $r->username;
        $pass = $r->password;
        $user = DB::table('employees')->where('active',1)->where('username', $username)->first();
        if($user!=null)
        {
            if(password_verify($pass, $user->password))
            {
                if($r->session()->get('employer')!=NULL)
                {
                    $r->session()->forget('employer');
                    $r->session()->flush();
                }
                // save user to session
                $r->session()->put('seeker', $user);
                return redirect('/seeker');
            }
            else{
                if($r->session()->get('lang')=='en')
                {
                    $r->session()->flash('sms1', "Invalid username or password. Try again!");
                    
                }
                else{
                    $r->session()->flash('sms1', "ឈ្មេាះឬលេខសម្ងាត់មិនត្រឹមត្រូវទេ។ សូមព្យាយាមម្តងទៀត!");
                    
                }
                return redirect('/seeker/login')->withInput();
            }
        }
        else{
            if($r->session()->get('lang')=='en')
            {
                $r->session()->flash('sms1', "Invalid username or password. Try again!");
                
            }
            else{
                $r->session()->flash('sms1', "ឈ្មេាះឬលេខសម្ងាត់មិនត្រឹមត្រូវទេ។ សូមព្យាយាមម្តងទៀត!");
                
            }
            return redirect('/seeker/login')->withInput();
        }
    }
    // logout function
    public function logout(Request $request)
    {
        $lang = $request->session()->get('lang');
        $request->session()->forget('seeker');
        $request->session()->flush();
        $request->session()->put('lang', $lang);
        return redirect('/seeker/login');
    }
    // delete
    public function delete($id)
    {
        if (Auth::user()==null)
        {
            return redirect("/login");
        }
        if(!Right::check('Employee', 'd'))
        {
            return view('permissions.no');
        }
        DB::table('employees')->where('id', $id)->update(['active'=>0]);
        return redirect('/employee');
    }

    public function edit($id)
    {
        if (Auth::user()==null)
        {
            return redirect("/login");
        }
        if(!Right::check('Employee', 'u'))
        {
            return view('permissions.no');
        }
        $data['employee'] = DB::table('employees')
            ->where('id',$id)->first();
        return view('employees.edit', $data);
    }

    public function update(Request $r)
    {
        if (Auth::user()==null)
        {
            return redirect("/login");
        }
        $email = DB::table('employees')
            ->where('email', $r->email)
            ->where('id', '!=', $r->id)
            ->where('active', 1)
            ->count();

        $username = DB::table('employees')
            ->where('username', $r->username)
            ->where('id', '!=', $r->id)
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
            );
            if($r->password)  {
                $data = array(
                    'password' => bcrypt($r->password),
                );
            }
            $sms = "All changes have been saved successfully.";
            $sms1 = "Fail to to save changes, please check again!";
            $i = DB::table('employees')->where('id', $r->id)->update($data);
            if ($i)
            {
                $r->session()->flash('sms', $sms);
                return redirect('/employee/edit/'.$r->id);
            }
            else
            {
                $r->session()->flash('sms1', $sms1);
                return redirect('/employee/edit/'.$r->id);
            }
        } elseif ( $email > 0 or $username > 0) {
            if ($email > 0 and $username > 0) {
                $sms1 = "Your email and username already exit!";
            } elseif ($username) {
                $sms1 = "Your username already exit!";
            } else {
                $sms1 = "your email already exit!";
            }
            $r->session()->flash('sms1', $sms1);
            return redirect('/employee/edit/'.$r->id);
        } 
    }
}
