<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Message extends Aipl_admin {

    function __construct() {
        parent::__construct();
        $this->isAdminloggedin();
        $this->load->model('message_model');
        $this->load->library('form_validation');
        $this->load->library('breadcrumbs');
    }

    public function index() {
        $this->breadcrumbs->push('Dashboard', '/admin/dashboard');
        $this->breadcrumbs->push('Message List', '/admin/message');
        $this->load->view('admin/requires/header', array('title' => 'Message'));
        $this->load->view('admin/message/message_list');
        $this->load->view('admin/requires/footer');
    }

    public function read($id) {
        $row = $this->message_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id' => $row->id,
                'send_from' => $row->send_from,
                'send_to' => $row->send_to,
                'subject' => $row->subject,
                'message' => $row->message,
            );
            $this->load->view('admin/requires/header', array('title' => 'message'));
            $this->load->view('admin/message/message_read', $data);
            $this->load->view('admin/requires/footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/message'));
        }
    }

    public function create() {
        $data = array(
            'button' => 'Create',
            'action' => site_url('admin/message/create_action'),
            'id' => set_value('id'),
            'send_from' => set_value('send_from'),
            'send_to' => set_value('send_to'),
            'subject' => set_value('subject'),
            'message' => set_value('message'),
        );
        $this->breadcrumbs->push('Dashboard', '/admin/dashboard');
        $this->breadcrumbs->push('Message List', '/admin/message');
        $this->breadcrumbs->push('Compose Message', '/admin/message/create');
        $this->load->view('admin/requires/header', array('title' => 'message'));
        $this->load->view('admin/message/message_form', $data);
        $this->load->view('admin/requires/footer');
    }
    
   /**
    * get_custnames
    *
    * @return void
    */
    function get_custnames(){
        $term = trim(strip_tags($this->input->get("term", TRUE)));
        $a_json = array();
        $a_json_row = array();
        
        $this->load->model('customers_model');
        $records = $this->customers_model->search_rows(10, 0, $term, "name", $term);
        if($records) {
            foreach($records as $rows) {
                $a_json_row["id"] = $rows->id;
                $a_json_row["label"] = $rows->name." : ".$rows->address;
                $a_json_row["value"] = $rows->email;
                $a_json_row["name"] = $rows->name;
                $a_json_row["address"]=$this->customers_model->get_address_by_id($rows->id);
                array_push($a_json, $a_json_row);
            }//End foreach()
            echo json_encode($a_json);
            flush();
        } else {
            $a_json_row["id"] = "XXX";
            $a_json_row["value"] = "No customer found. Register a customer";
            array_push($a_json, $a_json_row);
            echo json_encode($a_json);
            flush();
        }//End of if else
    }//End of get_custnames()

    public function create_action() {
        if($this->input->post('sendall')) {
            $this->load->model('customers_model');
            $records = $this->customers_model->get_all();
            if($records) {
                $emails = null;
                foreach($records as $rows) {
                    $emails = $emails.",".$rows->email;
                }//End foreach()
                $send_to = trim($emails,",");
            }//End of if
        } else {
            $send_to = $this->input->post('send_to');
        }//End of if else

        $this->load->helper("sendmail");
        $subject = $this->input->post('subject');
        $message = $this->input->post('message');
        
        $this->load->helper('fileupload');
        if ($this->input->post("upload_download_file")) {
            $download_file = moveFile(3, $this->input->post("upload_download_file"), "download_file");
        } else {
            $download_file = NULL;
        }//End of if else
        //die("File : ".$download_file[0]);
        $data = array(
            'send_to' => $send_to,
            'subject' => $subject,
            'message' => $message,
        );

        $this->message_model->insert($data);
        $sub = $subject;
        $msgBody = $message;
        //$msgFooter =  "Regards, \n Supply Origin \n Guwahati Assam";
        $status = sendtoall($send_to, $sub, $msgBody, $download_file[0]);
        $this->session->set_flashdata('message', 'Email Sent');
        redirect(site_url('admin/message'));
    }

    public function update($id) {
        $row = $this->message_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('admin/message/update_action'),
                'id' => set_value('id', $row->id),
                'send_from' => set_value('send_from', $row->send_from),
                'send_to' => set_value('send_to', $row->send_to),
                'subject' => set_value('subject', $row->subject),
                'message' => set_value('message', $row->message),
            );

            $this->load->view('admin/requires/header', array('title' => 'message'));
            $this->load->view('admin/message/message_form', $data);
            $this->load->view('admin/requires/footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/message'));
        }
    }

    public function update_action() {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
                'send_from' => $this->input->post('send_from', TRUE),
                'send_to' => $this->input->post('send_to', TRUE),
                'subject' => $this->input->post('subject', TRUE),
                'message' => $this->input->post('message', TRUE),
            );

            $this->message_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('admin/message'));
        }
    }

    public function delete($id) {
        $row = $this->message_model->get_by_id($id);

        if ($row) {
            $this->message_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('admin/message'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/message'));
        }
    }

    public function _rules() {
        $this->form_validation->set_rules('send_from', ' ', 'trim');
        $this->form_validation->set_rules('send_to', ' ', 'trim');
        $this->form_validation->set_rules('subject', ' ', 'trim');
        $this->form_validation->set_rules('message', ' ', 'trim');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    function get_dtrecords() {
        $columns = array(
            0 => "send_to",
            1 => "subject",
            2 => "message",
            3 => "id",
        );
        $limit = $this->input->post("length");
        $start = $this->input->post("start");
        $order = $columns[$this->input->post("order")[0]["column"]];
        $dir = $this->input->post("order")[0]["dir"];
        $totalData = $this->message_model->tot_rows();
        $totalFiltered = $totalData;
        if (empty($this->input->post("search")["value"])) {
            $records = $this->message_model->all_rows($limit, $start, $order, $dir);
        } else {
            $search = $this->input->post("search")["value"];
            $records = $this->message_model->search_rows($limit, $start, $search, $order, $dir);
            $totalFiltered = $this->message_model->tot_search_rows($search);
        }//End of if else
        $data = array();
        if (!empty($records)) {
            $slno = 1;
            foreach ($records as $rows) {
                $id = $rows->id;
                $subject = $rows->subject;
                $send_to = $rows->send_to;
                $message = $rows->message;

                $viewBtn = anchor(site_url('admin/message/read/' . $id), 'View', array('class' => 'btn btn-sm btn-primary')) . "&nbsp;";
                $editBtn = anchor(site_url('admin/message/update/' . $id), 'Edit', array('class' => 'btn btn-sm btn-warning')) . "&nbsp;";
                $deleteBtn = anchor(site_url('admin/message/delete/' . $id), 'Delete', array('class' => 'btn btn-sm btn-danger', 'onclick' => 'return confirm(\'Are You Sure you want to delete?\')')) . "&nbsp;";
                $nestedData["slno"] = $slno++;
                $nestedData["send_to"] = $send_to;
                $nestedData["subject"] = $subject;
                $nestedData["message"] = $message;
                $nestedData["id"] = $viewBtn . $editBtn . $deleteBtn;
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

//End of get_dtrecords()
}

;

/* End of file Message.php */
/* Location: ./application/controllers/Message.php */
