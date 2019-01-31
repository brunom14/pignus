

function validacao(){
	if (document.form.usuario.value==""){
		alert("Campo de usuario vazio");
		document.form.usuario.focus();
		return false;
	}
	//checa se o nome de usuário já foi utilizado
	//alert("testando!!");
		// $.post("isUsed.php",{
		// 	usuario: document.form.usuario.value
		// }, function(data/*é o que vem do servidor*/){
  //       	var variavel = JSON.parse(data);
          
  //         		var result = variavel[0].result;
  //           	if(result == "t"){//"se tem..."
  //           		alert("Esse nome de usuário já foi utilizado, tente outro");
  //           		location.reload();
  //           	}
  //       })

	

	if (document.form.email.value=="" || document.form.email.value.indexOf('@')==-1 || document.form.email.value.indexOf('.')==-1){
		alert("Email inválido");
		document.form.email.focus();
		return false;
	}

	if (document.form.senha.value==""){
		alert("Campo de senha vazio");
		document.form.senha.focus();
		return false;
	}

	if (document.form.senha.value!==document.form.csenha.value){
		alert("As senhas preenchidas então diferentes");
		document.form.senha.focus();
		return false;
	}
	
	if (document.form.nome.value==""){
		alert("Campo de nome vazio");
		document.form.nome.focus();
		return false;
	}	

	return true;

}

function processa(){

	//alert(document.form.usuario.value);

		$.post("processa.php",{
	        
	        usuario: document.form.usuario.value,
	        senha: document.form.senha.value,
	        email: document.form.email.value,
	        nome: document.form.nome.value,
	        
	        }, function(data/*é o que vem do servidor*/){
        		//var variavel = JSON.parse(data);
          		alert("teste");
          	
        })

}