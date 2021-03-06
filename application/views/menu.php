<div class="nav-side-menu">
	<div class="brand">
		<div class="img-avatar">
			<img src="<?=( isset($imagemRestaurante) && !empty($imagemRestaurante) ? $imagemRestaurante : base_url('web-files/imagens/login/avatar.png') )?>" width="150" height="100" <?=( isset($imagemRestaurante) && !empty($imagemRestaurante) ? "class=\"img-rounded\"" : "class=\"img-circle\"" ) ?>>
		</div>
		<div class="restaurante-avatar">
			<span><?=ucfirst($nomeRestaurante)?></span>
		</div>
	</div>
	<i class="fa fa-bars fa-3x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>
	<div class="menu-list">
		<ul id="menu-content" class="menu-content collapse out">
			<li>
				<a href="<?=base_url('Reservas')?>">
					<i class="fa fa-calendar-check-o fa-lg"></i> Visualizar Reservas
				</a>
			</li>

			<li>
				<a href="<?=base_url('Eventos')?>">
					<i class="fa fa-gift fa-lg"></i> Cadastrar Eventos
				</a>
			</li>

			<li data-toggle="collapse" data-target="#links-restaurante" class="collapsed">
				<a href="#"><i class="fa fa-suitcase fa-lg"></i> Controlar Restaurante <span class="arrow"></span></a>
			</li>
			<ul class="sub-menu collapse out" id="links-restaurante">
				<li><a href="<?=base_url('Restaurante')?>">Cadastrar Informações</a></li>
				<li><a href="<?=base_url('Funcionarios')?>">Cadastrar Funcionário</a></li>
				<li><a href="<?=base_url('Cardapio')?>">Cadastrar Cardápio</a></li>
				<li><a href="<?=base_url('Produtos')?>">Cadastrar Produtos</a></li>
			</ul>

			<li data-toggle="collapse" data-target="#links-relatorios" class="collapsed">
				<a href="#"><i class="fa fa-bar-chart fa-lg"></i> Relatórios <span class="arrow"></span></a>
			</li>
			<ul class="sub-menu collapse out" id="links-relatorios">
				<li>Preferências por Cliente</li>
				<li>Avaliação do Restaurante(Região)</li>
				<li>Quantidade de Reservas Realizadas(App)</li>
				<li>Quantidade de Pedidos Mais Solicitados</li>
			</ul>

			<li>
				<a href="#" onclick="return logoff();" id="logout-system">
					<i class="fa fa-power-off fa-lg"></i> Logoff
				</a>
			</li>
		</ul>
	</div>
</div>
<script type="text/javascript">
function logoff()
{
	if( confirm("Deseja sair do sistema?") ) {
		window.location.href = "/sirp/Logoff";
	}
}
</script>