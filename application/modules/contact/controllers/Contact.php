<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends MX_Controller {

	public $data;

	function __construct() {
        parent::__construct();
    }

	public function index()	{
		$this->template->set('title', 'Contact');
		$this->template->load('default_layout', 'contents' , 'contact/index', $this->data);
    }
    
    public function send() {
		$this->template->set('title', 'Contact');
		$this->template->load('default_layout', 'contents' , 'contact/index', $this->data);
    }
}
