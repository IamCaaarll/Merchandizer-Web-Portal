<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login_controller extends CI_Controller {

    var $data = array();
    var $user = array();
    var $code = array();
    var $access = array();
    var $email = array();

    public function __construct() {

        parent::__construct();

        $this->load->model("login/login_model");
    }

    function index() {
        $session_data = $this->session->userdata($this->config->item('ses_id'));
        if (!$this->session->userdata($this->config->item('ses_id'))) {

            $this->load->view('login/index', $this->data);
        } else {
            if ($session_data['userType'] == 1) {
                redirect('admin', 'refresh');
            } else {
                redirect('employee', 'refresh');
            }
        }
    }

    function login() {

        $this->session->unset_userdata('recovery');
        $response = array(
            "bool" => true,
            "view" => $this->load->view('login/login', null, true)
        );
        echo json_encode($response);
    }

    function recovery() {

        $response = array(
            "bool" => true,
            "view" => $this->load->view('login/accountRecovery', null, true)
        );
        echo json_encode($response);
    }

    function change() {
        $session = $this->session->userdata($this->config->item('ses_id'));
        if (!empty($session)) {
            // if Session is Not Empty redirect to home
            $response = array(
                "bool" => true,
                "view" => $this->load->view('login/change', null, true)
            );
            echo json_encode($response);
        } else {
            $response = array(
                "bool" => false,
                "view" => $this->load->view('login/login', null, true)
            );
            echo json_encode($response);
        }
    }

    public function save() {

        $id = $this->session->userdata($this->config->item('ses_id'))['id'];
        $entry = array(
            'password' => hash('sha256', trim($this->input->post('new_password')))
        );
        $old_password = $this->login_model->get_oldpassword($id);
        if ($old_password != hash('sha256', trim($this->input->post('old_password')))) {
            $return = array(
                'code' => '02',
                'title' => 'Authentication',
                'message' => 'Wrong Old Password, Please Check your Password!'
            );
            echo json_encode($return);
        } else {
            if ($this->input->post('new_password') == $this->input->post('confrim_password')) {
                $date = date("Y-m-d");
                $date = strtotime(date("Y-m-d", strtotime($date)) . " +30 days");
                $date = date("Y-m-d", $date);

                $entry['password_expiration_date'] = $date;


                $this->login_model->update($entry, $id);
                $this->login_model->update_attempt($id, 0, 0, 0);

                $return = array(
                    'id' => $id,
                    'code' => '01',
                    'return' => 'Successfully Changed'
                );

                $this->session->unset_userdata($this->config->item('ses_id'));
                echo json_encode($return);
            } else {

                $return = array(
                    'code' => '02',
                    'title' => 'Authentication',
                    'message' => "Please check that you've entered and confirmed your password!"
                );
                echo json_encode($return);
            }
        }
    }

    public function saveNew() {

        $id = $this->input->post('id');
        $entry = array(
            'password' => hash('sha256', trim($this->input->post('new_password')))
        );

        $date = date("Y-m-d");
        $date = strtotime(date("Y-m-d", strtotime($date)) . " +30 days");
        $date = date("Y-m-d", $date);

        $entry['password_expiration_date'] = $date;
        $this->login_model->update($entry, $id);
        $this->login_model->update_attempt($id, 0, 0, 0);


        $response = array(
            'bool' => true
        );
        echo json_encode($response);
    }

    function sendCode() {
        $this->data['contact'] = trim($this->input->post('contact'));
        $this->data['empid'] = trim($this->input->post('id'));
        $entry = array('verifyCode' => strtoupper($this->input->post('code')));
        $save = $this->login_model->sendCode($this->data['empid'], $this->data['contact'], $entry);

        if ($save['bool'] == true) {
            $response = array(
                'bool' => true
            );
        }
        echo json_encode($response);
    }

    function checkCode() {
        $this->code = $this->login_model->validate_Code($this->input->post('id'), strtoupper($this->input->post('code')));
        if ($this->code['code'] == 1) {

            $response = array(
                'bool' => true
            );
        } else {
            $response = array(
                'bool' => false
            );
        }

        echo json_encode($response);
    }

    public function keep() {
        $id = $this->session->userdata($this->config->item('ses_id'))['id'];
        $old_password = $this->login_model->get_oldpassword($id);
        $entry = array(
            'password' => $old_password
        );
        $date = date("Y-m-d");
        $date = strtotime(date("Y-m-d", strtotime($date)) . " +30 days");
        $date = date("Y-m-d", $date);

        $entry['password_expiration_date'] = $date;


        $this->login_model->update($entry, $id);
        $this->login_model->update_attempt($id, 0, 0, 0);

        $return = array(
            'id' => $id,
            'code' => '01',
            'return' => 'Successfully Changed'
        );
        $this->session->unset_userdata($this->config->item('ses_id'));
        echo json_encode($return);
    }

    public function log() {
        $result = array();
        $this->data['username'] = trim($this->input->post('username'));
        $this->data['password'] = trim($this->input->post('password'));


        $password_sha = hash('sha256', $this->data['password']);

        $this->user = $this->login_model->validate_user($this->data['username'], $password_sha);

        if ($this->user['code'] == 0) {
            $session_array = array(
                "id" => $this->user['id'],
                "fullname" => $this->user['full_name'],
                "username" => $this->user['username'],
                "change_pass" => "1",
            );
            if ($this->user['locked_account'] == 1) {
                $result["title"] = "Authentication";
                $result["message"] = "Account Locked, Contact Systems Administrator!";
            } elseif (date('Y-m-d', strtotime($this->user['password_expiration_date'])) <= date('Y-m-d', strtotime(date('Y-m-d')))) {
                $result["data"] = "2";
                $result["title"] = "Authentication";
                $result["message"] = "Password Expired!";
                $this->session->set_userdata($this->config->item('ses_id'), $session_array);
            } elseif ($this->user['change_password'] == 1) {
                $result["data"] = "2";
                $result["title"] = "Authentication";
                $result["message"] = "Change Password!";
                $this->session->set_userdata($this->config->item('ses_id'), $session_array);
            } else {

                $this->login_model->update_attempt($this->user['id'], 0, 0, 0);
                $sess_array = array(
                    'id' => $this->user['id'],
                    'firstname' => $this->user['first_name'],
                    'username' => $this->user['username'],
                    'name' => $this->user['full_name'],
                    'emailaddress' => $this->user['emailaddress'],
                    "userType" => $this->user['admin']
                );
                $sess_count = array(
                    'count' => 1
                );
                $this->session->set_userdata('login', $sess_count);
                $this->session->set_userdata($this->config->item('ses_id'), $sess_array);
                $result["data"] = "1";
                $result["userType"] = $this->user['admin'];
            }
        } elseif ($this->user['code'] == 1) {
            if ($this->user['locked_account'] == 1) {
                $result["title"] = "Authentication";
                $result["message"] = "Account Locked, Contact Systems Administrator!";
            } elseif ($this->user['login_attempts'] == 0) {
                $this->login_model->update_attempt($this->user['id'], 1, $this->user['locked_account'], $this->user['change_password']);
                $result["title"] = "Authentication";
                $result["message"] = "Invalid Password! 9 Remaining Attempt";
            } elseif ($this->user['login_attempts'] == 1) {
                $this->login_model->update_attempt($this->user['id'], 2, $this->user['locked_account'], $this->user['change_password']);
                $result["title"] = "Authentication";
                $result["message"] = "Invalid Password! 8 Remaining Attempt";
            }  elseif ($this->user['login_attempts'] == 2) {
                $this->login_model->update_attempt($this->user['id'], 3, $this->user['locked_account'], $this->user['change_password']);
                $result["title"] = "Authentication";
                $result["message"] = "Invalid Password! 7 Remaining Attempt";
            }  elseif ($this->user['login_attempts'] == 3) {
                $this->login_model->update_attempt($this->user['id'], 4, $this->user['locked_account'], $this->user['change_password']);
                $result["title"] = "Authentication";
                $result["message"] = "Invalid Password! 6 Remaining Attempt";
            }  elseif ($this->user['login_attempts'] == 4) {
                $this->login_model->update_attempt($this->user['id'], 5, $this->user['locked_account'], $this->user['change_password']);
                $result["title"] = "Authentication";
                $result["message"] = "Invalid Password! 5 Remaining Attempt";
            }  elseif ($this->user['login_attempts'] == 5) {
                $this->login_model->update_attempt($this->user['id'], 6, $this->user['locked_account'], $this->user['change_password']);
                $result["title"] = "Authentication";
                $result["message"] = "Invalid Password! 4 Remaining Attempt";
            }  elseif ($this->user['login_attempts'] == 6) {
                $this->login_model->update_attempt($this->user['id'], 7, $this->user['locked_account'], $this->user['change_password']);
                $result["title"] = "Authentication";
                $result["message"] = "Invalid Password! 3 Remaining Attempt";
            }  elseif ($this->user['login_attempts'] == 7) {
                $this->login_model->update_attempt($this->user['id'], 8, $this->user['locked_account'], $this->user['change_password']);
                $result["title"] = "Authentication";
                $result["message"] = "Invalid Password! 2 Remaining Attempt";
            }  elseif ($this->user['login_attempts'] == 8) {
                $this->login_model->update_attempt($this->user['id'], 9, $this->user['locked_account'], $this->user['change_password']);
                $result["title"] = "Authentication";
                $result["message"] = "Invalid Password! 1 Remaining Attempt";
            } 
            elseif ($this->user['login_attempts'] == 9) {
                $this->login_model->update_attempt($this->user['id'], 10, $this->user['locked_account'], $this->user['change_password']);
                $result["title"] = "Authentication";
                $result["message"] = "Account Locked, Contact Systems Administrator!";
                $this->login_model->update_attempt($this->user['id'], 0, 1, 0);
            }
            
        } elseif ($this->user['code'] == 2) {
            $result["title"] = "Authentication";
            $result["message"] = $this->user['message'];
        } elseif ($this->user['code'] == 3) {
            $result["title"] = "Authentication";
            $result["message"] = $this->user['message'];
        } elseif ($this->user['code'] == 4) {
            $this->login_model->update_attempt($this->user['id'], 0, 0, 0);
            $sess_array = array(
                'id' => $this->user['id'],
                'firstname' => $this->user['first_name'],
                'username' => $this->user['username'],
                'name' => $this->user['full_name'],
                'template' => $this->user['template'],
                "userType" => $this->user['admin']
            );

            $this->session->set_userdata($this->config->item('ses_id'), $sess_array);
            $result["data"] = "1";
            $result["userType"] = $this->user['admin'];
        }
        echo json_encode($result);
    }

    public function checkEmail() {
        $result = array();
        $this->data['email'] = trim($this->input->post('emailaddress'));

        $this->email = $this->login_model->validate_email($this->data['email']);

        if ($this->email['code'] == 0) {
            $session_array = array(
                "id" => $this->email['id'],
                "fullname" => $this->email['full_name'],
                "username" => $this->email['username'],
                "email" => $this->email['emailaddress'],
                "contact" => $this->email['contact']
            );

            $result["data"] = "1";
            $result["contact"] = $this->email['contact'];
            $result["id"] = $this->email['id'];
            $this->session->set_userdata("recovery", $session_array);
        } elseif ($this->email['code'] == 1) {
            $result["title"] = "Authentication";
            $result["message"] = $this->email['message'];
        } elseif ($this->email['code'] == 2) {
            $result["title"] = "Authentication";
            $result["message"] = $this->email['message'];
        } elseif ($this->email['code'] == 3) {
            $result["title"] = "Authentication";
            $result["message"] = $this->email['message'];
        }
        echo json_encode($result);
    }

}
