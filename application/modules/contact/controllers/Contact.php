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

		$this->load->library('email');
        
        $from = 'no-reply@ceramicskart.com';
        $to = 'abhijit.bhatnagar@gmail.com';
		$subject = 'Website Enquiry';
		$message = 'We have received a message from '."\n";
		$message .= 'Name : '. $this->input->post('name'). "\n";
		$message .= 'Email : '. $this->input->post('email'). "\n";
		if(!empty($this->input->post('website'))) {
			$message .= 'Website : '. $this->input->post('website'). "\n";
		}
        $message .= $this->input->post('message');

        $this->email->set_newline("\r\n");
        $this->email->from($from);
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);
		
        if ($this->email->send()) {
			$this->session->flashdata('success','Contact information received.');
        } else {
			$this->session->flashdata('error','Error sending information.');
		}
		redirect('/contact', 'refresh');
    }
}
