<link rel="stylesheet" href="<?=base_url('web-files/css/admin/estiloPageAdmin.css')?>">
<link rel="stylesheet" href="<?=base_url('web-files/css/admin/estiloAutoComplete.css')?>">
<div class="container-fluid well">
	<div class="col-lg-8 col-md-8 col-sm-9 col-xs-12 col-lg-offset-3 col-md-offset-3 col-sm-offset-3">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<center><h3>Cardápio</h3></center>
		</div><br><br><br><br>
		<?=( isset($exibeMensagem) ? $exibeMensagem : '' )?>
		<form name="frmProduto"  action="<?=base_url('Cardapio/cadastrar')?>" method="post" enctype="multipart/form-data" class="form-horizontal">

			<div class="form-group">
				<label for="txtCardapio" class="col-lg-2 col-md-2 col-sm-2 col-xs-3">Cardápio:</label>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
					<input type="text" name="txtCardapio" id="txtCardapio" value="<?=( isset($nomeCardapio) ? $nomeCardapio : '' )?>" class="form-control" required>
				</div>
			</div>
			<div class="form-group">
				<label for="txtImagem" class="col-lg-2 col-md-2 col-sm-2 col-xs-3">Imagem:</label>
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
					<input type="file" name="txtImagem" accept="image/png, image/jpeg, image/gif" class="form-control" />
				</div>
				<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
					<img src="<?=( isset($imagemCardapio) && !empty($imagemCardapio) ? $imagemCardapio : base_url('web-files/imagens/stuffs/image-off.jpg'))?>" id="imagemCardapio" alt="<?=( isset($nomeCardapio) ? $nomeCardapio : 'Imagem do Produto' )?>" width="150" height="150" class="img-rounded">
				</div>
				
			</div>

			<div class="form-group">
				<label for="rbAtivo" class="col-lg-1 col-md-1 col-sm-1 col-xs-1">Ativo:</label>
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
					<label class="radio-inline">
						<input type="radio" name="rbAtivo" value='S' <?=( isset($status) && ($status == 'S' ||  empty($status) ) || !isset($status)  ? 'checked' : '')?>>Sim
					</label>
					<label class="radio-inline">
						<input type="radio" name="rbAtivo" value='N' <?=( isset($status) && $status == 'N' ? 'checked' : '')?>>Não
					</label>
				</div>

			<div class="form-group">				
				<div class="col-lg-4 col-md-4 col-sm-6 col-xs-7 col-lg-offset-7 col-md-offset-7  col-sm-offset-7 col-xs-offset-6">					
					<button name="btnCadastrar" type="submit" class="btn btn-success">Cadastrar</button>
				</div>
			</div>
		</form>
		<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 col-lg-offset-8 col-md-offset-8 col-sm-offset-8 col-xs-offset-8">
			<button type="button" name="btnAddProdutoTabela" id="btnAddProdutoTabela" class="btn btn-primary">Adicionar Produto</button>
		</div>
		<table id="tbProdutosCardapio" class="table">
			<thead>
				<tr>
					<td>Imagem Produto</td>
					<td>Produto</td>
					<td>Valor</td>
					<td></td>
				</tr>
			</thead>
			<tbody></tbody>
		</table>
	</div>
</div>
<script type="text/javascript" src="<?=base_url('web-files/js/funcoes/telaCardapio/buscarProdutosCardapio.js')?>"></script>