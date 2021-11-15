<?php
include "database.php";
validar();


	echo '<div id="ultimasVendas"></div>';


	$sql .= " select f.*, s.ServiceName, c.ClientName 
				from `flow` f 
				left join service s on f.ServiceID = s.ServiceID 
				left join client c on c.ClientId = f.ClientId
				order by FlowId desc";
	
	$consulta = DBQ($sql);
	if($consulta){
			$totalD = 0;
			$totalR = 0;
			echo '<table>';
					echo "	<thead><tr>
								<th>#</th>
								<th>Item</th>
								<th></th>
								<th></th>
								<th></th>
								<th>Valor</th>
							</tr>
						</thead>
						<tbody>";
			foreach($consulta as $u){
				$data = date( "d-m-Y", strtotime( $u[FlowDate] ) );
				// Soma o total de receitas e também o total de despesas
				if($u[FlowIn] == '1'){
					$totalR += $u[FlowPrice];
					$icone = '<i class="material-icons">done_all</i>';
					$cor = 'teal lighten-5';

				}else{
					$totalD += $u[FlowPrice];
					$icone = '';
					$cor = '';
				}
				echo "	<tr class='$cor'>
							<td>$u[FlowId]</td>
							<td colspan='4'>
								<b>$u[ClientName] <br /></b>
								$u[ServiceName] <br />
								$u[FlowDesc] <br />
								
								$data 
							</td>
							
							
							<td>R$ $u[FlowPrice]</td>
						</tr>";
			}
			echo "	<tfoot class='purple lighten-5'>
						<tr>
							<th colspan='2'>Total a receber</th><td>R$ $totalD</td>
							<th colspan='2'>Total recebido</th><td>R$ $totalR</td>
						</tr>
					</tfoot>
				</tbody>
				</table>";
		
		
	}
	
?>