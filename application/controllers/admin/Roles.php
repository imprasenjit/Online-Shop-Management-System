<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');
class Roles extends Aipl_admin {
    function __construct() {
        parent::__construct();
        $this->load->model('roles_model');
        $this->load->library('form_validation');
        $this->load->library('breadcrumbs');
        $this->isAdminloggedin();
    }

    function index() {
        $this->breadcrumbs->push('Dashboard', '/admin/dashboard');
        $this->breadcrumbs->push('Admin Roles', '/admin/roles');

        $this->load->view('admin/requires/header', array('title' => 'Admin Roles'));
        $this->load->view('admin/roles/role_list');
        $this->load->view('admin/requires/footer');
    }
    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('admin/roles/create_action'),
            'id' => set_value('id'),
            'name' => set_value('name'),
            'rights' => set_value('rolename'),
        );
        $this->breadcrumbs->push('Dashboard', '/admin/dashboard');
        $this->breadcrumbs->push('Admin roles', '/admin/roles');
        $this->breadcrumbs->push('Add role', '/admin/roles/create');
        $data['all_rights']=$this->roles_model->get_rights();
        $this->load->view('admin/requires/header',array('title'=>'Add role'));
        $this->load->view('admin/roles/role_form', $data);
        $this->load->view('admin/requires/footer');
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
          $check_role = $this->roles_model->check_role_name($this->input->post('name', TRUE));
          $rights=json_encode($this->input->post('rights[]'));
          if(!$check_role){
            $data = array(
              'name' => $this->input->post('name',TRUE),
              'rights' => $rights,
              'created_by' => $this->session->userdata('id'),
            );

              $this->roles_model->insert($data);
              $this->session->set_flashdata('message', 'Create Record Success');
              $this->session->set_flashdata('type', 'success');
              redirect(site_url('admin/roles'));
          }else {
            $this->session->set_flashdata('message', 'role Already Exists . Please use different role!');
            $this->session->set_flashdata('type', 'danger');
            $this->create();
          }

        }
    }

    public function update($id)
    {
        $row = $this->roles_model->get_by_id($id);

        if ($row) {
          $data = array(
          'button' => 'Update',
          'action' => site_url('admin/roles/update_action'),
          'id' => set_value('id', $row->role_id),
          'name' => set_value('name', $row->name),
          'rights' => set_value('rights', json_decode($row->rights)),
        );
        $data['all_rights']=$this->roles_model->get_rights();
        $this->load->view('admin/requires/header',array('title'=>'Edit roles'));
        $this->load->view('admin/roles/role_form', $data);
        $this->load->view('admin/requires/footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/roles'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
                  $rights=json_encode($this->input->post('rights[]'));
              $data = array(
               'name' => $this->input->post('name',TRUE),
               'rights' => $rights,
               'updated_at' => date("Y-m-d H:i:s"),
               'updated_by' => $this->session->userdata('id'),
               );
            $this->roles_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            $this->session->set_flashdata('type', 'success');
            redirect(site_url('admin/roles'));
      }
    }
    public function delete($id)
    {
        $row = $this->roles_model->get_by_id($id);
        if ($row) {
            $this->roles_model->update($id,array('updated_at' => date("Y-m-d H:i:s"),
            'updated_by' => $this->session->userdata('id'),'status'=>'0'));
            $this->session->set_flashdata('message', 'Delete Record Success');
            $this->session->set_flashdata('type', 'success');
            redirect(site_url('admin/roles'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            $this->session->set_flashdata('type', 'danger');
            redirect(site_url('admin/roles'));
        }
    }
    public function _rules()
    {
  $this->form_validation->set_rules('name', 'Name', 'trim|required');
  $this->form_validation->set_rules('rights[]', 'Rights', 'trim|required');
  $this->form_validation->set_rules('id', 'id', 'trim');
  $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
    function getroles(){
      $columns = array(
          0 => "name",
          1 => "rights"
      );
      $limit = $this->input->post("length");
      $start = $this->input->post("start");
      $order = $columns[$this->input->post("order")[0]["column"]];
      $dir = $this->input->post("order")[0]["dir"];
      $totalData = $this->roles_model->tot_rows();
      $totalFiltered = $totalData;
      if (empty($this->input->post("search")["value"])) {
          $records = $this->roles_model->all_rows($limit, $start, $order, $dir);
      } else {
          $search = $this->input->post("search")["value"];
          $records = $this->roles_model->search_rows($limit, $start, $search, $order, $dir);
          $totalFiltered = $this->roles_model->tot_search_rows($search);
      } //End of if else
      $data = array();
      if (!empty($records)) {
          $slno = 1;
          foreach ($records as $rows) {
              $id = $rows->role_id;

              $editBtn = anchor(site_url('admin/roles/update/' . $id), 'Edit', array('class' => 'btn btn-sm btn-warning')) . "&nbsp;";
              $deleteBtn = anchor(site_url('admin/roles/delete/' . $id), 'Delete', array('class' => 'btn btn-sm btn-danger', 'onclick' => 'return confirm(\'Are You Sure you want to delete?\')')) . "&nbsp;";
              $nestedData["slno"] = $slno++;
              $nestedData["name"] = $rows->name;
              $nestedData["rights"] = $this->roles_model->get_roles_name($rows->rights);
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
