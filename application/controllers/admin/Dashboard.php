<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Aipl_admin {
	public function __construct()
	{
		parent::__construct();
		$this->isAdminloggedin();
		$this->load->model("products_model");
		$this->load->model("customers_model");
		$this->load->model("enquires_model");
		$this->load->model("login_model");
		$this->load->model("quotation_model");
		$this->load->model("events_model");
		$this->load->library("breadcrumbs");
		$this->load->helper('counter');
		//count_visitor();
		$this->load->library('form_validation');
	}
	public function index()
	{
		$this->load->view('admin/requires/header',array("title"=>"Admin"));
		$this->load->view('admin/dashboard');
		$this->load->view('admin/requires/footer');
	}

	

	public function edit_profile($id)
	{
		$row = $this->login_model->get_by_id($id);
		//print_r($row); die();

        if ($row) {
            $data = array(
				'button' => 'Update',
                'action' => site_url('admin/dashboard/save_myprofile'),
                'id' => set_value('id', $row->id),
				'username' => set_value('username', $row->username)
			);

		$this->load->view('admin/requires/header',array("title"=>"Admin"));
		$this->load->view('admin/myaccount', $data);
		$this->load->view('admin/requires/footer');

        } else {
			$this->session->set_flashdata('flashMsg', 'Record Not Found');
            redirect(site_url('admin/dashboard'));
        }

	}
	public function save_myprofile(){

		$data = array(
			'username' => $this->input->post('username',TRUE),
			'password' => md5($this->input->post('password')),
		);

        $this->login_model->update($this->input->post('id', TRUE), $data);
        $this->session->set_flashdata('flashMsg', 'Update Record Success');
        redirect(site_url('admin/dashboard'));
	}
	public function events()
	{
		$this->breadcrumbs->push('Dashboard', '/admin/dashboard');
        $this->breadcrumbs->push('Event', '/admin/dashboard/events');
		$this->load->view('admin/requires/header',array("title"=>"Admin Events"));
		$this->load->view('admin/events');
		$this->load->view('admin/requires/footer');
	}
	function save_events()
	{
		$event_date =$this->input->post('event_date');
		$event_name =$this->input->post('event_name');
		$data = array(
			'events_id' => $this->input->post('events_id',TRUE),
			'event_date' => $event_date,
			'event_name' => $event_name
		);

        $this->events_model->insert_events($data);
	}

	function get_events(){
		$result=$this->events_model->get_all_events();
		$data=array();
		foreach($result as $row){
			$nestedData=array();
			$nestedData["title"]=$row->event_name;
			$nestedData["color"]='#006DF0';
			$nestedData["start"]=date("Y-m-d",strtotime($row->event_date));
			array_push($data,$nestedData);
		}
		echo json_encode($data);
	}

	public function remove_events()
    {
        $this->events_model->delete();
		redirect('admin/dashboard/events');
    }

	public function logout(){
		$this->session->sess_destroy();
        redirect(site_url("login"));
    }
}
