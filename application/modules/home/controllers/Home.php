<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MX_Controller {

	public $data;

	function __construct() {
        parent::__construct();
    }

	public function index()	{
		$this->template->set('title', 'Home');
		$this->template->load('default_layout', 'contents' , 'home/index', $this->data);
	}
}
