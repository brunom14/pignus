<?php
		include "../../db/bdajax.php";
	
		$id = $_POST['id_postagem'];
		$codUser = $_POST['cod_autor'];
		$comentario = $_POST['comentario'];
		$lat = $_POST['lat'];
		$lng = $_POST['lng'];
		$foto = $_POST['foto'];

		$dados = array(
			'marker' => $_POST['id_postagem'] ,
			'user' => $_POST['cod_autor'] ,
			'texto' => $_POST['comentario']
		 );

		Cadastra('coment', $dados);

		$result = DBRead('coment');
		print_r($result);

		$i = count($result) - 1;
		echo $i;
		
		$id_comentario;
		foreach ($result as $key => $value) {
			if ($key == $i) {
				$id_comentario = $value['COD'];
			}
		}

		
		header("Location: index.php?id=1&lat=$lat&lng=$lng&foto=$foto#$id_comentario");

?>