<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends MY_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->library('cart');
		$this->load->model('billing_model');
		$this->load->model('products_model');
		$this->load->model('sub_category_model');
		$this->load->model('associated_brands_model');
		$this->load->model('feedback_model');
		$this->load->model('services_model');
		$this->load->model('blogs_model');
		$this->load->model('home_page_slider_model');
		$this->load->helper('form');
	}
	public function index() {
		$data = array("page" => "Home");
		$this->load->view('site/comming_soon');
	}
	public function web() {
		$data = array("page" => "Home");
		$this->html_view('requires/header',$data);
		$this->html_view('home');
		$this->html_view('requires/footer');
	}
	public function contact() {
		$data = array("page" => "Contact");
		$this->html_view('requires/header',$data);
		$this->html_view('contact');
		$this->html_view('requires/footer');
	}
	public function about() {
		$data = array("page" => "About");
		$this->html_view('requires/header',$data);
		$this->html_view('about');
		$this->html_view('requires/footer');
	}
	public function services() {
		$this->html_view('requires/header');
		$this->html_view('services');
		$this->html_view('requires/footer');
	}
    function downloads() {
        $data = array("page" => "Downloads");
        $this->html_view('requires/header', $data);
        $this->html_view('downloads_view');
        $this->html_view('requires/footer');
    }
    function partnerprograms() {
		$this->load->model("suppliers_model");
        $data = array("page" => "Partner Programs");
        $this->html_view('requires/header', $data);
        $this->html_view('partnerprograms');
        $this->html_view('requires/footer');
    }
	public function feedback()
	{
		$data = array("page" => "Feedback");
		$this->html_view('requires/header',$data);
		$this->html_view('get_feedback');
		$this->html_view('requires/footer');
	}

	public function save_feedback_form()
	{
		$this->load->library("form_validation");
		$this->form_validation->set_rules("name", "Name", "required");
		$this->form_validation->set_rules("email", "Email", "required");
		$this->form_validation->set_rules("contact", "Contact", "required");
		$this->form_validation->set_rules("address", "Address", "required");
		$this->form_validation->set_rules("message", "Message", "required");
		$this->form_validation->set_error_delimiters("<font class='error animated fadeIn text-danger'>", "</font>");
		if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata("flashMsg", "Invalid inputs");
				$this->feedback();
		} else {

		 $data = array(
			'name' => $this->input->post('name',TRUE),
			'email' => $this->input->post('email',TRUE),
			'contact' => $this->input->post('contact',TRUE),
			'address' => $this->input->post('address',TRUE),
			'message' => $this->input->post('message',TRUE),
	    );
		$this->feedback_model->insert($data);
        $this->session->set_flashdata('message', 'Thank you for contacting us. We will respond as soon as possible.');
		redirect(site_url("home/feedback"));
	}
	}
	public function get_services()
	{
		$this->html_view('requires/header');
		$this->html_view('services');
		$this->html_view('requires/footer');
	}

	public function save_services_form()
	{
		 $data = array(
			'name' => $this->input->post('name',TRUE),
			'email' => $this->input->post('email',TRUE),
			'contact' => $this->input->post('contact',TRUE),
			'company' => $this->input->post('company',TRUE),
			'message' => $this->input->post('message',TRUE),
	    );
		$this->services_model->insert($data);
        $this->session->set_flashdata('message', 'Thank you! We will respond as soon as possible.');
		redirect(site_url("home"));

	}
}
