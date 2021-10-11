<?php

	/**
	
		Atualiza de forma prática o site da Geslane com o Github
	
	**/
	
	$command = 'cd /var/www/html/ggClaro && git pull && git add . && git commit -m "Atualização" && git push origin main';
	$sh = "echo yuk11nn4 | su -c '$command' -s /bin/bash ilunne";

	$output = shell_exec($sh);
	echo "<pre>".$output."</pre>";

	exit;
?>