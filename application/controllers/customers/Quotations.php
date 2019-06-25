<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Quotations extends Aipl_admin
{
    function __construct()
    {
        parent::__construct();
        $this->isUserloggedin();
        $this->load->library('cart');
        $this->load->model('billing_model');
        $this->load->model('quotation_model');
        $this->load->model('purchase_order_model');
        $this->load->model('products_model');
        $this->load->model('quotation_model');
        $this->load->model('customers_model');
        $this->load->library('form_validation');
    }
    public function index()
    {
        $this->load->view('site/requires/header', array('page' => 'Quotation'));
        $this->load->view('site/customers/quotation/quotation_list');
        $this->load->view('site/requires/footer');
    }

    public function getQuatations(){
      $customer_id=$this->session->userdata("id");

        $columns = array(
            0 => "unique_id",
            1 => "quotation_date",
            2 => "quotation_id",
        );
        $limit = $this->input->post("length");
        $start = $this->input->post("start");
        $order = $columns[$this->input->post("order")[0]["column"]];
        $dir = $this->input->post("order")[0]["dir"];
        $totalData = $this->quotation_model->front_tot_rows($customer_id);
        $totalFiltered = $totalData;
        if (empty($this->input->post("search")["value"])) {
            $records = $this->quotation_model->front_all_rows($limit, $start, $order, $dir,$customer_id);//var_dump($records);die;
        } else {
            $search = $this->input->post("search")["value"];
            $records = $this->quotation_model->front_search_rows($limit, $start, $search, $order, $dir,$customer_id);
            $totalFiltered = $this->quotation_model->front_tot_search_rows($search,$customer_id);
        }//End of if else
        $data = array();
        if (!empty($records)) {
              $slno = 1;
            foreach ($records as $rows) {
                $unique_id = $rows->unique_id;
                $quotation_id = $rows->quotation_id;
                $quotation_date = $rows->quotation_date;

                $results_purchase_order = $this->purchase_order_model->check_purchase_order($quotation_id);
                $viewBtn = anchor(site_url('customers/dashboard/quoted_price_details/'.urlencode(base64_encode($quotation_id))), 'View', array('class' => 'btn btn-primary btn-sm')) . "&nbsp;";
                if(!$results_purchase_order){
                // $sendPoBtn = anchor(site_url("customers/dashboard/send_purchase_order/".urlencode(base64_encode($quotation_id)) ), 'Sent PO', array('class' => 'btn btn-warning btn-sm')) . "&nbsp;";
                $sendPoBtn = "";
                }else {
                $sendPoBtn="<button type='button' disabled class='btn btn-outline-primary btn-sm'>Purchase Order Sent</button>";
                }


                $nestedData["slno"] = $slno++;
                $nestedData["unique_id"] = $unique_id;
                $nestedData["quotation_id"] = $quotation_id;
                $nestedData["quotation_date"] = date_format(date_create($quotation_date),'d M, Y');
                $nestedData["id"] = $viewBtn.$sendPoBtn;
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
