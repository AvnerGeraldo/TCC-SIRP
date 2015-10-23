<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Reserva_model extends CI_Model
{
	private $_db;

	public function __construct()
	{
		$this->_db = $this->load->database("site", TRUE);
	}

	public function buscarReserva($statusReserva = null, $dataHora = null);
	{
		$result = null;

		if( !empty($statusReserva) ) {
			$this->_db->where("statusReserva", $statusReserva);
		}

		if( !empty($dataHora) ) {
			$this->_db->where("dataHora =>", $dataHora);
		}

		$query = $this->_db->get("reserva");
		if( $query->num_rows() > 0 ) {
			$result = $query->result_array();
		}

		return $result;
	}

	
}