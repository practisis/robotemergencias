<?php

//obtiene los datos del POST
$content .= file_get_contents("php://input");
$update = json_decode($content, true);
if (!$update) {
  echo 'algo paso..no hay mensaje';
  exit;
}

//conexiones
include 'dbcon.php';
$gbd = new DBConn();
//include 'dbcon3.php';
//$gbd3 = new DBConn3();

function tieneFecha($text){
	
			$nadaDeFecha=0;
			$pos1 = strpos(strtoupper($text), "HOY");
			if ($pos1  !== false) {
				$nadaDeFecha=1;			
				return date("Y-m-d",strtotime( '-7 hours' ))."|hoy|".date("Y-m-d",strtotime( '-7 hours' ));
			}
			
			$pos1 = strpos(strtoupper($text), "AYER");
			if ($pos1  !== false) {
				$nadaDeFecha=1;
				return date("Y-m-d", strtotime( '-1 days' ))."|"."ayer"."|".date("Y-m-d", strtotime( '-1 days' ));
			}
			
			$pos1 = strpos(strtoupper($text), "LUNES");
			if ($pos1  !== false) {
				$nadaDeFecha=1;
				return date("Y-m-d", strtotime('last Monday'))."|lunes|".date("Y-m-d", strtotime('last Monday'));				
			}
			$pos1 = strpos(strtoupper($text), "MARTES");
			if ($pos1  !== false) {
				$nadaDeFecha=1;
				return date("Y-m-d", strtotime('last Tuesday'))."|martes|".date("Y-m-d", strtotime('last Tuesday'));				
			}
			
			$pos1 = strpos(strtoupper($text), "MIERCOLES");
			if ($pos1  !== false) {
				$nadaDeFecha=1;
				return date("Y-m-d", strtotime('last Wednesday'))."|miercoles|".date("Y-m-d", strtotime('last Wednesday'));				
			}
			$pos1 = strpos(strtoupper($text), "JUEVES");
			if ($pos1  !== false) {
				$nadaDeFecha=1;
				return date("Y-m-d", strtotime('last Thursday'))."|jueves|".date("Y-m-d", strtotime('last Thursday'));								
			}
			$pos1 = strpos(strtoupper($text), "VIERNES");
			if ($pos1  !== false) {
				$nadaDeFecha=1;
				return date("Y-m-d", strtotime('last Friday'))."|viernes|".date("Y-m-d", strtotime('last Friday'));											
			}
			$pos1 = strpos(strtoupper($text), "SABADO");
			if ($pos1  !== false) {
				$nadaDeFecha=1;
				return date("Y-m-d", strtotime('last Saturday'))."|sabado|".date("Y-m-d", strtotime('last Saturday'));															
			}
			$pos1 = strpos(strtoupper($text), "DOMINGO");
			if ($pos1  !== false) {
				$nadaDeFecha=1;
				return date("Y-m-d", strtotime('last Sunday'))."|domingo|".date("Y-m-d", strtotime('last Sunday'));															
			}
			$pos1 = strpos(strtoupper($text), "ESTA SEMANA");
			if ($pos1  !== false) {
				$nadaDeFecha=1;
				return date("Y-m-d", strtotime('last Monday'))."|esta semana, desde el lunes|".date("Y-m-d");															
			}
			
			$pos1 = strpos(strtoupper($text), "SEMANA PASADA");
			if ($pos1  !== false) {
				$nadaDeFecha=1;
				return date("Y-m-d", strtotime('Monday previous week'))."|semana pasada, de lunes a domingo en|".date("Y-m-d", strtotime('Sunday previous week'));															
			}
			
			$pos1 = strpos($text, "-");
			if ($pos1  !== false) {
				$nadaDeFecha=1;		
				$tempday="2016-".substr($text, $pos1-2,2)."-".substr($text, $pos1+1,2);
				if (checkdate(substr($text, $pos1-2,2),substr($text, $pos1+1,2) , 2016)==false){
						//reviso si es un mes
						if (substr($text, $pos1-2,2)=='01'){
							return date('Y-01-01')."|enero|".date('Y-m-d', strtotime("last day of january"));
						}
						else if (substr($text, $pos1-2,2)=='02'){
							return date('Y-02-01')."|febrero|".date('Y-m-d', strtotime("last day of february"));
						}
						else if (substr($text, $pos1-2,2)=='03'){
							return date('Y-03-01')."|marzo|".date('Y-m-d', strtotime("last day of march"));
						}
						else if (substr($text, $pos1-2,2)=='04'){
							return date('Y-04-01')."|abril|".date('Y-m-d', strtotime("last day of april"));
						}
						else if (substr($text, $pos1-2,2)=='05'){
							return date('Y-05-01')."|mayo|".date('Y-m-d', strtotime("last day of may"));
						}
						else if (substr($text, $pos1-2,2)=='06'){
							return date('Y-06-01')."|junio|".date('Y-m-d', strtotime("last day of june"));
						}
						else if (substr($text, $pos1-2,2)=='07'){
							return date('Y-07-01')."|julio|".date('Y-m-d', strtotime("last day of july"));
						}
						else if (substr($text, $pos1-2,2)=='08'){
							return date('Y-08-01')."|agosto|".date('Y-m-d', strtotime("last day of august"));
						}
						else if (substr($text, $pos1-2,2)=='09'){
							return date('Y-09-01')."|septiembre|".date('Y-m-d', strtotime("last day of september"));
						}
						else if (substr($text, $pos1-2,2)=='10'){
							return date('Y-10-01')."|octubre|".date('Y-m-d', strtotime("last day of october"));
						}
						else if (substr($text, $pos1-2,2)=='11'){
							return date('Y-11-01')."|noviembre|".date('Y-m-d', strtotime("last day of november"));
						}
						else if (substr($text, $pos1-2,2)=='12'){
							return date('Y-012-01')."|diciembre|".date('Y-m-d', strtotime("last day of december"));
						}
						else {
							return "date error";
						}
				}
				else{
						return $tempday."|".$tempday."|".$tempday;
				}
			}
			
			if ($nadaDeFecha==0){
					return "date error";
			}
			
			////AQUI PUEDO MANEJAR MAS DATOS, POR EJEMPLO MANANA, PASADO MANANA, ETC!!!
			//XXXXXXXXXXXXXXXXXXXXXXXXx
			//XXXXXXXXXXXXXXXXXXXXXXXXx
			//XXXXXXXXXXXXXXXXXXXXXXXXx
			//XXXXXXXXXXXXXXXXXXXXXXXXx
			
}



include 'apiengine.php';

function getUrlContentTelegram($comando,$parametros){
	//funcion para interactuar con Telegram
	global $token;
	$url="https://api.telegram.org/bot".$token."/".$comando;
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

function conversa($mensaje){
	global $idUsuario;
	$data_to_post = array();
	$data_to_post['text'] = $mensaje;
	$data_to_post['chat_id'] = $idUsuario;
	getUrlContentTelegram('sendMessage',$data_to_post);	
}

function conversaPOS($mensaje){
	global $idUsuario;
	$data_to_post = array();
	$data_to_post['text'] = $mensaje;
	$data_to_post['chat_id'] = $idUsuario;	
	$keyboard = array(array(array("text" => "Compartir Ubicación", "request_location" => true)));
    $resp = array("keyboard" => $keyboard,"resize_keyboard" => true,"one_time_keyboard" => true);
    $reply = json_encode($resp);
    $data_to_post['reply_markup'] = $reply;
    getUrlContentTelegram('sendMessage',$data_to_post);	
	
}

function saltabotFormulario($salto){
	global $clienteid;
	global $gbd;
	global $idcontacto;
	
	//borra datos superiores del formulario
	$sql= "delete from flujodata where idcontacto=".$idcontacto." and idflujo>=".$salto;
	$stmt = $gbd -> prepare($sql);
	$stmt -> execute();
	
	//ve que datos tienes que llenar
	$sql= "select flujo.id, flujodata.id as ids from flujo left join flujodata on flujo.id=flujodata.idflujo where idcliente=".$clienteid." and flujo.id<".$salto." order by id";
	$stmt = $gbd -> prepare($sql);
	$stmt -> execute();
	foreach($stmt -> fetchAll(PDO::FETCH_ASSOC) as $key => $value){
		if ($value['ids']>0){
			//no se llena, ya esta
		}
		else{
			//llena lineas faltantes
			$sql2 = "insert into flujodata (idflujo, idcontacto, data) values (".$value['id'].",".$idcontacto.",'Salto por exepcion directa')";				
			$stmt2 = $gbd -> prepare($sql2);
			$stmt2 -> execute();
		}
	}
	//ahora envia el mensaje
	$sql= "select flujo.id as ids, pregunta from flujo left join flujodata on flujodata.idflujo=flujo.id and flujodata.idcontacto=".$idcontacto." where flujo.idcliente=".$clienteid."  order by flujodata.idflujo desc, flujo asc limit 1";
	$stmt = $gbd -> prepare($sql);
	$stmt -> execute();
	foreach($stmt -> fetchAll(PDO::FETCH_ASSOC) as $key => $value){
			$response=$value['pregunta']; 
	}
	
	//Pone opciones en saltobot
	$sql= "select opcion, opcionnumero from flujoopciones where idflujo=".$salto." order by opcionnumero asc";
				$stmt = $gbd -> prepare($sql);
				$stmt -> execute();
				$tienefooter=0;
				foreach($stmt -> fetchAll(PDO::FETCH_ASSOC) as $key => $value){
					$response.=PHP_EOL.$value['opcionnumero'].") ".$value['opcion']; //ve la pregunta
					$footMensaje.=$value['opcionnumero'].",";
					$tienefooter=$tienefooter+1;
				}
				if ($tienefooter>0){
					$footMensaje = substr($footMensaje, 0, -1); 
					$response=$response.PHP_EOL.PHP_EOL."¿".$footMensaje."?";
				}
	
	
	conversa($response);						
}

function botFormulario($adonde, $mimensaje){
	global $clienteid;
	global $gbd;
	global $idcontacto;
	$response=0;
	
	//Ve si tiene formulario ya activo
	$sql= "select count(flujo.id) as ids from flujo, flujodata where idcliente=".$clienteid." and idcontacto=".$idcontacto;	
	$stmt = $gbd -> prepare($sql);
	$stmt -> execute();
	$cuantos=0;
	foreach($stmt -> fetchAll(PDO::FETCH_ASSOC) as $key => $value){
		$cuantos=$value['ids'];
	}
	$tieneformulario= $cuantos;
	
	//borra los registros anteriores si es un start.
	if ($mimensaje=='init'){
		$sql1 = "delete from flujodata where idcontacto=".$idcontacto;				
		$stmt1 = $gbd -> prepare($sql1);
		$stmt1 -> execute();
		$tieneformulario=0;
	}
	
	//ahora ve el contacto en que etapa esta y da respuesta
	if ($tieneformulario>0){
		 //aqui va la logica del formulario
		$sql= "select validacion,flujo.id,flujodata.data  from flujo left join flujodata on flujodata.idflujo=flujo.id and flujodata.idcontacto=".$idcontacto." where flujo.idcliente=".$clienteid."  order by flujodata.idflujo desc, flujo asc limit 1";
		$stmt = $gbd -> prepare($sql);
		$stmt -> execute();
		foreach($stmt -> fetchAll(PDO::FETCH_ASSOC) as $key => $value){
			$validacion=$value['validacion']; //que validación aplicar
			$idflujo=$value['id']; //que id del flujo se encuentra
			$tienedata=$value['data']; //que id del flujo se encuentra
		}
		///si es la ultima respuesta del formulario, no agrega uno mas y salta
		if ($validacion=='Final'){
			//no agrega respuesta, no hace nada.
		}
		else{
			////valida respuesta ******************************************	
			preg_match("/".$validacion."/", $mimensaje, $output_array);
			$result = count($output_array);
			if ($result>0){
				//inserta flujo - next - es el tipico movimiento
				$sql1 = "insert into flujodata (idflujo, idcontacto, data) values (".$idflujo.",".$idcontacto.",'".$mimensaje."')";				
				$stmt1 = $gbd -> prepare($sql1);
				$stmt1 -> execute();
				
				//Logica de flujo a respuestas - Goto
				$opciontif="next:";
				//ve a donde enviar
				if (is_numeric($mimensaje)){
					$sql= "select tif from flujoopciones where idflujo=".$idflujo." and opcionnumero=".$mimensaje;
					$stmt = $gbd -> prepare($sql);
					$stmt -> execute();
					foreach($stmt -> fetchAll(PDO::FETCH_ASSOC) as $key => $value){
						$opciontif=$value['tif'];
					}
				}
				$dondeVoy = explode(":",$opciontif);
				if ($dondeVoy[0]=="goto"){
					$response=$dondeVoy[0]."+".$dondeVoy[1];
					//ve que datos tienes que llenar
					$sql= "select id from flujo where idcliente=".$clienteid." and id>".$idflujo." and id<".$dondeVoy[1];
					$stmt = $gbd -> prepare($sql);
					$stmt -> execute();
					foreach($stmt -> fetchAll(PDO::FETCH_ASSOC) as $key => $value){
						//llena lineas faltantes
						$sql2 = "insert into flujodata (idflujo, idcontacto, data) values (".$value['id'].",".$idcontacto.",'Salto por Goto')";				
						$stmt2 = $gbd -> prepare($sql2);
						$stmt2 -> execute();
					}
				}
									
				//consulta respuesta
				$sql= "select flujo.id as ids, pregunta from flujo left join flujodata on flujodata.idflujo=flujo.id and flujodata.idcontacto=".$idcontacto." where flujo.idcliente=".$clienteid."  order by flujodata.idflujo desc, flujo asc limit 1";
				$stmt = $gbd -> prepare($sql);
				$stmt -> execute();
				foreach($stmt -> fetchAll(PDO::FETCH_ASSOC) as $key => $value){
					$flujonext=$value['ids'];
					$response=$value['pregunta']; //ve la pregunta
				}
				
				//ve si es compuesta la pregunta
				$sql= "select opcion, opcionnumero from flujoopciones where idflujo=".$flujonext." order by opcionnumero asc";
				$stmt = $gbd -> prepare($sql);
				$stmt -> execute();
				$tienefooter=0;
				foreach($stmt -> fetchAll(PDO::FETCH_ASSOC) as $key => $value){
					$response.=PHP_EOL.$value['opcionnumero'].") ".$value['opcion']; //ve la pregunta
					$footMensaje.=$value['opcionnumero'].",";
					$tienefooter=$tienefooter+1;
				}
				if ($tienefooter>0){
					$footMensaje = substr($footMensaje, 0, -1); 
					$response=$response.PHP_EOL.PHP_EOL."¿".$footMensaje."?";
				}
				
				//ve la opcion de respuesta es un API
				if($dondeVoy[0]=="api"){
					$response=correApi($dondeVoy[1], '',$idcontacto);
					$response="Gracias! Ayuda está en camino"; //Aqui hay un error, estoy quemando la solucion.
				}
			}
		}
	}		
	else {
		//si no tienes etapa creada, valida si eres funcion nueva y creacmos el primer paso del formulario.
		if ($mimensaje=='init'){
				//inicializa forms
				$sql= "select id as ids, pregunta from flujo where idcliente=".$clienteid." order by id asc limit 1";
				$stmt = $gbd -> prepare($sql);
				$stmt -> execute();
				$idflujodata=0;
				$preguntaInicial='';
				foreach($stmt -> fetchAll(PDO::FETCH_ASSOC) as $key => $value){
					$idflujodata=$value['ids']; 
				}
				if ($idflujodata==0){
					//no crea formularios porque no tiene plantilla
					conversa("error bot 5012: no tengo plantilla para iniciar un formulario");
				}
				else{
					//crear primera linea del formulario
					$sql1 = "insert into flujodata (idflujo, idcontacto, data) values (".$idflujodata.",".$idcontacto.",'Inicia Forma')";				
					$stmt1 = $gbd -> prepare($sql1);
					$stmt1 -> execute();
					//ve que respuesta le debe dar 
					$sql= "select pregunta, validacion from flujo left join flujodata on flujodata.idflujo=flujo.id and flujodata.idcontacto=".$idcontacto." where flujo.idcliente=".$clienteid."  order by flujodata.idflujo desc, flujo asc limit 1";
					$stmt = $gbd -> prepare($sql);
					$stmt -> execute();
					$nopost=0;
					foreach($stmt -> fetchAll(PDO::FETCH_ASSOC) as $key => $value){
						$preguntaInicial=$value['pregunta']; //ve la pregunta
						if ($value['validacion']=='Geo'){
							$preguntaInicial="Por favor autorizame a acceder a tu ubicación.";
							conversaPOS($preguntaInicial);
							$nopost=1;
						}
					}
					if ($nopost==0){
						conversa($preguntaInicial); //esto porque el reply es siempre cero porque ya lo procesa.
					}
				}
		}
		//si no es init no hace nada.
	}
	return $response;
}


function equivalencias($text){
	//equivalencias logicas para transformar 
	global $gbd;
	global $clienteid;
	
	$sql= "select * from equivalencias where idcliente=".$clienteid." order by id"; //orden por la entrada
	$stmt = $gbd -> prepare($sql);
	$stmt -> execute();
	$newphrase=$text;
	foreach($stmt -> fetchAll(PDO::FETCH_ASSOC) as $key => $value){
		$newphrase  = strtoupper($newphrase);
		$elstring= $value['arrayentrada'];
		$healthy = explode(",", $elstring);
		$yummy   = $value['resultado'];
		$newphrase = str_replace($healthy, $yummy, $newphrase);		
	}
	return $newphrase;
}


function databank($text){
		global $clienteid;
		global $gbd;
		global $idcontacto;		
		global $idUsuario;
		
		$tienecontenido=0;
		$text=equivalencias($text);
		
		//ve las expeciones del botexpeciones
		$sql= "select * from botexepcion where idcliente=".$clienteid." order by id"; //orden por la entrada
		$stmt = $gbd -> prepare($sql);
		$stmt -> execute();
		foreach($stmt -> fetchAll(PDO::FETCH_ASSOC) as $key => $value){	
			///bot de expeción regresa un texto
			if ($value['accion']=='texto'){
				$elstring= $value['keyword'];
				$pos = strpos(strtoupper($text), $elstring);
				if ($pos === false) {}
				else{
						$tienecontenido=1;	
						return $value['detalle'];
				}	
			}
			//bot expecion regresa el inicio del formulario
			else if ($value['accion']=='botformulario'){
				$elstring= $value['keyword'];
				$pos = strpos(strtoupper($text), $elstring);
				if ($pos === false) {}
				else{
						$tienecontenido=1;	
						if ($value['detalle']=='init'){
							botFormulario($idUsuario, 'init');
							return "nocomment";
						}
						else{
							saltabotFormulario($value['detalle']);
							return "nocomment";
						}
				}
			}
			else if ($value['accion']=='api'){
				$elstring= $value['keyword'];
				$pos = strpos(strtoupper($text), $elstring);
				if ($pos === false) {}
				else{
					$tienecontenido=1;
					$result=correApi($value['detalle'], $text);
					return $result;
				}
			}
		}
		if ($tienecontenido==0){
			return 0;			
		}		
}

function robot($adonde, $mimensaje){
		//este es el procesamiento del robot principal
		global $mibotAIML;
		
		$personalidad="0";	
		
		//BOT EXCEPCION
		$personalidad = databank($mimensaje,$adonde);
		
		//BOT DE FORMULARIO
		if ($personalidad=="0"){
			$personalidad=botFormulario($adonde, $mimensaje);
		}	
		
		//BOT BASE
		if ($personalidad=="0"){
			///// si no puedo con datos, entonces le doy a la personalidad estandar del ente
				$display = '';
				$options = array(
				'say'       => FILTER_SANITIZE_STRING,
				'format'    => FILTER_SANITIZE_STRING,
				'bot_id'    => FILTER_SANITIZE_STRING,
				'convo_id'  => array(
				'filter'    => FILTER_CALLBACK,
				'options'   => 'validateConvoId'
				));
				$options = array(
				CURLOPT_USERAGENT => 'Program_O_XML_API',
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_POST => true,
				);
				$ch = curl_init("http://practisis.net/akanedemo/chatbot/conversation_start.php");
				curl_setopt_array($ch, $options);
				$arrayseva = array('say' => $mimensaje,'format' => 'json', 'bot_id' => $mibotAIML, 'convo_id' => 'np0l47v7bpmg9k4cfi5rnkftn41');
				curl_setopt($ch, CURLOPT_POSTFIELDS, $arrayseva);
				$data = curl_exec($ch);
				curl_close($ch);
				$obj = json_decode($data);
				$resultado= $obj->{'botsay'};				
		}
		else{
			$resultado=$personalidad;
		}
		//$repgrabarchat=grabarchat($text,$resultado,$target); //graba el texto del cliente y la respuesta del bot (cualquier que sea)
		if (strlen($resultado)>0){
			if ($resultado=="nocomment"){
				//no hace ningun coment extra
			}
			else{
				conversa($resultado);
			}
		}
		
		////falta el gestor de iniciativas y grabar el texto y la respuesta del cliente.
		//BOT DE INICIATIVAS
		
		
}

// xxxxxxxxxxxxxxxxxxxxxxxxxxxxxx  inicia flujo de datos - código que corre, el resto son funciones xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx

//Saca datos principales mensaje
$idUsuario=$update["message"]["from"]["id"];
$mensaje =$update["message"]["text"];
$locacion1=$update["message"]["location"]["latitude"];
$locacion2=$update["message"]["location"]["longitude"];

//aqui tengo que grabar en la BD...
//ver esto....

$sql= "select id from contacts where idclient=".$clienteid." and telegramid=".$idUsuario;
$stmt = $gbd -> prepare($sql);
$stmt -> execute();
$idcontacto=0;
foreach($stmt -> fetchAll(PDO::FETCH_ASSOC) as $key => $value){
		$idcontacto=$value['id']; //iddelman
}

if ($locacion1!=''){
	//inserta flujo - next - es el tipico movimiento
	$sql1 = "insert into flujodata (idflujo, idcontacto, data) values (17,".$idcontacto.",'".$locacion1.",".$locacion2."')";				
	$stmt1 = $gbd -> prepare($sql1);
	$stmt1 -> execute();	
	//conversa($locacion1);
	saltabotFormulario("18");
}

//recibe codigo de bienvenida
if (strpos($mensaje, "/start") === 0) {	
	//si no hay contcto, crear el contacto
	if ($idcontacto==0){
		//crea el contacto
		$sql1 = "insert into contacts (contactphone, contactname, idclient, contactphoto, details, db, telegramid) values ('telegram','telegram customer',".$clienteid.",'telegramid.jpg','Cliente telegram',0,".$idUsuario.") RETURNING id";				
		$stmt1 = $gbd -> prepare($sql1);
		$stmt1 -> execute();
		$result1 = $stmt1->fetch(PDO::FETCH_ASSOC);
		$idcontacto = $result1['id'];						
	}
	//trigger alBot Reactivo, a ver si hay inicialización - KEY "init"
	$sql= "select * from botreactivo where idcliente=".$clienteid." and key='init'";
	$stmt = $gbd -> prepare($sql);
	$stmt -> execute();
	$idbotreactivo=0;
	foreach($stmt -> fetchAll(PDO::FETCH_ASSOC) as $key => $value){
			$idbotreactivo=$value['id'];
			$accionBotReactivo=$value['reaccion'];
	}
	if ($idbotreactivo>0){
			//aqui va la reacción del BOT
			if ($accionBotReactivo=='botFormulario'){
				//al start prende el formulario
				botFormulario($idUsuario, 'init');
			}
			else{
				//aqui debería haber la opción de que pase al flujo del bot o a un mensaje customizado
			}
	}
	else{
		//no hay bot reactivo
	}
}
else {
		
		//Si no es bienvenida START, pasa por el bot normal.
		robot($idUsuario, $mensaje);
		
}




?>
