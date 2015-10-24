<link rel="stylesheet" href="<?=base_url('web-files/css/admin/estiloPageAdmin.css')?>">
<link rel="stylesheet" href="<?=base_url('web-files/css/admin/estiloPageReserva.css')?>">
<div class="container-fluid well">
	<div class="col-lg-8 col-md-8 col-sm-9 col-xs-12 col-lg-offset-3 col-md-offset-3 col-sm-offset-3">	
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 titulo">
			<center><h3>Visualizar Reservas</h3></center>
		</div>
		<div class="clearfix"></div>
		<?=( isset($exibeMensagem) ? $exibeMensagem : '' )?>
		<div id="listaReservas" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div id="accordion"></div>
		</div>
	</div>
</div>

<script type="text/javascript" src="<?=base_url('web-files/js/funcoes/telaReserva/exibirReservas.js')?>"></script>

