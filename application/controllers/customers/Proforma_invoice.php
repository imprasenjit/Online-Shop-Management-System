<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Proforma_invoice extends Aipl_admin
{
    function __construct()
    {
        parent::__construct();
        $this->isUserloggedin();
        $this->load->library('cart');
        $this->load->model('quotation_model');
        $this->load->model('products_model');
        $this->load->model('blogs_model');
        $this->load->model('proforma_invoice_model');
        $this->load->model('purchase_order_model');
        $this->load->library('form_validation');
    }
    public function index()
    {
        $this->view('requires/header', array('page' => 'Proforma Orders'));
        $this->view('customers/proforma_invoice/pi_list');
        $this->view('requires/footer');

    }

    public function pi_view($id)
    {
        $data = array("page" => "Proforma Order");
        $po=$this->proforma_invoice_model->get_by_id(base64_decode(urldecode($id)));
        if(empty($po)){
          $this->session->set_flashdata('flashMsg', 'Record Not Found');
          redirect(base_url("customers/proforma_invoice"));
        }
        $data=(array)$po;
        $data['purchase_order_id']=$po->purchase_order_id;
        //echo '<pre>';print_r($po);die;
		$this->view('requires/header',array("page"=>"Proforma Invoice"));
		$this->view('customers/proforma_invoice/proforma_invoice_view',$data);
		$this->view('requires/footer');
    }

    public function getProformaInvoice(){
      $customer_id=$this->session->userdata("id");

        $columns = array(

            0 => "porforma_invoice_id",
            1 => "purchase_order_date",
            2 => "created_at"
        );
        $limit = $this->input->post("length");
        $start = $this->input->post("start");
        $order = $columns[$this->input->post("order")[0]["column"]];
        $dir = $this->input->post("order")[0]["dir"];
        $totalData = $this->proforma_invoice_model->front_tot_rows($customer_id);
        $totalFiltered = $totalData;
        if (empty($this->input->post("search")["value"])) {
            $records = $this->proforma_invoice_model->front_all_rows($limit, $start, $order, $dir,$customer_id);//var_dump($records);die;
        } else {
            $search = $this->input->post("search")["value"];
            $records = $this->proforma_invoice_model->front_search_rows($limit, $start, $search, $order, $dir,$customer_id);
            $totalFiltered = $this->proforma_invoice_model->front_tot_search_rows($search,$customer_id);
        }//End of if else
        $data = array();
        if (!empty($records)) {
              $slno = 1;
            foreach ($records as $rows) {
                $viewBtn = anchor(site_url('customers/proforma_invoice/pi_view/'.urlencode(base64_encode($rows->porforma_invoice_id))), 'View', array('class' => 'btn btn-primary btn-sm')) . "&nbsp;";

                $nestedData["slno"] = $slno++;
                $nestedData["purchase_order_date"] = date_format(date_create($rows->purchase_order_date),'d M, Y');
                $nestedData["created_at"] = date_format(date_create($rows->created_at),'d M, Y');
                $nestedData["id"] = $viewBtn;
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
}
