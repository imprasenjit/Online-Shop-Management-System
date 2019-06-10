<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Byproducts_model extends CI_Model
{

    public $table = 'products';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }
	
	function get_all_by_subcategory($product_sub_category)
    {
        $this->db->where("product_sub_category", $product_sub_category);
		return $this->db->get($this->table)->result();
	
    }


    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
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
		$this->db->or_like('product_name', $keyword);
		$this->db->or_like('product_category', $keyword);
		$this->db->or_like('product_sub_category', $keyword);
		$this->db->or_like('description', $keyword);
		
		$this->db->or_like('product_price', $keyword);
		$this->db->or_like('picture', $keyword);
		$this->db->or_like('status', $keyword);
		$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get search data with limit
    function search_index_limit($limit, $start = 0, $keyword = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $keyword);
		$this->db->or_like('product_name', $keyword);
		$this->db->or_like('product_category', $keyword);
		$this->db->or_like('product_sub_category', $keyword);
		$this->db->or_like('description', $keyword);
		
		$this->db->or_like('product_price', $keyword);
		$this->db->or_like('picture', $keyword);
		$this->db->or_like('status', $keyword);
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

	function total_rows1() {
        $this->db->from($this->table);
		return $this->db->count_all_results();
    }

	
	function total_rows_ms_channel() {
        $this->db->from($this->table);
		return $this->db->count_all_results();
    }

    function index_limit_ms_angle($limit, $start = 0){
        $this->db->select("*");
        $this->db->from("products"); 
        $this->db->where("product_category", 1); 
        $this->db->where("product_sub_category", 1); 
		$this->db->limit($limit, $start);
        $query = $this->db->get();  
        if($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }//End of if else
    }

    function index_limit_ms_channel($limit, $start = 0) {
		
        $this->db->order_by($this->id, $this->order);
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }
	
	
	
}

/* End of file Byproducts_model.php */
/* Location: ./application/models/Byproducts_model.php */