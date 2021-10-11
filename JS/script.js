function moeda(){
        var myAudio = new Audio('moeda.mp3');
		myAudio.play();
}

$(document).ready(function(){
	
	$('.sidenav').sidenav();
	
	$('.dropdown-trigger').dropdown({
		inDuration: 300,
		alignment: 'right',
		hover: true,
		coverTrigger: false
		
	});
	
	$('.menu').click(function() {
		args = $(this).attr("args");
		if(typeof args != "undefined"){
			pagina = $(this).attr("id")+".php"+"?"+args;
		}else{
			pagina = $(this).attr("id")+".php";
		}
		console.log(pagina);
		
		$.post(pagina, "", function(retorna){
			$("#conteudo").html(retorna);
			// $('select').formSelect();
			$('.modal').modal();
		});
		
		
	});

	$('.cpf').keyup(function() {
		$(this).val(this.value.replace(/\D/g, ''));
    });

});
