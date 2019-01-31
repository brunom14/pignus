<?php 
		
	include "../../db/bdajax.php";

	$imagens = $_FILES['arquivo'];
	$indice = count(array_filter($imagens['name']));
	$permite = array("image/jpg","image/png","image/jpeg","image/gif");
	$mensagem ='';
	
	if ($indice <= 0) {
		$mensagem = "Você não selecionou nenhuma imagem";
	}else{
		for ($i=0; $i < $indice; $i++) { 
			$imagens['name'][$i];

			if(!in_array($imagens['type'][$i], $permite)){
				$mensagem = "alguns arquivos não foram enviados(formato inválido)";
			}


			$extensao = strtolower(substr($imagens['name'][$i], -4)); // pega a extensão do arquivo
			$novo_nome = md5(time()) . $extensao; // define o nome do qrquivo
			$diretorio = "upload/"; // define o diretório para onde enviamos o arquivo

			move_uploaded_file($imagens['tmp_name'][$i], $diretorio.$novo_nome); // efetia upload

			$sql_code = "INSERT INTO arquivo (arquivo, data) VALUES ( '$novo_nome', NOW())";

			if(Query($sql_code))
				$mensagem = "".$novo_nome;
			else
				$mensagem = "Houve um erro ao enviar suas imagens";
		}
	}
	
	echo "$mensagem";
 ?>
