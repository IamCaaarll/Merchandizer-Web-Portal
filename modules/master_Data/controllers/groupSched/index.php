<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class index extends MX_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->model('master_Data/groupSched/groupsched_Model');
        $this->filter = array();
    }

    function sched() {
        $response = array(
            "bool" => true,
            "view" => $this->load->view('groupSched/index', null, true)
        );
        echo json_encode($response);
    }

    public function saveGSched() {
        if ($this->input->post()) {
            $entry = array(
                'Group_Desc' => strtoupper($this->input->post('Group_Desc')),
                'PeriodFT' => strtoupper($this->input->post('PeriodFT')),
                'period_id' => strtoupper($this->input->post('period_id')),
                'Store' => strtoupper($this->input->post('Store')),
                'store_id' => strtoupper($this->input->post('store_id')),
                'GroupCode' => strtoupper($this->input->post('GroupCode')),
                'Status' => strtoupper($this->input->post('Status')),
                'created_by' => $this->session->userdata($this->config->item('ses_id'))['username'],
                'date_created' => date('Y-m-d h:i:s'),
                'ip_created' => $this->input->ip_address(),
                'terminal_created' => php_uname("n")
            );
            $save = $this->groupsched_Model->saveData($entry, $this->filter);

            if ($save['bool'] == true) {
                $result = array(
                    "bool" => $save['bool'],
                    "message" => $save['message'],
                    "gID" => $save['gID']
                );
            } else {
                $result = array(
                    "bool" => false,
                    "message" => $save['message']
                );
            }
            echo json_encode($result);
        }
    }

    public function updateGSched($groupid) {
        if ($this->input->post()) {
            $entry = array(
                'Group_Desc' => strtoupper($this->input->post('Group_Desc')),
                'PeriodFT' => strtoupper($this->input->post('PeriodFT')),
                'period_id' => strtoupper($this->input->post('period_id')),
                'Status' => strtoupper($this->input->post('Status')),
                'modified_by' => $this->session->userdata($this->config->item('ses_id'))['username'],
                'date_modified' => date('Y-m-d h:i:s'),
                'ip_modified' => $this->input->ip_address(),
                'terminal_modified' => php_uname("n")
            );

            $save = $this->groupsched_Model->updateData($entry, $this->filter, $groupid);

            if ($save['bool'] == true) {
                $result = array(
                    "bool" => $save['bool'],
                    "message" => $save['message']
                );
            } else {
                $result = array(
                    "bool" => false,
                    "message" => $save['message']
                );
            }
            echo json_encode($result);
        }
    }

    public function savemerchSched() {
        if ($this->input->post()) {
            $entry = array(
                'merchID' => strtoupper($this->input->post('merchID')),
                'period_id' => strtoupper($this->input->post('period_id')),
                'store_id' => strtoupper($this->input->post('store_id')),
                'name' => strtoupper($this->input->post('name')),
                'PeriodFT' => strtoupper($this->input->post('PeriodFT')),
                'Store' => strtoupper($this->input->post('Store')),
                'GroupID' => strtoupper($this->input->post('GroupID')),
                'Status' => strtoupper($this->input->post('Status')),
                'sched_Date' => strtoupper($this->input->post('sched_Date')),
                'Schedule_Code' => strtoupper($this->input->post('Schedule_Code')),
                'Day' => strtoupper($this->input->post('Day')),
                'created_by' => $this->session->userdata($this->config->item('ses_id'))['username'],
                'date_created' => date('Y-m-d h:i:s'),
                'ip_created' => $this->input->ip_address(),
                'terminal_created' => php_uname("n")
            );

            $save = $this->groupsched_Model->savemerchSched($entry);

            if ($save['bool'] == true) {
                $result = array(
                    "bool" => $save['bool'],
                    "message" => $save['message']
                );
            } else {
                $result = array(
                    "bool" => false,
                    "message" => $save['message']
                );
            }
            echo json_encode($result);
        }
    }

    public function saveIndividualSched() {
        if ($this->input->post()) {
            $id = $this->input->post('GroupID');
            $entry = array(
                'merchID' => strtoupper($this->input->post('merchID')),
                'name' => strtoupper($this->input->post('name')),
                'period_id' => strtoupper($this->input->post('period_id')),
                'PeriodFT' => strtoupper($this->input->post('PeriodFT')),
                'store_id' => strtoupper($this->input->post('store_id')),
                'Store' => strtoupper($this->input->post('Store')),
                'GroupID' => strtoupper($this->input->post('GroupID')),
                'Status' => strtoupper($this->input->post('Status')),
                'created_by' => $this->session->userdata($this->config->item('ses_id'))['username'],
                'date_created' => date('Y-m-d h:i:s'),
                'ip_created' => $this->input->ip_address(),
                'terminal_created' => php_uname("n")
            );
            $save = $this->groupsched_Model->saveIndividualSched($entry, null);
            if ($save['bool'] == true) {
                $result = array(
                    "bool" => $save['bool'],
                    "message" => $save['message']
                );
            } else {
                $result = array(
                    "bool" => false,
                    "message" => $save['message']
                );
            }
            echo json_encode($result);
        }
    }

    public function deleteIndividualSched() {
        if ($this->input->post()) {
            $this->whereFilter = array(
                'merchID' => strtoupper($this->input->post('merchID')),
                'GroupID' => strtoupper($this->input->post('GroupID'))
            );

            $delete = $this->groupsched_Model->deleteIndividualSched($this->whereFilter);

            echo json_encode($result);
        }
    }

    public function updateIndividualSched() {
        if ($this->input->post()) {
            $this->whereFilter = array(
                'merchID' => strtoupper($this->input->post('merchID')),
                'GroupID' => strtoupper($this->input->post('GroupID'))
            );
            $entry = array(
                'merchID' => strtoupper($this->input->post('merchID')),
                'name' => strtoupper($this->input->post('name')),
                'period_id' => strtoupper($this->input->post('period_id')),
                'PeriodFT' => strtoupper($this->input->post('PeriodFT')),
                'store_id' => strtoupper($this->input->post('store_id')),
                'Store' => strtoupper($this->input->post('Store')),
                'GroupID' => strtoupper($this->input->post('GroupID')),
                'Status' => strtoupper($this->input->post('Status')),
                'created_by' => $this->session->userdata($this->config->item('ses_id'))['username'],
                'date_created' => date('Y-m-d h:i:s'),
                'ip_created' => $this->input->ip_address(),
                'terminal_created' => php_uname("n")
            );

            $save = $this->groupsched_Model->updateIndividualSched($entry, $this->whereFilter);
            if ($save['bool'] == true) {
                $result = array(
                    "bool" => $save['bool'],
                    "message" => $save['message']
                );
            } else {

                $result = array(
                    "bool" => false,
                    "message" => $save['message']
                );
            }
            echo json_encode($result);
        }
    }

    public function updateIndividualStats($id) {
        if ($this->input->post()) {
            $entry = array(
                'Status' => strtoupper($this->input->post('Status')),
            );

            $update = $this->groupsched_Model->updateIndividualStats($entry, $id);

            if ($update['bool'] == true) {
                $result = array(
                    "bool" => $update['bool'],
                    "message" => $update['message']
                );
            } else {
                $result = array(
                    "bool" => false,
                    "message" => $update['message']
                );
            }
            echo json_encode($result);
        }
    }

    public function updateGSSched($groupid) {
        if ($this->input->post()) {
            $entry = array(
                'Status' => strtoupper($this->input->post('Status')),
            );

            $update = $this->groupsched_Model->updateGSSched($entry, $groupid);

            if ($update['bool'] == true) {
                $result = array(
                    "bool" => $update['bool'],
                    "message" => $update['message']
                );
            } else {
                $result = array(
                    "bool" => false,
                    "message" => $update['message']
                );
            }
            echo json_encode($result);
        }
    }

    public function getIndexCode() {
        $get = $this->groupsched_Model->getIndexCode();
        if ($get[0]->code == null) {

            $response = "0";
            echo json_encode($response);
        } else {
            $response = $get[0]->code;
            echo json_encode($response);
        }
    }

    public function getSchedCode() {
        $response = array(
            "sched" => $this->groupsched_Model->getSchedCode()->result_array()
        );

        echo json_encode($response);
    }

    public function getDailySchedule($periodID, $groupID) {
        $response = array(
            "dailySched" => $this->groupsched_Model->getDailySchedule($periodID, $groupID)->result_array()
        );
        echo json_encode($response);
    }

    public function updateSched($update_id) {
        if ($this->input->post()) {
            $entry = array(
                'Group_Desc' => strtoupper($this->input->post('Group_Desc')),
                'PeriodFT' => strtoupper($this->input->post('PeriodFT')),
                'period_id' => strtoupper($this->input->post('period_id')),
                'Store' => strtoupper($this->input->post('Store')),
                'store_id' => strtoupper($this->input->post('store_id')),
                'modified_by' => $this->session->userdata($this->config->item('ses_id'))['username'],
                'date_modified' => date('Y-m-d h:i:s'),
                'ip_modified' => $this->input->ip_address(),
                'terminal_modified' => php_uname("n")
            );

            $update = $this->groupsched_Model->updateData($entry, null, $update_id);

            if ($update['bool'] == true) {

                $delete = $this->groupsched_Model->deleteIndividualSched($update_id);

                $result = array(
                    "bool" => $update['bool'],
                    "message" => $update['message']
                );
            } else {
                $result = array(
                    "bool" => false,
                    "message" => $update['message']
                );
            }
            echo json_encode($result);
        }
    }

    public function getperiodCover() {
        $response = array(
            "periodCover" => $this->groupsched_Model->getperiodCover()->result_array()
        );
        echo json_encode($response);
    }

    public function getrestCode() {
        $response = array(
            "rest" => $this->groupsched_Model->getrestCode()->result_array()
        );

        echo json_encode($response);
    }

    public function getMerchName($store_id, $period_id) {
        $response = array(
            "merch" => $this->groupsched_Model->getMerchName($store_id, $period_id)->result_array()
        );

        echo json_encode($response);
    }

    function getRestSched($id) {
        $response = array(
            "restDay" => $this->groupsched_Model->getRestSched($id)->result_array()
        );
        echo json_encode($response);
    }

    public function getActiveMerchName($store_id, $period_id, $id) {
        $response = array(
            "merchActive" => $this->groupsched_Model->getActiveMerchName($store_id, $period_id, $id)->result_array()
        );

        echo json_encode($response);
    }

    public function getStore() {
        $response = array(
            "store" => $this->groupsched_Model->getStore()->result_array()
        );

        echo json_encode($response);
    }

    function getLists() {
        $data = array();
        $filter = array(
            'period_id' => $this->input->post('FperiodCover'),
            'store_id' => $this->input->post('Fstore'),
            'Status' => $this->input->post('FStatus')
        );
        // Fetch member's records
        $groupData = $this->groupsched_Model->getRows($_POST, $filter);
        foreach ($groupData as $group) {
            $dataRow = array();

            IF ($group->Status == 'PROCESS') {
                $dataRow[] = '<div class="btn-group">
                                <button type="button" class="btn btn-info dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class = "ft-settings"></i> </button> 
                                    <div class="dropdown-menu">
                                        <a data-stats="' . $group->Status . '"  data-id="' . $group->id . '" data-storeid="' . $group->store_id . '" data-periodid="' . $group->period_id . '" data-action="view" data-action="view" class="dropdown-item"><i class="ft-eye"></i> View</a>
                                    </div>
                            </div>';
            } ELSE {
                $dataRow[] = '<div class="btn-group">
                                <button type="button" class="btn btn-info dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class = "ft-settings"></i> </button> 
                                    <div class="dropdown-menu">
                                        <a data-stats="' . $group->Status . '"  data-id="' . $group->id . '" data-storeid="' . $group->store_id . '" data-periodid="' . $group->period_id . '" data-action="edit" class="dropdown-item"><i class="fa fa-pencil"></i> Edit</a>
                                        <a data-stats="' . $group->Status . '"  data-id="' . $group->id . '" data-storeid="' . $group->store_id . '" data-periodid="' . $group->period_id . '" data-action="view" data-action="view" class="dropdown-item"><i class="ft-eye"></i> View</a>
                                    </div>
                            </div>';
            }

            $dataRow[] = $group->GroupCode;
            $dataRow[] = $group->Group_Desc;
            $dataRow[] = $group->PeriodFT;
            $dataRow[] = $group->Store;
            $data[] = $dataRow;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->groupsched_Model->countAll($filter),
            "recordsFiltered" => $this->groupsched_Model->countFiltered($_POST, $filter),
            "data" => $data,
        );
// Output to JSON format
        echo json_encode($output);
    }

}
