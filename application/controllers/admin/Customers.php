<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Customers extends Aipl_admin{
    function __construct(){
        parent::__construct();
        $this->isAdminloggedin();
        $this->load->library('cart');
        $this->load->model('billing_model');
        $this->load->model('quotation_model');
        $this->load->model('products_model');
        $this->load->model('enquires_model');
        $this->load->model('customers_model');
        $this->load->library('form_validation');
        $this->load->library('breadcrumbs');
    }

    public function index(){
        $this->breadcrumbs->push('Dashboard', '/admin/dashboard');
        $this->breadcrumbs->push('Customer List', '/admin/customers');
        $this->load->view('admin/requires/header', array('title' => 'Customer List'));
        $this->load->view('admin/customer_registration/customer_registration_list');
        $this->load->view('admin/requires/footer');
    }

    public function read($id) {
        $row = $this->customers_model->get_by_id($id);
        $additional_address = $this->customers_model->get_address_by_id($id);
        if ($row) {
            $data = array(
                'id' => $row->id,
                'name' => $row->name,
                'address' => $row->address,
                'contact' => $row->contact,
                'email' => $row->email,
                'gst_no' => $row->gst_no,
                'pan_no' => $row->pan_no,
                'reg_date' => $row->reg_date,
                'password' => $row->password,
            );
            $data['additional_address']=$additional_address;
            $this->breadcrumbs->push('Dashboard', '/admin/dashboard');
            $this->breadcrumbs->push('Customer List', '/admin/customers');
            $this->breadcrumbs->push('Customer Details', '/admin/customers/read');
            $this->load->view('admin/requires/header', array('title' => 'Customers'));
            $this->load->view('admin/customer_registration/customer_registration_read', $data);
            $this->load->view('admin/requires/footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/customer_registration'));
        }
    }

    public function report($customer_id) {
        $customer_detail=$this->customers_model->get_by_id($customer_id);
        $data = array(
            "customer" => $customer_detail
        );
        $this->load->view('admin/requires/header', array("title" => "Report"));
        $this->load->view('admin/customer_registration/customer_registration_report', $data);
        $this->load->view('admin/requires/footer');
    }

    public function create() {
        $data = array(
            'button' => 'Create',
            'action' => site_url('admin/customers/create_action'),
            'id' => set_value('id'),
            'name' => set_value('name'),
            'address' => set_value('address'),
            'contact' => set_value('contact'),
            'email' => set_value('email'),
            'gst_no' => set_value('gst_no'),
            'pan_no' => set_value('pan_no'),
            'password' => set_value('password'),
        );
        $data['additional_address']="";
        $this->breadcrumbs->push('Dashboard', '/admin/dashboard');
        $this->breadcrumbs->push('Customer List', '/admin/customers');
        $this->breadcrumbs->push('Add Customer', '/admin/customers/create');
        $this->load->view('admin/requires/header', array('title' => 'Customer Registration'));
        $this->load->view('admin/customer_registration/customer_registration_form', $data);
        $this->load->view('admin/requires/footer');
    }

    public function create_action() {
        $this->_rules();
        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {

            $pass = ($this->input->post('password', TRUE));
            $salt = uniqid("", true);
            $algo = "6";
            $rounds = "5050";
            $cryptSalt = '$' . $algo . '$rounds=' . $rounds . '$' . $salt;
            $hashedPassword = crypt($pass, $cryptSalt);
            $data = array(
                'name' => $this->input->post('name', TRUE),
                'address' => $this->input->post('address', TRUE),
                'contact' => $this->input->post('contact', TRUE),
                'email' => $this->input->post('email', TRUE),
                'gst_no' => $this->input->post('gst_no', TRUE),
                'pan_no' => $this->input->post('pan_no', TRUE),
                'password' => $hashedPassword,
            );

            if(!$this->customers_model->checkuser($this->input->post('email'))){
              $this->session->set_flashdata('message', 'Customer email already exist');
              $this->session->set_flashdata('type', 'warning');
            }else {
              $customer_id=$this->customers_model->insert($data);
              if($this->input->post('address_type[]',TRUE)){
                $address_type=$this->input->post('address_type[]',TRUE);
                $address=$this->input->post('customer_address[]',TRUE);
                foreach ($address_type as $key => $value) {
                  $address_data=array('address_type'=>$address_type[$key],'address'=>$address[$key],'customer_id'=>$customer_id);
                  $this->customers_model->add_address($address_data);
                }
              }
              $this->session->set_flashdata('message', 'Create Record Success');
              $this->session->set_flashdata('type', 'success');
            }

            redirect(site_url('admin/customers'));
        }
    }

    public function update($id) {
        $this->breadcrumbs->push('Dashboard', '/admin/dashboard');
        $this->breadcrumbs->push('Customer List', '/admin/customers');
        $this->breadcrumbs->push('Edit Customer', '/admin/customers/update');
        $row = $this->customers_model->get_by_id($id);
        $additional_address = $this->customers_model->get_address_by_id($id);
        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('admin/customers/update_action'),
                'id' => set_value('id', $row->id),
                'name' => set_value('name', $row->name),
                'address' => set_value('address', $row->address),
                'contact' => set_value('contact', $row->contact),
                'email' => set_value('email', $row->email),
                'gst_no' => set_value('gst_no', $row->gst_no),
                'pan_no' => set_value('pan_no', $row->pan_no),
                'password' => set_value('password', "1234567890abcdbefghijklmnopqrstuvwxyz"),
                'cpassword' => set_value('cpassword', "1234567890abcdbefghijklmnopqrstuvwxyz"),
            );
            $data['additional_address']=$additional_address;
            $this->load->view('admin/requires/header', array('title' => 'customer_registration'));
            $this->load->view('admin/customer_registration/customer_registration_form', $data);
            $this->load->view('admin/requires/footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/customer_registration'));
        }
    }

    public function update_action() {
        $this->_rules();
        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
          // var_dump($this->input->post());die;
            $data = array(
                'name' => $this->input->post('name', TRUE),
                'address' => $this->input->post('address', TRUE),
                'contact' => $this->input->post('contact', TRUE),
                // 'email' => $this->input->post('email', TRUE),
            );
            if($this->input->post('password') != "1234567890abcdbefghijklmnopqrstuvwxyz"){
              $salt = uniqid("", true);
              $algo = "6";
              $rounds = "5050";
              $cryptSalt = '$' . $algo . '$rounds=' . $rounds . '$' . $salt;
              $hashedPassword = crypt($this->input->post('password'), $cryptSalt);
              $data['password']=$hashedPassword;
            }
            $this->customers_model->update($this->input->post('id', TRUE), $data);
            if($this->input->post('address_type[]',TRUE)){
              $address_type=$this->input->post('address_type[]',TRUE);
              $address=$this->input->post('customer_address[]',TRUE);
              $exiting_customer_id=$this->input->post('existing_address_id[]',TRUE);
              foreach ($address_type as $key => $value) {
                if($exiting_customer_id[$key]){
                  $this->customers_model->update_address($exiting_customer_id[$key],array('address_type'=>$address_type[$key],'address'=>$address[$key],'updated_at'=>date('Y-m-d H:i:s')));
                }else {
                  $this->customers_model->add_address(array('address_type'=>$address_type[$key],'address'=>$address[$key],'customer_id'=>$this->input->post('id', TRUE)));
                }
              }
            }
            $this->session->set_flashdata('message', 'Customer details updated successfully');
            $this->session->set_flashdata('type', 'success');
            redirect(site_url('admin/customers'));
        }
    }

    public function delete($id) {
        $row = $this->customers_model->get_by_id($id);
        if ($row) {
            $this->customers_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            $this->session->set_flashdata('type', 'success');
            redirect(site_url('admin/customers'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            $this->session->set_flashdata('message', 'error');
            redirect(site_url('admin/customers'));
        }
    }

    public function _rules() {
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('address', 'Address', 'trim|required');
        $this->form_validation->set_rules('contact', 'Contact Number', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        $this->form_validation->set_rules('cpassword','Confirm Password', 'trim|required');
        $this->form_validation->set_rules('id', 'id', 'trim');

        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel() {
        $this->load->helper('exportexcel');
        $namaFile = "customer_registration.xls";
        $judul = "customer_registration";
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
        xlsWriteLabel($tablehead, $kolomhead++, "name");
        xlsWriteLabel($tablehead, $kolomhead++, "address");
        xlsWriteLabel($tablehead, $kolomhead++, "contact");
        xlsWriteLabel($tablehead, $kolomhead++, "email");
        foreach ($this->customers_model->get_all() as $data) {
            $kolombody = 0;
            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->name);
            xlsWriteLabel($tablebody, $kolombody++, $data->address);
            xlsWriteLabel($tablebody, $kolombody++, $data->contact);
            xlsWriteLabel($tablebody, $kolombody++, $data->email);
            $tablebody++;
            $nourut++;
        }
        xlsEOF();
        exit();
    }

    function get_dtrecords() {
        $columns = array(
            0 => "name",
            1 => "contact",
            2 => "address",
            3 => "email",
            4 => "id",
        );
        $limit = $this->input->post("length");
        $start = $this->input->post("start");
        $order = $columns[$this->input->post("order")[0]["column"]];
        $dir = $this->input->post("order")[0]["dir"];
        $totalData = $this->customers_model->tot_rows();
        $totalFiltered = $totalData;
        if (empty($this->input->post("search")["value"])) {
            $records = $this->customers_model->all_rows($limit, $start, $order, $dir);
        } else {
            $search = $this->input->post("search")["value"];
            $records = $this->customers_model->search_rows($limit, $start, $search, $order, $dir);
            $totalFiltered = $this->customers_model->tot_search_rows($search);
        } //End of if else
        $data = array();
        if (!empty($records)) {
            $slno = 1;
            foreach ($records as $rows) {
                $name = $rows->name;
                $contact = $rows->contact;
                $address = $rows->address;
                $email = $rows->email;
                $id = $rows->id;

                $reportBtn = anchor(site_url('admin/customers/report/' . $id), 'Report', array('class' => 'btn btn-success btn-sm')) . "&nbsp;";
                $viewBtn = anchor(site_url('admin/customers/read/' . $id), 'View', array('class' => 'btn btn-primary btn-sm')) . "&nbsp;";
                $editBtn = anchor(site_url('admin/customers/update/' . $id), 'Edit', array('class' => 'btn btn-warning btn-sm')) . "&nbsp;";
                $deleteBtn = anchor(site_url('admin/customers/delete/' . $id), 'Delete', array('class' => 'btn btn-danger btn-sm', 'onclick' => 'return confirm(\'Are You Sure you want to delete?\')')) . "&nbsp;";

                $nestedData["slno"] = $slno++;
                $nestedData["name"] = $name;
                $nestedData["contact"] = $contact;
                $nestedData["address"] = $address;
                $nestedData["email"] = $email;
                $nestedData["id"] = $reportBtn . $viewBtn . $editBtn . $deleteBtn;
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

    function get_dtrecords_customer_report($customer_id) {
        $columns = array(
            0 => "name",
            1 => "contact",
            2 => "address",
            3 => "email",
            4 => "id",
        );
        $limit = $this->input->post("length");
        $start = $this->input->post("start");
        $order = $columns[$this->input->post("order")[0]["column"]];
        $dir = $this->input->post("order")[0]["dir"];
        $totalData = $this->enquires_model->tot_rows();
        $totalFiltered = $totalData;
        if (empty($this->input->post("search")["value"])) {
            $records = $this->customers_model->get_enquiry_details_by_customer_id_all_rows($customer_id,$limit, $start, $order, $dir);
        } else {
            $search = $this->input->post("search")["value"];
            $records = $this->customers_model->get_enquiry_details_by_customer_id($customer_id,$limit, $start, $search, $order, $dir);
            $totalFiltered = $this->customers_model->get_enquiry_details_by_customer_tot_search_rows($customer_id);
        } //End of if else

        $data = array();
        if (!empty($records)) {
            $slno =1;
            foreach ($records as $rows) {
                $id = $rows->enquiry_id;

                $reportBtn = anchor(site_url('admin/enquires/enquiry_details/' . $id), 'View', array('class' => 'btn btn-success btn-sm')) . "&nbsp;";
                $nestedData["slno"] = $slno++;
                $nestedData["enquiry_no"] = $rows->unique_id;
                $nestedData["enquiry_date"] = date("d-m-Y",strtotime($rows->enquiry_placed_date));
                $nestedData["action"] = $reportBtn;
                 $data[] = $nestedData;
            } //End of for
        } //End of if
        $json_data = array(
            "draw" => intval($this->input->post("draw")),
            "recordsTotal" => intval($totalFiltered),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        );
        echo json_encode($json_data);
    }//End of get_dtrecords()
};
