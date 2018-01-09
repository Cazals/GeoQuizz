<?php
/**
 * Created by PhpStorm.
 * User: cazals
 * Date: 22/12/2017
 * Time: 10:00
 */
class Walk extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('Model_walk');
        header("Access-Control-Allow-Origin: *"); // CORS Origin enabled
    }
    //  User connection
    public function walkPlc()
    {
        $content = file_get_contents("php://input");
        //Make sure that it is a POST request.
        if(strcasecmp($_SERVER['REQUEST_METHOD'], 'POST') != 0){
            throw new Exception('Request method must be POST!');
        }
        //Receive the RAW post data.
        $content = trim(file_get_contents("php://input"));
        //Attempt to decode the incoming RAW post data from JSON.
        $decoded = json_decode($content, true);
        //If json_decode failed, the JSON is invalid.
        if(!is_array($decoded)){
            throw new Exception('Received content contained invalid JSON!');
        }
        $question = $this->Model_walk->post($decoded[0]['plcLat'],$decoded[0]['plcLon'],$decoded[0]['usrId'], TRUE);
        //echo $question;
        echo $question;
    }
}