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

		$this->template->set('title', 'Floor Tiles');
		$this->template->load('default_layout', 'contents' , 'floor_tiles/index', $this->data);
    }
    
}
