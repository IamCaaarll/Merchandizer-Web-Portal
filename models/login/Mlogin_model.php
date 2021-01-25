<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mlogin_model extends CI_Model {

    var $sql = "";

    public function __construct() {

        parent::__construct();

        date_default_timezone_set('Asia/Shanghai');
    }

    public function validate_user($username, $password) {

        $this->sql = " empid,";
        $this->sql = $this->sql . " username,";
        $this->sql = $this->sql . " password,";
        $this->sql = $this->sql . " lock,";
        $this->sql = $this->sql . " expire_date,";
        $this->sql = $this->sql . " attempt,";
        $this->sql = $this->sql . " change,";
        $this->sql = $this->sql . " lastname + ', ' + firstname  as active_user";

        $this->db->select($this->sql);
        $this->db->from('tblta_userlog');

        $this->db->where('username=', trim($username));
        $this->db->where('password=', trim($password));

        $query = $this->db->get();
        return $query;
    }

    public function update_attempt($username, $attempt, $lock, $change) {

        $data_array = array(
            'attempt' => $attempt,
            'lock' => $lock,
            'change' => $change
        );

        $this->db->where('username', $username);
        $this->db->update('tblta_userlog', $data_array);
    }

        

    public function single_user($username) {

        $this->sql = " empid,";
        $this->sql = $this->sql . " username,";
        $this->sql = $this->sql . " password,";
        $this->sql = $this->sql . " lock,";
        $this->sql = $this->sql . " expire_date,";
        $this->sql = $this->sql . " attempt,";
        $this->sql = $this->sql . " change,";
        $this->sql = $this->sql . " lastname + ', ' + firstname + ' ' + left(middlename,1) + '.' as active_user";

        $this->db->select($this->sql);
        $this->db->from('tblta_userlog');

        $this->db->where('username=', trim($username));

        $query = $this->db->get();
        return $query;
    }

}
