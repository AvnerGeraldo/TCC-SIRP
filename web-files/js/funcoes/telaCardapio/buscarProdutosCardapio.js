var url 	= "/sirp/";
var removeProdutoCardapio = null;

$(document).ready(function() {
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

						        $.post(
						        	url + "Categoria/pesquisarCategoria",
						        	{
						        		id_categoria:ui.item.categoria
						        	}, function( retornoPesquisaCategoria ) {
						        		retornoPesquisaCategoria = $.parseJSON(retornoPesquisaCategoria);

						        		if( retornoPesquisaCategoria != null ) {
						        			$.each(retornoPesquisaCategoria, function(index, value) {

						        				categoria = value['nomeCategoriaProduto'];
						        				linhaTabela = "<tr>";
										        linhaTabela += "<td><img src='";

										        if( ui.item.imagem == "" ) {
										        	linhaTabela += url + "web-files/imagens/stuffs/image-off.jpg";
										        } else {
										        	linhaTabela += ui.item.imagem;
										        }

						        				linhaTabela += "' witdh='50' height='50' class='img-rounded'></td>";
										        linhaTabela += "<td>" + ui.item.label + "</td>";
										        linhaTabela += "<td>" + ui.item.preco + "</td>";
										        linhaTabela += "<td>" + categoria + "</td>";
										        linhaTabela += "<td><a href='#' id=\"btnRemoveProdutoCardapio_" + ui.item.idProduto + "\"><span class='glyphicon glyphicon-remove'></span></td>";
										        linhaTabela += "</tr>";

										        $("#tbProdutosCardapio tbody").append(linhaTabela);

										       	$("#btnRemoveProdutoCardapio_" + ui.item.idProduto).click( function(event) {
										       		if( ui.item.idProduto != "" ) {
														$.post(
															url + "Produto/removeProduto",
															{
																id_produto:ui.item.idProduto
															}
															function( retornoExclusaoProduto) {
																retornoExclusaoProduto = $.parseJSON(retornoExclusaoProduto);
																if( retornoExclusaoProduto == true ) {						
																	$("#btnRemoveProdutoCardapio_" + ui.item.idProduto).parent().remove();
																} else {
																	$("#btnRemoveProdutoCardapio_" + ui.item.idProduto).parent().addClass('bg-danger');
																}
															}
														);
													}
										       	});												
						        			});
						        		}
						        	}
						        );						        						 
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