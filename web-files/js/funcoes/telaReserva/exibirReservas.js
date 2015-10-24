var url 		= "/sirp/";
var rodouScript = false;

$(document).ready(function() {
	verificaReservasEmAberto();
	setInterval(
	function() {
		verificaReservasEmAberto();
	}, 30000);


	function verificaReservasEmAberto()
	{
		//Pegar data e hora Atual
		var data 		= new Date();
		var dataHora 	= null;
        dia 			= data.getDate();
        mes 			= data.getMonth() + 1;
        ano 			= data.getFullYear();
        hora 			= ( data.getHours() < 10 ? '0' + data.getHours() : data.getHours() );
        minutos 		= ( data.getMinutes() < 10 ? '0' + (data.getMinutes() - 1) : ( data.getMinutes() - 1 ) );
        segundos 		= ( data.getSeconds() < 10 ? '0' + data.getSeconds() : data.getSeconds() );
    	dataHora = [dia, mes, ano].join('/') + ' ' + [hora, minutos, segundos].join(':');    	
		//--------------------------------------------------------------
		$.ajax({
			method: "POST",
			url: url + "Reservas/pesquisarReservas",
			dataType: 'JSON',
			data: {
				statusReserva: 0,
				rodouScript: rodouScript,
				dataHora: dataHora
			}
		}).done( function( retornoBuscaReservas ) {
				//retornoBuscaReservas = JSON.parse(retornoBuscaReservas);
				
				if( retornoBuscaReservas != "" && retornoBuscaReservas != null && retornoBuscaReservas != undefined ) {
					
					$.each( retornoBuscaReservas, function(indexReserva, dadosReserva) {

						
						if( $(".headerReservaPedido div:nth-child(1) span.hide:contains('" + dadosReserva['id_reserva'] + "')").text().length == 0 ) {

							headerReserva  = "<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>";
								headerReserva += "<div class='headerReservaPedido'>";
									headerReserva += "<div class='col-lg-10 col-md-10 col-sm-10 col-xs-10'><span class='hide'>" + dadosReserva['id_reserva'] + "</span><h3>Nome:  " + dadosReserva['nomeCliente'] + "</h3></div>";
									headerReserva += "<div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><a href='#' id='btnRemoveReserva_" + dadosReserva['id_reserva'] + "'><span class='glyphicon glyphicon-remove'></span></a></div>";
									headerReserva += "<div class='clearfix'></div>";						
									headerReserva += "<div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'><span class='num_mesa'>" + dadosReserva['num_mesa'] + "</span></div>";
									headerReserva += "<div class='col-lg-4 col-md-4 col-sm-4 col-xs-4 col-lg-offset-4 col-md-offset-4 col-sm-offset-4 col-xs-offset-4'><label>Data e Hora:&nbsp;&nbsp;&nbsp;</label>" + dadosReserva['dataHora'] + "</div>";
								headerReserva += "</div>";
								headerReserva += "<div class='clearfix'></div>";													
							if( dadosReserva['id_pedido'] != '' ) {
								headerReserva += "<div class='content-accordion col-lg-8 col-md-8 col-sm-8 col-xs-10 col-lg-offset-1 col-md-offset-1 col-sm-offset-1'>";
									headerReserva += "<table class='table table-striped'>";
								
									arrayPedidos = (dadosReserva['arrayPedidos']);
									if( arrayPedidos != null && arrayPedidos != undefined ) {
										$.each(arrayPedidos, function(indexPedido, dadosPedido) {
											headerReserva += "<tr>";
												headerReserva += "<td>Produto:</td><td>" + dadosPedido['nomeProduto'] + "</td>";
												headerReserva += "<td>Qtd:</td><td>" + dadosPedido['qtd_produto'] + " </td>";
												headerReserva += "<td>Valor:</td><td>" + dadosPedido['valor'] + " </td>";
											headerReserva += "</tr>";										
										});
									}
									headerReserva += "</table>";
								headerReserva += "</div>";
							}				

							headerReserva += "</div>";
							$("#accordion").prepend(headerReserva);
							$(".content-accordion").hide();

							$(".headerReservaPedido").click( function(e) {
								e.preventDefault(event);			
								$( this ).parent().find(".content-accordion").show();
							});

							$("#btnRemoveReserva_" + dadosReserva['id_reserva']).click( function() {
								if( confirm("Deseja cancelar a reserva de " + dadosReserva['nomeCliente'] + " ?") ) {
									$.post(
										url + "Reservas/cancelarReservaCliente",
										{
											id_reserva: dadosReserva['id_reserva']
										}, function( retornoResposta ) {
											retornoResposta = $.parseJSON(retornoResposta);
											if( retornoResposta == true ) {
												$("#btnRemoveReserva_" + dadosReserva['id_reserva']).parent().parent().parent().remove();
											}
										}
									);
								}
							});
						}
					});
				}
			}


		    
		);

		if( rodouScript == false ) {
			rodouScript = true;
		}		
	}
});