<?php
defined("BASEPATH") OR exit("No direct script access allowed");
class Test extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->model('proforma_invoice_model');
        $this->load->model('products_model');
        $this->load->library('Tcpdflib');
    }
            
    function index() {
        $html = '<table><tbody><tr><td>Test One</td></tr><tr><td>Test Two</td></tr><tbody></table>';
        $pdf = new Tcpdflib('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetTitle('Test PDF');
        $pdf->AddPage(); 
        $pdf->writeHTML(utf8_encode($html), true, false, true, false, '');
        $pdf->Output('MyFileName.pdf', 'I');
    }//End of index()
    
    function hi() {
        $this->load->view('test_view');
    }//End of hi()
    
    function pdf($id=4) { 
        //$this->load->view('test_view');
        $html = $this->load->view('test_view', '', true);        
        $pdf = new Tcpdflib('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetTitle('Test PDF');
        $pdf->AddPage(); 
        $pdf->writeHTML(utf8_encode($html), true, false, true, false, '');
        $pdf->Output('MyFileName.pdf', 'I');
    }
    
    function mpdftest() {
        $html = '<table><tbody><tr><td>Test One</td></tr><tr><td>Test Two</td></tr><tbody></table>';
        $pdfFilePath ="test.pdf";
        $this->load->library("m_pdf"); 
        $this->m_pdf->pdf->WriteHTML($html);
        $this->m_pdf->pdf->Output($pdfFilePath, "I");
    }//End of index()
    
    function mpdf($id=4) {
        //$this->load->view('test_view');
        $html = $this->load->view('test_view', '', true);        
        $pdf = new Tcpdflib('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetTitle('Test PDF');
        $pdf->AddPage(); 
        $pdf->writeHTML(utf8_encode($html), true, false, true, false, '');
        $pdf->Output('MyFileName.pdf', 'I');
        
        $html=$this->load->view("admin/checkout_pdf_view", $data, true);
        $pdfFilePath ="public/bills/".$checkout_id.".pdf";
        $this->load->library("m_pdf"); 
        $this->m_pdf->pdf->WriteHTML($html);
        $this->m_pdf->pdf->Output($pdfFilePath, "F");
        $bill_pdf=base_url().$pdfFilePath;
    }
}//End of Test