<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class index extends MX_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->model('master_Data/Admin/admin_Model');
        $this->filter = array('username');
    }

    function admin() {
        $response = array(
            "bool" => true,
            "view" => $this->load->view('Admin/index', null, true)
        );
        echo json_encode($response);
    }

    function Module() {
        $response = array(
            "module" => $this->admin_Model->Module()->result_array()
        );

        echo json_encode($response);
    }

    function getModule() {
        if ($this->input->post()) {
            $check = $this->admin_Model->getModule($this->input->post('moduleID'), $this->input->post('userID'));

            if ($check['bool'] == true) {

                $result = array(
                    "bool" => $check['bool']
                );
            } else {
                $result = array(
                    "bool" => $check['bool']
                );
            }
            echo json_encode($result);
        }
//        $data['moduleData'] = $this->admin_Model->getModule($this->input->post('userID'));
//        $response = array(
//            "bool" => true,
//            "view" => $this->load->view('Admin/module', $data, true)
//        );
//        echo json_encode($response);
    }

    public function saveAdmin() {
        if ($this->input->post()) {
            $time = strtotime(date('Y-m-d h:i:s'));
            $final = date("Y-m-d h:i:s", strtotime("+1 month", $time));
            $entry = array(
                'first_name' => strtoupper($this->input->post('fname')),
                'middle_name' => strtoupper($this->input->post('mname')),
                'last_name' => strtoupper($this->input->post('lname')),
                'address' => $this->input->post('address'),
                'emailaddress' => $this->input->post('eaddress'),
                'contact' => strtoupper($this->input->post('contNum')),
                'username' => $this->input->post('userid'),
                'password' => hash('sha256', $this->input->post('password')),
                'template' => 'hmt',
                'locked_account' => strtoupper($this->input->post('locked')),
                'change_password' => $this->input->post('change'),
                'active' => $this->input->post('stats'),
                'admin' => 1,
                'acmanager' => 0,
                'password_expiration_date' => $final,
                'login_attempts' => 0,
                'created_by' => $this->session->userdata($this->config->item('ses_id'))['username'],
                'date_created' => date('Y-m-d h:i:s'),
                'ip_created' => $this->input->ip_address(),
                'terminal_created' => php_uname("n")
            );

            $save = $this->admin_Model->saveData($entry, $this->filter);

            if ($save['bool'] == true) {
                $result = array(
                    "bool" => $save['bool'],
                    "userID" => $save['id'],
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

    public function saveAdminAccess() {
        if ($this->input->post()) {

            $access = array(
                'userID' => $this->input->post('id'),
                'module' => $this->input->post('module')
            );
            $save = $this->admin_Model->saveAdminAccess($access);

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

    public function saveAccess() {
        if ($this->input->post()) {

            $access = array(
                'userID' => $this->input->post('id'),
                'module' => $this->input->post('module'),
                'status' => 1
            );
            $save = $this->admin_Model->saveAdminAccess($access);

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

    public function updateAdminAccess() {
        if ($this->input->post()) {
            $filter = array(
                'userID' => $this->input->post('id')
            );
            $delete = $this->admin_Model->updateAccessData($filter);

            if ($delete['bool'] == true) {
                $result = array(
                    "bool" => $delete['bool'],
                    "message" => $delete['message']
                );
            } else {
                $result = array(
                    "bool" => false,
                    "message" => $delete['message']
                );
            }
            echo json_encode($result);
        }
    }

    public function resetPass($id) {
        if ($this->input->post()) {
            $entry = array(
                'password' => hash('sha256', $this->input->post('newpassword')),
                'change_password' => 1
            );
            $update = $this->admin_Model->updatePassword($entry, $id);
            if ($update['bool'] == true) {
                $send = $this->admin_Model->sendnewPass($this->input->post('contact'), $this->input->post('newpassword'));
                $result = array(
                    "bool" => $update['bool'],
                    "message" => $update['message']
                );
            } else {
                $result = array(
                    "bool" => false,
                    "message" => $update['message']
                );
            }
            echo json_encode($result);
        }
    }

    public function updateAdmin($update_id) {

        if ($this->input->post()) {
            $time = strtotime(date('Y-m-d h:i:s'));
            $final = date("Y-m-d h:i:s", strtotime("+1 month", $time));
            $entry = array(
                'first_name' => strtoupper($this->input->post('fname')),
                'middle_name' => strtoupper($this->input->post('mname')),
                'last_name' => strtoupper($this->input->post('lname')),
                'address' => $this->input->post('address'),
                'emailaddress' => $this->input->post('eaddress'),
                'contact' => strtoupper($this->input->post('contNum')),
                'store' => strtoupper($this->input->post('cbo_Store')),
                'username' => $this->input->post('userid'),
                'template' => 'hmt',
                'locked_account' => strtoupper($this->input->post('locked')),
                'change_password' => $this->input->post('change'),
                'active' => $this->input->post('stats'),
                'admin' => 1,
                'password_expiration_date' => $final,
                'login_attempts' => 0,
                'modified_by' => $this->session->userdata($this->config->item('ses_id'))['username'],
                'date_modified' => date('Y-m-d h:i:s'),
                'ip_modified' => $this->input->ip_address(),
                'terminal_modified' => php_uname("n")
            );

            $update = $this->admin_Model->updateData($entry, null, $update_id);

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

    public function getAdmin($id) {
        $update = $this->admin_Model->getAdmin($id);

        $result = array(
            "fname" => $update[0]->first_name,
            "eaddress" => $update[0]->emailaddress,
            "mname" => $update[0]->middle_name,
            "lname" => $update[0]->last_name,
            "address" => $update[0]->address,
            "contNum" => $update[0]->contact,
            "userid" => $update[0]->username,
            "password" => $update[0]->password,
            "change" => $update[0]->change_password,
            "locked" => $update[0]->locked_account,
            "active" => $update[0]->active,
            "admin" => $update[0]->admin
        );
        echo json_encode($result);
    }

    function getLists() {
        $data = array();

// Fetch member's records
        $adminData = $this->admin_Model->getRows($_POST);

        $i = $_POST['start'];
        foreach ($adminData as $admin) {
            $i++;
            $dataRow = array();
            $dataRow[] = '<div class="btn-group">
                                <button type="button" class="btn btn-info dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class = "ft-settings"></i> </button>
                                    <div class="dropdown-menu">
                                        <a data-id="' . $admin->id . '" data-action="edit" class="dropdown-item"><i class="fa fa-pencil"></i> Edit</a>
                                        <a data-id="' . $admin->id . '" data-action="view" class="dropdown-item"><i class="ft-eye"></i> View</a>
                                        <a data-id="' . $admin->id . '" data-action="reset" class="dropdown-item"><i class="ft-lock"></i> Reset Password</a>
                                    </div>
                            </div>';
            $dataRow[] = $admin->username;
            $dataRow[] = $admin->full_name;
            $dataRow[] = "+63" . $admin->contact;
            $dataRow[] = ($admin->active == 0) ? '<div class="badge badge-danger">Inactive</div>' : '<div class="badge badge-success">Active</div>';
            $data[] = $dataRow;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->admin_Model->countAll(),
            "recordsFiltered" => $this->admin_Model->countFiltered($_POST),
            "data" => $data,
        );

// Output to JSON format
        echo json_encode($output);
    }

    function getListsAccess() {
        $data = array();

// Fetch member's records
        $adminMenu = $this->admin_Model->getAccessRows($_POST);

        $i = $_POST['start'];
        foreach ($adminMenu as $menu) {
            $dataRow = array();

            $dataRow[] = ($menu->status == 0) ? '<input type = "checkbox" checked class = "input-chk checked">' : '<input type = "checkbox" class = "input-chk">';
            $dataRow[] = $menu->module;
            $data[] = $dataRow;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->admin_Model->countAllAccess(),
            "recordsFiltered" => $this->admin_Model->countFilteredAccess($_POST),
            "data" => $data,
        );

// Output to JSON format
        echo json_encode($output);
    }

}
