<?php defined('BASEPATH') OR exit('No direct script access allowed');

class AdminController extends CI_Controller 
{

	public function eventos()
	{
		$this->load->view("header");
		$this->exibeMenu();
		$this->load->view("administracao/admin/eventos");
		$this->load->view("footer");
	}


	//Pesquisas
	public function pesquisarEventos()
	{
		$retorno = null;
		if( isset($_POST['nomeEvento']) && !empty($_POST['nomeEvento']) || isset($_POST['dataHoraEvento'], $_POST['dataHoraEventoFinal']) && !empty($_POST['dataHoraEvento']) && !empty($_POST['dataHoraEventoFinal']) ) {
			$this->load->model("admin/Evento_model", "mEvento");
			extract($_POST);

			$count 			= 0;
			$listaEventos 	= $this->mEvento->listaEventos($nomeEvento, $dataHoraInicial, $dataHoraFinal);
			foreach ($listaEventos as $evento) {
				$retorno[$count]['id_evento'] 		= $evento['id_evento'];
				$retorno[$count]['nomeEvento'] 		= $evento['nomeEvento'];
				$retorno[$count]['descricaoEvento']	= $evento['descricaoEvento'];				
				$retorno[$count]['dataHora'] 		= formataDataExibir($evento['dataHora']);
				$retorno[$count]['linkEvento'] 		= $evento['linkEvento'];
				$retorno[$count]['imagemEvento'] 	= $evento['imagemEvento'];
				$retorno[$count]['id_restaurante'] 	= $evento['id_restaurante'];
				$count++;
			}
		}

		echo json_encode($retorno);
		exit;
	}

	//--------------------------------------------------------------------------------------------------------------


	private function exibeMenu()
	{
		if(! isset($_SESSION) ) {
			session_start();
		}

		if(! isset($_SESSION['restaurante']) ) {
			session_destroy();
			alertMessage("Erro ao tentar acessar a página.\nPor favor faça o login novamente!", base_url());
			exit;
		}

		$arrayDadosTela = null;
		//Buscar dados do Restaurante
		$this->load->model("admin/Restaurante_model", "mRest");
		$listaRestaurante = $this->mRest->listaRestaurante($_SESSION['restaurante']);
		if( empty($listaRestaurante) ) {
			session_destroy();
			alertMessage("Erro ao processar dados do restaurante.\nPor favor faça o login novamente." , base_url());
			exit;
		}
		foreach ($listaRestaurante as $dadosRestaurante) {
			$arrayDadosTela['nomeRestaurante']		= $dadosRestaurante['nomeRestaurante'];
		}		
		//------------------------------------------------------------------------------------		
		$this->load->view("menu", $arrayDadosTela);
	}
}