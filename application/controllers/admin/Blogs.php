<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Blogs extends Aipl_admin {

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
        $this->load->view('admin/blogs/blog_list');
        $this->load->view('admin/requires/footer');
    }

    public function read($id) {
        $row = $this->blogs_model->get_by_id($id);
        if ($row) {
            $data = array(
                'blogs_id' => $row->blogs_id,
                'blog' => $row->blog,
                'blog_title' => $row->blog_title
            );
            $this->breadcrumbs->push('Dashboard', '/admin/dashboard');
            $this->breadcrumbs->push('Blog List', '/admin/blogs');
            $this->breadcrumbs->push('Blog Details', '/admin/blogs/read');
            $this->load->view('admin/requires/header', array('title' => 'Blog'));
            $this->load->view('admin/blogs/blog_view', $data);
            $this->load->view('admin/requires/footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            $this->session->set_flashdata('type', 'warning');
            redirect(site_url('admin/blogs'));
        }
    }

    public function create() {

        $data = array(
            'button' => 'Add',
            'action' => site_url('admin/blogs/create_action'),
            'blogs_id' => set_value('blogs_id'),
            'blog' => set_value('blog'),
            'blog_title' => set_value('blog_title'),
        );
        $this->breadcrumbs->push('Dashboard', '/admin/dashboard');
        $this->breadcrumbs->push('Blog List', '/admin/blogs');
        $this->breadcrumbs->push('Add new blog', '/admin/blogs/create');
        $this->load->view('admin/requires/header', array('title' => 'Add new blog'));
        $this->load->view('admin/blogs/blog_form', $data);
        $this->load->view('admin/requires/footer');
    }

    public function create_action() {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {

            $data = array(
                'blog' => $this->input->post('blog', TRUE),
                'blog_title' => $this->input->post('blog_title', TRUE),
                'created_by' => $this->session->id,
            );
            $this->blogs_model->insert($data);
            $this->session->set_flashdata('message', 'Successfully Blog Added');
            $this->session->set_flashdata('type', 'success');
            redirect(site_url('admin/blogs'));
        }
    }

    public function update($id) {
        $row = $this->blogs_model->get_by_id($id);
        $this->breadcrumbs->push('Dashboard', '/admin/dashboard');
        $this->breadcrumbs->push('Blog List', '/admin/blogs');
        $this->breadcrumbs->push('Update Blog', '/admin/blogs/update');
        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('admin/blogs/update_action'),
                'blogs_id' => set_value('blogs_id', $row->blogs_id),
                'blog' => set_value('description', $row->blog),
                'blog_title' => set_value('blog_title', $row->blog_title)
            );
            $this->load->view('admin/requires/header', array('title' => 'Blogs'));
            $this->load->view('admin/blogs/blog_form', $data);
            $this->load->view('admin/requires/footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            $this->session->set_flashdata('type', 'warning');
            redirect(site_url('admin/blogs'));
        }
    }

    public function update_action() {
        $this->_rules();
        $data_to_save = array();
        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {

            $data_to_save['blog'] = $this->input->post('blog', TRUE);
            $data_to_save['blog_title'] = $this->input->post('blog_title', TRUE);
            $data_to_save['updated_by'] = $this->session->id;
            $data_to_save['updated_at'] = date("Y-m-d H:i:s");

            $this->blogs_model->update($this->input->post('id', TRUE), $data_to_save);
            $this->session->set_flashdata('message', 'Successfully Record Updated');
            $this->session->set_flashdata('type', 'success');
            redirect(site_url('admin/blogs'));
        }
    }

    public function delete($id) {
        $row = $this->blogs_model->get_by_id($id);

        if ($row) {
            $this->blogs_model->update($id,array('status'=>'0','updated_at'=>date("Y-m-d H:i:s"),'updated_by'=>$this->session->id));
            $this->session->set_flashdata('message', 'Delete Record Success');
            $this->session->set_flashdata('type', 'success');
            redirect(site_url('admin/blogs'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            $this->session->set_flashdata('type', 'warning');
            redirect(site_url('admin/blogs'));
        }
    }

    public function _rules() {
        $this->form_validation->set_rules('blogs_id', ' ', 'trim');
        $this->form_validation->set_rules('blog', 'Blog', 'trim|required');
        $this->form_validation->set_rules('blog_title', 'Blog Title', 'trim|required');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    function get_records() {
        $columns = array(
            0 => "blogs_id",
            1 => "blog_title",
            2 => "blog",
        );
        $limit = $this->input->post("length");
        $start = $this->input->post("start");
        $order = $columns[$this->input->post("order")[0]["column"]];
        $dir = $this->input->post("order")[0]["dir"];
        $totalData = $this->blogs_model->tot_rows();
        $totalFiltered = $totalData;
        if (empty($this->input->post("search")["value"])) {
            $records = $this->blogs_model->all_rows($limit, $start, $order, $dir);
        } else {
            $search = $this->input->post("search")["value"];
            $records = $this->blogs_model->search_rows($limit, $start, $search, $order, $dir);
            $totalFiltered = $this->blogs_model->tot_search_rows($search);
        }//End of if else
        $data = array();
        if (!empty($records)) {
            foreach ($records as $rows) {
                $viewBtn = anchor(site_url('admin/blogs/read/' . $rows->blogs_id), 'View', array('class' => 'btn btn-primary btn-sm')) . "&nbsp;";
                $editBtn = anchor(site_url('admin/blogs/update/' . $rows->blogs_id), 'Edit', array('class' => 'btn btn-warning btn-sm')) . "&nbsp;";
                $deleteBtn = anchor(site_url('admin/blogs/delete/' . $rows->blogs_id), 'Delete', array('class' => 'btn btn-danger btn-sm', 'onclick' => 'return confirm(\'Are You Sure you want to delete?\')')) . "&nbsp;";


                $nestedData["blogs_id"] = $rows->blogs_id;
                $nestedData["blog_title"] = $rows->blog_title;
                $nestedData["blog"] = $rows->blog;
                $nestedData["action"] = $viewBtn . $editBtn . $deleteBtn;
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
