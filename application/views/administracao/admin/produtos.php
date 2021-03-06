<?php
	if( isset($dadosProduto) && !empty($dadosProduto) ) {
		extract($dadosProduto);
	}
?>

<link rel="stylesheet" href="<?=base_url('web-files/css/admin/estiloPageAdmin.css')?>">
<link rel="stylesheet" href="<?=base_url('web-files/css/admin/estiloAutoComplete.css')?>">
<link rel="stylesheet" href="<?=base_url('web-files/css/admin/estiloPageReserva.css')?>">
<div class="container-fluid well">
	<div class="col-lg-8 col-md-8 col-sm-9 col-xs-12 col-lg-offset-3 col-md-offset-3 col-sm-offset-3">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 titulo">
			<center><h3>Produto</h3></center>
		</div>
		<div class="clearfix"></div>
		<?=( isset($exibeMensagem) ? $exibeMensagem : '' )?>
		<form name="frmProduto"  action="<?=base_url('Produtos/cadastrar')?>" method="post" enctype="multipart/form-data" class="form-horizontal">

			<div class="form-group">
				<label for="Categoria" class="col-lg-2 col-md-2 col-sm-2 col-xs-3">Categoria:</label>
				<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
					<select name="cboCategoria" class="form-control">
					<option value="0">Selecione...</option>
					<?php
						if( isset($listaCategorias) && !empty($listaCategorias) ) {
							foreach ($listaCategorias as $categoria) {
								echo "<option value='{$categoria['id_categoriaProduto']}'";
								if( isset($id_categoriaProduto) && $categoria['id_categoriaProduto'] == $id_categoriaProduto ) {
									echo " selected ";
								}
								echo ">{$categoria['nomeCategoriaProduto']}</option>";
							}
						}
					?>
					</select>
				</div>
			</div>

			<div class="form-group">
				<label for="txtProduto" class="col-lg-2 col-md-2 col-sm-2 col-xs-3">Produto:</label>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
					<input type="text" name="txtProduto" id="txtProduto" value="<?=( isset($nomeProduto) ? $nomeProduto : '' )?>" class="form-control" required>
				</div>
			</div>
			<div class="form-group">
				<label for="txtImagem" class="col-lg-2 col-md-2 col-sm-2 col-xs-3">Imagem:</label>
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
					<input type="file" name="txtImagem" accept="image/png, image/jpeg, image/gif" class="form-control" />
				</div>
				<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
					<img src="<?=( isset($imagem) && !empty($imagem) ? $imagem : base_url('web-files/imagens/stuffs/image-off.jpg'))?>" id="imagemProduto" alt="<?=( isset($nomeProduto) ? $nomeProduto : 'Imagem do Produto' )?>" width="150" height="150" class="img-rounded">
				</div>
				
			</div>

			<div class="form-group">
				<label for="txtDescricao" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">Descrição:</label>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-lg-offset-2 col-md-offset-2 col-sm-offset-2 col-xs-offset-3">
					<textarea name="txtDescricao" id="txtDescricao" placeholder="Escreva aqui a descrição do evento." class="form-control"><?=( isset($descricaoProduto) && !empty($descricaoProduto) ? ($descricaoProduto) : '' )?></textarea>
				</div>
			</div>

			<div class="form-group">
				<label for="txtPreco" class="col-lg-2 col-md-2 col-sm-2 col-xs-3">Preço:</label>
				<div class="col-lg-3 col-md-3 col-sm-3 col-xs-4">
					<input type="text" name="txtPreco" id="txtPreco"  value="<?=( isset($valor) ? formataValorExibir($valor) : '' )?>"class="form-control" required>
				</div>

				<label for="rbAtivo" class="col-lg-1 col-md-1 col-sm-1 col-xs-1">Ativo:</label>
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
					<label class="radio-inline">
						<input type="radio" name="rbAtivo" value='S' <?=( isset($status) && ($status == 'S' ||  empty($status) ) || !isset($status)  ? 'checked' : '')?>>Sim
					</label>
					<label class="radio-inline">
						<input type="radio" name="rbAtivo" value='N' <?=( isset($status) && $status == 'N' ? 'checked' : '')?>>Não
					</label>
				</div>
			</div>

			<div class="form-group">				
				<div class="col-lg-4 col-md-4 col-sm-6 col-xs-7 col-lg-offset-7 col-md-offset-7  col-sm-offset-7 col-xs-offset-6">					
					<button name="btnCadastrar" type="submit" class="btn btn-success">Cadastrar</button>
				</div>
			</div>
		</form>		
	</div>
</div>
<script type="text/javascript" src="<?=base_url('web-files/js/funcoes/telaProduto/buscarProdutos.js')?>"></script>