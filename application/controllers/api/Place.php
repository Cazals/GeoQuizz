<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Place extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('Model_place');
        header("Access-Control-Allow-Origin: *"); // CORS Origin enabled
    }

    // Get all products
    public function index()
    {
        $data = $this->Model_place->get_all();

        if ($data->num_rows() > 0) {
            foreach ($data->result() as $row) {
                $result[] = array("plcId" => intval($row->plcId), "plcName" => $row->plcName, "plcAddress" => $row->plcAddress,
                    "plcLat" =>$row->plcLat,"plcLon" =>$row->plcLon,"plcPrice" =>$row->plcPrice,
                    "plcWkPrice" =>$row->plcWkPrice,"plcUsrIdOwner" =>$row->plcUsrIdOwner);
            }
            echo json_encode($result);
        } else {
            header("HTTP/1.0 204 No Content");
            echo json_encode("204: no Places in the database");
        }
    }

    // Get a product
    public function view($id)
    {
        $data = $this->Model_place->get_one($id);

        if ($data->num_rows() > 0) {
            foreach ($data->result() as $row) {
                $result[] = array("plcId" => intval($row->plcId), "plcName" => $row->plcName, "plcAddress" => $row->plcAddress,
                    "plcLat" =>$row->plcLat,"plcLon" =>$row->plcLon,"plcPrice" =>$row->plcPrice,
                    "plcWkPrice" =>$row->plcWkPrice,"plcUsrIdOwner" =>$row->plcUsrIdOwner);
            }
            echo json_encode($result);
        } else {
            header("HTTP/1.0 404 Not Found");
            echo json_encode("404 : Place #$id not found");
        }
    }

    public function create()
    {
        $post = file_get_contents('php://input');

        $plcName = $_REQUEST['plcName'];
        $plcAddress = $_REQUEST['plcAddress'];
        $plcLat = $_REQUEST['plcLat'];
        $plcLon = $_REQUEST['plcLon'];
        $plcPrice = $_REQUEST['plcPrice'];
        $plcWkPrice = $_REQUEST['plcWkPrice'];

        $this->Model_place->post($plcName,$plcAddress,$plcLat,$plcLon,$plcPrice,$plcWkPrice);
    }

    // Update a product
    public function update($id)
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

        $updated = $this->Model_place->patch(
                    $decoded[0]['plcId'],
                    $decoded[0]['plcName'],
                    $decoded[0]['plcAddress'],
                    $decoded[0]['plcLat'],
                    $decoded[0]['plcLon'],
                    $decoded[0]['plcPrice'],
                    $decoded[0]['plcWkPrice'],
                    $decoded[0]['plcUsrIdOwner'],
                    TRUE);
    }

    // Delete a product
    public function delete($id)
    {
        // If product exists
        if ($this->Model_place->get_one($id)->num_rows() == 1) {
            $this->Model_place->delete($id);
            echo json_encode("200: Place #$id deleted");
        } else {
            header("HTTP/1.0 404 Not Found");
            echo json_encode("404: Product $id not found");
        }
    }





}

/* End of file Product.php */
/* Location: ./application/controllers/Product.php */