<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Attribute_model extends CI_Model
{

    public $table = 'attribute';
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
    function get_all_product_attribute($product_id)
    {
        $this->db->where("product_id", $product_id);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    function get_attribute_value($pid,$attr)
    {
		$this->db->distinct();
        $this->db->select("$attr as attr_value");
        $this->db->order_by("attribute_order","ASC");
        $this->db->where("product_id", $pid);
        return $this->db->get($this->table)->result();
    }
    // get total rows
    function total_rows() {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    function get_attribute_of_product($product_id)
    {
        $this->db->select("*");
        $this->db->where('product_id',$product_id);
        $this->db->order_by("attribute_order","ASC");
        $this->db->from($this->table);
        $query = $this->db->get(); 
        if($query->num_rows() == 0) {
            return NULL;
        } else {
            return $query->result();
        }
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
	$this->db->or_like('size', $keyword);
	$this->db->or_like('attr1', $keyword);
	$this->db->or_like('attr2', $keyword);
	$this->db->or_like('product_id', $keyword);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get search data with limit
    function search_index_limit($limit, $start = 0, $keyword = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $keyword);
	$this->db->or_like('size', $keyword);
	$this->db->or_like('attr1', $keyword);
	$this->db->or_like('attr2', $keyword);
	$this->db->or_like('product_id', $keyword);
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

	function getAttributesDetails() {
        $id = $this->input->post('id');
        $qry = $this->db->query("SELECT * FROM products WHERE id='$id'");
        
        if ($qry->num_rows() == 0) {
            echo "";
        } else {
            $row = $qry->row();
            echo $row->id;
        }
    }
    //For datatable    
    function tot_rows($product_id=NULL){
        $this->db->select("*");
        if($product_id!=NULL){
            $this->db->where('product_id',$product_id);
        }
        $this->db->from($this->table);
        $query = $this->db->get(); 
        return $query->num_rows();
    }//End of tot_rows()
    
    function all_rows($limit, $start, $col, $dir,$product_id=NULL){
        $this->db->select("*");
        $this->db->limit($limit, $start); 
        $this->db->order_by($col, $dir); 
        if($product_id!=NULL){
            $this->db->where('product_id',$product_id);
        }
        $this->db->from($this->table);
        $query = $this->db->get(); 
        if($query->num_rows() == 0) {
            return NULL;
        } else {
            return $query->result();
        }
    }//End of all_rows()
    
    function search_rows($limit, $start, $keyword, $col, $dir,$product_id=NULL){
        $this->db->select("*");
        $this->db->like($this->id, $keyword);
        $this->db->or_like('product_id', $keyword);
        $this->db->or_like('attr1', $keyword);
        if($product_id!=NULL){
            $this->db->where('product_id',$product_id);
        }
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
    
    function tot_search_rows($keyword,$product_id=NULL){
        $this->db->select("*");
        $this->db->like($this->id, $keyword);
        $this->db->or_like('product_id', $keyword);
        if($product_id!=NULL){
            $this->db->where('product_id',$product_id);
        }
        $this->db->or_like('attr1', $keyword);
        $this->db->from($this->table);
        $query = $this->db->get(); 
        return $query->num_rows();
    }//End of tot_search_rows()
}

/* End of file Attribute_model.php */
/* Location: ./application/models/Attribute_model.php */