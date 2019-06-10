<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');
class Transporters extends Aipl_admin {
    function __construct() {
        parent::__construct();
        $this->load->model('transporters_model');
        $this->load->library('form_validation');
        $this->load->library('breadcrumbs');
    }//End of __construct()
    
    function index() {
        $this->breadcrumbs->push('Dashboard', '/admin/dashboard');
        $this->breadcrumbs->push('Transporters', '/admin/transporters');
        $this->breadcrumbs->push('Add Transporter', '/admin/transporters/create');
        $this->isAdminloggedin();
        $this->load->view('admin/requires/header', array('title' => 'Transporters Management'));
        $this->load->view('admin/transporters/transporters_list');
        $this->load->view('admin/requires/footer');
    }//End of index()
    
    function read($id) {
        $this->isAdminloggedin();
        $row = $this->transporters_model->get_by_id($id);
        if ($row) {
            $data = array(
                'transporter_id' => $row->transporter_id,
                'transporter_name' => $row->transporter_name,
                'transporter_mobile' => $row->transporter_mobile,
                'transporter_email' => $row->transporter_email,
                'transporter_address' => $row->transporter_address,
                'transporter_gst' => $row->transporter_gst,
            );
            $this->breadcrumbs->push('Dashboard', '/admin/dashboard');
            $this->breadcrumbs->push('Suppliers List', '/admin/transporters');
            $this->breadcrumbs->push('Suppliers Details', '/admin/transporters/read');

            $this->load->view('admin/requires/header', array('title' => 'Transporter view'));
            $this->load->view('admin/transporters/transporters_read', $data);
            $this->load->view('admin/requires/footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            $this->session->set_flashdata('type', 'error');
            redirect(site_url('admin/transporters'));
        }//End of if else
    }//End of read()
    
    function create() {
        $this->breadcrumbs->push('Dashboard', '/admin/dashboard');
        $this->breadcrumbs->push('Transporters', '/admin/transporters');
        $this->breadcrumbs->push('Add Transporter', '/admin/transporters/create');
        $this->isAdminloggedin();
        $data = array(
            'button' => 'Create',
            'action' => site_url('admin/transporters/create_action'),
            'transporter_id' => set_value('transporter_id'),'transporter_name' => set_value('transporter_name'),
            'transporter_mobile' => set_value('transporter_mobile'),
            'transporter_email' => set_value('transporter_email'),
            'transporter_pass' => set_value('transporter_pass'),
            'transporter_address' => set_value('transporter_address'),
            'transporter_gst' => set_value('transporter_gst'),
        );
        $this->load->view('admin/requires/header', array('title' => 'transporters'));
        $this->load->view('admin/transporters/transporters_form', $data);
        $this->load->view('admin/requires/footer');
    }//End of create
    
    function create_action(){
        $this->isAdminloggedin();
        $transporter_pass = $this->input->post('transporter_pass', TRUE);
        $hashed_transporter_pass = crypt($transporter_pass, '$6$$supplyorigin$');
        $data = array(
            'transporter_id' => $this->input->post('transporter_id', TRUE),
            'transporter_name' => $this->input->post('transporter_name', TRUE),
            'transporter_mobile' => $this->input->post('transporter_mobile', TRUE),
            'transporter_email' => $this->input->post('transporter_email', TRUE),
            'transporter_pass' => $hashed_transporter_pass,
            'transporter_address' => $this->input->post('transporter_address', TRUE),
            'transporter_gst' => $this->input->post('transporter_gst', TRUE),
            'created_at' => date("Y-m-d H:i:s"),
            'created_by' => $this->session->userdata('id'),
        );
        $this->transporters_model->insert($data);
        $this->session->set_flashdata('message', 'Create Record Success');
        redirect(site_url('admin/transporters'));
    }//End of create_action
    
    function update($id) {
        $this->isAdminloggedin();
        $row = $this->transporters_model->get_by_id($id);
        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('admin/transporters/update_action'),
                'transporter_id' => set_value('transporter_id', $row->transporter_id),
                'transporter_name' => set_value('transporter_name', $row->transporter_name),
                'transporter_mobile' => set_value('transporter_mobile', $row->transporter_mobile),
                'transporter_email' => set_value('transporter_email', $row->transporter_email),
                'transporter_pass' => set_value('transporter_pass', "123456789456"),
                'transporter_address' => set_value('transporter_address', $row->transporter_address),
                'transporter_gst' => set_value('transporter_gst', $row->transporter_gst),
            );
            $this->load->view('admin/requires/header', array('title' => 'transporters'));
            $this->load->view('admin/transporters/transporters_form', $data);
            $this->load->view('admin/requires/footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/transporters'));
        }//End of if else
    }//End of update
    
    function update_action(){
        $this->isAdminloggedin();
        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('transporter_id', TRUE));
        } else {
            $transporter_pass = $this->input->post('transporter_pass', TRUE);
            if ($transporter_pass == "123456789456") {
                $data = array(
                    'transporter_name' => $this->input->post('transporter_name', TRUE),
                    'transporter_mobile' => $this->input->post('transporter_mobile', TRUE),
                    'transporter_address' => $this->input->post('transporter_address', TRUE),
                    'transporter_gst' => $this->input->post('transporter_gst', TRUE),
                    'updated_at' => date("Y-m-d H:i:s"),
                    'updated_by' => $this->session->userdata('id'),
                );
            } else {
                $hashed_transporter_pass = crypt($transporter_pass, '$6$$supplyorigin$');
                $data = array(
                    'transporter_name' => $this->input->post('transporter_name', TRUE),
                    'transporter_mobile' => $this->input->post('transporter_mobile', TRUE),
                    'transporter_pass' => $hashed_transporter_pass,
                    'transporter_address' => $this->input->post('transporter_address', TRUE),
                    'transporter_gst' => $this->input->post('transporter_gst', TRUE),
                    'updated_at' => date("Y-m-d H:i:s"),
                    'updated_by' => $this->session->userdata('id'),
                );
            }
            $this->transporters_model->update($this->input->post('transporter_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('admin/transporters'));
        }//End of if else
    }//End of update_action
    
    function delete($id){
        $this->isAdminloggedin();
        $row = $this->transporters_model->get_by_id($id);
        if ($row) {
            $this->transporters_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('admin/transporters'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/transporters'));
        }//End of if else
    }//End of delete()

    function get_dtrecords() {
        $columns = array(
            0 => "transporter_name",
            1 => "transporter_mobile",
            2 => "transporter_address",
            3 => "transporter_email",
            4 => "transporter_id",
        );
        $limit = $this->input->post("length");
        $start = $this->input->post("start");
        $order = $columns[$this->input->post("order")[0]["column"]];
        $dir = $this->input->post("order")[0]["dir"];
        $totalData = $this->transporters_model->tot_rows();
        $totalFiltered = $totalData;
        if (empty($this->input->post("search")["value"])) {
            $records = $this->transporters_model->all_rows($limit, $start, $order, $dir);
        } else {
            $search = $this->input->post("search")["value"];
            $records = $this->transporters_model->search_rows($limit, $start, $search, $order, $dir);
            $totalFiltered = $this->transporters_model->tot_search_rows($search);
        } //End of if else
        $data = array();
        if (!empty($records)) {
            $slno = 1;
            foreach ($records as $rows) {
                $transporter_name = $rows->transporter_name;
                $transporter_mobile = $rows->transporter_mobile;
                $transporter_address = $rows->transporter_address;
                $transporter_email = $rows->transporter_email;
                $transporter_id = $rows->transporter_id;

                $viewBtn = anchor(site_url('admin/transporters/read/' . $transporter_id), 'View', array('class' => 'btn btn-primary btn-sm')) . "&nbsp;";
                $editBtn = anchor(site_url('admin/transporters/update/' . $transporter_id), 'Edit', array('class' => 'btn btn-sm btn-warning')) . "&nbsp;";
                $deleteBtn = anchor(site_url('admin/transporters/delete/' . $transporter_id), 'Delete', array('class' => 'btn btn-sm btn-danger', 'onclick' => 'return confirm(\'Are You Sure you want to delete?\')')) . "&nbsp;";
                $nestedData["slno"] = $slno++;
                $nestedData["transporter_name"] = $transporter_name;
                $nestedData["transporter_mobile"] = $transporter_mobile;
                $nestedData["transporter_address"] = $transporter_address;
                $nestedData["transporter_email"] = $transporter_email;
                $nestedData["transporter_id"] = $viewBtn . $editBtn . $deleteBtn;
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
    }//End of get_dtrecords()
};
