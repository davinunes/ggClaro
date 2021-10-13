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
	dados['index'] = $(this).attr("index");
	console.log('Adicionando Cliente');
	console.log(dados);
	
	
	$.post('php/database.php', dados, function(retorna, index){
		
			M.toast({html: retorna, classes: 'rounded'});
			setTimeout(function(){
			 $(dados['index']).click();
			}, 2000);
			
		
	});

});



$(document).on('click', '.getServClient', function(){
	/**
		Chama o script que retornará a lista de produtos por cliente
	**/		
			var dados = {};
			dados["metodo"] = "getServClient";
			dados["ClientId"] =  $(this).attr("ClientId");
			
	$.post('php/database.php', dados, function(retorna){
		
			
			$('#servPorClient').html(retorna);
			// M.toast({html: retorna, classes: 'rounded'});
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

$(document).on('click', '.new', function(){
	let f = $(this).attr('form');
	$(f)[0].reset();
	$("#img").attr("src","");
});

$(document).on('click', '.sellService', function(){
  $("#fClientId").val($(this).attr("ClientId"));
  $("#fClientName").val($(this).attr("ClientName"));
});

$(document).on('click', '.editGlobal', function(){
  let formulario = $(this).attr('form');
  let dados = {};
  dados['metodo'] = "getServiceJSON";
  dados['ServiceId'] = $(this).attr('ServiceId');
  console.log(formulario);
  	$.post('php/database.php', dados, function(retorna){
		// M.toast({html: retorna, classes: 'rounded'});
		console.log(retorna);
		$.each(retorna, function(key,value){
			console.log(key);
			$("#"+key).val(value);
			$("#"+key).trigger("change");
		});
		$("#send").attr("metodo",'serviceSet');
		$("#send").text("Atualizar");
	},"json");
});

$(document).on('keyup', '.somenteNumeros', function(){
	$(this).val(this.value.replace(/\D/g, ''));
});


$("#UserPasswordCheck").on("keyup", function (e) {
    if ($("#UserPassword").val() != $(this).val()) {
        $(this).removeClass("valid").addClass("invalid");
    } else {
        $(this).removeClass("invalid").addClass("valid");
    }
});

$(document).on('change', '#ServiceImage', function(){
	console.log("Deveria escrever a nova imagem");
	$("#img").attr("src",$(this).val());
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
		// $("#img").attr("src",ctx.result);
		$("#ServiceImage").val(ctx.result);
		$("#ServiceImage").trigger("change");
	}
	ctx.readAsDataURL(file);
});
