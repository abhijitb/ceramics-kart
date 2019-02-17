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
}