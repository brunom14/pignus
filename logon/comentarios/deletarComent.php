<?php
	include "../../db/bdajax.php";

	$lat = $_GET['lat'];
	$lng = $_GET['lng'];
	$foto = $_GET['foto'];


	$id = $_GET['id_comentario'];


	$result = Query("DELETE FROM coment WHERE COD = $id;");

	header("Location: index.php?id=1&lat=$lat&lng=$lng&foto=$foto");

?>