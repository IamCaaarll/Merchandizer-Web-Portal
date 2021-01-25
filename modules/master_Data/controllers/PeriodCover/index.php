<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class index extends MX_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->model('master_Data/PeriodCover/period_Model');
    }

    function period() {
        $response = array(
            "bool" => true,
            "view" => $this->load->view('PeriodCover/index', null, true)
        );
        echo json_encode($response);
    }

    public function getIndexCode() {
        $get = $this->period_Model->getIndexCode();
        if ($get[0]->code == null) {

            $response = "0";
            echo json_encode($response);
        } else {
            $response = $get[0]->code;
            echo json_encode($response);
        }

    }

    public function savePeriod() {
        if ($this->input->post()) {
            $entry = array(
                'period_code' => strtoupper($this->input->post('period_code')),
                'Period_from' => strtoupper($this->input->post('Period_from')),
                'Period_to' => strtoupper($this->input->post('Period_to')),
                'Date_from' => strtoupper($this->input->post('Date_From')),
                'Date_to' => strtoupper($this->input->post('Date_To')),
                'status' => $this->input->post('stats'),
                'created_by' => $this->session->userdata($this->config->item('ses_id'))['username'],
                'date_created' => date('Y-m-d h:i:s'),
                'ip_created' => $this->input->ip_address(),
                'terminal_created' => php_uname("n")
            );

            $save = $this->period_Model->saveData($entry, null);

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

    public function updatePeriod($update_id) {

        if ($this->input->post()) {
            $entry = array(
                'Period_from' => strtoupper($this->input->post('Period_from')),
                'Period_to' => strtoupper($this->input->post('Period_to')),
                'Date_from' => strtoupper($this->input->post('Date_From')),
                'Date_to' => strtoupper($this->input->post('Date_To')),
                'status' => $this->input->post('stats'),
                'modified_by' => $this->session->userdata($this->config->item('ses_id'))['username'],
                'date_modified' => date('Y-m-d h:i:s'),
                'ip_modified' => $this->input->ip_address(),
                'terminal_modified' => php_uname("n")
            );

            $update = $this->period_Model->updateData($entry, null, $update_id);

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

    function getLists() {
        $data = array();

        // Fetch member's records
        $periodData = $this->period_Model->getRows($_POST);
        foreach ($periodData as $period) {
            $dataRow = array();
            $dataRow[] = '<div class="btn-group">
                                <button type="button" class="btn btn-info dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class = "ft-settings"></i> </button> 
                                    <div class="dropdown-menu">
                                        <a data-id="' . $period->PeriodNumber . '" data-action="edit" class="dropdown-item"><i class="fa fa-pencil"></i> Edit</a>
                                        <a data-id="' . $period->PeriodNumber . '" data-action="view" data-action="view" class="dropdown-item"><i class="ft-eye"></i> View</a>
                                    </div>
                            </div>';
            $dataRow[] = $period->period_code;
            $dataRow[] = $period->Period_from;
            $dataRow[] = $period->Period_to;
            $dataRow[] = $period->Date_From;
            $dataRow[] = $period->Date_To;
            $dataRow[] = ($period->Status == 0) ? '<div class="badge badge-danger">Inactive</div>' : '<div class="badge badge-success">Active</div>';
            $data[] = $dataRow;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->period_Model->countAll(),
            "recordsFiltered" => $this->period_Model->countFiltered($_POST),
            "data" => $data,
        );
// Output to JSON format
        echo json_encode($output);
    }

}
