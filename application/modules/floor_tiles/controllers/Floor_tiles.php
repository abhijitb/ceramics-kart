<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Floor_tiles extends MX_Controller {

	public $data;

	function __construct() {
		parent::__construct();
		$this->load->model('floortiles_model');
    }

	public function index()	{

		$this->data['tile_colours'] = $this->floortiles_model->getColours();
		$this->data['tile_sizes'] = $this->floortiles_model->getSizes();
		$this->data['tile_finishes'] = $this->floortiles_model->getFinishes();
		$this->data['tile_applications'] = $this->floortiles_model->getApplications();

		$floor_tiles_from_db = $this->floortiles_model->getFloorTiles();
		
		if ($handle = opendir(FCPATH.'img/floor_tiles')) {
			while (false !== ($entry = readdir($handle))) {
				if ($entry != "." && $entry != "..") {
					$floor_tiles_from_dir[] = $entry;
				}
			}
			closedir($handle);
		}
		
		foreach($floor_tiles_from_db as $key => $item) {
			$file_name = str_replace(' ','-', $item['product_name']);
			if(($key = $this->util->array_search_partial($floor_tiles_from_dir, $file_name)) !== FALSE) {
				$item['img_path'] = base_url().'img/floor_tiles/'.$floor_tiles_from_dir[$key];
				$floor_tiles_from_db[$key] = $item;
			}
		}

		$this->data['floor_tiles'] = $floor_tiles_from_db;

		$this->template->set('title', 'Floor Tiles');
		$this->template->load('default_layout', 'contents' , 'floor_tiles/index', $this->data);
	}
	
	public function details(){
		if(empty($this->uri->segment(3)))  {
			redirect('/floor-tiles', 'refresh');
		} else {
			$tile_id = $this->uri->segment(3);
			$this->data['tile_details'] = $this->floortiles_model->getFloorTileById($tile_id);
			$this->data['product_name'] = $this->data['tile_details']['product_name'];
			$this->data['img_path'] = base_url().'img/floor_tiles/'.str_replace(' ', '-', $this->data['product_name']).'.jpg';
			$this->data['retailer_details'] = $this->floortiles_model->getRetailerDetails($this->data['tile_details']['retailer_number']);
			$this->data['dealer_details'] = $this->floortiles_model->getDealerDetails($this->data['tile_details']['dealer_number']);
			$this->data['manufacturer_details'] = $this->floortiles_model->getManufacturerDetails($this->data['tile_details']['manufacturer_number']);
			$this->data['number_of_pieces_per_box'] = 9;
		}

		$this->template->set('title', 'Floor Tiles - Details');
		$this->template->load('default_layout', 'contents' , 'floor_tiles/details', $this->data);
	}
    
}
