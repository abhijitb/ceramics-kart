<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Template {
    
    private $CI;
    var $template_data = array();

    public function __construct() {
        $this->CI =& get_instance();
    }

    function set($content_area, $value) {
        $this->template_data[$content_area] = $value;
    }

    function load($template = '', $name ='', $view = '' , $view_data = array(), $return = FALSE) {
        $this->set($name , $this->CI->load->view($view, $view_data, TRUE));
        $this->set('locations' , $this->get_cities());
        $this->CI->load->view('layouts/'.$template, $this->template_data);
    }

    function get_cities() {
        $result = $this->CI->db->get('city_master');
        return $result->result_array();
    }

}
?>