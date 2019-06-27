<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Products extends Aipl_admin {

    function __construct() {
        parent::__construct();
        $this->isAdminloggedin();
        $this->load->library('cart');
        $this->load->model('products_model');
        $this->load->model('attribute_model');
        $this->load->model('category_model');
        $this->load->library('form_validation');
        $this->load->helper("fileupload");
        $this->load->model('sub_category_model');
        $this->load->library('breadcrumbs');
    }

    public function index() {

        $this->breadcrumbs->push('Dashboard', '/admin/dashboard');
        $this->breadcrumbs->push('Product List', '/admin/products');
        $this->load->view('admin/requires/header', array('title' => 'products'));
        $this->load->view('admin/products/products_list');
        $this->load->view('admin/requires/footer');
    }

    public function read($id) {
        $row = $this->products_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id' => $row->id,
                'product_name' => $row->product_name,
                'product_category' => $this->category_model->get_by_id($row->product_category)->category_name,
                'product_sub_category' => $this->sub_category_model->get_by_id($row->product_sub_category)->sub_category,
                'description' => $row->description,
                'weight_chart' => $row->weight_chart,
                'tax_rate' => $row->tax_rate,
                'hsn_code' => $row->hsn_code,
                'picture' => $row->picture,
                'specification' => $row->specification,
                'status' => $row->status,
            );
            if($row->attributes){
              $att_data=json_decode($row->attributes)->data;
              $stringValue="";
              foreach ($att_data as $key => $value) {
                $stringValue .= $value;
                if(count($att_data) != $key+1)
                $stringValue .=",";
              }
              $data['attributes']=$stringValue;
            }else {
              $data['attributes']="";
            }
            $this->load->view('admin/requires/header', array('title' => 'products'));
            $this->load->view('admin/products/products_read', $data);
            $this->load->view('admin/requires/footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/products'));
        }
    }

    public function get_product_tax_rate() {
        $id = $this->input->post("product", TRUE);
        $result = $this->products_model->get_by_id($id);
        echo json_encode(array("tax_rate" => (int) $result->tax_rate));
    }

    public function create() {
        $data = array(
            'button' => 'Create',
            'action' => site_url('admin/products/create_action'),
            'id' => set_value('id'),
            'product_name' => set_value('product_name'),
            'product_category' => set_value('product_category'),
            'product_sub_category' => set_value('product_sub_category'),
            'description' => set_value('description'),
            'weight_chart' => set_value('weight_chart'),
            'specification' => set_value('specification'),
            'attributes' => set_value('attributes', NULL),
            'picture' => set_value('picture'),
            'tax_rate' => set_value('tax_rate'),
            'hsn_code' => set_value('hsn_code'),
            'status' => set_value('status'),
        );
        //var_dump($data); die();
        $this->breadcrumbs->push('Dashboard', '/admin/dashboard');
        $this->breadcrumbs->push('Product List', '/admin/products');
        $this->breadcrumbs->push('Add Product', '/admin/products/create');

        $this->load->view('admin/requires/header', array('title' => 'products'));
        $this->load->view('admin/products/products_form', $data);
        $this->load->view('admin/requires/footer');
    }

    public function create_action() {
        $this->_rules();
        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            if ($this->input->post("upload_picture")) {
                $picture = moveFile(3, $this->input->post("upload_picture"), "picture");
                $specification = moveFile(3, $this->input->post("upload_specification"), "specification");
            }
            $data = array(
                'product_name' => $this->input->post('product_name', TRUE),
                'product_category' => $this->input->post('product_category', TRUE),
                'product_sub_category' => $this->input->post('product_sub_category', TRUE),
                'description' => $this->input->post('description', TRUE),
                'weight_chart' => $this->input->post('weight_chart'),
                'tax_rate' => $this->input->post('tax_rate', TRUE),
                'hsn_code' => $this->input->post('hsn_code', TRUE),
                'show_description' => !empty($this->input->post('show_description',TRUE))?$this->input->post('show_description',TRUE):"0",
                'show_weight_chart' => !empty($this->input->post('show_weight_chart',TRUE))?$this->input->post('show_weight_chart',TRUE):"0",
                'specification' => $specification[0],
                'attributes' => json_encode(array("data" => $this->input->post('attributes', TRUE))),
                'picture' => $picture[0],
            );
            $this->products_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('admin/products'));
        }
    }

    public function update($id) {
        $row = $this->products_model->get_by_id($id);
        $this->breadcrumbs->push('Dashboard', '/admin/dashboard');
        $this->breadcrumbs->push('Product List', '/admin/products');
        $this->breadcrumbs->push('Update Product', '/admin/products/update');
        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('admin/products/update_action'),
                'id' => set_value('id', $row->id),
                'product_name' => set_value('product_name', $row->product_name),
                'product_category' => set_value('product_category', $row->product_category),
                'product_sub_category' => set_value('product_sub_category', $row->product_sub_category),
                'description' => set_value('description', $row->description),
                'show_description' => set_value('show_description', $row->show_description),
                'weight_chart' => set_value('weight_chart',$row->weight_chart),
                'show_weight_chart' => set_value('show_weight_chart',$row->show_weight_chart),
                'tax_rate' => set_value('tax_rate', $row->tax_rate),
                'hsn_code' => set_value('hsn_code', $row->hsn_code),
                'specification' => set_value('specification', $row->specification),
                'picture' => set_value('picture', $row->picture),
                'attributes' => set_value('attributes', $row->attributes),
                'status' => set_value('status', $row->status),
            );
            $this->load->view('admin/requires/header', array('title' => 'products'));
            $this->load->view('admin/products/products_form', $data);
            $this->load->view('admin/requires/footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/products'));
        }
    }

    public function update_action() {
        $this->_rules();
        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            if ($this->input->post("upload_picture")) {
                $picture = moveFile(3, $this->input->post("upload_picture"), "picture");
                $data = array('picture' => $picture[0]);
                $this->products_model->update($this->input->post('id', TRUE), $data);
            }
            if ($this->input->post("upload_specification")) {
                $specification = moveFile(3, $this->input->post("upload_specification"), "specification");
                $data = array('specification' => $specification[0]);
                $this->products_model->update($this->input->post('id', TRUE), $data);
            }
            $data = array(
                'product_name' => $this->input->post('product_name', TRUE),
                'product_category' => $this->input->post('product_category', TRUE),
                'product_sub_category' => $this->input->post('product_sub_category', TRUE),
                'description' => $this->input->post('description', TRUE),
                'weight_chart' => $this->input->post('weight_chart'),
                'show_description' => !empty($this->input->post('show_description',TRUE))?$this->input->post('show_description',TRUE):"0",
                'show_weight_chart' => !empty($this->input->post('show_weight_chart',TRUE))?$this->input->post('show_weight_chart',TRUE):"0",
                'tax_rate' => $this->input->post('tax_rate', TRUE),
                'hsn_code' => $this->input->post('hsn_code', TRUE),
                'attributes' => json_encode(array("data" => $this->input->post('attributes', TRUE))),
                'status' => $this->input->post('status', TRUE),
            );
            //$attributes = array($this->input->post('attributes'));
            //$data['attributes'] = json_encode($attributes);
            $this->products_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('admin/products'));
        }
    }

    public function delete($id) {
        $row = $this->products_model->get_by_id($id);
        if ($row) {
            $this->products_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('admin/products'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/products'));
        }
    }

    public function _rules() {
        $this->form_validation->set_rules('product_name', ' ', 'trim');
        $this->form_validation->set_rules('product_unit', ' ', 'trim');
        $this->form_validation->set_rules('product_price', ' ', 'trim');
        $this->form_validation->set_rules('status', ' ', 'trim');
        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel() {
        $this->load->helper('exportexcel');
        $namaFile = "products.xls";
        $judul = "products";
        $tablehead = 2;
        $tablebody = 3;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");
        xlsBOF();
        xlsWriteLabel(0, 0, $judul);
        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "no");
        xlsWriteLabel($tablehead, $kolomhead++, "product_name");
        xlsWriteLabel($tablehead, $kolomhead++, "product_unit");
        xlsWriteLabel($tablehead, $kolomhead++, "product_price");
        xlsWriteLabel($tablehead, $kolomhead++, "status");
        foreach ($this->products_model->get_all() as $data) {
            $kolombody = 0;
            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->product_name);
            xlsWriteLabel($tablebody, $kolombody++, $data->product_unit);
            xlsWriteLabel($tablebody, $kolombody++, $data->product_price);
            xlsWriteLabel($tablebody, $kolombody++, $data->status);
            $tablebody++;
            $nourut++;
        }
        xlsEOF();
        exit();
    }

    function get_sub_category($id = NULL) {
        if ($id == NULL) {
            $id = $this->input->post("id");
        }
        $qry = $this->db->query("SELECT * FROM product_sub_category WHERE category = '$id'");
        if ($qry->num_rows() > 0) {
            echo '<option value="">Select Sub-Category</option>';
            foreach ($qry->result() as $row) {
                echo '<option value="' . $row->id . '">' . $row->sub_category . '</option>';
            }
        }
    }

    function get_dtrecords() {
        $columns = array(
            0 => "product_id",
            0 => "product_name",
            1 => "description",
            2 => "picture",
            3 => "id",
        );
        $limit = $this->input->post("length");
        $start = $this->input->post("start");
        $sl_no=$start+1;
        $order = $columns[$this->input->post("order")[0]["column"]];
        $dir = $this->input->post("order")[0]["dir"];
        $totalData = $this->products_model->tot_rows();
        $totalFiltered = $totalData;
        if (empty($this->input->post("search")["value"])) {
            $records = $this->products_model->all_rows($limit, $start, $order, $dir);
        } else {
            $search = $this->input->post("search")["value"];
            $records = $this->products_model->search_rows($limit, $start, $search, $order, $dir);
            $totalFiltered = $this->products_model->tot_search_rows($search);
        }//End of if else
        $data = array();
        if (!empty($records)) {

            foreach ($records as $rows) {
                $product_name = $rows->product_name;
                $description = $rows->description;
                $picture = $rows->picture;
                $id = $rows->id;

                $viewBtn = anchor(site_url('admin/products/read/' . $id), 'View', array('class' => 'btn btn-sm btn-primary')) . "&nbsp;";
                $editBtn = anchor(site_url('admin/products/update/' . $id), 'Edit', array('class' => 'btn btn-sm btn-warning')) . "&nbsp;";
                $deleteBtn = anchor(site_url('admin/products/delete/' . $id), 'Delete', array('class' => 'btn btn-sm btn-danger', 'onclick' => 'return confirm(\'Are You Sure you want to delete?\')')) . "&nbsp;";

                $nestedData["sl_no"] = $sl_no++;
                $nestedData["product_name"] = $product_name;
                $nestedData["description"] = $description;
                $nestedData["picture"] = '<img src="'.base_url($picture).'" style="width:80px;height:50px;">';
                $nestedData["id"] = $viewBtn.$editBtn.$deleteBtn;
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
    }//End of get_dtrecords()

}
