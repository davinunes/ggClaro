<?php
include "database.php";

getUsuarios();


echo " <a class='btn teal center modal-trigger' href='#cadastro' id='addUser'>Criar novo Usuário</a>";
echo " <a class='btn red right' id='github'>GitHub</a>";


?>

<!-- Modal Structure -->
  <div id="cadastro" class="modal">
    <div class="modal-content">
      <h4>Cadastro de Usuarios</h4>
      
	  
<div class="row">
    <form class="col s12" id="formUser">
      <div class="row">
        <div class="input-field col s12 m6">
          <input placeholder="Nome" id="UserName" name="UserName" type="text" class="validate">
          <label for="UserName" class="active">Nome do Usuário</label>
        </div>
        <div class="input-field col s12 m6">
          <input id="UserLogin" name="UserLogin" placeholder="Login" type="text" class="validate ">
          <label for="UserLogin" class="active">Login</label>
        </div>
        <div class="input-field col s12 m6">
          <input id="UserPassword" name="UserPassword" placeholder="Senha" type="password" class="validate ">
          <label for="UserPassword" class="active">Senha</label>
        </div>
		<div class="input-field col s12 m6">
          <input id="UserPasswordCheck" name="UserPasswordCheck" placeholder="Repita a Senha" type="password" class="validate ">
          <label for="UserPasswordCheck" class="active">Confirmar a Senha</label>
        </div>
        <div class="input-field col s12 m6 hide">
          <input id="UserId" name="UserId" placeholder="0" type="text" class="validate somenteNumeros" disabled>
          <label for="UserId" class="active">Id</label>
        </div>
      </div>

    </form>
  </div>
	  
	  
	  
	  
    </div>
    <div class="modal-footer">
		<a id="send" metodo="userAdd" formId="formUser" class="include modal-close waves-effect waves-green btn">CADASTRAR</a>
      <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cancelar</a>
    </div>
  </div>