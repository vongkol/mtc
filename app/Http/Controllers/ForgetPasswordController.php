<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use App\Http\Controllers\Right;
class ForgetPasswordController extends Controller
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
        return view('fronts.seekers.forgot');
    }
    // reset password for seeker
    public function reset_password(Request $r)
    {
        $seeker_email = $r->email;
        // check if email exist
        $result = DB::table("employees")->where("email", $seeker_email)->first();
        if ($result!=null)
        {
            $id = md5($result->id);
            $i = Right::send_email($seeker_email, $id);
            // update recovery mode for seeker
           // DB::raw("update employees set recovery_mode=1 where md5(id)='{$id}'");
            DB::table("employees")->where("id", $result->id)->update(['recovery_mode'=>1]);
            return view("fronts.seekers.send-success");
        }
        else{
            if ($r->session()->get('lang')=='en') {
                $r->session()->flash("sms1", "Your email does not exist in our system!");
            
            } else {
                $r->session()->flash("sms1", "អុីម៉ែលរបស់អ្នកមិនមាននៅក្នុងប្រព័ន្ធយើងទេ!");
            
            }
            
            return redirect('/seeker/forgot')->withInput();
        }
    }
    // load new password form for job seeker
    public function new_password($id)
    {
        $data['id'] = $id;
        return view("fronts.seekers.new-password", $data);
    }
    public function update_password(Request $r)
    {
        $pass = password_hash($r->password, PASSWORD_BCRYPT);
       // DB::raw("update employees set password='{$pass}', recovery_mode=0 where md5(id)='{$r->id}' and recovery_mode=1");
        DB::table("employees")->whereRaw("md5(id)='{$r->id}'")->update(["password"=>$pass, "recovery_mode"=>0]);
        if ($r->session()->get('lang')=='en') {
            $r->session()->flash("sms", "You just reset your password. Please login with your new password.");
        
        } else {
            $r->session()->flash("sms", "អ្នកទើបតែប្តូរលេខសម្ងាត់ សូមចូលក្នុងប្រព័ន្ធជាមួយនឹងលេខសម្ងាត់ថ្មីរបស់អ្នក!");
        
        }
        
        return redirect('/seeker/login');
    }
    public function index1()
    {
        return view('fronts.employers.forgot');
    }

//////////////////////////////////////////////////////////////////////////////////////////////
/// // reset password for employer
    public function reset_password1(Request $r)
    {
        $seeker_email = $r->email;
        // check if email exist
        $result = DB::table("employers")->where("email", $seeker_email)->first();
        if ($result!=null)
        {
            $id = md5($result->id);
            $i = Right::send_email1($seeker_email, $id);
            // update recovery mode for seeker
            //DB::raw("update employers set recovery_mode=1 where md5(id)='{$id}'");
            DB::table("employers")->where("id", $result->id)->update(['recovery_mode'=>1]);
            return view("fronts.employers.send-success");
        }
        else{
            if ($r->session()->get('lang')=='en') {
                $r->session()->flash("sms1", "Your email does not exist in our system!");
            
            } else {
                $r->session()->flash("sms1", "អុីម៉ែលរបស់អ្នកមិនមាននៅក្នុងប្រព័ន្ធយើងទេ!");
            
            }
            return redirect('/employer/forgot')->withInput();
        }
    }
    public function new_password1($id)
    {
        $data['id'] = $id;
        return view("fronts.employers.new-password", $data);
    }
    public function update_password1(Request $r)
    {
        $pass = password_hash($r->password, PASSWORD_BCRYPT);
//        DB::raw("update employers set password='{$pass}', recovery_mode=0 where md5(id)='{$r->id}' and recovery_mode=1");
        DB::table("employers")->whereRaw("md5(id)='{$r->id}'")->update(["password"=>$pass, "recovery_mode"=>0]);
        if ($r->session()->get('lang')=='en') {
            $r->session()->flash("sms", "You just reset your password. Please login with your new password.");
        
        } else {
            $r->session()->flash("sms", "អ្នកទើបតែប្តូរលេខសម្ងាត់ សូមចូលក្នុងប្រព័ន្ធជាមួយនឹងលេខសម្ងាត់ថ្មីរបស់អ្នក!");
        
        }
        return redirect('/employer/login');
    }
}
