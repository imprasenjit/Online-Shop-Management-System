<?php
if (!defined("BASEPATH"))
    exit("No direct script access allowed");
if (!function_exists("sendmail")) {
    function sendmail($to, $subject, $body, $attachment = NULL) {
        if (ENVIRONMENT === "development") {
            $status = offline($to, $subject, $body, $attachment);
        } else {
            $status = online($to, $subject, $body, $attachment);
        }
        return $status;
    }
// End of sendmail
} // End of if
if (!function_exists("online")) {
    function online($to, $subject, $body, $attachment = NULL, $frmMail = "ruchi@avantikain.com") {
        $ci = & get_instance();
        $ci->load->library("email");
        $ci->email->initialize(array(
            "protocol" => "smtp",
            "smtp_host" => "ssl://mail.easeofdoingbusinessinassam.in",
            "smtp_user" => "ruchi@avantikain.com",
            "smtp_pass" => "",
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
        }
        if ($ci->email->send()) {
            return TRUE;
        } else {
            return $ci->email->print_debugger();
        }
    }
//End of online
}//End of if
if (!function_exists("offline")) {
    function offline($to, $subject, $body, $attachment = NULL, $frmMail = "easeofdoingbusinessinassam@gmail.com") {
        $ci = & get_instance();
        $ci->load->library("email");
        $ci->email->initialize(array(
            "protocol" => "smtp",
            "smtp_host" => "ssl://smtp.gmail.com",
            "smtp_user" => "easeofdoingbusinessinassam@gmail.com",
            "smtp_pass" => "aiplglobal",
            "smtp_port" => 465,
            "mailtype" => "html",
            "charset" => "iso-8859-1",
            "wordwrap" => TRUE,
			"priority"=>1,
            "crlf" => "\r\n",
            "newline" => "\r\n"
        ));
        $ci->email->from($frmMail,'Supply Origin', 'easeofdoingbusinessinassam@gmail.com');
        $ci->email->to($to);
        $ci->email->subject($subject);
        $emailBody = "";
        //$emailBody .= $ci->load->view("pages/requires/header", '', TRUE);
        $emailBody .= $body;
       // $emailBody .= $ci->load->view("pages/requires/footer", '', TRUE);
        $ci->email->message($emailBody);
        if (!is_null($attachment)) {
            $ci->email->attach($attachment);
        }
        if ($ci->email->send()) {
            return TRUE;
        } else {
            return $ci->email->print_debugger();
        }
    }
//End of offline
}//End of if