<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Purchase_order extends Aipl_admin
{
    function __construct()
    {
        parent::__construct();
        $this->isUserloggedin();
        $this->load->library('cart');
        $this->load->library('breadcrumbs');
        $this->load->model('quotation_model');
        $this->load->model('products_model');
        $this->load->model('purchase_order_model');
        $this->load->library('form_validation');
        // $this->load->library('encryption');
    }
    public function index()
    {
        $this->load->view('requires/header', array('page' => 'Purchase Orders'));
        $this->load->view('site/customers/purchase_order/po_list');
        $this->load->view('requires/footer');
    }

    public function view($id)
    {
      $id=$this->uri->segment(4);
      $id=base64_decode(urldecode($id));
        $data = array("page" => "Purchase Order");
        $po=$this->purchase_order_model->get_by_id($id);
        if(empty($po)){
          $this->session->set_flashdata('flashMsg', 'Record Not Found');
          redirect(base_url("customers/purchase_order"));
        }
        $data=(array)$po;
        //echo '<pre>';print_r($data);die;
		$this->load->view('requires/header',array("page"=>"Purchase Orders"));
		$this->load->view('site/customers/purchase_order/purchase_order_view',$data);
		$this->load->view('requires/footer');
    }

    public function getPurchaseOrders(){
      $customer_id=$this->session->userdata("id");

      $columns = array(
          0 => "potoadmin_id",
          1 => "quotation_date",
          2 => "created_at"
      );
        $limit = $this->input->post("length");
        $start = $this->input->post("start");
        $order = $columns[$this->input->post("order")[0]["column"]];
        $dir = $this->input->post("order")[0]["dir"];
        $totalData = $this->purchase_order_model->front_tot_rows($customer_id);
        $totalFiltered = $totalData;
        if (empty($this->input->post("search")["value"])) {
            $records = $this->purchase_order_model->front_all_rows($limit, $start, $order, $dir,$customer_id);//var_dump($records);die;
        } else {
            $search = $this->input->post("search")["value"];
            $records = $this->purchase_order_model->front_search_rows($limit, $start, $search, $order, $dir,$customer_id);
            $totalFiltered = $this->purchase_order_model->front_tot_search_rows($search,$customer_id);
        }//End of if else
        $data = array();
        if (!empty($records)) {
              $slno = 1;
            foreach ($records as $rows) {
                $viewBtn = anchor(site_url('customers/purchase_order/view/' . urlencode(base64_encode($rows->potoadmin_id))), 'View', array('class' => 'btn btn-primary btn-sm')) . "&nbsp;";
                $nestedData["slno"] = $slno++;
                $nestedData["quotation_date"] = date_format(date_create($rows->quotation_date),'d M, Y');
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
