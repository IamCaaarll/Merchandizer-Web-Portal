<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class index extends MX_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->model('master_Data/Store/store_Model');
        $this->filter = array('storeName', 'sapCode');
    }

    function store() {
        $data['managerData'] = $this->store_Model->getManager();
        $response = array(
            "bool" => true,
            "view" => $this->load->view('Store/index', $data, true)
        );
        echo json_encode($response);
    }

    function map() {
        $response = array(
            "bool" => true,
            "view" => $this->load->view('Store/map', null, true)
        );
        echo json_encode($response);
    }

    public function saveStore() {
        if ($this->input->post()) {
            $entry = array(
                'sapCode' => strtoupper($this->input->post('sapCode')),
                'storeName' => strtoupper($this->input->post('storeName')),
                'geoLocation' => strtoupper($this->input->post('geoLocation')),
                'accManager' => ($this->input->post('accManager') == 0) ? NULL : $this->input->post('accManager'),
                'geoID' => strtoupper($this->input->post('geoID')),
                'geolng' => strtoupper($this->input->post('geoLng')),
                'geolat' => strtoupper($this->input->post('geoLat')),
                'geoFence' => strtoupper($this->input->post('geoFence')),
                'status' => $this->input->post('stats'),
                'created_by' => $this->session->userdata($this->config->item('ses_id'))['username'],
                'date_created' => date('Y-m-d h:i:s'),
                'ip_created' => $this->input->ip_address(),
                'terminal_created' => php_uname("n")
            );

            $save = $this->store_Model->saveData($this->input->post('accManager'), $entry, $this->filter);

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

    public function getManager() {

        $response = array(
            "paymentTerms" => $this->store_Model->getManagers()->result_array()
        );

        echo json_encode($response);
    }

    public function getPaymentTerms($id) {
        $dataRow = array(
            "id" => $this->store_Model->getPaymentTerms($id)->row()->id,
            "description" => $this->store_Model->getPaymentTerms($id)->row()->description,
        );
        echo json_encode($dataRow);
    }

    public function updateStore($update_id) {

        if ($this->input->post()) {
            $entry = array(
                'sapCode' => strtoupper($this->input->post('sapCode')),
                'storeName' => strtoupper($this->input->post('storeName')),
                'accManager' => strtoupper($this->input->post('accManager')),
                'geoLocation' => strtoupper($this->input->post('geoLocation')),
                'geoID' => strtoupper($this->input->post('geoID')),
                'geolng' => strtoupper($this->input->post('geoLng')),
                'geolat' => strtoupper($this->input->post('geoLat')),
                'geoFence' => strtoupper($this->input->post('geoFence')),
                'status' => $this->input->post('stats'),
                'modified_by' => $this->session->userdata($this->config->item('ses_id'))['username'],
                'date_modified' => date('Y-m-d h:i:s'),
                'ip_modified' => $this->input->ip_address(),
                'terminal_modified' => php_uname("n")
            );
            $update = $this->store_Model->updateData($entry, $this->filter, $update_id);
            if ($this->input->post('accManager') != $this->input->post('oldManager')) {
                $this->store_Model->updateStoreData($this->input->post('oldManager'), $update_id, $this->input->post('accManager'));
            }
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

// Fetch member's records
        $storeData = $this->store_Model->getRows($_POST);

        $i = $_POST['start'];
        foreach ($storeData as $store) {
            $i++;
            $dataRow = array();
            $dataRow[] = '<div class="btn-group">
                                <button type="button" class="btn btn-info dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class = "ft-settings"></i> </button> 
                                    <div class="dropdown-menu">
                                        <a data-accmanager="' . $store->accManager . '"  data-id="' . $store->id . '" data-loc="' . $store->geoLocation . '" data-gid="' . $store->geoID . '" data-lng="' . $store->geolng . '" data-lat="' . $store->geolat . '" data-fen="' . $store->geoFence . '" data-action="edit" class="dropdown-item"><i class="fa fa-pencil"></i> Edit</a>
                                        <a data-accmanager="' . $store->accManager . '"  data-id="' . $store->id . '" data-loc="' . $store->geoLocation . '" data-gid="' . $store->geoID . '" data-lng="' . $store->geolng . '" data-lat="' . $store->geolat . '" data-fen="' . $store->geoFence . '" data-action="view" data-action="view" class="dropdown-item"><i class="ft-eye"></i> View</a>
                                    </div>
                            </div>';
            $dataRow[] = $store->sapCode;
            $dataRow[] = $store->geoLocation;
            $dataRow[] = $store->storeName;
            $dataRow[] = $store->manager;
            $dataRow[] = ($store->status == 0) ? '<div class="badge badge-danger">Inactive</div>' : '<div class="badge badge-success">Active</div>';
            $data[] = $dataRow;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->store_Model->countAll(),
            "recordsFiltered" => $this->store_Model->countFiltered($_POST),
            "data" => $data,
        );

// Output to JSON format
        echo json_encode($output);
    }

}
