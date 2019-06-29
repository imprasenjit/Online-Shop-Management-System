<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Partnerprograms extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('cart');
        $this->load->model('billing_model');
        $this->load->model('partnerprograms_model');
        $this->load->model('companies_model');
        $this->load->model('products_model');
        $this->load->model('sub_category_model');
        $this->load->model('associated_brands_model');
        $this->load->model('quotes_model');
        $this->load->model('services_model');
        $this->load->model('suppliers_model');
        $this->load->helper('form');
    }

    function index() {
        $data = array("page" => "Partner Programs");
        $this->load->view('requires/header', $data);
        $this->view('partnerprograms');
        $this->load->view('requires/footer');
    }
    
    function smesave() {
        $this->load->library("form_validation");
        $this->form_validation->set_rules("sme_name", "Name", "required");
        $this->form_validation->set_error_delimiters("<font class='error animated fadeIn'>", "</font>");
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata("flashMsg", "Invalid inputs");
            $this->index();
        } else {
            $nowTime = date("Y-m-d H:i:s");
            $sme_name = $this->security->xss_clean($this->input->post("sme_name"));
            $sme_mobile = $this->security->xss_clean($this->input->post("sme_mobile"));
            $sme_email = $this->security->xss_clean($this->input->post("sme_email"));
            $sme_state = $this->security->xss_clean($this->input->post("sme_state"));
            $sme_district = $this->security->xss_clean($this->input->post("sme_district"));
            $sme_msg = $this->security->xss_clean($this->input->post("sme_msg"));
            $data = array(
                "entry_time" => $nowTime,
                "sme_name" => $sme_name,
                "sme_mobile" => $sme_mobile,
                "sme_email" => $sme_email,
                "sme_state" => $sme_state,
                "sme_district" => $sme_district,
                "sme_msg" => $sme_msg
            );
            $this->partnerprograms_model->insert($data);
            $this->session->set_flashdata("flashMsg", "Data has been successfully submitted!");
            redirect(site_url('partnerprograms'));
        }
    }//End of smesave()
    
    function companysave() {
        $this->load->library("form_validation");
        $this->form_validation->set_rules("company_name", "Company name", "required");
        $this->form_validation->set_error_delimiters("<font class='error animated fadeIn'>", "</font>");
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata("flashMsg", "Invalid inputs");
            $this->index();
        } else {
            $nowTime = date("Y-m-d H:i:s");
            $company_name = $this->security->xss_clean($this->input->post("company_name"));
            $contact_person = $this->security->xss_clean($this->input->post("contact_person"));
            $designation = $this->security->xss_clean($this->input->post("designation"));
            $conatct_no = $this->security->xss_clean($this->input->post("conatct_no"));
            $contact_email = $this->security->xss_clean($this->input->post("contact_email"));
            $product_manufactured = $this->security->xss_clean($this->input->post("product_manufactured"));
            $office_address = $this->security->xss_clean($this->input->post("office_address"));
            $factory_address = $this->security->xss_clean($this->input->post("factory_address"));
            $data = array(
                "entry_time" => $nowTime,
                "company_name" => $company_name,
                "contact_person" => $contact_person,
                "designation" => $designation,
                "conatct_no" => $conatct_no,
                "contact_email" => $contact_email,
                "product_manufactured" => $product_manufactured,
                "office_address" => $office_address,
                "factory_address" => $factory_address
            );
            $this->companies_model->insert($data);
            $this->session->set_flashdata("flashMsg", "Data has been successfully submitted!");
            redirect(site_url('partnerprograms'));
        }
    }//End of companysave()

}//End of Partnerprograms
