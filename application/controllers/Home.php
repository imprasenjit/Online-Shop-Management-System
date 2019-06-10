<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends CI_Controller {
	public function __construct() {
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
	}
	public function index() {
		$data = array("page" => "Home");
		$this->load->view('site/requires/header', $data);
		$this->load->view('site/home');
		$this->load->view('site/requires/footer');
	}
	public function contact() {
		$data = array("page" => "Contact");
		$this->load->view('site/requires/header',$data);
		$this->load->view('site/contact');
		$this->load->view('site/requires/contact_page_footer');
	}
	public function about() {
		$data = array("page" => "About");
		$this->load->view('site/requires/header',$data);
		$this->load->view('site/about');
		$this->load->view('site/requires/footer');
	}
	public function services() {
		$this->load->view('site/requires/header');
		$this->load->view('site/services');
		$this->load->view('site/requires/footer');
	}
    function downloads() {
        $data = array("page" => "Downloads");
        $this->load->view('site/requires/header', $data);
        $this->load->view('site/downloads_view');
        $this->load->view('site/requires/footer');
    }
    function partnerprograms() {
		$this->load->model("suppliers_model");
        $data = array("page" => "Partner Programs");
        $this->load->view('site/requires/header', $data);
        $this->load->view('site/partnerprograms');
        $this->load->view('site/requires/footer');
    }
	public function feedback()
	{
		$data = array("page" => "Feedback");
		$this->load->view('site/requires/header',$data);
		$this->load->view('site/get_feedback');
		$this->load->view('site/requires/footer');
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
		$this->load->view('site/requires/header');
		$this->load->view('site/services');
		$this->load->view('site/requires/footer');
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
