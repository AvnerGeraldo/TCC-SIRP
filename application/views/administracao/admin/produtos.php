<link rel="stylesheet" href="<?=base_url('web-files/css/admin/estiloPageAdmin.css')?>">
<div class="container-fluid well">
	<div class="col-lg-8 col-md-8 col-sm-9 col-xs-12 col-lg-offset-3 col-md-offset-3 col-sm-offset-3">		
		<form name="frmProduto"  action="<?=base_url('Produtos/cadastrar')?>" method="post" enctype="multipart/form-data" class="form-horizontal">

			<div class="form-group">
				<label for="Categoria" class="col-lg-2 col-md-2 col-sm-2 col-xs-3">Categoria:</label>
				<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
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
			</div>

			<div class="form-group">
				<label for="txtProduto" class="col-lg-2 col-md-2 col-sm-2 col-xs-3">Produto:</label>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
					<input type="text" name="txtProduto" id="txtProduto" class="form-control" required>
				</div>
			</div>
			<div class="form-group">
				<label for="txtImagem" class="col-lg-2 col-md-2 col-sm-2 col-xs-3">Imagem:</label>
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
					<input type="file" name="txtImagem" accept="image/png, image/jpeg, image/gif" class="form-control" />
				</div>
				<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
					<img src="#" alt="<?=( isset($nomeProduto) ? $nomeProduto : 'Imagem do Produto' )?>" width="150" height="150" class="img-rounded">
				</div>
				
			</div>

			<div class="form-group">
				<label for="txtDescricao" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">Descrição:</label>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-lg-offset-2 col-md-offset-2 col-sm-offset-2 col-xs-offset-3">
					<textarea name="txtDescricao" id="txtDescricao" placeholder="Escreva aqui a descrição do evento." class="form-control"></textarea>
				</div>
			</div>

			<div class="form-group">
				<label for="txtPreco" class="col-lg-2 col-md-2 col-sm-2 col-xs-3">Preço:</label>
				<div class="col-lg-3 col-md-3 col-sm-3 col-xs-4">
					<input type="text" name="txtPreco" id="txtPreco" class="form-control" required>
				</div>

				<label for="rbAtivo" class="col-lg-1 col-md-1 col-sm-1 col-xs-1">Ativo:</label>
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
<script type="text/javascript" src="<?=base_url('web-files/lib/form-master/jquery.form.js')?>"></script>
<script type="text/javascript">
	$(document).ready(function() { 
	    var options = { 
            target:   '#output',   // target element(s) to be updated with server response 
            beforeSubmit:  beforeSubmit,  // pre-submit callback 
            resetForm: true        // reset the form after successful submit 
        }; 
	        
	     $('#MyUploadForm').submit(function() { 
            $(this).ajaxSubmit(options);  //Ajax Submit form            
            // return false to prevent standard browser submit and page navigation 
            return false; 
        });

	 });


    //function to check file size before uploading.
	function beforeSubmit(){
	    //check whether browser fully supports all File API
	   if (window.File && window.FileReader && window.FileList && window.Blob)
	    {
	        
	        if( !$('#imageInput').val()) //check empty input filed
	        {
	            $("#output").html("Are you kidding me?");
	            return false
	        }
	        
	        var fsize = $('#imageInput')[0].files[0].size; //get file size
	        var ftype = $('#imageInput')[0].files[0].type; // get file type
	        

	        //allow only valid image file types 
	        switch(ftype)
	        {
	            case 'image/png': case 'image/gif': case 'image/jpeg': case 'image/pjpeg':
	                break;
	            default:
	                $("#output").html("<b>"+ftype+"</b> Tipo de arquivo não suportado!");
	                return false
	        }
	        
	        //Allowed file size is less than 1 MB (1048576)
	        if(fsize>5048576) 
	        {
	            $("#output").html("<b>"+fsize +"</b> Imagem muito grande! Por favor insira uma imagem de tamanho menor que 5MB.");
	            return false
	        }
	                
	        $('#submit-btn').hide(); //hide submit button
	        $('#loading-img').show(); //hide submit button
	        $("#output").html("");  
	    }
	    else
	    {
	        //Output error to older browsers that do not support HTML5 File API
	        $("#output").html("Por favor acesse através de outro navegador, pois este navegador falta plugins!");
	        return false;
	    }
	}
</script>