<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');
class Users extends Aipl_admin {
    function __construct() {
        parent::__construct();
        $this->load->model('users_model');
        $this->load->model('roles_model');
        $this->load->library('form_validation');
        $this->load->helper('fileupload');
        $this->load->library('breadcrumbs');
        $this->isAdminloggedin();
    }

    function index() {
        $this->breadcrumbs->push('Dashboard', '/admin/dashboard');
        $this->breadcrumbs->push('Admin Users', '/admin/aboutus');

        $this->load->view('admin/requires/header', array('title' => 'Admin Users'));
        $this->load->view('admin/users/user_list');
        $this->load->view('admin/requires/footer');
    }
    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('admin/users/create_action'),
            'id' => set_value('id'),
            'role_id' => set_value('role_id'),
            'name' => set_value('name'),
            'username' => set_value('username'),
            'mobile' => set_value('mobile'),
            'password' => set_value(''),
        );
        $this->breadcrumbs->push('Dashboard', '/admin/dashboard');
        $this->breadcrumbs->push('Admin Users', '/admin/users');
        $this->breadcrumbs->push('Add User', '/admin/users/create');
        $data['role_list']=$this->roles_model->get_all();
        $this->load->view('admin/requires/header',array('title'=>'Add User'));
        $this->load->view('admin/users/user_form', $data);
        $this->load->view('admin/requires/footer');
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
          $check_user = $this->users_model->check_user_name($this->input->post('username', TRUE));

          if(!$check_user){
            $password = $this->input->post('password', TRUE);
            $hashed_password = crypt($password, '$6$$supplyorigin$');
            $data = array(
              'name' => $this->input->post('name',TRUE),
              'username' => $this->input->post('username',TRUE),
              'role_id' => $this->input->post('role_id',TRUE),
              'mobile' =>  $this->input->post('mobile',TRUE),
              'password' => $hashed_password,
              'created_by' => $this->session->userdata('id'),
            );

              $this->users_model->insert($data);
              $this->session->set_flashdata('message', 'Create Record Success');
              $this->session->set_flashdata('type', 'success');
              redirect(site_url('admin/users'));
          }else {
            $this->session->set_flashdata('message', 'Username Already Exists . Please use different username!');
            $this->session->set_flashdata('type', 'danger');
            $this->create();
          }

        }
    }

    public function update($id)
    {
        $row = $this->users_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('admin/users/update_action'),
        'id' => set_value('id', $row->id),
        'name' => set_value('name', $row->name),
        'role_id' => set_value('name', $row->role_id),
        'username' => set_value('username', $row->username),
        'mobile' => set_value('mobile', $row->mobile),
        'password' => set_value('password', "123456789456abcdefghijklmnopqrstuvwxyzq"),
      );
      $data['role_list']=$this->roles_model->get_all();
    $this->load->view('admin/requires/header',array('title'=>'Edit Users'));
        $this->load->view('admin/users/user_form', $data);
    $this->load->view('admin/requires/footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/users'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
              $password=$this->input->post('password',TRUE);
              $data = array(
               'name' => $this->input->post('name',TRUE),
               'role_id' => $this->input->post('role_id',TRUE),
               'username' => $this->input->post('username',TRUE),
               'mobile' => $this->input->post('mobile',TRUE),
               'updated_at' => date("Y-m-d H:i:s"),
               'updated_by' => $this->session->userdata('id'),
               );

              if($password !="123456789456abcdefghijklmnopqrstuvwxyzq"){
                  $hashed_password = crypt($password, '$6$$supplyorigin$');
                $data['password']=$hashed_password;
              }
            $this->users_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            $this->session->set_flashdata('type', 'success');
            redirect(site_url('admin/users'));
      }
    }
    public function delete($id)
    {
        $row = $this->users_model->get_by_id($id);
        if ($row) {
            $this->users_model->update($id,array('updated_at' => date("Y-m-d H:i:s"),
            'updated_by' => $this->session->userdata('id'),'status'=>'0'));
            $this->session->set_flashdata('message', 'Delete Record Success');
            $this->session->set_flashdata('type', 'success');
            redirect(site_url('admin/users'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            $this->session->set_flashdata('type', 'danger');
            redirect(site_url('admin/users'));
        }
    }
    public function _rules()
    {
  $this->form_validation->set_rules('name', 'Name', 'trim|required');
  $this->form_validation->set_rules('role_id', 'Role', 'trim|required');
  $this->form_validation->set_rules('username', 'Username', 'trim|required');
  $this->form_validation->set_rules('password', 'Pasword', 'trim|required');
  $this->form_validation->set_rules('id', 'id', 'trim');
  $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
    function getUsers(){
      $columns = array(
          0 => "name",
          1 => "username",
          2 => "mobile"
      );
      $limit = $this->input->post("length");
      $start = $this->input->post("start");
      $order = $columns[$this->input->post("order")[0]["column"]];
      $dir = $this->input->post("order")[0]["dir"];
      $totalData = $this->users_model->tot_rows();
      $totalFiltered = $totalData;
      if (empty($this->input->post("search")["value"])) {
          $records = $this->users_model->all_rows($limit, $start, $order, $dir);
      } else {
          $search = $this->input->post("search")["value"];
          $records = $this->users_model->search_rows($limit, $start, $search, $order, $dir);
          $totalFiltered = $this->users_model->tot_search_rows($search);
      } //End of if else
      $data = array();
      if (!empty($records)) {
          $slno = 1;
          foreach ($records as $rows) {
              $id = $rows->id;
              // $viewBtn = anchor(site_url('admin/users/read/' . $id), 'View', array('class' => 'btn btn-primary btn-sm')) . "&nbsp;";
              $editBtn = anchor(site_url('admin/users/update/' . $id), 'Edit', array('class' => 'btn btn-sm btn-warning')) . "&nbsp;";
              $deleteBtn = anchor(site_url('admin/users/delete/' . $id), 'Delete', array('class' => 'btn btn-sm btn-danger', 'onclick' => 'return confirm(\'Are You Sure you want to delete?\')')) . "&nbsp;";
              $nestedData["slno"] = $slno++;
              $nestedData["name"] = $rows->name;
              $nestedData["username"] = $rows->username;
              $nestedData["phone"] = $rows->mobile;
              $nestedData["id"] =  $editBtn . $deleteBtn;
              $data[] = $nestedData;
          } //End of for
      } //End of if
      $json_data = array(
          "draw" => intval($this->input->post("draw")),
          "recordsTotal" => intval($totalData),
          "recordsFiltered" => intval($totalFiltered),
          "data" => $data
      );
      echo json_encode($json_data);
    }


}
