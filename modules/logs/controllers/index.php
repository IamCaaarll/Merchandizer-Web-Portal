<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class index extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('logs/logs_Model');
    }

    function logsIndex() {
        $response = array(
            "bool" => true,
            "view" => $this->load->view('index', null, true)
        );
        echo json_encode($response);
    }

    function getLists($id) {
        $data = array();

// Fetch member's records
        $logData = $this->logs_Model->getRows($_POST, $id);

        $i = $_POST['start'];
        foreach ($logData as $logs) {
            $i++;
            $dataRow = array();
            $dataRow[] = '<button type="button" data-date="' . $logs->date_created . '" class="btn btn-info btn-sm"><i class = "ft-eye"></i> </button>';
            $dataRow[] = $logs->date_created;
            $dataRow[] = $logs->timein;
            $dataRow[] = $logs->morningout;
            $dataRow[] = $logs->afternoonin;
            $dataRow[] = $logs->timeout;
            $data[] = $dataRow;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->logs_Model->countAll($id),
            "recordsFiltered" => $this->logs_Model->countFiltered($_POST, $id),
            "data" => $data,
        );

// Output to JSON format
        echo json_encode($output);
    }

    function getLLists($id) {
        $data = array();

// Fetch member's records
        $logData = $this->logs_Model->getLRows($_POST, $id, $this->input->post('date'));

        $i = $_POST['start'];
        foreach ($logData as $logs) {
            $dataRow = array();
            $dataRow[] = $logs->date_created;
            $dataRow[] = $logs->time;
            $dataRow[] = $logs->event;
            $data[] = $dataRow;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->logs_Model->countLAll($id, $this->input->post('date')),
            "recordsFiltered" => $this->logs_Model->countLFiltered($_POST, $id, $this->input->post('date')),
            "data" => $data,
        );

// Output to JSON format
        echo json_encode($output);
    }

}
