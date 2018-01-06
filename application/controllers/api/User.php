<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('Model_user');
        header("Access-Control-Allow-Origin: *"); // CORS Origin enabled
    }
//TODO fix userLastConnection
    // Get all products
    public function index()
    {
        $data = $this->Model_user->get_all();

        if ($data->num_rows() > 0) {
            foreach ($data->result() as $row) {
                $result[] = array("id" => intval($row->usrId), "login" => $row->usrLogin, "mail" => $row->usrEmail,
                    "FirstName" =>$row->usrFirstName,"LastName" =>$row->usrLastName,"Address" =>$row->usrAddress,
                    "Password" =>$row->usrPassword,"Points" =>$row->usrPointsBalance,"RegisterDate" =>$row->usrRegisterDate);//,
                    //"LastConnection" =>$row->usrLastConnectionDate,"Status" =>$row->usrStsId);
            }
            echo json_encode($result);
        } else {
            header("HTTP/1.0 204 No Content");
            echo json_encode("204: no Users in the database");
        }
    }

    // Get a product
    public function view($id)
    {
        $data = $this->Model_user->get_one($id);

        if ($data->num_rows() > 0) {
            foreach ($data->result() as $row) {
                $result[] = array("id" => intval($row->usrId), "login" => $row->usrLogin, "mail" => $row->usrEmail,
                                    "FirstName" =>$row->usrFirstName,"LastName" =>$row->usrLastName,"Address" =>$row->usrAddress,
                                    "Password" =>$row->usrPassword,"Points" =>$row->usrPointsBalance,"RegisterDate" =>$row->usrRegisterDate,
                                    "LastConnection" =>$row->usrLastConnectionDate,"Status" =>$row->usrStsId);
            }
            echo json_encode($result);
        } else {
            header("HTTP/1.0 404 Not Found");
            echo json_encode("404 : User #$id not found");
        }
    }

    // Create a product
//    public function create()
//    {
//
//    }

    // Update a product
    public function update($id)
    {
        $title = utf8_encode($this->input->input_stream("title", TRUE));

        // If product exists
        if ($this->Model_user->get_one($id)->num_rows() == 1) {

            if (!empty($title)) {
                $this->Model_user->put($id, $title);
                echo json_encode("200: User #$id updated");
            } else {
                header("HTTP/1.0 400 Bad Request");
                echo json_encode("400: Empty value");
            }

        } else {
            header("HTTP/1.0 404 Not Found");
            echo json_encode("404: User #$id not found");
        }
    }

    // Delete a product
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