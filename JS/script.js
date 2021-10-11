function moeda(){
        var myAudio = new Audio('moeda.mp3');
		myAudio.play();
}
onResize = function() {
	if($(window).width() > 992){
		$("#conteudo").css("padding-left",160);
	}else{
		$("#conteudo").css("padding-left",24);
	}
}

function serializar(e){
	var inputs = $(e+" :input");
	var obj = $.map(inputs, function(n, i){
		var o = {};
		o[n.name] = $(n).val();
		return o;
	});
	console.log(obj);
	return obj;
}


$(window).resize(onResize);

$(document).ready(function(){
	
	$('.sidenav').sidenav({
		menuWidth: 50,
		edge:'left'
	});
	
	onResize();
	
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

$(document).on('keyup', '.somenteNumeros', function(){
	$(this).val(this.value.replace(/\D/g, ''));
});
