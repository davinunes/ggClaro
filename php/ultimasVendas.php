<?php
include "database.php";
validar();
getClientes();

	echo '<div id="ultimasVendas"></div>';


	$sql .= " select f.*, s.ServiceName 
				from `flow` f 
				left join service s on f.ServiceID = s.ServiceID 
				order by FlowId desc";
	
	$consulta = DBQ($sql);
	
?>