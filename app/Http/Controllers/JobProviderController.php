<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Auth;
class JobProviderController extends Controller
{
   // index
    public function index()
    {
        if(!Right::check('Employer', 'l'))
        {
            return view('permissions.no');
        }
        $data['employers'] = DB::table('employers')
            ->leftJoin('companies', 'employers.id', '=', 'companies.employer_id')
            ->where('employers.active', 1)
            ->select('employers.*', 'companies.name as company_name')
            ->paginate(18);
            $data['total'] = DB::table("employers")->where("active", 1)->count();
            $data['male'] = DB::table("employers")->where("active", 1)->where("gender","Male")->count();
            $data['female'] = DB::table("employers")->where("active", 1)->where("gender", "Female")->count();
        return view('employers.index', $data);
    }
    // load create form
    public function create()
    {
        if(!Right::check('Employer', 'i'))
        {
            return view('permissions.no');
        }
        return view('employers.create');
    }
     // job provider save
     public function save(Request $r)
     {
         // check the email if it is valid or not
         if (!filter_var($r->email, FILTER_VALIDATE_EMAIL)) {
             $r->session()->flash('sms1', "Your email is invalid. Check it again!");
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
             $sms = "New employer has been created successfully.";
             $sms1 = "Fail to create the new employer, please check again!";
             $i = DB::table('employers')->insert($data);
             if ($i)
             {
                 $r->session()->flash('sms', $sms);
                 return redirect('/provider/create');
             }
             else
             {
                 $r->session()->flash('sms1', $sms1);
                 return redirect('/provider/create')->withInput();
             }
         } else {
             if ($email > 0) {
                 $sms1 = "Your email already exist. Please use a different one!";
             } 
             if ($username > 0) {
                 $sms1 = "Your username already exit. Please use a different one!";
             }
             $r->session()->flash('sms1', $sms1);
             return redirect('provider/create')->withInput();
         } 
     }

    // delete employer
    public function delete($id)
    {
        if(!Right::check('Employer', 'd'))
        {
            return view('permissions.no');
        }
        // delete employer
        $i = DB::table('employers')->where('id', $id)->update(['active'=>0]);
        if($id)
        {
            // delete company
            DB::table('companies')->where('employer_id', $id)->update(['active'=>0]);
            return redirect('/provider');
        }
    }

    public function edit($id)
    {
        if(!Right::check('Employer', 'u'))
        {
            return view('permissions.no');
        }
        $data['employer'] = DB::table('employers')
            ->where('id',$id)->first();
        return view('employers.edit', $data);
    }

    public function update(Request $r)
    {
        $email = DB::table('employers')
            ->where('email', $r->email)
            ->where('id', '!=', $r->id)
            ->where('active', 1)
            ->count();

        $username = DB::table('employers')
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
                    'password' =>password_hash($r->password, PASSWORD_BCRYPT)
                );
            }
            $sms = "All changes have been saved successfully.";
            $sms1 = "Fail to to save changes, it seems you don't change anything!";
            $i = DB::table('employers')->where('id', $r->id)->update($data);
            if ($i)
            {
                $r->session()->flash('sms', $sms);
                return redirect('/provider/edit/'.$r->id);
            }
            else
            {
                $r->session()->flash('sms1', $sms1);
                return redirect('/provider/edit/'.$r->id);
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
            return redirect('/provider/edit/'.$r->id);
        } 
    }
}
