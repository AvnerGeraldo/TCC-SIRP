<?php defined('BASEPATH') OR exit('No direct script access allowed');

class AcessoController extends CI_Controller 
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->model("acesso/Funcionario_model", "mFunc");

		if( !isset($_SESSION['loginSIRP']) ) {
			session_start();
		}

		$this->load->view('header');
		if( isset($_POST['txtLogin'], $_POST['txtSenha']) || isset($_SESSION['loginSIRP']) && !empty($_SESSION['loginSIRP']) ) {

			if( !isset($_SESSION['loginSIRP']) ) {
				extract($_POST);
				$arrayDados 	= null;
				$retornoLogin 	= $this->mFunc->logarUsuarioRestaurante($txtLogin, $txtSenha);
			} else {
				$retornoLogin = TRUE;
			}

			if( $retornoLogin ) {
				//Variáveis Tela
				$arrayDadosTela = null;
				//------------------------------------------
				if( !isset($_SESSION['loginSIRP']) ) {		
					$listaFunc = $this->mFunc->listaFuncionario($txtLogin);
					if( !empty($listaFunc) ) {						
						foreach ($listaFunc as $func) {
							$_SESSION['loginSIRP']		= $func['login'];
							$_SESSION['nivelSIRP']		= $func['nivel_acesso'];
							$_SESSION['restaurante']	= $func['id_restaurante'];
						}
					}					
				}

				$this->exibeMenu();
				

				//Nível de Acesso sistema
				switch ($_SESSION['nivelSIRP']) {
					case 3:
						//$this->load->view('administracao/index');
						break;
					case 2:
						//$this->load->view('administracao/index');
						break;
					
					default:
						$this->load->view('administracao/admin/index');
						break;
				}
				
			} else {

				$arrayDados['txtLogin'] 	= $txtLogin;
				$arrayDados['txtSenha'] 	= $txtSenha;
				$arrayDados['errorMessage'] = "Não foi possível logar. Por favor tente novamente.";

				$this->load->view('loginSistema', $arrayDados);
			}
		} else {			
			$this->load->view('loginSistema');
		}

		$this->load->view("footer");
	}

	public function logoff()
	{
		if( !isset($_SESSION) ) {
			session_start();
		}
		session_destroy();		
		alertMessage("Saindo do sistema...", base_url());
	}


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
