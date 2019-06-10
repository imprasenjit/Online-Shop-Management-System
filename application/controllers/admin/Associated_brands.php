<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Associated_brands extends Aipl_admin
{
    function __construct()
    {
        parent::__construct();
        $this->isAdminloggedin();
        $this->load->model('associated_brands_model');
        $this->load->model('category_model');
        $this->load->helper("fileupload");
        $this->load->library('form_validation');
        $this->load->library('breadcrumbs');
    }

    public function index()
    {
        $this->breadcrumbs->push('Dashboard', '/admin/dashboard');
        $this->breadcrumbs->push('Associated Brands', '/admin/associated_brands');
        $this->load->view('admin/requires/header', array('title' => 'Associated Brands'));
        $this->load->view('admin/associated_brands/associated_brands_list');
        $this->load->view('admin/requires/footer');
    }


    public function read($id)
    {
        $row = $this->associated_brands_model->get_by_id($id);
        $this->breadcrumbs->push('Dashboard', '/admin/dashboard');
        $this->breadcrumbs->push('Associated Brands', '/admin/associated_brands');
        $this->breadcrumbs->push('Associated Brands View', '/admin/associated_brands/read');
        if ($row) {
            $data = array(
                'id' => $row->id,
                'name' => $row->name,
                'description' => $row->description,
                'picture' => $row->picture,
            );
            $this->load->view('admin/requires/header', array('title' => 'associated_brands'));
            $this->load->view('admin/associated_brands/associated_brands_read', $data);
            $this->load->view('admin/requires/footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/associated_brands'));
        }
    }

    public function create()
    {
        $this->breadcrumbs->push('Dashboard', '/admin/dashboard');
        $this->breadcrumbs->push('Associated Brands', '/admin/associated_brands');
        $this->breadcrumbs->push('Create Associated Brands', '/admin/associated_brands/create');
        $data = array(
            'button' => 'Create',
            'action' => site_url('admin/associated_brands/create_action'),
            'id' => set_value('id'),
            'name' => set_value('name'),
            'description' => set_value('description'),
            'picture' => set_value('picture'),
        );
        $this->load->view('admin/requires/header', array('title' => 'associated_brands'));
        $this->load->view('admin/associated_brands/associated_brands_form', $data);
        $this->load->view('admin/requires/footer');
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            if ($this->input->post("upload_picture")) {
                $picture = moveFile(3, $this->input->post("upload_picture"), "picture");
            }
            $data = array(
                'name' => $this->input->post('name', TRUE),
                'description' => $this->input->post('description', TRUE),
                //'picture' => $this->input->post('picture',TRUE),
                'picture' => $picture[0],
            );

            $this->associated_brands_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('admin/associated_brands'));
        }
    }

    public function update($id)
    {
        $row = $this->associated_brands_model->get_by_id($id);
        $this->breadcrumbs->push('Dashboard', '/admin/dashboard');
        $this->breadcrumbs->push('Associated Brands', '/admin/associated_brands');
        $this->breadcrumbs->push('Update Associated Brands', '/admin/associated_brands/update');
        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('admin/associated_brands/update_action'),
                'id' => set_value('id', $row->id),
                'name' => set_value('name', $row->name),
                'description' => set_value('description', $row->description),
                'picture' => set_value('picture', $row->picture),
            );
            $this->load->view('admin/requires/header', array('title' => 'associated_brands'));
            $this->load->view('admin/associated_brands/associated_brands_form', $data);
            $this->load->view('admin/requires/footer');

            //$this->load->view('associated_brands/associated_brands_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/associated_brands'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            if ($this->input->post("upload_picture")) {
                $picture = moveFile(3, $this->input->post("upload_picture"), "picture");
                $data = array('picture' => $picture[0]);
                $this->associated_brands_model->update($this->input->post('id', TRUE), $data);
            }

            $data = array(
                'name' => $this->input->post('name', TRUE),
                'description' => $this->input->post('description', TRUE),
            );

            $this->associated_brands_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('admin/associated_brands'));
        }
    }

    public function delete($id)
    {
        $row = $this->associated_brands_model->get_by_id($id);

        if ($row) {
            $this->associated_brands_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('admin/associated_brands'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/associated_brands'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('name', ' ', 'trim');
        $this->form_validation->set_rules('description', ' ', 'trim');
        $this->form_validation->set_rules('picture', ' ', 'trim');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    function get_dtrecords()
    {
        $columns = array(
            0 => "name",
            1 => "description",
            2 => "picture",
            3 => "id",
        );
        $limit = $this->input->post("length");
        $start = $this->input->post("start");
        $order = $columns[$this->input->post("order")[0]["column"]];
        $dir = $this->input->post("order")[0]["dir"];
        $totalData = $this->associated_brands_model->tot_rows();
        $totalFiltered = $totalData;
        if (empty($this->input->post("search")["value"])) {
            $records = $this->associated_brands_model->all_rows($limit, $start, $order, $dir);
        } else {
            $search = $this->input->post("search")["value"];
            $records = $this->associated_brands_model->search_rows($limit, $start, $search, $order, $dir);
            $totalFiltered = $this->associated_brands_model->tot_search_rows($search);
        } //End of if else
        $data = array();
        if (!empty($records)) {
            foreach ($records as $rows) {
                $id = $rows->id;
                $description = $rows->description;
                $name = $rows->name;
                $picture = $rows->picture;

                $viewBtn = anchor(site_url('admin/associated_brands/read/' . $rows->id), 'View', array('class' => 'btn btn-primary btn-sm')) . "&nbsp;";
                $editBtn = anchor(site_url('admin/associated_brands/update/' . $rows->id), 'Edit', array('class' => 'btn btn-warning btn-sm')) . "&nbsp;";
                $deleteBtn = anchor(site_url('admin/associated_brands/delete/' . $rows->id), 'Delete', array('class' => 'btn btn-danger btn-sm', 'onclick' => 'return confirm(\'Are You Sure you want to delete?\')')) . "&nbsp;";

                $nestedData["name"] = $name;
                $nestedData["description"] = $description;
                $nestedData["picture"] = '<img src="' . base_url($picture) . '" style="width:80px;height:50px;">';
                $nestedData["id"] = $viewBtn . $editBtn . $deleteBtn;
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
    } //End of get_dtrecords()

};

