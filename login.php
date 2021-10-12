

<?php
include "php/database.php";
if($_POST[UserLogin] and $_POST[UserPassword]){
	$sql = "select * from user where UserLogin = '$_POST[UserLogin]' and UserPassword = sha2('$_POST[UserPassword]', '256')";
	echo $sql;
	$lg = DBExecute($sql);
	var_dump($lg);
	if(mysqli_num_rows($lg) == 1){
		$retorno = mysqli_fetch_assoc($lg);
		session_start();
		$_SESSION[UserId] = $retorno[UserId];
		$_SESSION[UserName] = $retorno[UserName];
		$_SESSION[UserLogin] = $retorno[UserLogin];
		$_SESSION[UserPassword] = $retorno[UserPassword];
		header("location: index.php");
	}else{
		$erro = "Dados incorretos, tente novamente!";
	}	
	
}

?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GE CLARO STUDIO</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
  <link rel="stylesheet" href="css/estilo.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  
	<link rel="apple-touch-icon" sizes="57x57" href="fav/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="fav/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="fav/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="fav/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="fav/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="fav/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="fav/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="fav/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="fav/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192"  href="fav/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="fav/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="fav/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="fav/favicon-16x16.png">
	<link rel="manifest" href="fav/manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="fav/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">

</head>

<div class="container">
	<div class="row">
	<div class="section"></div>
   <main>
    <center>
     <div class="container">
	 
        <div  class="z-depth-3 y-depth-3 x-depth-3 grey lighten-4 orange-text text-darken-3 row" style="display: inline-block; padding: 32px 48px 0px 48px; border: 1px; margin-top: 100px; solid #EEE;">
        <div class="section"><img width="60%" class="logo" src="logo/md03.png"></div>
		<div class="section"></div>
		<div class="section"><i class="mdi-alert-error red-text"></i></div>
<?php
	if($erro){
		echo "<h5>$erro</h5>";
	}
?> 
<form method="post">
	<div class='row'>
	  <div class='input-field col s12'>
		<input class='validate' type="text" name='UserLogin' id='email' required placeholder=''/>
		<label for='email'>Login</label>
	  </div>
	</div>
	<div class='row'>
	  <div class='input-field col m12'>
		<input class='validate' type='password' name='UserPassword' id='password' required placeholder=''/>
		<label for='password'>Senha</label>
	  </div>
	  <label style='float: right;'>
	  <a><b style="color: #F5F5F5;">Sem Essa!</b></a>
	  </label>
	</div>
	<br/>
	<center>
	  <div class='row'>
		<button style="left: 50%; margin-right: -50%; transform: translate(-50%, -50%);"  type='submit' name='btn_login' class='col  s6 btn btn-large white black-text  waves-effect z-depth-1 y-depth-1'>Login</button>
	  </div>
	</center>
</form>
        </div>

       </div>
      </center>
      </main>
    

	</div>
</div>



	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<script src="JS/serialize.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>