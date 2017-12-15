<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Model_question extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->table = "gquser";
    }


    function post($cat, $difficulty)
    {
        $apiResponse=file_get_contents('https://opentdb.com/api.php?amount=1&category='.$cat.'&difficulty='.$difficulty.'&type=multiple');
        $decoded = json_decode($content, true);


        return $apiResponse;
    }
}

