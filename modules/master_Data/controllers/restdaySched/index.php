<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class index extends MX_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->model('master_Data/restdaySched/restday_Model');
        $this->filter = array('period_id', 'merchID');
    }

    function restsched() {
        $response = array(
            "bool" => true,
            "view" => $this->load->view('restdaySched/index', null, true)
        );
        echo json_encode($response);
    }

    public function saveRest() {
        if ($this->input->post()) {

            $entry = array(
                'restCode' => strtoupper($this->input->post('restCode')),
                'Description' => strtoupper($this->input->post('Description')),
                'Status' => strtoupper($this->input->post('Status')),
                'Day' => strtoupper($this->input->post('Day')),
                'created_by' => $this->session->userdata($this->config->item('ses_id'))['username'],
                'date_created' => date('Y-m-d h:i:s'),
                'ip_created' => $this->input->ip_address(),
                'terminal_created' => php_uname("n")
            );

            $save = $this->restday_Model->saveData($entry);

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

        $delete = $this->restday_Model->deleteRest($id);
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
            "restDay" => $this->restday_Model->getRestSched($id)->result_array()
        );
        echo json_encode($response);
    }

    public function getIndexCode() {
        $get = $this->restday_Model->getIndexCode();
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
        $RestData = $this->restday_Model->getRows($_POST);

        foreach ($RestData as $rest) {
            $dataRow = array();
            $dataRow[] = '<div class="btn-group">
                                <button type="button" class="btn btn-info dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class = "ft-settings"></i> </button> 
                                    <div class="dropdown-menu">
                                        <a data-id="' . $rest->restCode . '" data-action="edit" class="dropdown-item"><i class="fa fa-pencil"></i> Edit</a>
                                        <a  data-id="' . $rest->restCode . '" data-action="view" data-action="view" class="dropdown-item"><i class="ft-eye"></i> View</a>
                                    </div>
                            </div>';

            $dataRow[] = $rest->restCode;
            $dataRow[] = $rest->Description;
            $data[] = $dataRow;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->restday_Model->countAll(),
            "recordsFiltered" => $this->restday_Model->countFiltered($_POST),
            "data" => $data,
        );
// Output to JSON format
        echo json_encode($output);
    }

}
