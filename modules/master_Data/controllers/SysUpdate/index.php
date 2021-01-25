<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class index extends MX_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->model('master_Data/SysUpdate/SysUpdate_Model');
    }

    function sysUpdate() {

        $data['storeData'] = $this->SysUpdate_Model->get_Recipient();
        $response = array(
            "bool" => true,
            "view" => $this->load->view('SysUpdate/index', $data, true)
        );
        echo json_encode($response);
    }

}
