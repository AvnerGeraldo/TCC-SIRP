var url 		= "/sirp/";
var rodouScript = false;

$(document).ready(function() {
	setInterval(verificarReservasEmAberto(), 60000);


	function verificarReservasEmAberto()
	{
		//Pegar data e hora Atual
		var data 		= new Date();
		var dataHora 	= null;
        dia 			= data.getDate();
        mes 			= data.getMonth() + 1;
        ano 			= data.getFullYear();
        hora 			= ( data.getHours() < 10 ? '0' + data.getHours() : data.getHours() );
        minutos 		= data.getMinutes();
        segundos 		= data.getSeconds();
    	dataHora = [dia, mes, ano].join('/') + ' ' + [hora, minutos, segundos].join(':');
    	console.log(dataHora);
		//--------------------------------------------------------------
		$.post(
			url + "Reservas/pesquisarReservas",
			{
				statusReserva: 0,
				rodouScript: rodouScript,
				dataHora: dataHora
			}, function( retornoBuscaReservas ) {
				retornoBuscaReservas = $.parseJSON(retornoBuscaReservas);

			}
		);

		if( rodouScript == false ) {
			rodouScript = true;
		}
	}
});