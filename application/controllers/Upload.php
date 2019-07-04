<?php
defined("BASEPATH") or exit("No direct script access allowed");
class Upload extends CI_Controller
{
    function index()
    {
        $this->load->helper("fileupload");
        $file = $this->input->post("file");
        fileupload($file);
    } //End of index()s
    public function genkey(Type $var = null)
    {
        $this->load->library('encryption');
        // $key = $this->encryption->create_key(16);
        //echo '<pre>';var_dump(bin2hex($key));
        $plain_text = 'This is a plain-text message!';
        $ciphertext = $this->encryption->encrypt($plain_text);
        echo $ciphertext;
        // Outputs: This is a plain-text message!
        // echo $this->encryption->decrypt($ciphertext);
    }
    public function getfile()
    {
        //print_r($_GET);die;
        if (!empty($_GET['req'])) {
            // check if user is logged
            if (!empty($this->session->userdata("is_loggedin"))) {
                $url = $_GET['req'];
                $ptype = 1; // tracking the type of file is being requested
                if (strpos($url, 'report_problem') !== false) {
                    $pdf_name = md5(time()) . '.png';
                    $ptype = 2;
                } elseif (strpos($url, 'Signature') !== false) {
                    $filename = "signature.zip";
                    $ptype = 3;
                } else {
                    $pdf_name = md5(time()) . '.pdf';
                }
                $pdf_file = $_SERVER['DOCUMENT_ROOT'] . $url;
                if (file_exists($pdf_file)) {
                    if ($ptype == 2) {
                        header('Content-Type: image/png');
                        echo file_get_contents($pdf_file);
                    } elseif ($ptype == 3) {
                        //echo $filename.'<br> '.$pdf_file; die;
                        header("Pragma: public");
                        header("Expires: 0");
                        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                        header("Cache-Control: public");
                        header("Content-Description: File Transfer");
                        header("Content-type: application/octet-stream");
                        header("Content-Disposition: attachment; filename=\"" . $filename . "\"");
                        header("Content-Transfer-Encoding: binary");
                        header("Content-Length: " . filesize($pdf_file));
                        ob_end_flush();
                        @readfile($pdf_file);
                    } else {
                        header('Content-Type: application/pdf');
                        echo file_get_contents($pdf_file);
                    }
                    //echo file_get_contents($pdf_file);
                } else {
                    redirect(base_url());
                }
            } else {
                redirect(base_url());
            }
        }
    }
}//End of Upload
