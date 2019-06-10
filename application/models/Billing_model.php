<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Billing_model extends CI_Model {
    public $table = 'products';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

     // Get all details ehich store in "products" table in database.
    function get_all($limit, $start = 0)
	{
		$this->db->order_by($this->id, $this->order);
		$this->db->limit($limit, $start);
        return $this->db->get('products')->result_array();
		
		//$query = $this->db->get('products');
		//var_dump($query); die();
		//return $query->result_array();
	}
    
	
	
	// Insert customer details in "customer" table in database.
	public function insert_enquiry($data)
	{
		$this->db->insert('enquires', $data);
		$id = $this->db->insert_id();
		return (isset($id)) ? $id : FALSE;		
	}
	
    
	/*
	public function insert_customer_reg($data)
	{
		$this->db->insert('customer', $data);
		$id = $this->db->insert_id();
		return (isset($id)) ? $id : FALSE;	
	}
	// Insert order date with customer id in "enquires" table in database.
	public function insert_order($data)
	{
		$this->db->insert('enquires', $data);
		$id = $this->db->insert_id();
		return (isset($id)) ? $id : FALSE;
	}*/
	
    // Insert ordered product detail in "order_detail" table in database.
	public function insert_order_detail($data)
	{
		$this->db->insert('enquiry_detail', $data);
		//$id = $this->db->insert_id();
		//return (isset($id)) ? $id : FALSE;
	}
       
}