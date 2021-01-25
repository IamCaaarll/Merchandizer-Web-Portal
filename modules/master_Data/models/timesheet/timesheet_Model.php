<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class timesheet_Model extends CI_Model {

    public function __construct() {

        parent::__construct();
        $this->load->database();
        $this->table = 'tbl_timesheetHeader tsh';
// Set orderable column fields
        $this->column_select = array("tsh.id", "tsh.merchID", "tsh.storeid", "tsh.periodid", "tsh.timesheet_code", "ids.name", "ids.Store", "ids.PeriodFT", "tsh.schedid", "tsh.status");
        $this->column_order = array("tsh.id", "tsh.merchID", "tsh.storeid", "tsh.periodid", "tsh.timesheet_code", "ids.name", "ids.Store", "ids.PeriodFT", "tsh.schedid", "tsh.status");
// Set searchable column fields
        $this->column_search = array("tsh.timesheet_code", "ids.name", "tsh.status");
// Set default order
        $this->order = array("tsh.id" => 'asc');
        $this->key = 'tsh.id';
    }

    public function submitTimesheet($id) {
        $entry = array(
            'status' => 1);

        $this->db->where('merchId in (select merchID from tbl_timesheetHeader where groupid = ' . $id . ')');
        $this->db->update('tbl_timeSheet', $entry);

        $this->db->where('groupid', $id);
        $this->db->update('tbl_timesheetHeader', $entry);

        $result = array(
            "bool" => true,
            "message" => 'Sucesssfully Updated!'
        );
        return $result;
    }

    public function getStore() {
        return $this->db->query("select id,storeName as StoreCode from tblmd_store where status = 1");
        return $query;
    }

    public function editTimeSheet($id, $period, $store) {
        return $this->db->query("select *,FORMAT(cast(schedule_Time_In as DateTime), N'hh:mm tt') as 's_Time_In',FORMAT(cast(schedule_Lunch_In as DateTime), N'hh:mm tt') as 's_Lunch_In',FORMAT(cast(schedule_Lunch_Out as DateTime), N'hh:mm tt') as 's_Lunch_Out',FORMAT(cast(schedule_Time_Out as DateTime), N'hh:mm tt') as 's_Time_Out' from tbl_timeSheet where merchId = " . $id . " and storeid = " . $store . " and periodid = " . $period . " order by  CONVERT(DateTime, transactionDate,101)  ASC");
        return $query;
    }

    public function merchTimeSheet($id, $period, $store) {
        return $this->db->query("select *,FORMAT(cast(timeIn as DateTime), N'hh:mm tt') as 'timeIn',FORMAT(cast(lunch_In as DateTime), N'hh:mm tt') as 'lunch_In',FORMAT(cast(lunch_Out as DateTime), N'hh:mm tt') as 'lunch_Out',FORMAT(cast(timeOut as DateTime), N'hh:mm tt') as 'timeOut',FORMAT(cast(schedule_Time_In as DateTime), N'hh:mm tt') as 's_Time_In',FORMAT(cast(schedule_Lunch_In as DateTime), N'hh:mm tt') as 's_Lunch_In',FORMAT(cast(schedule_Lunch_Out as DateTime), N'hh:mm tt') as 's_Lunch_Out',FORMAT(cast(schedule_Time_Out as DateTime), N'hh:mm tt') as 's_Time_Out' from tbl_timeSheet where merchId = " . $id . " and storeid = " . $store . " and periodid = " . $period . " order by  CONVERT(DateTime, transactionDate,101)  ASC");
        return $query;
    }

    public function checkTimesheet($group) {
        return $this->db->query("SELECT top 1 status FROM tbl_timesheetHeader where groupid = " . $group . "");
        return $query;
    }

    public function getgroupSchedule($store_id, $period_id) {
        return $this->db->query("select id,Group_Desc,Status,sched_id,RestCode from tblmd_groupSched where store_id = '" . $store_id . "' and period_id = '" . $period_id . "' and Status = 'PROCESS' and id IN (select  distinct GroupID from tbl_merchSchedule where store_id = '" . $store_id . "' and period_id = '" . $period_id . "' )");
        return $query;
    }

    public function getperiodCover() {
        return $this->db->query("select period_code,PeriodNumber,CONCAT(FORMAT(CAST(Period_from as datetime), 'MMMM dd, yyyy') ,' to ',FORMAT(CAST(Period_to as datetime), 'MMMM dd, yyyy')) as periodDesc from tblmd_PeriodCover where Status = 1 ");
        return $query;
    }

    public function getSchedCode() {
        return $this->db->query("select id,ScheduleCode,Schedule_desc,CONVERT(varchar(15),CAST(Morning_in AS TIME),100) as Morning_In,CONVERT(varchar(15),CAST(Morning_out AS TIME),100) as Morning_out,CONVERT(varchar(15),CAST(Afternoon_In AS TIME),100) as Afternoon_In,CONVERT(varchar(15),CAST(Afternoon_out AS TIME),100) as Afternoon_out from tblmd_Schedule where status = 1");
        return $query;
    }

    public function generateTimesheet($period, $store, $group) {
        return $this->db->query("select merchID,GroupID,sched_id,period_id,store_id from tblmd_indiSched where store_id = " . $store . " and period_id = " . $period . " and GroupID  = " . $group . " and Status = 'PROCESS' ");
        return $query;
    }

    public function updateMerchTimesheet($id, $period) {
        return $this->db->query("select merchID,GroupID,sched_id,period_id,store_id from tblmd_indiSched where store_id = " . $store . " and period_id = " . $period . " and GroupID  = " . $group . " and Status = 'PROCESS' ");
        return $query;
    }

    public function getMerch($group) {
        return $this->db->query("select name from tblmd_indiSched where GroupID = " . $group . "");
        return $query;
    }

    public function SaveTimesheet($merch, $store, $period, $schedule, $groupid) {

        $timesheetCode = '';
        $this->db->select("MAX(id) + 1 as code");
        $this->db->from("tbl_timesheetHeader");
        $query = $this->db->get();
        $get = $query->result();
        if ($get[0]->code == null) {
            $timesheetCode = "MWP-TSC-001";
        } else {
            $timesheetCode = 'MWP-TSC-00' . $get[0]->code;
        }

        $entry = array(
            'timesheet_code' => $timesheetCode,
            'merchID' => $merch,
            'schedid' => $schedule,
            'storeid' => $store,
            'periodid' => $period,
            'groupid' => $groupid,
            'status' => '0',
            'created_by' => $this->session->userdata($this->config->item('ses_id'))['username'],
            'date_created' => date('Y-m-d h:i:s'),
            'ip_created' => $this->input->ip_address(),
            'terminal_created' => php_uname("n")
        );
        $this->db->insert('tbl_timesheetHeader', $entry);

        $this->db->query("INSERT INTO tbl_timeSheet(merchId,periodid,storeid, dayType,
 transactionDate,
 weekDay,
 timeIn,
 lunch_In,
 lunch_Out,
 timeOut,
 schedule_Time_In,
 schedule_Lunch_In,
 schedule_Lunch_Out,
 schedule_Time_Out,
 actual_Hours,
 late_Hours,
 undertime_Hours,
 total_Hours,
 absent,
 special_holiday,
 regular_holiday,
 status,
 created_by,
 date_created,
 ip_created,
 terminal_created) select '" . $merch . "','" . $period . "','" . $store . "', *, '0' as 'Status', '" . $this->session->userdata($this->config->item('ses_id'))['username'] . "' as 'created_by', '" . date('Y-m-d h:i:s') . "' as 'date_created', '" . $this->input->ip_address() . "' as 'ip_created', '" . php_uname("n") . "' as 'terminal_created' from TimeSheet(" . $merch . ", " . $store . ", " . $period . ", " . $schedule . ")");

        $result = array(
            "bool" => true,
            "message" => 'Sucesssfully Save!'
        );
        return $result;
    }

    public function deleteTimesheet($merch, $store, $period) {
        $this->db->delete('tbl_timeSheet', array('merchId' => $merch, 'storeid' => $store, 'periodid' => $period));

        $result = array(
            "bool" => true,
            "message" => 'Sucesssfully Save!'
        );
        return $result;
    }

    public function UpdateTimesheet($entry) {
        $this->db->query("INSERT INTO tbl_timeSheet(merchId,periodid,storeid, dayType,
 transactionDate,
 weekDay,
 timeIn,
 lunch_In,
 lunch_Out,
 timeOut,
 schedule_Time_In,
 schedule_Lunch_In,
 schedule_Lunch_Out,
 schedule_Time_Out,
 actual_Hours,
 late_Hours,
 undertime_Hours,
 total_Hours,
 absent,
 special_holiday,
 regular_holiday,
 status,
 created_by,
 date_created,
 ip_created,
 terminal_created) select '" . $entry['merch'] . "','" . $entry['period'] . "','" . $entry['store'] . "', *, '0' as 'Status', '" . $this->session->userdata($this->config->item('ses_id'))['username'] . "' as 'created_by', '" . date('Y-m-d h:i:s') . "' as 'date_created', '" . $this->input->ip_address() . "' as 'ip_created', '" . php_uname("n") . "' as 'terminal_created' from UpdateTimeSheet(" . $entry['merch'] . "," . $entry['store'] . "," . $entry['period'] . "," . $entry['sched'] . ",'" . $entry['date'] . "','" . $entry['timein'] . "','" . $entry['timeout'] . "','" . $entry['lunchin'] . "','" . $entry['lunchout'] . "','" . $entry['daytype'] . "')");


        $result = array(
            "bool" => true,
            "message" => 'Sucesssfully Save!'
        );
        return $result;
    }

    public function getIndexCode() {
        $this->db->select("MAX(id) + 1 as code");
        $this->db->from("tblmd_holiday");
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
                    return true;
                } else {
                    $row = $query->row();
                    if ($row->id != $id) {
                        return true;
                    } else {
                        
                    }
                }
            } else {
                return false;
            }
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
        $this->db->join('tblmd_indiSched ids', 'tsh.merchID = ids.merchID');
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
        $this->db->join('tblmd_indiSched ids', 'tsh.merchID = ids.merchID');
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
