$(document).ready(function() {
	$("#txtCNPJ").mask("00.000.000/0000-00");
	$("#txtHorarioFuncionamentoInicial").mask("00/00/0000 00:00:00");
	$("#txtHorarioFuncionamentoFinal").mask("00/00/0000 00:00:00");
	$("#txtTelefone1").mask("(00) 0000-0000)");
	$("#txtTelefone2").mask("(00) 00000-0000)");

	$("button[name='btnCadastraInfoRestaurante']").click( function(e) {
		e.preventDefault(event);

		//Variaveis
		cnpjRest 			= $("#txtCNPJ").val();
		nomeRest 			= $("#txtNomeRestaurante").val();
		nomeFantasiaRest	= $("#txtNomeFantasia").val();
		descricaoRest		= $("#txtDescricao").val();
		telRest_1 			= $("#txtTelefone1").val();
		telRest_2 			= $("#txtTelefone2").val();
		arrayImagens		= $("input[type='file'][name='txtImagemRestaurante']").files;
		enderecoRest		= $("#txtLogradouro").val();
		complementoRest		= $("#txtComplemento").val();
		bairroRest			= $("#txtBairro").val();
		cidadeRest			= $("#txtCidade").val();
		cboEstadoRest		= $("#cboEstado").val();
		horarioIniRest		= $("#txtHorarioFuncionamentoInicial").val();
		horarioFimRest		= $("#txtHorarioFuncionamentoFinal").val();


		console.log($("input[type='file'][name='txtImagemRestaurante']"));
		console.log(arrayImagens);
		//----------------------------------------------------------------------------

		if( cnpjRest != "" && nomeRest != "" && enderecoRest != "" && bairroRest != "" && cidadeRest != ""
			&& cboEstadoRest != "" && telRest_1 != "" && horarioIniRest != "" && horarioFimRest != "" ) {
			$.post(
			{

			}, function( retornoCadastraRestaurante ) {
				retornoCadastraRestaurante = $.parseJSON(retornoCadastraRestaurante);

				if( retornoCadastraRestaurante != null && retornoCadastraRestaurante != "" ) {

					if( retornoCadastraRestaurante == true ) {
						limpaDados();
						$(".error-message").remove();
						$("form[name=\"frmRestauranteInfo\"]").before("<div class=\"alert alert-success alert-dismissible error-message\" role=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\" >&times;</span></button>Cadastro de restaurante realizado com sucesso!</div>");
						$("form[name=\"frmRestauranteEndereco\"]").before("<div class=\"alert alert-success alert-dismissible error-message\" role=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\" >&times;</span></button>Cadastro de restaurante realizado com sucesso!</div>");
						return false;
					} else {
						$(".error-message").remove();
						$("form[name=\"frmRestauranteInfo\"]").before("<div class=\"alert alert-warning alert-dismissible error-message\" role=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\" >&times;</span></button>Não foi possível cadastrar restaurante. Por favor verifique os seus dados.</div>");
						$("form[name=\"frmRestauranteEndereco\"]").before("<div class=\"alert alert-warning alert-dismissible error-message\" role=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\" >&times;</span></button>Não foi possível cadastrar restaurante. Por favor verifique os seus dados.</div>");
						return false;
					}
				} else {
					$(".error-message").remove();
					$("form[name=\"frmRestauranteInfo\"]").before("<div class=\"alert alert-warning alert-dismissible error-message\" role=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\" >&times;</span></button>Não foi possível cadastrar restaurante. Por favor verifique os seus dados.</div>");
					$("form[name=\"frmRestauranteEndereco\"]").before("<div class=\"alert alert-warning alert-dismissible error-message\" role=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\" >&times;</span></button>Não foi possível cadastrar restaurante. Por favor verifique os seus dados.</div>");
					return false;
				}
			}
			);
		} else {
			$(".error-message").remove();
			$("form[name=\"frmRestauranteInfo\"]").before("<div class=\"alert alert-warning alert-dismissible error-message\" role=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\" >&times;</span></button>Por favor preencha os campos corretamente!</div>");
			$("form[name=\"frmRestauranteEndereco\"]").before("<div class=\"alert alert-warning alert-dismissible error-message\" role=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\" >&times;</span></button>Por favor preencha os campos corretamente!</div>");
			return false;
		}
	});

	function limpaDados()
	{
		$("#txtCNPJ").val('');
		$("#txtNomeRestaurante").val('');
		$("#txtNomeFantasia").val('');
		$("#txtDescricao").val('');
		$("#txtTelefone1").val('');
		$("#txtTelefone2").val('');
		$("input[type='file'][name='txtImagemRestaurante']").each(function(){
			$( this ).val('');
		});
		$("#txtLogradouro").val('');
		$("#txtComplemento").val('');
		$("#txtBairro").val('');
		$("#txtCidade").val('');
		$("#cboEstado").val('');
		$("#txtHorarioFuncionamentoInicial").val('');
		$("#txtHorarioFuncionamentoFinal").val('');
	}
});