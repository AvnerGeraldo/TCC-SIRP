<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Cardapio_model extends CI_Model
{
	private $_db;

	public function __construct()
	{
		$this->_db = $this->load->database("site", TRUE);
	}

	public function buscarCardapio($nomeCardapio = null, $statusCardapio = null)
	{
		$result = null;

		if(! isset($_SESSION) ) {
			session_start();
		}

		if(! isset($_SESSION['restaurante']) ) {
			return $result;
		}

		if( !empty($nomeCardapio) ) {
			$this->_db->like("nomeCardapio", $nomeCardapio);
		}

		if( !empty($statusCardapio) ) {
			$this->_db->where("statusCardapio", $statusCardapio);
		}

		$this->_db->where("id_restaurante", $_SESSION['restaurante']);

		$query = $this->_db->get("cardapio");
		if( $query->num_rows() > 0 ) {
			$result = $query->result_array();
		}

		return $result;
	}

	public function cadastrarCardapio($arrayCardapio)
	{
		$result 		= null;

		if(! isset($_SESSION) ) {
			session_start();
		}

		if(! isset($_SESSION['restaurante']) ) {
			return $result;
		}
		
		$listaCardapios = $this->buscarCardapio($arrayCardapio['nomeCardapio']);
		if( !empty($listaCardapios) ) {
			foreach ($listaCardapios as $cardapio) {
				$this->_db->where("id_cardapio", $cardapio['id_cardapio']);
				$this->_db->where("id_restaurante", $_SESSION['restaurante']);
				$result = $this->_db->update("cardapio", $arrayCardapio);
			}			
		} else {
			$result = $this->_db->insert("cardapio", $arrayCardapio);
		}
		return $result;
	}	
}