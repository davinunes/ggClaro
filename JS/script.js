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
			pagina = "php/"+$(this).attr("id")+".php"+"?"+args;
		}else{
			pagina = "php/"+$(this).attr("id")+".php";
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

$(document).on('click', '#github', function(){
	/**
		Chama o script que fará a atualização no GitHub
	**/
	console.log('Sincronizando com GitHub');
	$.post('php/git.php', '', function(retorna){
		
			M.toast({html: retorna, classes: 'rounded'});
			setTimeout(function(){
			 // window.location.reload(true);
			}, 2500);
			
		
	});

});
