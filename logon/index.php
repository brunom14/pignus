
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Projeto Pignus</title>
	<link href="css/main.css" rel="stylesheet">
</head>
<body>
	
	<input type="hidden" id="cod" value=" <?php echo $_SESSION['cod']; ?> ">
	
	<div id="menu">
		<h3><?php echo $_SESSION['nome']; ?></h3>
		<h5><?php echo $_SESSION['email']; ?></h5>
		<br><br>
		<input onclick="formpost.style.visibility='visible';formpost.style.Zindex='10';" type=button value="Adicionar Postagem">
		  &nbsp; &nbsp;
		<input type="button" value="Marcar como resolvido" id="resolvido" onclick="resolvidof();">
		
		<input type="button" value="Logout" onclick="Logout();">
	</div>
	<div id="map"></div>

	</div>
	</div>
	<div id="formpost">
			<div id="mensagens"></div>
			<form id="meuForm" enctype="multipart/form-data">
				<input type="file" name="arquivo[]" multiple="multiple" accept="image/jpg,image/png,image/jpeg,image/gif" />
				<br>
				<br>
				<button id="enviar">Subir imagem</button>
			</form>
			
			<form>
				<br/>Selecione o tipo do seu alerta:<br/>
				<select name="type" id="type">
					<option value="E">Infraestrura</option>
					<option value="A">Violência</option>
				</select>
				<br>
				fotoNome:<input id="foto" type="text" name="foto">
				<br/>Digite o título<br/>
				<input type="text" name="title" id="title">
				<br/>Digite a descrição<br/>
				<textarea name="desc" id="desc" rows="10" cols="30"></textarea>
				<input type="button" value="selecionar local" onclick="ligMarker();postagem();">
				<input type="button" value="cancela" onclick="formpost.style.visibility='hidden';formpost.style.Zindex='-10';">
			</form>
		</div>

	<script src="../jquery-3.3.1.min.js" type="text/javascript"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB3EbXfPIIAr7rrJwBXWVGkgfG9Ue6gDWM"></script>
	<script id="meta" src="js.js" type="text/javascript"></script>
</body>
</html>
