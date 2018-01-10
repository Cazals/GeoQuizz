<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('Model_transaction');
        header("Access-Control-Allow-Origin: *"); // CORS Origin enabled
    }

    // Get all transactions
    public function index()
    {
        $data = $this->Model_transaction->get_all();

        if ($data->num_rows() > 0) {
            foreach ($data->result() as $row) {
                $result[] = array("id" => intval($row->transId), "Date" => $row->transDate, "Type" => $row->transType,
                    "Points" =>$row->transPoints,"Buyer" =>$row->transUsrIdBuyer,"Seller" =>$row->transUsrIdSeller,
                    "Place" =>$row->transPlaceId);
            }
            echo json_encode($result);
        } else {
            header("HTTP/1.0 204 No Content");
            echo json_encode("204: no Transactions in the database");
        }
    }

    // Get a transaction
    public function view($id)
    {
        $data = $this->Model_transaction->get_one($id);

        if ($data->num_rows() > 0) {
            foreach ($data->result() as $row) {
                $result[] = array("id" => intval($row->transId), "Date" => $row->transDate, "Type" => $row->transType,
                    "Points" =>$row->transPoints,"Buyer" =>$row->transUsrIdBuyer,"Seller" =>$row->transUsrIdSeller,
                    "Place" =>$row->transPlaceId);
            }
            echo json_encode($result);
        } else {
            header("HTTP/1.0 404 Not Found");
            echo json_encode("404 : transaction #$id not found");
        }
    }

    // Create a transaction
    public function create()
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
        $created = $this->Model_transaction->post(
            $decoded[0]['transType'],
            $decoded[0]['transPoints'],
            $decoded[0]['transUsrIdBuyer'],
            $decoded[0]['transUsrIdSeller'],
            $decoded[0]['transPlaceId'],
            TRUE);
    }


    // Delete a transaction
    public function delete($id)
    {
        // If product exists
        if ($this->Model_transaction->get_one($id)->num_rows() == 1) {
            $this->Model_transaction->delete($id);
            echo json_encode("200: transaction #$id deleted");
        } else {
            header("HTTP/1.0 404 Not Found");
            echo json_encode("404: transaction $id not found");
        }
    }
}
