<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class index extends MX_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->model('master_Data/Scheduled/scheduled_Model');
    }

    function sched() {
        $response = array(
            "bool" => true,
            "view" => $this->load->view('Scheduled/index', null, true)
        );
        echo json_encode($response);
    }

    public function saveSched() {
        if ($this->input->post()) {
            $entry = array(
                'ScheduleCode' => strtoupper($this->input->post('ScheduleCode')),
                'Schedule_desc' => strtoupper($this->input->post('Schedule_desc')),
                'Morning_in' => strtoupper($this->input->post('Morning_in')),
                'Morning_out' => strtoupper($this->input->post('Morning_out')),
                'Afternoon_In' => strtoupper($this->input->post('Afternoon_In')),
                'Afternoon_out' => strtoupper($this->input->post('Afternoon_out')),
                'Total_hours' => strtoupper($this->input->post('Total_hours')),
                'Total_break' => strtoupper($this->input->post('Total_break')),
                'status' => $this->input->post('stats'),
                'created_by' => $this->session->userdata($this->config->item('ses_id'))['username'],
                'date_created' => date('Y-m-d h:i:s'),
                'ip_created' => $this->input->ip_address(),
                'terminal_created' => php_uname("n")
            );

            $save = $this->scheduled_Model->saveData($entry, null);

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

    public function getIndexCode() {
        $get = $this->scheduled_Model->getIndexCode();
        if ($get[0]->code == null) {

            $response = "0";
            echo json_encode($response);
        } else {
            $response = $get[0]->code;
            echo json_encode($response);
        }
    }

    public function updateSched($update_id) {

        if ($this->input->post()) {
            $entry = array(
                'Schedule_desc' => strtoupper($this->input->post('Schedule_desc')),
                'Morning_in' => strtoupper($this->input->post('Morning_in')),
                'Morning_out' => strtoupper($this->input->post('Morning_out')),
                'Afternoon_In' => strtoupper($this->input->post('Afternoon_In')),
                'Afternoon_out' => strtoupper($this->input->post('Afternoon_out')),
                'Total_hours' => strtoupper($this->input->post('Total_hours')),
                'Total_break' => strtoupper($this->input->post('Total_break')),
                'status' => $this->input->post('stats'),
                'modified_by' => $this->session->userdata($this->config->item('ses_id'))['username'],
                'date_modified' => date('Y-m-d h:i:s'),
                'ip_modified' => $this->input->ip_address(),
                'terminal_modified' => php_uname("n")
            );

            $update = $this->scheduled_Model->updateData($entry, null, $update_id);

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
        $periodData = $this->scheduled_Model->getRows($_POST);
        foreach ($periodData as $period) {
            $dataRow = array();
            $dataRow[] = '<div class="btn-group">
                                <button type="button" class="btn btn-info dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class = "ft-settings"></i> </button> 
                                    <div class="dropdown-menu">
                                        <a data-id="' . $period->id . '" data-action="edit" class="dropdown-item"><i class="fa fa-pencil"></i> Edit</a>
                                        <a data-id="' . $period->id . '" data-action="view" data-action="view" class="dropdown-item"><i class="ft-eye"></i> View</a>
                                    </div>
                            </div>';

            $dataRow[] = $period->ScheduleCode;
            $dataRow[] = $period->Schedule_desc;
            $dataRow[] = date_format(date_create("2013-03-15 " . $period->Morning_in), "H:i A");
            $dataRow[] = date_format(date_create("2013-03-15 " . $period->Morning_out), "H:i A");
            $dataRow[] = date_format(date_create("2013-03-15 " . $period->Afternoon_In), "H:i A");
            $dataRow[] = date_format(date_create("2013-03-15 " . $period->Afternoon_out), "H:i A");
            $dataRow[] = $period->Total_hours;
            $dataRow[] = $period->Total_break;
            $dataRow[] = ($period->Status == 0) ? '<div class="badge badge-danger">Inactive</div>' : '<div class="badge badge-success">Active</div>';
            $data[] = $dataRow;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->scheduled_Model->countAll(),
            "recordsFiltered" => $this->scheduled_Model->countFiltered($_POST),
            "data" => $data,
        );
// Output to JSON format
        echo json_encode($output);
    }

}
