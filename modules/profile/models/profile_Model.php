<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class profile_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function changeContact($new, $where) {
        $entry = array(
            'contact' => $new
        );
        $this->db->where($where);
        $this->db->update('tbl_users', $entry);
        $result = array(
            "bool" => true,
            "message" => 'Success'
        );
        return $result;
    }

    public function checkOld($old, $id) {
        $result = array();
        $entry = array("id=" => $id,"contact=" =>$old);
        $this->db->select("id,contact");
        $this->db->from("tbl_users");
        $this->db->where($entry);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $result = array(
                "bool" => true,
                "message" => 'Success'
            );
        } else {
           $result = array(
            "bool" => false,
            "message" => 'Failed'
        );
        }
        return $result;
    }

}
