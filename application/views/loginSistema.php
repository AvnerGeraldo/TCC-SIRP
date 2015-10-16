		<link rel="stylesheet" href="<?=base_url('web-files/css/login/estiloLogin.css')?>">
	</head>
	<body>
		<!-- <div class="container-fluid">
			<div class="col-lg-4 col-md-4 col-sm-6 col-xs-8 col-lg-offset-4 col-md-offset-4 col-sm-offset-3 col-xs-offset-2 well">
				<form name="form" method="POST" action="<?=base_url(logar)?>">
					<div class="form-group">
						<label for="txtLogin">Login</label>
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
							<input type="text" name="txtLogin" placeholder="Entre com o seu login" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<label for="txtSenha">Senha</label>
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
							<input type="password" name="txtSenha" placeholder="Entre com sua senha" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<input type="submit" name="btnLogar" value="Entrar" class="btn btn-success">
					</div>
				</form>
			</div>
		</div> -->
		<div class="container">
	        <div class="card card-container">
	            <!-- <img class="profile-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" /> -->
	            <!-- <img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" /> -->
	            <p id="profile-name" class="profile-name-card"></p>
	            <form method="POST" action="<?=base_url('')?>" class="form-signin">
	            	<?php 
	            		if ( isset($errorMessage) && !empty($errorMessage) ) {
	            	?>
	                <div class="alert alert-danger alert-dismissible" role="alert">
					  	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					  	<?=$errorMessage?>
					</div>
					<?php
						}
					?>
	                <input type="text" id="inputText" name="txtLogin" class="form-control" value="<?=( isset($txtLogin) ? $txtLogin : '' )?>" placeholder="Entre com o seu login" required autofocus>	                
	                <input type="password" id="inputPassword" name="txtSenha" class="form-control" value="<?=( isset($txtSenha) ? $txtSenha : '' )?>" placeholder="Entre com sua senha" required>
	                <!-- <div id="remember" class="checkbox">
	                    <label>
	                        <input type="checkbox" value="remember-me"> Recordarme
	                    </label>
	                </div> -->
	                <br>
	                <button class="btn btn-lg btn-success btn-block btn-signin" type="submit">Entrar</button>
	            </form><!-- /form -->
	            <!-- <a href="#" class="forgot-password">
	                Forgot the password?
	            </a> -->
	        </div><!-- /card-container -->
	    </div><!-- /container -->
	</body>
</html>