<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Downloads_model extends CI_Model{
    public $table = 'downloads';
    public $id = 'download_id';
    public $order = 'DESC';
    function __construct(){
        parent::__construct();
    }
	
    function get_all() {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }
    
    function get_by_id($id){
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // insert data
    function insert($data){
        $this->db->insert($this->table, $data);
    }
    
    function update($id, $data){
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }//delete data
    
    function delete($id){
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }
    
    //For datatable    
    function tot_rows(){
        $this->db->select("*");
        $this->db->where('download_status', 1);
        $this->db->from($this->table);
        $query = $this->db->get(); 
        return $query->num_rows();
    }//End of tot_rows()
    
    function all_rows($limit, $start, $col, $dir){
        $this->db->select("*");
        $this->db->where('download_status', 1);
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
    
    function search_rows($limit, $start, $search, $col, $dir){
        $this->db->select("*");
        $this->db->where('download_status', 1);
        $this->db->like($this->id, $search);
        $this->db->or_like('download_title', $search);
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
    
    function tot_search_rows($search){
        $this->db->select("*");
        $this->db->where('download_status', 1);
        $this->db->like($this->id, $search);
        $this->db->or_like('download_title', $search);
        $this->db->from($this->table);
        $query = $this->db->get(); 
        return $query->num_rows();
    }//End of tot_search_rows()
}