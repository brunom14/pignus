<?php

	require '../../db/bdajax.php';
	
	session_start();

	$cod = $_SESSION['cod'];


	$lat = $_POST['lat'];
	$lng = $_POST['lng'];
	$tipo = $_POST['tipo'];
	$titulo = $_POST['titulo'];
	$descricao = $_POST['descricao'];
	$creater = $cod;

	if (isset($_POST['foto'])) 
		$foto = $_POST['foto'];
	else
		$foto = null;
	$idFoto;
	$dados = DBRead('arquivo', "WHERE arquivo = '$foto'",'cod');
	foreach ($dados as $key => $value) {
		$idFoto = $value['cod'];
	}


	$titulo = DBEscape($titulo);
	$descricao = DBEscape($descricao);


	$result = Query("INSERT INTO markers(name, address, lat, lng, type, creater, foto) VALUES ('$titulo','$descricao','$lat','$lng','$tipo','$creater','$idFoto');");
	if($result)
		echo"salvo";
	else
		echo "nao salvo";
?>