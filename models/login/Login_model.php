<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->library('user_agent');
        $this->sms = $this->load->database('sms', TRUE);
    }

    public function validate_user($username, $password) {
        $return = array();

        $sql = "select id,";
        $sql .= " username, password, locked_account, change_password,contact,emailaddress,";
        $sql .= " template,active, admin,first_name, last_name + ', ' + first_name  as full_name,";
        $sql .= " password_expiration_date, login_attempts";
        $sql .= " from tbl_users";
        $sql .= " where username like '" . $username . "'";

        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            $row = $query->row_array();

            if ($row['password'] == $password) {
                $return = $row;
                $return['code'] = 0;
                $return['message'] = 'Success';
            } elseif ($row['locked_account'] == 1) {
                $return = $row;
                $return['code'] = 3;
                $return['message'] = 'Account Disabled';
            } else {
                $return = $row;
                $return['code'] = 1;
                $return['message'] = 'Invalid Password';
            }
        } else {
            $return['code'] = 2;
            $return['message'] = 'Invalid Username';
        }

        return $return;
    }

    public function validate_email($email) {
        $return = array();
        $sql = "select id,";
        $sql .= " username, password, locked_account, change_password,";
        $sql .= " template,active, admin,first_name, last_name + ', ' + first_name  as full_name,";
        $sql .= " password_expiration_date, login_attempts,emailaddress,contact";
        $sql .= " from tbl_users";
        $sql .= " where emailaddress like '" . $email . "'";

        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            $row = $query->row_array();
            if ($row['emailaddress'] == $email) {
                $return = $row;
                $return['code'] = 0;
                $return['contact'] = $row['contact'];
                $return['message'] = 'Success';
            } elseif ($row['locked_account'] == 1) {
                $return = $row;
                $return['code'] = 3;
                $return['message'] = 'Account Disabled';
            } else {
                $return = $row;
                $return['code'] = 1;
                $return['message'] = 'Invalid Email Address';
            }
        } else {
            $return['code'] = 2;
            $return['message'] = 'Invalid Email Address';
        }

        return $return;
    }

    public function getAccess($id) {
        $this->db->select("admin,merch,agency,store,reports");
        $this->db->from("tbl_access");
        $this->db->where("userID", $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function validate_Code($id, $code) {
        $return = array();
        $sql = "select verifyCode from tbl_users";
        $sql .= " where id = '" . $id . "'";
        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            $row = $query->row_array();

            if ($row['verifyCode'] == $code) {
                $return = $row;
                $return['code'] = 1;
                $return['message'] = 'Success';
            } else {
                $return = $row;
                $return['code'] = 0;
                $return['message'] = 'Invalid Code';
            }
        } else {
            $return['code'] = 0;
            $return['message'] = 'Invalid Code';
        }

        return $return;
    }
    
    public function sendCode($id, $contact, $entry) {
        $recipient = "+63" . $contact;
        $this->db->where('id', $id);
        $this->db->update('tbl_users', $entry);
        $entry = array(
            'storecode' => null,
            'sender' =>$recipient,
            'datetime_sent' => date('Y-m-d h:i:s'),
            'date_sent' => date('Y-m-d h:i:s'),
            'message' => "Your MWP Account verification code is " . $entry['verifyCode'] . ".",
            'status' => 'U',
            'category' => 'MWP',
            'retry_attempts' => 1
        );
         $this->sms->insert('tbloutbox', $entry);

        $result = array(
            'bool' => true,
        );
        return $result;
    }
    
    public function update_attempt($empid, $attempt, $lock, $change) {

        $data = array(
            'login_attempts' => $attempt,
            'locked_account' => $lock,
            'change_password' => $change
        );

        $this->db->where('id', $empid);
        $this->db->update('tbl_users', $data);
    }

    public function update($entry, $id) {

        $this->db->where('id', $id);
        $this->db->update('tbl_users', $entry);
    }

    public function get_oldpassword($empid) {
        $sql = "select password from tbl_users where id = " . $empid;
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->password;
        }
    }

}
