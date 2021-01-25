<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class index extends MX_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->model('master_Data/Agency/agency_Model');
        $this->filter = array('Agency');
    }

    function agency() {
        $response = array(
            "bool" => true,
            "view" => $this->load->view('Agency/index', null, true)
        );
        echo json_encode($response);
    }

    public function saveAgency() {
        if ($this->input->post()) {
            $entry = array(
                'Agency' => strtoupper($this->input->post('Agency')),
                'status' => $this->input->post('stats'),
                'created_by' => $this->session->userdata($this->config->item('ses_id'))['username'],
                'date_created' => date('Y-m-d h:i:s'),
                'ip_created' => $this->input->ip_address(),
                'terminal_created' => php_uname("n")
            );

            $save = $this->agency_Model->saveData($entry, $this->filter);

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

    public function updateAgency($update_id) {

        if ($this->input->post()) {
            $entry = array(
                'Agency' => strtoupper($this->input->post('Agency')),
                'status' => $this->input->post('stats'),
                'modified_by' => $this->session->userdata($this->config->item('ses_id'))['username'],
                'date_modified' => date('Y-m-d h:i:s'),
                'ip_modified' => $this->input->ip_address(),
                'terminal_modified' => php_uname("n")
            );

            $update = $this->agency_Model->updateData($entry, $this->filter, $update_id);

            if ($update['bool'] == true) {
                $result = array(
                    "bool" => $update['bool'],
                    "message" => $update['message']
                );
            } else {
                $result = array(
                    "bool" => $update['bool'],
                    "message" => $update['message']
                );
            }
            echo json_encode($result);
        }
    }

    function getLists() {
        $data = array();

// Fetch member's records
        $agencyData = $this->agency_Model->getRows($_POST);

        $i = $_POST['start'];
        foreach ($agencyData as $agency) {
            $i++;
            $dataRow = array();
            $dataRow[] = '<div class="btn-group">
                                <button type="button" class="btn btn-info dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class = "ft-settings"></i> </button>
                                    <div class="dropdown-menu">
                                        <a data-id="' . $agency->id . '" data-action="edit" class="dropdown-item"><i class="fa fa-pencil"></i> Edit</a>
                                        <a data-id="' . $agency->id . '" data-action="view" data-action="view" class="dropdown-item"><i class="ft-eye"></i> View</a>
                                    </div>
                            </div>';
            $dataRow[] = $agency->Agency;
            $dataRow[] = ($agency->status == 0) ? '<div class="badge badge-danger">Inactive</div>' : '<div class="badge badge-success">Active</div>';
            $data[] = $dataRow;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->agency_Model->countAll(),
            "recordsFiltered" => $this->agency_Model->countFiltered($_POST),
            "data" => $data,
        );

// Output to JSON format
        echo json_encode($output);
    }

}
