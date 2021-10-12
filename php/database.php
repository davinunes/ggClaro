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
	session_start();
	if(!isset($_SESSION[UserId])){
		header("location: login.php");
		exit;
	}
}

function getUsuarios(){ # Executa um Comando na Conexão
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
						<a class='btn blue editUser' UserId='$u[UserId]'><i class='material-icons'>edit</i></a>
						<a class='btn green senhaUser' UserId='$u[UserId]'><i class='material-icons'>phonelink_lock</i></a>
						<a class='btn red removeUser' UserId='$u[UserId]'><i class='material-icons'>delete_forever</i></a>
					</span>
				</li>";
	}
	echo '</ul>';

}

function getClientes(){ # Executa um Comando na Conexão
	$sql .= "select * from `client` c ";
	
	$consulta = DBQ($sql);
	echo '<ul class="collection">';
	foreach($consulta as $u){
		
		echo "	<li class='collection-item avatar'>
					<i class='material-icons circle'>assignment_ind</i>
					<span class='title'>$u[ClientName]</span>
					<p>
						CPF :: $u[ClientCPF]
					</p>
					<span class='secondary-content'>
						<a class='btn blue editClient' ClientId='$u[ClientId]'><i class='material-icons'>edit</i></a>
						<a href='#venda'class='modal-trigger btn green sellService' ClientName='$u[ClientName]' ClientId='$u[ClientId]'><i class='material-icons'>add_shopping_cart</i></a>

					</span>
				</li>";
	}
	echo '</ul>';

}

function getServiceList(){ # Executa um Comando na Conexão
	$sql .= "select * from `service` ";
	
	$consulta = DBQ($sql);

	foreach($consulta as $u){
		echo "	<option value='$u[ServiceId]'>$u[ServiceName]</option>\n";
	}

}

function getService(){ # Executa um Comando na Conexão
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
						Preço de referência :: R$ $u[ServiceDefVal] (O preço final será confirmado após avaliação do cliente)
					</p>
					<span class='secondary-content'>
						<a class='btn blue editService' ServiceId='$u[ServiceId]'><i class='material-icons'>edit</i></a>
						<a class='btn red delService' ServiceId='$u[ServiceId]'><i class='material-icons'>delete_forever</i></a>

					</span>
				</li>";
	}
	echo '</ul>';

}

if($_POST[metodo] == 'userAdd'){ # Executa um Comando na Conexão
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

?>