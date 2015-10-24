<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Reserva_model extends CI_Model
{
	private $_db;

	public function __construct()
	{
		$this->_db = $this->load->database("site", TRUE);
	}

	public function buscarDadosReserva($statusReserva = null, $dataHora = null)
	{
		$result = null;

		if( $statusReserva != "" ) {
			$this->_db->where("r.statusReserva", $statusReserva);
		}

		if( !empty($dataHora) ) {
			$this->_db->where("r.dataHora >=", $dataHora);
		}
		$this->_db->select("r.id_reserva, r.dataHora, r.statusReserva, c.nomeCliente, m.num_mesa, m.qtdLugaresMesa, m.taxaMesa, p.id_pedido, p.valorTotal, p.statusAprovado");
		$this->_db->from("reserva r");
		$this->_db->join("cliente c", "c.id_cliente = r.id_cliente");
		$this->_db->join("mesa m", "m.id_mesa = r.id_mesa");
		$this->_db->join("pedido p", "p.id_pedido = r.id_pedido", "left");

		$query = $this->_db->get();
	/*	echo $this->_db->last_query();
		exit;*/
		if( $query->num_rows() > 0 ) {
			$result = $query->result_array();
		}

		return $result;
	}

	public function cancelarReserva($id_reserva)
	{		
		$this->_db->where("id_reserva", $id_reserva);
		return $this->_db->update("reserva", array("statusReserva" => 1));

	}

	
}