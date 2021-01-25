<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class menu_Model extends CI_Model {

    public function __construct() {

        parent::__construct();
        $this->load->database();
    }
    public function getAccess($id, $module) {
        $response = array();
        $this->db->select("tbl_access.module, tblmd_module.module");
        $this->db->from("tblmd_module");
        $this->db->join("tbl_access", "tbl_access.module = tblmd_module.id", "left");
        $array = array('tbl_access.userID =' => $id, 'tblmd_module.module =' => $module,'tbl_access.status =' => 1);
        $this->db->where($array);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $response['status'] = 1;
        } else {
            $response['status'] = 0;
        }
        return $response;
    }
    public function getAllAccess($id) {
        $response = array();
        $this->db->select("tbl_access.module, tblmd_module.module");
        $this->db->from("tblmd_module");
        $this->db->join("tbl_access", "tbl_access.module = tblmd_module.id", "left");
        $array = array('tbl_access.userID =' => $id,'tbl_access.status =' => 1);
        $this->db->where($array);
        $query = $this->db->get();
        return $query->result();
    }
}
