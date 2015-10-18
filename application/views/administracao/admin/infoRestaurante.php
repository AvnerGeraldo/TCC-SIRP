<link rel="stylesheet" href="<?=base_url('web-files/css/admin/estiloPageAdmin.css')?>">
<link rel="stylesheet" href="<?=base_url('web-files/css/admin/estiloPageInfoRestaurante.css')?>">
<div class="container-fluid well">
    <div class="col-lg-8 col-md-8 col-sm-9 col-xs-12 col-lg-offset-3 col-md-offset-3 col-sm-offset-3">
        <div class="panel with-nav-tabs panel-primary">
            <div class="panel-heading">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tabInfoRestaurante" data-toggle="tab">Restaurante</a></li>
                        <li><a href="#tabInfoEndereco" data-toggle="tab">Endereço</a></li>
                        <li><a href="#tabInfoMesas" data-toggle="tab">Mesas</a></li>
                        <!-- <li class="dropdown">
                            <a href="#" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#tab4primary" data-toggle="tab">Primary 4</a></li>
                                <li><a href="#tab5primary" data-toggle="tab">Primary 5</a></li>
                            </ul>
                        </li> -->
                    </ul>
            </div>
            <div class="panel-body">
                <div class="tab-content">                    
                    <?=( isset($exibeMensagem) ? $exibeMensagem : '')?>
                    <div class="tab-pane fade in active" id="tabInfoRestaurante">
                        <form name="frmRestauranteInfo" method="POST" action="<?=base_url('Restaurante/cadastrar')?>" enctype="multipart/form-data" class="form-horizontal">
                            <div class="form-group">
                                <label for="txtCNPJ" class="col-lg-2 col-md-2 col-sm-2 col-xs-4 col-lg-offset-1 col-md-offset-1 col-sm-offset-1 col-xs-offset-1">CNPJ:</label>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4">
                                    <input type="text" name="txtCNPJ" id="txtCNPJ" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="txtNomeRestaurante" class="col-lg-2 col-md-2 col-sm-2 col-xs-4 col-lg-offset-1 col-md-offset-1 col-sm-offset-1 col-xs-offset-1">Restaurante:</label>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7">
                                    <input type="text" name="txtNomeRestaurante" id="txtNomeRestaurante" placeholder="Escreva aqui o nome do restaurante" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="txtNomeFantasia" class="col-lg-2 col-md-2 col-sm-2 col-xs-4 col-lg-offset-1 col-md-offset-1 col-sm-offset-1 col-xs-offset-1">Nome Fantasia:</label>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7">
                                    <input type="text" name="txtNomeFantasia" id="txtNomeFantasia" placeholder="Escreva aqui o nome fantasia do restaurante" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="txtDescricao" class="col-lg-8 col-md-8 col-sm-8 col-xs-8 col-lg-offset-3 col-md-offset-3 col-sm-offset-3 col-xs-offset-1">Descrição:</label>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7 col-lg-offset-3 col-md-offset-3 col-sm-offset-3 col-xs-offset-5">
                                    <textarea name="txtDescricao" id="txtDescricao" placeholder="Escreva aqui a descrição do evento." class="form-control"></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="txtTelefone" class="col-lg-2 col-md-2 col-sm-2 col-xs-3 col-lg-offset-1 col-md-offset-1 col-sm-offset-1 col-xs-offset-1">Telefone:</label>
                                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-4">
                                    <input type="text" name="txtTelefone1" id="txtTelefone1" class="form-control">
                                </div>
                                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                                    ou
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-4 col-lg-offset-0 col-md-offset-0 col-sm-offset-0 col-xs-offset-4">
                                    <input type="text" name="txtTelefone2" id="txtTelefone2" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="txtHorarioFuncionamento" class="col-lg-2 col-md-2 col-sm-2 col-xs-3 col-lg-offset-1 col-md-offset-1 col-sm-offset-1 col-xs-offset-1">Horário de Funcionamento:</label>
                                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-4">
                                    <input type="text" name="txtHorarioFuncionamentoInicial" id="txtHorarioFuncionamentoInicial" class="form-control">
                                </div>
                                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                                    a
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-4 col-lg-offset-0 col-md-offset-0 col-sm-offset-0 col-xs-offset-4">
                                    <input type="text" name="txtHorarioFuncionamentoFinal" id="txtHorarioFuncionamentoFinal" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="txtImagemRestaurante" class="col-lg-11 col-md-11 col-sm-11 col-xs-11 col-lg-offset-1 col-md-offset-1 col-sm-offset-1 col-xs-offset-1">Imagens:</label>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 col-lg-offset-3 col-md-offset-3 col-sm-offset-3 col-xs-offset-4">
                                    <div class="input-group image-preview1">
                                        <input type="text" class="form-control image-preview-filename1" disabled="disabled"> <!-- don't give a name === doesn't send on POST/GET -->
                                        <span class="input-group-btn">
                                            <!-- image-preview-clear button -->
                                            <button type="button" class="btn btn-default image-preview-clear1" style="display:none;">
                                                <span class="glyphicon glyphicon-remove"></span> Clear
                                            </button>
                                            <!-- image-preview-input -->
                                            <div class="btn btn-default image-preview-input1">
                                                <span class="glyphicon glyphicon-folder-open"></span>
                                                <span class="image-preview-input-title1">Browse</span>
                                                <input type="file" accept="image/png, image/jpeg, image/gif" name="txtImagemRestaurante[]"/> <!-- rename it -->
                                            </div>
                                        </span>
                                    </div>
                                    <div class="input-group image-preview2">
                                        <input type="text" class="form-control image-preview-filename2" disabled="disabled"> <!-- don't give a name === doesn't send on POST/GET -->
                                        <span class="input-group-btn">
                                            <!-- image-preview-clear button -->
                                            <button type="button" class="btn btn-default image-preview-clear2" style="display:none;">
                                                <span class="glyphicon glyphicon-remove"></span> Clear
                                            </button>
                                            <!-- image-preview-input -->
                                            <div class="btn btn-default image-preview-input2">
                                                <span class="glyphicon glyphicon-folder-open"></span>
                                                <span class="image-preview-input-title2">Browse</span>
                                                <input type="file" accept="image/png, image/jpeg, image/gif" name="txtImagemRestaurante[]"/> <!-- rename it -->
                                            </div>
                                        </span>
                                    </div>
                                    <div class="input-group image-preview3">
                                        <input type="text" class="form-control image-preview-filename3" disabled="disabled"> <!-- don't give a name === doesn't send on POST/GET -->
                                        <span class="input-group-btn">
                                            <!-- image-preview-clear button -->
                                            <button type="button" class="btn btn-default image-preview-clear3" style="display:none;">
                                                <span class="glyphicon glyphicon-remove"></span> Clear
                                            </button>
                                            <!-- image-preview-input -->
                                            <div class="btn btn-default image-preview-input3">
                                                <span class="glyphicon glyphicon-folder-open"></span>
                                                <span class="image-preview-input-title3">Browse</span>
                                                <input type="file" accept="image/png, image/jpeg, image/gif" name="txtImagemRestaurante[]"/> <!-- rename it -->
                                            </div>
                                        </span>
                                    </div>
                                    <div class="input-group image-preview4">
                                        <input type="text" class="form-control image-preview-filename4" disabled="disabled"> <!-- don't give a name === doesn't send on POST/GET -->
                                        <span class="input-group-btn">
                                            <!-- image-preview-clear button -->
                                            <button type="button" class="btn btn-default image-preview-clear4" style="display:none;">
                                                <span class="glyphicon glyphicon-remove"></span> Clear
                                            </button>
                                            <!-- image-preview-input -->
                                            <div class="btn btn-default image-preview-input4">
                                                <span class="glyphicon glyphicon-folder-open"></span>
                                                <span class="image-preview-input-title4">Browse</span>
                                                <input type="file" accept="image/png, image/jpeg, image/gif" name="txtImagemRestaurante[]"/> <!-- rename it -->
                                            </div>
                                        </span>
                                    </div>
                                    <div class="input-group image-preview5">
                                        <input type="text" class="form-control image-preview-filename5" disabled="disabled"> <!-- don't give a name === doesn't send on POST/GET -->
                                        <span class="input-group-btn">
                                            <!-- image-preview-clear button -->
                                            <button type="button" class="btn btn-default image-preview-clear5" style="display:none;">
                                                <span class="glyphicon glyphicon-remove"></span> Clear
                                            </button>
                                            <!-- image-preview-input -->
                                            <div class="btn btn-default image-preview-input5">
                                                <span class="glyphicon glyphicon-folder-open"></span>
                                                <span class="image-preview-input-title5">Browse</span>
                                                <input type="file" accept="image/png, image/jpeg, image/gif" name="txtImagemRestaurante[]"/> <!-- rename it -->
                                            </div>
                                        </span>
                                    </div>                                  
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="btnCadastraInfoRestaurante" class="btn btn-success">Cadastrar Restaurante</button>
                            </div>
                        </form>                       
                    </div>
                    <div class="tab-pane fade" id="tabInfoEndereco">
                        <form name="frmRestauranteEndereco" method="POST" action="<?=base_url('Restaurante/cadastrar')?>" class="form-horizontal">
                            <div class="form-group">
                                <label for="txtLogradouro" class="col-lg-2 col-md-2 col-sm-2 col-xs-3 col-lg-offset-1 col-md-offset-1 col-sm-offset-1 col-xs-offset-1">Logradouro:</label>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7">
                                    <input type="text" name="txtLogradouro" id="txtLogradouro" placeholder="Escreva aqui o endereço do restaurante" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="txtComplemento" class="col-lg-2 col-md-2 col-sm-2 col-xs-3 col-lg-offset-1 col-md-offset-1 col-sm-offset-1 col-xs-offset-1">Complemento:</label>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7">
                                    <input type="text" name="txtComplemento" id="txtComplemento" placeholder="Escreva aqui o complemento do endereço" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="txtBairro" class="col-lg-2 col-md-2 col-sm-2 col-xs-3 col-lg-offset-1 col-md-offset-1 col-sm-offset-1 col-xs-offset-1">Bairro:</label>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-7">
                                    <input type="text" name="txtBairro" id="txtBairro" placeholder="Escreva aqui o bairro" class="form-control">
                                </div>
                                <label for="txtCep" class="col-lg-1 col-md-1 col-sm-1 col-xs-3 col-lg-offset-0 col-md-offset-0 col-sm-offset-0 col-xs-offset-1">Cep:</label>
                                <div class="col-lg-2 col-md-2 col-sm-3 col-xs-4">
                                    <input type="text" name="txtCep" id="txtCep" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="txtCidade" class="col-lg-2 col-md-2 col-sm-2 col-xs-3 col-lg-offset-1 col-md-offset-1 col-sm-offset-1 col-xs-offset-1">Cidade:</label>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-7">
                                    <input type="text" name="txtCidade" id="txtCidade" placeholder="Escreva aqui a cidade" class="form-control">
                                </div>

                                <label for="cboEstado" class="col-lg-1 col-md-1 col-sm-1 col-xs-3 col-lg-offset-0 col-md-offset-0 col-sm-offset-0 col-xs-offset-1">UF:</label>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4">
                                    <select name="cboEstado" id="cboEstado"class="form-control">
                                        <option value="">Selecione</option>
                                        <option value="AC">Acre</option>
                                        <option value="AL">Alagoas</option>
                                        <option value="AP">Amapá</option>
                                        <option value="AM">Amazonas</option>
                                        <option value="BA">Bahia</option>
                                        <option value="CE">Ceará</option>
                                        <option value="DF">Distrito Federal</option>
                                        <option value="ES">Espirito Santo</option>
                                        <option value="GO">Goiás</option>
                                        <option value="MA">Maranhão</option>
                                        <option value="MS">Mato Grosso do Sul</option>
                                        <option value="MT">Mato Grosso</option>
                                        <option value="MG">Minas Gerais</option>
                                        <option value="PA">Pará</option>
                                        <option value="PB">Paraíba</option>
                                        <option value="PR">Paraná</option>
                                        <option value="PE">Pernambuco</option>
                                        <option value="PI">Piauí</option>
                                        <option value="RJ">Rio de Janeiro</option>
                                        <option value="RN">Rio Grande do Norte</option>
                                        <option value="RS">Rio Grande do Sul</option>
                                        <option value="RO">Rondônia</option>
                                        <option value="RR">Roraima</option>
                                        <option value="SC">Santa Catarina</option>
                                        <option value="SP">São Paulo</option>
                                        <option value="SE">Sergipe</option>
                                        <option value="TO">Tocantins</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="btnCadastraInfoRestaurante" class="btn btn-success">Cadastrar Endereço</button>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="tabInfoMesas">
                        <form name="frmRestauranteMesas" class="form-horizontal">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-2"><label for="txtNumMesa">Nº Mesa</label></div>
                                    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 col-lg-offset-10 col-md-offset-10 col-sm-offset-10 col-xs-offset-10"></div>
                                    <div class="col-lg-2 col-md-2 col-sm-3 col-xs-2">
                                        <input type="text" name="txtNumMesa" id="txtNumMesa" class="form-control">
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-sm-7 col-xs-8">
                                        <div class="row">
                                            <label for="txtQtdLugares" class="col-lg-3 col-md-3 col-sm-5 col-xs-6">Qtd Lugares:</label>
                                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
                                                <input type="text" name="txtQtdLugares" id="txtQtdLugares" class="form-control">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label for="txtTaxaMesa" class="col-lg-3 col-md-3 col-sm-5 col-xs-6">Valor Taxa:</label>
                                            <div class="col-lg-3 col-md-3 col-sm-5 col-xs-6">
                                                <input type="text" name="txtTaxaMesa" id="txtTaxaMesa" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                        <a href="#" id="btnAddMesa"><span class="glyphicon glyphicon-plus"></span></a>
                                    </div>
                                </div>                                
                            </div>
                        </form>
                    </div>                    
                </div>                
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?=base_url('web-files/js/funcoes/telaRestaurante/viewImagensUpload.js')?>"></script>
<script type="text/javascript" src="<?=base_url('web-files/js/funcoes/telaRestaurante/infoRestaurante.js')?>"></script>
<script type="text/javascript" src="<?=base_url('web-files/js/funcoes/telaRestaurante/adicionarMesas.js')?>"></script>