<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class indisched_Model extends CI_Model {

    public function __construct() {

        parent::__construct();
        $this->load->database();
        $this->table = 'tblmd_indiSched';
        // Set orderable column fields
        $this->column_select = array("id", "GroupID", "period_id", "merchID", "name", "PeriodFT", "store_id", "Store");
        $this->column_order = array("id", "GroupID", "period_id", "merchID", "name", "PeriodFT", "store_id", "Store");
        // Set searchable column fields
        $this->column_search = array("name");
        // Set default order
        $this->order = array("id" => 'asc');
        $this->key = 'id';
    }

    public function saveData($entry) {
        $this->db->insert('tblmd_indiSched', $entry);
        $result = array(
            "bool" => true,
            "message" => 'Sucesssfully Created!'
        );
        return $result;
    }

    public function savemerchSched($entry) {
        $this->db->insert('tbl_merchSchedule', $entry);
        $result = array(
            "bool" => true,
            "message" => 'Sucesssfully Created!'
        );
        return $result;
    }

    public function updateData($id, $gid) {
        $this->db->delete('tblmd_indiSched', array('merchID' => $id, 'GroupID' => $gid));
        $this->db->delete('tbl_merchSchedule', array('merchID' => $id, 'GroupID' => $gid));
        $result = array(
            "bool" => true,
            "message" => 'Sucesssfully Deleted!'
        );
        return $result;
    }

    public function updatemerchSched($entry, $where) {
        $this->db->where($where);
        $this->db->update('tbl_merchSchedule', $entry);
        $result = array(
            "bool" => true,
            "message" => 'Sucesssfully Updated!'
        );
        return $result;
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

    public function getMerchName($groupID) {
        return $this->db->query("select merchID,name from tblmd_indiSched where GroupID = '" . $groupID . "' and merchID not in (select distinct merchID from tbl_merchSchedule where GroupID = '" . $groupID . "' )");
        return $query;
    }

    public function getActiveMerchName($store_id, $period_id) {
        return $this->db->query("select id,CONCAT(last_name,', ',first_name,' ',middle_name) as Name from tbl_users where admin = 0 and acmanager = 0 and active = 1 and store = '" . $store_id . "' and id NOT IN (select merchID from tblmd_indiSched where period_id = '" . $period_id . "')");
        return $query;
    }                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    
    public function getSchedCode() {
        return $this->db->query("select id,ScheduleCode,Schedule_desc,CONVERT(varchar(15),CAST(Morning_in AS TIME),100) as Morning_In,CONVERT(varchar(15),CAST(Morning_out AS TIME),100) as Morning_out,CONVERT(varchar(15),CAST(Afternoon_In AS TIME),100) as Afternoon_In,CONVERT(varchar(15),CAST(Afternoon_out AS TIME),100) as Afternoon_out from tblmd_Schedule where status = 1");
        return $query;
    }

    public function getgroupSchedule($store_id, $period_id) {
        return $this->db->query("select id,Group_Desc,Status from tblmd_groupSched where store_id = '" . $store_id . "' and period_id = '" . $period_id . "' and Status = 'PROCESS' and id IN (select  distinct GroupID from tbl_merchSchedule where store_id = '" . $store_id . "' and period_id = '" . $period_id . "' )");
        return $query;
    }

    public function getDailySchedule($groupID) {
        return $this->db->query("select Status,sched_Date,Day from tbl_merchSchedule where GroupID = " . $groupID . " group by Status,sched_Date,Day order by  CONVERT(DateTime, sched_Date,101)  ASC");
        return $query;
    }


    public function getperiodCover() {
        return $this->db->query("select period_code,PeriodNumber,CONCAT(Period_from,' - ',Period_to) as periodDesc from tblmd_PeriodCover where Status = 1 ");
        return $query;
    }


    public function getStore() {
        return $this->db->query("select id,storeName as StoreCode from tblmd_store where status = 1");
        return $query;
    }

    /*
     * Fetch members data from the database
     * @param $_POST filter data based on the posted parameters
     */

    public function getRows($postData, $filter) {
        $this->_get_datatables_query($postData, $filter);
        if ($postData['length'] != -1) {
            $this->db->limit($postData['length'], $postData['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }

    /*
     * Count all records
     */

    public function countAll($filter) {
        $this->db->select($this->column_select);
        $this->db->from($this->table);
        $this->db->where('GroupID in (select distinct GroupID from tbl_merchSchedule) and merchID in (select distinct merchID from tbl_merchSchedule)');
        $this->db->where($filter);
        return $this->db->count_all_results();
    }

    /*
     * Count records based on the filter params
     * @param $_POST filter data based on the posted parameters
     */

    public function countFiltered($postData, $filter) {
        $this->_get_datatables_query($postData, $filter);
        $query = $this->db->get();
        return $query->num_rows();
    }

    /*
     * Perform the SQL queries needed for an server-side processing requested
     * @param $_POST filter data based on the posted parameters
     */

    private function _get_datatables_query($postData, $filter) {

        $this->db->select($this->column_select);
        $this->db->from($this->table);
        $this->db->where("GroupID in (select distinct GroupID from tbl_merchSchedule)  AND Status='Process' and merchID in (select distinct merchID from tbl_merchSchedule)");
        $this->db->where($filter);
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
