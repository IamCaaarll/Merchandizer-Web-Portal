<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class index extends MX_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->model('master_Data/Merchandizer/merch_Model');
        $this->filter = array('username');
    }

    function merch() {
        $data['agencyData'] = $this->merch_Model->getAgency();
        $data['storeData'] = $this->merch_Model->getStore();
        $response = array(
            "bool" => true,
            "view" => $this->load->view('Merchandizer/index', $data, true)
        );
        echo json_encode($response);
    }

    public function saveMerch() {
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
                'agency' => strtoupper($this->input->post('cbo_Agency')),
                'store' => strtoupper($this->input->post('cbo_Store')),
                'username' => $this->input->post('userid'),
                'password' => hash('sha256', $this->input->post('password')),
                'template' => 'hmt',
                'locked_account' => strtoupper($this->input->post('locked')),
                'change_password' => $this->input->post('change'),
                'manager' => strtoupper($this->input->post('manager')),
                'active' => $this->input->post('stats'),
                'admin' => 0,
                'acmanager' => 0,
                'password_expiration_date' => $final,
                'login_attempts' => 0,
                'created_by' => $this->session->userdata($this->config->item('ses_id'))['username'],
                'date_created' => date('Y-m-d h:i:s'),
                'ip_created' => $this->input->ip_address(),
                'terminal_created' => php_uname("n")
            );

            $save = $this->merch_Model->saveData($entry, $this->filter);

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

    public function resetPass($id) {
        if ($this->input->post()) {
            $entry = array(
                'password' => hash('sha256', $this->input->post('newpassword')),
                'change_password' => 1
            );
            $update = $this->merch_Model->updatePassword($entry, $id);
            if ($update['bool'] == true) {
                $send = $this->merch_Model->sendnewPass($this->input->post('contact'), $this->input->post('newpassword'));
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

    public function updateMerch($update_id) {

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
                'agency' => strtoupper($this->input->post('cbo_Agency')),
                'store' => strtoupper($this->input->post('cbo_Store')),
                'username' => $this->input->post('userid'),
                'template' => 'hmt',
                'locked_account' => $this->input->post('locked'),
                'change_password' => $this->input->post('change'),
                'active' => $this->input->post('stats'),
                'manager' => strtoupper($this->input->post('manager')),
                'admin' => 0,
                'password_expiration_date' => $final,
                'login_attempts' => 0,
                'modified_by' => $this->session->userdata($this->config->item('ses_id'))['username'],
                'date_modified' => date('Y-m-d h:i:s'),
                'ip_modified' => $this->input->ip_address(),
                'terminal_modified' => php_uname("n")
            );

            $update = $this->merch_Model->updateData($entry, null, $update_id);

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

    public function getMerch($id) {
        $update = $this->merch_Model->getMerch($id);
        $result = array(
            "fname" => $update[0]->first_name,
            "mname" => $update[0]->middle_name,
            "lname" => $update[0]->last_name,
            "address" => $update[0]->address,
            "eaddress" => $update[0]->emailaddress,
            "contNum" => $update[0]->contact,
            "cbo_Agency" => $update[0]->agency,
            "cbo_Store" => $update[0]->store,
            "userid" => $update[0]->username,
            "password" => $update[0]->password,
            "change" => $update[0]->change_password,
            "locked" => $update[0]->locked_account,
            "active" => $update[0]->active
        );
        echo json_encode($result);
    }


    function getLists() {
        $data = array();

// Fetch member's records
        $merchData = $this->merch_Model->getRows($_POST);

        $i = $_POST['start'];
        foreach ($merchData as $merch) {
            $i++;
            $dataRow = array();
            $dataRow[] = '<div class="btn-group">
                                <button type="button" class="btn btn-info dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class = "ft-settings"></i> </button>
                                    <div class="dropdown-menu">
                                        <a data-id="' . $merch->id . '" data-action="edit" class="dropdown-item"><i class="fa fa-pencil"></i> Edit</a>
                                        <a data-id="' . $merch->id . '" data-action="view" class="dropdown-item"><i class="ft-eye"></i> View</a>
                                        <a data-id="' . $merch->id . '" data-action="reset" class="dropdown-item"><i class="ft-lock"></i> Reset Password</a>
                                    </div>
                            </div>';
            $dataRow[] = $merch->username;
            $dataRow[] = $merch->full_name;
            $dataRow[] = "+63" . $merch->contact;
            $dataRow[] = $merch->Agency;
            $dataRow[] = $merch->storeName;
            $dataRow[] = ($merch->active == 0) ? '<div class="badge badge-danger">Inactive</div>' : '<div class="badge badge-success">Active</div>';
            $data[] = $dataRow;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->merch_Model->countAll(),
            "recordsFiltered" => $this->merch_Model->countFiltered($_POST),
            "data" => $data,
        );

// Output to JSON format
        echo json_encode($output);
    }

}
