<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Warehouse extends Aipl_admin
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('warehouse_model');
        $this->load->model('suppliers_model');
        $this->load->model('purchase_order_model');
        $this->load->library('form_validation');
        $this->load->library('breadcrumbs');
    }
    public function dashboard()
    {
        $this->isWarehouseLoggedIn();
        $this->load->view('admin/requires/header', array('title' => 'warehouse'));
        $this->load->view('admin/warehouse/dashboard');
        $this->load->view('admin/requires/footer');
    }

    public function goods_dispatch_status()
    {
        $purchase_order_to_warehouse_id = $this->input->post("purchase_order_to_warehouse_id", TRUE);
        $data = array(
            "goods_dispatch_status" => 1,
            "goods_dispatch_time" => date("Y-m-d H:i:s")
        );
        $this->purchase_order_model->update_purchase_order_to_warehouse($purchase_order_to_warehouse_id, $data);
        echo json_encode(array("x" => 1));
    }
    public function purchase_order_view_for_warehouse($id)
    {
        $this->isWarehouseLoggedIn();
        $this->load->model('suppliers_model');
        $this->load->model('products_model');
        $this->load->model('customers_model');
        $this->load->model('invoice_model');
        $data = array("page" => "Purchase Order");
        $po = $this->purchase_order_model->get_by_id_purchase_order_to_warehouse($id);
        $data = (array)$po;
        $this->load->view('admin/requires/header', array("title" => "Purchase Orders"));
        $this->load->view('admin/warehouse/purchase_order_view_for_warehouse', $data);
        $this->load->view('admin/requires/footer');
    }
    public function index()
    {
        $this->isAdminloggedin();
        $keyword = '';
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'warehouse/index/';
        $config['total_rows'] = $this->warehouse_model->total_rows();
        $config['per_page'] = 10;
        $config['uri_segment'] = 3;
        $config['suffix'] = '.html';
        $config['first_url'] = base_url() . 'warehouse.html';
        $this->pagination->initialize($config);
        $start = $this->uri->segment(3, 0);
        $warehouse = $this->warehouse_model->index_limit($config['per_page'], $start);
        $data = array(
            'warehouse_data' => $warehouse,
            'keyword' => $keyword,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );

        $this->breadcrumbs->push('Dashboard', '/admin/dashboard');
        $this->breadcrumbs->push('Warehouse', '/admin/warehouse');

        $this->load->view('admin/requires/header', array('title' => 'warehouse'));
        $this->load->view('admin/warehouse/warehouse_list', $data);
        $this->load->view('admin/requires/footer');
    }
    public function read($id)
    {
        $this->isAdminloggedin();
        $row = $this->warehouse_model->get_by_id($id);
        if ($row) {
            $data = array(
                'warehouse_user_id' => $row->warehouse_user_id,
                'name' => $row->name,
                'mobile' => $row->mobile,
                'username' => $row->username,
                'address' => $row->address,
            );
            $this->breadcrumbs->push('Dashboard', '/admin/dashboard');
            $this->breadcrumbs->push('Warehouse', '/admin/warehouse');
            $this->breadcrumbs->push('Warehouse Details', '/admin/warehouse/read');

            $this->load->view('admin/requires/header', array('title' => 'warehouse'));
            $this->load->view('admin/warehouse/warehouse_read', $data);
            $this->load->view('admin/requires/footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            $this->session->set_flashdata('result', 'error');
            redirect(site_url('admin/warehouse'));
        }
    }
    public function create()
    {
        $this->isAdminloggedin();
        $this->breadcrumbs->push('Dashboard', '/admin/dashboard');
        $this->breadcrumbs->push('Warehouse', '/admin/warehouse');
        $this->breadcrumbs->push('Create Warehouse', '/admin/warehouse/create');
        $data = array(
            'button' => 'Create',
            'action' => site_url('admin/warehouse/create_action'),
            'warehouse_user_id' => set_value('warehouse_user_id'),
            'name' => set_value('name'),
            'mobile' => set_value('mobile'),
            'username' => set_value(''),
            'password' => set_value('password'),
            'address' => set_value('address'),
        );
        $this->breadcrumbs->push('Dashboard', '/admin/dashboard');
        $this->breadcrumbs->push('Warehouse', '/admin/warehouse');
        $this->breadcrumbs->push('Add Warehouse', '/admin/warehouse/create');

        $this->load->view('admin/requires/header', array('title' => 'Warehouse'));
        $this->load->view('admin/warehouse/warehouse_form', $data);
        $this->load->view('admin/requires/footer');
    }
    public function create_action()
    {
        $this->isAdminloggedin();
        $this->_rules();
        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $check_user = $this->warehouse_model->check_user_name($this->input->post('username', TRUE));
            if (!$check_user) {
                $password = $this->input->post('password', TRUE);
                $hashed_password = crypt($password, '$6$$supplyorigin$');
                $data = array(
                    'warehouse_user_id' => $this->input->post('warehouse_user_id', TRUE),
                    'name' => $this->input->post('name', TRUE),
                    'mobile' => $this->input->post('mobile', TRUE),
                    'username' => $this->input->post('username', TRUE),
                    'password' => $hashed_password,
                    'address' => $this->input->post('address', TRUE),
                    'created_at' => date("Y-m-d H:i:s"),
                    'created_by' => $this->session->userdata('id'),
                );
                $this->warehouse_model->insert($data);
                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('admin/warehouse'));
            } else {
                $this->session->set_flashdata('message', 'Username Already Exists');
                $this->create();
            }
        }
    }
    public function update($id)
    {
        $this->isAdminloggedin();
        $this->breadcrumbs->push('Dashboard', '/admin/dashboard');
        $this->breadcrumbs->push('Warehouse', '/admin/warehouse');
        $this->breadcrumbs->push('Update Warehouse', '/admin/warehouse/update');
        $row = $this->warehouse_model->get_by_id($id);
        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('admin/warehouse/update_action'),
                'warehouse_user_id' => set_value('warehouse_user_id', $row->warehouse_user_id),
                'name' => set_value('name', $row->name),
                'mobile' => set_value('mobile', $row->mobile),
                'username' => set_value('username', $row->username),
                'password' => set_value('password', "123456789456"),
                'address' => set_value('address', $row->address),
            );
            $this->load->view('admin/requires/header', array('title' => 'warehouse'));
            $this->load->view('admin/warehouse/warehouse_form', $data);
            $this->load->view('admin/requires/footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            $this->session->set_flashdata('result', 'error');
            redirect(site_url('admin/warehouse'));
        }
    }
    public function update_action()
    {
        $this->isAdminloggedin();
        $this->_rules();
        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('warehouse_user_id', TRUE));
        } else {
            $password = $this->input->post('password', TRUE);
            if ($password == "123456789456") {
                $data = array(
                    'name' => $this->input->post('name', TRUE),
                    'mobile' => $this->input->post('mobile', TRUE),
                    'username' => $this->input->post('username', TRUE),
                    'address' => $this->input->post('address', TRUE),
                    'updated_at' => date("Y-m-d H:i:s"),
                    'updated_by' => $this->session->userdata('id'),
                );
            } else {
                $hashed_password = crypt($password, '$6$$supplyorigin$');
                $data = array(
                    'name' => $this->input->post('name', TRUE),
                    'mobile' => $this->input->post('mobile', TRUE),
                    'username' => $this->input->post('username', TRUE),
                    'password' => $hashed_password,
                    'address' => $this->input->post('address', TRUE),
                    'updated_at' => date("Y-m-d H:i:s"),
                    'updated_by' => $this->session->userdata('id'),
                );
            }
            $this->warehouse_model->update($this->input->post('warehouse_user_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            $this->session->set_flashdata('result', 'success');
            redirect(site_url('admin/warehouse'));
        }
    }
    public function delete($id)
    {
        $this->isAdminloggedin();
        $row = $this->warehouse_model->get_by_id($id);
        if ($row) {
            $this->warehouse_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('admin/warehouse'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/warehouse'));
        }
    }
    public function _rules()
    {
        $this->form_validation->set_rules('warehouse_user_id', 'ID', 'trim');
        $this->form_validation->set_rules('name', 'name', 'trim|required');
        $this->form_validation->set_rules('mobile', 'mobile', 'trim|required');
        $this->form_validation->set_rules('username', 'username', 'trim|required');
        $this->form_validation->set_rules('password', 'password', 'trim|required');
        $this->form_validation->set_rules('address', 'address', 'trim|required');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    function get_dtrecords()
    {
        $columns = array(
            0 => "name",
            1 => "mobile",
            2 => "address",
            3 => "username",
            4 => "warehouse_user_id",
        );
        $limit = $this->input->post("length");
        $start = $this->input->post("start");
        $order = $columns[$this->input->post("order")[0]["column"]];
        $dir = $this->input->post("order")[0]["dir"];
        $totalData = $this->warehouse_model->tot_rows();
        $totalFiltered = $totalData;
        if (empty($this->input->post("search")["value"])) {
            $records = $this->warehouse_model->all_rows($limit, $start, $order, $dir);
        } else {
            $search = $this->input->post("search")["value"];
            $records = $this->warehouse_model->search_rows($limit, $start, $search, $order, $dir);
            $totalFiltered = $this->warehouse_model->tot_search_rows($search);
        } //End of if else
        $data = array();
        if (!empty($records)) {
            $slno = 1;
            foreach ($records as $rows) {
                $warehouse_user_id = $rows->warehouse_user_id;
                $mobile = $rows->mobile;
                $name = $rows->name;
                $address = $rows->address;
                $username = $rows->username;

                $viewBtn = anchor(site_url('admin/warehouse/read/' . $warehouse_user_id), 'View', array('class' => 'btn btn-sm btn-primary')) . "&nbsp;";
                $editBtn = anchor(site_url('admin/warehouse/update/' . $warehouse_user_id), 'Edit', array('class' => 'btn btn-sm btn-warning')) . "&nbsp;";
                $deleteBtn = anchor(site_url('admin/warehouse/delete/' . $warehouse_user_id), 'Delete', array('class' => 'btn btn-sm btn-danger', 'onclick' => 'return confirm(\'Are You Sure you want to delete?\')')) . "&nbsp;";
                $nestedData["slno"] = $slno++;
                $nestedData["name"] = $name;
                $nestedData["mobile"] = $mobile;
                $nestedData["address"] = $address;
                $nestedData["username"] = $username;
                $nestedData["warehouse_user_id"] = $viewBtn . $editBtn . $deleteBtn;
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

    public function get_dtrecords_for_warehouse()
    {
        $this->load->model("customers_model");
        $this->load->model("suppliers_model");
        $columns = array(
            0 => "purchase_order_to_warehouse_id",
        );
        $limit = $this->input->post("length");
        $start = $this->input->post("start");
        $order = $columns[$this->input->post("order")[0]["column"]];
        $dir = $this->input->post("order")[0]["dir"];
        $search = $this->input->post("search")["value"];

        $records = $this->purchase_order_model->index_limit_purchase_order_to_warehouse($limit, $start, $search, $order, $dir);
        $data = array();
        if (!empty($records)) {
            $slno = 1;
            foreach ($records as $rows) {
                $customer_details = $this->customers_model->get_by_id($rows->customer_id);
                if ($rows->goods_dispatch_status == 1) {
                    $editBtn = '<a href="#!" class="btn btn-success btn-sm"><i class="glyphicon glyphicon-ok"></i>&nbsp;sent</a>&nbsp;';
                } else {
                    $editBtn = '<a href="#!" data-po-id="' . $rows->purchase_order_to_warehouse_id . '" class="btn btn-sm btn-warning goods_dispatch">Goods Dispatch</a>&nbsp;';
                }
                $viewBtn = anchor(site_url('admin/warehouse/purchase_order_view_for_warehouse/' . $rows->purchase_order_to_warehouse_id), 'View', array('class' => 'btn btn-sm btn-primary')) . "&nbsp;";
                $dispatchBtn = anchor(site_url('admin/warehouse/add_dispatch_details/' . $rows->purchase_order_to_warehouse_id), 'Dispatch Info', array('class' => 'btn btn-sm btn-primary')) . "&nbsp;";
                $nestedData["sl_no"] = $slno++;
                $nestedData["customer"] = $customer_details->name . '<br/>' . $customer_details->contact . '<br/>' . $customer_details->address;
                //$nestedData["supplier"] = $suppliers_details->name . '<br/>' . $suppliers_details->mobile . '<br/>' . $suppliers_details->address;
                $nestedData["po_date"] = date("d-m-Y", strtotime($rows->created_at));
                $nestedData["action"] = $viewBtn . $editBtn . $dispatchBtn;
                $data[] = $nestedData;
            } //End of for
            $json_data = array(
                "draw" => intval($this->input->post("draw")),
                "recordsTotal" => count($records),
                "recordsFiltered" => count($records),
                "data" => $data
            );
        } else {
            $json_data = array(
                "draw" => intval($this->input->post("draw")),
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => $data
            );
        }

        echo json_encode($json_data);
    }
    public function add_dispatch_details($po_id)
    {
        $this->breadcrumbs->push('Dashboard', '/admin/dashboard');
        $this->breadcrumbs->push('Warehouse', '/admin/warehouse');
        $this->breadcrumbs->push('Update Warehouse', '/admin/warehouse/add_dispatch_details');
        $this->load->view('admin/requires/header', array("title" => "Add Dispatch Information"));
        $data['po_id'] = $po_id;
        $data['docs_info'] = $this->warehouse_model->get_goods_dispatch_details($po_id);
        $this->load->view('admin/warehouse/add_dispatch_details', $data);
        $this->load->view('admin/requires/footer');
    }
    public function add_dispatch_details_action()
    {
        $res = false;
        $purchase_order_to_warehouse_id = $this->input->post('purchase_order_to_warehouse_id');
        if ($this->input->post('upload_dispatch_doc')) {
            $this->load->helper("fileupload");
            $doc = moveFile(0, $this->input->post("upload_dispatch_doc"), "dispatch_doc");
            $res = $this->warehouse_model->add_dispatch_details($purchase_order_to_warehouse_id, array('dispatch_doc' => json_encode($doc)));
        }
        if ($res) {
            $this->session->set_flashdata('message', 'Record Updated Successfully');
            $this->session->set_flashdata('type', 'success');
            redirect(site_url('admin/warehouse/dashboard'));
        } else {
            $this->session->set_flashdata('message', 'Unable to update. Please try again');
            $this->session->set_flashdata('type', 'danger');
            redirect(site_url('admin/warehouse/dashboard'));
        }
    }
};
