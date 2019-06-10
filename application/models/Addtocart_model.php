<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Addtocart_model extends CI_Model
{

    public $table = 'add_to_cart';
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
		$this->db->or_like('item_id', $keyword);
		$this->db->or_like('item_name', $keyword);
		$this->db->or_like('item_size', $keyword);
		$this->db->or_like('item_qty', $keyword);
		$this->db->or_like('item_price', $keyword);
		$this->db->or_like('status', $keyword);
		$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get search data with limit
    function search_index_limit($limit, $start = 0, $keyword = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $keyword);
		$this->db->or_like('item_id', $keyword);
		$this->db->or_like('item_name', $keyword);
		$this->db->or_like('item_size', $keyword);
		$this->db->or_like('item_qty', $keyword);
		$this->db->or_like('item_price', $keyword);
		$this->db->or_like('status', $keyword);
		$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data,$item_id)
    {
		//$this->db->where($this->id, $item_id);
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

	/*function get_all_rows()
    {
		
		$this->db->where("status", '1');
		$query=$this->db->get("products");
        if($query->num_rows() > 0){
			return $query->result();
		}else{
            return NULL;
        }
    }*/
}

/* End of file Addtocart_model.php */
/* Location: ./application/models/Addtocart_model.php */