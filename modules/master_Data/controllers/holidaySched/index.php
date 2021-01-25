<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class index extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('master_Data/holidaySched/holiday_Model');
        $this->filter = array('holiday_Date');
    }

    function holisched() {
        $response = array(
            "bool" => true,
            "view" => $this->load->view('holidaySched/index', null, true)
        );
        echo json_encode($response);
    }

    public function saveholiday() {
        if ($this->input->post()) {
            $entry = array(
                'holiday_Code' => strtoupper($this->input->post('holiday_Code')),
                'description' => strtoupper($this->input->post('description')),
                'holiday_Type' => strtoupper($this->input->post('holiday_Type')),
                'holiday_Date' => strtoupper($this->input->post('holiday_Date')),
                'created_by' => $this->session->userdata($this->config->item('ses_id'))['username'],
                'date_created' => date('Y-m-d h:i:s'),
                'ip_created' => $this->input->ip_address(),
                'terminal_created' => php_uname("n")
            );
            $save = $this->holiday_Model->saveData($entry, $this->filter);

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

    public function updateholiday($id) {
        if ($this->input->post()) {
            $entry = array(
                'holiday_Code' => strtoupper($this->input->post('holiday_Code')),
                'description' => strtoupper($this->input->post('description')),
                'holiday_Type' => strtoupper($this->input->post('holiday_Type')),
                'holiday_Date' => strtoupper($this->input->post('holiday_Date')),
                'created_by' => $this->session->userdata($this->config->item('ses_id'))['username'],
                'date_created' => date('Y-m-d h:i:s'),
                'ip_created' => $this->input->ip_address(),
                'terminal_created' => php_uname("n")
            );
            $save = $this->holiday_Model->updateData($entry, $this->filter, $id);

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

    public function deleteRest($id) {
        $delete = $this->holiday_Model->deleteRest($id);
        if ($delete['bool'] == true) {
            $result = array(
                "bool" => $delete['bool'],
                "message" => $delete['message']
            );
        } else {
            $result = array(
                "bool" => false,
                "message" => $delete['message']
            );
        }
        echo json_encode($result);
    }

    function getRestSched($id) {
        $response = array(
            "restDay" => $this->holiday_Model->getRestSched($id)->result_array()
        );
        echo json_encode($response);
    }

    public function getIndexCode() {
        $get = $this->holiday_Model->getIndexCode();
        if ($get[0]->code == null) {
            $response = "0";
            echo json_encode($response);
        } else {
            $response = $get[0]->code;
            echo json_encode($response);
        }
    }

    function getLists() {
        $data = array();
// Fetch member's records
        $HoliData = $this->holiday_Model->getRows($_POST);

        foreach ($HoliData as $holiday) {
            $dataRow = array();
            $dataRow[] = '<div class="btn-group">
                                <button type="button" class="btn btn-info dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class = "ft-settings"></i> </button> 
                                    <div class="dropdown-menu">
                                        <a data-id="' . $holiday->id . '" data-action="edit" class="dropdown-item"><i class="fa fa-pencil"></i> Edit</a>
                                        <a  data-id="' . $holiday->id . '" data-action="view" data-action="view" class="dropdown-item"><i class="ft-eye"></i> View</a>
                                    </div>
                            </div>';

            $dataRow[] = $holiday->holiday_Code;
            $dataRow[] = $holiday->description;
            $dataRow[] = $holiday->holiday_Date;
            $dataRow[] = $holiday->holiday_Type;
            $data[] = $dataRow;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->holiday_Model->countAll(),
            "recordsFiltered" => $this->holiday_Model->countFiltered($_POST),
            "data" => $data,
        );
// Output to JSON format
        echo json_encode($output);
    }

}
