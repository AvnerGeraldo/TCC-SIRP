<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Evento_model extends CI_Model
{
	private $_db;

	public function __construct()
	{
		$this->_db = $this->load->database("site", TRUE);
	}

	public function listaEventos($nomeEvento = null, $dataHoraInicial = null, $dataHoraFinal = null)
	{
		$result = null;

		if(! isset($_SESSION) ) {
			session_start();
		}

		if(! isset($_SESSION['restaurante']) ) {
			return $result;
		}

		if( !empty($nomeEvento) ) {
			$this->_db->like("nomeEvento", $nomeEvento);
		}

		if( !empty($dataHoraInicial) ) {
			$this->_db->where("dataHora >=", formataDataBanco($dataHoraInicial, 'S') );

			if( !empty($dataHoraFinal) ) {
				$this->_db->where("dataHora <=", formataDataBanco($dataHoraFinal, 'S') );
			}
		}

		$this->_db->where("id_restaurante", $_SESSION['restaurante']);

		$query = $this->_db->get("evento");
		if( $query->num_rows() > 0 ) {
			$result = $query->result_array();
		}

		return $result;
	}

	public function cadastrarEvento($arrayEvento)
	{
		$result 		= null;
		$listaEvento 	= $this->listaEventos($arrayEvento['nomeEvento'], $arrayEvento['dataHora'], $arrayEvento['dataHora']);
		if( !empty($listaEvento) ) {
			foreach ($listaEvento as $evento) {
				$this->_db->where("id_evento", $evento['id_evento']);
				$result = $this->_db->update("evento", $arrayEvento);
			}			
		} else {
			$result = $this->_db->insert("evento", $arrayEvento);
		}
		return $result;
	}

}