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
//    public function create()
//    {
//
//    }




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

/* End of file Product.php */
/* Location: ./application/controllers/Product.php */