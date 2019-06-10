<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Blogs extends Aipl_admin {
//Changed Master
    function __construct() {
        parent::__construct();
        $this->isAdminloggedin();
        $this->load->model('blogs_model');
        $this->load->helper("fileupload");
        $this->load->library('form_validation');
        $this->load->library('breadcrumbs');
    }

    public function index() {
        $this->breadcrumbs->push('Dashboard', '/admin/dashboard');
        $this->breadcrumbs->push('Blogs', '/admin/blogs');
        $this->load->view('admin/requires/header', array('title' => 'Blogs'));
        $this->load->view('admin/home_page_slider/slider_list');
        $this->load->view('admin/requires/footer');
    }

    public function read($id) {
        $row = $this->home_page_slider_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id' => $row->slider_id,
                'description' => $row->description,
                'display_order' => $row->display_order,
                'picture' => $row->file_path,
            );
            $this->load->view('admin/requires/header', array('title' => 'Home page slider'));
            $this->load->view('admin/home_page_slider/slider_view', $data);
            $this->load->view('admin/requires/footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            $this->session->set_flashdata('type', 'error');
            redirect(site_url('admin/associated_brands'));
        }
    }

    public function create() {

        $data = array(
            'button' => 'Add',
            'action' => site_url('admin/home_page_slider/create_action'),
            'slider_id' => set_value('slider_id'),
            'description' => set_value('description'),
            'display_order' => set_value('display_order'),
            'file_path' => set_value('file_path'),
        );
        $this->breadcrumbs->push('Dashboard', '/admin/dashboard');
        $this->breadcrumbs->push('Home Page Slider', '/admin/home_page_slider');
        $this->breadcrumbs->push('Add new slider', '/admin/home_page_slider/create');
        $this->load->view('admin/requires/header', array('title' => 'Add new home page slider'));
        $this->load->view('admin/home_page_slider/slider_form', $data);
        $this->load->view('admin/requires/footer');
    }

    public function create_action() {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            if ($this->input->post("upload_picture")) {
                $picture = moveFile(3, $this->input->post("upload_picture"), "picture"); //var_dump($picture);die;
            }
            $data = array(
                'description' => $this->input->post('description', TRUE),
                'display_order' => $this->input->post('display_order', TRUE),
                'file_path' => $picture[0],
            );
            // var_dump($data);die;
            $this->home_page_slider_model->insert($data);
            $this->session->set_flashdata('message', 'Successfully Slider Added');
            $this->session->set_flashdata('type', 'success');
            redirect(site_url('admin/home_page_slider'));
        }
    }

    public function update($id) {
        $row = $this->home_page_slider_model->get_by_id($id);
        $this->breadcrumbs->push('Dashboard', '/admin/dashboard');
        $this->breadcrumbs->push('Home Page Slider', '/admin/home_page_slider');
        $this->breadcrumbs->push('Update slider', '/admin/home_page_slider/update');
        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('admin/home_page_slider/update_action'),
                'slider_id' => set_value('slider_id', $row->slider_id),
                'description' => set_value('description', $row->description),
                'display_order' => set_value('display_order', $row->display_order),
                'file_path' => set_value('file_path', $row->file_path),
            );
            $this->load->view('admin/requires/header', array('title' => 'Home page slider'));
            $this->load->view('admin/home_page_slider/slider_form', $data);
            $this->load->view('admin/requires/footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            $this->session->set_flashdata('type', 'error');
            redirect(site_url('admin/home_page_slider'));
        }
    }

    public function update_action() {
        $this->_rules();
        $data_to_save = array();
        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            if ($this->input->post("upload_picture")) {
                $picture = moveFile(1, $this->input->post("upload_picture"), "picture");
                $data_to_save['file_path'] = $picture[0];
            }
            $data_to_save['description'] = $this->input->post('description', TRUE);
            $data_to_save['display_order'] = $this->input->post('display_order', TRUE);

            $this->home_page_slider_model->update($this->input->post('id', TRUE), $data_to_save);
            $this->session->set_flashdata('message', 'Successfully Record Updated');
            $this->session->set_flashdata('type', 'success');
            redirect(site_url('admin/home_page_slider'));
        }
    }

    public function delete($id) {
        $row = $this->home_page_slider_model->get_by_id($id);

        if ($row) {
            $this->home_page_slider_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            $this->session->set_flashdata('type', 'success');
            redirect(site_url('admin/home_page_slider'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            $this->session->set_flashdata('type', 'success');
            redirect(site_url('admin/home_page_slider'));
        }
    }

    public function _rules() {
        $this->form_validation->set_rules('description', ' ', 'trim');
        $this->form_validation->set_rules('display_order', ' ', 'trim');
        $this->form_validation->set_rules('picture', ' ', 'trim');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    function get_records() {
        $columns = array(
            0 => "file_path",
            1 => "description",
            2 => "slider_id",
        );
        $limit = $this->input->post("length");
        $start = $this->input->post("start");
        $order = $columns[$this->input->post("order")[0]["column"]];
        $dir = $this->input->post("order")[0]["dir"];
        $totalData = $this->home_page_slider_model->tot_rows();
        $totalFiltered = $totalData;
        if (empty($this->input->post("search")["value"])) {
            $records = $this->home_page_slider_model->all_rows($limit, $start, $order, $dir);
        } else {
            $search = $this->input->post("search")["value"];
            $records = $this->home_page_slider_model->search_rows($limit, $start, $search, $order, $dir);
            $totalFiltered = $this->home_page_slider_model->tot_search_rows($search);
        }//End of if else
        $data = array();
        if (!empty($records)) {
            foreach ($records as $rows) {
                $id = $rows->slider_id;
                $description = $rows->description;
                $picture = $rows->file_path;

                $viewBtn = anchor(site_url('admin/home_page_slider/read/' . $rows->slider_id), 'View', array('class' => 'btn btn-primary btn-sm')) . "&nbsp;";
                $editBtn = anchor(site_url('admin/home_page_slider/update/' . $rows->slider_id), 'Edit', array('class' => 'btn btn-warning btn-sm')) . "&nbsp;";
                $deleteBtn = anchor(site_url('admin/home_page_slider/delete/' . $rows->slider_id), 'Delete', array('class' => 'btn btn-danger btn-sm', 'onclick' => 'return confirm(\'Are You Sure you want to delete?\')')) . "&nbsp;";


                $nestedData["description"] = $description;
                $nestedData["picture"] = '<img src="' . $picture . '" style="width:80px;height:50px;">';
                $nestedData["slider_id"] = $viewBtn . $editBtn . $deleteBtn;
                $data[] = $nestedData;
            }//End of for
        }//End of if
        $json_data = array(
            "draw" => intval($this->input->post("draw")),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        );
        echo json_encode($json_data);
    }

//End of get_dtrecords()
}
