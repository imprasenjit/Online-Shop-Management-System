<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class Proforma_invoice extends Aipl_admin
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
        $this->load->model('proforma_invoice_model');
        $this->load->model('products_model');
        $this->load->model('quotation_model');
        $this->load->model('enquires_model');
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
        $this->breadcrumbs->push('Purchase Invoice', '/admin/proforma_invoice');
        $this->load->view('admin/requires/header', array('title' => 'Proforma Invoice'));
        $this->load->view('admin/proforma_invoice/proforma_invoice_list');
        $this->load->view('admin/requires/footer');
    }
    /**
     * send_pi_to_customer
     *
     * @param mixed $purchase_order_id
     * @return void
     */
    public function send_pi_to_customer($purchase_order_id)
    {
        $this->breadcrumbs->push('Dashboard', '/admin/dashboard');
        $this->breadcrumbs->push('Proforma Invoice', '/admin/proforma_invoice');
        $this->breadcrumbs->push('New Proforma Invoice', '/admin/proforma_invoice/send_pi_to_customer');
        $this->load->library('email');
        $this->load->model("attribute_model");
        $this->load->model("purchase_order_model");
        $po = $this->purchase_order_model->get_by_id($purchase_order_id);
        $po_data = (array)$po;
        $data = array(
            'button' => 'Create',
            'action' => site_url('admin/proforma_invoice/create_action'),
            'id' => set_value('id'),
            'lot_no' => set_value('lot_no'),
            'editordata' => set_value('editordata'),
            'editordata2' => set_value('editordata2'),
            'purchase_order' => $po_data,
            'customer' => $this->customers_model->get_by_id($po_data["customer_id"]),
            'quotation_details' => $this->quotation_model->get_by_id($po_data["quotation_id"])
        );
        $this->load->view('admin/requires/header', array('title' => 'proforma_invoice'));
        $this->load->view('admin/proforma_invoice/proforma_invoice_form', $data);
        $this->load->view('admin/requires/footer');
    }
    /**
     * create_action
     *
     * @return void
     */
    public function create_action()
    {
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
        $products = json_encode($product_ids, TRUE);
        $product_quantity = json_encode($this->input->post('quantity', TRUE));
        $product_unit = json_encode($this->input->post('product_unit', TRUE));
        $product_attributes = json_encode($temp_array);
        $others = json_encode($this->input->post('others', TRUE));
        $enquiry_id = $this->input->post('enquiry_id', TRUE);
        $send_to = $this->input->post('send_to', TRUE);
        $editordata = $this->input->post('editordata', TRUE);
        $editordata2 = $this->input->post('editordata2', TRUE);
        $product_price = json_encode($this->input->post('product_price'));
        $tax_rate = json_encode($this->input->post('tax_rate', TRUE));
        $cgst = json_encode($this->input->post('cgst', TRUE));
        $sgst = json_encode($this->input->post('sgst', TRUE));
        $igst = json_encode($this->input->post('igst', TRUE));
        $exyard = json_encode($this->input->post('exyard', TRUE));
        $frieght = json_encode($this->input->post('frieght', TRUE));
        $total = json_encode($this->input->post('total_price', TRUE));
        $data = array(
            'purchase_order_id' => $this->input->post("potoadmin_id", TRUE),
            'purchase_order_ref' => $this->input->post("purchase_order_ref", TRUE),
            'quotation_id' => $this->input->post("quotation_id", TRUE),
            'quotation_ref' => $this->input->post("quotation_ref", TRUE),
            'customer_id' => $this->input->post("customer_id", TRUE),
            'pro_inv_no' => uniqid(),
            'products' => $products,
            'quantity' =>  $product_quantity,
            'product_unit' =>  $product_unit,
            'attributes' =>  $product_attributes,
            'others' =>  $others,
            'product_price' =>  $product_price,
            'tax_rate' =>  $tax_rate,
            'cgst' =>  $cgst,
            'sgst' =>  $sgst,
            'igst' =>  $igst,
            'exyard' =>  $exyard,
            'frieght' =>  $frieght,
            'total' =>  $total,
            'editordata' =>  $editordata,
            'editordata2' =>  $editordata2,
            'created_at' => date("Y-m-d H:i:s"),
            'created_by' => $this->session->userdata("id")
        );
        $proforma_invoice_id = $this->proforma_invoice_model->insert($data);
        if ($proforma_invoice_id) {
            $proforma_invoice_ref = genunqid(3, $proforma_invoice_id);
            $this->proforma_invoice_model->update($proforma_invoice_id, array("proforma_invoice_ref" => $proforma_invoice_ref));
            $data['row'] = $this->proforma_invoice_model->get_by_id($proforma_invoice_id);
            $this->load->view('admin/proforma_invoice/proforma_invoice_pdf', $data);
            $html = $this->output->get_output();
            $this->load->library('dompdflib');
            $this->dompdf->loadHtml($html);
            $this->dompdf->setPaper('A4', 'landscape');
            $this->dompdf->render();
            $output = $this->dompdf->output();
            $pdfName = time() . ".pdf";
            $pdfPath = 'storage/temps/' . $pdfName;
            file_put_contents($pdfPath, $output);
            $this->load->helper("sendmail");
            $sub = "Porforma Invoice";
            $msgBody = "Please find the attachment below";
            sendmail($send_to, $sub, $msgBody, $pdfPath);
            unlink($pdfPath);
            $this->session->set_flashdata('message', 'Proforma Invoice has been sent successfully');
            redirect(site_url('admin/proforma_invoice'));
        } else {
            redirect(site_url('admin/proforma_invoice'));
        } //End of if else
    }
    /**
     * view
     *
     * @param mixed $id
     * @return void
     */
    public function view($id)
    {
        $po = $this->proforma_invoice_model->get_by_id($id);
        $data = (array)$po;
        $this->breadcrumbs->push('Dashboard', '/admin/dashboard');
        $this->breadcrumbs->push('Purchase Invoice', '/admin/proforma_invoice');
        $this->breadcrumbs->push('Purchase Invoice View', '/admin/proforma_invoice/view');
        $this->load->view('admin/requires/header', array('title' => 'Proforma Invoice'));
        $this->load->view('admin/proforma_invoice/proforma_invoice_view', $data);
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
            0 => "porforma_invoice_id",
            1 => "customer_id",
            2 => "purchase_order_id",
            3 => "created_at"
        );
        $limit = $this->input->post("length");
        $start = $this->input->post("start");
        $sl_no = $start + 1;
        $order = $columns[$this->input->post("order")[0]["column"]];
        $dir = $this->input->post("order")[0]["dir"];
        $totalData = $this->proforma_invoice_model->tot_rows();
        $totalFiltered = $totalData;
        if (empty($this->input->post("search")["value"])) {
            $records = $this->proforma_invoice_model->all_rows($limit, $start, $order, $dir);
        } else {
            $search = $this->input->post("search")["value"];
            $records = $this->proforma_invoice_model->search_rows($limit, $start, $search, $order, $dir);
            $totalFiltered = $this->proforma_invoice_model->tot_search_rows($search);
        } //End of if else
        $data = array();
        if (!empty($records)) {
            foreach ($records as $rows) {
                $custName = $rows->name ? $rows->name : "Not found";
                $created_at = $rows->created_at;
                $viewBtn = anchor(site_url('admin/proforma_invoice/view/' . $rows->porforma_invoice_id), 'View', array('class' => 'btn btn-sm btn-primary')) . "&nbsp;";
                $editBtn = '<a href="#!" data-id="' . $rows->porforma_invoice_id . '" class="btn btn-sm btn-warning upload-invoice">Upload Invoice</a>&nbsp';
                $nestedData["sl_no"] = $sl_no++;
                $nestedData["proforma_invoice_ref"] = $rows->proforma_invoice_ref;
                $nestedData["customer"] = $custName;
                $nestedData["purchase_order_id"] = $rows->purchase_order_id;
                $nestedData["created_at"] = date("d-m-Y h:i A", strtotime($created_at));
                $nestedData["status"] = $viewBtn . $editBtn;
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

    public function upload_proforma_invoice()
    {
        $proforma_invoice_id = $this->input->post("proforma_invoice_id");
        $this->load->helper("fileupload");
        if ($this->input->post("upload_proforma_invoice")) {
            $invoice_doc = moveFile(0, $this->input->post("upload_proforma_invoice"), "proforma_invoice");
        }
        $data = array(
            "invoice" => $invoice_doc[0]
        );
        $this->proforma_invoice_model->update($proforma_invoice_id, $data);
        echo json_encode(array("x" => 1));
    }
};
