<?php defined('BASEPATH') OR exit('No direct script access allowed');

class AdminController extends CI_Controller 
{

	public function restaurante()
	{
		$this->load->view("header");
		$this->exibeMenu();
		$this->load->view("administracao/admin/infoRestaurante");
		$this->load->view("footer");
	}

	public function cadastrarRestaurante()
	{
		$result = null;
		extract($_POST);
		if( isset($nomeRest, $telRest_1, $enderecoRest, $bairroRest, $cidadeRest, $cboEstadoRest, $horarioIniRest, $horarioFimRest) &&
			!empty($nomeRest) && !empty($telRest_1) && !empty($enderecoRest) && !empty($bairroRest) && !empty($cidadeRest) && !empty($cboEstadoRest) && !empty($horarioIniRest) && !empty($horarioFimRest) ) {
			$this->load->model("Restaurante_model", "mRest");

			$arrayRestauranteBD 								= null;
			$arrayRestauranteBD['nomeRestaurante'] 				= $nomeRest;
			$arrayRestauranteBD['nomeFantasia'] 				= $nomeFantasiaRest;
			$arrayRestauranteBD['descricaoRestaurante'] 		= $descricaoRest;
			$arrayRestauranteBD['cnpj'] 						= retiraCaracteres($cnpjRest);
			$arrayRestauranteBD['logradouro'] 					= $enderecoRest;
			$arrayRestauranteBD['complemento'] 					= $complementoRest;
			$arrayRestauranteBD['bairro'] 						= $bairroRest;
			$arrayRestauranteBD['cidade'] 						= $cidadeRest;
			$arrayRestauranteBD['cep'] 							= retiraCaracteres($cepRest);
			$arrayRestauranteBD['uf'] 							= $cboEstadoRest;
			$arrayRestauranteBD['telefone1'] 					= retiraCaracteres($telRest_1);
			$arrayRestauranteBD['telefone2'] 					= retiraCaracteres($telRest_2);
			$arrayRestauranteBD['horarioFuncionamentoInicial'] 	= formataDataBanco($horarioIniRest, 'S');
			$arrayRestauranteBD['horarioFuncionamentoFinal'] 	= formataDataBanco($horarioFimRest, 'S');
			$arrayRestauranteBD['statusRestaurante'] 			= 'A';

			$result = $this->mRest->cadastrarRestaurante($arrayRestauranteBD);
		}

		echo json_encode($result);
		exit;
	}

	public function cadastrarMesa()
	{
		$result = null;
		if( isset($_POST['numeroMesa'], $_POST['qtdLugarMesa']) && !empty($_POST['numeroMesa']) && !empty($_POST['qtdLugarMesa']) ) {
			$this->load->model("admin/Mesa_model", "mMesa");
			extract($_POST);

			//Verificar acesso do restaurante
			if(! isset($_SESSION) ) {
				session_start();
			}

			if(! isset($_SESSION['restaurante']) ) {
				session_destroy();
				alertMessage("Erro ao tentar acessar a página.\nPor favor faça o login novamente!", base_url());
				exit;
			}
			//---------------------------------------------------------------------------------------------------
			
			$arrayMesaBD 					= null;
			$arrayMesaBD['num_mesa'] 		= $numeroMesa;
			$arrayMesaBD['qtdLugaresMesa'] 	= $qtdLugarMesa;
			$arrayMesaBD['taxaMesa'] 		= ( isset($taxaMesa) ? formataValorBanco($taxaMesa) : 0 );
			$arrayMesaBD['id_restaurante'] 	= $_SESSION['restaurante'];

			$result = $this->mMesa->cadastrarMesa($arrayMesaBD);
		} 

		echo json_encode($result);
		exit;
	}

	public function eventos()
	{
		$this->load->view("header");
		$this->exibeMenu();
		$this->load->view("administracao/admin/eventos");
		$this->load->view("footer");
	}

	public function cadastrarEvento()
	{

		if(! isset($_SESSION) ) {
			session_start();
		}

		if(! isset($_SESSION['restaurante']) ) {
			session_destroy();
			alertMessage("Erro ao tentar acessar a página.\nPor favor faça o login novamente!", base_url());
			exit;
		}

		if( isset($_POST['txtEvento'], $_POST['txtDataHora']) && !empty($_POST['txtEvento'])
			&& !empty($_POST['txtDataHora']) && !empty($_SESSION['restaurante']) ) {
			$this->load->model("admin/Evento_model", "mEvento");
			extract($_POST);
			
			if( isset($_FILES['txtImagemEvento']['name']) && !empty($_FILES['txtImagemEvento']['name']) ) {
				$arquivo 			= $_FILES['txtImagemEvento'];
				$diretorioArquivo 	= $_SERVER['DOCUMENT_ROOT']."/sirp/web-files/imagens/restaurantes/{$_SESSION['restaurante']}";

				//Criando Pasta dos eventos do restaurante
				if (!is_dir($diretorioArquivo)) {
		            umask(0777);
		            mkdir($diretorioArquivo);
		            chmod($diretorioArquivo, 0777);
		        }
		        $diretorioArquivo .= "/eventos";
		        if (!is_dir($diretorioArquivo)) {
		            umask(0777);
		            mkdir($diretorioArquivo);
		            chmod($diretorioArquivo, 0777);
		        }
		        //--------------------------------------------------------  

				$retornoUpload = uploadArquivo($arquivo, $diretorioArquivo);

				if( !empty($retornoUpload) ) {					
					$arrayDadosTela['exibeMensagem'] = "<div class=\"alert alert-danger alert-dismissible error-message\" role=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\" >&times;</span></button>Erro de upload: {$retornoUpload}\nNão foi possível cadastrar evento.</div>";
					
				}
			}

			if( !isset($arrayDadosTela['exibeMensagem']) ) {
				$arrayEventoBD 						= null;
				$arrayEventoBD['nomeEvento'] 		= $txtEvento;
				$arrayEventoBD['descricaoEvento'] 	= ( isset($txtDescricao) && !empty($txtDescricao) ? $txtDescricao : null );
				$arrayEventoBD['dataHora'] 			= formataDataBanco($txtDataHora, 'S');
				$arrayEventoBD['linkEvento'] 		= ( isset($txtLinkEvento) && !empty($txtLinkEvento) ? $txtLinkEvento : null );
				$arrayEventoBD['imagemEvento'] 		= ( isset($arquivo['name']) && !empty($arquivo['name']) ? $arquivo['name'] : null );
				$arrayEventoBD['id_restaurante'] 	= $_SESSION['restaurante'];

				$retorno = $this->mEvento->cadastrarEvento($arrayEventoBD);

				if( $retorno ) {
					$arrayDadosTela['exibeMensagem'] = "<div class=\"alert alert-success alert-dismissible error-message\" role=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\" >&times;</span></button>Cadastro de evento realizado com sucesso!</div>";
				}
			}
		}

		$this->load->view("header");
		$this->exibeMenu();
		$this->load->view("administracao/admin/eventos", $arrayDadosTela);
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
			$listaEventos 	= $this->mEvento->listaEventos($nomeEvento, $dataHoraEvento, $dataHoraEventoFinal);
			if( !empty($listaEventos) ) {
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
		}

		echo json_encode($retorno);
		exit;
	}
	
	public function pesquisarMesas()
	{
		$retorno = null;		
		$this->load->model("admin/Mesa_model", "mMesa");
		extract($_POST);

		$count 			= 0;
		$listaEventos 	= $this->mMesa->listaMesa();
		if( !empty($listaEventos) ) {
			foreach ($listaEventos as $evento) {
				$retorno[$count]['id_mesa'] 		= $evento['id_mesa'];
				$retorno[$count]['num_mesa'] 		= $evento['num_mesa'];
				$retorno[$count]['qtdLugaresMesa']	= $evento['qtdLugaresMesa'];				
				$retorno[$count]['taxaMesa'] 		= formataValorExibir($evento['taxaMesa']);				
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