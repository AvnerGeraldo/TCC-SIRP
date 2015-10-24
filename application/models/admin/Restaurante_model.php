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

	public function listaImagensRestaurante($id_restaurante, $nomeImagem = null, $imgPrincipal = null)
	{
		$result = null;
		
		$this->_db->where("id_restaurante", $id_restaurante);

		if( !empty($imgPrincipal) )	 {
			$this->_db->where("opt_imagem_principal", $imgPrincipal);
		}

		if( !empty($nomeImagem) )	 {
			$this->_db->where("imagem", $nomeImagem);
		}

		$query = $this->_db->get("imagemrestaurante");
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

	public function cadastrarImagemRestaurante($arrayImagens)
	{
		$result 		= null;

		if( $arrayImagens['opt_imagem_principal'] == 'S' ) {
			$listaImagensRestaurante 	= $this->listaImagensRestaurante( $arrayImagens['id_restaurante'], null, 'S');
			if( !empty($listaImagensRestaurante) ) {
				$this->_db->where("id_restaurante", $rest['id_restaurante']);
				$this->_db->where("opt_imagem_principal", 'S');
				$this->_db->where("id_imagem", $listaImagensRestaurante[0]['id_imagem']);
				$this->_db->update("restaurante", array('opt_imagem_principal' => 'N'));
			}
		}
		
		$listaImagensRestaurante 	= $this->listaImagensRestaurante( $arrayImagens['id_restaurante'], $arrayImagens['imagem']);
		if( !empty($listaImagensRestaurante) ) {
			foreach ($listaImagensRestaurante as $rest) {
				$this->_db->where("id_restaurante", $rest['id_restaurante']);
				$this->_db->where("id_imagem", $rest['id_imagem']);
				$result = $this->_db->update("imagemrestaurante", $arrayImagens);
			}			
		} else {
			$result = $this->_db->insert("imagemrestaurante", $arrayImagens);
		}
		return $result;
	}
}