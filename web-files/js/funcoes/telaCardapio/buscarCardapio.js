var url 	= "/sirp/";
$(document).ready(function() {		
	$( "#txtCardapio" ).keyup(function(event) {
		$.post(
			url + "Cardapio/pesquisarArrayCardapio",
			{
				nomeCardapio: $( this ).val()
			}, function( retornoPesquisa ) {
				retornoPesquisa = $.parseJSON(retornoPesquisa);

				if( retornoPesquisa != null ) {
					$("#txtCardapio").autocomplete({
						minLength: 0, 
						source: retornoPesquisa,
						focus: function( event, ui ) {
					    	$( this ).val( ui.item.label );
					        return false;
					     },
					    select: function( event, ui ) {
					    	$( "#txtCardapio" ).val( ui.item.label );					        					        
					        $( "#imagemCardapio" ).attr( "src", ui.item.imagem );
					        if( ui.item.ativo == true ) {
					        	$( "input[name='rbAtivo'][value='S']" ).attr( "checked", true );	
					        	$( "input[name='rbAtivo'][value='N']" ).attr( "checked", false );
					        } else {
					        	$( "input[name='rbAtivo'][value='S']" ).attr( "checked", false );
					        	$( "input[name='rbAtivo'][value='N']" ).attr( "checked", true );	
					        }			 
					        return false;
					    }
					});
				} else {
					limparDados();
				}
			}
		);

		if( $( "#txtCardapio" ).val().length == 0 ) {
			limparDados();
		}
	});
		

	function limparDados()
	{
		$( "#txtCardapio" ).val( '' );				        					        
        $( "#imagemCardapio" ).attr( "src", url + 'web-files/imagens/stuffs/image-off.jpg' );
        $( "input[name='rbAtivo'][value='S']" ).attr( "checked", true );
        $( "input[name='rbAtivo'][value='N']" ).attr( "checked", false );
        $( "#tbProdutosCardapio tbody").html('');
	}
});