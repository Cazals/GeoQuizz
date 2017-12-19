<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Model_login extends CI_Model {

	function __construct()
	{
		parent::__construct();
		$this->table = "gquser";
	}

	function get_all()
	{
		return $this->db->get($this->table);
	}

	function get_one($id)
	{
		$this->db->select("id, title")
				 ->from($this->table)
				 ->where("id", $id)
				 ->limit(1);

		return $this->db->get();
	}

	function post($username,$password)
	{
        $this->db->select('UsrId')
                 ->from($this->table)
                 ->where('UsrLogin', $username)
                 ->where('UsrPassword', $password)
                 ->limit(1);

//            $id = $this->db->get()->result()
        $json = $this->db->get()->result();

        if (empty($json)){
            return array('code'=> 1,'msg'=>'erreur');
        }
        else {
            return array('code'=> 2, 'msg'=>'connecté');
        }

	}

	function put($id, $title)
	{
		$data = array(
			"title" => $title
		);

		$this->db->where("id", $id)
				 ->update($this->table, $data);
	}

	function delete($id)
	{
		$this->db->where_in("id", $id)
				 ->delete($this->table);
	}

}

/* End of file Model_product.php */
/* Location: ./application/models/Model_product.php */