<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Products1 extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
		$this->load->library('cart');
        $this->load->model('products_model');
        $this->load->model('byproducts_model');
        $this->load->model('sub_category_model');
        $this->load->model('category_model');
        $this->load->model('attribute_model');
        $this->load->model('blogs_model');
        $this->load->library('form_validation');
		$this->load->helper('form');
    }
    public function index()
    {
        $products = $this->byproducts_model->index_limit(10);
        $data = array(
            'products_data' => $products,
        );
        $this->load->view('site/theme1/requires/new_header',array('page'=>'Products'));
        $this->load->view('site/theme1/products/products_list', $data);
        $this->load->view('site/theme1/requires/new_footer');
	}

	public function product_view($id){
	        $data=array(
			'product'=>$this->byproducts_model->get_by_id($id)
			);
			$this->load->view('site/requires/header',array('page'=>'product'));
			$this->load->view('site/product_view', $data);
			$this->load->view('site/requires/footer');
		}


	public function steel()
    {
		$products = $this->byproducts_model->get_all();
		$data = array(
            'products_data' => $products,
            'category'=>'Steel'
        );
        $this->load->view('site/requires/header',array('title'=>'product'));
		$this->load->view('site/products/products_list', $data);
		$this->load->view('site/requires/footer');
    }

	public function category($category)
    {
		$products = $this->byproducts_model->get_all_by_subcategory($category);
        $data = array(
            'products_data' => $products,
        );
        $this->load->view('site/requires/header',array('page'=>'Products'));
        $this->load->view('site/products/products_list', $data);
        $this->load->view('site/requires/footer');
    }

    public function subcategory()
    {

        $sub_categories = $this->sub_category_model->get_all();
        $data = array(
            'subcategory_list' => $sub_categories,
        );
        $this->load->view('site/theme1/requires/new_header',array('page'=>'Products'));
        $this->load->view('site/theme1/category_list', $data);
        $this->load->view('site/theme1/requires/new_footer');
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('products/create_action'),
			'id' => set_value('id'),
			'product_name' => set_value('product_name'),
			'product_category' => set_value('product_category'),
			'product_sub_category' => set_value('product_sub_category'),
			'description' => set_value('description'),
			//'product_len' => set_value('product_len'),
			'product_price' => set_value('product_price'),
			'picture' => set_value('picture'),
			'status' => set_value('status'),
		);
        $this->load->view('site/requires/header',array('title'=>'products'));
        $this->load->view('site/products/products_form', $data);
        $this->load->view('site/requires/footer');
    }
    public function create_action()
    {
        $this->_rules();
        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'product_name' => $this->input->post('product_name',TRUE),
		'product_category' => $this->input->post('product_category',TRUE),
		'product_sub_category' => $this->input->post('product_sub_category',TRUE),
		'description' => $this->input->post('description',TRUE),
		//'product_len' => $this->input->post('product_len',TRUE),
		'product_price' => $this->input->post('product_price',TRUE),
		'picture' => $this->input->post('picture',TRUE),
		'status' => $this->input->post('status',TRUE),
	    );
            $this->byproducts_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('products'));
        }
    }
    public function update($id)
    {
        $row = $this->byproducts_model->get_by_id($id);
        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('products/update_action'),
		'id' => set_value('id', $row->id),
		'product_name' => set_value('product_name', $row->product_name),
		'product_category' => set_value('product_category', $row->product_category),
		'product_sub_category' => set_value('product_sub_category', $row->product_sub_category),
		'description' => set_value('description', $row->description),
		//'product_len' => set_value('product_len', $row->product_len),
		'product_price' => set_value('product_price', $row->product_price),
		'picture' => set_value('picture', $row->picture),
		'status' => set_value('status', $row->status),
	    );
            $this->load->view('site/products/products_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('products'));
        }
    }
    public function update_action()
    {
        $this->_rules();
        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'product_name' => $this->input->post('product_name',TRUE),
		'product_category' => $this->input->post('product_category',TRUE),
		'product_sub_category' => $this->input->post('product_sub_category',TRUE),
		'description' => $this->input->post('description',TRUE),
		//'product_len' => $this->input->post('product_len',TRUE),
		'product_price' => $this->input->post('product_price',TRUE),
		'picture' => $this->input->post('picture',TRUE),
		'status' => $this->input->post('status',TRUE),
	    );
            $this->byproducts_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('products'));
        }
    }
    public function delete($id)
    {
        $row = $this->byproducts_model->get_by_id($id);
        if ($row) {
            $this->byproducts_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('products'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('products'));
        }
    }
    public function _rules()
    {
	$this->form_validation->set_rules('product_name', ' ', 'trim');
	$this->form_validation->set_rules('product_category', ' ', 'trim');
	$this->form_validation->set_rules('product_sub_category', ' ', 'trim');
	$this->form_validation->set_rules('description', ' ', 'trim');

	$this->form_validation->set_rules('product_price', ' ', 'trim');
	$this->form_validation->set_rules('picture', ' ', 'trim');
	$this->form_validation->set_rules('status', ' ', 'trim');
	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
};
