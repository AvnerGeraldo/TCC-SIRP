var url 		= "/sirp/";
var editaMesa 	= null;
$(document).ready( function() {
	$("#btnAddMesa").click( function() {
		numeroMesa 		= parseInt($("#txtNumMesa").val());
		qtdLugarMesa	= parseInt($("#txtQtdLugares").val());
		taxaMesa 		= parseFloat($("#txtTaxaMesa").val());

		if( numeroMesa == "" || numeroMesa == 0 || qtdLugarMesa == 0 || qtdLugarMesa == "" ) {
			$(".error-message").remove();
			$("form[name=\"frmRestauranteMesas\"]").before("<div class=\"alert alert-warning alert-dismissible error-message\" role=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\" >&times;</span></button>Por favor preencha os campos corretamente!</div>");
			return false;
		}

		$.post(
			url + "Restaurante/cadastrarMesa",
			{
				numeroMesa: numeroMesa,
				qtdLugarMesa: qtdLugarMesa,
				taxaMesa: taxaMesa
			}, function( retornoCadastroMesa ) {
				retornoCadastroMesa = $.parseJSON(retornoCadastroMesa);

				if( retornoCadastroMesa != null && retornoCadastroMesa != "" ) {
					boxMesa = "<div class=\"form-group\"> ";
                    boxMesa += "<div class=\"col-lg-2 col-md-2 col-sm-4 col-xs-2\"><label for=\"txtNumMesa\">Nº Mesa</label></div>";
					boxMesa += "<div class=\"col-lg-1 col-md-1 col-sm-1 col-xs-1 col-lg-offset-10 col-md-offset-10 col-sm-offset-10 col-xs-offset-10\"></div>";
                    boxMesa += "<div class=\"col-lg-2 col-md-2 col-sm-3 col-xs-2\">";
					boxMesa += "<span class='info-numeroMesa'>" + numeroMesa + "</span>";
					boxMesa += "</div>";
                    boxMesa += "<div class=\"col-lg-8 col-md-8 col-sm-7 col-xs-8\">";
                    boxMesa += "<div class=\"row\">";
                    boxMesa += "<label for=\"txtQtdLugares\" class=\"col-lg-3 col-md-3 col-sm-5 col-xs-6\">Qtd Lugares:</label>";
                    boxMesa += "<div class=\"col-lg-2 col-md-2 col-sm-4 col-xs-4\">";
                    boxMesa += "<span class='info-qtdLugarMesa'>" + qtdLugarMesa + "</span>";
                    boxMesa += "</div>";
                    boxMesa += "</div>";
                    boxMesa += "<div class=\"row\">";
                    boxMesa += "<label for=\"txtTaxaMesa\" class=\"col-lg-3 col-md-3 col-sm-5 col-xs-6\">Valor Taxa:</label>";
                    boxMesa += "<div class=\"col-lg-3 col-md-3 col-sm-5 col-xs-6\">";
                    boxMesa += "<span class='info-taxaMesa'>" + numeroMesa + "</span>";
                    boxMesa += "</div>";
                    boxMesa += "</div>";
                    boxMesa += "</div>";
                    boxMesa += "<div class=\"col-lg-2 col-md-2 col-sm-2 col-xs-2\">";
                    boxMesa += "<a href=\"#\" onclick=\"editaMesa(this);\"><span class=\"glyphicon glyphicon-pencil\"></span></a>";
                    boxMesa += "</div>";
                    boxMesa += "</div>";
					$("form[name='frmRestauranteMesas'] div.form-group:nth-child(1)").append(boxMesa);
					$("#txtNumMesa").val('');
					$("#txtQtdLugares").val('');
					$("#txtTaxaMesa").val('');
				} else {
					$(".error-message").remove();
					$("form[name=\"frmRestauranteMesas\"]").before("<div class=\"alert alert-warning alert-dismissible error-message\" role=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\" >&times;</span></button>Não foi possível cadastrar Mesa. Por favor verifique os dados!</div>");
					return false;
				}

			}
		);

	});

	editaMesa = function(elemento)
	{

	}
});