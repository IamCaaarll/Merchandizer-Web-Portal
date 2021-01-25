<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class logs_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->table = 'tbl_merchTime';
        // Set orderable column fields
        $this->column_order = array("id", "date_created", "timein","morningout","afternoonin", "timeout");
        // Set searchable column fields
        $this->column_search = array("id", "date_created", "timein","morningout","afternoonin", "timeout");
        // Set default order
        $this->order = array('id' => 'asc');

        $this->Ltable = 'tbl_timeLogs';
        // Set orderable column fields
        $this->column_Lorder = array("id", "merchId", "date_created", "time", "event");
        // Set searchable column fields
        $this->column_Lsearch = array("id", "merchId", "date_created", "time", "event");
        // Set default order
        $this->Lorder = array('id' => 'asc');
        $this->key = 'id';
    }

    public function timeIn($entry) {

        $this->db->insert($this->table, $entry);
        $result = array(
            "bool" => true,
            "message" => 'Sucesssfully Created!'
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

    public function timeOut($entry, $id) {
        $this->db->where($this->key, $id);
        $this->db->update($this->table, $entry);
        $result = array(
            "bool" => true,
            "message" => 'Sucesssfully Updated!'
        );
        return $result;
    }

    /*
     * Fetch members data from the database
     * @param $_POST filter data based on the posted parameters
     */

    public function getRows($postData, $id) {
        $this->_get_datatables_query($postData, $id);
        if ($postData['length'] != -1) {
            $this->db->limit($postData['length'], $postData['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }

    /*
     * Count all records
     */

    public function countAll($id) {
        $this->db->from($this->table);
        $this->db->where("merchId", $id);
        return $this->db->count_all_results();
    }

    /*
     * Count records based on the filter params
     * @param $_POST filter data based on the posted parameters
     */

    public function countFiltered($postData, $id) {
        $this->_get_datatables_query($postData, $id);
        $this->db->where("merchId", $id);
        $query = $this->db->get();
        return $query->num_rows();
    }

    /*
     * Perform the SQL queries needed for an server-side processing requested
     * @param $_POST filter data based on the posted parameters
     */

    private function _get_datatables_query($postData, $id) {

        $this->db->from($this->table);
        $this->db->where("merchId", $id);        
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

    public function getLRows($postData, $id, $date) {
        $this->L_get_datatables_query($postData, $id, $date);
        if ($postData['length'] != -1) {
            $this->db->limit($postData['length'], $postData['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }

    /*
     * Count all records
     */

    public function countLAll($id, $date) {
        $array = array('merchId' => $id, 'date_created' => $date);
        $this->db->from($this->Ltable);
        $this->db->where($array);
 
        return $this->db->count_all_results();
    }

    /*
     * Count records based on the filter params
     * @param $_POST filter data based on the posted parameters
     */

    public function countLFiltered($postData, $id, $date) {
        $this->L_get_datatables_query($postData, $id,$date);
        $query = $this->db->get();
        return $query->num_rows();
    }

    /*
     * Perform the SQL queries needed for an server-side processing requested
     * @param $_POST filter data based on the posted parameters
     */

    private function L_get_datatables_query($postData, $id, $date) {

        $array = array('merchId' => $id, 'date_created' => $date);
        $this->db->from($this->Ltable);
        $this->db->where($array);

        $i = 0;
        // loop searchable columns 
        foreach ($this->column_Lsearch as $item) {
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
                if (count($this->column_Lsearch) - 1 == $i) {
                    // close bracket
                    $this->db->group_end();
                }
            }
            $i++;
        }

        if (isset($postData['order'])) {
            $this->db->order_by($this->column_Lorder[$postData['order']['0']['column']], $postData['order']['0']['dir']);
        } else if (isset($this->Lorder)) {
            $order = $this->Lorder;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

}
