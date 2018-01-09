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

        //Receive the RAW post data.
        $content = trim(file_get_contents("php://input"));

        //Attempt to decode the incoming RAW post data from JSON.
        $decoded = json_decode($content, true);

        //If json_decode failed, the JSON is invalid.
        if(!is_array($decoded)){
            throw new Exception('Received content contained invalid JSON!');
        }

        $logged = $this->Model_login->post($decoded[0]['usrLogin'],$decoded[0]['usrPassword'], TRUE);


        echo json_encode($logged);

    }

    public function register(){

        //$content = file_get_contents("php://input");

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
        $New = true;
        $LogExist= false;


        //Test Login
        $testExistLog=$this->Model_login->userExists($decoded[0]['usrLogin'],'usrLogin', TRUE);
        if(!empty($testExistLog)){
            $LogExist= true;
            $New=false;
        }


        //Test Mail
        $testExistMail=$this->Model_login->userExists($decoded[0]['usrEmail'],'usrEmail', TRUE);
        if(!empty($testExistMail)){
            If ($LogExist){
                echo json_encode(array($testExistLog,$testExistMail));
            }
            else {
                echo json_encode($testExistMail);
            }

            $New=false;
        }


        if (!$New){
            echo json_encode($testExistLog);
        }
        else {
            $this->load->model('Model_user');

            $this->Model_user->post($decoded[0]['usrLogin'],$decoded[0]['usrEmail'],$decoded[0]['usrFirstName'],$decoded[0]['usrLastName'],
                                    $decoded[0]['usrAddress'],$decoded[0]['usrPassword'],30,2);
            echo json_encode(array('code'=> 0,'msg'=>'Utilisateur créé avec succés'));

        }

    }
}