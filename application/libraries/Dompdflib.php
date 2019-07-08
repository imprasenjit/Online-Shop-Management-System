<?php defined('BASEPATH') OR exit('No direct script access allowed');
use Dompdf\Dompdf;
class Dompdflib {
    public function __construct(){
        require_once APPPATH.'third_party/dompdf/autoload.inc.php';
        $pdf = new DOMPDF();
        $CI =& get_instance();
        $CI->dompdf = $pdf;
    }
}