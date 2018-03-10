<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;
use PHPMailer\PHPMailer\PHPMailer;
class MailController extends Controller
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
        if(!Right::check('Mail Marketing', 'l'))
        {
            return view('permissions.no');
        }
        $data['mails'] = DB::table("mails")
            ->orderBy("id", "desc")
            ->paginate(18);
        return view("mails.index", $data);
    }
    public function create()
    {
        if(!Right::check('Mail Marketing', 'i'))
        {
            return view('permissions.no');
        }
        if (Auth::user()==null)
        {
            return redirect('/admin');
        }
        $data['mails'] = DB::table("employees")
            ->where("active",1)
            ->orderBy('email')
            ->get();
        return view("mails.create", $data);
    }
    public function send(Request $r)
    {

        for($i=0;$i<count($r->list);$i++)
        {
            if (!filter_var($r->list[$i], FILTER_VALIDATE_EMAIL)) 
            {
                continue;
            }
            try {
                
                $mail = new PHPMailer(true); // notice the \  you have to use root namespace here
                $mail->isSMTP(); // tell to use smtp
                $mail->CharSet = "utf-8"; // set charset to utf8
                $mail->SMTPAuth = true;  // use smpt auth
                $mail->SMTPSecure = "ssl"; // or ssl
                $mail->MailerDebug = false;
                $mail->Host = "gator4170.hostgator.com";
                $mail->Port = 465; // most likely something different for you. This is the mailtrap.io port i use for testing.
                $mail->Username = "service@masterjobscambodia.com";
                $mail->Password = "Khmer@123";
                $mail->setFrom("service@masterjobscambodia.com", "Master Jobs Cambodia Co., Ltd");
                $mail->Subject = "HR Angkor: ". $r->subject;
                $mail->MsgHTML($r->description);
                $mail->addAddress($r->list[$i]);
                $mail->send();
             } catch (phpmailerException $e) {
   
             } catch (Exception $e) {

            }
          
        }
        // insert message to db
        $data = array(
            "subject" => $r->subject,
            "description" => $r->description,
            "send_to" => ($r->send_to==0?'Employee':'Employer'),
            "send_date" => date('Y-m-d')
        );
        DB::table("mails")->insert($data);
        $r->session()->flash("sms", "Emails have sent!");
        return redirect("/mail/create");
    }
    // get employee mail
    public function get_email($id)
    {
        if ($id==0)
        {
            return DB::table("employees")->where("active",1)->orderBy("email")->get();
        }
        else{
            return DB::table("employers")->where("active",1)->orderBy("email")->get();
        }

    }
    public function delete($id)
    {
        if(!Right::check('Mail Marketing', 'd'))
        {
            return view('permissions.no');
        }
        $i = DB::table("mails")->where("id", $id)->delete();
        return redirect("/mail");
    }

}
