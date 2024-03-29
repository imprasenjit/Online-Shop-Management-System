<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Purchase_orders extends Aipl_admin
{
   /**
    * __construct
    *
    * @return void
    */
    function __construct()
    {
        parent::__construct();
        $this->load->model('purchase_order_model');
        $this->load->model('products_model');
        $this->load->model('customers_model');
        $this->load->model('billing_model');
        $this->load->model("quotation_model");
        $this->load->model("suppliers_model");
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
        $this->isAdminloggedin();
        $this->breadcrumbs->push('Dashboard', '/admin/dashboard');
        $this->breadcrumbs->push('purchase Orders', '/admin/purchase_orders');
        $this->load->view('admin/requires/header', array('title' => 'Purchase Orders'));
        $this->load->view('admin/purchase_order/purchase_order_list');
        $this->load->view('admin/requires/footer');
    }
    /**
     * cancel_purchase_order
     *
     * @return void
     */
    public function cancel_purchase_order()
    {
        $purchase_order_id = $this->input->post("po_id", TRUE);
        $this->purchase_order_model->update($purchase_order_id, array("order_status" => 0));
        echo json_encode(array("x" => true));
    }
    /**
     * view
     *
     * @param mixed $id
     * @return void
     */
    public function view($id)
    {
        $this->isAdminloggedin();
        $data = array("page" => "Purchase Order");
        $po = $this->purchase_order_model->get_by_id($id);
        $data = (array)$po;
        $this->breadcrumbs->push('Dashboard', '/admin/dashboard');
        $this->breadcrumbs->push('purchase Orders', '/admin/purchase_orders');
        $this->breadcrumbs->push('purchase Orders View', '/admin/purchase_orders/view');
        $this->load->view('admin/requires/header', array("title" => "Purchase Orders"));
        $this->load->view('admin/purchase_order/purchase_order_view', $data);
        $this->load->view('admin/requires/footer');
    }
    /**
     * send_po_to_supplier
     *
     * @param mixed $purchase_order_id
     * @return void
     */
    public function send_po_to_supplier($purchase_order_id)
    {
        $this->isAdminloggedin();
        $this->load->model("products_model");
        $this->load->model("customers_model");
        $this->load->model("attribute_model");
        $this->load->model("purchase_order_model");
        $data = array("page" => "Purchase Order");
        $po = $this->purchase_order_model->get_by_id($purchase_order_id);
        $po_data = (array)$po;
        $data = array(
            'purchase_order' => $po_data,
            'customer'=>$this->customers_model->get_by_id($po_data["customer_id"]),
            'quotation_details'=>$this->quotation_model->get_by_id($po_data["quotation_id"])
        );
        $this->load->view('admin/requires/header', array("title" => "Purchase Order to Supplier"));
        $this->load->view('admin/purchase_order/purchase_order_to_supplier', $data);
        $this->load->view('admin/requires/footer');
    }
    /**
     * purchase_order_to_supplier_action
     *
     * @return void
     */
    public function purchase_order_to_supplier_action()
    {
        $this->isAdminloggedin();
        $this->form_validation->set_rules('supplier_id', 'Suppler', 'trim|required');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', 'Please select supplier.');
            $this->session->set_flashdata('type', 'danger');
            $this->send_po_to_supplier($this->input->post("potoadmin_id", TRUE));
        } else {
            $this->load->helper("sendmail");
            $attr_count = $this->input->post("product_attr_count");
            $product_attributes = $this->input->post('product_attr', TRUE);
            $product_ids = $this->input->post('product_id', TRUE);
            $temp_array = array();
            $d_key = 0;
            foreach ($attr_count as $key => $key_value) {
                $attributes = array();
                $mykey = 0;
                while ($key_value > 0) {
                    $attributes[$mykey] = $product_attributes[$d_key];
                    $key_value--;
                    $d_key++;
                    $mykey++;
                }
                array_push($temp_array, array($product_ids[$key] => $attributes));
            }
            $products = json_encode($this->input->post("product_id", TRUE));
            $product_quantity = json_encode($this->input->post('quantity', TRUE));
            $product_unit = json_encode($this->input->post('product_unit', TRUE));
            $product_attributes = json_encode($temp_array);
            $others = json_encode($this->input->post('others', TRUE));
            $product_price = json_encode($this->input->post('product_price', TRUE));
            $tax_rate = json_encode($this->input->post('tax_rate', TRUE));
            $cgst = json_encode($this->input->post('cgst', TRUE));
            $sgst = json_encode($this->input->post('sgst', TRUE));
            $igst = json_encode($this->input->post('igst', TRUE));
            $exyard = json_encode($this->input->post('exyard', TRUE));
            $frieght = json_encode($this->input->post('frieght', TRUE));
            $total = json_encode($this->input->post('total_price', TRUE));
            $data = array(
                'purchase_order_from_customer_id' => $this->input->post("potoadmin_id", TRUE),
                'customer_purchase_order_ref' => $this->input->post("purchase_order_ref", TRUE),
                'customer_id' => $this->input->post("customer_id", TRUE),
                'supplier_id' => $this->input->post("supplier_id", TRUE),
                'products' => $products,
                'quantity' =>  $product_quantity,
                'product_unit' =>  $product_unit,
                'attributes' =>  $product_attributes,
                'others' => $others,
                'product_price' =>  $product_price,
                'tax_rate' =>  $tax_rate,
                'cgst' =>  $cgst,
                'sgst' =>  $sgst,
                'igst' =>  $igst,
                'exyard' =>  $exyard,
                'frieght' =>  $frieght,
                'total' =>  $total,
                'created_at' => date("Y-m-d H:i:s"),
                'created_by' => $this->session->userdata("id")
            );
            $this->load->model("purchase_order_model");
            $this->purchase_order_model->insert_purchase_order_to_supplier($data);
            $this->session->set_flashdata('message', 'Purchase Order successfully sent to suppluer.');
            $this->session->set_flashdata('type', 'success');
            redirect(base_url("admin/purchase_orders/purchase_order_to_supplier_list"));
        }
    }
    /**
     * purchase_order_to_supplier_view
     *
     * @param mixed $id
     * @return void
     */
    public function purchase_order_to_supplier_view($id)
    {
        $this->load->model('invoice_model');
        $data = array("page" => "Purchase Order");
        $po = $this->purchase_order_model->get_by_id_purchase_order_to_supplier($id);
        $data = (array)$po;
        $this->breadcrumbs->push('Dashboard', '/admin/dashboard');
        $this->breadcrumbs->push('Purchase Orders To Suppliers', 'admin/purchase_orders/purchase_order_to_supplier_list');
        $this->breadcrumbs->push('purchase Order', '/admin/purchase_orders/purchase_order_to_supplier_view');
        $this->load->view('admin/requires/header', array("title" => "Purchase Orders"));
        $this->load->view('admin/purchase_order/purchase_order_to_supplier_view', $data);
        $this->load->view('admin/requires/footer');
    }
    /**
     * purchase_order_to_supplier_list
     *
     * @return void
     */
    public function purchase_order_to_supplier_list()
    {
        $this->isAdminloggedin();
        log_message('error', '' . print_r($this->session->userdata(), 1));
        $this->load->library('breadcrumbs');
        $this->breadcrumbs->push('Dashboard', '/admin/dashboard');
        $this->breadcrumbs->push('Purchase Orders To Suppliers', '/purchase_orders/purchase_order_to_supplier_list/');
        $this->load->view('admin/requires/header', array('title' => 'purchase_orders'));
        $this->load->view('admin/purchase_order/supplier_purchase_order_list');
        $this->load->view('admin/requires/footer');
    }
   /**
    * get_dtrecords
    *
    * @return void
    */
    function get_dtrecords()
    {
        $columns = array(
            0 => "potoadmin_id",
            1 => "potoadmin_ref",
            2 => "customer_id",
            3 => "created_at",
            4 => "status"
        );
        $limit = $this->input->post("length");
        $start = $this->input->post("start");
        $sl_no = $start + 1;
        $order = $columns[$this->input->post("order")[0]["column"]];
        $dir = $this->input->post("order")[0]["dir"];
        $totalData = $this->purchase_order_model->tot_rows();
        $totalFiltered = $totalData;
        if (empty($this->input->post("search")["value"])) {
            $records = $this->purchase_order_model->all_rows($limit, $start, $order, $dir);
        } else {
            $search = $this->input->post("search")["value"];
            $records = $this->purchase_order_model->search_rows($limit, $start, $search, $order, $dir);
            $totalFiltered = $this->purchase_order_model->tot_search_rows($search);
        } //End of if else
        $data = array();
        if (!empty($records)) {
            foreach ($records as $rows) {
                $potoadmin_id = $rows->potoadmin_id;
                $customerInfos = $rows->name . "  ( " . $rows->contact . " | " . $rows->email . " )  <br/>" . $rows->address . "<br/>";
                $created_at = $rows->created_at;
                $viewBtn = anchor(site_url('admin/purchase_orders/view/' . $potoadmin_id), 'View', array('class' => 'btn btn-sm btn-primary')) . "&nbsp;";
                if($rows->purchase_order_supplier_id){
                    $poBtn = '<a href="#!" class="btn btn-outline-success btn-sm"><i class="fas fa-check"></i>PO Sent</a>&nbsp;';
                }else {
                    $poBtn='';
                }

                if($rows->porforma_invoice_id){
                    $piBtn = '<a href="#!" class="btn btn-outline-primary btn-sm"><i class="fas fa-check"></i>PI Sent</a>&nbsp;';
                }else {
                    $piBtn='';
                }

                if ($rows->order_status) {
                    $cancelBtn = '<a class="btn btn-danger btn-sm cancel_po" data-po-id="' . $potoadmin_id . '"  href="#!">Cancel PO</a>&nbsp;';
                } else {
                    $cancelBtn = '<span class="text-danger">PO canceled</span>&nbsp;';
                } //End of if else
                $nestedData["sl_no"] = $sl_no++;
                $nestedData["potoadmin_id"] = $potoadmin_id;
                $nestedData["potoadmin_ref"] = $rows->potoadmin_ref;
                $nestedData["name"] = $customerInfos;
                $nestedData["created_at"] = date("d-m-Y", strtotime($created_at));
                $nestedData["status"] = $viewBtn .$cancelBtn;
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
   /**
    * get_supdtrecords
    *
    * @return void
    */
    function get_supdtrecords()
    {
        $columns = array(
            0 => "purchase_order_supplier_id",
            1 => "purchase_order_from_customer_id",
            2 => "supplier_id",
            3 => "invoice_status",
            4 => "purchase_order_supplier_id"
        );
        $limit = $this->input->post("length");
        $start = $this->input->post("start");
        $order = $columns[$this->input->post("order")[0]["column"]];
        $dir = $this->input->post("order")[0]["dir"];
        $totalData = $this->purchase_order_model->tot_suprows();
        $totalFiltered = $totalData;
        if (empty($this->input->post("search")["value"])) {
            $records = $this->purchase_order_model->all_suprows($limit, $start, $order, $dir);
        } else {
            $search = $this->input->post("search")["value"];
            $records = $this->purchase_order_model->search_suprows($limit, $start, $search, $order, $dir);
            $totalFiltered = $this->purchase_order_model->tot_search_suprows($search);
        } //End of if else
        $data = array();
        if (!empty($records)) {
            $sl_no = 1;
            foreach ($records as $rows) {
                $purchase_order_supplier_id = $rows->purchase_order_supplier_id;
                $supplier_name = $rows->supplier_name ? $rows->supplier_name : "Not found";
                $invoice_status = $rows->invoice_status;
                $this->load->library('encryption');
                $encoded_purchase_order_supplier_id = $this->encryption->encrypt($purchase_order_supplier_id);
                $encoded = str_replace(array('+', '/', '='), array('-', '_', '|'), $encoded_purchase_order_supplier_id);
                if ($rows->invoice_status != NULL) {
                    if ($rows->send_to_warehouse_status == 1) {
                        $poBtn = '<a class="btn btn-success btn-sm"href="#!"><i class="glyphicon glyphicon-ok"></i>&nbsp;Sent</a>';
                    } else {
                        $poBtn = '<a class="btn btn-warning btn-sm"  href="' . base_url("admin/purchase_orders/send_to_warehouse/" . $encoded) . '">Send to Warehouse</a>';
                    }
                } else {
                    $poBtn = '';
                }
                $viewBtn = anchor(site_url('admin/purchase_orders/purchase_order_to_supplier_view/' . $purchase_order_supplier_id), 'View', array('class' => 'btn btn-sm btn-primary')) . "&nbsp;";
                $nestedData["sl_no"] = $sl_no++;
                $nestedData["customer_id"] = $rows->customer_name;
                $nestedData["purchase_order_from_customer_id"] = $rows->customer_purchase_order_ref;
                $nestedData["supplier_id"] = $supplier_name;
                $nestedData["invoice_status"] = ($invoice_status != NULL) ? '<span class="text-success"><i class="glyphicon glyphicon-ok"></i>&nbsp;Invoice Sent</span>' : '<span class="text-danger">Pending</span>';
                $nestedData["purchase_order_supplier_id"] = $viewBtn . $poBtn;
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
    } //End of get_supdtrecords()
   /**
    * get_suppliernames
    *
    * @return void
    */
    function get_suppliernames()
    {
        $term = trim(strip_tags($this->input->get("term", TRUE)));
        $a_json = array();
        $a_json_row = array();
        $this->load->model('suppliers_model');
        $records = $this->suppliers_model->search_rows(10, 0, $term, "name", $term);
        if ($records) {
            foreach ($records as $rows) {
                $a_json_row["id"] = $rows->supplier_id;
                $a_json_row["label"] = $rows->name;
                $a_json_row["value"] = $rows->name;
                array_push($a_json, $a_json_row);
            } //End foreach()
            echo json_encode($a_json);
            flush();
        } else {
            $a_json_row["id"] = "XXX";
            $a_json_row["value"] = "No supplier found. Register a supplier";
            array_push($a_json, $a_json_row);
            echo json_encode($a_json);
            flush();
        } //End of if else
    } //End of get_suppliernames()
    //** Purchase Order to Warehouse Functions */
    public function purchase_order_to_warehouse_list()
    {
        $this->isAdminloggedin();
        $this->load->library('breadcrumbs');
        $this->breadcrumbs->push('Dashboard', '/admin/dashboard');
        $this->breadcrumbs->push('Purchase Orders To Warehouse', '/purchase_orders/purchase_order_to_warehouse_list/');
        $this->load->view('admin/requires/header', array('title' => 'Purchase order to warehouse'));
        $this->load->view('admin/purchase_order/purchase_order_to_warehouse_list');
        $this->load->view('admin/requires/footer');
    }
   /**
    * get_dtrecords_purchase_order_to_warehouse
    *
    * @return void
    */
    function get_dtrecords_purchase_order_to_warehouse()
    {
        $columns = array(
            0 => "potoadmin_id",
            1 => "customer_id",
            2 => "created_at",
            3 => "status"
        );
        $limit = $this->input->post("length");
        $start = $this->input->post("start");
        $sl_no = $start + 1;
        $order = $columns[$this->input->post("order")[0]["column"]];
        $dir = $this->input->post("order")[0]["dir"];
        $totalData = $this->purchase_order_model->total_rows_purchase_order_to_warehouse();
        $totalFiltered = $totalData;
        if (empty($this->input->post("search")["value"])) {
            $records = $this->purchase_order_model->all_rows_purchase_order_to_warehouse($limit, $start, $order, $dir);
        } else {
            $search = $this->input->post("search")["value"];
            $records = $this->purchase_order_model->search_rows_purchase_order_to_warehouse($limit, $start, $search, $order, $dir);
            $totalFiltered = $this->purchase_order_model->tot_search_rows_purchase_order_to_warehouse($search);
        } //End of if else
        $data = array();
        if (!empty($records)) {
            foreach ($records as $rows) {
                $purchase_order_to_warehouse_id = $rows->purchase_order_to_warehouse_id;
                $customerInfos = $rows->name . " ( " . $rows->contact . " | " . $rows->email . " ) <br/>" . $rows->address . "<br/>";
                $created_at = $rows->created_at;
                $viewBtn = anchor(site_url('admin/purchase_orders/purchase_order_to_warehouse_view/' . $purchase_order_to_warehouse_id), 'View', array('class' => 'btn btn-sm btn-primary')) . "&nbsp;";
                $cancelBtn = '<a class="btn btn-danger btn-sm cancel_po" data-po-id="' . $purchase_order_to_warehouse_id . '"  href="#!">Cancel PO</a>';
                $nestedData["sl_no"] = $sl_no++;
                $nestedData["name"] = $customerInfos;
                $nestedData["created_at"] = date("d-m-Y h:i A", strtotime($created_at));
                $nestedData["status"] = $viewBtn;
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
    public function send_to_warehouse($send_id = NULL)
    {
        $this->isAdminloggedin();
        $this->breadcrumbs->push('Dashboard', '/admin/dashboard');
        $this->breadcrumbs->push('purchase Orders to Warehouse List', '/admin/purchase_orders/purchase_order_to_warehouse_list');
        $this->breadcrumbs->push('purchase Orders to Warehouse', '/admin/purchase_orders/send_to_warehouse');
        if ($send_id != NULL) {
            $this->load->library('encryption');
            $dec_send_id = str_replace(array('-', '_', '|'), array('+', '/', '='), $send_id);
            $dec_send_id = $this->encryption->decrypt($dec_send_id);           
            $row = $this->purchase_order_model->get_by_id_purchase_order_to_supplier($dec_send_id);
            $data = array(
                "purchase_order_to_supplier_id" => $row->purchase_order_supplier_id,
                "supplier_id" => $row->supplier_id,
                "invoice_id" => $row->invoice_id,
                "purchase_order_from_customer_id" => $row->purchase_order_from_customer_id,
                "customer_id" => $row->customer_id,
                "products" => $row->products,
                "quantity" => $row->quantity,
                "product_unit" => $row->product_unit,
                "attributes" => $row->attributes,
                "others" => $row->others,
                "product_price" => $row->product_price,
                "tax_rate" => $row->tax_rate,
                "cgst" => $row->cgst,
                "sgst" => $row->sgst,
                "igst" => $row->igst,
                "exyard" => $row->exyard,
                "frieght" => $row->frieght,
                "total" => $row->total,
                'created_at' => date("Y-m-d H:i:s"),
                'created_by' => $this->session->userdata('id')
            );
            $this->purchase_order_model->insert_purchse_order_to_warehouse($data);
            $this->session->set_flashdata('message', 'Purchase Order has been sent successfully');
            $this->session->set_flashdata('type', 'success');
            redirect(site_url('admin/purchase_orders/purchase_order_to_warehouse_list'));
        } else {
            $this->load->view('admin/requires/header', array('title' => 'Purchase Order to Warehouse'));
            $this->load->view('admin/purchase_order/purchase_order_to_warehouse');
            $this->load->view('admin/requires/footer');
        }
    }
    public function send_to_warehouse_action()
    {
        //$this->pr($this->input->post());
        $this->isAdminloggedin();
        $this->form_validation->set_rules('send_to', 'Customer', 'trim|required');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', 'Purchase Order could not be Sent to warehouse <br/>');
            $this->session->set_flashdata('type', 'danger');
            $this->send_to_warehouse();
        } else {
            $attr_count = $this->input->post("product_attr_count");
            $product_attributes = $this->input->post('product_attr', TRUE);
            $product_ids = $this->input->post('product_id', TRUE);
            $temp_array = array();
            $d_key = 0;
            foreach ($attr_count as $key => $key_value) {
                $attributes = array();
                $mykey = 0;
                while ($key_value > 0) {
                    $attributes[$mykey] = $product_attributes[$d_key];
                    $key_value--;
                    $d_key++;
                    $mykey++;
                }
                array_push($temp_array, array($product_ids[$key] => $attributes));
            }
            $products = json_encode($product_ids);
            $send_to = $this->input->post('send_to', TRUE);
            $customer_address = $this->customers_model->get_address_by_address_id($this->input->post('address_selector', TRUE));
            $editordata = $this->input->post('editordata', TRUE);
            $editordata2 = $this->input->post('editordata2', TRUE);
            $product_quantity = json_encode($this->input->post('quantity', TRUE));
            $product_unit = json_encode($this->input->post('product_unit', TRUE));
            $product_attributes = json_encode($temp_array);
            $product_price = json_encode($this->input->post('product_price', TRUE));
            $tax_rate = json_encode($this->input->post('tax_rate', TRUE));
            $cgst = json_encode($this->input->post('cgst', TRUE));
            $sgst = json_encode($this->input->post('sgst', TRUE));
            $igst = json_encode($this->input->post('igst', TRUE));
            $exyard = json_encode($this->input->post('exyard', TRUE));
            $frieght = json_encode($this->input->post('frieght', TRUE));
            $total = json_encode($this->input->post('total_price', TRUE));
            $others = json_encode($this->input->post('others', TRUE));
            $data = array(
                'customer_id' => $send_to,
                'customer_address' => $customer_address->address,
                'products' => $products,
                'quantity' =>  $product_quantity,
                'product_unit' =>  $product_unit,
                'attributes' =>  $product_attributes,
                'product_price' =>  $product_price,
                'tax_rate' =>  $tax_rate,
                'cgst' =>  $cgst,
                'sgst' =>  $sgst,
                'igst' =>  $igst,
                'exyard' =>  $exyard,
                'frieght' =>  $frieght,
                'total' =>  $total,
                'others' => $others,
                'created_at' => date("Y-m-d H:i:s"),
                'created_by' => $this->session->userdata('id')
            );
            $this->purchase_order_model->insert_purchse_order_to_warehouse($data);
            $this->session->set_flashdata('message', 'Purchase Order has been sent successfully');
            $this->session->set_flashdata('type', 'success');
            redirect(site_url('admin/purchase_orders/purchase_order_to_warehouse_list'));
        }
    }
    public function purchase_order_to_warehouse_view($purchase_order_to_warehouse_id)
    {
        $this->load->model('suppliers_model');
        $this->load->model('products_model');
        $this->load->model('customers_model');
        $this->load->model('invoice_model');
        $data = array("page" => "Purchase Order");
        $po = $this->purchase_order_model->get_by_id_purchase_order_to_warehouse($purchase_order_to_warehouse_id);
        $data = (array)$po;
        $this->load->view('admin/requires/header', array("title" => "Purchase Orders"));
        $this->load->view('admin/purchase_order/purchase_order_view_for_warehouse', $data);
        $this->load->view('admin/requires/footer');
    }
    //** Purchase Order to Warehouse Functions */
};
