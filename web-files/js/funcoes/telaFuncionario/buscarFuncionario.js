var url 	= "/sirp/";

$(document).ready(function() {
	
	$("button[name='btnPesquisar']").click(function() {
		//Variaveis
		nomeFunc 		= $("#txtFuncionario").val();
		loginFunc 		= $("#txtLogin").val();
		senhaFunc 		= $("#txtSenha").val();
		nivelFunc 		= $("#cboNivelAcesso").val();
		//----------------------------------------------------

		$.post(
			url + "Funcionarios/pesquisarFuncionario",
			{
				nomeFunc: nomeFunc,
				loginFunc: loginFunc,
				senhaFunc: senhaFunc,
				nivelFunc: nivelFunc
			}, function( retornoBuscaFuncionario ) {
				$("#tbFuncionarios tbody").html('');
				retornoBuscaFuncionario = $.parseJSON(retornoBuscaFuncionario);

				if( retornoBuscaFuncionario != "" && retornoBuscaFuncionario != null ) {
					$.each( retornoBuscaFuncionario, function(index, value) {
						var achouFuncionario = false;

						$("#tbFuncionarios tbody tr").each( function(indexFunc) {
							funcionarioTabela = $( this ).find("td:nth-child(2)").text();

							if( value['login'] == funcionarioTabela ) {
								achouFuncionario = true;
							}
						});

						if( achouFuncionario == false ) {
							var linha = "";
							linha += "<tr>";
							linha += "<td>" + value['nome_funcionario'] + "</td>";
							linha += "<td>" + value['login'] + "</td>";
							linha += "<td><select name='cboNivelAcesso' disabled>";
							linha += "<option value=\"0\">Selecione</option>";
							linha += "<option value=\"1\">Administrador</option>";
							linha += "<option value=\"2\">Acesso a Relatorios</option>";
							linha += "<option value=\"3\">Visualiza Reservas</option></select></td>";
							
							linha += "<td><a id='btnEditaFunc_" + value['id_funcionario'] + "'><span class='glyphicon glyphicon-pencil'></span></td>";
							linha += "<td><a id='btnExcluirFunc_" + value['id_funcionario'] + "'><span class='glyphicon glyphicon-remove'></span></td>";
							linha += "<tr>";

							$("#tbFuncionarios tbody").append(linha);
							

							funcionarioTabela 	= $("#btnEditaFunc_" + value['id_funcionario']).parent().parent("tr").find("td:nth-child(1)").text();
							loginTabela 		= $("#btnEditaFunc_" + value['id_funcionario']).parent().parent("tr").find("td:nth-child(2)").text();
							$("#btnEditaFunc_" + value['id_funcionario']).parent().parent("tr").find("td:nth-child(3)").find("select[name='cboNivelAcesso']").val(value['nivel_acesso']);
							nivelAcessoTabela 	= $("#btnEditaFunc_" + value['id_funcionario']).parent().parent("tr").find("td:nth-child(3)").find("select[name='cboNivelAcesso']").val();
							
							/*console.log($("#btnEditaFunc_" + value['id_funcionario']).parent().parent("td select[name='cboNivelAcesso']").text());*/

							$("#btnEditaFunc_" + value['id_funcionario']).click( function() {
								$("#txtFuncionario").val( funcionarioTabela);
								$("#txtLogin").val( loginTabela );
								$("#txtSenha").val( '' );
								$("#cboNivelAcesso").val( nivelAcessoTabela );
							});

							$("#btnExcluirFunc_" + value['id_funcionario']).click( function() {
								if ( confirm("Deseja excluir a(o) funcionario(a) " + value['nome_funcionario'] + " ?") ) {
									$.post(
										url + "Funcionarios/excluir",
										{
											id_funcionario: value['id_funcionario']
										}, function( retornoExclusao ) {
											retornoExclusao = $.parseJSON(retornoExclusao);

											if( retornoExclusao == true ) {
												$( this ).parent().parent("tr").remove();
											} else {
												alert("Não foi possível excluir funcionario");
												return false;
											}
										}
									);
								}
							});
						}						
					});
					
				} else {
					alert("Funcionário(s) não encontrado(s). Por favor reveja seus filtros de busca!");
					return false;
				}
			}
		);
	});
});