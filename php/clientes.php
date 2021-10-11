<?php
include "database.php";

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
          <label for="ClientZap" class="active">Id</label>
        </div>
      </div>

    </form>
  </div>
	  
	  
	  
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cancelar</a>
    </div>
  </div>