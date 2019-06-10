<?php if(!defined("BASEPATH")) exit("No direct script access allowed");
class Useractivities_model extends CI_Model{
    function add_row($data){
        $this->db->insert("useractivities", $data);
    }//End of add_row()

    function get_userwise($uid){
        $this->db->select("*");
        $this->db->where("uid", $uid);
        $this->db->order_by("activity_time","DESC");
        $this->db->limit(200);
        $this->db->from("useractivities");
        $query = $this->db->get();
        if($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }//End of if else
    }//End of get_userwise()

    function tot_rows($utype=null,$uid=null){
        $this->db->select("*");
        $this->db->from("useractivities");
        if($utype){
          $this->db->where('utype',$utype);
          $this->db->where('uid',$uid);
        }
        $query = $this->db->get();
        return $query->num_rows();
    }//End of tot_rows()

    function all_rows($limit, $start, $col, $dir,$utype=null,$uid=null){
        $this->db->select("*");
        $this->db->limit($limit, $start);
        $this->db->order_by($col, $dir);
        $this->db->from("useractivities");
        if($utype){
          $this->db->where('utype',$utype);
          $this->db->where('uid',$uid);
        }
        $query = $this->db->get();
        if($query->num_rows() == 0) {
            return NULL;
        } else {
            return $query->result();
        }
    }//End of all_rows()

    function search_rows($limit, $start, $search, $col, $dir,$utype=null,$uid=null){
        $this->db->select("*");
        $this->db->like("uid", $search);
        $this->db->or_like("activity_time", $search);
        $this->db->or_like("activity", $search);
        $this->db->limit($limit, $start);
        $this->db->order_by($col, $dir);
        $this->db->from("useractivities");
        if($utype){
          $this->db->where('utype',$utype,$utype=null);
          $this->db->where('uid',$uid);
        }
        $query = $this->db->get();
        if($query->num_rows() == 0) {
            return NULL;
        } else {
            return $query->result();
        }
    }//End of search_rows()

    function tot_search_rows($search,$utype=null,$uid=null){
        $this->db->select("*");
        $this->db->like("uid", $search);
        $this->db->or_like("activity_time", $search);
        $this->db->or_like("activity", $search);
        $this->db->from("useractivities");
        if($utype){
          $this->db->where('utype',$utype);
          $this->db->where('uid',$uid);
        }
        $query = $this->db->get();
        return $query->num_rows();
    }//End of tot_search_rows()

    function delete_row($dt){
        $this->db->where("DATE(activity_time) <", $dt);
        $this->db->delete("useractivities");
        return $this->db->affected_rows();
    }//End of if delete_row()
}//End of Useractivities_model
