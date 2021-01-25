<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class index extends MX_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->model('master_Data/Menu/menu_Model');
    }

    function menu() {
        $response = array(
            "bool" => true,
            "view" => $this->load->view('Menu/index', null, true)
        );
        echo json_encode($response);
    }

    function getAccess() {
        $get = $this->menu_Model->getAccess($this->input->post('id'), $this->input->post('module'));
        $result = array(
            "status" => $get['status']
        );
        echo json_encode($result);
    }

    function getAllAccess() {
        $get = $this->menu_Model->getAllAccess($this->input->post('id'));
        $result = array();
        foreach ($get as $access) {
            $result[] = array("name" =>  $access->module, "status" => 1);
        }
         echo json_encode($result);
    }

}
