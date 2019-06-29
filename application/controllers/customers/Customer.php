<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Customer extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('cart');
        $this->load->model('billing_model');
        $this->load->model('quotation_model');
        $this->load->model('products_model');
        $this->load->model('blogs_model');
        $this->load->model('enquires_model');
        $this->load->model('customers_model');
        $this->load->library('form_validation');
    }
    public function check_email()
    {
        $email = $this->input->post('email');
        if ($this->customers_model->checkuser($email)) {
            $res = true;
        } else {
            $res = false;
        }
        echo json_encode($res);
    }
    public function save_customer()
    {
        $email = $this->input->post('email');
        if ($this->customers_model->checkuser($email)) {
            $password = $this->input->post('password', TRUE);
            $hashed_password = crypt($password, '193782465');
            $data = array(
                'name' => $this->input->post('name', TRUE),
                'address' => $this->input->post('address', TRUE),
                'contact' => $this->input->post('phone', TRUE),
                'email' => $this->input->post('email', TRUE),
                'password' => $hashed_password,
            );
            $insert = $this->customers_model->insert($data);
            if ($insert) {
                $data["flag"] = 1;
                $data["message"] = "Registered successfully";
            } else {
                $data["flag"] = 0;
                $data["message"] = "Something Went wrong!";
            }
        } else {
            $data["flag"] = 2;
            $data["message"] = "Registered successfully";
        }

        echo json_encode(array("message" => $data));
    }
    public function edit_profile()
    {
        $row = $this->customers_model->get_by_id($this->session->userdata("id"));
        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('customers/customer/edit_profile_update_action'),
                'id' => set_value('id', $row->id),
                'name' => set_value('name', $row->name),
                'address' => set_value('address', $row->address),
                'contact' => set_value('contact', $row->contact),
                'email' => set_value('email', $row->email),
                'password' => set_value('password', "1234567345qwertyuiopasdfghjklzsercgyhawikdgbdjdkdb"),
                'cpassword' => set_value('cpassword', "1234567345qwertyuiopasdfghjklzsercgyhawikdgbdjdkdb"),
            );
            $this->view('requires/header', array('page' => 'Customer Profile'));
            $this->view('customers/dashboard/edit_profile', $data);
            $this->view('requires/footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('customers/dashboard'));
        }
    }
    public function edit_profile_update_action()
    {
        $this->_rules();
        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {

          $hashed_password=crypt($this->input->post('password', TRUE), '193782465');
            $data = array(
                'name' => $this->input->post('name', TRUE),
                'address' => $this->input->post('address', TRUE),
                'contact' => $this->input->post('contact', TRUE),
                'email' => $this->input->post('email', TRUE)

            );
            if($this->input->post('password') != "1234567345qwertyuiopasdfghjklzsercgyhawikdgbdjdkdb"){
                $data['password'] = $hashed_password;
              }
            //print_r($data); die();
            $this->customers_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'successfully Profile Updated');
            redirect(site_url('customers/customer/edit_profile'));
        }
    }
    public function manage_address(){
      $logged_id=$this->session->id;
  		$data['customer_address']=$this->customers_model->get_address_by_id($logged_id);//var_dump($data['customer_address']);die;
      $this->view('requires/header', array('page' => 'Customer Address'));
      $this->view('customers/dashboard/customer_address', $data);
    }
    public function manage_address_action(){
      $logged_id=$this->session->id;
      if($logged_id){
        $address_type=$this->input->post("address_type");
        $address=$this->input->post("customer_address");
        if($this->input->post("submit") =="save"){
          $res=$this->customers_model->add_address(array('address_type'=>$address_type,'address'=>$address,'customer_id'=>$logged_id));
        }else {
          $res=$this->customers_model->update_address($this->input->post('customer_address_id'),array('address_type'=>$address_type,'address'=>$address,'updated_at'=>date('Y-m-d H:i:s')));
        }

        if($res){
          $this->session->set_flashdata('message', 'successfully Address Saved');
          redirect(site_url('customers/customer/manage_address'));
        }else {
          $this->session->set_flashdata('message', 'Something went wrong');
          redirect(site_url('customers/customer/manage_address'));
        }

      }else {
        redirect(site_url('/'));
      }
    }
    public function _rules()
    {
        $this->form_validation->set_rules('name', ' ', 'trim');
        $this->form_validation->set_rules('gst_no', ' ', 'trim');
        $this->form_validation->set_rules('pan_no', ' ', 'trim');
        $this->form_validation->set_rules('password', ' ', 'trim');
        $this->form_validation->set_rules('status', ' ', 'trim');
        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
};
