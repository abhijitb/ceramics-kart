<?php

class Location_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function store_location_details($location_details) {
        $this->db->where('session_id', $location_details['session_id']);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get('user_location');

        if ($query->num_rows() > 0 ) {
            $this->db->update('user_location', $location_details);
            return $query->row_array();
        } else {
            $this->db->insert('user_location', $location_details);
            $id = $this->db->insert_id();
            $query = $this->db->get_where('user_location', array('id' => $id));
            return $query->row_array();
        }
    }

    public function fetch_location_details($session_id) {
        $this->db->where('session_id', $session_id);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get('user_location');
        return $query->row_array();
    }

    public function get_cities() {
        $query = $this->db->get('city_master');
        return $query->row_array();

    }
}
