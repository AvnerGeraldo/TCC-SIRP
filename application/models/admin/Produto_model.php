<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Produto_model extends CI_Model
{
	private $_db;

	public function __construct()
	{
		$this->_db = $this->load->database("site", TRUE);
	}

	public function buscarProduto($idProduto = null, $nomeProduto = null, $status = null)
	{
		$result = null;
		if( !empty($idProduto) ) {
			$this->_db->where("id_produto", $idProduto);
		}

		if( !empty($nomeProduto) ) {
			$this->_db->like("nomeProduto", $nomeProduto);
		}

		if( !empty($status) ) {
			$this->_db->where("status", $status);
		}

		$query = $this->_db->get("produto");
		if( $query->num_rows() > 0 ) {
			$result = $query->result_array();
		}

		return $result;
	}

	public function cadastrarProduto($arrayProduto)
	{
		$result 		= null;
		
		$listaProduto 	= $this->buscarProduto(null, $arrayProduto['nomeProduto']);
		if( !empty($listaProduto) ) {
			foreach ($listaProduto as $prod) {
				$this->_db->where("id_produto", $prod['id_produto']);
				$result = $this->_db->update("produto", $arrayProduto);
			}			
		} else {
			$result = $this->_db->insert("produto", $arrayProduto);
		}
		return $result;
	}

	public function excluirProduto($id_produto)
	{
		if( !empty($id_produto) ) {			
			$this->_db->where("id_produto", $id_produto);
			return $this->_db->delete("produto");
		}

		return false;
	}
}