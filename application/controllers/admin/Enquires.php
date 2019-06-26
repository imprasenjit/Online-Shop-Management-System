<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Enquires extends Aipl_admin
{
    function __construct()
    {
        parent::__construct();
        $this->isAdminloggedin();
        $this->load->model('enquires_model');
        $this->load->model('products_model');
        $this->load->model('customers_model');
        $this->load->model('billing_model');
        $this->load->model("quotation_model");
        $this->load->library('form_validation');
        $this->load->library('breadcrumbs');
        $this->load->model('settings_model');
    }
    public function index()
    {
        $this->breadcrumbs->push('Dashboard','admin/dashboard');
        $this->breadcrumbs->push('Enquiry List','admin/enquires');
        $this->load->view('admin/requires/header', array('title' => 'Enquires'));
        $this->load->view('admin/enquires/enquires_list');
        $this->load->view('admin/requires/footer');
    }
    public function read($id)
    {
        $row = $this->enquires_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id' => $row->id,
                'order_date' => $row->order_date,
                'orderid' => $row->orderid,
                'productid' => $row->productid,
                'quantity' => $row->quantity,
                'price' => $row->price,
            );
            $this->load->view('admin/requires/header', array('title' => 'enquires'));
            $this->load->view('admin/enquires/enquires_read', $data);
            $this->load->view('admin/requires/footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/enquires'));
        }
    }
    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('admin/enquires/create_action'),
            'id' => set_value('id'),
            'orderid' => set_value('orderid'),
            'productid' => set_value('productid'),
            'quantity' => set_value('quantity'),
            'price' => set_value('price'),
        );
        $this->load->view('admin/requires/header', array('title' => 'enquires'));
        $this->load->view('admin/enquires/enquires_form', $data);
        $this->load->view('admin/requires/footer');
    }
    public function create_action()
    {
        $this->_rules();
        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'orderid' => $this->input->post('orderid', TRUE),
                'productid' => $this->input->post('productid', TRUE),
                'quantity' => $this->input->post('quantity', TRUE),
                'price' => $this->input->post('price', TRUE),
            );
            $this->enquires_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('admin/enquires'));
        }
    }
    public function save_order()
    {
        $customer = array(
            'enquiry_placed_date' => date("Y-m-d H:i:s"),
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'address' => $this->input->post('address'),
            'contact' => $this->input->post('contact')
        );
        $ord_id = $this->billing_model->insert_customer($customer);
        $name = $this->input->post('name', true);
        $price = $this->input->post('price', true);
        $qty = $this->input->post('qty', true);
        foreach ($ord_id as $i => $ord_id) {
            $order_detail = array(
                'orderid' => $ord_id,
                'productid' => $item['name'],
                'price' => $item['price'],
                'quantity' => $item['qty']
            );
            $cust_id = $this->billing_model->insert_order_detail($order_detail);
        }
        //}
        $this->load->view('admin/requires/header');
        $this->load->view('admin/enquires');
        $this->load->view('admin/requires/footer');
    }
    public function update($id)
    {
        $row = $this->enquires_model->get_by_id($id);
        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('admin/enquires/update_action'),
                'id' => set_value('id', $row->id),
                'orderid' => set_value('orderid', $row->orderid),
                'productid' => set_value('productid', $row->productid),
                'quantity' => set_value('quantity', $row->quantity),
                'price' => set_value('price', $row->price),
            );
            $this->load->view('admin/requires/header', array('title' => 'enquires'));
            $this->load->view('admin/enquires/enquires_form', $data);
            $this->load->view('admin/requires/footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/enquires'));
        }
    }
    public function update_action()
    {
        $this->_rules();
        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
                'order_date' => $this->input->post('order_date', TRUE),
                'orderid' => $this->input->post('orderid', TRUE),
                'productid' => $this->input->post('productid', TRUE),
                'quantity' => $this->input->post('quantity', TRUE),
                'price' => $this->input->post('price', TRUE),
            );
            $this->enquires_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('admin/enquires'));
        }
    }
    public function delete($id)
    {
        $row = $this->enquires_model->get_by_id($id);
        if ($row) {
            $this->enquires_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('admin/enquires'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/enquires'));
        }
    }
    public function enquiry_details($enquiry_id)
    {
        $row = $this->enquires_model->get_by_id($enquiry_id);
        //$id=$this->generate_unique_id("ENQ",$enquiry_id,$row->enquiry_placed_date);
        $data=array(
            "result"=>$row
        );
        $this->breadcrumbs->push('Dashboard','admin/dashboard');
        $this->breadcrumbs->push('Enquiry List','admin/enquires');
        $this->breadcrumbs->push('Enquiry Details','admin/enquiresenquiry_details/'.$enquiry_id);
        $this->load->view('admin/requires/header',array("title"=>"Enquiry Details"));
        $this->load->view('admin/enquires/enquires',$data);
        $this->load->view('admin/requires/footer');
    }
    public function _rules()
    {
        $this->form_validation->set_rules('order_date', ' ', 'trim');
        $this->form_validation->set_rules('orderid', ' ', 'trim');
        $this->form_validation->set_rules('productid', ' ', 'trim');
        $this->form_validation->set_rules('quantity', ' ', 'trim');
        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "enquires.xls";
        $judul = "enquires";
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
        xlsWriteLabel($tablehead, $kolomhead++, "order_date");
        xlsWriteLabel($tablehead, $kolomhead++, "orderid");
        xlsWriteLabel($tablehead, $kolomhead++, "productid");
        xlsWriteLabel($tablehead, $kolomhead++, "quantity");
        foreach ($this->enquires_model->get_all() as $data) {
            $kolombody = 0;
            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->order_date);
            xlsWriteLabel($tablebody, $kolombody++, $data->orderid);
            xlsWriteLabel($tablebody, $kolombody++, $data->productid);
            xlsWriteNumber($tablebody, $kolombody++, $data->quantity);
            $tablebody++;
            $nourut++;
        }
        xlsEOF();
        exit();
    }
    function get_dtrecords() {
        $columns = array(
            0 => "enquiry_id",
            1 => "enquiry_placed_date",
            2 => "name",
            3 => "email",
            4 => "unique_id",
        );
        $limit = $this->input->post("length");
        $start = $this->input->post("start");
        $sl_no=$start+1;
        $order = $columns[$this->input->post("order")[0]["column"]];
        $dir = $this->input->post("order")[0]["dir"];
        $totalData = $this->enquires_model->tot_rows();
        $totalFiltered = $totalData;
        if (empty($this->input->post("search")["value"])) {
            $records = $this->enquires_model->all_rows($limit, $start, $order, $dir);
        } else {
            $search = $this->input->post("search")["value"];
            $records = $this->enquires_model->search_rows($limit, $start, $search, $order, $dir);
            $totalFiltered = $this->enquires_model->tot_search_rows($search);
        }//End of if else
        $data = array();
        if (!empty($records)) {
            foreach ($records as $rows) {
                $viewBtn = anchor(site_url('admin/enquires/enquiry_details/' . $rows->enquiry_id), 'View', array('class' => 'btn btn-sm btn-primary')) . "&nbsp;";
                $editBtn = anchor(site_url('admin/quotation/send_quotation/' . $rows->enquiry_id), 'Send', array('class' => 'btn btn-sm btn-warning')) . "&nbsp;";
                $nestedData["sl_no"] = $sl_no++;
                $nestedData["unique_id"] = $rows->unique_id;
                $nestedData["enquiry_placed_date"] = date("d-m-Y",strtotime($rows->enquiry_placed_date));
                $nestedData["name"] = $rows->name;
                $nestedData["email"] = $rows->email;
                $nestedData["enquiry_id"] = $viewBtn.$editBtn;
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
