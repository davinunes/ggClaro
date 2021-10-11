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
      <p>Form Aqui</p>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cancelar</a>
    </div>
  </div>