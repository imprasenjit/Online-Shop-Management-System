<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Customer_registration_model extends CI_Model
{

    public $table = 'customer_registration';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }
	function checkuser($email) {
        $qry = $this->db->query("SELECT * FROM customer_registration where email='$email'");
        if ($qry->num_rows() > 0) {
            return FALSE;
        } else {
            return TRUE;
        }
    }
    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }
	
	 
	//count all existing customer
	function get_all_customerCount() {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
	
    function get_by_id1($id){
        $this->db->select("*");
        $this->db->where($this->id, $id);
        $this->db->from($this->table);
        $query = $this->db->get();
        if($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->row();
        }//End of if else
    }//End of get_name()
    
	function get_by_email($email)
    {
        $this->db->where("email", $email);
        return $this->db->get($this->table)->row();
    }
	
    // get total rows
    function total_rows() {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit
    function index_limit($limit, $start = 0) {
        $this->db->order_by($this->id, $this->order);
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }
    
    // get search total rows
    function search_total_rows($keyword = NULL) {
        $this->db->like('id', $keyword);
	$this->db->or_like('name', $keyword);
	$this->db->or_like('gst_no', $keyword);
	$this->db->or_like('pan_no', $keyword);
	$this->db->or_like('password', $keyword);
	$this->db->or_like('status', $keyword);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get search data with limit
    function search_index_limit($limit, $start = 0, $keyword = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $keyword);
		$this->db->or_like('name', $keyword);
		//$this->db->or_like('gst_no', $keyword);
		//$this->db->or_like('pan_no', $keyword);
		//$this->db->or_like('password', $keyword);
		//$this->db->or_like('status', $keyword);
		$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

	function get_customer_details($order_no=NULL) {
		$this->db->where("id", $order_no);
		$qry=$this->db->get("orders");
		if ($qry->num_rows() > 0) {
			foreach ($qry->result() as $row) {
			$cust_id = $row->customerid;
            echo "Customer ID - " .$cust_id;
		}
        } else {
                return NULL;
        }
        $this->db->where("id", $cust_id);
		$query=$this->db->get("customer_registration");
        if($query->num_rows() > 0){
			return $query->result();
		}else{
            return NULL;
        }
	}
	function get_orders_details($order_no=NULL) {
        
        //$order_no = $this->input->post('id');
        $this->db->where("id", $order_no);
		$query=$this->db->get("orders");
        if($query->num_rows() > 0){
			return $query->result();
		}else{
            return NULL;
        }
	}
	
	/*
	 function get_all_events()
    {
       
        return $this->db->get("events")->result();
    }
	function insert_events($data)
    {
        $this->db->insert('events', $data);
    }*/
}

/* End of file Customer_registration_model.php */
/* Location: ./application/models/Customer_registration_model.php */