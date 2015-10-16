<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Funcionario_model extends CI_Model
{
	private $_db;

	public function __construct()
	{
		$this->_db = $this->load->database("site", TRUE);
	}

	public function listaFuncionario($login = null, $nomeFuncionario = null, $restaurante = null)
	{
		$result 	= null;

		if( !empty($login) ) {
			$this->_db->where("login", $login);	
		}		

		if( !empty($nomeFuncionario) ) {
			$this->_db->where("nome_funcionario", $nomeFuncionario);	
		}

		if( !empty($restaurante) ) {
			$this->_db->where("id_restaurante", $restaurante);	
		}		
		
		$query = $this->_db->get("funcionario");
		if( $query->num_rows() > 0 ) {
			$result = $query->result_array();
		}

		return $result;
	}

	public function logarUsuarioRestaurante($usuario, $senha)
	{
		$result 	= FALSE;

		if( !empty($usuario) && !empty($senha) ) {
			$usuario 	= xss_clean($usuario);
			$senha 		= do_hash($senha, "md5");

			$this->_db->where("login", $usuario);
			$this->_db->where("senha", $senha);
			$query = $this->_db->get("funcionario");
			if( $query->num_rows() > 0 ) {
				$result = TRUE;
			}
		}

		return $result;
	}
}