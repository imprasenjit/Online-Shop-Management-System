<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Login extends Aipl_admin
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('login_model');
        $this->load->model('suppliers_model');
        $this->load->model('warehouse_model');
        $this->load->model("useractivities_model");
        $this->load->library('form_validation');
        $this->load->helper('cookie');
        $this->load->library('encryption');

    }
    public function index()
    {
       $data=array();
       $data['username']='';
       if($this->input->cookie('usertype',true)=="admin"){
         $data['name']=$this->encryption->decrypt($this->input->cookie('uname',true));
         $data['username']=$this->encryption->decrypt($this->input->cookie('username',true));
       }
       //$this->session->sess_destroy();
       $this->load->view('admin/login',$data);
    }
    public function profile(){
  //
      $user=$this->session->userdata();
      if(isset($user['isadmin']) && $user['isadmin']){
        $row = $this->login_model->get_by_id($user['id']);
      }elseif (isset($user['issupplier']) && $user['issupplier']) {
        $row = $this->suppliers_model->get_by_id($user['id']);
      }else {
        $row = $this->warehouse_model->get_by_id($user['id']);
      }

      if ($row) {
          $data['logged_data'] = $row;
          $this->load->view('admin/requires/header',array("title"=>"Admin"));
          $this->load->view('admin/profile', $data);
          $this->load->view('admin/requires/footer');
        } else {
          $this->session->set_flashdata('flashMsg', 'Record Not Found');
          redirect(site_url('admin/dashboard'));
        }
    }

    public function change_password(){
  		// $data = array('username' => set_value('username', $row->username));
  		$this->load->view('admin/requires/header',array("title"=>"Change Password"));
  		$this->load->view('admin/change_password');
  		$this->load->view('admin/requires/footer');
  	}

  	function savepass() {
  			 $this->load->library("form_validation");
  			 $this->form_validation->set_rules("pass_current", "Current Pasword", "required");
  			 $this->form_validation->set_rules("pass_new", "New Pasword", "required|min_length[4]");
  			 $this->form_validation->set_rules("pass_conf", "Confirmation Password", "required|matches[pass_new]");
  			 $this->form_validation->set_error_delimiters("<font class='error animated fadeIn'>", "</font>");

  			 if ($this->form_validation->run() == FALSE) {
  					 $this->session->set_flashdata("errorMsg", "Input(s) field cannot be empty!");
  					 $this->change_password();
  			 } else {
  				 $uid = $this->session->id;
           if(isset($this->session->isadmin) && $this->session->isadmin){
             $user = $this->login_model->get_by_id($uid);
             $goto_url=site_url('admin/dashboard');
           }else if(isset($this->session->issupplier) && $this->session->issupplier){
             $user = $this->suppliers_model->get_by_id($uid);
             $goto_url=site_url('admin/suppliers/dashboard');
           }else {
             $user = $this->warehouse_model->get_by_id($uid);
             $goto_url=site_url('admin/warehouse/dashboard');
           }

  				 $userOldPass=$user->password;

  				 $current_pass = $this->security->xss_clean($this->input->post("pass_current"));
  				 // if ( MD5($current_pass) == $userOldPass) {//
           if (crypt($current_pass, $userOldPass) == $userOldPass) {
           $pass = $this->input->post("pass_new");
           $salt = uniqid("", true);
           $algo = "6";
           $rounds = "5050";
           $cryptSalt = '$' . $algo . '$rounds=' . $rounds . '$' . $salt;
           $hashedPassword = crypt($pass, $cryptSalt);

           if(isset($this->session->isadmin) && $this->session->isadmin){
             $this->login_model->update($uid, array('password'=>MD5($pass)));
           }else if(isset($this->session->issupplier) && $this->session->issupplier){
             $this->suppliers_model->update($uid, array('password'=>$hashedPassword));
           }else {
              $this->warehouse_model->update($uid, array('password'=>$hashedPassword));
           }

  					 $this->session->set_flashdata("message", "Successfully password updated!! ");
  					 $this->session->set_flashdata("type", "success");
             redirect($goto_url);

  				 }else {
  					 $this->session->set_flashdata("message", "Wrong password you have entered");
  					 $this->session->set_flashdata("type", "danger");
  					 $this->change_password();

  				 }


  			 }//End of if esle
  	 }//End of savepass()

    public function supplier()
    {
      $data=array();
      $data['username']='';
      if($this->input->cookie('usertype',true)=="supplier"){
        $data['name']=$this->encryption->decrypt($this->input->cookie('uname',true));
        $data['username']=$this->encryption->decrypt($this->input->cookie('username',true));
      }

        $this->session->sess_destroy();
        $this->load->view("admin/suppliers/login",$data);
    }
    public function warehouse()
    {
      $data=array();
      $data['username']='';
      if($this->input->cookie('usertype',true)=="warehouse"){
        $data['name']=$this->encryption->decrypt($this->input->cookie('uname',true));
        $data['username']=$this->encryption->decrypt($this->input->cookie('username',true));
      }
        $this->session->sess_destroy();
        $this->load->view("admin/warehouse/login",$data);
    }
    public function supplier_login_process()
    {

        $username = $this->security->xss_clean($this->input->post("username"));
        $password = $this->security->xss_clean($this->input->post("password"));
        $usr = $this->suppliers_model->login_process($username);
        if ($usr) {
            if (crypt($password, $usr->password) == $usr->password) {
                $mobile = $usr->mobile;
                $name = $usr->name;
                $username = $usr->username;
                $id = $usr->supplier_id;
                $data = array(
                    "username" => $username,
                    "name" => $name,
                    "mobile" => $mobile,
                    "id" => $id,
                    "login" => true,
                    "issupplier" => true
                );
                $this->session->set_userdata($data);

                //setting cookie data
                $this->input->set_cookie(array('name' => 'uname','value'=>$this->encryption->encrypt($name),'expire'=>'86500'));
                $this->input->set_cookie(array('name' => 'username','value'=>$this->encryption->encrypt($username),'expire'=>'86500'));
                $this->input->set_cookie(array('name' => 'usertype','value'=>'supplier','expire'=>'86500'));

                $this->useractivities_model->add_row(array("activity_time"=>date("Y-m-d H:i:s"), "uid"=>$id, "activity"=>"Sign in",'utype'=>'supplier'));
                $data["login"] = true;
                $data["message"] = "Login Successfull. Please wait.";
            } else {
                $data["login"] = false;
                $data["message"] = "Invalid Login.";
            }
        } else {
            $data["login"] = false;
            $data["message"] = "Invalid Login.";
        }
        echo json_encode($data);
    }
    public function warehouse_login_process()
    {

        $username = $this->security->xss_clean($this->input->post("username"));
        $password = $this->security->xss_clean($this->input->post("password"));
        $usr = $this->warehouse_model->login_process($username);
        if ($usr) {
            if (crypt($password, $usr->password) == $usr->password) {
                $mobile = $usr->mobile;
                $name = $usr->name;
                $username = $usr->username;
                $id = $usr->warehouse_user_id;
                $data = array(
                    "username" => $username,
                    "name" => $name,
                    "mobile" => $mobile,
                    "id" => $id,
                    "login" => true,
                    "iswarehouse" => true
                );
                $this->session->set_userdata($data);
                //setting cookie data
                $this->input->set_cookie(array('name' => 'uname','value'=>$this->encryption->encrypt($name),'expire'=>'86500'));
                $this->input->set_cookie(array('name' => 'username','value'=>$this->encryption->encrypt($username),'expire'=>'86500'));
                $this->input->set_cookie(array('name' => 'usertype','value'=>'warehouse','expire'=>'86500'));
                $data["login"] = true;
                $this->useractivities_model->add_row(array("activity_time"=>date("Y-m-d H:i:s"), "uid"=>$id, "activity"=>"Sign in",'utype'=>'warehouse'));
                $data["message"] = "Login Successfull. Please wait.";
            } else {
                $data["login"] = false;
                $data["message"] = "Invalid Login.";
            }
        } else {
            $data["login"] = false;
            $data["message"] = "Invalid Login.";
        }
        echo json_encode($data);
    }

	public function process(){

        $this->load->library("form_validation");
        $this->form_validation->set_rules("username", "Username", "required");
        $this->form_validation->set_rules("password", "Password", "required");
        $this->form_validation->set_error_delimiters("<font class='animated fadeIn' style='color: #d43f3a'>", "</font>");
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', 'Invalid/Empty Input fields!');
            $this->index();
        } else {
            $username = $this->security->xss_clean($this->input->post("username"));
            $password = $this->security->xss_clean($this->input->post("password"));
            $this->load->model("login_model");
            $admin=$this->login_model->process($username);
              if (crypt($password, $admin->password) == $admin->password) {
                $id = $admin->id;
                $username = $admin->username;
                $name = $admin->name;
                $password = $admin->password;
                $data = array(
                    "username" => $username,
                    "id" => $id,
            				"status" => "1",
                    "login" => true,
                    "isadmin" => true
                );

                //setting cookie data


                $this->input->set_cookie(array('name' => 'uname','value'=>$this->encryption->encrypt($name),'expire'=>'86500'));
                $this->input->set_cookie(array('name' => 'username','value'=>$this->encryption->encrypt($username),'expire'=>'86500'));
                $this->input->set_cookie(array('name' => 'usertype','value'=>'admin','expire'=>'86500'));



    			      $this->session->set_userdata($data);
                $this->useractivities_model->add_row(array("activity_time"=>date("Y-m-d H:i:s"), "uid"=>$admin->id, "activity"=>"Sign in",'utype'=>'admin'));
                $data["login"] = true;
                $data["message"] = "Login Successfull. Please wait.";
              }else {
                $data["login"] = false;
                $data["message"] = "Invalid Login.";
            }
        }
        echo json_encode($data);
    } // End of process()
	public function logout(){
        $data=array("activity_time"=>date("Y-m-d H:i:s"), "uid"=>$this->session->userdata['id'], "activity"=>"Sign out");
        if($this->session->issupplier){
            $data['utype']="supplier";
            $goto_url="admin/login/supplier";
        }else if($this->session->iswarehouse){
            $data['utype']="warehouse";
            $goto_url="admin/login/warehouse";
        }else{
          $data['utype']="admin";
            $goto_url="admin/login/";
        }
        $this->useractivities_model->add_row($data);
        $this->session->sess_destroy();
        session_write_close();
        redirect(site_url($goto_url));
    }
}
/* End of file Login.php */
/* Location: ./application/controllers/Login.php */
