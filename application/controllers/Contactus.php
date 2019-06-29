<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Contactus extends CI_Controller {
//This is dev
    function __construct() {
        parent::__construct();
        $this->load->library('cart');
        $this->load->model('billing_model');
        $this->load->model('products_model');
        $this->load->model('sub_category_model');
        $this->load->model('associated_brands_model');
        $this->load->model('feedback_model');
        $this->load->model('services_model');
        $this->load->model('home_page_slider_model');
        $this->load->helper('form');
        $this->load->helper('sendmail');
    }//End of __construct()

    function index() {
        $data = array("page" => "Contact us");
        $this->view('requires/header', $data);
        $this->view('contactus_view');
        $this->view('requires/contact_page_footer');
    }//End of index()
    
    function save() {
        $this->load->library("form_validation");
        $this->form_validation->set_rules("fullname", "Name", "required");
        $this->form_validation->set_rules("mobile", "Mobile", "required");
        $this->form_validation->set_rules("email", "Email", "required");
        $this->form_validation->set_rules("message", "Message", "required");
        $this->form_validation->set_error_delimiters("<font class='error text-danger'>", "</font>");
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata("flashMsg", "Invalid inputs");
            $this->index();
        } else {
            $nowTime = date("Y-m-d H:i:s");
            $fullname = $this->security->xss_clean($this->input->post("fullname"));
            $mobile = $this->security->xss_clean($this->input->post("mobile"));
            $email = $this->security->xss_clean($this->input->post("email"));
            $message = $this->security->xss_clean($this->input->post("message"));
            $subject = "Contact Supplyorigin";
            sendmail($email, $subject, $message);
	    //sendmail($email, $subject, $message);
            $this->session->set_flashdata("flashMsg", "Data has been successfully submitted!");
            $this->thankyou();
        }//End of if else
    }//End of save()

    function thankyou() {
        $data = array("page" => "Thank you for contacting us");
        $this->view('requires/header', $data);
        $this->view('thankyou_view');
        $this->view('requires/contact_page_footer');
    }//End of thankyou()

}//End of Contactus
