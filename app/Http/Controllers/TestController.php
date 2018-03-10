<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use PHPMailer\PHPMailer\PHPMailer;
class TestController extends Controller
{
    public function index()
    {
        $mail = new PHPMailer(true); // notice the \  you have to use root namespace here
        try {
            $mail->isSMTP(); // tell to use smtp
            $mail->CharSet = "utf-8"; // set charset to utf8
            $mail->SMTPAuth = true;  // use smpt auth
            $mail->SMTPSecure = "ssl"; // or ssl
            $mail->Host = "smtp.gmail.com";
            $mail->Port = 465; // most likely something different for you. This is the mailtrap.io port i use for testing.
            $mail->Username = "hengvongkol@gmail.com";
            $mail->Password = "KhmerCamb0dia.com.kh";
            $mail->setFrom("hengvongkol@gmail.com", "HENG Vongkol");
            $mail->Subject = "Sending Test Email";
            $mail->MsgHTML("This is the test message!");
            $mail->addAddress("hengvongkol@vdoo.biz", "Vdoo");
            $mail->send();
        } catch (phpmailerException $e) {
            dd($e);
        } catch (Exception $e) {
            dd($e);
        }
        die('success');
    }
}
