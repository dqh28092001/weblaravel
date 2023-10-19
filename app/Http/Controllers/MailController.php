<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
class MailController extends Controller
{
    public function send_mail(){
        $to_name = "Đặng Quốc Huy";
        $to_email = "dqh28092001@gmail.com";

        $data = array("name" => "Mail từ tài khoản Khách Hàng", "body" => 'Mail gửi về vấn đề hàng hóa');

        Mail::send('pages.send_mail', $data, function($message) use ($to_name, $to_email){
            $message->to($to_email)->subject('Test thử gửi mail gg');
            $message->from($to_email, $to_name);
        });

        return redirect('/')->with('message', 'Email sent successfully.');
    }

}
