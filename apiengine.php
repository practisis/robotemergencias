<?php

function getUrlAPI($url, $parametros){
	//funcion para interactuar con el API
	global $token;
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch,CURLOPT_POST, sizeof($parametros));
    curl_setopt($ch,CURLOPT_POSTFIELDS, $parametros);
	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; .NET CLR 1.1.4322)');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
	curl_setopt($ch, CURLOPT_TIMEOUT, 5);
	$data = curl_exec($ch);
	$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	curl_close($ch);
	return ($httpcode>=200 && $httpcode<300) ? $data : false;
}

function correApi($cualapi, $eltexto, $elman=null){
	//funcion para llamar al API
	global $gbd;
	$valorresultado='';
	$textOut='0';
	$timelapso='';
	
	//inicia codigo del api engine
	$sql= "select link from api where id=".$cualapi; //orden por la entrada
	$stmt = $gbd -> prepare($sql);
	$stmt -> execute();
	foreach($stmt -> fetchAll(PDO::FETCH_ASSOC) as $key => $value){
			$url= $value['link'];
	}
	$data_to_post = array();
	$sql= "select variable, dato, tipodato, justificacion from apidetalle where idapi=".$cualapi; //orden por la entrada
	$stmt = $gbd -> prepare($sql);
	$stmt -> execute();
	foreach($stmt -> fetchAll(PDO::FETCH_ASSOC) as $key => $value){
			$tvariable= $value['variable'];
			if ($value['tipodato']=='fixed'){
				$tdato= $value['dato'];
				$data_to_post[$tvariable] = $tdato;
			}
			else if($value['tipodato']=='date'){
				$hayfecha=tieneFecha($eltexto);
				if ($hayfecha=='date error'){
					$mensajeError=$value['justificacion'];
					return $mensajeError;
					exit;
				}
				else {
					$mifecha=explode("|", $hayfecha);
					$tdato=$mifecha[0];
					$data_to_post[$tvariable] = $tdato;
					$timelapso=$mifecha[1];
				}
				
			}
			else if($value['tipodato']=='geo'){
					//$elman='340';
					$sql= "select data from flujodata where idcontacto=".$elman." and idflujo=17"; //orden por la entrada //quemado
					$stmt = $gbd -> prepare($sql);
					$stmt -> execute();
					foreach($stmt -> fetchAll(PDO::FETCH_ASSOC) as $key => $value){
							$latlong= explode(",",$value['data']);	
					}
				if ($tvariable=='lat'){	
					$data_to_post[$tvariable] = $latlong[1];
				}
				else if ($tvariable=='lon'){
					$data_to_post[$tvariable] = $latlong[0];
				}
			}
			
			//aqui viene otro tipo de dato....el multiple dato
			//aqui pueden venir otro tipo de datos que requieran los API para trabajar
			//XXXXXXXXXXXXXXXXXXXXXXXXXXXXX
			//XXXXXXXXXXXXXXXXXXXXXXXXXXXXX
			//XXXXXXXXXXXXXXXXXXXXXXXXXXXXX
			//XXXXXXXXXXXXXXXXXXXXXXXXXXXXX
			//XXXXXXXXXXXXXXXXXXXXXXXXXXXXX
			
	}

	
	$salida=getUrlAPI($url,$data_to_post);
	$jsonout=json_decode($salida);
	
	//ahora si saco el data del map y hago los ifs
	$sql= "select mapvar,condicion, tif, tipo  from apicondicion where idapi=".$cualapi; //orden por la entrada
	$stmt = $gbd -> prepare($sql);
	$stmt -> execute();
	foreach($stmt -> fetchAll(PDO::FETCH_ASSOC) as $key => $value){
			$mapvar= $value['mapvar'];
			$valorResultado=$jsonout->{$mapvar};
			$textif=str_replace('mapvar',$valorResultado, $value['condicion']);
			eval ('if ('.$textif.'){$respuestaTemporal="si";} else {$respuestaTemporal="no";}');
			if ($respuestaTemporal=="si"){
				if 	($value['tipo']=='texto'){
					$textOutTemp=str_replace('mapvar',$valorResultado, $value['tif']); //reemplazo variable mapvar en respuesta - contexto valor
					$textOut=str_replace('timelapso',$timelapso, $textOutTemp); //reemplazo variable timelapso en respuesta - contexto tiempo
				}			
				//AQUI FALTAN OTRO TIPO DE RESPUESTAS ANTES RESULTADOS DEL API, SOLO ESTA LA DEL TEXTO, QUE ES LA QUE SE ME OCURRE AHORITA
				//XXXXXXXXXXXXXXXXXXXXXXX
				//XXXXXXXXXXXXXXXXXXXXXXX
				//XXXXXXXXXXXXXXXXXXXXXXX
				//XXXXXXXXXXXXXXXXXXXXXXX
				//XXXXXXXXXXXXXXXXXXXXXXX
				
			}
	}
	return $textOut;
}


?>
