<?php
include "database.php";
validar();
getClientes();


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
        <div class="input-field col s12 m6">
          <input id="ClientId" name="ClientId" placeholder="0" type="text" class="validate somenteNumeros" disabled>
          <label for="ClientId" class="active">Id</label>
        </div>
      </div>

    </form>
  </div>
	  
	  
	  
    </div>
    <div class="modal-footer">
		<a id="send" metodo="clientAdd" formId="formClient" class="include modal-close waves-effect waves-green btn">CADASTRAR</a>
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
		<a id="send" metodo="flowAdd" formId="formVenda" class="include modal-close waves-effect waves-green btn">Anotar</a>
		<a href="#!" class="modal-close waves-effect waves-green btn-flat">Cancelar</a>
    </div>
  </div>