<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Testimonials extends Aipl_admin
{
    function __construct()
    {
        parent::__construct();
        $this->load->model("feedback_model");
        $this->load->library("breadcrumbs");
    } //End of __construct()

    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $this->breadcrumbs->push('Dashboard', '/admin/dashboard');
        $this->breadcrumbs->push('Testimonials List', '/admin/testimonials');
        $this->load->view('admin/requires/header', array('title' => 'Testimonial List'));
        $this->load->view('admin/testimonials/testimonials_list');
        $this->load->view('admin/requires/footer');
    }
    /**
     * get_dtrecords
     *
     * @return void
     */
    public function get_dtrecords()
    {
        $columns = array(
            0 => "feedback_id",
            1 => "name",
            2 => "email",
            3 => "contact",
            4 => "address",
            5 => "message",
            6 => "status",
        );
        $limit = $this->input->post("length");
        $start = $this->input->post("start");
        $sl_no = $start + 1;
        $order = $columns[$this->input->post("order")[0]["column"]];
        $dir = $this->input->post("order")[0]["dir"];
        $totalData = $this->feedback_model->tot_rows();
        $totalFiltered = $totalData;
        if (empty($this->input->post("search")["value"])) {
            $records = $this->feedback_model->all_rows($limit, $start, $order, $dir);
        } else {
            $search = $this->input->post("search")["value"];
            $records = $this->feedback_model->search_rows($limit, $start, $search, $order, $dir);
            $totalFiltered = $this->feedback_model->tot_search_rows($search);
        } //End of if else
        $data = array();
        if (!empty($records)) {
            foreach ($records as $rows) {
                $viewBtn = anchor(site_url('admin/testimonials/read/' . $rows->feedback_id), 'View', array('class' => 'btn btn-sm btn-primary')) . "&nbsp;";
                $editBtn = anchor(site_url('admin/testimonials/update/' . $rows->feedback_id), 'edit', array('class' => 'btn btn-sm btn-warning')) . "&nbsp;";
                if($rows->activation_status==0){
                    $activeBtn='<a href="#!" data-status="1" class="btn btn-sm btn-danger activate" data-id="'.$rows->feedback_id.'">Activate</a>';
                }else{
                    $activeBtn='<a href="#!" data-status="0" class="btn btn-sm btn-danger activate" data-id="'.$rows->feedback_id.'">Deactivate</a>';
                }
                $nestedData["sl_no"] = $sl_no++;
                $nestedData["name"] = $rows->name;
                $nestedData["email"] = $rows->email;
                $nestedData["contact"] = $rows->contact;
                $nestedData["id"] = $viewBtn . $editBtn .$activeBtn;
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
    }

    /**
     * read
     *
     * @param mixed $id
     * @return void
     */
    function read($id)
    {
        $this->isAdminloggedin();
        $row = $this->feedback_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id' => $row->feedback_id,
                'name' => $row->name,
                'email' => $row->email,
                'contact' => $row->contact,
                'address' => $row->address,
                'message' => $row->message,
                'created_at' => $row->created_at,
            );
            $this->breadcrumbs->push('Dashboard', '/admin/dashboard');
            $this->breadcrumbs->push('Testimonials', '/admin/testimonials');
            $this->breadcrumbs->push('Testimonials Details', '/admin/testimonials/read');
            $this->load->view('admin/requires/header', array('title' => 'Testimonials view'));
            $this->load->view('admin/testimonials/testimonials_read', $data);
            $this->load->view('admin/requires/footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            $this->session->set_flashdata('type', 'error');
            redirect(site_url('admin/testimonials'));
        } //End of if else
    } //End of read()

    /**
     * update
     *
     * @param mixed $id
     * @return void
     */
    public function update($id)
    {
        $this->load->helper('form');
        $this->isAdminloggedin();
        $row = $this->feedback_model->get_by_id($id);
        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => base_url('admin/testimonials/update_action'),
                'feedback_id' => $row->feedback_id,
                'name' => $row->name,
                'email' => $row->email,
                'contact' => $row->contact,
                'address' => $row->address,
                'message' => $row->message,
                'created_at' => $row->created_at,
            );
            $this->breadcrumbs->push('Dashboard', '/admin/dashboard');
            $this->breadcrumbs->push('Suppliers List', '/admin/testimonials');
            $this->breadcrumbs->push('Suppliers Details', '/admin/testimonials/read');
            $this->load->view('admin/requires/header', array('title' => 'Testimonials view'));
            $this->load->view('admin/testimonials/testimonials_form', $data);
            $this->load->view('admin/requires/footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            $this->session->set_flashdata('type', 'error');
            redirect(site_url('admin/testimonials'));
        } //End of if else
    }

    /**
     * update_action
     *
     * @param mixed $id
     * @return void
     */
    public function update_action()
    {
        //$this->pr($this->input->post());
        $this->isAdminloggedin();
        $data = array(
            'name' => $this->input->post("name", true),
            'email' => $this->input->post("email", true),
            'contact' => $this->input->post("contact", true),
            'address' => $this->input->post("address", true),
            'message' => $this->input->post("message", true),
        );
        $this->feedback_model->update($this->input->post("feedback_id", TRUE), $data);
        $this->session->set_flashdata('message', 'Update Testimonials Success');
        $this->session->set_flashdata('type', 'success');
        redirect(site_url('admin/testimonials'));
    }

    /**
     * activate
     *
     * @return void
     */
    public function activate()
    {
        $activation_status=$this->input->post("feedback_status",TRUE);
        $data=array(
            "activation_status"=>intval($activation_status)
        );
        $this->feedback_model->update($this->input->post("feedback_id", TRUE), $data);
        echo json_encode(array("x"=>1));
    }
    
}
