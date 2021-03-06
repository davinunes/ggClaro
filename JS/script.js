function moeda(){
        var myAudio = new Audio('moeda.mp3');
		myAudio.play();
}

function loader(){
	$('#conteudo').html('<div class="center"><img src="load.gif"></img></div>');
}

onResize = function() {
	/**
		Verifica o tamanho da tela para ajustar a div que apresenta o conteúdo
	**/
	if($(window).width() > 992){
		$("#conteudo").css("padding-left",160);
	}else{
		$("#conteudo").css("padding-left",24);
		// $('.collection ').css("min-height",'fit-content');
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
	
	$('.collapsible').collapsible();
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
		loader();
		
		$.post(pagina, "", function(retorna){
			$("#conteudo").html(retorna);
			// $('select').formSelect();
			$('.modal').modal();
			$('.collapsible').collapsible();
			$('.circle').css('object-fit', 'cover'); //Ajusta Imagem dentro do avatar
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

$(document).on('click', '.reexibeClientes', function(){
	/**
		Chama o script que retornará a lista de clientes que foi ocultada, alterando o nome do botão, e removendo o conteudo que foi exibido anteriormente
	**/
	$(this).removeClass('reexibeClientes').addClass('getServClient').children().text('list');
	$('.collection li').removeClass('selecionado');
	$(".collection li").show();
	$('#servPorClient').html('');
});
	
$(document).on('click', '.getServClient', function(){
	/**
		Chama o script que retornará a lista de produtos por cliente
	**/
	
	// Removo o marcador de todos os itens
	$('.collection li').removeClass('selecionado');
	// Marco o item atual
	let manter = $(this).parent().parent().addClass('selecionado');
	// Escondo todos os demais
	$(".collection li").not('.selecionado').hide();
	// Agora substituo a função deste botão, para que reexiva o que estava oculto
	$(this).removeClass('getServClient').addClass('reexibeClientes').children().text('update');
	
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
	$("#send").text("CADASTRAR");
	$("#send").attr('metodo',$("#send").attr('metododef'));
	$(f)[0].reset();
	$("#img").attr("src","");
});

$(document).on('click', '.sellService', function(){
  $("#fClientId").val($(this).attr("ClientId"));
  $("#fClientName").val($(this).attr("ClientName"));
});

$(document).on('click', '.editGlobal', function(){
	/**
		Tem que ter esses atributos no link que carrega a classe editGlobal:
		metodoGet='getServiceJSON'
		metodoSet='serviceSet'
		chave='ServiceId'
	
	**/
  let formulario = $(this).attr('form');
  let metodo = $(this).attr('metodoGet');
  let chave = $(this).attr('chave');
  
  var dados = {};
  dados['metodo'] = metodo;
  dados[chave] = $(this).attr(chave);
  dados['mset'] = $(this).attr('metodoSet');;
  
  console.log(formulario);
  	$.post('php/database.php', dados, function(retorna){
		// M.toast({html: retorna, classes: 'rounded'});
		console.log(retorna);
		$.each(retorna, function(key,value){
			console.log(key);
			$("#"+key).val(value);
			$("#"+key).trigger("change");
		});
		$("#send").attr("metodo",dados.mset);
		$("#send").text("Atualizar");
	},"json");
});

$(document).on('keyup', '.somenteNumeros', function(){
	$(this).val(this.value.replace(/\D/g, ''));
});

$(document).on('click', '.removerVendaDoCliente', function(){
	/**
		Tem que ter esses atributos no link que carrega a classe editGlobal:
		metodoGet='getServiceJSON'
		metodoSet='serviceSet'
		chave='ServiceId'
	
	**/

  var dados = {};
  dados['metodo'] = 'removerVendaDoCliente';
  dados['item'] = $(this).attr('item');
  dados['valor'] = $(this).attr('valor');
  dados['ClientId'] = $(this).attr('ClientId');

	let euQuero = confirm('Você vai deletar a venda numero '+dados.item+' no valor de R$ '+dados.valor+' do banco de dados. Esta ação é irreversível! Tem certeza?');
	if(euQuero){
		
		// $(this).parent().html('<i class="material-icons">done_all</i>').parent().addClass('teal lighten-5');
		$.post('php/database.php', dados, function(retorna){
			$('#servPorClient').html(retorna);
			M.toast({html: "Feito!!", classes: 'rounded'});
		});
	}
});

$(document).on('click', '.receberPagamentoDoCliente', function(){
	/**
		Tem que ter esses atributos no link que carrega a classe editGlobal:
		metodoGet='getServiceJSON'
		metodoSet='serviceSet'
		chave='ServiceId'
	
	**/

  var dados = {};
  dados['metodo'] = 'receberPagamentoDoCliente';
  dados['item'] = $(this).attr('item');
  dados['valor'] = $(this).attr('valor');
  dados['ClientId'] = $(this).attr('ClientId');

	let euQuero = confirm('Você vai dar baixa na venda numero '+dados.item+' no valor de R$ '+dados.valor+' do banco de dados. Tem certeza?');
	if(euQuero){
		
		// $(this).parent().html('<i class="material-icons">done_all</i>').parent().addClass('teal lighten-5');
		$.post('php/database.php', dados, function(retorna){
			$('#servPorClient').html(retorna);
			M.toast({html: "Feito!!", classes: 'rounded'});
		});
	}


});

$("#UserPasswordCheck").on("keyup", function (e) {
    if ($("#UserPassword").val() != $(this).val()) {
        $(this).removeClass("valid").addClass("invalid");
    } else {
        $(this).removeClass("invalid").addClass("valid");
    }
});

$(document).on('change', '.upimg', function(){
	console.log("Deveria escrever a nova imagem");
	$("#img").attr("src",$(this).val());
});

$(document).on('change', '#upload', function(){
	console.log("Upload:");
	const file = $(this)[0].files[0];
	console.log(file);
	let tag = $(this).attr('tag');
	const ctx = new FileReader();
	console.log(ctx);
	ctx.onloadend = function(){
		console.log("No Fim");
		console.log(ctx.result);
		// $("#img").attr("src",ctx.result);
		$(tag).val(ctx.result);
		$(tag).trigger("change");
	}
	ctx.readAsDataURL(file);
});

$(document).on('click', '.nono', function(){
	M.toast({html: "Ainda não é possível...", classes: 'rounded'});
});
