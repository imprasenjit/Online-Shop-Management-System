<?php
if (!defined("BASEPATH")) {
    exit("No direct script access allowed");
}

if (!function_exists("sendmail")) {
    function sendmail($to, $subject, $body, $attachment = NULL, $frmMail = "no-reply@supplyorigin.com") {
        $ci = & get_instance();
        $ci->load->library("email");
        $ci->email->initialize(array(
            "protocol" => "smtp",
            "smtp_host" => "ssl://mail.supplyorigin.com",
            "smtp_user" => "no-reply@supplyorigin.com",
            "smtp_pass" => "Supplyorigin#@Avantika",
            "smtp_port" => 465,
            "mailtype" => "html",
            "charset" => "iso-8859-1",
            "wordwrap" => TRUE,
            "crlf" => "\r\n",
            "newline" => "\r\n"
        ));
        $ci->email->from($frmMail);
        $ci->email->to($to);
        $ci->email->subject($subject);
        $ci->email->message($body);
        if (!is_null($attachment)) {
            $ci->email->attach($attachment);
        }//End of if
        if ($ci->email->send()) {
            return TRUE;
        } else {
            return $ci->email->print_debugger();
        }//End of if else
    }//End of online
}//End of if

//info@supplyorigin.com
if (!function_exists("sendtoall")) {
    function sendtoall($to, $subject, $body, $attachment = NULL, $frmMail = "no-reply@supplyorigin.com") {
        $ci = & get_instance();
        $ci->load->library("email");
        $ci->email->initialize(array(
            "protocol" => "smtp",
            "smtp_host" => "ssl://mail.supplyorigin.com",
            "smtp_user" => "no-reply@supplyorigin.com",
            "smtp_pass" => "Supplyorigin#@Avantika",
            "smtp_port" => 465,
            "mailtype" => "html",
            "charset" => "iso-8859-1",
            "wordwrap" => TRUE,
            "crlf" => "\r\n",
            "newline" => "\r\n"
        ));
        $ci->email->from($frmMail);
        $ci->email->to('info@supplyorigin.com');
        //$ci->email->cc('');
        $ci->email->bcc($to);
        $ci->email->subject($subject);
        $ci->email->message($body);
        if (!is_null($attachment)) {
            $ci->email->attach($attachment);
        }//End of if
        if ($ci->email->send()) {
            return TRUE;
        } else {
            return $ci->email->print_debugger();
        }//End of if else
    }//End of online
}//End of if