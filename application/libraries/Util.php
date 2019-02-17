<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Util {

    protected $CI;

    public function __construct() {
        $this->CI =& get_instance();
    }

    public function object_to_array($obj) {
        if(is_object($obj)) $obj = (array) $obj;
        if(is_array($obj)) {
            $new = array();
            foreach($obj as $key => $val) {
                $new[$key] = $this->object_to_array($val);
            }
        }
        else $new = $obj;
        return $new;       
    }

    public function object_unique($objects) {
        $unique_objects = $temp_emails = array();
        foreach($objects as $object) {
            if(!in_array($object->email, $temp_emails)) {
                $temp_emails[]=$object->email;
                $unique_objects[] = $object;
            }
        }
        return $unique_objects;
    }

    public function get_json($string) {
        // decode the JSON data
        $result = json_decode($string);

        // switch and check possible JSON errors
        switch (json_last_error()) {
            case JSON_ERROR_NONE:
                $error = ''; // JSON is valid // No error has occurred
                break;
            case JSON_ERROR_DEPTH:
                $error = 'The maximum stack depth has been exceeded.';
                break;
            case JSON_ERROR_STATE_MISMATCH:
                $error = 'Invalid or malformed JSON.';
                break;
            case JSON_ERROR_CTRL_CHAR:
                $error = 'Control character error, possibly incorrectly encoded.';
                break;
            case JSON_ERROR_SYNTAX:
                $error = 'Syntax error, malformed JSON.';
                break;
            // PHP >= 5.3.3
            case JSON_ERROR_UTF8:
                $error = 'Malformed UTF-8 characters, possibly incorrectly encoded.';
                break;
            // PHP >= 5.5.0
            case JSON_ERROR_RECURSION:
                $error = 'One or more recursive references in the value to be encoded.';
                break;
            // PHP >= 5.5.0
            case JSON_ERROR_INF_OR_NAN:
                $error = 'One or more NAN or INF values in the value to be encoded.';
                break;
            case JSON_ERROR_UNSUPPORTED_TYPE:
                $error = 'A value of a type that cannot be encoded was given.';
                break;
            default:
                $error = 'Unknown JSON error occured.';
                break;
        }

        if ($error !== '') {
            // throw the Exception or exit // or whatever :)
            return array('status' => 'error', 'message' => $error);
        }

        // everything is OK
        return array('status' => 'success', 'message' => $result);
    }

    public function array_flatten($array = null) {
        $result = array();
    
        if (!is_array($array)) {
            $array = func_get_args();
        }
    
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $result = array_merge($result, $this->array_flatten($value));
            } else {
                $result = array_merge($result, array($key => $value));
            }
        }
    
        return $result;
    }

    public function replace_template_vars($data, $message) {
        return str_replace(
            array('{name}', '{value}', '{code}'),
            array($data['name'], $data['amount'], $data['code']),
            $message);
    }

}