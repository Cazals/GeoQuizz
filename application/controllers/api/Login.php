<?php
/**
 * Created by PhpStorm.
 * User: 1484901
 * Date: 13/12/2017
 * Time: 22:15
 */

class Login extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('Model_login');
        header("Access-Control-Allow-Origin: *"); // CORS Origin enabled
    }

    //  User connection
    public function connection()
    {
        $content = file_get_contents("php://input");

        //Make sure that it is a POST request.
        if(strcasecmp($_SERVER['REQUEST_METHOD'], 'POST') != 0){
            throw new Exception('Request method must be POST!');
        }

//        //Make sure that the content type of the POST request has been set to application/json
//        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
//        if(strcasecmp($contentType, 'application/json') != 0){
//            throw new Exception('Content type must be: application/json');
//        }

        //Receive the RAW post data.
        $content = trim(file_get_contents("php://input"));

        //Attempt to decode the incoming RAW post data from JSON.
        $decoded = json_decode($content, true);

        //If json_decode failed, the JSON is invalid.
        if(!is_array($decoded)){
            throw new Exception('Received content contained invalid JSON!');
        }




        $title = $this->Model_login->post($decoded[0]['username'],$decoded[0]['password'], TRUE);



            echo json_encode($title);

    }
}