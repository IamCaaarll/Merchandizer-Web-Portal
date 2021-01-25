<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class index extends MX_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->model('master_Data/Report/report_Model');
        $this->filter = array('Agency');
    }

    function menu() {
        $response = array(
            "bool" => true,
            "view" => $this->load->view('Report/index', null, true)
        );
        echo json_encode($response);
    }

    function Summary() {
        $response = array(
            "bool" => true,
            "view" => $this->load->view('Report/summary', null, true)
        );
        echo json_encode($response);
    }

    function Logs() {
        $response = array(
            "bool" => true,
            "view" => $this->load->view('Report/logs', null, true)
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

            $save = $this->report_Model->saveData($entry, $this->filter);

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

            $update = $this->report_Model->updateData($entry, $this->filter, $update_id);

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
        $search_by = $this->input->post('searchBy');
// Fetch member's records
        $reportData = $this->report_Model->getRows($_POST, $search_by);

        $i = $_POST['start'];
        foreach ($reportData as $report) {
            $i++;
            $dataRow = array();
            $dataRow[] = $report->full_name;
            $dataRow[] = date("m/d/Y", strtotime($report->date_created));
            $dataRow[] = $report->timein;
            $dataRow[] = $report->morningout;
            $dataRow[] = $report->afternoonin;
            $dataRow[] = $report->timeout;
            $data[] = $dataRow;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->report_Model->countAll(),
            "recordsFiltered" => $this->report_Model->countFiltered($_POST, $search_by),
            "data" => $data,
        );

// Output to JSON format
        echo json_encode($output);
    }

    function FgetLists() {
        $data = array();
        $search_by = $this->input->post('searchBy');
        $dateFrom = $this->input->post('datefrom');
        $dateTo = $this->input->post('dateto');
// Fetch member's records
        $reportData = $this->report_Model->FgetRows($_POST, $dateFrom, $dateTo, $search_by);

        $i = $_POST['start'];
        foreach ($reportData as $report) {
            $i++;
            $dataRow = array();
            $dataRow[] = $report->full_name;
            $dataRow[] = date("m/d/Y", strtotime($report->date_created));
            $dataRow[] = $report->timein;
            $dataRow[] = $report->morningout;
            $dataRow[] = $report->afternoonin;
            $dataRow[] = $report->timeout;
            $data[] = $dataRow;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->report_Model->FcountAll($dateFrom, $dateTo),
            "recordsFiltered" => $this->report_Model->FcountFiltered($_POST, $dateFrom, $dateTo, $search_by),
            "data" => $data,
        );
// Output to JSON format
        echo json_encode($output);
    }

    function LgetLists() {
        $data = array();
// Fetch member's records
        $search_by = $this->input->post('searchBy');
        $reportlogData = $this->report_Model->LgetRows($_POST, $search_by);

        $i = $_POST['start'];
        foreach ($reportlogData as $logs) {
            $i++;
            $dataRow = array();
            $dataRow[] = $logs->full_name;
            $dataRow[] = $logs->date_created;
            $dataRow[] = $logs->time;
            $dataRow[] = $logs->event;
            $data[] = $dataRow;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->report_Model->LcountAll(),
            "recordsFiltered" => $this->report_Model->LcountFiltered($_POST, $search_by),
            "data" => $data,
        );

        // Output to JSON format
        echo json_encode($output);
    }

    function LFgetLists() {
        $data = array();
        $search_by = $this->input->post('searchBy');
        $dateFrom = $this->input->post('datefrom');
        $dateTo = $this->input->post('dateto');
        // Fetch member's records
        $reportData = $this->report_Model->LFgetRows($_POST, $dateFrom, $dateTo, $search_by);

        $i = $_POST['start'];
        foreach ($reportData as $logs) {
            $i++;
            $dataRow = array();
            $dataRow[] = $logs->full_name;
            $dataRow[] = $logs->date_created;
            $dataRow[] = $logs->time;
            $dataRow[] = $logs->event;
            $data[] = $dataRow;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->report_Model->LFcountAll($dateFrom, $dateTo),
            "recordsFiltered" => $this->report_Model->LFcountFiltered($_POST, $dateFrom, $dateTo, $search_by),
            "data" => $data,
        );
        // Output to JSON format
        echo json_encode($output);
    }

}
