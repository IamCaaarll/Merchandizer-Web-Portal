<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class index extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    function index() {
       $session_data = $this->session->userdata($this->config->item('ses_id'));
         if (!$session_data) {
             redirect('login', 'refresh');
        }
        $this->load->view('index');
    }
    function admin() {
       $session_data = $this->session->userdata($this->config->item('ses_id'));
         if (!$session_data) {
             redirect('login', 'refresh');
        }
        $this->load->view('Aindex');
    }
    
    function employee() {
       $session_data = $this->session->userdata($this->config->item('ses_id'));
         if (!$session_data) {
             redirect('login', 'refresh');
        }
         $this->load->view('Eindex');
    }
    

    public function sign_out() { 
        $this->session->unset_userdata($this->config->item('ses_id'));
        $response = array(
            "bool" => true,
            "message" => 'test'
        );

        echo json_encode($response);
    }
}
