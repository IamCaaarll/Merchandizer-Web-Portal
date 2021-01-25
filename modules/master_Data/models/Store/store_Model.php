<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class store_Model extends CI_Model {

    public function __construct() {

        parent::__construct();
        $this->load->database();
        $this->table = 'tblmd_store';
// Set orderable column fields
        $this->column_select = array("s.id", "s.sapCode", "s.accManager", "s.storeName", "u.first_name + ' ' + u.last_name as manager", "s.geoLocation", "s.geoID",
            "s.geolng", "s.geolat", "s.geoFence", "s.status");
        $this->column_order = array("s.id", "s.sapCode", "s.storeName", "s.geoLocation", "s.geoID",
            "s.geolng", "s.geolat", "s.geoFence", "s.status");
// Set searchable column fields
        $this->column_search = array('s.sapCode', 's.storeName');
// Set default order
        $this->order = array('s.id' => 'asc');
        $this->key = 'id';
    }

    public function getManagers() {
        $sql = "SELECT id, last_name+', '+ first_name as fullname FROM tbl_users where acmanager = 1 and admin = 0 and (store IS NULL or store = 0)";
        return $this->db->query($sql);
    }

    public function getPaymentTerms($id) {
        $where = array();
        $sql = "select pt.id, pt.description from TBL_MOTHER_CUSTOMERS h"
                . " left join TBL_PAYMENT_TERMS pt on pt.id = h.payment_terms_id where h.id = ?";
        $where[] = $id;
        return $this->db->query($sql, $where);
    }

    public function saveData($id, $entry, $filter = array()) {
        if (!empty($filter)) {
            if ($this->check_existing($filter, $entry, null) == true) {
                $result = array(
                    'bool' => false,
                    'message' => "Data Already Exists"
                );
                return $result;
            } else {
                $this->db->insert($this->table, $entry);
                $update = array(
                    'store' => $this->db->insert_id(),
                );
                $result = array(
                    "bool" => true,
                    "message" => 'Sucesssfully Created!'
                );
                $this->db->where("id", $id);
                $this->db->update("tbl_users", $update);
                return $result;
            }
        } else {

            $this->db->insert($this->table, $entry);
            $result = array(
                "bool" => true,
                "message" => 'Sucesssfully Created!'
            );
            return $result;
        }
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

    public function updateStoreData($id, $storeID, $nManager) {
        $entry = array(
            'Store' => NULL
        );
        $this->db->where("id", $id);
        $this->db->update("tbl_users", $entry);

        $update = array(
            'store' => $storeID,
        );
        $this->db->where("id", $nManager);
        $this->db->update("tbl_users", $update);
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

    function getManager() {
        $query = $this->db->query("SELECT id, last_name+', '+ first_name as fullname FROM tbl_users where acmanager = 1 and store IS NULL");
        return $query->result();
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
        $this->db->from('tblmd_store s');
        $this->db->join('tbl_users u', 's.accManager = u.id', 'left');
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
        $this->db->from('tblmd_store s');
        $this->db->join('tbl_users u', 's.accManager = u.id', 'left');

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

}
