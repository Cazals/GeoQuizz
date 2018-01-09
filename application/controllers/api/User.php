<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('Model_user');
        header("Access-Control-Allow-Origin: *"); // CORS Origin enabled
    }

    // Get all users
    public function index()
    {
        $data = $this->Model_user->get_all();

        if ($data->num_rows() > 0) {
            foreach ($data->result() as $row) {
                $result[] = array("usrId" => intval($row->usrId), "usrLogin" => $row->usrLogin, "usrEmail" => $row->usrEmail,
                    "usrFirstName" =>$row->usrFirstName,"usrLastName" =>$row->usrLastName,"usrAddress" =>$row->usrAddress,
                    "usrPassword" =>$row->usrPassword,"usrPointsBalance" =>$row->usrPointsBalance,"usrRegisterDate" =>$row->usrRegisterDate,
                    "usrLastConnectionDate" =>$row->usrLastConnectionDate,"usrStsId" =>$row->usrStsId);
            }
            echo json_encode($result);
        } else {
            header("HTTP/1.0 204 No Content");
            echo json_encode("204: no Users in the database");
        }
    }

    // Get a user
    public function view($id)
    {
        $data = $this->Model_user->get_one($id);

        if ($data->num_rows() > 0) {
            foreach ($data->result() as $row) {
                $result[] = array("usrId" => intval($row->usrId), "usrLogin" => $row->usrLogin, "usrEmail" => $row->usrEmail,
                    "usrFirstName" =>$row->usrFirstName,"usrLastName" =>$row->usrLastName,"usrAddress" =>$row->usrAddress,
                    "usrPassword" =>$row->usrPassword,"usrPointsBalance" =>$row->usrPointsBalance,"usrRegisterDate" =>$row->usrRegisterDate,
                    "usrLastConnectionDate" =>$row->usrLastConnectionDate,"usrStsId" =>$row->usrStsId);
            }
            echo json_encode($result);
        } else {
            header("HTTP/1.0 404 Not Found");
            echo json_encode("404 : User #$id not found");
        }
    }



    // Update a user
    public function update()
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

        $updated = $this->Model_user->patch(
                    $decoded[0]['usrId'],
                    $decoded[0]['usrLogin'],
                    $decoded[0]['usrEmail'],
                    $decoded[0]['usrFirstName'],
                    $decoded[0]['usrLastName'],
                    $decoded[0]['usrAddress'],
                    $decoded[0]['usrPassword'],
                    $decoded[0]['usrPointsBalance'],
                    $decoded[0]['usrStsId'],
                    TRUE);
    }

    // Delete a user
    public function delete($id)
    {
        // If product exists
        if ($this->Model_user->get_one($id)->num_rows() == 1) {
            $this->Model_user->delete($id);
            echo json_encode("200: User #$id deleted");
        } else {
            header("HTTP/1.0 404 Not Found");
            echo json_encode("404: User $id not found");
        }
    }





}

/* End of file Product.php */
/* Location: ./application/controllers/Product.php */