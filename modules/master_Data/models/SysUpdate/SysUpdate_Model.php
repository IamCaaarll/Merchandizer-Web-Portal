<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class SysUpdate_Model extends CI_Model {

    public function __construct() {

        parent::__construct();
        $this->load->database();

        $this->sms = $this->load->database('sms', TRUE);
    }

    public function get_Recipient() {
        $query = $this->db->query('SELECT id, storeName FROM tblmd_store where status = 1');
        return $query->result();
    }

}
