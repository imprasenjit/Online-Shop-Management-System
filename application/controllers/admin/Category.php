<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Category extends Aipl_admin
{
    function __construct()
    {
        parent::__construct();
        $this->isAdminloggedin();
        $this->load->model('category_model');
        $this->load->library('form_validation');
		    $this->load->helper("fileupload");
        $this->load->library("breadcrumbs");
    }
    public function index()
    {
        $this->breadcrumbs->push('Dashboard', '/admin/dashboard');
        $this->breadcrumbs->push('Category', '/admin/category');
        $this->load->view('admin/requires/header',array('title'=>'Category'));
        $this->load->view('admin/category/category_list');
        $this->load->view('admin/requires/footer');
    }
    public function read($id)
    {
        $row = $this->category_model->get_by_id($id);
        if ($row) {
            $data = array(
			'id' => $row->id,
			'category_name' => $row->category_name,
			'description' => $row->description,
			'picture' => $row->picture,
			'status' => $row->status,
	    );
		$this->load->view('admin/requires/header',array('title'=>'category'));
        $this->load->view('admin/category/category_read', $data);
        $this->load->view('admin/requires/footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/category'));
        }
    }
    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('admin/category/create_action'),
			      'id' => set_value('id'),
			      'category_name' => set_value('category_name'),
			      'description' => set_value('description'),
			      'picture' => set_value('picture'),
			      'status' => set_value('status'),
		    );
        $this->breadcrumbs->push('Dashboard', '/admin/dashboard');
        $this->breadcrumbs->push('Category List', '/admin/category');
        $this->breadcrumbs->push('Add Category', '/admin/category/create');
        $this->load->view('admin/requires/header',array('title'=>'category'));
        $this->load->view('admin/category/category_form', $data);
        $this->load->view('admin/requires/footer');
    }
    public function create_action()
    {
        $this->_rules();
        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
			$this->load->helper("fileupload");
			if ($this->input->post("upload_picture")) {
				$picture = moveFile(3, $this->input->post("upload_picture"), "picture");
			}
            $data = array(
			'category_name' => $this->input->post('category_name',TRUE),
			'description' => $this->input->post('description',TRUE),
			'picture' => $picture[0],
			//'picture' => $this->input->post('picture',TRUE),
			//'status' => $this->input->post('status',TRUE),
	    );
            $this->category_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('admin/category'));
        }
    }
    public function update($id)
    {
        $this->breadcrumbs->push('Dashboard', '/admin/dashboard');
        $this->breadcrumbs->push('Category', '/admin/category');
        $this->breadcrumbs->push('Update Category', '/admin/category/update');
        $row = $this->category_model->get_by_id($id);
        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('admin/category/update_action'),
				'id' => set_value('id', $row->id),
				'category_name' => set_value('category_name', $row->category_name),
				'description' => set_value('description', $row->description),
				'picture' => set_value('picture', $row->picture),
				'status' => set_value('status', $row->status),
	    );
		$this->load->view('admin/requires/header',array('title'=>'category'));
        $this->load->view('admin/category/category_form', $data);
		$this->load->view('admin/requires/footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/category'));
        }
    }
    public function update_action()
    {
        $this->_rules();
        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
			$this->load->helper("fileupload");
			if ($this->input->post("upload_picture")) {
                $picture = moveFile(3, $this->input->post("upload_picture"), "picture");                
				$data=array('picture' => $picture[0]);
				$this->category_model->update($this->input->post('id', TRUE), $data);
			}
            $data = array(
			'category_name' => $this->input->post('category_name',TRUE),
			'description' => $this->input->post('description',TRUE),			
			'status' => $this->input->post('status',TRUE),
	         );
            $this->category_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('admin/category'));
        }
    }
    public function delete($id)
    {
        $row = $this->category_model->get_by_id($id);
        if ($row) {
            $this->category_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('admin/category'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/category'));
        }
    }
    public function _rules()
    {
	$this->form_validation->set_rules('category_name', ' ', 'trim|required');
	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span><br/>');
    }
    function get_dtrecords() {
        $columns = array(
            0 => "category_name",
            1 => "description",
            2 => "picture",
            3 => "id",
        );
        $limit = $this->input->post("length");
        $start = $this->input->post("start");
        $order = $columns[$this->input->post("order")[0]["column"]];
        $dir = $this->input->post("order")[0]["dir"];
        $totalData = $this->category_model->tot_rows();
        $totalFiltered = $totalData;
        if (empty($this->input->post("search")["value"])) {
            $records = $this->category_model->all_rows($limit, $start, $order, $dir);
        } else {
            $search = $this->input->post("search")["value"];
            $records = $this->category_model->search_rows($limit, $start, $search, $order, $dir);
            $totalFiltered = $this->category_model->tot_search_rows($search);
        } //End of if else
        $data = array();
        if (!empty($records)) {
            $slno = 1;
            foreach ($records as $rows) {
                $category_name = $rows->category_name;
                $description = $rows->description;
                $picture = $rows->picture;
                $id = $rows->id;
                $viewBtn = anchor(site_url('admin/category/read/' . $id), 'View', array('class' => 'btn btn-primary btn-sm')) . "&nbsp;";
                $editBtn = anchor(site_url('admin/category/update/' . $id), 'Edit', array('class' => 'btn btn-sm btn-warning')) . "&nbsp;";
                $deleteBtn = anchor(site_url('admin/category/delete/' . $id), 'Delete', array('class' => 'btn btn-sm btn-danger', 'onclick' => 'return confirm(\'Are You Sure you want to delete?\')')) . "&nbsp;";
                $nestedData["slno"] = $slno++;
                $nestedData["category_name"] = $category_name;
                $nestedData["description"] = $description;
                $nestedData["picture"] = '<img src="'.base_url($picture).'" style="width:100px; height:100px" />';
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
/* End of file Category.php */
/* Location: ./application/controllers/Category.php */
