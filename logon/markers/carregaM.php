<?php
			require '../../db/bdajax.php';

			$result = DBRead("markers");

			$total = sizeof($result);
			$atual = 0;
			$json= "[";
			foreach ($result as $value) {
				
				$value['name']    = DBEscape($value['name']);
				$value['address'] = DBEscape($value['address']);
				$value['lat']     = DBEscape($value['lat']);
				$value['lng']     = DBEscape($value['lng']);
				$value['type']    = DBEscape($value['type']);
				$value['creater'] = DBEscape($value['creater']);
				
				$value['foto'] = DBEscape($value['foto']);	

				$local ='';
				if ($value['foto'] != null) {
					$dados = DBRead('arquivo',"WHERE cod = ".$value['foto']."",'arquivo');
					foreach ($dados as $key => $valor) {
						$local = $valor['arquivo'];
					}
				}
				$value['foto'] = $local;
				

				$json .="{";

				$json .="\"name\": ";
				$json .="\"{$value['name']}\",";
				$json .="\"address\": ";
				$json .="\"{$value['address']}\",";
				$json .="\"lat\": ";
				$json .="{$value['lat']},";
				$json .="\"lng\": ";
				$json .="{$value['lng']},";
				$json .="\"type\": ";
				$json .="\"{$value['type']}\",";
				$json .="\"creater\": ";
				$json .="\"{$value['creater']}\",";
				$json .="\"foto\": ";
				$json .="\"{$value['foto']}\"";

				if(($total-1)!=$atual)
					$json .="},";
				else
					$json .="}";
				
				$atual = $atual+1; 
			}
			$json .="]";
			echo $json;
?>