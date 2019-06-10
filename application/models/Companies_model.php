<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Companies_model extends CI_Model{
    public $smetbl = 'companies';
    public $smeid = 'company_id';
    public $order = 'DESC';
    function __construct(){
        parent::__construct();
    }
	
    function get_all() {
        $this->db->order_by($this->smeid, $this->order);
        return $this->db->get($this->smetbl)->result();
    }
    
    function get_by_id($id){
        $this->db->where($this->smeid, $id);
        return $this->db->get($this->smetbl)->row();
    }
    // insert data
    function insert($data){
        $this->db->insert($this->smetbl, $data);
    }
    function update($id, $data){
        $this->db->where($this->smeid, $id);
        $this->db->update($this->smetbl, $data);
    }
    // delete data
    function delete($id){
        $this->db->where($this->smeid, $id);
        $this->db->delete($this->smetbl);
    }
    
    //For datasmetbl    
    function tot_rows(){
        $this->db->select("*");
        $this->db->from($this->smetbl);
        $query = $this->db->get(); 
        return $query->num_rows();
    }//End of tot_rows()
    
    function all_rows($limit, $start, $col, $dir){
        $this->db->select("*");
        $this->db->limit($limit, $start); 
        $this->db->order_by($col, $dir); 
        $this->db->from($this->smetbl);
        $query = $this->db->get(); 
        if($query->num_rows() == 0) {
            return NULL;
        } else {
            return $query->result();
        }
    }//End of all_rows()
    
    function search_rows($limit, $start, $search, $col, $dir){
        $this->db->select("*");
        $this->db->like($this->smeid, $search);
        $this->db->or_like('company_name', $search);
        $this->db->or_like('contact_person', $search);
        $this->db->or_like('conatct_no', $search);
        $this->db->limit($limit, $start); 
        $this->db->order_by($col, $dir); 
        $this->db->from($this->smetbl);
        $query = $this->db->get(); 
        if($query->num_rows() == 0) {
            return NULL;
        } else {
            return $query->result();
        }
    }//End of search_rows()
    
    function tot_search_rows($search){
        $this->db->select("*");
        $this->db->like($this->smeid, $search);
        $this->db->or_like('company_name', $search);
        $this->db->or_like('contact_person', $search);
        $this->db->or_like('conatct_no', $search);
        $this->db->from($this->smetbl);
        $query = $this->db->get(); 
        return $query->num_rows();
    }//End of tot_search_rows()
}