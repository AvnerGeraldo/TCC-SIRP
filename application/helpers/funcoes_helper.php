<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function alertMessage($texto,$redirecionar = null,$back = 'N',$fechar_janela = 'N') {
    header("Content-Type: text/html; charset=utf-8");
    $imprimir = "<script type='text/javascript'>alert(\"{$texto}\");";
    if ($redirecionar != null) {
        $imprimir .= "setTimeout(location.href=\"" . $redirecionar . "\",1000);";
    }
    if ($redirecionar == null && $back == 'S') {
        $imprimir .= "window.history.back(-1);";
    }
    if($fechar_janela == 'S') {
        $imprimir .= "window.close();";
    }
    $imprimir .= "</script>";
    print($imprimir);
}

function formataValorBanco($valor) {
    
    if(empty($valor)) {
        $valor = "0.00";
    } else {
        if(strpos($valor, ".") > 0 && strpos($valor, ",") > 0) {
            $valor = str_replace(",", ".", str_replace(".", "", $valor));
        } elseif(strpos($valor, ",") > 0) {
            $valor = str_replace(",", ".", $valor);
        }    

        $arrayValor = explode(".", $valor);
   
        if(isset($arrayValor[1])) {
            $arrayValor[1]  = SUBSTR($arrayValor[1], 0, 2);
            $valor = $arrayValor[0].".".$arrayValor[1];
        }

        
        $valor = number_format($valor,2,".", ""); 
    }

    
    return $valor;
}

function formataValorExibir($valor) { 
    $valor = formataValorBanco($valor);
    $arrayValor = explode(".", $valor);
    
    if(isset($arrayValor[1])) {
        $arrayValor[1]  = SUBSTR($arrayValor[1], 0, 2);
        $valor = $arrayValor[0].".".$arrayValor[1];
    } 

    if(strpos($valor, ".") > 0 && strpos($valor, ",") > 0) {
        $valor = str_replace(",", ".", str_replace(".", "", $valor));
    }

    return number_format($valor,2,",", "."); 
}

function formataDataBanco($data,$comHora = 'N') 
{    
    if (strpos($data, "-")) {
        $data = explode("-",$data);  

        if($comHora == 'S')  {
            $data_auxiliar = substr($data[2], 0, 2);            
            $data[3] = substr($data[2], 2, 9);
            $data[3] = (empty(trim($data[3])) ? '00:00:00' : $data[3]);
            $data[2] = $data_auxiliar;

        } else {
            if(strlen($data[2]) > 2) {
                $data[2] = substr($data[2], 0, 2);
            } 
        }        
        return "{$data[0]}-{$data[1]}-{$data[2]}".($comHora != 'N' ? " {$data[3]}" : "");        
          
    } elseif (strpos($data, "/")) {
        $data = explode("/",$data);

        if($comHora == 'S')  {
            $data_auxiliar = substr($data[2], 0, 4);            
            $data[3] = substr($data[2], 4, 9);
            $data[3] = (empty(trim($data[3])) ? '00:00:00' : $data[3]);
            $data[2] = $data_auxiliar;

        } else {
            if(strlen($data[2]) > 4) {
                $data[2] = substr($data[2], 0, 4);
            } 
        }        
        return "{$data[2]}-{$data[1]}-{$data[0]}".($comHora != 'N' ? " {$data[3]}" : "");
    }
}

function formataDataExibir($data,$comHora = 'N') {
    if (strstr($data,"/")) {
        return $data;
    } else {
        
        $data = explode("-",$data);  
        if($comHora == 'S')  {
            $data_auxiliar = substr($data[2], 0, 2);            
            $data[3] = substr($data[2], 2, 9);
            $data[2] = $data_auxiliar;

        } else {
            if(strlen($data[2]) > 2) {
                $data[2] = substr($data[2], 0, 2);
            } 
        }        
        return "{$data[2]}/{$data[1]}/{$data[0]}".($comHora != 'N' ? " {$data[3]}" : "");
    }
}

function tiraAcento($texto) {
    $r = iconv("ISO-8859-1", "ASCII//TRANSLIT", $texto);   
    $r = str_replace(array('"', "'", '~', '^', '&', '?', '$', '.', ','), '', $r);
    return $r;
}

function retiraAcentos($texto) 
{
    return preg_replace( '/[`^~\'"]/', null, iconv( 'UTF-8', 'ASCII//TRANSLIT', $texto ) );
    /*$map = array(
    'á' => 'a',
    'à' => 'a',
    'ã' => 'a',
    'â' => 'a',
    'é' => 'e',
    'ê' => 'e',
    'í' => 'i',
    'ó' => 'o',
    'ô' => 'o',
    'õ' => 'o',
    'ú' => 'u',
    'ü' => 'u',
    'ç' => 'c',
    'Á' => 'A',
    'À' => 'A',
    'Ã' => 'A',
    'Â' => 'A',
    'É' => 'E',
    'Ê' => 'E',
    'Í' => 'I',
    'Ó' => 'O',
    'Ô' => 'O',
    'Õ' => 'O',
    'Ú' => 'U',
    'Ü' => 'U',
    'Ç' => 'C'
);
 
echo strtr($str, $map);*/
}

function retiraCaracteresHTML($texto)
{
    $texto = str_replace('\n', '', str_replace('\t', '',  str_replace('\r', '',  str_replace('\a', '', str_replace('\u', '',$texto)))));    
    return $texto;
}

function calculaIdade($dtNascimento) {
    $dtNascimento = formataDataExibir($dtNascimento);
    $dtNascimento = explode("/", $dtNascimento);   

    $idade = (date("Y") - $dtNascimento[2]);
    if (date("m") < ((int) $dtNascimento[1])) {
        $idade--;
    } elseif (date("m") == ((int) $dtNascimento[1])) {
        if (date("d") < ((int) $dtNascimento[0])) {
            $idade--;
        }
    }
    return $idade;
}

function mask($mascara, $string) {
    $tamanho_mascara = strlen(str_replace(" ", "", str_replace(".","",str_replace(",","",str_replace("/","",str_replace("-","",str_replace('(','',str_replace(')','',$mascara))))))));
    /*
    if ($mascara == "(##)####-####") {
        $string = (substr($string, 0,1) == "0" ? substr($string, 1,strlen($string)) : $string);
    }
    */
    $string = str_replace(" ", "", str_replace(".","",str_replace(",","",str_replace("/","",str_replace("-","",$string)))));
    $string = substr($string, 0,$tamanho_mascara);
    for ($i = 0; $i < strlen($string); $i++) {
       $mascara[strpos($mascara, "#")] = $string[$i];
    }
    
    $mascara = str_replace("#", "", $mascara);    
    return $mascara;
}

function retiraCaracteres($texto)
{
    return str_replace("#", "", str_replace(" ", "", str_replace(".","",str_replace(",","",str_replace("/","",str_replace("-","",str_replace('(','',str_replace(')','',str_replace("'","", str_replace("\ ", "", $texto))))))))));
}


function isDate($data) {
    $divisao = (strpos($data,"/") !== FALSE ? "/" : "-");
    $data_array = explode($divisao,$data);
    if (count($data_array) != 3) {
        return FALSE;
    } else {
        if (checkdate($data_array[1], $data_array[0], $data_array[2])) {
            return TRUE;
        }
    }
    return FALSE;
}

function textoFormatado($texto) {
        return iconv('ISO-8859-1', 'UTF-8',$texto);
    }

function ultimo_diaMes($mes)
{
    $ano = date("Y");
    return date("t", mktime(0,0,0,$mes,'01',$ano));
}

function valorPorExtenso($valor=0, $complemento=true) {
    $singular = array("centavo", "real", "mil", "milhão", "bilhão", "trilhão", "quatrilhão");
    $plural = array("centavos", "reais", "mil", "milhões", "bilhões", "trilhões","quatrilhões");
 
    $c = array("", "cem", "duzentos", "trezentos", "quatrocentos","quinhentos", "seiscentos", "setecentos", "oitocentos", "novecentos");
    $d = array("", "dez", "vinte", "trinta", "quarenta", "cinquenta","sessenta", "setenta", "oitenta", "noventa");
    $d10 = array("dez", "onze", "doze", "treze", "quatorze", "quinze","dezesseis", "dezesete", "dezoito", "dezenove");
    $u = array("", "um", "dois", "três", "quatro", "cinco", "seis","sete", "oito", "nove");
 
    $z=0;
 
    $valor = number_format($valor, 2, ".", ".");
    $inteiro = explode(".", $valor);
    for($i=0;$i<count($inteiro);$i++)
        for($ii=strlen($inteiro[$i]);$ii<3;$ii++)
            $inteiro[$i] = "0".$inteiro[$i];
 
    // $fim identifica onde que deve se dar junção de centenas por "e" ou por "," ;) 
    $fim = count($inteiro) - ($inteiro[count($inteiro)-1] > 0 ? 1 : 2);
    for ($i=0;$i<count($inteiro);$i++) {
        $valor = $inteiro[$i];
        $rc = (($valor > 100) && ($valor < 200)) ? "cento" : $c[$valor[0]];
        $rd = ($valor[1] < 2) ? "" : $d[$valor[1]];
        $ru = ($valor > 0) ? (($valor[1] == 1) ? $d10[$valor[2]] : $u[$valor[2]]) : "";
    
        $r = $rc.(($rc && ($rd || $ru)) ? " e " : "").$rd.(($rd && $ru) ? " e " : "").$ru;
        $t = count($inteiro)-1-$i;
        if ($complemento == true) {
            $r .= $r ? " ".($valor > 1 ? $plural[$t] : $singular[$t]) : "";
            if ($valor == "000")$z++; elseif ($z > 0) $z--;
            if (($t==1) && ($z>0) && ($inteiro[0] > 0)) $r .= (($z>1) ? " de " : "").$plural[$t]; 
        }
        if ($r) $rt = $rt . ((($i > 0) && ($i <= $fim) && ($inteiro[0] > 0) && ($z < 1)) ? ( ($i < $fim) ? ", " : " e ") : " ") . $r;
    }
 
    return($rt ? $rt : "zero");
}

function uploadArquivo($arquivo, $diretorio, $arrayTiposAceitos = null, $max_upload_size = 10000)
{    
    if(empty($arrayTiposAceitos)){
        $arrayTiposAceitos = array('image/png', 'image/jpeg', 'image/jpg', 'image/x-png', 'application/pdf', 'text/plain');
    }    
    $resultado = "falha ao dar upload de arquivo.";
    $extensao = explode(".", $arquivo['name']);
    $extensao = strtolower(end($extensao));        
    if (!empty($arquivo['error'])) {
        switch ($arquivo['error']) {
            case '1':
                $resultado = "O arquivo excedeu o tamanho máximo permitido pelas configurações do servidor";
                break;
            case '2':
                $resultado = "O arquivo excedeu o tamanho máximo permitido pelas configurações do formulário";
                break;
            case '3':
                $resultado = "O arquivo foi parcialmente upado (incompleto). Upe completamente";
                break;
            case '4':
                $resultado = "Nenhum arquivo para upar";
                break;
            case '6':
                $resultado = "Faltando uma pasta temporária";
                break;
            case '7':
                $resultado = "Falha ao escrever o arquivo no disco";
                break;
            case '8':
                $resultado = "Arquivo com extensão aceita";
                break;
            default :
                $resultado = "Houve um erro desconhecido. Tente novamente";
        }            
    } elseif (!is_uploaded_file($arquivo['tmp_name'])) {        
        $resultado = "Erro ao dar upload de arquivo.";
    } elseif (!in_array($arquivo['type'], $arrayTiposAceitos)) {

        $resultado = "O arquivo deve ser uma arquivo ". implode(",", $arrayTiposAceitos);        
    } elseif (filesize($arquivo['tmp_name']) > ($max_upload_size * 1024)) {
        $resultado = "arquivo muito grande.";        
    } else {
        $nome = $arquivo['name']; 
        //Move o arquivo que antes era temporário para a pasta correta.        
        if (!is_dir($diretorio)) {
            umask(0777);
            mkdir($diretorio);
            chmod($diretorio, 0777);
        }        
        if (move_uploaded_file($arquivo['tmp_name'], "{$diretorio}/{$nome}")) {
            $resultado = "";                
        } else {
            $resultado = "Erro ao mover o arquivo para a pasta";
        }        
    }
    return $resultado;
}

function mascaraTelefone($telefone)
{
    $telefone   = strtolower(retiraCaracteres($telefone));
    $tamanhoTel = strlen($telefone);
    if($telefone == "nãopossui" || $telefone == "naopossui") {
        return "NÃO POSSUI";
    } elseif($tamanhoTel == 8) {
        return mask("####-####", $telefone);
    } elseif($tamanhoTel == 9) {
        return mask("#####-####", $telefone);
    } elseif($tamanhoTel == 10) {
        return mask("(##)####-####", $telefone);
    } elseif($tamanhoTel == 11) {
        return mask("(##)#####-####", $telefone);
    } else {
        return $telefone;
    }
}

function buscaAcentosCaracteres($dados)
{    
    $erro   = 0;
    $arrayAcentosCaracteres = array( "á", "à", "â", "ã", "ä", "é", "è", "ê", "ë", "í", "ì", "î", "ï", "ó", "ò", "ô", "õ", "ö", "ú", "ù", "û", "ü", "ç" , "Á", "À", "Â", "Ã", "Ä", "É", "È", "Ê", "Ë", "Í", "Ì", "Î", "Ï", "Ó", "Ò", "Ô", "Õ", "Ö", "Ú", "Ù", "Û", "Ü", "Ç", "'", "`", "´", "$", "%", "&", "*", "¨", "!", '"' ); 
    if(is_array($dados)) {
        foreach ($dados as $texto) {            
            foreach ($arrayAcentosCaracteres as $caracteres) {                
                if(strpos($texto, $caracteres) > 0) {
                    $erro++;
                }
            }
            
        }
    } else {
        foreach ($arrayAcentosCaracteres as $caracteres) {
            if(strpos($texto, $caracteres) > 0) {
                $erro++;
            }
        }
    }
    
    if($erro > 0) {
        return TRUE;
    }    
    return FALSE;
}
