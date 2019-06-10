<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Sub_category_model extends CI_Model {

    public $table = 'product_sub_category';
    public $id = 'id';
    public $order = 'ASC';

    function __construct() {
        parent::__construct();
    }

    function get_subcategory_by_category($category) {
        $this->db->where('category', $category);
        $this->db->where('status', '1');
        return $this->db->get($this->table)->result();
    }

    // get all
    function get_all() {
        $this->db->order_by($this->id, $this->order);
        $this->db->where('status', '1');
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id) {
        $this->db->where('status','1');
        $this->db->where($this->id, $id);
        //echo $this->db->get_compiled_select($this->table);
        return $this->db->get($this->table)->row();
    }

    // get total rows
    function total_rows() {
        $this->db->where('status', '1');
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
        $this->db->or_like('category', $keyword);
        $this->db->or_like('sub_category', $keyword);
        $this->db->where('status', '1');
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get search data with limit
    function search_index_limit($limit, $start = 0, $keyword = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $keyword);
        $this->db->or_like('category', $keyword);
        $this->db->or_like('sub_category', $keyword);
        $this->db->where('status', '1');
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data) {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data) {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id) {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }
    
    //For datatable
    function tot_rows(){
        $this->db->select("*");
        $this->db->from($this->table);
        $this->db->where('status',"1");
        $query = $this->db->get();
        return $query->num_rows();
    }//End of tot_rows()

    function all_rows($limit, $start, $col, $dir){
        $this->db->select("*");
        $this->db->limit($limit, $start);
        $this->db->order_by($col, $dir);
        $this->db->from($this->table);
          $this->db->where('status',"1");
        $query = $this->db->get();
        if($query->num_rows() == 0) {
            return NULL;
        } else {
            return $query->result();
        }
    }//End of all_rows()

    function search_rows($limit, $start, $search, $col, $dir){
        $this->db->select("*");
        $this->db->like($this->id, $search);
        $this->db->or_like('category', $search);
        $this->db->or_like('sub_category', $search);
        $this->db->or_like('description', $search);
        $this->db->limit($limit, $start);
        $this->db->order_by($col, $dir);
        $this->db->from($this->table);
          $this->db->where('status',"1");
        $query = $this->db->get();
        if($query->num_rows() == 0) {
            return NULL;
        } else {
            return $query->result();
        }
    }//End of search_rows()

    function tot_search_rows($search){
        $this->db->select("*");
        $this->db->like($this->id, $search);
        $this->db->or_like('category', $search);
        $this->db->or_like('sub_category', $search);
        $this->db->or_like('description', $search);
        $this->db->from($this->table);
          $this->db->where('status',"1");
        $query = $this->db->get();
        return $query->num_rows();
    }//End of tot_search_rows()

}

