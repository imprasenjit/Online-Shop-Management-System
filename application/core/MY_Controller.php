<?php
class MY_Controller extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
  } //End of __construct()
} //End of MY_Controller
class Aipl_admin extends MY_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('roles_model');
  }
  public function pr($arr)
  {
    echo '<pre>';
    print_r($arr);die;
  }
  public function pro()
  {
    $sections = array(
      'config'  => TRUE,
      'queries' => TRUE
    );
    $this->output->set_profiler_sections($sections);
    $this->output->enable_profiler(TRUE);
  }
  public function isAdminloggedin()
  {
    if ($this->session->isadmin) {
      $access=$this->check_rights();
      if($access){
        return true;
      }else {
        $this->add_controllers();
        $this->session->set_flashdata("message", "Access Denied! Please contact administrator");
        $this->session->set_flashdata('type', 'danger');
        redirect(site_url("admin/dashboard"), "refresh");
      }

    } else {
      $this->session->set_flashdata("message", "Session has been Expired!");
      $this->session->set_flashdata('type', 'danger');
      redirect(site_url("admin/login"), "refresh");
    }
  }
  public function check_rights(){
    // var_dump($this->session-);die;
    if($this->session->role_id=="1"){
      return true;
    }
    if($this->router->class =="dashboard" && $this->router->method=="index"){
      return true;
    }
    $access=false;
    $user_rights=$this->session->rights;
    foreach ($user_rights as $key => $value) {
      if($value->controller_name == $this->router->class && $value->method_name==$this->router->method){
        $access=true;
      }
    }
    return $access;

  }
  public function add_controllers(){
    $cn=$this->router->class;
    $mn=$this->router->method;
    $checkController=$this->roles_model->check_exist_controller($cn,$mn);
    if($checkController){
      $data_to_save=array("controller_name"=>$cn,"method_name"=>$mn,"display_name"=>$cn."/".$mn);
      $this->roles_model->add_controllers($data_to_save);
    }


  }
  public function isSuppliersloggedin($right = null)
  {
    if ($this->session->issupplier) {
      return true;
    } else {
      $this->session->set_flashdata("accessMsg", "Session has been Expired!");
      redirect(site_url(), "refresh");
    }
  }
  public function isWarehouseLoggedIn($right = null)
  {
    if ($this->session->iswarehouse) {
      return true;
    } else {
      $this->session->set_flashdata("accessMsg", "Session has been Expired!");
      redirect(site_url(), "refresh");
    }
  }
  public function isUserloggedin($right = null)
  {
    if ($this->session->isuser) {
      return true;
    } else {
      $this->session->set_flashdata("accessMsg", "Session has been Expired!");
      redirect(site_url(), "refresh");
    }
  }
  public function check_post()
  {
    if ($this->input->server('REQUEST_METHOD') == 'POST') {
      return true;
    } else {
      return false;
    }
  }
  public function generate_unique_id($slug,$id,$date){
  //  var_dump(date_f('')$date);die;
    $date=date_create($date);
    $formated_date=date_format($date,"Y");
    $financial_year=$this->get_financial_year($formated_date);
    return $slug.$financial_year."-".$id;
  }
  public function get_financial_year($year){
    $financial_year="";
    if ( date('m') >= 3 ) {
      $current_year = date('y') + 1;
      $financial_year=$year."".$current_year;
    }
    else {
      $pre_year = date('Y')-1;
      $financial_year=$pre_year."".substr($year,-2);
    }
    return $financial_year;
  }
}
