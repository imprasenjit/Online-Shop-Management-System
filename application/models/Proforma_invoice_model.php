<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Proforma_invoice_model extends CI_Model
{

    public $table = 'proforma_invoice';
    public $id = 'porforma_invoice_id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }
    function total_rows_proforma_invoice_by_customer($customer_id){
        $this->db->where("customer_id",$customer_id);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
    function index_limit_proforma_invoice_by_customer($customer_id,$limit, $start = 0){
        $this->db->where("customer_id",$customer_id);
        $this->db->order_by($this->id, $this->order);
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }
    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }
	//count all quotation
	function get_all_quotationCount() {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

	//get quoted product details by id
	function get_quotation_by_id($id)
    {
        $this->db->where("enquiry_id", $id);
        return $this->db->get($this->table)->result();
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
		$this->db->or_like('send_to', $keyword);
		$this->db->or_like('product_price', $keyword);
		$this->db->or_like('send_from', $keyword);
		$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get search data with limit
    function search_index_limit($limit, $start = 0, $keyword = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $keyword);
		$this->db->or_like('send_to', $keyword);
		$this->db->or_like('product_price', $keyword);
		$this->db->or_like('send_from', $keyword);
		$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
	function insert($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
	//insert products
	function insert_products($productsdata)
    {
        $this->db->insert("proforma_invoice_products", $productsdata);

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
        $this->db->from("$this->table as pi");
        $this->db->join('customers as c','c.id=pi.customer_id','left');
        $this->db->where('pi.status','1');
        $this->db->group_by('pi.porforma_invoice_id');
        $query = $this->db->get();
        return $query->num_rows();
    }//End of tot_rows()

    function all_rows($limit, $start, $col, $dir){
        $this->db->select("*");
        $this->db->limit($limit, $start);
        $this->db->order_by($col, $dir);
        $this->db->from("$this->table as pi");
        $this->db->join('customers as c','c.id=pi.customer_id','left');
        $this->db->where('pi.status','1');
        $this->db->group_by('pi.porforma_invoice_id');
        $query = $this->db->get();
        if($query->num_rows() == 0) {
            return NULL;
        } else {
            return $query->result();
        }
    }//End of all_rows()

    function search_rows($limit, $start, $search, $col, $dir){
        $this->db->select("*");
        $this->db->like('c.name', $search);
        $this->db->limit($limit, $start);
        $this->db->order_by($col, $dir);
        $this->db->from("$this->table as pi");
        $this->db->join('customers as c','c.id=pi.customer_id','left');
        $this->db->where('pi.status','1');
        $this->db->group_by('pi.porforma_invoice_id');
        $query = $this->db->get();
        if($query->num_rows() == 0) {
            return NULL;
        } else {
            return $query->result();
        }
    }//End of search_rows()

    function tot_search_rows($search){
        $this->db->select("*");
        $this->db->like('c.name', $search);
        // $this->db->or_like('porforma_invoice_id', $search);
        // $this->db->or_like('created_at', $search);
        $this->db->from("$this->table as pi");
        $this->db->join('customers as c','c.id=pi.customer_id','left');
        $this->db->where('pi.status','1');
        $this->db->group_by('pi.porforma_invoice_id');
        $query = $this->db->get();
        return $query->num_rows();
    }//End of tot_search_rows()
// for front ent data table
function front_tot_rows($customer_id){
    $this->db->select("pi.*,pota.created_at as purchase_order_date");
    $this->db->from("$this->table as pi");
    $this->db->join('purchase_order_to_admin as pota','pota.potoadmin_id=pi.purchase_order_id','left');
    $this->db->where(array('pi.customer_id'=>$customer_id,'pi.status'=>"1"));
    $query = $this->db->get();
    return $query->num_rows();

}//End of tot_rows()

function front_all_rows($limit, $start, $col, $dir,$customer_id){
    $this->db->select("pi.*,pota.created_at as purchase_order_date");
    $this->db->from("$this->table as pi");
    $this->db->join('purchase_order_to_admin as pota','pota.potoadmin_id=pi.purchase_order_id','left');
    $this->db->where(array('pi.customer_id'=>$customer_id,'pi.status'=>"1"));
    $this->db->order_by($col, $dir);
    $this->db->limit($limit, $start);
    $query = $this->db->get();
    if($query->num_rows() == 0) {
        return NULL;
    } else {
        return $query->result();
    }
}//End of all_rows()

function front_search_rows($limit, $start, $keyword, $col, $dir,$customer_id){
    $this->db->select("pi.*,pota.created_at as purchase_order_date");
    $this->db->from("$this->table as pi");
    $this->db->join('purchase_order_to_admin as pota','pota.potoadmin_id=pi.purchase_order_id','left');
    $this->db->where(array('pi.customer_id'=>$customer_id,'pi.status'=>"1"));
    $this->db->like('pi.customer_id', $keyword);
    //$this->db->or_like('enquiry_placed_date', $keyword);
    $this->db->limit($limit, $start);
    $this->db->order_by($col, $dir);
    $query = $this->db->get();
    if($query->num_rows() == 0) {
        return NULL;
    } else {
        return $query->result();
    }
}//End of search_rows()

function front_tot_search_rows($keyword,$customer_id){
  $this->db->select("pi.*,pota.created_at as purchase_order_date");
  $this->db->from("$this->table as pi");
  $this->db->join('purchase_order_to_admin as pota','pota.potoadmin_id=pi.purchase_order_id','left');
  $this->db->where(array('pi.customer_id'=>$customer_id,'pi.status'=>"1"));
  $this->db->like('pi.customer_id', $keyword);
    //$this->db->or_like('enquiry_placed_date', $keyword);
    $query = $this->db->get();
    return $query->num_rows();

}//End of tot_search_rows()

}


