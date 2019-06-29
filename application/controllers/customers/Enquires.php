<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Enquires extends Aipl_admin
{
    function __construct()
    {
        parent::__construct();
        $this->isUserloggedin();
        $this->load->library('cart');
        $this->load->model('billing_model');
        $this->load->model('quotation_model');
        $this->load->model('products_model');
        $this->load->model('blogs_model');
        $this->load->model('enquires_model');
        $this->load->model('customers_model');
        $this->load->library('form_validation');
    }
    public function index()
    {
        $this->view('requires/header', array('page' => 'Enquires'));
        $this->view('customers/enquires/enquires_list');
        $this->view('requires/footer');
    }

    public function getEnquiries(){
      $customer_id=$this->session->userdata("id");

        $columns = array(
            0 => "enq_ref",
            1 => "enquiry_placed_date	"
        );
        $limit = $this->input->post("length");
        $start = $this->input->post("start");
        $order = $columns[$this->input->post("order")[0]["column"]];
        $dir = $this->input->post("order")[0]["dir"];
        $totalData = $this->enquires_model->front_tot_rows($customer_id);
        $totalFiltered = $totalData;
        if (empty($this->input->post("search")["value"])) {
            $records = $this->enquires_model->front_all_rows($limit, $start, $order, $dir,$customer_id);
        } else {
            $search = $this->input->post("search")["value"];
            $records = $this->enquires_model->front_search_rows($limit, $start, $search, $order, $dir,$customer_id);
            $totalFiltered = $this->enquires_model->front_tot_search_rows($search,$customer_id);
        }//End of if else
        $data = array();
        if (!empty($records)) {
              $slno = 1;
            foreach ($records as $rows) {
                $id = $rows->enq_ref;
                $enquiry_placed_date = $rows->enquiry_placed_date;
                $viewBtn=anchor(site_url('customers/dashboard/enquiry_details/'.urlencode(base64_encode($rows->enquiry_id)) ), 'View', array('class' => 'btn btn-primary btn-sm')) . "&nbsp;";
                $nestedData["slno"] = $slno++;
                $nestedData["enq_ref"] = $id;
                $nestedData["enquiry_placed_date"] = date_format(date_create($enquiry_placed_date),'d M, Y');
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
