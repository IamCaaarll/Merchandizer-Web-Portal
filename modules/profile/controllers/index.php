<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class index extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('profile/profile_Model');
    }

    function prof() {
        $response = array(
            "bool" => true,
            "view" => $this->load->view('index', null, true)
        );
        echo json_encode($response);
    }

    function updateContact() {
        $filter = array(
            'id' => $this->input->post('id')
        );

    
        $check = $this->profile_Model->checkOld($this->input->post('old'), $this->input->post('id'));
        if ($check['bool'] == true) {
            $change = $this->profile_Model->changeContact($this->input->post('new'), $filter);

            if ($change['bool'] == true) {
                $result = array(
                    "bool" => $change['bool'],
                    "message" => $change['message']
                );
            } else {
                $result = array(
                    "bool" => false,
                    "message" => $change['message']
                );
            }
        } else {
            $result = array(
                "bool" => false,
                "message" => $check['message']
            );
        }

        echo json_encode($result);
    }

}
