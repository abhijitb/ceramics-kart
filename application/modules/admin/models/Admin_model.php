<?php

class Admin_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function insertCustomData($data) {
        $this->db->insert_batch('lists', $data);
    }

    public function getSmsList() {
        $query = $this->db->get('lists');
        return $query->result();  
    }

    public function getUserInfo($user_ids){
        $this->db->where_in('id', $user_ids);
        $query = $this->db->get('lists');
        return $query->result();
    }

    public function insertSmsLog($data) {
        $this->db->insert('sms_reports', $data);
        return $this->db->insert_id();
    }
    
    public function updateSmsLog($data) {
        $this->db->where('message_id', $data['message_id']);
        $this->db->update('sms_reports', $data);
        return $this->db->insert_id();
    }
    
    public function getUserInfoFromCode($user_code){
        $this->db->where('code', $user_code);
        $query = $this->db->get('lists');
        return $query->row_array();
    }

    public function insertTrackingInfo($data) {
        $this->db->insert('tracking_info', $data);
        return $this->db->insert_id();
    }

    public function getTrackingInfo() {
        $query = $this->db->get('tracking_info');
        return $query->result();  

    }

    public function getSmsData() {
        $query = $this->db->get('sms_reports');
        return $query->result();
    }

    public function getUserApiKey($user_id) {
        $this->db->from('rest_api_keys');
        $this->db->where(array('user_id' => $user_id));
        $result = $this->db->get();
        return $result->row_array();
    }

    public function updateApiKey($id, $data) {
        $this->db->where('user_id', $id);
        $q = $this->db->get('rest_api_keys');
        $this->db->reset_query();
        if ($q->num_rows() > 0) {
            return $this->db->where('user_id', $id)->update('rest_api_keys', $data);
        } else {
            return $this->db->set('user_id', $id)->insert('rest_api_keys', $data);
        }
    }

    public function getUserDetailsFromApiKey($api_key) {
        $sql = "select * from users where id = (select user_id from rest_api_keys where `key` = '{$api_key}')";
        $query = $this->db->query($sql);
        return $query->row_array();
    }

    public function getAllUsers() {
        $query = $this->db->get('users');
        return $query->result();
    }

    public function getUser($id) {
        $this->db->from('users');
        $this->db->where(array('id' => $id));
        $result = $this->db->get();
        return $result->row();
    }

    public function getTables() {
        return $this->db->list_tables();
    }

    public function getTableFields($table) {
        return $this->db->list_fields($table);
    }

    public function insertCsvData($data) {
        $this->db->where('csv_filename', $data['csv_filename']);
        $query = $this->db->get('csv_data');

        if ($query->num_rows() > 0 ) {
            return $query->row_array();
        } else {
            $this->db->insert('csv_data', $data);
            return $this->db->insert_id();    
        }
    }

    public function getCsvData($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('csv_data');
        return $query->row_array();
    }

    public function insertData($table, $data) {
        $this->db->insert_batch($table, $data);
    }

}