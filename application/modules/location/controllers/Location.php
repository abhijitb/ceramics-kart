<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Location extends MX_Controller {

	public $data;

	function __construct() {
		parent::__construct();
		$this->load->model('location_model');
    }

	public function index()	{
		redirect('/', 'refresh');
	}
	
	public function set(){
		$location_details = $this->location_model->fetch_location_details($this->session->session_id);
		
		if(empty($location_details)) {
			$location_details = json_decode(file_get_contents('https://geoip-db.com/json/'), true);
			$location_details['session_id'] = $this->session->session_id;
			$location_details['ip_address'] = $location_details['IPv4'];
			unset($location_details['IPv4']);
			if(is_null($location_details['city'])){
				$location_details['city'] = 'Mumbai';
			}

			$location_details = $this->location_model->store_location_details($location_details);
		}

		echo json_encode(
			array(
				'status' => 'success',
				'city' => $location_details['city']
			)
		);
	}
    
}
