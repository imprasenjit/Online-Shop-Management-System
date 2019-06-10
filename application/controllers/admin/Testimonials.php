<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');
class Testimonials extends Aipl_admin {
    function __construct() {
        parent::__construct();
        $this->load->model("feedback_model");
    }//End of __construct()
    
    function index() {
        $this->breadcrumbs->push('Dashboard', '/admin/dashboard');
        $this->breadcrumbs->push('Customer List', '/admin/testimonials');
        $this->load->view('admin/requires/header', array('title' => 'Testimonial List'));
        $this->load->view('admin/testimonials/testimonials_list');
        $this->load->view('admin/requires/footer');
    }
}