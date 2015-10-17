<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Restaurante_model extends CI_Model
{
	private $_db;

	public function __construct()
	{
		$this->_db = $this->load->database("site", TRUE);
	}

	public function listaRestaurante($idRestaurante = null, $nomeRestaurante = null, $cidade = null, $horarioInicial = null, $horarioFinal = null)
	{
		$result = null;
		if( !empty($idRestaurante) ) {
			$this->_db->where("id_restaurante", $idRestaurante);
		}

		if( !empty($nomeRestaurante) ) {
			$this->_db->like("nomeRestaurante", $nomeRestaurante);
		}

		if( !empty($cidade) ) {
			$this->_db->like("cidade", $cidade);
		}

		if( !empty($horarioInicial) ) {
			$horarioInicial = formataDataBanco($horarioInicial,'S');
			$this->_db->where("horarioFuncionamentoInicial >=", $horarioInicial);
		}

		if( !empty($horarioFinal) ) {
			$horarioFinal = formataDataBanco($horarioFinal,'S');
			$this->_db->where("horarioFuncionamentoFinal <=", $horarioFinal);
		}

		$query = $this->_db->get("restaurante");
		if( $query->num_rows() > 0 ) {
			$result = $query->result_array();
		}

		return $result;
	}

	public function cadastrarRestaurante($arrayRestaurante)
	{
		$result 		= null;

		if(! isset($_SESSION) ) {
			session_start();
		}

		if(! isset($_SESSION['restaurante']) ) {
			return $result;
		}
		
		$listaRestaurante 	= $this->listaRestaurante( $_SESSION['restaurante']);
		if( !empty($listaRestaurante) ) {
			foreach ($listaRestaurante as $rest) {
				$this->_db->where("id_restaurante", $rest['id_restaurante']);
				$result = $this->_db->update("restaurante", $arrayRestaurante);
			}			
		} else {
			$result = $this->_db->insert("restaurante", $arrayRestaurante);
		}
		return $result;
	}
}