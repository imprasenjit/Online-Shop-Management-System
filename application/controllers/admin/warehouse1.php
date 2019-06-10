<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Warehouse extends Aipl_admin
{
    function __construct()
    {
        parent::__construct();        
        $this->load->model('warehouse_model');
        $this->load->library('form_validation');
    }
    public function dashboard(){
        $this->load->view('admin/requires/header', array('title' => 'warehouse'));
        $this->load->view('admin/warehouse/dashboard');
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
        $this->load->view('admin/requires/header', array('title' => 'warehouse'));
        $this->load->view('admin/warehouse/warehouse_list', $data);
        $this->load->view('admin/requires/footer');
    }
    public function search()
    {
        $this->isAdminloggedin();
        $keyword = $this->uri->segment(3, $this->input->post('keyword', TRUE));
        $this->load->library('pagination');
        if ($this->uri->segment(2) == 'search') {
            $config['base_url'] = base_url() . 'warehouse/search/' . $keyword;
        } else {
            $config['base_url'] = base_url() . 'warehouse/index/';
        }
        $config['total_rows'] = $this->warehouse_model->search_total_rows($keyword);
        $config['per_page'] = 10;
        $config['uri_segment'] = 4;
        $config['suffix'] = '.html';
        $config['first_url'] = base_url() . 'warehouse/search/' . $keyword . '.html';
        $this->pagination->initialize($config);
        $start = $this->uri->segment(4, 0);
        $warehouse = $this->warehouse_model->search_index_limit($config['per_page'], $start, $keyword);
        $data = array(
            'warehouse_data' => $warehouse,
            'keyword' => $keyword,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
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
                'supplier_id' => $row->supplier_id,
                'name' => $row->name,
                'mobile' => $row->mobile,
                'username' => $row->username,
                'address' => $row->address,
            );
            $this->load->view('admin/requires/header', array('title' => 'warehouse'));
            $this->load->view('admin/warehouse/warehouse_read', $data);
            $this->load->view('admin/requires/footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/warehouse'));
        }
    }
    public function create()
    {
        $this->isAdminloggedin();
        $data = array(
            'button' => 'Create',
            'action' => site_url('admin/warehouse/create_action'),
            'supplier_id' => set_value('supplier_id'),
            'name' => set_value('name'),
            'mobile' => set_value('mobile'),
            'username' => set_value('username'),
            'password' => set_value('password'),
            'address' => set_value('address'),
        );
        $this->load->view('admin/requires/header', array('title' => 'warehouse'));
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
                    'supplier_id' => $this->input->post('supplier_id', TRUE),
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
        $row = $this->warehouse_model->get_by_id($id);
        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('admin/warehouse/update_action'),
                'supplier_id' => set_value('supplier_id', $row->supplier_id),
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
            redirect(site_url('admin/warehouse'));
        }
    }
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
            $this->warehouse_model->update($this->input->post('supplier_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
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
        $this->form_validation->set_rules('supplier_id', 'ID', 'trim');
        $this->form_validation->set_rules('name', 'name', 'trim|required');
        $this->form_validation->set_rules('mobile', 'mobile', 'trim|required');
        $this->form_validation->set_rules('username', 'username', 'trim|required');
        $this->form_validation->set_rules('password', 'password', 'trim|required');
        $this->form_validation->set_rules('address', 'address', 'trim|required');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "warehouse.xls";
        $judul = "warehouse";
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
        xlsWriteLabel($tablehead, $kolomhead++, "supplier_id");
        xlsWriteLabel($tablehead, $kolomhead++, "name");
        xlsWriteLabel($tablehead, $kolomhead++, "mobile");
        xlsWriteLabel($tablehead, $kolomhead++, "username");
        xlsWriteLabel($tablehead, $kolomhead++, "password");
        xlsWriteLabel($tablehead, $kolomhead++, "address");
        xlsWriteLabel($tablehead, $kolomhead++, "status");
        xlsWriteLabel($tablehead, $kolomhead++, "created_at");
        xlsWriteLabel($tablehead, $kolomhead++, "created_by");
        xlsWriteLabel($tablehead, $kolomhead++, "updated_at");
        xlsWriteLabel($tablehead, $kolomhead++, "updated_by");
        foreach ($this->warehouse_model->get_all() as $data) {
            $kolombody = 0;
            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteNumber($tablebody, $kolombody++, $data->supplier_id);
            xlsWriteLabel($tablebody, $kolombody++, $data->name);
            xlsWriteLabel($tablebody, $kolombody++, $data->mobile);
            xlsWriteLabel($tablebody, $kolombody++, $data->username);
            xlsWriteLabel($tablebody, $kolombody++, $data->password);
            xlsWriteLabel($tablebody, $kolombody++, $data->address);
            xlsWriteNumber($tablebody, $kolombody++, $data->status);
            xlsWriteLabel($tablebody, $kolombody++, $data->created_at);
            xlsWriteNumber($tablebody, $kolombody++, $data->created_by);
            xlsWriteLabel($tablebody, $kolombody++, $data->updated_at);
            xlsWriteNumber($tablebody, $kolombody++, $data->updated_by);
            $tablebody++;
            $nourut++;
        }
        xlsEOF();
        exit();
    }
};
/* End of file Suppliers.php */
/* Location: ./application/controllers/Suppliers.php */
