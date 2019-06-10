<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login_model extends CI_Model {

    public $table = 'admin_login';
    public $id = 'id';
    public $order = 'DESC';

    function __construct() {
        parent::__construct();
    }

    function process($username) {
        $this->db->select('*');
        $this->db->from('admin_login');
        $this->db->where("username", $username);
        //$this->db->where("password", $password);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            return false;
        }
    }

// End of process()

    function login_process($email) {
        $this->db->select('*');

        $this->db->where("email", $email);
        $this->db->from('customers');
        $query = $this->db->get();
        //print_r($query);
        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            return false;
        }
    }
    
    function mobile_login($mobnum) {
        $this->db->select('*');
        $this->db->where("contact", $mobnum);
        $this->db->from('customers');
        $this->db->order_by('contact', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            return false;
        }//End of if else
    }//End of mobile_login

    function get_by_id($id) {
        $this->db->where($this->id, $id);
        return $this->db->get("admin_login")->row();
    }

    function update($id, $data) {
        $this->db->where($this->id, $id);
        $this->db->update("admin_login", $data);
    }

}
