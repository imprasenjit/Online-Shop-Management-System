<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Sub_category extends Aipl_admin {
    function __construct() {
        parent::__construct();
        $this->isAdminloggedin();
        $this->load->model('sub_category_model');
        $this->load->model('category_model');
        $this->load->library('form_validation');
        $this->load->library('breadcrumbs');
    }
    public function index() {
        $this->breadcrumbs->push('Dashboard', '/admin/dashboard');
        $this->breadcrumbs->push('Sub Category', '/admin/sub_category');
        $this->load->view('admin/requires/header', array('title' => 'Sub Category'));
        $this->load->view('admin/sub_category/sub_category_list');
        $this->load->view('admin/requires/footer');
    }
    public function read($id) {
        $row = $this->sub_category_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id' => $row->id,
                'category' => $row->category,
                'sub_category' => $row->sub_category,
                'description' => $row->description,
                'picture' => $row->picture,
                'status' => $row->status,
            );
            $this->load->view('admin/requires/header', array('title' => 'Sub Category'));
            $this->load->view('admin/sub_category/sub_category_read', $data);
            $this->load->view('admin/requires/footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/sub_category'));
        }
    }
    public function create() {
        $data = array(
            'button' => 'Create',
            'action' => site_url('admin/sub_category/create_action'),
            'id' => set_value('id'),
            'parent_category' => set_value('category'),
            'sub_category' => set_value('sub_category'),
            'description' => set_value('description'),
            'picture' => set_value('picture'),
            'status' => set_value('status'),
        );
        if ($this->category_model->get_all()) {
            $data["category"] = $this->category_model->get_all();
        }
        $this->breadcrumbs->push('Dashboard', '/admin/dashboard');
        $this->breadcrumbs->push('Sub Category', '/admin/sub_category');
        $this->breadcrumbs->push('Add Sub-Category', '/admin/sub_category/create');
        $this->load->view('admin/requires/header', array('title' => 'Sub Category'));
        $this->load->view('admin/sub_category/sub_category_form', $data);
        $this->load->view('admin/requires/footer');
    }
    public function create_action() {
        $this->_rules();
        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $this->load->helper("fileupload");
            if ($this->input->post("upload_picture")) {
                $picture = moveFile(3, $this->input->post("upload_picture"), "picture");
            }
            $data = array(
                'category' => $this->input->post('category', TRUE),
                'sub_category' => $this->input->post('sub_category', TRUE),
                'description' => $this->input->post('description', TRUE),
                'picture' => $picture[0],
                'status' => '1',
            );
            $this->sub_category_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('admin/sub_category'));
        }
    }
    public function update($id) {
        $row = $this->sub_category_model->get_by_id($id);
        $this->breadcrumbs->push('Dashboard', '/admin/dashboard');
        $this->breadcrumbs->push('Sub Category', '/admin/sub_category');
        $this->breadcrumbs->push('Update Sub-Category', '/admin/sub_category/update');
        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('admin/sub_category/update_action'),
                'id' => set_value('id', $row->id),
                'parent_category' => set_value('category', $row->category),
                'sub_category' => set_value('sub_category', $row->sub_category),
                'description' => set_value('description', $row->description),
                'picture' => set_value('picture', $row->picture),
                'status' => set_value('status', $row->status),
            );
            if ($this->category_model->get_all()) {
                $data["category"] = $this->category_model->get_all();
            }
            $this->load->view('admin/requires/header', array('title' => 'Sub Category'));
            $this->load->view('admin/sub_category/sub_category_form', $data);
            $this->load->view('admin/requires/footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/sub_category'));
        }
    }
    public function update_action() {
        $this->_rules();
        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $this->load->helper("fileupload");
            if ($this->input->post("upload_picture")) {
                $picture = moveFile(3, $this->input->post("upload_picture"), "picture");
                $data = array('picture' => $picture[0]);
                $this->sub_category_model->update($this->input->post('id', TRUE), $data);
            }
            $data = array(
                'category' => $this->input->post('category', TRUE),
                'sub_category' => $this->input->post('sub_category', TRUE),
                'description' => $this->input->post('description', TRUE),
            );
            $this->sub_category_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('admin/sub_category'));
        }
    }
    public function delete($id) {
        $row = $this->sub_category_model->get_by_id($id);
        if ($row) {
            $this->sub_category_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('admin/sub_category'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/sub_category'));
        }
    }
    public function _rules() {
        $this->form_validation->set_rules('category', 'Category', 'trim|required');
        $this->form_validation->set_rules('sub_category', 'Sub-category', 'trim|required');
        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span><br/>');
    }
    function get_dtrecords() {
        $columns = array(
            0 => "category",
            1 => "mobile",
            2 => "description",
            3 => "picture",
            4 => "id",
        );
        $limit = $this->input->post("length");
        $start = $this->input->post("start");
        $order = $columns[$this->input->post("order")[0]["column"]];
        $dir = $this->input->post("order")[0]["dir"];
        $totalData = $this->sub_category_model->tot_rows();
        $totalFiltered = $totalData;
        if (empty($this->input->post("search")["value"])) {
            $records = $this->sub_category_model->all_rows($limit, $start, $order, $dir);
        } else {
            $search = $this->input->post("search")["value"];
            $records = $this->sub_category_model->search_rows($limit, $start, $search, $order, $dir);
            $totalFiltered = $this->sub_category_model->tot_search_rows($search);
        } //End of if else
        $data = array();
        if (!empty($records)) {
            $slno = 1;
            foreach ($records as $rows) {
                $category = $rows->category;
                $category_name = ($this->category_model->get_by_id($category)) ? $this->category_model->get_by_id($category)->category_name : "N/A";
                $sub_category = $rows->sub_category;
                $description = $rows->description;
                $picture = $rows->picture;
                $id = $rows->id;
                $viewBtn = anchor(site_url('admin/sub_category/read/' . $id), 'View', array('class' => 'btn btn-primary btn-sm')) . "&nbsp;";
                $editBtn = anchor(site_url('admin/sub_category/update/' . $id), 'Edit', array('class' => 'btn btn-sm btn-warning')) . "&nbsp;";
                $deleteBtn = anchor(site_url('admin/sub_category/delete/' . $id), 'Delete', array('class' => 'btn btn-sm btn-danger', 'onclick' => 'return confirm(\'Are You Sure you want to delete?\')')) . "&nbsp;";
                $nestedData["slno"] = $slno++;
                $nestedData["category"] = $category_name;
                $nestedData["sub_category"] = $sub_category;
                $nestedData["description"] = $description;
                $nestedData["picture"] = '<img src="'.base_url($picture).'" style="width:80px;height:50px;" />';
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
}
;
/* End of file Sub_category.php */
/* Location: ./application/controllers/Sub_category.php */
