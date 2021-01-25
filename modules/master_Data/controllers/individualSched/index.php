<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class index extends MX_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->model('master_Data/individualSched/indisched_Model');
        $this->filter = array('period_id', 'merchID');
    }

    function indisched() {
        $response = array(
            "bool" => true,
            "view" => $this->load->view('individualSched/index', null, true)
        );
        echo json_encode($response);
    }

    public function savemerchSched() {
        if ($this->input->post()) {
            $entry = array(
                'merchID' => strtoupper($this->input->post('merchID')),
                'period_id' => strtoupper($this->input->post('period_id')),
                'store_id' => strtoupper($this->input->post('store_id')),
                'name' => strtoupper($this->input->post('name')),
                'PeriodFT' => strtoupper($this->input->post('PeriodFT')),
                'Schedule_Code' => strtoupper($this->input->post('Schedule_Code')),
                'Store' => strtoupper($this->input->post('Store')),
                'GroupID' => strtoupper($this->input->post('GroupID')),
                'Status' => strtoupper($this->input->post('Status')),
                'sched_Date' => strtoupper($this->input->post('sched_Date')),
                'Day' => strtoupper($this->input->post('Day')),
                'created_by' => $this->session->userdata($this->config->item('ses_id'))['username'],
                'date_created' => date('Y-m-d h:i:s'),
                'ip_created' => $this->input->ip_address(),
                'terminal_created' => php_uname("n")
            );

            $save = $this->indisched_Model->savemerchSched($entry);

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

    public function updatemerchSched() {
        if ($this->input->post()) {
            $where = array(
                'merchID' => strtoupper($this->input->post('merchID')),
                'GroupID' => strtoupper($this->input->post('GroupID'))
            );
            $entry = array(
                'merchID' => strtoupper($this->input->post('merchID')),
                'period_id' => strtoupper($this->input->post('period_id')),
                'store_id' => strtoupper($this->input->post('store_id')),
                'PeriodFT' => strtoupper($this->input->post('PeriodFT')),
                'Store' => strtoupper($this->input->post('Store')),
                'Status' => strtoupper($this->input->post('Status')),
                'sched_Date' => strtoupper($this->input->post('sched_Date')),
                'Day' => strtoupper($this->input->post('Day')),
                'created_by' => $this->session->userdata($this->config->item('ses_id'))['username'],
                'date_created' => date('Y-m-d h:i:s'),
                'ip_created' => $this->input->ip_address(),
                'terminal_created' => php_uname("n")
            );

            $save = $this->indisched_Model->updatemerchSched($entry, $where);

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

    public function saveSched() {
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
                'created_by' => $this->session->userdata($this->config->item('ses_id'))['username'],
                'date_created' => date('Y-m-d h:i:s'),
                'ip_created' => $this->input->ip_address(),
                'terminal_created' => php_uname("n")
            );

            $save = $this->indisched_Model->saveData($entry);

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

    public function updateData($id, $gid) {

        $update = $this->indisched_Model->updateData($id, $gid);
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

    public function getDailySchedule($groupID) {
        $response = array(
            "dailySched" => $this->indisched_Model->getDailySchedule($groupID)->result_array()
        );

        echo json_encode($response);
    }

    public function getSchedCode() {
        $response = array(
            "sched" => $this->indisched_Model->getSchedCode()->result_array()
        );

        echo json_encode($response);
    }

    public function getActiveMerchName($store_id, $period_id) {
        $response = array(
            "merchActive" => $this->indisched_Model->getActiveMerchName($store_id, $period_id)->result_array()
        );

        echo json_encode($response);
    }

    public function getMerchName($groupID) {
        $response = array(
            "merch" => $this->indisched_Model->getMerchName($groupID)->result_array()
        );

        echo json_encode($response);
    }

    public function getRestDay($merchID, $periodID) {
        $response = array(
            "rest" => $this->indisched_Model->getRestDay($merchID, $periodID)->result_array()
        );

        echo json_encode($response);
    }

    public function getperiodCover() {
        $response = array(
            "periodCover" => $this->indisched_Model->getperiodCover()->result_array()
        );

        echo json_encode($response);
    }

    public function getgroupSchedule($storeID, $periodID) {
        $response = array(
            "groupSched" => $this->indisched_Model->getgroupSchedule($storeID, $periodID)->result_array()
        );

        echo json_encode($response);
    }

    public function getStore() {
        $response = array(
            "store" => $this->indisched_Model->getStore()->result_array()
        );

        echo json_encode($response);
    }

    function getLists() {
        $data = array();

        $filter = array(
            'period_id' => $this->input->post('FperiodCover'),
            'store_id' => $this->input->post('Fstore'),
            'GroupID' => $this->input->post('FgroupSchedule')
        );
// Fetch member's records
        $indiSchedData = $this->indisched_Model->getRows($_POST, $filter);

        foreach ($indiSchedData as $sched) {
            $dataRow = array();
            $dataRow[] = '<div class="btn-group">
                                <button type="button" class="btn btn-info dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class = "ft-settings"></i> </button> 
                                    <div class="dropdown-menu">
                                        <a data-merch="' . $sched->merchID . '"  data-groupid="' . $sched->GroupID . '"   data-store="' . $sched->store_id . '"  data-id="' . $sched->id . '" data-perid="' . $sched->period_id . '" data-action="edit" class="dropdown-item"><i class="fa fa-pencil"></i> Edit</a>
                                        <a data-merch="' . $sched->merchID . '" data-groupid="' . $sched->GroupID . '"   data-store="' . $sched->store_id . '"  data-id="' . $sched->id . '" data-perid="' . $sched->period_id . '" data-action="view" data-action="view" class="dropdown-item"><i class="ft-eye"></i> View</a>
                                    </div>
                            </div>';

            $dataRow[] = $sched->name;
            $dataRow[] = $sched->PeriodFT;
            $dataRow[] = $sched->Store;
            $data[] = $dataRow;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->indisched_Model->countAll($filter),
            "recordsFiltered" => $this->indisched_Model->countFiltered($_POST, $filter),
            "data" => $data,
        );
// Output to JSON format
        echo json_encode($output);
    }

}
