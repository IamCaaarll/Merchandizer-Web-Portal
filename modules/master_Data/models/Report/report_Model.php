<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class report_Model extends CI_Model {

    public function __construct() {

        parent::__construct();
        $this->load->database();
        $this->table = 'tbl_merchTime';
        $this->column_select = array("tbl_users.last_name + ', ' + tbl_users.first_name as full_name ", "tbl_merchTime.timein", "tbl_merchTime.morningout", "tbl_merchTime.afternoonin", "tbl_merchTime.timeout", "tbl_merchTime.date_created");
        // Set orderable column fields
        $this->column_order = array("tbl_users.last_name + ', ' + tbl_users.first_name as full_name ", "tbl_merchTime.date_created", "tbl_merchTime.timein", "tbl_merchTime.morningout", "tbl_merchTime.fternoonin", "tbl_merchTime.timeout");
        // Set default order
        $this->order = array('tbl_merchTime.date_created' => 'desc');
        $this->key = 'id';

        $this->Ftable = 'tbl_merchTime';
        $this->Fcolumn_select = array("tbl_users.last_name + ', ' + tbl_users.first_name as full_name ", "tbl_merchTime.timein", "tbl_merchTime.morningout", "tbl_merchTime.afternoonin", "tbl_merchTime.timeout", "tbl_merchTime.date_created");
        // Set orderable column fields
        $this->Fcolumn_order = array("tbl_users.last_name + ', ' + tbl_users.first_name as full_name ", "tbl_merchTime.date_created", "tbl_merchTime.timein", "tbl_merchTime.morningout", "tbl_merchTime.fternoonin", "tbl_merchTime.timeout");
        // Set searchable column fields
        // Set default order
        $this->Forder = array('tbl_merchTime.date_created' => 'desc');


        $this->Ltable = 'tbl_timeLogs';
        $this->Lcolumn_select = array("tbl_users.last_name + ', ' + tbl_users.first_name as full_name ", "tbl_timeLogs.event", "tbl_timeLogs.time", "tbl_timeLogs.date_created");
        // Set orderable column fields
        $this->Lcolumn_order = array("tbl_users.last_name + ', ' + tbl_users.first_name as full_name ", "tbl_timeLogs.event", "tbl_timeLogs.time", "tbl_timeLogs.date_created");
        // Set default order
        $this->Lorder = array('tbl_timeLogs.time' => 'DESC');

        $this->LFtable = 'tbl_timeLogs';
        $this->LFcolumn_select = array("tbl_users.last_name + ', ' + tbl_users.first_name as full_name ", "tbl_timeLogs.event", "tbl_timeLogs.time", "tbl_timeLogs.date_created");
        // Set orderable column fields
        $this->LFcolumn_order = array("tbl_users.last_name + ', ' + tbl_users.first_name as full_name ", "tbl_timeLogs.event", "tbl_timeLogs.time", "tbl_timeLogs.date_created");
        // Set default order
        $this->LForder = array('tbl_timeLogs.time' => 'DESC');
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

                $this->db->insert('tblmd_agency', $entry);
                $result = array(
                    "bool" => true,
                    "message" => 'Sucesssfully Created!'
                );
                return $result;
            }
        } else {

            $this->db->insert('tblmd_agency', $entry);
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

    public function getRows($postData, $search_By) {
        $this->_get_datatables_query($postData, $search_By);
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
        $this->db->join("tbl_users", "tbl_users.id = tbl_merchTime.merchID");
        $this->db->where('tbl_merchTime.date_created >=', date('m/d/Y'));
        $this->db->where('tbl_merchTime.date_created <=', date('m/d/Y'));
        return $this->db->count_all_results();
    }

    /*
     * Count records based on the filter params
     * @param $_POST filter data based on the posted parameters
     */
    
    public function countFiltered($postData, $search_By) {
        $this->_get_datatables_query($postData, $search_By);
        $query = $this->db->get();
        return $query->num_rows();
    }

    /*
     * Perform the SQL queries needed for an server-side processing requested
     * @param $_POST filter data based on the posted parameters
     */

    private function _get_datatables_query($postData, $search_By) {

        switch ($search_By) {
            case 'Name':
                $this->column_search = array("tbl_users.last_name", "tbl_users.first_name");
                break;
            case 'TransDate':
                $this->column_search = array("tbl_merchTime.date_created");
                break;
            case 'mornIn':
                $this->column_search = array("tbl_merchTime.timein");
                break;
            case 'mornOut':
                $this->column_search = array("tbl_merchTime.morningout");
                break;
            case 'aftrIn':
                $this->column_search = array("tbl_merchTime.afternoonin");
                break;
            case 'aftrOut':
                $this->column_search = array("tbl_merchTime.timeout");
                break;
            default:
                $this->column_search = array("tbl_users.last_name", "tbl_users.first_name", "tbl_merchTime.timein", "tbl_merchTime.morningout", "tbl_merchTime.afternoonin", "tbl_merchTime.timeout", "tbl_merchTime.date_created");
                break;
        }

        $this->db->select($this->column_select);
        $this->db->from($this->table);
        $this->db->join("tbl_users", "tbl_users.id = tbl_merchTime.merchID");
        $this->db->where('tbl_merchTime.date_created >=', date('m/d/Y'));
        $this->db->where('tbl_merchTime.date_created <=', date('m/d/Y'));

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

    public function FgetRows($postData, $from, $to, $search_By) {

        $this->F_get_datatables_query($postData, $from, $to, $search_By);
        if ($postData['length'] != -1) {
            $this->db->limit($postData['length'], $postData['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }

    /*
     * Count all records
     */

    public function FcountAll($from, $to) {
        $this->db->select($this->Fcolumn_select);
        $this->db->from($this->Ftable);
        $this->db->join("tbl_users", "tbl_users.id = tbl_merchTime.merchID");
        $this->db->where('tbl_merchTime.date_created >=', $from);
        $this->db->where('tbl_merchTime.date_created <=', $to);
        return $this->db->count_all_results();
    }

    /*
     * Count records based on the filter params
     * @param $_POST filter data based on the posted parameters
     */

    public function FcountFiltered($postData, $from, $to, $search_By) {
        $this->F_get_datatables_query($postData, $from, $to, $search_By);
        $query = $this->db->get();
        return $query->num_rows();
    }

    /*
     * Perform the SQL queries needed for an server-side processing requested
     * @param $_POST filter data based on the posted parameters
     */

    private function F_get_datatables_query($postData, $from, $to, $search_By) {

        switch ($search_By) {
            case 'Name':
                $this->Fcolumn_search = array("tbl_users.last_name", "tbl_users.first_name");
                break;
            case 'TransDate':
                $this->Fcolumn_search = array("tbl_merchTime.date_created");
                break;
            case 'mornIn':
                $this->Fcolumn_search = array("tbl_merchTime.timein");
                break;
            case 'mornOut':
                $this->Fcolumn_search = array("tbl_merchTime.morningout");
                break;
            case 'aftrIn':
                $this->Fcolumn_search = array("tbl_merchTime.afternoonin");
                break;
            case 'aftrOut':
                $this->Fcolumn_search = array("tbl_merchTime.timeout");
                break;
            default:
                $this->Fcolumn_search = array("tbl_users.last_name", "tbl_users.first_name", "tbl_merchTime.timein", "tbl_merchTime.morningout", "tbl_merchTime.afternoonin", "tbl_merchTime.timeout", "tbl_merchTime.date_created");
                break;
        }
        $this->db->select($this->Fcolumn_select);
        $this->db->from($this->Ftable);
        $this->db->join("tbl_users", "tbl_users.id = tbl_merchTime.merchID");
        $this->db->where('tbl_merchTime.date_created >=', $from);
        $this->db->where('tbl_merchTime.date_created <=', $to);

        $i = 0;
        // loop searchable columns 
        foreach ($this->Fcolumn_search as $item) {
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
                if (count($this->Fcolumn_search) - 1 == $i) {
                    // close bracket
                    $this->db->group_end();
                }
            }
            $i++;
        }

        if (isset($postData['order'])) {
            $this->db->order_by($this->Fcolumn_order[$postData['order']['0']['column']], $postData['order']['0']['dir']);
        } else if (isset($this->Forder)) {
            $order = $this->Forder;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    /*
     * Fetch members data from the database
     * @param $_POST filter data based on the posted parameters
     */

    public function LgetRows($postData, $search_By) {
        // Set searchable column fields
        $this->L_get_datatables_query($postData, $search_By);
        if ($postData['length'] != -1) {
            $this->db->limit($postData['length'], $postData['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }

    /*
     * Count all records
     */

    public function LcountAll() {
        $this->db->select($this->Lcolumn_select);
        $this->db->from($this->Ltable);
        $this->db->join("tbl_users", "tbl_users.id = tbl_timeLogs.merchId");
        $this->db->where('tbl_timeLogs.date_created >=', date('m/d/Y'));
        $this->db->where('tbl_timeLogs.date_created <=', date('m/d/Y'));
        return $this->db->count_all_results();
    }

    /*
     * Count records based on the filter params
     * @param $_POST filter data based on the posted parameters
     */

    public function LcountFiltered($postData, $search_By) {
        $this->L_get_datatables_query($postData, $search_By);
        $query = $this->db->get();
        return $query->num_rows();
    }

    /*
     * Perform the SQL queries needed for an server-side processing requested
     * @param $_POST filter data based on the posted parameters
     */

    private function L_get_datatables_query($postData, $search_By) {
        switch ($search_By) {
            case 'Name':
                $this->Lcolumn_search = array("tbl_users.last_name", "tbl_users.first_name");
                break;
            case 'TransDate':
                $this->Lcolumn_search = array("tbl_timeLogs.date_created");
                break;
            case 'Time':
                $this->Lcolumn_search = array("tbl_timeLogs.time");
                break;
            case 'Event':
                $this->Lcolumn_search = array("tbl_timeLogs.event");
                break;
            default:
                $this->Lcolumn_search = array("tbl_users.last_name", "tbl_users.first_name", "tbl_timeLogs.event", "tbl_timeLogs.time", "tbl_timeLogs.date_created");
                break;
        }
        $this->db->select($this->Lcolumn_select);
        $this->db->from($this->Ltable);
        $this->db->join("tbl_users", "tbl_users.id = tbl_timeLogs.merchID");
        $this->db->where('tbl_timeLogs.date_created >=', date('m/d/Y'));
        $this->db->where('tbl_timeLogs.date_created <=', date('m/d/Y'));

        $i = 0;
        // loop searchable columns 
        foreach ($this->Lcolumn_search as $item) {
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
                if (count($this->Lcolumn_search) - 1 == $i) {
                    // close bracket
                    $this->db->group_end();
                }
            }
            $i++;
        }

        if (isset($postData['order'])) {
            $this->db->order_by($this->Lcolumn_order[$postData['order']['0']['column']], $postData['order']['0']['dir']);
        } else if (isset($this->Lorder)) {
            $order = $this->Lorder;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    /*
     * Fetch members data from the database
     * @param $_POST filter data based on the posted parameters
     */

    public function LFgetRows($postData, $from, $to, $search_By) {
        $this->LF_get_datatables_query($postData, $from, $to, $search_By);
        if ($postData['length'] != -1) {
            $this->db->limit($postData['length'], $postData['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }

    /*
     * Count all records
     */

    public function LFcountAll($from, $to) {
        $this->db->select($this->LFcolumn_select);
        $this->db->from($this->LFtable);
        $this->db->join("tbl_users", "tbl_users.id = tbl_timeLogs.merchId");
        $this->db->where('tbl_timeLogs.date_created >=', $from);
        $this->db->where('tbl_timeLogs.date_created <=', $to);
        return $this->db->count_all_results();
    }

    /*
     * Count records based on the filter params
     * @param $_POST filter data based on the posted parameters
     */

    public function LFcountFiltered($postData, $from, $to, $search_By) {
        $this->LF_get_datatables_query($postData, $from, $to, $search_By);
        $query = $this->db->get();
        return $query->num_rows();
    }

    /*
     * Perform the SQL queries needed for an server-side processing requested
     * @param $_POST filter data based on the posted parameters
     */

    private function LF_get_datatables_query($postData, $from, $to, $search_By) {

        switch ($search_By) {
            case 'Name':
                $this->LFcolumn_search = array("tbl_users.last_name", "tbl_users.first_name");
                break;
            case 'TransDate':
                $this->LFcolumn_search = array("tbl_timeLogs.date_created");
                break;
            case 'Time':
                $this->LFcolumn_search = array("tbl_timeLogs.time");
                break;
            case 'Event':
                $this->LFcolumn_search = array("tbl_timeLogs.event");
                break;
            default:
                $this->LFcolumn_search = array("tbl_users.last_name", "tbl_users.first_name", "tbl_timeLogs.event", "tbl_timeLogs.time", "tbl_timeLogs.date_created");
                break;
        }
        $this->db->select($this->LFcolumn_select);
        $this->db->from($this->LFtable);
        $this->db->join("tbl_users", "tbl_users.id = tbl_timeLogs.merchId");
        $this->db->where('tbl_timeLogs.date_created >=', $from);
        $this->db->where('tbl_timeLogs.date_created <=', $to);

        $i = 0;
        // loop searchable columns 
        foreach ($this->LFcolumn_search as $item) {
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
                if (count($this->LFcolumn_search) - 1 == $i) {
                    // close bracket
                    $this->db->group_end();
                }
            }
            $i++;
        }

        if (isset($postData['order'])) {
            $this->db->order_by($this->LFcolumn_order[$postData['order']['0']['column']], $postData['order']['0']['dir']);
        } else if (isset($this->LForder)) {
            $order = $this->LForder;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

}
