<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class groupsched_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->table = 'tblmd_groupSched';
        // Set orderable column fields
        $this->column_select = array("id", "Status", "GroupCode", "Group_Desc", "period_id", "PeriodFT", "store_id", "Store");
        $this->column_order = array("id", "Status", "GroupCode", "Group_Desc", "period_id", "PeriodFT", "store_id", "Store");
        // Set searchable column fields
        $this->column_search = array("GroupCode", "Group_Desc", "Store");
        // Set default order
        $this->order = array("id" => 'asc');
        $this->key = 'id';
    }

    public function savemerchSched($entry) {
        $this->db->insert('tbl_merchSchedule', $entry);
        $result = array(
            "bool" => true,
            "message" => 'Sucesssfully Created!'
        );
        return $result;
    }

    public function saveIndividualSched($entry) {
        $this->db->insert('tblmd_indiSched', $entry);
        $result = array(
            "bool" => true,
            "message" => 'Sucesssfully Created!'
        );
        return $result;
    }

    public function getIndexCode() {
        $this->db->select("MAX(id) + 1 as code");
        $this->db->from("tblmd_groupSched");
        $query = $this->db->get();
        return $query->result();
    }

    public function getDailySchedule($periodID, $groupID) {
        return $this->db->query("select CASE WHEN Status = 'REGULAR DAY' THEN 'Regular Day' ELSE 'Rest Day' END as 'Status' ,Schedule_Code,sched_Date,Day from tbl_merchSchedule where period_id = " . $periodID . " and GroupID = " . $groupID . " Group by Status,Schedule_Code,sched_Date,Day order by  CONVERT(DateTime, sched_Date,101)  ASC");
    }

    public function updateIndividualSched($entry, $whereFilter) {

        if ($this->check_existingSched($whereFilter) == true) {
            $this->db->where("merchID = '" . $entry["merchID"] . "' and groupID = '" . $entry["GroupID"] . "'");
            $this->db->update('tblmd_indiSched', $entry);
            $result = array(
                "bool" => true,
                "message" => 'Sucesssfully Updated!'
            );
            return $result;
        } else {
            $this->db->insert('tblmd_indiSched', $entry);

            $result = array(
                "bool" => true,
                "message" => 'Sucesssfully Created!'
            );
            return $result;
        }
    }

    public function deleteIndividualSched($whereFilter) {
        $this->db->delete('tblmd_indiSched', $whereFilter);
    }

    public function updateIndividualStats($entry, $groupid) {
        $this->db->where("id", $groupid);
        $this->db->update('tblmd_indiSched', $entry);
        $result = array(
            "bool" => true,
            "message" => 'Sucesssfully Updated!'
        );
        return $result;
    }

    public function updateGSSched($entry, $groupid) {
        $this->db->where("id", $groupid);
        $this->db->update('tblmd_groupSched', $entry);
        $result = array(
            "bool" => true,
            "message" => 'Sucesssfully Updated!'
        );
        return $result;
    }

    public function updateSched($entry, $where) {
        $this->db->where($where);
        $this->db->update('tbl_merchSchedule', $entry);
        $result = array(
            "bool" => true,
            "message" => 'Sucesssfully Updated!'
        );
        return $result;
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
                $insert_id = $this->db->insert_id();

                $result = array(
                    "bool" => true,
                    "message" => 'Sucesssfully Created!',
                    "gID" => $insert_id
                );
                return $result;
            }
        } else {

            $this->db->insert($this->table, $entry);
            $insert_id = $this->db->insert_id();
            $result = array(
                "bool" => true,
                "message" => 'Sucesssfully Created!',
                "gID" => $insert_id
            );
            return $result;
        }
    }

    public function updateData($entry, $filter = array(), $id) {
        $this->db->where("id", $id);
        $this->db->update('tblmd_groupSched', $entry);
        $this->db->delete('tbl_merchSchedule', array('GroupID' => $id));
        $result = array(
            "bool" => true,
            "message" => 'Sucesssfully Updated!'
        );
        return $result;
    }

    public function delIndiSched($id) {
        $this->db->where('GroupID', $id);
        $this->db->delete('tblmd_indiSched');
        $result = array(
            "bool" => true,
            "message" => 'Sucesssfully Deleted!'
        );
        return $result;
    }

    public function getStore() {
        return $this->db->query("select id,storeName as StoreCode from tblmd_store where status = 1");
        return $query;
    }

    public function getperiodCover() {
        return $this->db->query("select period_code,PeriodNumber,CONCAT(Period_from,' - ',Period_to) as periodDesc from tblmd_PeriodCover where Status = 1 ");
        return $query;
    }

    public function getrestCode() {
        return $this->db->query("select restCode, description from tblmd_RestDaySched group by restCode, description");
        return $query;
    }

    public function getSchedCode() {
        return $this->db->query("select id,ScheduleCode,Schedule_desc,CONVERT(varchar(15),CAST(Morning_in AS TIME),100) as Morning_In,CONVERT(varchar(15),CAST(Morning_out AS TIME),100) as Morning_out,CONVERT(varchar(15),CAST(Afternoon_In AS TIME),100) as Afternoon_In,CONVERT(varchar(15),CAST(Afternoon_out AS TIME),100) as Afternoon_out from tblmd_Schedule where status = 1");
        return $query;
    }

    public function getMerchName($store_id, $period_id) {
        return $this->db->query("select id,CONCAT(last_name,', ',first_name,' ',middle_name) as Name from tbl_users where admin = 0 and acmanager = 0 and active = 1 and store = '" . $store_id . "' and id NOT IN (select merchID from tblmd_indiSched where period_id = '" . $period_id . "'  and store_id =" . $store_id . ")");
        return $query;
    }

    public function getActiveMerchName($store_id, $period_id, $id) {
        return $this->db->query("select id,CONCAT(last_name,', ',first_name,' ',middle_name) as Name from tbl_users where admin = 0 and acmanager = 0 and active = 1 and store = '" . $store_id . "' and id IN (select distinct merchID from tblmd_indiSched where period_id = '" . $period_id . "'  and store_id = " . $store_id . " and GroupID = " . $id . ")");
        return $query;
    }

    public function getRestSched($id) {
        return $this->db->query("select Status,Day from tblmd_RestDaySched where restCode = '" . $id . "'  AND status = 'OFF' order by case Day when 'MONDAY' then 1 when 'TUESDAY' then 2 when 'WEDNESDAY' then 3 when 'THURSDAY' then 4 when 'FRIDAY' then 5 when 'SATURDAY' then 6 when 'SUNDAY' then 7  end");
        return $query;
    }

    public function check_existing($field_names, $entry, $id = null) {
        $count = 0;
        foreach ($field_names as $field_name) {
            $this->db->select("$this->key as id");
            $this->db->from('tblmd_indiSched');
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
        echo $count;
        if ($count > 2) {

            return true;
        } else {
            return false;
        }
    }

    public function check_existingSched($field_names) {
        $count = 0;
        $this->db->select("$this->key as id");
        $this->db->from('tblmd_indiSched');
        $this->db->where("merchID = '" . $field_names["merchID"] . "' and groupID = '" . $field_names["GroupID"] . "'");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $count++;
        } else {
            
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
