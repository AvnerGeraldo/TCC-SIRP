<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pedido_model extends CI_Model
{
	private $_db;

	public function __construct()
	{
		$this->_db = $this->load->database("site", TRUE);
	}

	public function listaPedidos($id_pedido = null, $status = null )
	{
		$result = null;

		if( !empty($id_pedido) ) {
			$this->_db->where("p.id_pedido", $id_pedido);
		}	

		$this->_db->select("p.id_pedido, p.valorTotal, p.statusAprovado, ip.qtd_produto, pr.id_produto, pr.nomeProduto, pr.valor, pr.imagem, pr.status, cat.nomeCategoriaProduto");
		$this->_db->from("pedido p");
		$this->_db->join("itenspedido ip", "ip.id_pedido = p.id_pedido");
		$this->_db->join("produto pr", "pr.id_produto = ip.id_produto");
		$this->_db->join("categoriaproduto cat", "cat.id_categoriaProduto = pr.id_categoriaProduto");

		$query = $this->_db->get();
		if( $query->num_rows() > 0 ) {
			$result = $query->result_array();
		}

		return $result;
	}	
}