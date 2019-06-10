<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Activity extends Aipl_admin
{
    function __construct()
    {
        parent::__construct();

        $this->load->model('useractivities_model');
        $this->load->library('breadcrumbs');
    }

    public function index()
    {
        $this->breadcrumbs->push('Dashboard', '/admin/dashboard');
        $this->breadcrumbs->push('Activity Log', '/admin/activity');
        $this->load->view('admin/requires/header',array('title'=>'Activity Log'));
        // $data['utype']=$this->session->issupplier
        $this->load->view('admin/activity_log');
        $this->load->view('admin/requires/footer');
    }
    function get_records() {
      $uid=$this->session->id;
      if($this->session->issupplier){
          $this->isSuppliersloggedin();
          $utype="supplier";
      }else if($this->session->iswarehouse){
          $this->isWarehouseLoggedIn();
          $utype="warehouse";
      }else{
          $this->isAdminloggedin();
        $utype="";
      }
        $columns = array(
            0 => "uid",
            1 => "activity",
            2 => "activity_time"
        );
        $limit = $this->input->post("length");
        $start = $this->input->post("start");
        $order = $columns[$this->input->post("order")[0]["column"]];
        $dir = $this->input->post("order")[0]["dir"];
        $totalData = $this->useractivities_model->tot_rows($utype,$uid);
        $totalFiltered = $totalData;
        if (empty($this->input->post("search")["value"])) {
            $records = $this->useractivities_model->all_rows($limit, $start, $order, $dir,$utype,$uid);
        } else {
            $search = $this->input->post("search")["value"];
            $records = $this->useractivities_model->search_rows($limit, $start, $search, $order, $dir,$utype,$uid);
            $totalFiltered = $this->useractivities_model->tot_search_rows($search,$utype,$uid);
        }//End of if else
        $data = array();
        if (!empty($records)) {
              $slno = 1;
            foreach ($records as $rows) {
                $id = $rows->uid;
                $activity = $rows->activity;
                $activity_time = $rows->activity_time;

                $nestedData["slno"] = $slno++;
                $nestedData["uid"] = $id;
                $nestedData["activity"] = $activity;
                $nestedData["activity_time"] = date_format(date_create($activity_time),'d M, Y H:i');
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

/* End of file Activity.php */
