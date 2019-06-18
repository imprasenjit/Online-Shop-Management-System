<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class Quotation extends Aipl_admin
{
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->isAdminloggedin();
        $this->load->library('email');
        $this->load->model('quotation_model');
        $this->load->model('sub_category_model');
        $this->load->model('attribute_model');
        $this->load->model('enquires_model');
        $this->load->model('products_model');
        $this->load->model('customers_model');
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
        $this->breadcrumbs->push('Dashboard', '/admin/dashboard');
        $this->breadcrumbs->push('Quotation List', '/admin/quotation');
        $this->load->view('admin/requires/header', array('title' => 'Quotation'));
        $this->load->view('admin/quotation/quotation_list');
        $this->load->view('admin/requires/footer');
    }

    /**
     * send_quotation
     *
     * @param mixed $enquiry_id
     * @return void
     */
    public function send_quotation($enquiry_id)
    {
        $this->load->library('email');
        $this->load->model("enquires_model");
        $this->load->model("products_model");
        $data = array(
            'button' => 'Create',
            'action' => site_url('admin/quotation/create_action'),
            'id' => set_value('id'),
            'enquiry_id' => set_value('enquiry_id', $enquiry_id),
            'send_to' => set_value('send_to'),
            'product_price' => set_value('product_price'),
            'cgst' => set_value('cgst'),
            'sgst' => set_value('sgst'),
            'igst' => set_value('igst'),
            'exyard' => set_value('exyard'),
            'frieght' => set_value('frieght'),
        );
        $this->load->view('admin/requires/header', array('title' => 'quotation'));
        $this->load->view('admin/quotation/quotation_form', $data);
        $this->load->view('admin/requires/footer');
    }
    /**
     * view_quotation
     *
     * @return void
     */
    public function view_quotation()
    {
        $this->load->library('email');
        $this->load->model("enquires_model");
        $this->load->model("products_model");
        $this->breadcrumbs->push('Dashboard', '/admin/dashboard');
        $this->breadcrumbs->push('Quotation List', '/admin/quotation');
        $this->breadcrumbs->push('Quotation', '/admin/quotation/view_quotation');
        $this->load->view('admin/requires/header', array('title' => 'Quotation'));
        $this->load->view('admin/quotation/quotation_format');
        $this->load->view('admin/requires/footer');
    }
    /**
     * create
     *
     * @return void
     */
    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('admin/quotation/create_action'),
            'id' => set_value('id'),
            'send_to' => set_value('send_to'),
            'product_price' => set_value('product_price'),
            'enquiry_id' => set_value('enquiry_id'),
        );
        $this->load->view('admin/requires/header', array('title' => 'quotation'));
        $this->load->view('admin/quotation/quotation_form', $data);
        $this->load->view('admin/requires/footer');
    }
    /**
     * create_action
     *
     * @return void
     */
    public function create_action()
    {
        $this->_rules();
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', 'Quotation could not be Sent');
            $this->session->set_flashdata('type', 'danger');
            $this->send_quotation($this->input->post('enquiry_id', TRUE));
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
            $enquiry_id = $this->input->post('enquiry_id', TRUE);
            $send_to = $this->input->post('send_to', TRUE);
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
                'enquiry_id' => $enquiry_id,
                'customer_id' => $send_to,
                'productid' => $products,
                'quantity' =>  $product_quantity,
                'product_unit' =>  $product_unit,
                'attributes' =>  $product_attributes,
                'editordata' =>  $editordata,
                'editordata2' =>  $editordata2,
                'product_price' =>  $product_price,
                'tax_rate' =>  $tax_rate,
                'cgst' =>  $cgst,
                'sgst' =>  $sgst,
                'igst' =>  $igst,
                'exyard' =>  $exyard,
                'frieght' =>  $frieght,
                'total' =>  $total,
                'others' => $others
            );
            $qid = $this->quotation_model->insert($data);
            if ($qid) {
                /*$sub = "Quotation for Enquiry";
            $msgBody = "Hello";
            $msgBody = $this->load->view('admin/quotation/quotation_view', array("qid"=>$qid), true);
            $status = sendmail($send_to, $sub, $msgBody);
            print_r($status);die();
            */
                $this->session->set_flashdata('message', 'Quotation Sent');
                $this->session->set_flashdata('type', 'success');
                redirect(site_url('admin/enquires'));
            } else {
                redirect(site_url('admin/enquires'));
            }
        }
    }
    /**
     * send_quotation_to_customer
     *
     * @param mixed $enquiry_id
     * @return void
     */
    public function send_quotation_to_customer()
    {
        
        $this->load->model('suppliers_model');
        $this->load->view('admin/requires/header', array('title' => 'quotation'));
        $this->load->view('admin/quotation/quotation_for_customer');
        $this->load->view('admin/requires/footer');
    }
    /**
     * create_action_for_customer
     *
     * @return void
     */
    public function create_action_for_customer()
    {
       
        $this->_rules();
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', 'Quotation could not be Sent <br/>');
            $this->session->set_flashdata('type', 'danger');
            $this->send_quotation_to_customer();
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
                'productid' => $products,
                'quantity' =>  $product_quantity,
                'product_unit' =>  $product_unit,
                'attributes' =>  $product_attributes,
                'editordata' =>  $editordata,
                'editordata2' =>  $editordata2,
                'product_price' =>  $product_price,
                'tax_rate' =>  $tax_rate,
                'cgst' =>  $cgst,
                'sgst' =>  $sgst,
                'igst' =>  $igst,
                'exyard' =>  $exyard,
                'frieght' =>  $frieght,
                'total' =>  $total,
                'others' => $others
            );
            $qid = $this->quotation_model->insert($data);
            if ($qid) {
/*                
                $data['row']=$this->enquires_model->get_by_id($qid);
                $this->load->view('admin/quotation/quotation_pdf', $data);
                $html = $this->output->get_output();
                $this->load->library('dompdflib');
                $this->dompdf->loadHtml($html);
                $this->dompdf->setPaper('A4', 'landscape');
                $this->dompdf->render();
                $output = $this->dompdf->output();
                $pdfName = time().".pdf";
                $pdfPath = 'storage/temps/'.$pdfName;
                //$this->dompdf->stream($pdfPath, array("Attachment"=>0)); die();
                file_put_contents($pdfPath, $output);

                $this->load->helper("sendmail");
                //$send_to = 'ashraful@avantikain.com';
                $sub = "Quotation for Enquiry";
                $msgBody = "Please find the attachment below";
                sendmail($send_to, $sub, $msgBody, $pdfPath);
                unlink($pdfPath);*/
                $this->session->set_flashdata('message', 'Quotation has been sent successfully');
                $this->session->set_flashdata('type', 'success');
                redirect(site_url('admin/quotation'));
            } else {
                redirect(site_url('admin/quotation'));
            }
        }
    }//End of create_action_for_customer()
    /*public function generatePDFFile() {
    $data = array();
    $htmlContent='';
    $data['getInfo'] = $this->createpdf->getContent();
    $htmlContent = $this->load->view('pdf/file', $data, TRUE);
    $createPDFFile = time().'.pdf';
    $this->createPDF(ROOT_FILE_PATH.$createPDFFile, $htmlContent);
    redirect(HTTP_FILE_PATH.$createPDFFile);
    }
    public function createPDF($fileName,$html) {
    $this->load->view('quotation/quotation_view');
    }
     */
    /**
     * update
     *
     * @param mixed $id
     * @return void
     */
    public function update($id)
    {
        $row = $this->quotation_model->get_by_id($id);
        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('admin/quotation/update_action'),
                'id' => set_value('id', $row->id),
                'send_to' => set_value('send_to', $row->send_to),
                'product_price' => set_value('product_price', $row->product_price),
                'enquiry_id' => set_value('enquiry_id', $row->enquiry_id),
            );
            $this->load->view('admin/requires/header', array('title' => 'quotation'));
            $this->load->view('admin/quotation/quotation_form', $data);
            $this->load->view('admin/requires/footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/quotation'));
        }
    }
    /**
     * update_action
     *
     * @return void
     */
    public function update_action()
    {
        $this->_rules();
        if ($this->form_validation->run() == false) {
            $this->update($this->input->post('id', true));
        } else {
            $data = array(
                'send_to' => $this->input->post('send_to', true),
                'product_price' => $this->input->post('product_price', true),
                'enquiry_id' => $this->input->post('enquiry_id', true),
            );
            $this->quotation_model->update($this->input->post('id', true), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('admin/quotation'));
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
        $row = $this->quotation_model->get_by_id($id);
        if ($row) {
            $this->quotation_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('admin/quotation'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/quotation'));
        }
    }
    /**
     * _rules
     *
     * @return void
     */
    public function _rules()
    {
        $this->form_validation->set_rules('send_to', 'Customer', 'trim|required');
        $this->form_validation->set_rules('product_price[]', 'Product Price', 'trim|required');
        $this->form_validation->set_rules('frieght[]', 'Frieght', 'trim|required', array('required' => 'You must provide %s value.'));
        $this->form_validation->set_rules('id', 'id', 'trim');
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
            0 => "quotation_id",
            1 => "quotation_date",
            2 => "enquiry_id",
            3 => "status",
        );
        $limit = $this->input->post("length");
        $start = $this->input->post("start");
        $sl_no = $start + 1;
        $order = $columns[$this->input->post("order")[0]["column"]];
        $dir = $this->input->post("order")[0]["dir"];
        $totalData = $this->quotation_model->tot_rows();
        $totalFiltered = $totalData;
        if (empty($this->input->post("search")["value"])) {
            $records = $this->quotation_model->all_rows($limit, $start, $order, $dir);
        } else {
            $search = $this->input->post("search")["value"];
            $records = $this->quotation_model->search_rows($limit, $start, $search, $order, $dir);
            $totalFiltered = $this->quotation_model->tot_search_rows($search);
        } //End of if else
        $data = array();
        if ($records) {
            foreach ($records as $rows) {                
                $custRow = $this->customers_model->get_by_id($rows->customer_id);
                $custName = $custRow ? $custRow->name : "Not found";
                $viewBtn = anchor(site_url('admin/quotation/view_quotation/' . $rows->quotation_id), 'View', array('class' => 'btn btn-sm btn-primary')) . "&nbsp;";
                $editBtn = anchor(site_url('admin/quotation/send_quotation/' . $rows->quotation_id), 'Send', array('class' => 'btn btn-sm btn-warning')) . "&nbsp;";
                $nestedData["sl_no"] = $sl_no++;
                $nestedData["quotation_id"] = $rows->quotation_id;
                $nestedData["date"] = date("d-m-Y h:i A", strtotime($rows->quotation_date));
                $nestedData["customer_details"] = $custName;
                $nestedData["action"] = $viewBtn;
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
};
