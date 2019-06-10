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
  public function isAdminloggedin($right = null)
  {
    if ($this->session->isadmin) {
      return true;
    } else {
      $this->session->set_flashdata("accessMsg", "Session has been Expired!");
      redirect(site_url("admin/login"), "refresh");
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
}
