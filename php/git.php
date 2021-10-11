<?php
	$command = 'cd /var/www/html/ggClaro && git pull && git add . && git commit -m "Atualização" && git push origin main';
	echo $command;
	echo shell_exec('$command');
	$output = shell_exec($command);
	echo "<pre>".$output."</pre>";

	exit;
?>