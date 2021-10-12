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
	/**
		Essa função visa serializar os itens de um formulário, fazendo uso de uma pequena gambiarra (não me perguntem como ela funciona!
	**/
	var inputs = $(e+" :input"); // pega todos os inputs do formulário
	var obj = $.map(inputs, function(n, i){ // cria um obj com um indice numérico pra cada par elemento/valor
		var o = {};
		o[n.name] = $(n).val();
		return o;

	});
	var dados = {};
	$.each(obj, function(key,value){ //Acessa cada elemento do novo objeto
		$.each(value, function(a,b){// Insere cada item no nomo array da forma correta
			dados[a] = b;
		});
	});
	console.log(dados);
	return dados;
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

$(document).on('click', '.include', function(){
	/**
		Chama o script que fará a inclusão de um Tipo de dado
	**/
	var dados = serializar('#'+$(this).attr("formId")); //Serializa pegando o id do form de um atributo presente no botão
	dados['metodo'] = $(this).attr("metodo");
	
	console.log('Adicionando Cliente');
	console.log(dados);
	
	
	$.post('php/database.php', dados, function(retorna){
		
			M.toast({html: retorna, classes: 'rounded'});
			setTimeout(function(){
			 // window.location.reload(true);
			}, 4000);
			
		
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
			}, 4000);
			
		
	});

});

$(document).on('click', '.sellService', function(){
  $("#fClientId").val($(this).attr("ClientId"));
  $("#fClientName").val($(this).attr("ClientName"));
});

$(document).on('keyup', '.somenteNumeros', function(){
	$(this).val(this.value.replace(/\D/g, ''));
});

$("#UserPassword").on("focusout", function (e) {
    if ($(this).val() != $("#UserPasswordCheck").val()) {
        $("#UserPasswordCheck").removeClass("valid").addClass("invalid");
    } else {
        $("#UserPasswordCheck").removeClass("invalid").addClass("valid");
    }
});

$("#UserPasswordCheck").on("keyup", function (e) {
    if ($("#UserPassword").val() != $(this).val()) {
        $(this).removeClass("valid").addClass("invalid");
    } else {
        $(this).removeClass("invalid").addClass("valid");
    }
});

$(document).on('change', '#upload', function(){
	console.log("Upload:");
	const file = $(this)[0].files[0];
	console.log(file);
	const ctx = new FileReader();
	console.log(ctx);
	ctx.onloadend = function(){
		console.log("No Fim");
		console.log(ctx.result);
		$("#img").attr("src",ctx.result);
		$("#ServiceImage").val(ctx.result);
	}
	ctx.readAsDataURL(file);
});
