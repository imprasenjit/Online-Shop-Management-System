<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Dashboard extends Aipl_admin
{
	public function __construct()
	{
		parent::__construct();
		$this->isUserloggedin();
		$this->load->library('cart');
		$this->load->library('breadcrumbs');
		$this->load->model('billing_model');
		$this->load->model('quotation_model');
		$this->load->model('purchase_order_model');
		$this->load->model('products_model');
		$this->load->model('enquires_model');
		$this->load->model('customers_model');
		$this->load->helper('form');
	}
	public function index()
	{

		$data = array("page" => "Dashboard");
		$this->load->view('requires/header', $data);
		$this->load->view('site/customers/dashboard/customer_dashboard');
		$this->load->view('requires/footer');
	}
	public function customer_dashboard()
	{
		$data = array("page" => "Dashboard");
		$this->load->view('requires/header', $data);
		$this->load->view('site/customers/customer_dashboard');
		$this->load->view('requires/footer');
	}
	public function enquiry_details()
	{

		$this->breadcrumbs->push('Dashboard', '/customers/dashboard');
		$this->breadcrumbs->push('Enquires View', '/enquires');
		$this->load->view('requires/header', array("page" => "Enquiry"));
		$this->load->view('site/customers/enquires/enquires_view');
		$this->load->view('requires/footer');
	}
	public function quoted_price_details()
	{
		$this->load->view('requires/header', array("page" => "View Quotation"));
		$this->load->view('site/customers/quotation/quoted_price_details');
		$this->load->view('requires/footer');
	}
	public function send_purchase_order($quotation_id)
	{
		$this->load->model('attribute_model');
		$this->load->view('requires/header', array("page" => "Purchase order"));
		$this->load->view('site/customers/purchase_order/send_purchase_order', array("quotation_id" => $quotation_id));
		$this->load->view('requires/footer');
	}
	public function send_po()
	{
		//echo '<pre>';print_r($this->input->post());die;
		$this->_rules();
		if ($this->form_validation->run() == FALSE) {
			$this->send_purchase_order($this->input->post("quotation_id", TRUE));
		} else {
			$temp_array = array();
			$product_attributes = $this->input->post('product_attr',TRUE);
			$product_ids=$this->input->post("product_id", TRUE);
			foreach ($product_attributes as $mykey=>$value) {
				$attributes=explode(",",$value);
				$final_attr=array_filter($attributes,function($value) { return $value !== ''; });
				array_push($temp_array,array($product_ids[$mykey]=>$final_attr));
			}
			$data = array(
				"customer_id" => $this->session->userdata("id"),
				"quotation_id" => $this->input->post("quotation_id", TRUE),
				"billing_address" => $this->input->post("billing_address", TRUE),
				"billing_state" => $this->input->post("billing_state", TRUE),
				"delivery_address" => $this->input->post("delivery_address", TRUE),
				"contact_person_name" => $this->input->post("contact_person_name", TRUE),
				"contact_person_mobile" => $this->input->post("contact_person_mobile", TRUE),
				"product" => json_encode($this->input->post("product_id", TRUE)),
				"quantity" => json_encode($this->input->post("quantity", TRUE)),
				"attributes" => json_encode($temp_array),
				"others" => json_encode($this->input->post("others", TRUE)),
				"unit" => json_encode($this->input->post("product_unit", TRUE)),
				"price" => json_encode($this->input->post("product_price", TRUE)),
				"tax_rate" => json_encode($this->input->post("tax_rate", TRUE)),
				"cgst" => json_encode($this->input->post("cgst", TRUE)),
				"sgst" => json_encode($this->input->post("sgst", TRUE)),
				"igst" => json_encode($this->input->post("igst", TRUE)),
				"exyard" => json_encode($this->input->post("exyard", TRUE)),
				"frieght" => json_encode($this->input->post("frieght", TRUE)),
				"total" => json_encode($this->input->post("total_price", TRUE)),
				"created_at" => date("Y-m-d H:i:s"),
				"created_by" => $this->session->userdata("id")
			);
			$this->customers_model->save_purchase_order($data);
			$this->session->set_flashdata('message', 'Purchase order sent successfully!');
			redirect(site_url('customers/dashboard/'));
		}
	}
	public function _rules()
	{
		$this->load->library("form_validation");
		$this->form_validation->set_rules('product_id[]', 'Products', 'trim|required');
		$this->form_validation->set_rules('quantity[]', 'Quantity', 'trim|required');
		$this->form_validation->set_rules('billing_address', 'Billing Address', 'trim|required');
		$this->form_validation->set_rules('billing_state', 'Billing State', 'trim|required');
		$this->form_validation->set_rules('delivery_address', 'Contact Person Name', 'trim|required');
		$this->form_validation->set_rules('contact_person_name', 'Billing Address', 'trim|required');
		$this->form_validation->set_rules('contact_person_mobile', 'Contact Person Mobile', 'trim|required');
		$this->form_validation->set_rules('product_price[]', 'Price', 'trim|required');
		$this->form_validation->set_rules('cgst[]', 'CGST', 'trim|required');
		$this->form_validation->set_rules('sgst[]', 'SGST', 'trim|required');
		$this->form_validation->set_rules('igst[]', 'IGST', 'trim|required');
		$this->form_validation->set_rules('exyard[]', 'Ex-yard', 'trim|required');
		$this->form_validation->set_rules('frieght[]', 'Frieght', 'trim|required');
		$this->form_validation->set_rules('total_price[]', 'Total', 'trim|required');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span><br/>');
	}

	public function getCustomerDashboard(){
		$customer_id=$this->session->userdata("id");

			$columns = array(
					0 => "unique_id",
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
							$id = $rows->unique_id;
							$enquiry_placed_date = $rows->enquiry_placed_date;
							if($rows->enquiry_id !=null){
									$viewEnquiry=anchor(site_url('customers/dashboard/enquiry_details/'.urlencode(base64_encode($rows->enquiry_id)) ), 'View Enquiry', array('class' => 'btn btn-info btn-sm')) . "&nbsp;";
							}else {
								$viewEnquiry="";
							}
							$viewQoutation="";
							$sendPO="";
							$results_q = $this->quotation_model->check_quotation($rows->enquiry_id);
							if ($results_q != NULL) {
								$viewQoutation=anchor(site_url('customers/dashboard/quoted_price_details/'.urlencode(base64_encode($results_q->quotation_id)) ), 'View Quotation', array('class' => 'btn btn-danger btn-sm')) . "&nbsp;";
								$results_purchase_order = $this->purchase_order_model->check_purchase_order($results_q->quotation_id);
								if(!$results_purchase_order){
										$sendPO=anchor(site_url('customers/dashboard/send_purchase_order/'.$results_q->quotation_id ), 'Send PO', array('class' => 'btn btn-warning btn-sm')) . "&nbsp;";
								}else {
									  $sendPO="Purchase Order Sent";
								}

							}
							$nestedData["slno"] = $slno++;
							$nestedData["unique_id"] = $id;
							$nestedData["enquiry_placed_date"] = date_format(date_create($enquiry_placed_date),'d M, Y');
							$nestedData["id"] = $viewEnquiry.$viewQoutation.$sendPO ;
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
