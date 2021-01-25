<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class index extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('master_Data/timesheet/timesheet_Model');
        $this->filter = array('holiday_Date');
    }

    function timesheet() {
        $response = array(
            "bool" => true,
            "view" => $this->load->view('timesheet/index', null, true)
        );
        echo json_encode($response);
    }

    public function submitTimesheet($groupID) {

        $update = $this->timesheet_Model->submitTimesheet($groupID);

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

    public function deleteTimesheet($merch, $store, $period) {

        $save = $this->timesheet_Model->deleteTimesheet($merch, $store, $period);

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

    public function UpdateTimesheet($merch, $store, $period, $schedule) {
        if ($this->input->post()) {
            $entry = array(
                "merch" => $merch,
                "store" => $store,
                "period" => $period,
                "sched" => $schedule,
                "date" => $this->input->post('date'),
                "timein" => $this->input->post('timein'),
                "timeout" => $this->input->post('timeout'),
                "lunchin" => $this->input->post('lunchin'),
                "lunchout" => $this->input->post('lunchout'),
                "daytype" => $this->input->post('daytype')
            );
            $save = $this->timesheet_Model->UpdateTimesheet($entry);

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

    public function SaveTimesheet($merch, $store, $period, $schedule, $group) {

        $save = $this->timesheet_Model->SaveTimesheet($merch, $store, $period, $schedule, $group);

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

    public function getIndexCode() {
        $get = $this->timesheet_Model->getIndexCode();
        if ($get[0]->code == null) {
            $response = "0";
            echo json_encode($response);
        } else {
            $response = $get[0]->code;
            echo json_encode($response);
        }
    }

    public function getStore() {
        $response = array(
            "store" => $this->timesheet_Model->getStore()->result_array()
        );

        echo json_encode($response);
    }

    public function checkTimesheet($group) {
        $response = array(
            "sheet" => $this->timesheet_Model->checkTimesheet($group)->result_array()
        );

        echo json_encode($response);
    }

    public function editTimeSheet($id, $period, $store) {
        $response = array(
            "editMerchs" => $this->timesheet_Model->editTimeSheet($id, $period, $store)->result_array()
        );

        echo json_encode($response);
    }

    public function merchTimeSheet($id, $period, $store) {
        $response = array(
            "merchs" => $this->timesheet_Model->merchTimeSheet($id, $period, $store)->result_array()
        );

        echo json_encode($response);
    }

    public function getSchedCode() {
        $response = array(
            "sched" => $this->timesheet_Model->getSchedCode()->result_array()
        );

        echo json_encode($response);
    }

    public function getMerch($groupid) {
        $response = array(
            "merch" => $this->timesheet_Model->getMerch($groupid)->result_array()
        );

        echo json_encode($response);
    }

    public function generateTimesheet($period, $store, $group) {
        $response = array(
            "timesheet" => $this->timesheet_Model->generateTimesheet($period, $store, $group)->result_array()
        );

        echo json_encode($response);
    }

    public function getgroupSchedule($storeID, $periodID) {
        $response = array(
            "groupSched" => $this->timesheet_Model->getgroupSchedule($storeID, $periodID)->result_array()
        );

        echo json_encode($response);
    }

    public function getperiodCover() {

        $response = array(
            "periodCover" => $this->timesheet_Model->getperiodCover()->result_array()
        );

        echo json_encode($response);
    }

    function getLists() {
        $data = array();
        $filter = array(
            'tsh.periodid' => $this->input->post('FperiodCover'),
            'tsh.storeid' => $this->input->post('Fstore'),
            'tsh.schedid' => $this->input->post('Fschedule'),
            'tsh.status' => $this->input->post('FStatus')
        );
// Fetch member's records
        $TimeData = $this->timesheet_Model->getRows($_POST, $filter);

        foreach ($TimeData as $timesheet) {
            $dataRow = array();
            if ($timesheet->status == 0) {
                $dataRow[] = '<div class="btn-group">
                                <button type="button" class="btn btn-info dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class = "ft-settings"></i> </button> 
                                    <div class="dropdown-menu">
                                        <a data-id="' . $timesheet->merchID . '" data-store="' . $timesheet->storeid . '"data-period="' . $timesheet->periodid . '" data-sched="' . $timesheet->schedid . '" data-action="edit" class="dropdown-item"><i class="fa fa-pencil"></i> Edit</a>
                                        <a  data-id="' . $timesheet->merchID . '" data-store="' . $timesheet->storeid . '"data-period="' . $timesheet->periodid . '" data-sched="' . $timesheet->schedid . '" data-action="view" data-action="view" class="dropdown-item"><i class="ft-eye"></i> View</a>
                                    </div>
                            </div>';
            } else {
                $dataRow[] = '<div class="btn-group">
                                <button type="button" class="btn btn-info dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class = "ft-settings"></i> </button> 
                                    <div class="dropdown-menu">
                                    <a  data-id="' . $timesheet->merchID . '" data-store="' . $timesheet->storeid . '"data-period="' . $timesheet->periodid . '" data-action="view" data-action="view" class="dropdown-item"><i class="ft-eye"></i> View</a>
                                    </div>
                            </div>';
            }
            $dataRow[] = $timesheet->timesheet_code;
            $dataRow[] = $timesheet->name;
            $dataRow[] = ($timesheet->status == 0) ? '<div class="badge badge-danger">In Process</div>' : '<div class="badge badge-success">Process</div>';

            $data[] = $dataRow;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->timesheet_Model->countAll($filter),
            "recordsFiltered" => $this->timesheet_Model->countFiltered($_POST, $filter),
            "data" => $data,
        );
// Output to JSON format
        echo json_encode($output);
    }

}
