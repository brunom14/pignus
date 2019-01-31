$(function(){
	$(".abre_coment").click(function(){
		$(this).siblings("#comentarios").toggle("slow");
	});

	$(".abre_respostas").click(function(){
		$(this).siblings("#respostas").toggle("slow");
	});

	//limpa campos
	$("input:text, input:password, textarea").focus(function(){
		if($(this).val() == $(this)[0].defaultValue){
			$(this).removeClass("campo");
			$(this).val('');	
		}
	}).blur(function(){
		if ($(this).val() == "" || $(this).val() == " "){
			$(this).val($(this)[0].defaultValue);
			$(this).addClass("campo");
	}
	});

});