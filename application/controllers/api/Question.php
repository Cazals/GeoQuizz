<?php
/**
 * Created by PhpStorm.
 * User: 1484901
 * Date: 15/12/2017
 * Time: 15:20
 */

class Question extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('Model_question');
        header("Access-Control-Allow-Origin: *"); // CORS Origin enabled
    }

    //  User connection
    public function getQuestion()
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

        $question = $this->Model_question->post($decoded[0]['cat'],$decoded[0]['difficulty'], TRUE);

        echo $question;
//        echo json_encode($question);

    }
}