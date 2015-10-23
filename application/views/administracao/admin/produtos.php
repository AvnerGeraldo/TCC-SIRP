<link rel="stylesheet" href="<?=base_url('web-files/css/admin/estiloPageAdmin.css')?>">
<div class="container-fluid well">
	<div class="col-lg-8 col-md-8 col-sm-9 col-xs-12 col-lg-offset-3 col-md-offset-3 col-sm-offset-3">		
		<form name="frmProduto" class="form-horizontal">

			<div class="form-group">
				<label for="Categoria" class="col-lg-2 col-md-2 col-sm-2 col-xs-3">Categoria:</label>
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
					<select name="cboCategoria" class="form-control">
					<?php
						if( isset($listaCategorias) && !empty($listaCategorias) ) {
							foreach ($listaCategorias as $categoria) {
								echo "<option value='{$categoria['id_categoriaProduto']}'>{$categoria['nomeCategoriaProduto']}</option>";
							}
						}
					?>
					</select>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 col-lg-offset-3 col-md-offset-3 col-md-offset-3 col-xs-offset-2">
					<form action="<?=base_url('UploadImagem')?>" method="post" enctype="multipart/form-data" id="MyUploadForm">
						<input name="image_file" id="imageInput" type="file" accept="image/png, image/jpeg, image/gif" />
						<input type="submit"  id="submit-btn" value="Upload" />
						<img src="images/ajax-loader.gif" id="loading-img" style="display:none;" alt="Por favor aguarde."/>
					</form>
					<div id="output" class="img-rounded"></div>
					<input type="hidden" name="txtImagem">
				</div>
			</div>

			<div class="form-group">
				<label for="txtProduto" class="col-lg-2 col-md-2 col-sm-2 col-xs-3">Produto:</label>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
					<input type="text" name="txtProduto" id="txtProduto" class="form-control" required>
				</div>
			</div>

			<div class="form-group">
				<label for="txtDescricao" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">Descrição:</label>
				<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 col-lg-offset-2 col-md-offset-2 col-sm-offset-2 col-xs-offset-4">
					<textarea name="txtDescricao" id="txtDescricao" placeholder="Escreva aqui a descrição do evento." class="form-control"></textarea>
				</div>
			</div>

			<div class="form-group">
				<label for="txtPreco" class="col-lg-2 col-md-2 col-sm-2 col-xs-3">Preço:</label>
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
					<input type="text" name="txtPreco" id="txtPreco" class="form-control" required>
				</div>

				<label for="rbAtivo" class="col-lg-2 col-md-2 col-sm-2 col-xs-1">Ativo:</label>
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
					<label class="radio-inline">
						<input type="radio" name="rbAtivo">Sim
					</label>
					<label class="radio-inline">
						<input type="radio" name="rbAtivo">Não
					</label>
				</div>
			</div>

			<div class="form-group">				
				<div class="col-lg-4 col-md-4 col-sm-6 col-xs-7 col-lg-offset-6 col-md-offset-6  col-sm-offset-6 col-xs-offset-5">
					<button name="btnPesquisar" type="button" class="btn btn-primary">Pesquisar</button>
					<button name="btnCadastrar" type="submit" class="btn btn-success">Cadastrar</button>
				</div>
			</div>
		</form>
		<div class="clearfix"></div>
		<table id="tbProdutos" class="table">
			<thead>
				<tr>
					<td></td><!--Foto-->
					<td>Produto</td>
					<td>Preço</td>
					<td>Categoria</td>
					<td></td>
					<td></td>
				</tr>
			</thead>
			<tbody></tbody>
		</table>
	</div>
</div>
<script type="text/javascript" src="<?=base_url('web-files/js/funcoes/telaFuncionario/buscarProduto.js')?>"></script>