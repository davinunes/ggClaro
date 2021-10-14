<?php
include "database.php";
validar();
getService();


echo " <a 
			class='new btn teal center modal-trigger' 
			href='#cadastro' 
			form='#formService' 
			id='addService' 
		>Criar novo Serviço</a>";


?>

<!-- Modal Structure -->
  <div id="cadastro" class="modal">
    <div class="modal-content">
      <h4>Cadastro de Serviços ou Produtos</h4>
      
	  
<div class="row">
    <form class="col s12" id="formService">
      <div class="row">
        <div class="input-field col s12 m6">
          <input placeholder="Nome" id="ServiceName" name="ServiceName" type="text" class="validate">
          <label for="ServiceName" class="active">Nome do Serviço ou produto</label>
        </div>
        <div class="input-field col s12 m6">
          <input id="ServiceDefVal" name="ServiceDefVal" placeholder="1.15" type="number" class="validate ">
          <label for="ServiceDefVal" class="active">Preço de referência</label>
        </div>
	  </div>
		<div class="row">
		<div class="file-field input-field s12">
			  <div class="btn">
				<span>Imagem</span>
				<input type='file' id='upload' name='upload' tag='#ServiceImage'/>
			  </div>
			  
			  <div class="file-path-wrapper">
				<input name="upload2" id="upload2" class="file-path validate" type="text">
			  </div>
		</div>
		</div>
		<div class="row">
		<div class="input-field col s12 m6">
			<img id='img' style='width:70px;' />
		</div>
        <div class="input-field col s12 m6 ">
          <textarea id="ServiceDesc" name="ServiceDesc" placeholder="Texto sobre o item, produto ou serviço." type="textarea" class="materialize-textarea "></textarea>
          <label for="ServiceDesc" class="active">Descrição do Item</label>
        </div>

        <div class="input-field col s12 m6 hide">
          <input id="ServiceId" name="ServiceId" placeholder="0" type="text" class="validate somenteNumeros" disabled>
          <label for="ServiceId" class="active">Id</label>
        </div>
		<div class="input-field col s12 m6 hide">
          <input class='upimg' id="ServiceImage" name="ServiceImage" placeholder=" " type="text" disabled>
          <label for="ServiceImage" class="active">Imagem Codificada</label>
        </div>
      </div>

    </form>
  </div>
	  
	  
	  
	  
    </div>
    <div class="modal-footer">
		<a 
			id="send" 
			index='#servicos' 
			metodo="serviceAdd"
			metododef="serviceAdd"
			formId="formService" 
			class="include modal-close waves-effect waves-green btn"
		>CADASTRAR</a>
      <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cancelar</a>
    </div>
  </div>