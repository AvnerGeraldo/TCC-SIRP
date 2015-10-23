<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Funcionario_model extends CI_Model
{
	private $_db;
	public function __construct()
	{
		$this->_db = $this->load->database("site", TRUE);
	}

	public function buscarFuncionario($nomeFunc = null, $loginFunc = null, $nivelAcessoFunc = null)
	{
		$result = null;

		if(! isset($_SESSION) ) {
			session_start();
		}

		if(! isset($_SESSION['restaurante']) ) {
			session_destroy();
			alertMessage("Erro ao tentar acessar a página.Por favor faça o login novamente!", base_url());
			exit;
		}

		if( !empty($nomeFunc) ) {
			$this->_db->like("nome_funcionario", $nomeFunc);
		}

		if( !empty($loginFunc) ) {
			$this->_db->where("login", $loginFunc);
		}

		if( !empty($nivelAcessoFunc) ) {
			$this->_db->where("nivel_acesso", $nivelAcessoFunc);
		}

		
		$this->_db->where("id_restaurante", $_SESSION['restaurante']);
		

		$query = $this->_db->get("funcionario");
	/*	echo $this->_db->last_query();
		exit;*/
		if( $query->num_rows() > 0 ) {
			$result = $query->result_array();
		}

		return $result;
	}

	public function buscarFuncionarioLogin($loginFunc)
	{
		$result = null;

		if( !empty($loginFunc) ) {
			$this->_db->where("login", $loginFunc);
		} else {
			return $result;
		}

		$query = $this->_db->get("funcionario");
		if( $query->num_rows() > 0 ) {
			$result = $query->result_array();
		}

		return $result;
	}

	public function cadastrarFuncionario($arrayFuncionario)
	{
		$result 		= null;

		if(! isset($_SESSION) ) {
			session_start();
		}

		if(! isset($_SESSION['restaurante']) ) {
			return $result;
		}
		
		$buscarFuncionario 	= $this->buscarFuncionario( null , $arrayFuncionario['login']);
		if( !empty($buscarFuncionario) ) {
			foreach ($buscarFuncionario as $func) {
				$this->_db->where("id_restaurante", $func['id_restaurante']);
				$this->_db->where("id_funcionario", $func['id_funcionario']);
				$result = $this->_db->update("funcionario", $arrayFuncionario);
			}			
		} else {
			$result = $this->_db->insert("funcionario", $arrayFuncionario);
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
			/*echo $this->_db->last_query();
			exit;*/
			if( $query->num_rows() > 0 ) {
				$result = TRUE;
			}
		}
		return $result;
	}
}