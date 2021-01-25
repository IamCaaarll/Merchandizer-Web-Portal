<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class scheduled_Model extends CI_Model {

    public function __construct() {

        parent::__construct();
        $this->load->database();
        $this->table = 'tblmd_Schedule';
        // Set orderable column fields
        $this->column_select = array("id", "ScheduleCode", "Schedule_desc", "Morning_in", "Morning_out", "Afternoon_In", "Afternoon_out", "Total_hours", "Total_break", "Status");
        $this->column_order = array("id", "ScheduleCode", "Schedule_desc", "Morning_in", "Morning_out", "Afternoon_In", "Afternoon_out", "Total_hours", "Total_break", "Status");
        // Set searchable column fields
        $this->column_search = array("ScheduleCode", "Schedule_desc");
        // Set default order
        $this->order = array("id" => 'asc');
        $this->key = 'id';
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

                $this->db->insert($this->table, $entry);
                $result = array(
                    "bool" => true,
                    "message" => 'Sucesssfully Created!'
                );
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
            if ($this->check_existing($filter, $entry, null) == true) {
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
                    "message" => 'Sucesssfully Created!'
                );
                return $result;
            }
        } else {
            $this->db->where($this->key, $id);
            $this->db->update($this->table, $entry);
            $result = array(
                "bool" => true,
                "message" => 'Sucesssfully Created!'
            );
            return $result;
        }
    }

    public function getIndexCode() {
        $this->db->select("MAX(id) + 1 as code");
        $this->db->from("tblmd_Schedule");
        $query = $this->db->get();
        return $query->result();
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
