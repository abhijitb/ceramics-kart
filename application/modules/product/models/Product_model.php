<?php

class Product_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getColours($application) {
        $sql = "select DISTINCT colour from item_by_application_and_colour where application = '{$application}'";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function getSizes($application) {
        $sql = "select DISTINCT size from item_by_application_and_colour where application = '{$application}'";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function getFinishes($application) {
        $sql = "select DISTINCT finish from item_by_application_and_colour where application = '{$application}'";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function getTiles($application) {
        $this->db->where('application', $application);
        $query = $this->db->get('item_by_application_and_colour');
        return $query->result_array();
    }
}
