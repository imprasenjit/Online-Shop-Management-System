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
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $this->breadcrumbs->push('Dashboard','admin/dashboard');
        $this->breadcrumbs->push('Enquiry List','admin/enquires');
        $this->load->view('admin/requires/header', array('title' => 'Enquires'));
        $this->load->view('admin/enquires/enquires_list');
        $this->load->view('admin/requires/footer');
    }
   
    /**
     * enquiry_details
     *
     * @param mixed $enquiry_id
     * @return void
     */
    public function enquiry_details($enquiry_id)
    {
        $row = $this->enquires_model->get_by_id($enquiry_id);
        
        $data=array(
            "result"=>$row
        );
        $this->breadcrumbs->push('Dashboard','admin/dashboard');
        $this->breadcrumbs->push('Enquiry List','admin/enquires');
        $this->breadcrumbs->push('Enquiry Details','admin/enquires/enquiry_details/'.$enquiry_id);
        $this->load->view('admin/requires/header',array("title"=>"Enquiry Details"));
        $this->load->view('admin/enquires/enquires',$data);
        $this->load->view('admin/requires/footer');
    }
   
   /**
    * get_dtrecords
    *
    * @return void
    */
    function get_dtrecords() {
        $columns = array(
            0 => "enquiry_id",
            1 => "enq_ref",
            2 => "name",
            3 => "email",
            4 => "enquiry_placed_date",
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
                //$editBtn = anchor(site_url('admin/quotation/send_quotation/' . $rows->enquiry_id), 'Send', array('class' => 'btn btn-sm btn-warning')) . "&nbsp;";
                $nestedData["sl_no"] = $sl_no++;
                $nestedData["enq_ref"] = $rows->enq_ref;
                $nestedData["enquiry_placed_date"] = date("d-m-Y",strtotime($rows->enquiry_placed_date));
                $nestedData["name"] = $rows->name;
                $nestedData["email"] = $rows->email;
                $nestedData["enquiry_id"] = $viewBtn;
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
