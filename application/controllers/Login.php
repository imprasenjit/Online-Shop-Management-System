<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('login_model');
        $this->load->library('form_validation');
        $this->load->helper('sendmail');
    }

    public function login_process() {
        $email = $this->security->xss_clean($this->input->post("email"));
        $password = $this->security->xss_clean($this->input->post("password"));
        $this->load->model("login_model");
        $usr = $this->login_model->login_process($email);
        if ($usr) {
            if (crypt($password, $usr->password) == $usr->password) {
                $email = $usr->email;
                $name = $usr->name;
                $contact = $usr->contact;
                $id = $usr->id;
                $data = array(
                    "email" => $email,
                    "name" => $name,
                    "contact" => $contact,
                    "id" => $id,
                    "login" => true,
                    "isuser" => true
                );
                $this->session->set_userdata($data);
                $data["login"] = true;
                $data["message"] = "Login Successfull. Please wait.";
            } else {
                $data["login"] = false;
                $data["message"] = "Invalid Login.";
            }
        } else {
            $data["login"] = false;
            $data["message"] = "Invalid Login.";
        }
        echo json_encode($data);
    }// End of process()

    public function logout() {
        //session_write_close();
        $this->session->sess_destroy();
        redirect(site_url("home"));
    }
    
    function sendotp() {
        $email = $this->security->xss_clean($this->input->post("email"));
        $mobnum = $this->security->xss_clean($this->input->post("mobnum"));
        if(strlen($mobnum) == 10) {
            $usr = $this->login_model->mobile_login($mobnum);
        } elseif(strlen($email) >= 8) {
            $usr = $this->login_model->login_process($email);
        } else {
            $usr = false;
        }//End of if else
        
        if($usr) {
            $otp = mt_rand(100000, 999999);
            $this->session->set_tempdata('login_otp', $otp, 300);
            $custEmail = $usr->email;
            if(strlen($custEmail) > 7) {
                $subject = "OTP For Supplyorigin";
                $body = "The One Time Password for Supplyorigin is ".$otp;
                sendmail($custEmail, $subject, $body);
            }            
            $msg = "OTP has been generated and sent to : ".$mobnum;
            $flag = 1;
        } else {
            $otp=null;
            $msg = 'Records does not exist!';
            $flag = 0;
        }//End of if else
        echo json_encode(array('flag'=>$flag, 'msg'=>$msg, 'otp'=>$otp));
    }//End of sendotp()
    
    function otplogin() {
        $mobnum = $this->security->xss_clean($this->input->post("mobnum"));
        $otp = $this->security->xss_clean($this->input->post("otp"));
        $login_otp = $this->session->tempdata('login_otp');
        if($login_otp == $otp) {
            $usr = $this->login_model->mobile_login($mobnum);
            if($usr) {
                $email = $usr->email;
                $name = $usr->name;
                $contact = $usr->contact;
                $id = $usr->id;
                $data = array(
                    "email" => $email,
                    "name" => $name,
                    "contact" => $contact,
                    "id" => $id,
                    "login" => true,
                    "isuser" => true
                );
                $this->session->set_userdata($data);
                $msg = 'Login Successfull!';
                $flag = 1;
                $this->session->unset_tempdata('login_otp');
            } else {
                 $msg = 'Mobile Number does not matched!';
                $flag = 0;
            }//End of if else 
        } else {
            $msg =  'OTP does not matched!';
            $flag = 0;
        }//End of if else
        echo json_encode(array('flag'=>$flag, 'msg'=>$msg));
    }//End of otplogin()
    
    function updatepass() {
        $email = $this->security->xss_clean($this->input->post("email"));
        $mobnum = $this->security->xss_clean($this->input->post("mobnum"));
        $otp = $this->security->xss_clean($this->input->post("otp"));
        $reg_newpass = $this->security->xss_clean($this->input->post("pass"));
        $login_otp = $this->session->tempdata('login_otp');
        if($login_otp == $otp) {
            $this->load->model('customers_model');
            if(strlen($mobnum) == 10) {
                $usr = $this->login_model->mobile_login($mobnum);
            } elseif(strlen($email) >= 8) {
                $usr = $this->login_model->login_process($email);
            } else {
                $usr = false;
            }//End of if else
        
            if($usr) {
                $id = $usr->id;
                $hashed_password = crypt($reg_newpass, '193782465');
                $this->customers_model->update($id, array('password' => $hashed_password));
                $msg = 'Password has been successfully updated!';
                $flag = 1;
                $this->session->unset_tempdata('login_otp');
            } else {
                $msg = 'Mobile Number does not matched!';
                $flag = 0;
            }//End of if else 
        } else {
            $msg =  'OTP does not matched!';
            $flag = 0;
        }//End of if else
        echo json_encode(array('flag'=>$flag, 'msg'=>$msg));
    }//End of updatepass()

}