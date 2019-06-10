<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Suppliers extends Aipl_admin
{
   /**
    * __construct
    *
    * @return void
    */
    function __construct()
    {
        parent::__construct();
        $this->load->model('suppliers_model');
        $this->load->model('purchase_order_model');
        $this->load->library('form_validation');
        $this->load->library('breadcrumbs');
    }
    /**
     * dashboard
     *
     * @return void
     */
    public function dashboard()
    {
        $this->isSuppliersloggedin();
        $this->load->view('admin/requires/header', array('title' => 'suppliers'));
        $this->load->view('admin/suppliers/dashboard');
        $this->load->view('admin/requires/footer');
    }

    /**
     * purchase_order_to_supplier_view
     *
     * @param mixed $id
     * @return void
     */
    public function purchase_order_to_supplier_view($id){
        $this->load->model('invoice_model');
        $this->load->model('products_model');
        $data = array("page" => "Purchase Order");
        $po=$this->purchase_order_model->get_by_id_purchase_order_to_supplier($id);
        $data=(array)$po;
        $this->breadcrumbs->push('Dashboard', 'admin/suppliers/dashboard');
        $this->breadcrumbs->push('Purchase Orders To Suppliers', 'admin/suppliers/purchase_order_to_supplier_view');
		$this->load->view('admin/requires/header',array("title"=>"Purchase Orders"));
		$this->load->view('admin/purchase_order/po_to_supplier_view_for_supplier',$data);
		$this->load->view('admin/requires/footer');
    }

   /**
    * get_dtrecords_for_supplier
    *
    * @return void
    */
    function get_dtrecords_for_supplier()
    {

        $supplier_id = $this->session->id;
        $columns = array(
            0 => "purchase_order_supplier_id",
            1 => "supplier_id",
            2 => "purchase_order_from_customer_id",
            3 => "customer_id",
        );
        $limit = $this->input->post("length");
        $start = $this->input->post("start");
        $order = $columns[$this->input->post("order")[0]["column"]];
        $dir = $this->input->post("order")[0]["dir"];
        $search = $this->input->post("search")["value"];
        $records = $this->purchase_order_model->search_suprows_supplier_dashboard($limit, $start, $search, $order, $dir, $supplier_id);
        $data = array();
        if (!empty($records)) {
            $sl_no = 1;
            foreach ($records as $rows) {
                if ($rows->invoice_status != NULL) {
                    $str='<span class="text-success"><i class="glyphicon glyphicon-ok"></i>&nbsp;Invoice Sent</span>';
                    $nestedData["invoice_date"] = date("d-m-Y",strtotime($rows->invoice_date));
                } else {
                    $str='<span class="text-danger">Pending</span>';
                    $nestedData["invoice_date"] = "Not sent";
                }
                $viewBtn = anchor(site_url('admin/suppliers/purchase_order_to_supplier_view/' . $rows->purchase_order_supplier_id), 'View', array('class' => 'btn btn-sm btn-primary')) . "&nbsp;";
                $editBtn = anchor(site_url('admin/suppliers/upload_invoice_details/' . $rows->purchase_order_supplier_id), 'Upload Invoice', array('class' => 'btn btn-sm btn-warning')) . "&nbsp;";
                $nestedData["sl_no"] = $sl_no++;
                $nestedData["purchase_order_id"] = $rows->purchase_order_supplier_id;
                $nestedData["date"] = $rows->purchase_order_supplier_id;
                $nestedData["status"] =$str;

                $nestedData["action"] = $viewBtn.$editBtn;
                $data[] = $nestedData;
            } //End of for
        } //End of if
        $json_data = array(
            "draw" => intval($this->input->post("draw")),
            "recordsTotal" => count($records),
            "recordsFiltered" => count($records),
            "data" => $data
        );
        echo json_encode($json_data);
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
        $this->breadcrumbs->push('Suppliers List', '/admin/suppliers');
        $this->load->view('admin/requires/header', array('title' => 'suppliers'));
        $this->load->view('admin/suppliers/suppliers_list');
        $this->load->view('admin/requires/footer');
    }
    public function upload_invoice_details($po_order)
    {
        $purchase_order_detail = $this->purchase_order_model->get_by_id_purchase_order_to_supplier($po_order);
        $data = (array)$purchase_order_detail;
        $this->load->view('admin/requires/header', array('title' => 'suppliers'));
        $this->load->view('admin/suppliers/invoice_upload', $data);
        $this->load->view('admin/requires/footer');
    }

    /**
     * send_invoice_details_action
     *
     * @return void
     */
    public function send_invoice_details_action()
    {

        $this->isSuppliersloggedin();
        $this->form_validation->set_rules('purchase_order_to_supplier_id', 'Purchase Order', 'trim|required');
        $this->form_validation->set_rules('company_name', 'Company Name', 'trim|required');
        $this->form_validation->set_rules('invoice_no', 'Invoice No', 'trim|required');
        $this->form_validation->set_rules('invoice_date', 'Invoice Date', 'trim|required');
        $this->form_validation->set_rules('lorry_no', 'Lorry No', 'trim|required');
        $this->form_validation->set_rules('lorry_date', 'Lorry Date', 'trim|required');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
        if ($this->form_validation->run() == FALSE) {
            $this->upload_invoice_details($this->input->post("purchase_order_to_supplier_id", TRUE));
        } else {
            $this->load->helper("fileupload");
            if ($this->input->post("upload_invoice")) {
                $invoice_doc = moveFile(0, $this->input->post("upload_invoice"), "invoice");
            }
            $data = array(
                'purchase_order_to_supplier_id' => $this->input->post("purchase_order_to_supplier_id", TRUE),
                'company_name' => $this->input->post("company_name", TRUE),
                'invoice_no' => $this->input->post("invoice_no", TRUE),
                'invoice_date' => $this->input->post("invoice_date", TRUE),
                'lorry_no' => $this->input->post("lorry_no", TRUE),
                'lorry_date' => $this->input->post("lorry_date", TRUE),
                'invoice_doc' => $invoice_doc[0],
                'created_at' => date("Y-m-d H:i:s"),
                'created_by' => $this->session->id
            );
            $insert_id = $this->suppliers_model->save_invoice_details($data);
            if ($insert_id) {
                $status_change = array("invoice_status" => 1, "invoice_id" => $insert_id);
                $this->purchase_order_model->update_purchase_order_to_supplier($data["purchase_order_to_supplier_id"], $status_change);
                $this->session->set_flashdata('message', 'Invoice Details Successfully Send');
                $this->session->set_flashdata('type', 'success');
                redirect(site_url('admin/suppliers/dashboard'));
            }
        }
    }
    /**
     * read
     *
     * @param mixed $id
     * @return void
     */
    public function read($id)
    {
        $this->isAdminloggedin();
        $row = $this->suppliers_model->get_by_id($id);
        if ($row) {
            $data = array(
                'supplier_id' => $row->supplier_id,
                'name' => $row->name,
                'mobile' => $row->mobile,
                'username' => $row->username,
                'address' => $row->address,
                'state' => $row->state,
            );
            $this->breadcrumbs->push('Dashboard', '/admin/dashboard');
            $this->breadcrumbs->push('Suppliers List', '/admin/suppliers');
            $this->breadcrumbs->push('Suppliers Details', '/admin/suppliers/read');

            $this->load->view('admin/requires/header', array('title' => 'suppliers'));
            $this->load->view('admin/suppliers/suppliers_read', $data);
            $this->load->view('admin/requires/footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            $this->session->set_flashdata('type', 'error');
            redirect(site_url('admin/suppliers'));
        }
    }
    /**
     * create
     *
     * @return void
     */
    public function create()
    {
        $this->breadcrumbs->push('Dashboard', '/admin/dashboard');
        $this->breadcrumbs->push('Suppliers', '/admin/suppliers');
        $this->breadcrumbs->push('Add Supplier', '/admin/suppliers/create');
        $this->isAdminloggedin();
        $data = array(
            'button' => 'Create',
            'action' => site_url('admin/suppliers/create_action'),
            'supplier_id' => set_value('supplier_id'),
            'name' => set_value('name'),
            'mobile' => set_value('mobile'),
            'username' => set_value(''),
            'password' => set_value('password'),
            'address' => set_value('address'),
            'state' => set_value('state'),
        );
        $this->load->view('admin/requires/header', array('title' => 'suppliers'));
        $this->load->view('admin/suppliers/suppliers_form', $data);
        $this->load->view('admin/requires/footer');
    }
    /**
     * create_action
     *
     * @return void
     */
    public function create_action()
    {
        $this->isAdminloggedin();
        $this->_rules();
        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $check_user = $this->suppliers_model->check_user_name($this->input->post('username', TRUE));
            if (!$check_user) {
                $password = $this->input->post('password', TRUE);
                $hashed_password = crypt($password, '$6$$supplyorigin$');
                $data = array(
                    'supplier_id' => $this->input->post('supplier_id', TRUE),
                    'name' => $this->input->post('name', TRUE),
                    'mobile' => $this->input->post('mobile', TRUE),
                    'username' => $this->input->post('username', TRUE),
                    'password' => $hashed_password,
                    'address' => $this->input->post('address', TRUE),
                    'state' => $this->input->post('state', TRUE),
                    'created_at' => date("Y-m-d H:i:s"),
                    'created_by' => $this->session->userdata('id'),
                );
                $this->suppliers_model->insert($data);
                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('admin/suppliers'));
            } else {
                $this->session->set_flashdata('message', 'Username Already Exists . Please use different username!');
                $this->session->set_flashdata('message_type', 'danger');
                $this->create();
            }
        }
    }
    /**
     * update
     *
     * @param mixed $id
     * @return void
     */
    public function update($id)
    {
        $this->isAdminloggedin();
        $this->breadcrumbs->push('Dashboard', '/admin/dashboard');
        $this->breadcrumbs->push('Suppliers', '/admin/suppliers');
        $this->breadcrumbs->push('Update Supplier', '/admin/suppliers/update');
        $row = $this->suppliers_model->get_by_id($id);
        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('admin/suppliers/update_action'),
                'supplier_id' => set_value('supplier_id', $row->supplier_id),
                'name' => set_value('name', $row->name),
                'mobile' => set_value('mobile', $row->mobile),
                'username' => set_value('username', $row->username),
                'password' => set_value('password', "123456789456"),
                'address' => set_value('address', $row->address),
                'state' => set_value('address', $row->state),
            );
            $this->load->view('admin/requires/header', array('title' => 'suppliers'));
            $this->load->view('admin/suppliers/suppliers_form', $data);
            $this->load->view('admin/requires/footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            $this->session->set_flashdata('type', 'error');
            redirect(site_url('admin/suppliers'));
        }
    }
    /**
     * update_action
     *
     * @return void
     */
    public function update_action()
    {
        $this->isAdminloggedin();
        $this->_rules();
        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('supplier_id', TRUE));
        } else {
            $password = $this->input->post('password', TRUE);
            if ($password == "123456789456") {
                $data = array(
                    'name' => $this->input->post('name', TRUE),
                    'mobile' => $this->input->post('mobile', TRUE),
                    'address' => $this->input->post('address', TRUE),
                    'state' => $this->input->post('state', TRUE),
                    'updated_at' => date("Y-m-d H:i:s"),
                    'updated_by' => $this->session->userdata('id'),
                );
            } else {
                $hashed_password = crypt($password, '$6$$supplyorigin$');
                $data = array(
                    'name' => $this->input->post('name', TRUE),
                    'mobile' => $this->input->post('mobile', TRUE),
                    'password' => $hashed_password,
                    'address' => $this->input->post('address', TRUE),
                    'state' => $this->input->post('state', TRUE),
                    'updated_at' => date("Y-m-d H:i:s"),
                    'updated_by' => $this->session->userdata('id'),
                );
            }
            $this->suppliers_model->update($this->input->post('supplier_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            $this->session->set_flashdata('type', 'success');
            redirect(site_url('admin/suppliers'));
        }
    }
    /**
     * delete
     *
     * @param mixed $id
     * @return void
     */
    public function delete($id)
    {
        $this->isAdminloggedin();
        $row = $this->suppliers_model->get_by_id($id);
        if ($row) {
            $this->suppliers_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            $this->session->set_flashdata('type', 'success');
            redirect(site_url('admin/suppliers'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            $this->session->set_flashdata('type', 'error');
            redirect(site_url('admin/suppliers'));
        }
    }
    /**
     * _rules
     *
     * @return void
     */
    public function _rules()
    {
        $this->form_validation->set_rules('supplier_id', 'ID', 'trim');
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('mobile', 'Mobile', 'trim|required');
        $this->form_validation->set_rules('username', 'Username', 'trim');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        $this->form_validation->set_rules('address', 'Address', 'trim|required');
        $this->form_validation->set_rules('state', 'State', 'trim|required');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span><br/>');
    }
    
   /**
    * get_dtrecords
    *
    * @return void
    */
    function get_dtrecords()
    {
        $columns = array(
            0 => "name",
            1 => "mobile",
            2 => "address",
            3 => "username",
            4 => "supplier_id",
        );
        $limit = $this->input->post("length");
        $start = $this->input->post("start");
        $order = $columns[$this->input->post("order")[0]["column"]];
        $dir = $this->input->post("order")[0]["dir"];
        $totalData = $this->suppliers_model->tot_rows();
        $totalFiltered = $totalData;
        if (empty($this->input->post("search")["value"])) {
            $records = $this->suppliers_model->all_rows($limit, $start, $order, $dir);
        } else {
            $search = $this->input->post("search")["value"];
            $records = $this->suppliers_model->search_rows($limit, $start, $search, $order, $dir);
            $totalFiltered = $this->suppliers_model->tot_search_rows($search);
        } 
        $data = array();
        if (!empty($records)) {
            $slno = 1;
            foreach ($records as $rows) {
                $name = $rows->name;
                $mobile = $rows->mobile;
                $address = $rows->address;
                $username = $rows->username;
                $supplier_id = $rows->supplier_id;

                $viewBtn = anchor(site_url('admin/suppliers/read/' . $supplier_id), 'View', array('class' => 'btn btn-primary btn-sm')) . "&nbsp;";
                $editBtn = anchor(site_url('admin/suppliers/update/' . $supplier_id), 'Edit', array('class' => 'btn btn-sm btn-warning')) . "&nbsp;";
                $deleteBtn = anchor(site_url('admin/suppliers/delete/' . $supplier_id), 'Delete', array('class' => 'btn btn-sm btn-danger', 'onclick' => 'return confirm(\'Are You Sure you want to delete?\')')) . "&nbsp;";
                $nestedData["slno"] = $slno++;
                $nestedData["name"] = $name;
                $nestedData["mobile"] = $mobile;
                $nestedData["address"] = $address;
                $nestedData["username"] = $username;
                $nestedData["supplier_id"] = $viewBtn . $editBtn . $deleteBtn;
                $data[] = $nestedData;
            } 
        } 
        $json_data = array(
            "draw" => intval($this->input->post("draw")),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        );
        echo json_encode($json_data);
    } 
};
