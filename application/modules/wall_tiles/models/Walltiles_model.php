<?php

class Walltiles_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->type = 'Wall Tile';
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

    public function getWallTiles() {
        $this->db->where('product_type', 'Wall Tile');
        $this->db->group_by('product_name');
        $query = $this->db->get('item_by_application_and_colour');
        return $query->result_array();
    }
    
    public function getWallTileById($tile_id) {
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

    public function getTileViews($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('tile_views');
        return $query->row_array();
    }

    public function updateTileViews($data) {
        $tile_id = $data['id'];
        $this->db->where('id', $tile_id);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get('tile_views');

        if ($query->num_rows() > 0 ) {
            unset($data['id']);
            $this->db->where('id', $tile_id);
            $this->db->set($data);
            $this->db->update('tile_views');
            return $tile_id;
        } else {
            $this->db->insert('tile_views', $data);
            return $this->db->insert_id();
        }    
    }

    public function getRecentlyViewed($product_type) {
        $product_type = ucwords(str_replace('_', ' ', $product_type));
        $this->db->where('product_type', $product_type);
        $this->db->group_by('product_name');
        $this->db->order_by('no_of_views', 'DESC');
        $this->db->limit('10');
        $query = $this->db->get('tile_views');
        return $query->result_array();
    }
}
