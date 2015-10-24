<link rel="stylesheet" href="<?=base_url('web-files/css/admin/estiloPageAdmin.css')?>">
<link rel="stylesheet" href="<?=base_url('web-files/css/admin/estiloPageReserva.css')?>">
<div class="container-fluid well">
	<div class="col-lg-8 col-md-8 col-sm-9 col-xs-12 col-lg-offset-3 col-md-offset-3 col-sm-offset-3">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 titulo">
			<center><h3>Eventos</h3></center>
		</div>
		<div class="clearfix"></div>
		<?=( isset($exibeMensagem) ? $exibeMensagem : '' )?>
		<form name="frmEvento" method="POST" action="<?=base_url('Eventos/cadastrar')?>" enctype="multipart/form-data" class="form-horizontal">
			<div class="form-group">
				<label for="txtEvento" class="col-lg-2 col-md-2 col-sm-2 col-xs-4">Evento:</label>
				<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
					<input type="text" name="txtEvento" id="txtEvento" placeholder="Escreve aqui o evento" class="form-control" required>
				</div>
			</div>
			<div class="form-group">
				<label for="txtDescricao" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">Descrição:</label>
				<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 col-lg-offset-2 col-md-offset-2 col-sm-offset-2 col-xs-offset-4">
					<textarea name="txtDescricao" id="txtDescricao" placeholder="Escreva aqui a descrição do evento." class="form-control"></textarea>
				</div>
			</div>
			<div class="form-group">
				<label for="txtDataHora" class="col-lg-2 col-md-2 col-sm-2 col-xs-4">Data e Hora:</label>
				<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
					<input type="text" name="txtDataHora" id="txtDataHora" class="form-control" required>
				</div>
				<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
					<span class="texto-periodo">a</span>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
					<input type="text" name="txtDataHoraFinal" id="txtDataHoraFinal" class="form-control">
				</div>
				<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
					<a class="btnAddBuscaPeriodo">Buscar por período&nbsp;&nbsp;&nbsp;<i class="fa fa-caret-square-o-right"></i></a>
				</div>				
			</div>
			<div class="form-group">
				<label for="txtLinkEvento" class="col-lg-2 col-md-2 col-sm-2 col-xs-4">Link do Evento:</label>
				<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
					<input type="text" name="txtLinkEvento" id="txtLinkEvento" placeholder="Escreve aqui o evento" class="form-control">
				</div>
			</div>

			<div class="form-group">
				<label for="txtImagemEvento" class="col-lg-2 col-md-2 col-sm-2 col-xs-4">Imagem do Evento:</label>
				<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
					<input type="file" name="txtImagemEvento" id="txtImagemEvento" class="form-control">
				</div>
			</div>

			<div class="form-group col-lg-10 col-md-10 col-sm-10 col-xs-10">				
				<button type="submit" name="btnCadastrar" class="btn btn-success">Cadastrar</button>
				<button type="button" name="btnPesquisar" class="btn btn-primary">Pesquisar</button>
			</div>
		</form>

		<table id="tbListaEventos" class="table table-striped">
			<thead>
				<tr>
					<td>Evento</td>
					<td>Data e Hora</td>
					<td></td>
				</tr>
			</thead>
			<tbody></tbody>
		</table>
	</div>
</div>
<script type="text/javascript" src="<?=base_url('web-files/js/funcoes/telaEventos/buscarEventos.js')?>"></script>