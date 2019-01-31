<?php
	//abre conexão
	function Connect(){
		$link = mysqli_connect('localhost','root','','pignus') or di(mysqli_connect_error());
		mysqli_set_charset($link,'utf8') or die(mysqli_error($link));
		return $link;
	}
	//fecha conexão
	function Disconnect($link){
			@mysqli_close($link) or die(mysqli_error($link));
	}
	//protege de SQL injection
	function DBEscape($dado){
		$link = Connect();
		if(!is_array($dado))
			$dado = mysqli_real_escape_string($link,$dado);
		else{
			$arr = $dado;

			foreach($arr as $key => $value){
				$key = mysqli_real_escape_string($link,$key);
				$value = mysqli_real_escape_string($link,$value);

				$dado[$key] = $value;
			}
		}
		Disconnect($link);
		return $dado;
	}
	//executa uma query qualquer
	function Query($query){
		$link = Connect();

		$result = @mysqli_query($link,$query) or die(mysqli_error($link));
		
		Disconnect($link);
		//retorna verdadeiro ou falso
		return $result;
	}

	function Cadastra($tabela, array $dados){
		$campos = implode(", ", array_keys($dados));
		$valores = "'".implode("', '",$dados)."'";

		$query = "INSERT INTO $tabela ($campos) VALUES ($valores);"; 
		return Query($query);
	}
	//realiza um select qualquer e retorna os valores em um array EX: $clientes = DBRead('aluno','WHERE matricula = 1', 'nome, senha');
	function DBRead($tabela, $parametros = null, $campos = '*'){
		
		// $tabela = DBEscape($tabela);
		// $parametros = DBEscape($parametros);
		
		$query = "SELECT $campos FROM $tabela $parametros ";
		$result = Query($query);

		if(!mysqli_num_rows($result))
			return $result;
		else{
			//retorna array com todos os resultados
			while ($res = mysqli_fetch_assoc($result)){
				$data[] = $res;
			}
			return $data;
		}
	}

	function DBRead1($tabela, $parametros = null, $campos = '*'){
		
		// $tabela = DBEscape($tabela);
		// $parametros = DBEscape($parametros);
		
		$query = "SELECT $campos FROM $tabela $parametros ";
		$result = Query($query);

		if(!mysqli_num_rows($result))
			return $result;
		else{
			//retorna array com todos os resultados
			while ($res = mysqli_fetch_assoc($result)){
				$data = $res;
			}
			return $data;
		}
	}

	function TrataArray($array,$campo){
		foreach ($array as $value) {
				return $value[$campo];
			}
	}
?>