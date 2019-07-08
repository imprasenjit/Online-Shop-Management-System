<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pdftest extends CI_Controller {
    
    function index() {
        $this->load->view('pdf_view');
        
        // Get output html
        $html = $this->output->get_output(); //echo $html; die();
        
        // Load pdf library
        $this->load->library('dompdflib');
        
        // Load HTML content
        $this->dompdf->loadHtml($html);
        
        // (Optional) Setup the paper size and orientation
        $this->dompdf->setPaper('A4', 'landscape');
        
        // Render the HTML as PDF
        $this->dompdf->render();
        
        // Output the generated PDF (1 = download and 0 = preview)
        $this->dompdf->stream("welcome.pdf", array("Attachment"=>0));
    }
    
    
    function pdf($id=4) { 
        $this->load->model('proforma_invoice_model');
        $this->load->model('products_model');
        $this->load->view('test_view');
        $html = $this->output->get_output();
        $this->load->library('dompdflib');
        $this->dompdf->loadHtml($html);
        $this->dompdf->setPaper('A4', 'landscape');
        $this->dompdf->render();
        //$this->dompdf->stream("welcome.pdf", array("Attachment"=>0));
        $output = $this->dompdf->output();
        $pdfName = time().".pdf";
        $pdfPath = 'storage/temps/'.$pdfName;
        file_put_contents($pdfPath, $output);
        
        $this->load->helper("sendmail");
        $send_to = 'ashraful@avantikain.com';
        $sub = "Pdf Mail test";
        $msgBody = "Please find the attachment";
        sendmail($send_to, $sub, $msgBody, $pdfPath);
        unlink($pdfPath);
        
    }
}