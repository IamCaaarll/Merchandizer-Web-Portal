<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class index extends MX_Controller {

    public function __construct() {

        parent::__construct();
     
    }

    function sched() {
        $response = array(
            "bool" => true,
            "view" => $this->load->view('Schedule/index', null, true)
        );
        echo json_encode($response);
    }


}
