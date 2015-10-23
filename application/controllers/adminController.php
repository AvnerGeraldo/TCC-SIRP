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
		
		$this->load->model("admin/Restaurante_model", "mRest");
		$result 			= null;
		$erros 				= 0;
		$arrayRestauranteBD = null;
		$arrayDadosTela 	= null;
		extract($_POST);

		
		//Verificar acesso do restaurante
		if(! isset($_SESSION) ) {
			session_start();
		}

		if(! isset($_SESSION['restaurante']) ) {
			session_destroy();
			alertMessage("Erro ao tentar acessar a página.Por favor faça o login novamente!", base_url());
			exit;
		}
		//---------------------------------------------------------------------------------------------------			

		if( isset($txtCNPJ, $txtNomeRestaurante, $txtTelefone1, $txtHorarioFuncionamentoInicial, $txtHorarioFuncionamentoFinal) && !empty($txtCNPJ) && !empty($txtNomeRestaurante) && !empty($txtTelefone1) && !empty($txtHorarioFuncionamentoInicial) && !empty($txtHorarioFuncionamentoFinal) ) {
			$arrayRestauranteBD['cnpj'] 						= retiraCaracteres($txtCNPJ);
			$arrayRestauranteBD['nomeRestaurante'] 				= $txtNomeRestaurante;
			$arrayRestauranteBD['nomeFantasia'] 				= $txtNomeFantasia;
			$arrayRestauranteBD['descricaoRestaurante'] 		= auto_typography($txtDescricao);			
			$arrayRestauranteBD['telefone1'] 					= $txtTelefone1;
			$arrayRestauranteBD['telefone2'] 					= $txtTelefone2;
			$arrayRestauranteBD['horarioFuncionamentoInicial'] 	= formataDataBanco($txtHorarioFuncionamentoInicial, 'S');
			$arrayRestauranteBD['horarioFuncionamentoFinal'] 	= formataDataBanco($txtHorarioFuncionamentoFinal, 'S');
			$arrayRestauranteBD['statusRestaurante'] 			= 'A';			

			if( isset($_FILES['txtImagemRestaurante']) && !empty($_FILES['txtImagemRestaurante']) ) {	
				$diretorioArquivo 	= $_SERVER['DOCUMENT_ROOT']."/sirp/web-files/imagens/restaurantes/{$_SESSION['restaurante']}";

				//Criando Pasta dos eventos do restaurante
				if (!is_dir($diretorioArquivo)) {
		            mkdir($diretorioArquivo);
		        }
		        $diretorioArquivo .= "/imagens";
		        if (!is_dir($diretorioArquivo)) {
		            mkdir($diretorioArquivo);
		        }
		        //--------------------------------------------------------
		        $arrayImagens = null;
				for($i = 0; $i < count($_FILES['txtImagemRestaurante']); $i++) {
					if( !empty($_FILES['txtImagemRestaurante']['name'][$i]) ) {
						$arrayImagens[$i]['name'] 		= $_FILES['txtImagemRestaurante']['name'][$i];
						$arrayImagens[$i]['type'] 		= $_FILES['txtImagemRestaurante']['type'][$i];
						$arrayImagens[$i]['tmp_name'] 	= $_FILES['txtImagemRestaurante']['tmp_name'][$i];
						$arrayImagens[$i]['error'] 		= $_FILES['txtImagemRestaurante']['error'][$i];
						$arrayImagens[$i]['size'] 		= $_FILES['txtImagemRestaurante']['size'][$i];

						$arquivo 		= $arrayImagens[$i];
						$retornoUpload 	= uploadArquivo($arquivo, $diretorioArquivo);
						if( !empty($retornoUpload) ) {
							$arrayDadosTela['exibeMensagem'] = "<div class=\"alert alert-warning alert-dismissible error-message\" role=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\" >&times;</span></button>{$retornoUpload}</div>";
							$erros++;
							break;
						}
					}	
				}								
			}

		/*	var_dump($erros, $arrayRestauranteBD);
			exit;*/
			if( $erros == 0 ) {					
				$result = $this->mRest->cadastrarRestaurante($arrayRestauranteBD);
			}			
		}

		if( isset($txtLogradouro, $txtBairro, $txtCidade, $cboEstado) && !empty($txtLogradouro) && !empty($txtBairro) && !empty($txtCidade) && !empty($cboEstado) ) {
			$listaRestaurante = $this->mRest->listaRestaurante($_SESSION['restaurante']);
			if( !empty($listaRestaurante) ) {
				foreach ($listaRestaurante as $restaurante) {
					if( !empty($restaurante['cnpj']) && !empty($restaurante['nomeRestaurante']) && !empty($restaurante['telefone1']) && !empty($restaurante['horarioFuncionamentoInicial']) && !empty($restaurante['horarioFuncionamentoFinal']) ) {
						$arrayRestauranteBD['nomeRestaurante'] 				= $restaurante['nomeRestaurante'];
						$arrayRestauranteBD['horarioFuncionamentoInicial'] 	= $restaurante['horarioFuncionamentoInicial'];
						$arrayRestauranteBD['horarioFuncionamentoFinal'] 	= $restaurante['horarioFuncionamentoFinal'];
						$arrayRestauranteBD['logradouro'] 					= $txtLogradouro;
						$arrayRestauranteBD['complemento'] 					= ( isset($txtComplemento) && !empty($txtComplemento) ? $txtComplemento : '' );
						$arrayRestauranteBD['bairro'] 						= $txtBairro;
						$arrayRestauranteBD['cidade'] 						= $txtCidade;
						$arrayRestauranteBD['cep'] 							= $txtCep;
						$arrayRestauranteBD['uf'] 							= $cboEstado;
						$result = $this->mRest->cadastrarRestaurante($arrayRestauranteBD);
						
					} else {
						$arrayDadosTela['exibeMensagem'] = "<div class=\"alert alert-warning alert-dismissible error-message\" role=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\" >&times;</span></button>Não foi possível cadastrar Restaurante. Por favor cadastre os dados do restaurante primeiro.</div>";
					}
				}				
			}
		}

		if( $result == FALSE  && !isset($arrayDadosTela['exibeMensagem']) ) {
			$arrayDadosTela['exibeMensagem'] = "<div class=\"alert alert-warning alert-dismissible error-message\" role=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\" >&times;</span></button>Não foi possível cadastrar Restaurante.</div>";
		} else {
			$arrayDadosTela['exibeMensagem'] = "<div class=\"alert alert-success alert-dismissible error-message\" role=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\" >&times;</span></button>Restaurante cadastrado com sucesso!</div>";
		}

		$this->load->view("header");
		$this->exibeMenu();
		$this->load->view("administracao/admin/infoRestaurante", $arrayDadosTela);
		$this->load->view("footer");
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
				alertMessage("Erro ao tentar acessar a página.Por favor faça o login novamente!", base_url());
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
			alertMessage("Erro ao tentar acessar a página.Por favor faça o login novamente!", base_url());
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
				$arrayEventoBD['descricaoEvento'] 	= ( isset($txtDescricao) && !empty($txtDescricao) ? auto_typography($txtDescricao) : null );
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

	public function funcionario()
	{		
		$this->load->view("header");
		$this->exibeMenu();
		$this->load->view("administracao/admin/funcionarios");
		$this->load->view("footer");
	}

	public function cadastrarFuncionario()
	{	
		$arrayDadosTela = null;
		if( isset($_POST['txtFuncionario'], $_POST['txtLogin'], $_POST['cboNivelAcesso']) && !empty($_POST['txtFuncionario']) && !empty($_POST['txtLogin']) && !empty($_POST['cboNivelAcesso']) ) {
			$this->load->model("acesso/Funcionario_model", "mFunc");
			extract($_POST);

			if(! isset($_SESSION) ) {
				session_start();
			}

			if(! isset($_SESSION['restaurante']) ) {
				session_destroy();
				alertMessage("Erro ao tentar acessar a página.Por favor faça o login novamente!", base_url());
				exit;
			}

			$arrayFuncionario = null;
			$arrayFuncionario['nome_funcionario'] 		=  strtoupper($txtFuncionario);
			$arrayFuncionario['login'] 					=  strtolower($txtLogin);
			
			if( !empty($txtSenha) ) {
				$arrayFuncionario['senha'] 					=  do_hash($txtSenha, "md5");
			}

			$arrayFuncionario['nivel_acesso'] 			=  $cboNivelAcesso;
			$arrayFuncionario['id_restaurante'] 		=  $_SESSION['restaurante'];



			$retornoCadastro = $this->mFunc->cadastrarFuncionario($arrayFuncionario) ;
		
			if( $retornoCadastro ) {
				$arrayDadosTela['exibeMensagem'] = "<div class=\"alert alert-success alert-dismissible error-message\" role=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\" >&times;</span></button>Funcionário cadastrado com sucesso!</div>";
			} else {
				$arrayDadosTela['exibeMensagem'] = "<div class=\"alert alert-danger alert-dismissible error-message\" role=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\" >&times;</span></button>Erro ao cadastrar funcionário. Por favor verifique os dados.</div>";
			}
		}

		$this->load->view("header");
		$this->exibeMenu();
		$this->load->view("administracao/admin/funcionarios", $arrayDadosTela);
		$this->load->view("footer");
 	}

	public function excluirFuncionario()
	{
		$result = false;
		if( isset($_POST['id_funcionario']) && !empty($_POST['id_funcionario']) ) {
			$this->load->model("acesso/Funcionario_model", "mFunc");
			extract($_POST);

			$result = $this->mFunc->excluirFuncionario($id_funcionario);
		}

		echo json_encode($result);
		exit;
	}


	public function produto()
	{

		$this->load->view("header");
		$this->exibeMenu();
		$this->load->view("administracao/admin/produtos");
		$this->load->view("footer");
	}

	public function cadastrarProduto()
	{
		if( isset($_POST['cboCategoria'], $_POST['txtProduto'], $_POST['txtPreco'], $_POST['rbAtivo']) &&
			!empty($_POST['cboCategoria']) && !empty($_POST['txtProduto']) && !empty($_POST['txtPreco']) &&
			!empty($_POST['rbAtivo']) ) {
			$this->load->model("admin/Produto_model", "mProduto");
			extract($_POST);


			//Verificar acesso do restaurante
			if(! isset($_SESSION) ) {
				session_start();
			}

			if(! isset($_SESSION['restaurante']) ) {
				session_destroy();
				alertMessage("Erro ao tentar acessar a página.Por favor faça o login novamente!", base_url());
				exit;
			}
			//---------------------------------------------------------------------------------------------------	

			if( isset($_FILES['txtImagem']) && !empty($_FILES['txtImagem']) ) {
				//Pasta de destino
				$diretorioArquivo 	= $_SERVER['DOCUMENT_ROOT']."/sirp/web-files/imagens/restaurantes/{$_SESSION['restaurante']}/";
				if (!is_dir($diretorioArquivo)) {
		            umask(0777);
		            mkdir($diretorioArquivo);            
		        }

		        $diretorioArquivo     .= "produtos/";
		        if (!is_dir($diretorioArquivo)) {
		            umask(0777);
		            mkdir($diretorioArquivo);            
		        }        
		        //---------------------------------------------------------------------------------------------------------------------------------------------
		        		        
				$retornoUpload 	= uploadArquivo($arquivo, $diretorioArquivo);
				if( !empty($retornoUpload) ) {
					$arrayDadosTela['exibeMensagem'] = "<div class=\"alert alert-warning alert-dismissible error-message\" role=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\" >&times;</span></button>{$retornoUpload}</div>";
					$erros++;
					break;
				} else {
					$nomeImagem = $_FILES['txtImagem']['name'];
				}
			}

			if( !isset($_FILES['txtImagem']) || empty($retornoUpload) ) {
				$arrayProduto 							= null;
				$arrayProduto['nomeProduto'] 			= $txtProduto;
				$arrayProduto['descricaoProduto'] 		= auto_typography($txtDescricao);
				$arrayProduto['valor'] 					= formataValorBanco($txtPreco);
				$arrayProduto['status'] 				= $rbAtivo;
				$arrayProduto['imagem'] 				= ( isset($nomeImagem) ? $nomeImagem : '' );
				$arrayProduto['id_categoriaProduto'] 	= $cboCategoria;

				$retornoCadastro = $this->mProduto->cadastrarProduto($arrayProduto);
				if( $retornoCadastro ) {
					$arrayDadosTela['exibeMensagem'] = "<div class=\"alert alert-success alert-dismissible error-message\" role=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\" >&times;</span></button>Produto cadastrado com sucesso!</div>";
				} else {
					$arrayDadosTela['exibeMensagem'] = "<div class=\"alert alert-danger alert-dismissible error-message\" role=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\" >&times;</span></button>Erro ao cadastrar produto. Por favor verifique os dados inseridos!</div>";
				}
			}

		}

		$this->load->view("header");
		$this->exibeMenu();
		$this->load->view("administracao/admin/produtos", $arrayDadosTela);
		$this->load->view("footer");
	}

	
	//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
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
					$retorno[$count]['descricaoEvento']	= auto_typography($evento['descricaoEvento']);				
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

	public function pesquisarInfoRestaurante()
	{
		$retorno = null;		
		$this->load->model("admin/Restaurante_model", "mRest");
		extract($_POST);

		if(! isset($_SESSION) ) {
			session_start();
		}

		if(! isset($_SESSION['restaurante']) ) {
			session_destroy();
			alertMessage("Erro ao tentar acessar a página.Por favor faça o login novamente!", base_url());
			exit;
		}

		$count 				= 0;
		$listaRestaurante 	= $this->mRest->listaRestaurante($_SESSION['restaurante']);
		if( !empty($listaRestaurante) ) {
			foreach ($listaRestaurante as $restaurante) {
				$retorno[$count]['id_restaurante'] 				= $restaurante['id_restaurante'];
				$retorno[$count]['nomeRestaurante'] 			= $restaurante['nomeRestaurante'];
				$retorno[$count]['nomeFantasia'] 				= $restaurante['nomeFantasia'];
				$retorno[$count]['descricaoRestaurante'] 		= auto_typography($restaurante['descricaoRestaurante']);
				$retorno[$count]['cnpj'] 						= $restaurante['cnpj'];
				$retorno[$count]['logradouro'] 					= $restaurante['logradouro'];
				$retorno[$count]['complemento'] 				= $restaurante['complemento'];
				$retorno[$count]['bairro'] 						= $restaurante['bairro'];
				$retorno[$count]['cidade'] 						= $restaurante['cidade'];
				$retorno[$count]['cep'] 						= $restaurante['cep'];
				$retorno[$count]['uf'] 							= $restaurante['uf'];
				$retorno[$count]['telefone1'] 					= $restaurante['telefone1'];
				$retorno[$count]['telefone2'] 					= $restaurante['telefone2'];
				$retorno[$count]['horarioFuncionamentoInicial'] = formataDataExibir($restaurante['horarioFuncionamentoInicial'], 'S');
				$retorno[$count]['horarioFuncionamentoFinal'] 	= formataDataExibir($restaurante['horarioFuncionamentoFinal'], 'S');				
						
				$count++;
			}
		}
		

		echo json_encode($retorno);
		exit;
	}

	public function pesquisarFuncionario()
	{
		$result = null;
		

		if( isset($_POST['nomeFunc'], $_POST['loginFunc'], $_POST['senhaFunc'], $_POST['nivelFunc']) ) {
			$this->load->model("acesso/Funcionario_model", "mFunc");
			extract($_POST);

			$result = $this->mFunc->buscarFuncionario($nomeFunc, $loginFunc, $nivelFunc);
		}

		echo json_encode($result);
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
			alertMessage("Erro ao tentar acessar a página.Por favor faça o login novamente!", base_url());
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

	//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

}