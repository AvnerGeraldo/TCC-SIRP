<link rel="stylesheet" href="<?=base_url('web-files/css/admin/estiloPageAdmin.css')?>">
<link rel="stylesheet" href="<?=base_url('web-files/css/admin/estiloPageReserva.css')?>">
<div class="container-fluid well">
	<div class="col-lg-8 col-md-8 col-sm-9 col-xs-12 col-lg-offset-3 col-md-offset-3 col-sm-offset-3">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 titulo">
			<center><h3>Funcionário</h3></center>
		</div>
		<?=( isset($exibeMensagem) ? $exibeMensagem : '' )?>
		<form name="frmFuncionario" method="POST" action="<?=base_url('Funcionario/cadastrar')?>" class="form-horizontal">
			<div class="form-group">
				<label for="txtFuncionario" class="col-lg-2 col-md-2 col-sm-2 col-xs-4">Funcionario:</label>
				<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
					<input type="text" name="txtFuncionario" id="txtFuncionario" placeholder="Escreve aqui o nome do funcionario" class="form-control" required>
				</div>
			</div>
			<div class="form-group">
				<label for="txtLogin" class="col-lg-2 col-md-2 col-sm-2 col-xs-4">Login:</label>
				<div class="col-lg-3 col-md-4 col-sm-4 col-xs-4">
					<input type="text" name="txtLogin" id="txtLogin" maxlength="30" class="form-control" required>
				</div>
			</div>

			<div class="form-group">
				<label for="txtSenha" class="col-lg-2 col-md-2 col-sm-2 col-xs-4">Senha:</label>
				<div class="col-lg-3 col-md-4 col-sm-4 col-xs-4">
					<input type="password" name="txtSenha" id="txtSenha" class="form-control">
				</div>
			</div>
			<div class="form-group">
				<label for="cboNivelAcesso" class="col-lg-2 col-md-2 col-sm-2 col-xs-4">Nível de Acesso:</label>
				<div class="col-lg-3 col-md-4 col-sm-4 col-xs-6">
					<select name="cboNivelAcesso" id="cboNivelAcesso" class="form-control">
						<option value="0">Selecione</option>
						<option value="1">Administrador</option>
						<option value="2">Acesso a Relatorios</option>
						<option value="3">Visualiza Reservas</option>
					</select>
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
		<table id="tbFuncionarios" class="table table-striped">
			<thead>
				<tr>
					<td>Funcionário</td>
					<td>Login</td>
					<td>Nivel de Acesso</td>
					<td></td>
					<td></td>
				</tr>
			</thead>
			<tbody></tbody>
		</table>
	</div>
</div>
<script type="text/javascript" src="<?=base_url('web-files/js/funcoes/telaFuncionario/buscarFuncionario.js')?>"></script>