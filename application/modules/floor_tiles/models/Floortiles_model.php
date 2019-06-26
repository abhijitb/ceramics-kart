<?php

class Floortiles_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->type = 'Floor Tile';
    }

    public function getColours() {
        $sql = "select DISTINCT colour from item_by_application_and_colour where product_type = '{$this->type}'";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function getSizes() {
        $sql = "select DISTINCT size from item_by_application_and_colour where product_type = '{$this->type}'";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function getFinishes() {
        $sql = "select DISTINCT finish from item_by_application_and_colour where product_type = '{$this->type}'";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function getApplications() {
        $sql = "select DISTINCT application from item_by_application_and_colour where product_type = '{$this->type}'";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function getFloorTiles() {
        $this->db->where('product_type', 'Floor Tile');
        $query = $this->db->get('item_by_application_and_colour');
        return $query->result_array();
    }
    
    public function getFloorTileById($tile_id) {
        $this->db->where('id', $tile_id);
        $query = $this->db->get('item_by_application_and_colour');
        return $query->row_array();
    }
    
    public function getRetailerDetails($retailer_number) {
        $this->db->where('retailer_number', $retailer_number);
        $query = $this->db->get('retailer_master_list');
        return $query->result_array();

    }

    public function getDealerDetails($dealer_number) {
        $this->db->where('dealer_number', $dealer_number);
        $query = $this->db->get('dealer_master_list');
        return $query->result_array();

    }

    public function getManufacturerDetails($manufacturer_number) {
        $this->db->where('manufacturer_number', $manufacturer_number);
        $query = $this->db->get('manufacturer_master');
        return $query->row_array();

    }
}
