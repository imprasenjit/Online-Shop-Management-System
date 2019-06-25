<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Settings extends Aipl_admin
{
    function __construct()
    {
        parent::__construct();
        $this->isAdminloggedin();
        $this->load->library('breadcrumbs');
        $this->load->model('settings_model');
        $this->load->library('form_validation');
        $this->load->helper('fileUpload');
    }
    public function index()
    {
      $this->breadcrumbs->push('Dashboard', '/admin/dashboard');
      $this->breadcrumbs->push('Settings', '/admin/settings');
      $this->load->view('admin/requires/header', array('title' => 'Settings'));
      $this->load->view('admin/settings/settings_list');
      $this->load->view('admin/requires/footer');
    }



    public function create() {
        $row=$this->settings_model->settings();
        $data = array(
            'button' => 'update',
            'action' => site_url('admin/settings/create_action')
        );
        $data['sett_pdf_header']=array();
        $data['sett_pdf_footer']=array();
        $data['sett_color']=array();
        foreach ($row as $key => $value) {
        if($value->key=="PDF_HEADER"){
          $data['sett_pdf_header']=array("settings_id"=>$value->settings_id,"values"=>$value->values);
          // array_push();
        }elseif ($value->key=="PDF_FOOTER") {
          $data['sett_pdf_footer']=array("settings_id"=>$value->settings_id,"values"=>$value->values);
        }elseif($value->key=="COLOR") {
          $data['sett_color']=array("settings_id"=>$value->settings_id,"values"=>$value->values);
        }else {
          $data['sett_bank']=array("settings_id"=>$value->settings_id,"values"=>$value->values);
        }
        }
        $this->breadcrumbs->push('Dashboard', '/admin/dashboard');
        $this->breadcrumbs->push('Settings', '/admin/settings');
        $this->breadcrumbs->push('Update settings', '/admin/settings/create');
        $this->load->view('admin/requires/header', array('title' => 'Add settings'));
        $this->load->view('admin/settings/settings_form', $data);
        $this->load->view('admin/requires/footer');
    }

    public function create_action() {
      $data=array();
      $success=null;
      if ($this->input->post("upload_header_image")) {
          $picture = moveFile(2, $this->input->post("upload_header_image"), "header_image"); //var_dump($picture);die;
          // $data['key']="PDF_HEADER";
          $data['values']=$picture[0];
          $data['updated_at']=date("Y-m-d H:i:s");
          $success=$this->settings_model->update($this->input->post('header_setting_id'),$data);//var_dump($success);die;
          //unset($data);
      }
      if ($this->input->post("upload_footer_image")) {
          $picture = moveFile(2, $this->input->post("upload_footer_image"), "footer_image"); //var_dump($picture);die;
          // $data['key']="PDF_FOOTER";
          $data['values']=$picture[0];
          $data['updated_at']=date("Y-m-d H:i:s");
          $success=$this->settings_model->update($this->input->post('footer_setting_id'),$data);//var_dump($success);die;
        //  unset($data);
      }
      if($this->input->post("color_code")){
        $success=$this->settings_model->update($this->input->post('color_setting_id'),array('values'=>$this->input->post("color_code"),'updated_at'=>date("Y-m-d H:i:s")));
      }
      if($this->input->post("bank_details")){
        $success=$this->settings_model->update($this->input->post('bank_setting_id'),array('values'=>$this->input->post("bank_details"),'updated_at'=>date("Y-m-d H:i:s")));
      }
      //if($success){
        $this->session->set_flashdata('message', 'Successfully Settings Added');
        $this->session->set_flashdata('type', 'success');
      // }else {
      //   $this->session->set_flashdata('message', 'Something Went Wrong');
      //   $this->session->set_flashdata('type', 'warning');
      // }
      redirect(site_url('admin/settings'));
    }


    public function getSettings(){
      $customer_id=$this->session->userdata("id");

      $columns = array(
          1 => "key",
          2 => "value"
      );
        $limit = $this->input->post("length");
        $start = $this->input->post("start");
        $order = $columns[$this->input->post("order")[0]["column"]];
        $dir = $this->input->post("order")[0]["dir"];
        $totalData = $this->settings_model->tot_rows();
        $totalFiltered = $totalData;
        if (empty($this->input->post("search")["value"])) {
            $records = $this->settings_model->all_rows($limit, $start, $order, $dir);//var_dump($records);die;
        } else {
            $search = $this->input->post("search")["value"];
            $records = $this->settings_model->search_rows($limit, $start, $search, $order, $dir);
            $totalFiltered = $this->settings_model->tot_search_rows($search);
        }//End of if else
        $data = array();
        if (!empty($records)) {
              $slno = 1;
            foreach ($records as $rows) {
              $value="";
              $key="";
              if($rows->key =="PDF_HEADER"){
                $value="<img src=".base_url($rows->values)." width='50' height='50'>";
                $key="Header";
              }elseif ($rows->key =="PDF_FOOTER") {
                $value="<img src=".base_url($rows->values)." width='50' height='50'>";
                $key="Footer";
              }else {
                $value= $rows->values;
                $key="Color";
              }
                $viewBtn = anchor(site_url('admin/settings/view/' . $rows->settings_id), 'View', array('class' => 'btn btn-primary btn-sm')) . "&nbsp;";
                $nestedData["slno"] = $slno++;
                $nestedData["key"] = $key;
                $nestedData["value"] = $value;
                $nestedData["id"] = $viewBtn;
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
}
