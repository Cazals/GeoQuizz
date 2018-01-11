<?php

class Stats extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('Model_stats');
        header("Access-Control-Allow-Origin: *"); // CORS Origin enabled
    }

    public function sendStats($id)
    {
        if ($id==1){ // Case stats empty places
            $result = $this->Model_stats->statsEmptyPlaces();
        }
        elseif ($id==2){ // Case stats owned places
            $result = $this->Model_stats->statsOwnedPlaces();
        }
        elseif ($id==3){ // Graph places bought in time
            $result = $this->Model_stats->statsBoughtPlc();
        }

        if(!empty($result)){
            echo json_encode($result);
        }
    }
}