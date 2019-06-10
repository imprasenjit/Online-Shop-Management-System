<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Attribute extends Aipl_admin
{
    function __construct()
    {
        parent::__construct();
        $this->isAdminloggedin();
        $this->load->model('attribute_model');
        $this->load->model('products_model');
        $this->load->library('form_validation');
        $this->load->library('breadcrumbs');
    }

    public function index()
    {
        $this->breadcrumbs->push('Dashboard', '/admin/dashboard');
        $this->breadcrumbs->push('Attribute List', '/admin/attribute');
        $this->load->view('admin/requires/header',array('title'=>'attribute'));
        $this->load->view('admin/attribute/attribute_list');
        $this->load->view('admin/requires/footer');
    }
    public function sort()
    {
        $this->breadcrumbs->push('Dashboard', '/admin/dashboard');
        $this->breadcrumbs->push('Attribute List', '/admin/attribute');
        $this->load->view('admin/requires/header',array('title'=>'attribute'));
        $this->load->view('admin/attribute/attribute_sort');
        $this->load->view('admin/requires/footer');
    }

    public function save_attribute_order()
    {
        $choices=$this->input->post("choices");
        $master=array();
        foreach($choices as $key=>$attr_id){
        $data=array(
            "attribute_order"=>$key,
            "id"=>$attr_id
        );
        array_push($master,$data);
        //$this->attribute_model->update($attr_id,$data);
        }
        $this->db->update_batch('attribute', $master, 'id');
        
    }

    public function get_attributes()
    {
        $product_id=$this->input->post("id");
        $attributes=$this->attribute_model->get_attribute_of_product($product_id);
        foreach($attributes as $attr){
            echo '<li class="list-group-item" data-article-id="'.$attr->id.'">'.$attr->attr1.'</li>';
        }
    }
    public function read($id)
    {
        $row = $this->attribute_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		//'size' => $row->size,
		'attr1' => $row->attr1,
		'attr2' => $row->attr2,
		'attr3' => $row->attr3,
		'attr4' => $row->attr4,
		'attr5' => $row->attr5,
		'attr6' => $row->attr6,
		'attr7' => $row->attr7,
		'product_id' => $row->product_id,
	    );
		$this->load->view('admin/requires/header',array('title'=>'attribute'));
            $this->load->view('admin/attribute/attribute_read', $data);
                $this->load->view('admin/requires/footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/attribute'));
        }
    }

    public function create()
    {
        $this->breadcrumbs->push('Dashboard', '/admin/dashboard');
        $this->breadcrumbs->push('Attribute List', '/admin/attribute');
        $this->breadcrumbs->push('Create Attribute', '/admin/attribute/create');
		$data = array(
            'button' => 'Create',
            'action' => site_url('admin/attribute/create_action'),
			'id' => set_value('id'),
			//'size' => set_value('size'),
			'attr1' => set_value('attr1'),
			'attr2' => set_value('attr2'),
			'attr3' => set_value('attr3'),
			'attr4' => set_value('attr4'),
			'attr5' => set_value('attr5'),
			'attr6' => set_value('attr6'),
			'attr7' => set_value('attr7'),
			'product_id' => $this->products_model->get_all(),
		);
    $this->breadcrumbs->push('Dashboard', '/admin/dashboard');
    $this->breadcrumbs->push('Attribute List', '/admin/attribute');
    $this->breadcrumbs->push('Add Attribute', '/admin/attribute/create');

		$this->load->view('admin/requires/header',array('title'=>'attribute'));
		$this->load->view('admin/attribute/attribute_form', $data);
		$this->load->view('admin/requires/footer');
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
			'product_id' => $this->input->post('product_id',TRUE),
			'attr1' => $this->input->post('attributes1',TRUE),
			'attr2' => $this->input->post('attributes2',TRUE),
			'attr3' => $this->input->post('attributes3',TRUE),
			'attr4' => $this->input->post('attributes4',TRUE),
			'attr5' => $this->input->post('attributes5',TRUE),
			'attr6' => $this->input->post('attributes6',TRUE),
			'attr7' => $this->input->post('attributes7',TRUE),
            );
		     $this->attribute_model->insert($data);
            $this->session->set_flashdata('message', 'Attribute Added Successfully');
            redirect(site_url('admin/attribute'));
        }
    }

    public function update($id)
    {
        $this->breadcrumbs->push('Dashboard', '/admin/dashboard');
        $this->breadcrumbs->push('Attribute List', '/admin/attribute');
        $this->breadcrumbs->push('Update Attribute', '/admin/attribute/update');
        $row = $this->attribute_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('admin/attribute/update_action'),
				'id' => set_value('id', $row->id),
				//'size' => set_value('size', $row->size),
				'attr1' => set_value('attr1', $row->attr1),
				'attr2' => set_value('attr2', $row->attr2),
				'attr3' => set_value('attr3', $row->attr3),
				'attr4' => set_value('attr4', $row->attr4),
				'attr5' => set_value('attr5', $row->attr5),
				'attr6' => set_value('attr6', $row->attr6),
				'attr7' => set_value('attr2', $row->attr7),
				//'product_id' => set_value('product_id', $row->product_id),
				'product_id' => $this->products_model->get_all(),
	    );
            //$this->load->view('attribute/attribute_form', $data);
		$this->load->view('admin/requires/header',array('title'=>'attribute'));
		$this->load->view('admin/attribute/attribute_form', $data);
		$this->load->view('admin/requires/footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/attribute'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
			//'size' => $this->input->post('size',TRUE),
			'product_id' => $this->input->post('product_id',TRUE),
			'attr1' => $this->input->post('attributes1',TRUE),
			'attr2' => $this->input->post('attributes2',TRUE),
			'attr3' => $this->input->post('attributes3',TRUE),
			'attr4' => $this->input->post('attributes4',TRUE),
			'attr5' => $this->input->post('attributes5',TRUE),
			'attr6' => $this->input->post('attributes6',TRUE),
			'attr7' => $this->input->post('attributes7',TRUE),

	    );

            $this->attribute_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Attribute Updated Successfully');
            redirect(site_url('admin/attribute'));
        }
    }

    public function delete($id)
    {
        $row = $this->attribute_model->get_by_id($id);

        if ($row) {
            $this->attribute_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('admin/attribute'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/attribute'));
        }
    }

    public function _rules()
    {
	$this->form_validation->set_rules('attr1', ' ', 'trim');
	$this->form_validation->set_rules('attr2', ' ', 'trim');
	$this->form_validation->set_rules('product_id', ' ', 'trim');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }


	function getAttributesDetails($id) {
        $this->load->model("attribute_model");
        $result=$this->products_model->get_by_id($id);
        echo json_encode($result->attributes);
    }

    function get_attribute_for_order(){
        $id=$this->input->post("product",TRUE);
        $this->load->model("attribute_model");
        $result=$this->products_model->get_by_id($id);
        $data=array(
            "results"=>$result
        );
        $this->load->view('admin/attribute/product_attributes', $data);
    }

    function get_dtrecords() {
        $columns = array(
            0 => "product_id",
            1 => "attr1",
            2 => "attr1",
            3 => "id",
        );
        $product_id = $this->input->post("product");
        $limit = $this->input->post("length");
        $start = $this->input->post("start");
        $slno = $start+1;
        $order = $columns[$this->input->post("order")[0]["column"]];
        $dir = $this->input->post("order")[0]["dir"];
        if(!empty($product_id)){
            $totalData = $this->attribute_model->tot_rows($product_id);
            $totalFiltered = $totalData;
            if (empty($this->input->post("search")["value"])) {
                $records = $this->attribute_model->all_rows($limit, $start, $order, $dir,$product_id);
            } else {
                $search = $this->input->post("search")["value"];
                $records = $this->attribute_model->search_rows($limit, $start, $search, $order, $dir,$product_id);
                $totalFiltered = $this->attribute_model->tot_search_rows($search,$product_id);
            } //End of if else
        }else{
            $totalData = $this->attribute_model->tot_rows();
            $totalFiltered = $totalData;
            if (empty($this->input->post("search")["value"])) {
                $records = $this->attribute_model->all_rows($limit, $start, $order, $dir);
            } else {
                $search = $this->input->post("search")["value"];
                $records = $this->attribute_model->search_rows($limit, $start, $search, $order, $dir);
                $totalFiltered = $this->attribute_model->tot_search_rows($search);
            } //End of if else
        }

        $data = array();
        if (!empty($records)) {
            
            foreach ($records as $rows) {
                $productRow=$this->products_model->get_by_id($rows->product_id);
                $product_name=$productRow?$productRow->product_name:"Not found";
                $attr1 = $rows->attr1;
                $attr2 = $rows->attr2;
                $id = $rows->id;

                $viewBtn = anchor(site_url('admin/attribute/read/' . $id), 'View', array('class' => 'btn btn-primary btn-sm')) . "&nbsp;";
                $editBtn = anchor(site_url('admin/attribute/update/' . $id), 'Edit', array('class' => 'btn btn-sm btn-warning')) . "&nbsp;";
                $deleteBtn = anchor(site_url('admin/attribute/delete/' . $id), 'Delete', array('class' => 'btn btn-sm btn-danger', 'onclick' => 'return confirm(\'Are You Sure you want to delete?\')')) . "&nbsp;";
                $nestedData["slno"] = $slno++;
                $nestedData["product_id"] = $product_name;
                $nestedData["attr1"] = $attr1;
                $nestedData["attr2"] = $attr2;
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

/* End of file Attribute.php */
/* Location: ./application/controllers/Attribute.php */
