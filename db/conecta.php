<?php

	$servidor = 'localhost';
	$usuario ='root';
	$senha = '';
	$bancodedados='pignus';

	$link = mysqli_connect($servidor,$usuario,$senha,$bancodedados);

	if (!$link) {
		die("FALHA NA CONECXÃO!".mysqli_connect_error());
	}

?>