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
		
		if ($handle = opendir(FCPATH.'img/wall_tiles')) {
			while (false !== ($entry = readdir($handle))) {
				if ($entry != "." && $entry != "..") {
					$wall_tiles_from_dir[] = $entry;
				}
			}
			closedir($handle);
		}
		
		foreach($wall_tiles_from_db as $key => $item) {
			$file_name = str_replace(' ','-', $item['product_name']);
			if(($key = $this->util->array_search_partial($wall_tiles_from_dir, $file_name)) !== FALSE) {
				$item['img_path'] = base_url().'img/wall_tiles/'.$wall_tiles_from_dir[$key];
				$wall_tiles_from_db[$key] = $item;
			}
		}

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
		}

		$this->template->set('title', 'Wall Tiles - Details');
		$this->template->load('default_layout', 'contents' , 'wall_tiles/details', $this->data);
	}
    
}
