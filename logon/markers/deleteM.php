<?php

	require '../../db/bdajax.php';
	session_start();


	$tipo = $_POST['tipo'];
	$titulo = $_POST['titulo'];
	$descricao = $_POST['descricao'];
	$cod = $_SESSION['cod'];
	$resp;

	$query = "WHERE name = '$titulo' and address = '$descricao'";

	$dados = DBRead1('markers',$query,'creater');

	if ($dados['creater'] == $cod or $cod == 1) {
		//é o criador ou adm
	  {//deleta a postagem
		$titulo = DBEscape($titulo);
		$descricao = DBEscape($descricao);

		$result = Query("DELETE FROM markers WHERE name = '$titulo' and address = '$descricao';");
		if($result)
			$resp = 1;//"Deletado com sucesso";
		else
			$resp = 2;//"Ocorreu algum erro ao deletar, tente denovo";	
	  }	

	}else{
		$resp = 3;//"Você não pode marcar como resolvido pois você não criou essa postagem";
	}

	$json = "[{\"resp\": \"$resp\"}]";

	echo $json;
	
	
?>