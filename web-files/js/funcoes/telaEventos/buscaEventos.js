var url 	= "/sirp/";
var display = true;
$(document).ready(function() {
	limparFormulario();
	limpaPeriodo();

	$("a.btnAddBuscaPeriodo").click(function () {
		if( display == true ) {
			display = false;
			$("#txtDataHoraFinal").parent("div").show();
			$(".texto-periodo").parent("div").show();			
			$("a.btnAddBuscaPeriodo i").removeClass("fa-caret-square-o-right").addClass('fa-caret-square-o-left');
		} else {
			display = true;
			$("#txtDataHoraFinal").parent("div").hide();
			$(".texto-periodo").parent("div").hide();
			$("a.btnAddBuscaPeriodo i").removeClass("fa-caret-square-o-left").addClass('fa-caret-square-o-right');
		}
	});

	$("button[name='btnPesquisar']").click( function() {
		nomeEvento 			= $("#txtEvento").val();
		dataHoraEvento 		= $("#txtDataHora").val();
		dataHoraEventoFinal = $("#txtDataHoraFinal").val();

		if( nomeEvento == "" || dataHoraEvento == "" || dataHoraEvento != "" && dataHoraEventoFinal == "") {
			$(".error-message").show();
			$(".error-message span").html('Por favor preencha os campos corretamente!');
			return false;
		}

		$.post(
			url + "AdminController/pesquisarEventos",
			{
				nomeEvento: nomeEvento,
				dataHoraEvento: dataHoraEvento,
				dataHoraEventoFinal: dataHoraEventoFinal	
			}, function(retornoPesquisa) {
				retornoPesquisa = $.parseJSON(retornoPesquisa);

				if( retornoPesquisa == null || retornoPesquisa == "" ) {
					$("#tbListaEventos tbody").html('');
					return false;
				}

				$.each(retornoPesquisa, function(index, value) {
					linha = "<tr>";
					linha += "<td>" + value['nomeEvento'] + "</td>";
					linha += "<td>" + value['dataHora'] + "</td>";
					linha += "<td><a id='visualizarEvento_" + value['id_evento'] + "'><span class='glyphicon glyphicon-search'></span></a></td>";
					linha += "<td>" + value['descricaoEvento'] + "</td>";
					linha += "<td>" + value['linkEvento'] + "</td>";
					linha += "<td>" + value['imagemEvento'] + "</td>";
					linha += "</tr>";
					$("#tbListaEventos tbody").append(linha);					

					$("#visualizarEvento_" + value['id_evento']).click( function() {
						limparFormulario();
						campos = $( this ).parent().parent("tr");
						$("#txtEvento").val(campos.find("td:nth-child(1)"));
						$("#txtDescricao").val(campos.find("td:nth-child(4)"));
						$("#txtLinkEvento").val(campos.find("td:nth-child(5)"));
						//$("#txtImagemEvento").val(campos.find("td:nth-child(1)"));
						$("#txtDataHora").val(campos.find("td:nth-child(2)"));
					});
				});

				//Escondendo tds
				$("#tbListaEventos tbody tr td:nth-child(3)").hide();
				$("#tbListaEventos tbody tr td:nth-child(4)").hide();
				$("#tbListaEventos tbody tr td:nth-child(5)").hide();
				//-------------------------------------------------------------------
			}
		);
	});

	function limparFormulario()
	{
		$("#txtEvento").val('');
		$("#txtDescricao").val('');
		$("#txtLinkEvento").val('');
		$("#txtImagemEvento").val('');
		$("#txtDataHora").val('');		
		$(".error-message").hide();
		$(".error-message span").html('');
	}

	function limpaPeriodo()
	{
		$("#txtDataHoraFinal").val('');
		$("#txtDataHoraFinal").parent("div").hide();
		$(".texto-periodo").parent("div").hide();
		$("a.btnAddBuscaPeriodo i").removeClass("fa-caret-square-o-left").addClass('fa-caret-square-o-right');
	}
});