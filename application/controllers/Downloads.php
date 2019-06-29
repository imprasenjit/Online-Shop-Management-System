<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');
class Downloads extends MY_Controller {
    function __construct() {
        parent::__construct();
        $this->load->library('cart');
        $this->load->model('downloads_model');
    }

   
    function get_dtrecords() {
        $columns = array(
            0 => "download_id",
            1 => "download_title",
            2 => "download_description",
            3 => "download_file",
        );
        $limit = $this->input->post("length");
        $start = $this->input->post("start");
        $order = $columns[$this->input->post("order")[0]["column"]];
        $dir = $this->input->post("order")[0]["dir"];
        $totalData = $this->downloads_model->tot_rows();
        $totalFiltered = $totalData;
        if (empty($this->input->post("search")["value"])) {
            $records = $this->downloads_model->all_rows($limit, $start, $order, $dir);
        } else {
            $search = $this->input->post("search")["value"];
            $records = $this->downloads_model->search_rows($limit, $start, $search, $order, $dir);
            $totalFiltered = $this->downloads_model->tot_search_rows($search);
        } //End of if else
        $data = array();
        if (!empty($records)) {
            $slno = 1;
            foreach ($records as $rows) {
                $download_title = $rows->download_title;
                $download_description = $rows->download_description;
                $download_file = $rows->download_file;
                $download_id = $rows->download_id;

                $dBtn = '<a href="'.$download_file.'" class="btn btn-primary" target="_blank"><i class="fa fa-cloud-download"></i> Download</a>';
                $viewBtn = anchor($download_file, 'View File', array('class' => 'btn btn-primary btn-sm')) . "&nbsp;";
                $editBtn = anchor(site_url('admin/downloads/index/' . $download_id), 'Edit', array('class' => 'btn btn-sm btn-warning')) . "&nbsp;";
                $deleteBtn = anchor(site_url('admin/downloads/delete/' . $download_id), 'Delete', array('class' => 'btn btn-sm btn-danger', 'onclick' => 'return confirm(\'Are You Sure you want to delete?\')')) . "&nbsp;";
                
                $nestedData["download_id"] = $download_id;
                $nestedData["download_title"] = $download_title;
                $nestedData["download_description"] = $download_description;
                $nestedData["download_file"] = $dBtn;
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
    }//End of get_dtrecords()

}
