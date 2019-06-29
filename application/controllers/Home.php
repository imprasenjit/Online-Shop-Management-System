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
		$this->view('requires/header',$data);
		$this->view('home');
		$this->view('requires/footer');
	}
	public function contact() {
		$data = array("page" => "Contact");
		$this->view('requires/header',$data);
		$this->view('contact');
		$this->view('requires/contact_page_footer');
	}
	public function about() {
		$data = array("page" => "About");
		$this->view('requires/header',$data);
		$this->view('about');
		$this->view('requires/footer');
	}
	public function services() {
		$this->view('requires/header');
		$this->view('services');
		$this->view('requires/footer');
	}
    function downloads() {
        $data = array("page" => "Downloads");
        $this->view('requires/header', $data);
        $this->view('downloads_view');
        $this->view('requires/footer');
    }
    function partnerprograms() {
		$this->load->model("suppliers_model");
        $data = array("page" => "Partner Programs");
        $this->view('requires/header', $data);
        $this->view('partnerprograms');
        $this->view('requires/footer');
    }
	public function feedback()
	{
		$data = array("page" => "Feedback");
		$this->view('requires/header',$data);
		$this->view('get_feedback');
		$this->view('requires/footer');
	}
	
	public function save_feedback_form()
	{
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
	public function get_services()
	{
		$this->view('requires/header');
		$this->view('services');
		$this->view('requires/footer');
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
