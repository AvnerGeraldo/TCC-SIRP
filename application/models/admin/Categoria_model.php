<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Categoria_model extends CI_Model
{
	private $_db;

	public function __construct()
	{
		$this->_db = $this->load->database("site", TRUE);
	}

	public function listaCategorias($idCategoria = null)
	{
		$result = null;

		if( !empty($idCategoria) ) {
			$this->_db->where("id_categoriaProduto", $idCategoria);
		}		

		$query = $this->_db->get("categoriaproduto");
		if( $query->num_rows() > 0 ) {
			$result = $query->result_array();
		}

		return $result;
	}	
}