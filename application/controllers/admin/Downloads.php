<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');
class Downloads extends Aipl_admin {
    function __construct() {
        parent::__construct();
        $this->isAdminloggedin();
        $this->load->model('downloads_model');
        $this->load->library('form_validation');
        $this->load->helper('fileupload');
        $this->load->library('breadcrumbs');
    }

    function index($download_id=null) {
        $this->breadcrumbs->push('Dashboard', '/admin/dashboard');
        $this->breadcrumbs->push('Download', '/admin/downloads');
        $this->breadcrumbs->push('Add Download', '/admin/downloads/create');

        $row = $this->downloads_model->get_by_id($download_id);
        if ($row) {
            $data = array(
                'download_id' => $download_id,
                'download_title' => $row->download_title,
                'download_description' => $row->download_description,
                'file_path' => $row->download_file
            );
        } else {
            $data = array(
                'download_id' => $download_id,
                'download_title' => set_value('download_title'),
                'download_description' => set_value('download_description'),
                'file_path' => null
            );
        }
        $this->load->view('admin/requires/header', array('title' => 'Downloads'));
        $this->load->view('admin/downloads/downloads_form', $data);
        $this->load->view('admin/requires/footer');
    }

    function save(){
        $download_id = $this->input->post('download_id');
        $this->load->library('form_validation');
        $this->form_validation->set_rules("download_title", "Title", "required|min_length[4]");
        $this->form_validation->set_error_delimiters("<font class='error animated fadeIn'>", "</font>");
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('type', 'danger');
            $this->session->set_flashdata("message", "Input(s) field cannot be empty!");
            $this->index($download_id);
        } else {
            $nowTime = date("Y-m-d H:i:s");
            if ($this->input->post("upload_download_file")) {
                $download_file = moveFile(3, $this->input->post("upload_download_file"), "download_file");
            } else {
                $download_file = NULL;
            }//End of if else
            $data = array(
                "entry_time" => $nowTime,
                'download_title' => $this->input->post('download_title', TRUE),
                'download_description' => $this->input->post('download_description', TRUE),
                'download_file' => $download_file[0]
            );
            if(strlen($download_id)) {
                $this->downloads_model->update($download_id, $data);
                $this->session->set_flashdata('message', 'Update Record Success');
            } else {
                $this->downloads_model->insert($data);
                $this->session->set_flashdata('message', 'Create Record Success');
            }//End of if else            
            $this->session->set_flashdata('type', 'success');
            redirect(site_url('admin/downloads'));
        }
    }
    
    function delete($download_id=null) {
        $this->downloads_model->update($download_id, array('download_status'=>0));
        $this->session->set_flashdata('message', 'One record has been successfully deleted!');
        $this->session->set_flashdata('type', 'success');
        redirect(site_url('admin/downloads'));
    }
    
    function get_dtrecords() {
        $columns = array(
            0 => "download_id",
            1 => "download_title",
            2 => "download_description",
            3 => "download_file",
        );
        $limit = $this->input->post("length");
        $start = $this->input->post("start");
        $order = $columns[$this->input->post("order")[0]["column"]];
        $dir = $this->input->post("order")[0]["dir"];
        $totalData = $this->downloads_model->tot_rows();
        $totalFiltered = $totalData;
        if (empty($this->input->post("search")["value"])) {
            $records = $this->downloads_model->all_rows($limit, $start, $order, $dir);
        } else {
            $search = $this->input->post("search")["value"];
            $records = $this->downloads_model->search_rows($limit, $start, $search, $order, $dir);
            $totalFiltered = $this->downloads_model->tot_search_rows($search);
        } //End of if else
        $data = array();
        if (!empty($records)) {
            $slno = 1;
            foreach ($records as $rows) {
                $download_title = $rows->download_title;
                $download_description = $rows->download_description;
                $download_file = $rows->download_file;
                $download_id = $rows->download_id;

                $viewBtn = anchor($download_file, 'View File', array('class' => 'btn btn-primary btn-sm')) . "&nbsp;";
                $editBtn = anchor(site_url('admin/downloads/index/' . $download_id), 'Edit', array('class' => 'btn btn-sm btn-warning')) . "&nbsp;";
                $deleteBtn = anchor(site_url('admin/downloads/delete/' . $download_id), 'Delete', array('class' => 'btn btn-sm btn-danger', 'onclick' => 'return confirm(\'Are You Sure you want to delete?\')')) . "&nbsp;";
                
                $nestedData["download_id"] = $download_id;
                $nestedData["download_title"] = $download_title;
                $nestedData["download_description"] = $download_description;
                $nestedData["download_file"] = $viewBtn . $editBtn . $deleteBtn;
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

}
