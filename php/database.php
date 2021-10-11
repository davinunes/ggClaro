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
						<a class='btn blue editUser' userid='$u[UserId]'><i class='material-icons'>edit</i></a>
						<a class='btn green senhaUser' userid='$u[UserId]'><i class='material-icons'>phonelink_lock</i></a>
						<a class='btn red removeUser' userid='$u[UserId]'><i class='material-icons'>delete_forever</i></a>
					</span>
				</li>";
	}
	echo '</ul>';

}

function setUsuarios(){ # Executa um Comando na Conexão
	$sql .= "select * from `user` u ";
	
	$consulta = DBExecute($sql);
	echo "<pre>";
	$senha=sha2('yuk11nn4', '256');
	echo "$senha <br />";
	
	var_dump($consulta);
	echo "</pre>";
}



?>