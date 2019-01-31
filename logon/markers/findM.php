<?php

	require '../../db/bdajax.php';

	session_start();

	$cod = $_SESSION['cod'];
	
	$lat = $_POST['lat'];
	$lng = $_POST['lng'];

	$lat = (float)$lat;
	$lng = (float)$lng;
	

	$query = 'WHERE lat = '.$lat.' and lng = '.$lng.'';

	$dados = DBRead1('markers',$query,'creater');

	if ($dados['creater'] == $cod or $cod == 1) {
		$c = "v";
	}else{
		$c = "f";
	}
	

	
	$query = 'WHERE lat = '.$lat.' and lng = '.$lng.'';

	$dados = DBRead1('markers',$query,'name, address, id');

	
	$tit = $dados['name'];
	$desc = $dados['address'];
	$markerid = $dados['id'];

	$_SESSION['markerOn'] = $markerid;
	

	$json = "[{\"tit\": \"$tit\", \"desc\": \"$desc\", \"controle\": \"$c\"}]";

			echo $json;

?>