<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');
class Aboutus extends Aipl_admin {
    function __construct() {
        parent::__construct();
        $this->load->model('aboutus_model');
        $this->load->library('form_validation');
        $this->load->helper('fileupload');
        $this->load->library('breadcrumbs');
    }

    function index() {
        $this->breadcrumbs->push('Dashboard', '/admin/dashboard');
        $this->breadcrumbs->push('Aboutus', '/admin/aboutus');
        $this->breadcrumbs->push('Add Aboutus', '/admin/aboutus/create');
        $this->isAdminloggedin();

        $row = $this->aboutus_model->get_by_id(1);
        if ($row) {
            $data = array(
                'aboutus_content' => $row->aboutus_content,
                'file_path' => $row->aboutus_img
            );
        } else {
            $data = array(
                'aboutus_content' => set_value('aboutus_content'),
                'file_path' => null
            );
        }
        $this->load->view('admin/requires/header', array('title' => 'aboutus'));
        $this->load->view('admin/aboutus/aboutus_form', $data);
        $this->load->view('admin/requires/footer');
    }

    function save(){
        $this->isAdminloggedin();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('description', ' ', 'trim');
        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $aboutus_id = 1;
            if ($this->input->post("upload_aboutus_img")) {
                $aboutus_img = moveFile(1, $this->input->post("upload_aboutus_img"), "aboutus_img");
            } else {
                $aboutus_img = NULL;
            }//End of if else
            $data = array(
                'aboutus_content' => $this->input->post('aboutus_content', TRUE),
                'aboutus_img' => $aboutus_img[0]
            );
            $this->aboutus_model->update($aboutus_id, $data);
            $this->session->set_flashdata('message', 'Create Record Success');
            $this->session->set_flashdata('type', 'success');
            redirect(site_url('admin/aboutus'));
        }
    }

}
