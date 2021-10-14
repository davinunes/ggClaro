<?php
include "database.php";
validar();
getClientes();

echo '<div id="servPorClient"></div>';

echo "<a class='btn teal center modal-trigger' id='addUser' href='#cadastro'>Cadastrar Cliente</a>";


?>


<!-- Modal Structure -->
  <div id="cadastro" class="modal">
    <div class="modal-content">
      <h4>Cadastro de Clientes</h4>
      
<div class="row">
    <form class="col s12" id="formClient">
      <div class="row">
        <div class="input-field col s12 m6">
          <input placeholder="Nome" id="ClientName" name="ClientName" type="text" class="validate">
          <label for="ClientName" class="active">Nome do Cliente</label>
        </div>
        <div class="input-field col s12 m6">
          <input id="ClientCPF" name="ClientCPF" placeholder="99999999999" type="text" class="validate somenteNumeros">
          <label for="ClientCPF" class="active">CPF</label>
        </div>
        <div class="input-field col s12 m6">
          <input id="ClientZap" name="ClientZap" placeholder="5561999999999" type="text" class="validate somenteNumeros">
          <label for="ClientZap" class="active">WhatsApp no formato: 5561999999999</label>
        </div>
        <div class="input-field col s12 m6 hide">
          <input id="ClientId" name="ClientId" placeholder="0" type="text" class="validate somenteNumeros" disabled>
          <label for="ClientId" class="active">Id Cliente</label>
        </div>
		<div class="file-field input-field s12 m6">
			  <div class="btn">
				<span>Foto</span>
				<input type='file' accept="image/*" id='upload' class='upload' name='upload' tag='#ClientImg'/>
			  </div>
			  
			  <div class="file-path-wrapper">
				<input name="upload2" id="upload2" class="file-path validate" type="text">
			  </div>
		</div>
		<div class="input-field col s12 m6">
			<img id='img' style='width:70px;' />
		</div>
		<div class="input-field col s12 m6 hide">
          <input class='upimg'  id="ClientImg" name="ClientImg" placeholder=" " type="text" disabled>
          <label for="ClientImg" class="active">Imagem Codificada</label>
        </div>
      </div>

    </form>
  </div>
	  
	  
	  
    </div>
    <div class="modal-footer">
		<a 
			id="send" 
			index='#clientes'
			metodo="clientAdd" 
			metododef="clientAdd"
			formId="formClient" 
			class="include modal-close waves-effect waves-green btn"
		>CADASTRAR</a>
		<a href="#!" class="modal-close waves-effect waves-green btn-flat">Cancelar</a>
    </div>
  </div>
  
<div id="venda" class="modal">
    <div class="modal-content">
      <h4>Anotar no caderninho</h4>
      
<div class="row">
    <form class="col s12" id="formVenda">
      <div class="row">
        <div class="input-field col s12 m6">
          <input placeholder="Clique para selecionar um cliente" id="fClientName" name="ClientName" type="text" class="validate" disabled>
          <label for="fClientName" class="active">Cliente</label>
        </div>

        <div class="input-field col s12 m6">
          <input id="FlowDate" name="FlowDate" type="date" class="validate ">
          <label for="FlowDate" class="active">Vencimento</label>
        </div>
        <div class="input-field col s12 m6">
          <input id="FlowPrice" name="FlowPrice" type="number" class="validate ">
          <label for="FlowPrice" class="active">Valor</label>
        </div>
		<div class="input-field col s12 m6">
		
				<select name="ServiceId" class='browser-default'>
				  <option value="" disabled selected>Escolha o Serviço</option>
<?php
 getServiceList();
?>
				</select>
          
        </div>
        <div class="input-field col s12">
          <textarea id="FlowDesc" name="FlowDesc" placeholder="Descrição do que foi feito" type="text" class="validate "></textarea>
          <label for="FlowDesc" class="active">Anotações</label>
        </div>
        <div class="hide input-field col s12 m6">
          <input id="UserId" name="UserId" placeholder="0" type="text" class="validate " value="<?php  echo $_SESSION[UserId]; ?>" disabled>
          <label for="UserId" class="active">UserId</label>
        </div>
		<div class="hide input-field col s12 m6">
          <input id="fClientId" name="ClientId" placeholder="0" type="text" class="validate " disabled>
          <label for="fClientId" class="active">ClientId</label>
        </div>
		<div class="hide input-field col s12 m6">
          <input id="FlowId" name="FlowId" placeholder="0" type="text" class="validate " disabled>
          <label for="FlowId" class="active">FlowId</label>
        </div>
      </div>

    </form>
  </div>
	  
	  
	  
    </div>
    <div class="modal-footer">
		<a 
			id="sendFlow" 
			metodo="flowAdd" 
			metododef="flowAdd"
			formId="formVenda" 
			class="include modal-close waves-effect waves-green btn"
		>Anotar</a>
		<a href="#!" class="modal-close waves-effect waves-green btn-flat">Cancelar</a>
    </div>
  </div>