<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class admin_Model extends CI_Model {

    public function __construct() {

        parent::__construct();
        $this->load->database();

        $this->sms = $this->load->database('sms', TRUE);
        $this->table = 'tbl_users';
        $this->column_select = array("tbl_users.id", "tbl_users.username", "tbl_users.last_name + ', ' + tbl_users.first_name  as full_name",
            "tbl_users.contact", "tblmd_agency.Agency", "tblmd_store.storeName", "tbl_users.active");
        // Set orderable column fields
        $this->column_order = array("tbl_users.id", "tbl_users.username", "tbl_users.last_name + ', ' + tbl_users.first_name  as full_name",
            "tbl_users.contact", "tblmd_agency.Agency", "tblmd_store.storeName", "tbl_users.active");
        // Set searchable column fields
        $this->column_search = array("tbl_users.first_name", "tbl_users.username", "tbl_users.last_name", "tbl_users.contact",
            "tblmd_agency.Agency", "tblmd_store.storeName", "tbl_users.active");
        // Set default order
        $this->order = array('tbl_users.id' => 'asc');
        $this->key = 'id';
        $this->column_getselect = array("*", "tblmd_store.storeName", "tbl_users.active");
    }

    public function saveData($entry, $filter = array()) {
        if (!empty($filter)) {
            if ($this->check_existing($filter, $entry, null) == true) {
                $result = array(
                    'bool' => false,
                    'message' => "Data Already Exists"
                );
                return $result;
            } else {

                $this->db->insert('tbl_users', $entry);
                $result = array(
                    "bool" => true,
                    "message" => 'Sucesssfully Created!',
                    "id" => $this->db->insert_id()
                );
                return $result;
            }
        } else {

            $this->db->insert('tbl_users', $entry);
            $result = array(
                "bool" => true,
                "message" => 'Sucesssfully Created!',
                "id" => $this->db->insert_id()
            );
            return $result;
        }
    }
    
    public function saveAdminAccess($entry) {
        $this->db->insert('tbl_access', $entry);
        $result = array(
            "bool" => true,
            "message" => 'Sucesssfully Created!'
        );
        return $result;
    }

    public function updateAdminAccess($entry) {
        $this->db->insert('tbl_access', $entry);
        $result = array(
            "bool" => true,
            "message" => 'Sucesssfully Created!'
        );
        return $result;
    }

    public function saveAccessData($entry) {
        $this->db->insert('tbl_access', $entry);
        $result = array(
            "bool" => true,
            "message" => 'Sucesssfully Created!'
        );
        return $result;
    }

    public function updateAccess($where) {

        $entry = array(
            'status' => 1
        );
        $this->db->where($where);
        $this->db->update('tbl_access', $entry);
        $result = array(
            "bool" => true,
            "message" => 'Sucess'
        );
        return $result;
    }

    public function updateAccessData($filter) {
        $this->db->where($filter);
        $this->db->delete('tbl_access');
        $result = array(
            "bool" => true,
            "message" => 'Sucess'
        );
        return $result;
    }

    public function getAdmin($id) {
        $this->db->select($this->column_getselect);
        $this->db->from($this->table);
        $this->db->join('tblmd_agency', 'tbl_users.agency = tblmd_agency.id', 'left');
        $this->db->join('tblmd_store', 'tbl_users.store = tblmd_store.id', 'left');
        $this->db->join('tbl_access', 'tbl_users.id = tbl_access.userID', 'left');
        $array = array('tbl_users.id' => $id, 'tbl_users.admin' => 1);
        $this->db->where($array);
        $query = $this->db->get();
        return $query->result();
    }

    // Fetch Agency
    function getAgency() {
        $query = $this->db->query('SELECT id, Agency FROM tblmd_agency where status = 1');
        return $query->result();
    }

    function Module() {
        $sql = 'SELECT id,module FROM tblmd_module where status = 1';
        return $this->db->query($sql);
    }

    function getModule($module, $id) {

        $result = array();
        $sql = "select module from tbl_access where userID =" . $id . "AND Module =" . $module . "AND STATUS = 1";

        $query = $this->db->query($sql);



        if ($query->num_rows() > 0) {
            $result['bool'] = true;
        } else {
            $result['bool'] = false;
        }
        return $result;

//        $this->db->select("tblmd_module.id,tblmd_module.module,tbl_access.status");
//        $this->db->from("tblmd_module");
//        $this->db->join('tbl_access', 'tbl_access.module = tblmd_module.id', 'left');
//        $this->db->where("tbl_access.userID", $id);
//        $query = $this->db->get();
//        return $query->result();
    }

    function getStore() {
        $query = $this->db->query('SELECT id, storeName FROM tblmd_store where status = 1');
        return $query->result();
    }

    public function updateData($entry, $filter = array(), $id) {
        if (!empty($filter)) {
            if ($this->check_existing($filter, $entry, $id) == true) {
                $result = array(
                    'bool' => false,
                    'message' => "Data Already Exists"
                );
                return $result;
            } else {

                $this->db->where($this->key, $id);
                $this->db->update($this->table, $entry);
                $result = array(
                    "bool" => true,
                    "message" => 'Sucesssfully Updated!'
                );
                return $result;
            }
        } else {

            $this->db->where($this->key, $id);
            $this->db->update($this->table, $entry);
            $result = array(
                "bool" => true,
                "message" => 'Sucesssfully Updated!'
            );
            return $result;
        }
    }

    public function updatePassword($entry, $id) {
        $this->db->where($this->key, $id);
        $this->db->update($this->table, $entry);
        $result = array(
            "bool" => true,
            "message" => 'Sucesssfully Updated!'
        );
        return $result;
    }

    public function sendnewPass($recipient, $newpass) {
        $entrysms = array(
            'storecode' => null,
            'sender' => $recipient,
            'datetime_sent' => date('Y-m-d h:i:s'),
            'date_sent' => date('Y-m-d h:i:s'),
            'message' => "Your new Password in MWP is " . $newpass . ".",
            'status' => 'U',
            'category' => 'MWP',
            'retry_attempts' => 1
        );
        $this->sms->insert('tbloutbox', $entrysms);
    }

    private function check_existing($field_names, $entry, $id = null) {
        $count = 0;
        foreach ($field_names as $field_name) {

            $this->db->select("$this->key as id");
            $this->db->from($this->table);
            $this->db->where($field_name, $entry[$field_name]);
            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                if ($id == null) {
                    $count++;
                } else {
                    $row = $query->row();
                    if ($row->id != $id) {
                        $count++;
                    } else {
                        
                    }
                }
            } else {
                
            }
        }
        if ($count > 0) {

            return true;
        } else {
            return false;
        }
    }

    /*
     * Fetch members data from the database
     * @param $_POST filter data based on the posted parameters
     */

    public function getRows($postData) {
        $this->_get_datatables_query($postData);
        if ($postData['length'] != -1) {
            $this->db->limit($postData['length'], $postData['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }

    /*
     * Count all records
     */

    public function countAll() {

        $this->db->select($this->column_select);
        $this->db->from($this->table);
        $this->db->join('tblmd_agency', 'tbl_users.agency = tblmd_agency.id', 'left');
        $this->db->join('tblmd_store', 'tbl_users.store = tblmd_store.id', 'left');
        $array = array('tbl_users.admin' => 1, 'tbl_users.acmanager' => 0);
        $this->db->where($array);

        return $this->db->count_all_results();
    }

    /*
     * Count records based on the filter params
     * @param $_POST filter data based on the posted parameters
     */

    public function countFiltered($postData) {
        $this->_get_datatables_query($postData);
        $query = $this->db->get();
        return $query->num_rows();
    }

    /*
     * Perform the SQL queries needed for an server-side processing requested
     * @param $_POST filter data based on the posted parameters
     */

    private function _get_datatables_query($postData) {

        $this->db->select($this->column_select);
        $this->db->from($this->table);
        $this->db->join('tblmd_agency', 'tbl_users.agency = tblmd_agency.id', 'left');
        $this->db->join('tblmd_store', 'tbl_users.store = tblmd_store.id', 'left');
        $array = array('tbl_users.admin' => 1, 'tbl_users.acmanager' => 0);
        $this->db->where($array);

        $i = 0;
        // loop searchable columns 
        foreach ($this->column_search as $item) {
            // if datatable send POST for search
            if ($postData['search']['value']) {
                // first loop
                if ($i === 0) {
                    // open bracket
                    $this->db->group_start();
                    $this->db->like($item, $postData['search']['value']);
                } else {
                    $this->db->or_like($item, $postData['search']['value']);
                }

                // last loop
                if (count($this->column_search) - 1 == $i) {
                    // close bracket
                    $this->db->group_end();
                }
            }
            $i++;
        }

        if (isset($postData['order'])) {
            $this->db->order_by($this->column_order[$postData['order']['0']['column']], $postData['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    /*
     * Fetch members data from the database
     * @param $_POST filter data based on the posted parameters
     */

    public function getAccessRows($postData) {
        $this->access_get_datatables_query($postData);
        if ($postData['length'] != -1) {
            $this->db->limit($postData['length'], $postData['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }

    /*
     * Count all records
     */

    public function countAllAccess() {

        $this->db->select("*");
        $this->db->from("tblmd_module");
//        $this->db->where("status", 1);
        return $this->db->count_all_results();
    }

    /*
     * Count records based on the filter params
     * @param $_POST filter data based on the posted parameters
     */

    public function countFilteredAccess($postData) {
        $this->access_get_datatables_query($postData);
        $query = $this->db->get();
        return $query->num_rows();
    }

    /*
     * Perform the SQL queries needed for an server-side processing requested
     * @param $_POST filter data based on the posted parameters
     */

    private function access_get_datatables_query($postData) {
        $this->db->select("*");
        $this->db->from("tblmd_module");
    }

}
