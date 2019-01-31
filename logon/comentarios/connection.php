<?php

	$db = @mysql_connect("localhost","root","") or die("Ocorreu o seguinte erro na conexao: ".mysql_error());
	@mysql_select_db("comentarios_respostas", $db) or die("Ocorreu o seguinte erro na selecao: ".mysql_error());

?>