<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class time_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->table = 'tbl_merchTime';
        $this->key = 'id';
    
    }

    public function check($field_name) {
        if ($this->checktimeIn($field_name) == true) {
            $result = array(
                'bool' => true
            );
            return $result;
        } else {

            $result = array(
                "bool" => false
            );
            return $result;
        }
    }

    public function getInfo($id) {
        $this->db->select("tblmd_store.storeName,tblmd_store.geoLocation,tblmd_store.geoID,tblmd_store.geolat,tblmd_store.geolng,tblmd_store.geoFence");
        $this->db->from("tbl_users");
        $this->db->join("tblmd_store", "tbl_users.store = tblmd_store.id", "left");
        $this->db->where("tbl_users.id", $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function checktimeIn($field_name) {
        $this->db->select("*");
        $this->db->from($this->table);
        $this->db->where($field_name);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return true;
        } else {

            return false;
        }
    }

    public function timeIn($entry) {

        $this->db->insert($this->table, $entry);
        $result = array(
            "bool" => true,
            "message" => 'Sucesssfully Created!'
        );

        return $result;
    }

    public function mornOut($entry, $id) {
        $where = array("merchID" => $id, "date_created" => date('m/d/Y'));
        $this->db->where($where);
        $this->db->update($this->table, $entry);
        $result = array(
            "bool" => true,
            "message" => 'Sucesssfully Updated!'
        );
        return $result;
    }

    public function afternoonIn($entry, $id) {
        $where = array("merchID" => $id, "date_created" => date('m/d/Y'));
        $this->db->where($where);
        $this->db->update($this->table, $entry);
        $result = array(
            "bool" => true,
            "message" => 'Sucesssfully Updated!'
        );
        return $result;
    }
    
    public function timeOut($entry, $id) {
        $where = array("merchID" => $id, "date_created" => date('m/d/Y'));
        $this->db->where($where);
        $this->db->update($this->table, $entry);
        $result = array(
            "bool" => true,
            "message" => 'Sucesssfully Updated!'
        );
        return $result;
    }

    public function timeInlogs($entry) {

        $this->db->insert("tbl_timeLogs", $entry);
        $result = array(
            "bool" => true,
            "message" => 'Sucesssfully Created!'
        );

        return $result;
    }

}
