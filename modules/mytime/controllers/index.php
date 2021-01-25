<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class index extends CI_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->model('mytime/time_Model');
    }

    function change() {
        $response = array(
            "bool" => true,
            "view" => $this->load->view('index', null, true)
        );
        echo json_encode($response);
    }

    function resetCount() {
        $sess_array = array(
            "count" => '2',
        );
        $this->session->set_userdata(login, $sess_array);
        echo json_encode($response);
    }

    function timein() {
        if ($this->input->post()) {
            $entry = array(
                'merchID' => $this->session->userdata($this->config->item('ses_id'))['id'],
                'timein' => date('h:i A'),
                'store' => $this->input->post('store'),
                'created_by' => $this->session->userdata($this->config->item('ses_id'))['username'],
                'date_created' => date('m/d/Y'),
                'ip_created' => $this->input->ip_address(),
                'terminal_created' => php_uname("n")
            );
            $save = $this->time_Model->timeIn($entry);

            if ($save['bool'] == true) {
                $result = array(
                    "bool" => $save['bool'],
                    "message" => $save['message']
                );
            } else {
                $result = array(
                    "bool" => $save['bool'],
                    "message" => $save['message']
                );
            }
            echo json_encode($result);
        }
    }

    function getInfo($id) {
        $get = $this->time_Model->getInfo($id);
        $result = array(
            "data" => $get
        );
        echo json_encode($result);
    }

    function mornOut() {
        if ($this->input->post()) {
            $entry = array(
                'morningout' => date('h:i A')
            );

            $update = $this->time_Model->mornOut($entry, $this->input->post('merchID'));

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

    function afternoonIn() {
        if ($this->input->post()) {
            $entry = array(
                'afternoonin' => date('h:i A')
            );

            $update = $this->time_Model->afternoonIn($entry, $this->input->post('merchID'));

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

    function timeout() {
        if ($this->input->post()) {
            $entry = array(
                'timeout' => date('h:i A')
            );

            $update = $this->time_Model->timeOut($entry, $this->input->post('merchID'));

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

    function timeinLogs() {
        if ($this->input->post()) {
            $entry = array(
                'merchId' => $this->session->userdata($this->config->item('ses_id'))['id'],
                'event' => $this->input->post('event'),
                'time' => $this->input->post('time'),
                'created_by' => $this->session->userdata($this->config->item('ses_id'))['username'],
                'date_created' => date('m/d/Y'),
                'ip_created' => $this->input->ip_address(),
                'terminal_created' => php_uname("n")
            );

            $save = $this->time_Model->timeInlogs($entry);

            if ($save['bool'] == true) {
                $result = array(
                    "bool" => $save['bool'],
                    "message" => $save['message']
                );
            } else {
                $result = array(
                    "bool" => $save['bool'],
                    "message" => $save['message']
                );
            }
            echo json_encode($result);
        }
    }

    function getTime() {
        $entry = array(
            'merchID' => $this->session->userdata($this->config->item('ses_id'))['id'],
            'date_created' => date('m/d/Y'),
        );

        $save = $this->time_Model->check($entry);

        if ($save['bool'] == true) {
            $result = array(
                "bool" => $save['bool']
            );
        } else {
            $result = array(
                "bool" => $save['bool']
            );
        }
        echo json_encode($result);
    }

}
