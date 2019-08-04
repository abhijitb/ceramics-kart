<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wall_tiles extends MX_Controller {

	public $data;

	function __construct() {
		parent::__construct();
		$this->load->model('walltiles_model');
    }

	public function index()	{

		$this->data['tile_colours'] = $this->walltiles_model->getColours();
		$this->data['tile_sizes'] = $this->walltiles_model->getSizes();
		$this->data['tile_finishes'] = $this->walltiles_model->getFinishes();
		$this->data['tile_applications'] = $this->walltiles_model->getApplications();

		$wall_tiles_from_db = $this->walltiles_model->getWallTiles();
		$wall_tiles_from_db = $this->get_tile_images($wall_tiles_from_db);
		
		$this->data['wall_tiles'] = $wall_tiles_from_db;

		$this->template->set('title', 'Wall Tiles');
		$this->template->load('default_layout', 'contents' , 'wall_tiles/index', $this->data);
	}
	
	public function details(){
		if(empty($this->uri->segment(3)))  {
			redirect('/wall-tiles', 'refresh');
		} else {
			$tile_id = $this->uri->segment(3);
			$this->data['tile_details'] = $this->walltiles_model->getWallTileById($tile_id);
			$this->data['product_name'] = $this->data['tile_details']['product_name'];
			$this->data['img_path'] = base_url().'img/wall_tiles/'.str_replace(' ', '-', $this->data['product_name']).'.jpg';
			$this->data['retailer_details'] = $this->walltiles_model->getRetailerDetails($this->data['tile_details']['retailer_number']);
			$this->data['dealer_details'] = $this->walltiles_model->getDealerDetails($this->data['tile_details']['dealer_number']);
			$this->data['manufacturer_details'] = $this->walltiles_model->getManufacturerDetails($this->data['tile_details']['manufacturer_number']);
			$this->data['number_of_pieces_per_box'] = 9;
			$this->load->model('product/product_model');
			$this->data['reviews'] = $this->product_model->getReviews(str_replace(' ', '-', $this->data['product_name']));

			// add this view into views table
			$tile_views = $this->walltiles_model->getTileViews($this->data['tile_details']['id']);
			if(empty($tile_views)) {
				$tile_views = $this->data['tile_details'];
			}
			if(isset($tile_views['no_of_views']) && !empty($tile_views['no_of_views'])) {
				$tile_views['no_of_views'] = ++$tile_views['no_of_views'];
			} else {
				$tile_views['no_of_views'] = 1;
			}
			$view_id = $this->walltiles_model->updateTileViews($tile_views);

			// fetch recently viewed tiles
			$recently_viewed_tiles = $this->walltiles_model->getRecentlyViewed('wall_tile');
			if(count($recently_viewed_tiles) < 10) {
				$wall_tiles_from_db = $this->walltiles_model->getWallTiles();
				$random_tiles = array_slice($wall_tiles_from_db, 0 , 10);
				$recently_viewed_tiles = array_merge($recently_viewed_tiles, $random_tiles);
			}
			$recently_viewed_tiles = $this->get_tile_images($recently_viewed_tiles);
			$this->data['recently_viewed_tiles'] = array_slice($recently_viewed_tiles, 0 , 10);
		}

		$this->template->set('title', 'Wall Tiles - Details');
		$this->template->load('default_layout', 'contents' , 'wall_tiles/details', $this->data);
	}
	
	public function get_tile_images($wall_tiles_from_db) {

		if ($handle = opendir(FCPATH.'img/wall_tiles')) {
			while (false !== ($entry = readdir($handle))) {
				if ($entry != "." && $entry != "..") {
					$wall_tiles_from_dir[] = $entry;
				}
			}
			closedir($handle);
		}

		foreach($wall_tiles_from_db as $counter => $item) {
			$file_name = str_replace(' ','-', $item['product_name']);
			if(($key = $this->util->array_search_partial($wall_tiles_from_dir, $file_name)) !== FALSE) {
				$item['img_path'] = base_url().'img/wall_tiles/'.$wall_tiles_from_dir[$key];
				$wall_tiles_from_db[$counter] = $item;
			}
		}
		return $wall_tiles_from_db;
	}
}
