<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] 		= 'AcessoController';
$route['Logoff'] 					= 'AcessoController/logoff';

//Exibir páginas
$route['Restaurante'] 							= 'AdminController/restaurante';
$route['Eventos'] 								= 'AdminController/eventos';
$route['Funcionarios'] 							= 'AdminController/funcionario';
$route['Produtos'] 								= 'AdminController/produto';
$route['Cardapio'] 								= 'AdminController/cardapio';
$route['Reservas'] 								= 'AdminController/visualizaReserva';
//---------------------------------------------------------------------------------

//Cadastros
$route['Restaurante/cadastrar'] 				= 'AdminController/cadastrarRestaurante';
$route['Restaurante/cadastrarMesa'] 			= 'AdminController/cadastrarMesa';
$route['Eventos/cadastrar'] 					= 'AdminController/cadastrarEvento';
$route['Funcionario/cadastrar'] 				= 'AdminController/cadastrarFuncionario';
$route['Produtos/cadastrar'] 					= 'AdminController/cadastrarProduto';
$route['Cardapio/cadastrar'] 					= 'AdminController/cadastrarCardapio';
//---------------------------------------------------------------------------------

//Excluir
$route['Funcionario/excluir'] 					= 'AdminController/excluirFuncionario';
$route['Produto/removeProduto'] 				= 'AdminController/excluirProduto';
$route['Reservas/cancelarReservaCliente'] 		= 'AdminController/cancelarReservaCliente';

//---------------------------------------------------------------------------------


//Pesquisas
$route['Restaurante/pesquisarEventos'] 			= 'AdminController/pesquisarEventos';
$route['Restaurante/pesquisarMesas'] 			= 'AdminController/pesquisarMesas';
$route['Restaurante/pesquisarInfoRestaurante'] 	= 'AdminController/pesquisarInfoRestaurante';
$route['Funcionarios/pesquisarFuncionario'] 	= 'AdminController/pesquisarFuncionario';
$route['Produtos/pesquisarArrayProdutos'] 		= 'AdminController/pesquisarArrayProdutos';
$route['Cardapio/pesquisarArrayCardapio'] 		= 'AdminController/pesquisarArrayCardapio';
$route['Categoria/pesquisarCategoria'] 			= 'AdminController/pesquisarCategoria';
$route['Reservas/pesquisarReservas'] 			= 'AdminController/pesquisarReservas';

//---------------------------------------------------------------------------------
//Stuffs
$route['UploadImagem'] 	= 'AdminController/UploadImagem';
//---------------------------------------------------------------------------------

$route['404_override'] 			= '';
$route['translate_uri_dashes'] 	= FALSE;
