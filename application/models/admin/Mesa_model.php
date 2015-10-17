<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Mesa_model extends CI_Model
{
	private $_db;

	public function __construct()
	{
		$this->_db = $this->load->database("site", TRUE);
	}

	public function listaMesa( $numeroMesa = null )
	{
		$result = null;

		if(! isset($_SESSION) ) {
			session_start();
		}

		if(! isset($_SESSION['restaurante']) ) {
			return $result;
		}

		if( !empty($numeroMesa) ) {
			$this->_db->like("num_mesa", $numeroMesa);
		}

		$this->_db->where("id_restaurante", $_SESSION['restaurante']);

		$query = $this->_db->get("mesa");
		if( $query->num_rows() > 0 ) {
			$result = $query->result_array();
		}

		return $result;
	}

	public function cadastrarMesa($arrayMesa)
	{
		$result 		= null;

		if(! isset($_SESSION) ) {
			session_start();
		}

		if(! isset($_SESSION['restaurante']) ) {
			return $result;
		}

		$listaMesa 	= $this->listaMesa( $arrayMesa['num_mesa'] );
		if( !empty($listaMesa) ) {
			foreach ($listaMesa as $mesa) {
				$this->_db->where("id_restaurante", $_SESSION['restaurante']);
				$this->_db->where("id_mesa", $mesa['id_mesa']);
				$result = $this->_db->update("mesa", $arrayMesa);
			}			
		} else {
			$result = $this->_db->insert("mesa", $arrayMesa);
		}
		return $result;
	}

}