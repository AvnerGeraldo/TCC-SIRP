var url 	= "/sirp/";
$(document).ready(function() {
	$('#txtPreco').mask("#.##0,00", {reverse: true});

	$("#txtProduto").keyup(function(event) {
		if( $( this ).val() != "" ) {
			$.post(
				url + "Produtos/pesquisarArrayProdutos",
				{
					nomeProduto: $( this ).val()
				}, function( retornoPesquisa ) {
					retornoPesquisa = $.parseJSON(retornoPesquisa);

					if( retornoPesquisa != null ) {
						$("#txtProduto").autocomplete({
							minLength: 0, 
							source: retornoPesquisa,
							focus: function( event, ui ) {
						    	$( this ).val( ui.item.label );
						        return false;
						     },
						    select: function( event, ui ) {
						    	$( "#txtProduto" ).val( ui.item.label );
						        $( "select[name='cboCategoria']" ).val( ui.item.categoria );					        					        
						        $( "#imagemProduto" ).attr( "src", ui.item.imagem );
						        $( "#txtDescricao" ).val( ui.item.descricao );
						        $( "#txtPreco" ).val( ui.item.preco );

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
					}
				}
			);
		} else {
			limparDados();
		}
	});	

	function limparDados()
	{
		$( "#txtProduto" ).val( '' );
        $( "select[name='cboCategoria']" ).val( 0 );					        					        
        $( "#imagemProduto" ).attr( "src", url + 'web-files/imagens/stuffs/image-off.jpg' );
        $( "#txtDescricao" ).val( '' );
        $( "#txtPreco" ).val( '' );
        $( "input[name='rbAtivo'][value='S']" ).attr( "checked", true );
        $( "input[name='rbAtivo'][value='N']" ).attr( "checked", false );

	}
});