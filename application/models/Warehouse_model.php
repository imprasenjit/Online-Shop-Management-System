<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Warehouse_model extends CI_Model
{

    public $table = 'warehouse_user';
    public $id = 'warehouse_user_id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }
	function login_process($username) {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where("username", $username);
        $this->db->where('status',"1");
        $query = $this->db->get();
        if($query->num_rows() == 1){
            return $query->row();
        } else {
            return false;
        }
    }
    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }
    function check_user_name($username)
    {
        $this->db->where("username", $username);
        $query=$this->db->get($this->table);
        if($query->num_rows() > 0){
            return TRUE;
        }else{
            return FALSE;
        }
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
        $this->db->like('', $keyword);
	$this->db->or_like('supplier_id', $keyword);
	$this->db->or_like('name', $keyword);
	$this->db->or_like('mobile', $keyword);
	$this->db->or_like('username', $keyword);
	$this->db->or_like('address', $keyword);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get search data with limit
    function search_index_limit($limit, $start = 0, $keyword = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('', $keyword);
	$this->db->or_like('supplier_id', $keyword);
	$this->db->or_like('name', $keyword);
	$this->db->or_like('mobile', $keyword);
	$this->db->or_like('username', $keyword);
	$this->db->or_like('address', $keyword);
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

    function search_rows($limit, $start, $keyword, $col, $dir){
        $this->db->select("*");
        $this->db->like($this->id, $keyword);
        $this->db->or_like('warehouse_user_id', $keyword);
        $this->db->or_like('mobile', $keyword);
        $this->db->or_like('name', $keyword);
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

    function tot_search_rows($keyword){
        $this->db->select("*");
        $this->db->like($this->id, $keyword);
        $this->db->or_like('warehouse_user_id', $keyword);
        $this->db->or_like('mobile', $keyword);
        $this->db->or_like('name', $keyword);
        $this->db->from($this->table);
          $this->db->where('status',"1");
        $query = $this->db->get();
        return $query->num_rows();
    }//End of tot_search_rows()
    public function add_dispatch_details($purchase_order_to_supplier_id,$data){
      $this->db->where("purchase_order_supplier_id",$purchase_order_to_supplier_id);
      $this->db->update("purchase_order_to_supplier",$data);
      return $this->db->affected_rows();
    }
    public function get_goods_dispatch_details($po_id){
      $this->db->select("dispatch_doc")
              ->from("purchase_order_to_supplier")
              ->where(array("purchase_order_supplier_id"=>$po_id,"status"=>"1"));
      return $this->db->get()->row();
    }

}


/* End of file Suppliers_model.php */
/* Location: ./application/models/Suppliers_model.php */
