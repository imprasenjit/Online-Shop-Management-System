<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Purchase_order_model extends CI_Model
{
    function get_by_id($id){
        $this->db->select('*');
        $this->db->where("potoadmin_id",$id);
        $this->db->from("purchase_order_to_admin");
        return $this->db->get()->row();
    }
    function get_by_id_purchase_order_to_supplier($id){
        $this->db->select('*');
        $this->db->where("purchase_order_supplier_id",$id);
        $this->db->from("purchase_order_to_supplier");
        return $this->db->get()->row();
    }
    function update($id,$data){
        $this->db->where("potoadmin_id",$id);
        $this->db->update("purchase_order_to_admin",$data);
    }
    function update_purchase_order_to_supplier($id,$data){
        $this->db->where("purchase_order_supplier_id",$id);
        $this->db->update("purchase_order_to_supplier",$data);
    }
    function check_purchase_order($quotation_id){
        $this->db->select('*');
        $this->db->where("quotation_id",$quotation_id);
        $this->db->where("order_status",1);
        $this->db->from("purchase_order_to_admin");
        $result=$this->db->get();
        if($result->num_rows() > 0){
            return $result->row();
        }else{
            return FALSE;
        }

    }
    function insert_purchase_order_to_supplier($data){
        $this->db->insert("purchase_order_to_supplier", $data);
        return $this->db->insert_id();
    }

    function insert_purchse_order_to_warehouse(){
        $this->db->insert("purchase_order_to_warehouse", $data);
        return $this->db->insert_id();
    }

    function total_rows_purchase_order(){
        $this->db->select('*');
        $this->db->from("purchase_order_to_admin");
        return $this->db->count_all_results();
    }// get total rows

    function total_rows_purchase_order_to_warehouse(){
        $this->db->select('*');
        $this->db->where("send_to_warehouse_status",1);
        $this->db->from("purchase_order_to_supplier");
        return $this->db->count_all_results();
    }// get total rows

    function index_limit_purchase_order_to_warehouse($limit, $start, $keyword=NULL, $col, $dir,$warehouse_id=NULL)
    {
        $this->db->select('*');
        $this->db->where("send_to_warehouse_status",1);
        $this->db->where('warehouse_user_id', $warehouse_id);
        $this->db->limit($limit, $start);
        $this->db->order_by($col, $dir);
        $this->db->from("purchase_order_to_supplier");
        $query = $this->db->get();

        if($query->num_rows() == 0) {
            return NULL;
        } else {
            return $query->result();
        }
    }
    function index_limit_purchase_order($limit, $start = 0)
    {
        $this->db->select('*');
        $this->db->from("purchase_order_to_admin");
        $this->db->order_by("potoadmin_id","DESC");
        $this->db->limit($limit, $start);
        return $this->db->get()->result();
    }
    function total_rows_purchase_order_by_customer($customer_id){
        $this->db->select('*');
        $this->db->where("customer_id",$customer_id);
        $this->db->from("purchase_order_to_admin");
        return $this->db->count_all_results();
    }// get total rows

    function index_limit_purchase_order_by_customer($customer_id,$limit, $start = 0)
    {
        $this->db->select('*');
        $this->db->where("customer_id",$customer_id);
        $this->db->from("purchase_order_to_admin");
        $this->db->order_by("potoadmin_id","DESC");
        $this->db->limit($limit, $start);
        return $this->db->get()->result();
    }
    // get search total rows


    //For datatable
    function tot_rows(){
        $this->db->select("*");
        $this->db->from("purchase_order_to_admin as pota");
        $this->db->join('customers as c','pota.customer_id=c.id','left');
        $this->db->where("pota.status","1");
        $this->db->group_by('pota.potoadmin_id');
        $query = $this->db->get();
        return $query->num_rows();
    }//End of tot_rows()

    function all_rows($limit, $start, $col, $dir){
        $this->db->select("*");
        $this->db->limit($limit, $start);
        $this->db->order_by($col, $dir);
        $this->db->from("purchase_order_to_admin");
        $this->db->join('customers','purchase_order_to_admin.customer_id=customers.id','left');
        $this->db->where("purchase_order_to_admin.status","1");
        $this->db->group_by('purchase_order_to_admin.potoadmin_id');
        $query = $this->db->get();
        if($query->num_rows() == 0) {
            return NULL;
        } else {
            return $query->result();
        }
    }//End of all_rows()

    function search_rows($limit, $start, $keyword, $col, $dir){
        $this->db->select("*");
        // $this->db->like($this->id, $keyword);

        $this->db->from("purchase_order_to_admin as pota");
        $this->db->join('customers as c','pota.customer_id=c.id','left');
        $this->db->where("pota.status","1");
        $this->db->where("c.status","1");
        $this->db->like('c.name', $keyword);
        // $this->db->or_like('c.name', $keyword);
        // $this->db->like('pota.created_at', $keyword);
        $this->db->limit($limit, $start);

        $this->db->group_by('pota.potoadmin_id');
        $this->db->order_by($col, $dir);


        $query = $this->db->get();//var_dump($this->db->last_query());die;
        if($query->num_rows() == 0) {
            return NULL;
        } else {
            return $query->result();
        }
    }//End of search_rows()

    function tot_search_rows($keyword){
        $this->db->select("*");
        // $this->db->like($this->id, $keyword);
        $this->db->or_like('pota.potoadmin_id', $keyword);
        $this->db->or_like('c.name', $keyword);
        $this->db->or_like('created_at', $keyword);
        $this->db->from("purchase_order_to_admin as pota");
          $this->db->join('customers as c','pota.customer_id=c.id','left');
        $this->db->where("pota.status","1");
        $this->db->group_by('pota.potoadmin_id');
        $query = $this->db->get();
        return $query->num_rows();
    }//End of tot_search_rows()

    //For supplier datatable
    function tot_suprows(){
        $this->db->select("*");
        $this->db->from("purchase_order_to_supplier as pots");
        $this->db->join('suppliers as s','s.supplier_id=pots.supplier_id','left');
        $this->db->where('pots.status','1');
        $this->db->group_by('pots.purchase_order_supplier_id');
        $query = $this->db->get();
        return $query->num_rows();
    }//End of tot_suprows()

    function all_suprows($limit, $start, $col, $dir){
        $this->db->select("pots.*,s.name as supplier_name,c.name as customer_name");
        $this->db->limit($limit, $start);
        $this->db->order_by($col, $dir);
        $this->db->from("purchase_order_to_supplier as pots");
        $this->db->join('suppliers as s','s.supplier_id=pots.supplier_id','left');
        $this->db->join('customers as c','c.id=pots.customer_id','left');
        $this->db->where('pots.status','1');
        $this->db->group_by('pots.purchase_order_supplier_id');
        $query = $this->db->get();
        if($query->num_rows() == 0) {
            return NULL;
        } else {
            return $query->result();
        }
    }//End of all_suprows()

    function search_suprows($limit, $start, $keyword, $col, $dir){
        $this->db->select("pots.*,s.name as supplier_name,c.name as customer_name");
        $this->db->like("c.name", $keyword);
        // $this->db->or_like('purchase_order_from_customer_id', $keyword);
        // $this->db->or_like('supplier_id', $keyword);
        $this->db->limit($limit, $start);
        $this->db->order_by($col, $dir);
        $this->db->from("purchase_order_to_supplier as pots");
        $this->db->join('suppliers as s','s.supplier_id=pots.supplier_id','left');
        $this->db->join('customers as c','c.id=pots.customer_id','left');
        $this->db->where('pots.status','1');
        $this->db->group_by('pots.purchase_order_supplier_id');
        $query = $this->db->get();
        if($query->num_rows() == 0) {
            return NULL;
        } else {
            return $query->result();
        }
    }//End of search_suprows()

    function tot_search_suprows($keyword){
        $this->db->select("*");
        $this->db->like("c.name", $keyword);
        // $this->db->or_like('purchase_order_from_customer_id', $keyword);
        // $this->db->or_like('supplier_id', $keyword);
        $this->db->from("purchase_order_to_supplier as pots");
        $this->db->join('suppliers as s','s.supplier_id=pots.supplier_id','left');
        $this->db->join('customers as c','c.id=pots.customer_id','left');
        $this->db->where('pots.status','1');
        $this->db->group_by('pots.purchase_order_supplier_id');
        $query = $this->db->get();
        return $query->num_rows();
    }//End of tot_search_suprows()

    function search_suprows_supplier_dashboard($limit, $start, $keyword, $col, $dir,$supplier_id){
        $this->db->select("*");
        $this->db->like("purchase_order_supplier_id", $keyword);
        $this->db->or_like('purchase_order_from_customer_id', $keyword);
        $this->db->where('supplier_id', $supplier_id);
        $this->db->join("invoice_details_from_supplier","invoice_details_from_supplier.invoice_details_from_supplier_id=purchase_order_to_supplier.invoice_id","left");
        $this->db->limit($limit, $start);
        $this->db->order_by($col, $dir);
        $this->db->from("purchase_order_to_supplier");
        $query = $this->db->get();
        if($query->num_rows() == 0) {
            return NULL;
        } else {
            return $query->result();
        }
    }//End of search_suprows()

    function tot_search_suprows_supplier_dashboard($keyword,$supplier_id){
        $this->db->select("*");
        $this->db->like("purchase_order_supplier_id", $keyword);
        $this->db->or_like('purchase_order_from_customer_id', $keyword);
        $this->db->where('supplier_id', $supplier_id);
        $this->db->from("purchase_order_to_supplier");
        $query = $this->db->get();
        return $query->num_rows();
    }//End of tot_search_suprows()
    // for front ent data table
    function front_tot_rows($customer_id){
        $this->db->select("pota.*,q.quotation_date");
        $this->db->from("purchase_order_to_admin pota");
        $this->db->join('quotation as q','q.quotation_id=pota.quotation_id','left');
        $this->db->where(array('pota.customer_id'=>$customer_id,'pota.status'=>"1"));
        $query = $this->db->get();
        return $query->num_rows();

    }//End of tot_rows()

    function front_all_rows($limit, $start, $col, $dir,$customer_id){
      $this->db->select("pota.*,q.quotation_date");
      $this->db->from("purchase_order_to_admin pota");
      $this->db->join('quotation as q','q.quotation_id=pota.quotation_id','left');
      $this->db->where(array('pota.customer_id'=>$customer_id,'pota.status'=>"1"));
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
      $this->db->select("pota.*,q.quotation_date");
      $this->db->from("purchase_order_to_admin pota");
      $this->db->join('quotation as q','q.quotation_id=pota.quotation_id','left');
      $this->db->where(array('pota.customer_id'=>$customer_id,'pota.status'=>"1"));
      $this->db->like('customer_id', $keyword);
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
      $this->db->select("pota.*,q.quotation_date");
      $this->db->from("purchase_order_to_admin pota");
      $this->db->join('quotation as q','q.quotation_id=pota.quotation_id','left');
      $this->db->where(array('pota.customer_id'=>$customer_id,'pota.status'=>"1"));
      $this->db->like('customer_id', $keyword);
        //$this->db->or_like('enquiry_placed_date', $keyword);
        $query = $this->db->get();
        return $query->num_rows();

    }//End of tot_search_rows()
}
