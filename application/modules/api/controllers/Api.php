<?php
require APPPATH.'/libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';
use Restserver\Libraries\REST_Controller;

class Api extends REST_Controller{
    
    public function __construct() {
        parent::__construct();
        $this->load->model('admin/admin_model');
        $this->headers = array();
        foreach(getallheaders() as $name => $value) {
            $this->headers[$name] = $value;
        }
        // if(isset($this->headers['api-key'])) {
        //     $this->user_details = $this->admin_model->getUserDetailsFromApiKey($this->headers['api-key']);
        // } else {
        //     $this->response('API Key not provided', 401);
        // }
    }

    function user_get() {
        if(!$this->get('id')) {
            $this->response('User Id not provided', 400);
        }
        if(!is_numeric($this->get('id'))) {
            $this->response('User Id is numeric', 400);
        }
        $user = $this->admin_model->getUser($this->get('id'));
        if($user) {
            $this->response($user, 200);
        } else {
            $this->response('User not found', 404);
        }
    }
     
    function users_get() {
        $users = $this->admin_model->getAllUsers();
        if($users) {
            $this->response($users, 200);
        } else{
            $this->response(NULL, 404);
        }
    }

}
