<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends MX_Controller {

	public $data;

	function __construct() {
		parent::__construct();
		$this->load->model('product_model');
    }

	public function index()	{
		redirect('/', 'refresh');
	}

	public function review() {
		if(!empty($this->input->post())) {
			$data = array();
			$data['tile_code'] = $this->input->post('tile_code');
			$data['name'] = $this->input->post('name');
			$data['email'] = $this->input->post('email');
			$data['rating'] = $this->input->post('review_rating');
			$data['message'] = $this->input->post('message');
			$data['status'] = 'active';
			$data['created_at'] = time();
			$review_id = $this->product_model->saveReview($data);
			if(!empty($review_id)) {
				echo json_encode(
					array(
						'status' => 'success',
						'message' => 'Review saved successfully.',
						'review_id' => $review_id
					)
				);
			} else {
				echo json_encode(
					array(
						'status' => 'error',
						'message' => 'There was an error saving the review.'
					)
				);
			}
		}
	}

	public function reviews() {
		$tile_code = $this->input->get('tile_code');
		$reviews = $this->product_model->getReviews($tile_code);
		if(!empty($reviews)) {
			echo json_encode(
				array(
					'status' => 'success',
					'message' => 'Reviews found.',
					'reviews' => $reviews
				)
			);
		} else {
			echo json_encode(
				array(
					'status' => 'success',
					'message' => 'No reviews found for the provided tile code.',
					'reviews' => array()
				)
			);
		}
	}

	public function bathroom() {
		$this->data['tile_colours'] = $this->product_model->getColours('bathroom');
		$this->data['tile_sizes'] = $this->product_model->getSizes('bathroom');
		$this->data['tile_finishes'] = $this->product_model->getFinishes('bathroom');

		$tiles_from_db = $this->product_model->getTiles('bathroom');
		
		$tile_image_paths = $this->get_tile_image_paths();

		foreach($tiles_from_db as $key => $item) {
			$file_name = str_replace(' ','-', $item['product_name']);
			if(($key = $this->util->array_search_partial($tile_image_paths, $file_name)) !== FALSE) {
				$item['img_path'] = base_url().$tile_image_paths[$key];
				$tiles_from_db[$key] = $item;
			}
		}
		$this->data['floor_tiles'] = $tiles_from_db;

		$this->template->set('title', 'Bathroom Tiles');
		$this->template->load('default_layout', 'contents' , 'product/index', $this->data);
	}

	public function bedroom() {
		$this->data['tile_colours'] = $this->product_model->getColours('bedroom');
		$this->data['tile_sizes'] = $this->product_model->getSizes('bedroom');
		$this->data['tile_finishes'] = $this->product_model->getFinishes('bedroom');

		$tiles_from_db = $this->product_model->getTiles('bedroom');
		
		$tile_image_paths = $this->get_tile_image_paths();

		foreach($tiles_from_db as $key => $item) {
			$file_name = str_replace(' ','-', $item['product_name']);
			if(($key = $this->util->array_search_partial($tile_image_paths, $file_name)) !== FALSE) {
				$item['img_path'] = base_url().$tile_image_paths[$key];
				$tiles_from_db[$key] = $item;
			}
		}
		$this->data['floor_tiles'] = $tiles_from_db;

		$this->template->set('title', 'Bedroom Tiles');
		$this->template->load('default_layout', 'contents' , 'product/index', $this->data);
	}

	public function drawingroom() {
		$this->data['tile_colours'] = $this->product_model->getColours('drawingroom');
		$this->data['tile_sizes'] = $this->product_model->getSizes('drawingroom');
		$this->data['tile_finishes'] = $this->product_model->getFinishes('drawingroom');

		$tiles_from_db = $this->product_model->getTiles('drawingroom');
		
		$tile_image_paths = $this->get_tile_image_paths();

		foreach($tiles_from_db as $key => $item) {
			$file_name = str_replace(' ','-', $item['product_name']);
			if(($key = $this->util->array_search_partial($tile_image_paths, $file_name)) !== FALSE) {
				$item['img_path'] = base_url().$tile_image_paths[$key];
				$tiles_from_db[$key] = $item;
			}
		}
		$this->data['floor_tiles'] = $tiles_from_db;

		$this->template->set('title', 'Drawing Room Tiles');
		$this->template->load('default_layout', 'contents' , 'product/index', $this->data);
	}

	public function kitchen() {
		$this->data['tile_colours'] = $this->product_model->getColours('kitchen');
		$this->data['tile_sizes'] = $this->product_model->getSizes('kitchen');
		$this->data['tile_finishes'] = $this->product_model->getFinishes('kitchen');

		$tiles_from_db = $this->product_model->getTiles('kitchen');
		
		$tile_image_paths = $this->get_tile_image_paths();

		foreach($tiles_from_db as $key => $item) {
			$file_name = str_replace(' ','-', $item['product_name']);
			if(($key = $this->util->array_search_partial($tile_image_paths, $file_name)) !== FALSE) {
				$item['img_path'] = base_url().$tile_image_paths[$key];
				$tiles_from_db[$key] = $item;
			}
		}
		$this->data['floor_tiles'] = $tiles_from_db;

		$this->template->set('title', 'Kitchen Tiles');
		$this->template->load('default_layout', 'contents' , 'product/index', $this->data);
	}
	
	public function outdoor() {
		$this->data['tile_colours'] = $this->product_model->getColours('outdoor');
		$this->data['tile_sizes'] = $this->product_model->getSizes('outdoor');
		$this->data['tile_finishes'] = $this->product_model->getFinishes('outdoor');

		$tiles_from_db = $this->product_model->getTiles('outdoor');
		
		$tile_image_paths = $this->get_tile_image_paths();

		foreach($tiles_from_db as $key => $item) {
			$file_name = str_replace(' ','-', $item['product_name']);
			if(($key = $this->util->array_search_partial($tile_image_paths, $file_name)) !== FALSE) {
				$item['img_path'] = base_url().$tile_image_paths[$key];
				$tiles_from_db[$key] = $item;
			}
		}
		$this->data['floor_tiles'] = $tiles_from_db;

		$this->template->set('title', 'OutDoor Tiles');
		$this->template->load('default_layout', 'contents' , 'product/index', $this->data);
	}
	
	public function office() {
		$this->data['tile_colours'] = $this->product_model->getColours('office');
		$this->data['tile_sizes'] = $this->product_model->getSizes('office');
		$this->data['tile_finishes'] = $this->product_model->getFinishes('office');

		$tiles_from_db = $this->product_model->getTiles('office');
		
		$tile_image_paths = $this->get_tile_image_paths();

		foreach($tiles_from_db as $key => $item) {
			$file_name = str_replace(' ','-', $item['product_name']);
			if(($key = $this->util->array_search_partial($tile_image_paths, $file_name)) !== FALSE) {
				$item['img_path'] = base_url().$tile_image_paths[$key];
				$tiles_from_db[$key] = $item;
			}
		}
		$this->data['floor_tiles'] = $tiles_from_db;

		$this->template->set('title', 'Office Tiles');
		$this->template->load('default_layout', 'contents' , 'product/index', $this->data);
	}

	public function get_tile_image_paths(){
		$tile_paths = array();
		if ($handle = opendir(FCPATH.'img/floor_tiles')) {
			while (false !== ($entry = readdir($handle))) {
				if ($entry != "." && $entry != "..") {
					$tile_paths[] = 'img/floor_tiles/'.$entry;
				}
			}
			closedir($handle);
		}

		if ($handle = opendir(FCPATH.'img/wall_tiles')) {
			while (false !== ($entry = readdir($handle))) {
				if ($entry != "." && $entry != "..") {
					$tile_paths[] = 'img/wall_tiles/'.$entry;
				}
			}
			closedir($handle);
		}
		return $tile_paths;
	}
    
}
