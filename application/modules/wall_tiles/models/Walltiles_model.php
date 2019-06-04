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
        $query = $this->db->get('item_by_application_and_colour');
        return $query->result_array();
    }
    
    public function getWallTileById($tile_id) {
        $this->db->where('id', $tile_id);
        $query = $this->db->get('item_by_application_and_colour');
        return $query->row_array();
    }
}
