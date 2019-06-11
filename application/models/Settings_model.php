<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Settings_model extends CI_Model
{
    function get_by_id($id){
        $this->db->select('*');
        $this->db->where("settings_id",$id);
        $this->db->from("settings");
        return $this->db->get()->row();
    }
    
    function get_row($fld, $val){
        $this->db->select('*');
        $this->db->where($fld,$val);
        $this->db->from("settings");
        return $this->db->get()->row();
    }

    function insert($data){
        $this->db->insert("settings",$data);
        return $this->db->insert_id();
    }
    function update($id,$data){
        $this->db->where("settings_id",$id);
        $this->db->update("settings",$data);
        return $this->db->affected_rows();
    }
    function settings(){
      $this->db->select("*");
      $this->db->from("settings");
      $this->db->where("status","1");
      $this->db->group_by('settings_id');
        return $this->db->get()->result();
    }

    //For datatable
    function tot_rows(){
        $this->db->select("*");
        $this->db->from("settings");
        $this->db->where("status","1");
        $this->db->group_by('settings_id');
        $query = $this->db->get();
        return $query->num_rows();
    }//End of tot_rows()

    function all_rows($limit, $start, $col, $dir){

        $this->db->select("*");
        $this->db->from("settings");
        $this->db->where("status","1");
        $this->db->group_by('settings_id');
        $this->db->limit($limit, $start);
        $this->db->order_by($col, $dir);
        $query = $this->db->get();
        if($query->num_rows() == 0) {
            return NULL;
        } else {
            return $query->result();
        }
    }//End of all_rows()

    function search_rows($limit, $start, $keyword, $col, $dir){
        $this->db->select("*");
        $this->db->from("settings");
        $this->db->where("status","1");
        $this->db->like('key', $keyword);
        $this->db->limit($limit, $start);
        $this->db->group_by('settings_id');
        $this->db->order_by($col, $dir);
        $query = $this->db->get();
        if($query->num_rows() == 0) {
            return NULL;
        } else {
            return $query->result();
        }
    }//End of search_rows()

    function tot_search_rows($keyword){
        $this->db->select("*");
        $this->db->from("settings");
        $this->db->where("status","1");
        $this->db->group_by('settings_id');
        $query = $this->db->get();
        return $query->num_rows();
    }//End of tot_search_rows()


}
