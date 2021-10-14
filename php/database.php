<?php


define('DB_HOSTNAME', 'localhost');
define('DB_DATABASE', 'ggClaro');
define('DB_USERNAME', 'ilunne');
define('DB_PASSWORD', 'yuk11nn4');
define('DB_PREFIX', '');
define('DB_CHARSET', 'utf8');

function DBConnect(){ # Abre Conexão com Database
	$link = @mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE) or die(mysqli_connect_error());
	mysqli_set_charset($link, DB_CHARSET) or die(mysqli_error($link));
	return $link;
}

function DBClose($link){ # Fecha Conexão com Database
	@mysqli_close($link) or die(mysqli_error($link));
}

function DBEscape($dados){ # Proteje contra SQL Injection
	$link = DBConnect();
	
	if(!is_array($dados)){
		$dados = mysqli_real_escape_string($link,$dados);
	}else{
		$arr = $dados;
		foreach($arr as $key => $value){
			$key	= mysqli_real_escape_string($link, $key);
			$value	= mysqli_real_escape_string($link, $value);
			
			$dados[$key] = $value;
		}
	}
	DBClose($link);
	return $dados;
}

function DBExecute($query){ # Executa um Comando na Conexão
	$link = DBConnect();
	$result = mysqli_query($link,$query) or die(mysqli_error($link));
	
	DBClose($link);
	return $result;
}

function DBQ($query){ # Executa um Comando na Conexão
	$link = DBConnect();
	$result = mysqli_query($link,$query) or die(mysqli_error($link));
	
	DBClose($link);
	if(!mysqli_num_rows($result)){

	}else{
		while($retorno = mysqli_fetch_assoc($result)){
			$dados[] = $retorno;
		}
	}
	return $dados;
}

function validar(){
	/**
		Verifica se o usuário está logado
	**/
	session_start();
	if(!isset($_SESSION[UserId])){
		header("location: login.php");
		exit;
	}
}

function getUsuarios(){ 
	/**
		Escreve uma lista com os usuários na tabela user
	**/
	$sql .= "select * from `user` u ";
	
	$consulta = DBQ($sql);
	echo '<ul class="collection">';
	foreach($consulta as $u){
		
		echo "	<li class='collection-item avatar'>
					<i class='material-icons circle'>assignment_ind</i>
					<span class='title'>$u[UserName]</span>
					<p>
						Login :: $u[UserLogin]
					</p>
					<span class='secondary-content'>
						<a 
							href='#cadastro' 
							class='modal-trigger btn blue editGlobal' 
							UserId='$u[UserId]'
							metodoGet='getUserJSON'
							metodoSet='userSet'
							chave='UserId'
							form='#formUser'

						><i class='material-icons'>edit</i></a>
						
						<a class='btn red removeUser' UserId='$u[UserId]'><i class='nono material-icons'>delete_forever</i></a>
					</span>
				</li>";
	}
	echo '</ul>';

}

function getClientes(){ # Executa um Comando na Conexão
	/**
		Escreve uma lista com os clientes na tabela client
	**/
	$sql .= "select * from `client` c ";
	
	$consulta = DBQ($sql);
	echo '<ul class="collection">';
	foreach($consulta as $u){
		$img = !$u[ClientImg] ? "<i class='material-icons circle'>assignment_ind</i>" : "<img src='$u[ClientImg]' class='circle'>";
		echo "	<li class='collection-item avatar'>
					$img
					<span class='title'>$u[ClientName]</span>
					<p>
						CPF :: $u[ClientCPF]
					</p>
					<span class='secondary-content'>
						<a 
							href='#cadastro'
							class='modal-trigger btn blue editGlobal' 
							ClientId='$u[ClientId]'
							metodoGet='getClientJSON'
							metodoSet='clientSet'
							chave='ClientId'
							form='#formClient'
							
						
						><i class='material-icons'>edit</i></a>
						<a class='btn orange getServClient' ClientId='$u[ClientId]'><i class='material-icons'>list</i></a>
						<a href='#venda'class='modal-trigger btn green sellService' ClientName='$u[ClientName]' ClientId='$u[ClientId]'><i class='material-icons'>add_shopping_cart</i></a>

					</span>
				</li>";
	}
	echo '</ul>';

}

function getServiceList(){ # Executa um Comando na Conexão
	/**
		Pega os Serviços para preencher o select
	**/
	$sql .= "select * from `service` ";
	
	$consulta = DBQ($sql);

	foreach($consulta as $u){
		echo "	<option value='$u[ServiceId]'>$u[ServiceName]</option>\n";
	}

}

function getService(){ # Executa um Comando na Conexão
	/**
		Escreve uma lista com os serviços na tabela service
	**/
	$sql .= "select * from `service` ";
	
	$consulta = DBQ($sql);
	echo '<ul class="collection">';
	foreach($consulta as $u){
		$img = !$u[ServiceImage] ? "<i class='material-icons circle'>assignment_ind</i>" : "<img src='$u[ServiceImage]' class='circle'>";

		echo "	<li class='collection-item avatar'>
					$img
					<span class='title '>$u[ServiceName]</span>
					<p>
						$u[ServiceDesc]
					</p>
					<p>
						Preço de referência :: R$ $u[ServiceDefVal] <br />(O preço final será confirmado após avaliação do cliente)
					</p>
					<span class='secondary-content'>
						<a 
							href='#cadastro' 
							class='modal-trigger btn blue edit editGlobal'	
							form='#formService'	
							ServiceId='$u[ServiceId]'
							metodoGet='getServiceJSON'
							metodoSet='serviceSet'
							chave='ServiceId'
							
						>

							<i class='material-icons'>edit</i>
						</a>
						
						<a class='btn red delService' ServiceId='$u[ServiceId]'><i class='nono material-icons'>delete_forever</i></a>

					</span>
				</li>";
	}
	echo '</ul>';

}

/**
	Abaixo os métodos. Esta página é chamada via POST e retorna um html que deverá preencher alguma parte do código
	A variável método define qual parte desde php vai rodar, podendo ser apresentadas mais variáveis
**/



if($_POST[metodo] == 'userAdd'){ # Executa um Comando na Conexão
	
	/**
		Adiciona um usuário na tabela
	**/
	
	$sql .= "	INSERT INTO `user`
					(UserName, UserLogin, UserPassword)
				VALUES
					('$_POST[UserName]', '$_POST[UserLogin]', sha2('$_POST[UserPassword]', '256'))";
	
	if(DBExecute($sql)){
		echo "ok"; 
	}else{
		echo "erro";
	}
}

if($_POST[metodo] == 'userSet'){ # Executa um Comando na Conexão
	$sql .= "	UPDATE `user` 
					SET 
						UserName = '$_POST[UserName]', ";
	if($_POST[UserPassword] != ""){
		$sql .= "		UserPassword = sha2('$_POST[UserPassword]', '256'), ";
	}
	$sql .= "
						UserLogin = '$_POST[UserLogin]'
					WHERE 
						UserId = $_POST[UserId]";
	// echo $sql;
	if(DBExecute($sql)){
		echo "ok"; 
	}else{
		echo "erro";
	}
}

if($_POST[metodo] == 'clientAdd'){
	
	$sql .= "INSERT INTO client
				(ClientName, ClientCPF, ClientZap, ClientImg)
				VALUES
				('$_POST[ClientName]', '$_POST[ClientCPF]', '$_POST[ClientZap]', '$_POST[ClientImg]');";
	if(DBExecute($sql)){
		echo "ok"; 
	}else{
		echo "erro";
	}
}

if($_POST[metodo] == 'flowAdd'){
	
	$sql .= "INSERT INTO flow
				(UserId, ClientId, ServiceId, FlowDesc, FlowDate, FlowPrice)
				VALUES
				('$_POST[UserId]','$_POST[ClientId]', '$_POST[ServiceId]', '$_POST[FlowDesc]', '$_POST[FlowDate]','$_POST[FlowPrice]');";
	if(DBExecute($sql)){
		echo "ok"; 
	}else{
		echo "erro";
	}
}

if($_POST[metodo] == 'serviceAdd'){
	
	$sql .= "INSERT INTO service
				(ServiceName, ServiceDesc, ServiceDefVal, ServiceImage)
				VALUES
				('$_POST[ServiceName]', '$_POST[ServiceDesc]', '$_POST[ServiceDefVal]', '$_POST[ServiceImage]');";
	if(DBExecute($sql)){
		echo "ok"; 
	}else{
		echo "erro";
	}
}

if($_POST[metodo] == 'serviceSet'){
	
	$sql .= "UPDATE service
				SET
					ServiceName = '$_POST[ServiceName]', 
					ServiceDesc = '$_POST[ServiceDesc]', 
					ServiceDefVal = '$_POST[ServiceDefVal]', 
					ServiceImage = '$_POST[ServiceImage]'
				WHERE 
					ServiceId = $_POST[ServiceId]";
	if(DBExecute($sql)){
		echo "ok"; 
	}else{
		echo "erro";
	}
}
if($_POST[metodo] == 'clientSet'){
	
	$sql .= "UPDATE client
				SET
					ClientName = '$_POST[ClientName]', 
					ClientCPF = '$_POST[ClientCPF]', 
					ClientZap = '$_POST[ClientZap]', 
					ClientImg = '$_POST[ClientImg]'
				WHERE 
					ClientId = $_POST[ClientId]";
	if(DBExecute($sql)){
		echo "ok"; 
	}else{
		echo "erro";
	}
}

if($_POST[metodo] == 'getServClient'){
	
	/**
		Escreve uma tabela, com os serviços na lançados para determinado cliente
	**/
	
	$sql .= "select f.*, s.ServiceName from `flow` f 
	left join service s on f.ServiceID = s.ServiceID 
	where ClientId = '$_POST[ClientId]'";
	
	$consulta = DBQ($sql);
	
	$totalD = 0;
	$totalR = 0;
	echo '<table>';
			echo "	<thead><tr>
					<th>#</th>
					<th>Item</th>
					<th>Descrição</th>
					<th>Valor</th>
					<th>Vencimento</th>
					<th>Pago?</th>
				</tr></thead>
				<tbody>";
	foreach($consulta as $u){
		
		// Soma o total de receitas e também o total de despesas
		if($u[FlowIn] == '0'){
			$totalD += $u[FlowPrice];
		}else{
			$totalR += $u[FlowPrice];
		}
		
		echo "	<tr>
					<td>$u[ServiceId]</td>
					<td>$u[ServiceName]</td>
					<td>$u[FlowDesc]</td>
					<td>R$ $u[FlowPrice]</td>
					<td>".date( "d-m-Y", strtotime( $u[FlowDate] ) )."</td>
				</tr>";
	}
	echo "<tfoot>
		<th>Total em aberto</th><td>$totalD</td>
		<th>Total fechado</th><td>$totalR</td>
		</tfoot>
		    </tbody>
			</table>";

}

if($_POST[metodo] == 'getServiceJSON'){

	$sql .= "select * from `service` where ServiceId = '$_POST[ServiceId]' ";
	$consulta = DBQ($sql);
	foreach($consulta as $u){
		$j[ServiceId]		=$u[ServiceId];
		$j[ServiceName]		=$u[ServiceName];
		$j[ServiceDefVal]	=$u[ServiceDefVal];
		$j[ServiceDesc]		=$u[ServiceDesc];
		$j[ServiceImage]	=$u[ServiceImage];	
	}
	
	echo json_encode($j);
}
if($_POST[metodo] == 'getUserJSON'){
	
	$sql .= "select * from `user` u where UserId = '$_POST[UserId]'";
	$consulta = DBQ($sql);
	foreach($consulta as $u){
		$j[UserId]		=$u[UserId];
		$j[UserName]	=$u[UserName];
		$j[UserLogin]	=$u[UserLogin];
	}
	
	echo json_encode($j);
}
if($_POST[metodo] == 'getClientJSON'){
	
	$sql .= "select * from `client` u where ClientId = '$_POST[ClientId]'";
	$consulta = DBQ($sql);
	foreach($consulta as $u){
		$j[ClientId]		=$u[ClientId];
		$j[ClientName]	=$u[ClientName];
		$j[ClientCPF]	=$u[ClientCPF];
		$j[ClientZap]	=$u[ClientZap];
		$j[ClientImg]	=$u[ClientImg];
	}
	
	echo json_encode($j);
}

?>
