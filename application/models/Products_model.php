<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Products_model extends CI_Model
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
	//count all products
	function get_all_productsCount() {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
	function get_all_by_id($id)
	{
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->result();
    }
    function get_by_id_ms_channel($id)
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
    
	//start structural steel function
	function total_rows1() {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    
    function index_limit1($limit, $start = 0) {
        $this->db->order_by($this->id, $this->order);
        $this->db->limit($limit, $start);
		$this->db->where("product_category", '1');
		$this->db->where("product_sub_category", '1');
        return $this->db->get($this->table)->result();
    }
	
	//end structural steel function
	
    // get search total rows
    function search_total_rows($keyword = NULL) {
        $this->db->like('id', $keyword);
		$this->db->or_like('product_name', $keyword);
		//$this->db->or_like('product_len', $keyword);
		$this->db->or_like('product_price', $keyword);
		$this->db->or_like('status', $keyword);
		$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get search data with limit
    function search_index_limit($limit, $start = 0, $keyword = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $keyword);
		$this->db->or_like('product_name', $keyword);
		//$this->db->or_like('product_len', $keyword);
		$this->db->or_like('product_price', $keyword);
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
	
	function filter_rows($limit, $start = 0, $size = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->limit($limit, $start);
		//$this->db->where('product_len', $size);
        return $this->db->get($this->table)->result();
    }
	function get_all_attributes()
	{
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }
    
    
    //For datatable    
    function tot_rows(){
        $this->db->select("*");
        $this->db->from($this->table);
        $query = $this->db->get(); 
        return $query->num_rows();
    }//End of tot_rows()
    
    function all_rows($limit, $start, $col, $dir){
        $this->db->select("*");
        $this->db->limit($limit, $start); 
        $this->db->order_by($col, $dir); 
        $this->db->from($this->table);
        $query = $this->db->get(); 
        if($query->num_rows() == 0) {
            return NULL;
        } else {
            return $query->result();
        }
    }//End of all_rows()
    
    function search_rows($limit, $start, $keyword, $col, $dir){
        $this->db->select("*");
        $this->db->like($this->id, $keyword);
        $this->db->or_like('product_name', $keyword);
        $this->db->or_like('description', $keyword);
        $this->db->or_like('picture', $keyword);
        $this->db->limit($limit, $start); 
        $this->db->order_by($col, $dir); 
        $this->db->from($this->table);
        $query = $this->db->get(); 
        if($query->num_rows() == 0) {
            return NULL;
        } else {
            return $query->result();
        }
    }//End of search_rows()
    
    function tot_search_rows($keyword){
        $this->db->select("*");
        $this->db->like($this->id, $keyword);
        $this->db->or_like('product_name', $keyword);
        $this->db->or_like('description', $keyword);
        $this->db->or_like('picture', $keyword);
        $this->db->from($this->table);
        $query = $this->db->get(); 
        return $query->num_rows();
    }//End of tot_search_rows()
	
}
/* End of file Products_model.php */
/* Location: ./application/models/Products_model.php */