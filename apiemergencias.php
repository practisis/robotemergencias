<?php



$id=$_REQUEST['id'];




function emergenciaingreso($dia,$hora,$locacion,$tipo,$des,$status,$check,$lat,$long)
{


            //include 'enoc_con.php';

            $dbname = 'desastres';
        	include 'enoc.php';
			$sql="INSERT INTO datos( locacion, tipo, descripcion, status, checked,latitud, longitud) VALUES ( 'Quito', '$tipo', '$des', 'Activo', 1,$lat, $long)";
			
		//	echo $sql;
			
			pg_query($conectado,$sql) or die('{"emp" : "0" , "funcion" : "ventasayer","local" :"0","response":"0"}');

			echo '{"emp" : "0" , "funcion" : "ventasayer","local" :"0","response":"1"}';



			break;

}


function emergencia()



{



//include 'enoc_con.php';

$dbname = 'desastres';

include 'enoc.php';

//echo $host;



$datos=pg_query($conectado,"SELECT * from datos");

$eljson='{"type": "FeatureCollection",
  "features":[';
  


	while ($dr1 = pg_fetch_array($datos))



	{

			//	$eljson='{"type/"';
     

				
				$eljson .='{"type": "Feature",';
				$eljson .='"properties":{';
				$date=date_format(date_create($dr1[1]),'Ymd');
				$time=date_format(date_create($dr1[2]),'His');
				
						
				$eljson .='"date":"'.$date.'",' ;
				$eljson .='"time":"'.$time.'",' ;
				$eljson .='"location":"'.$dr1[3].'",' ;
				$eljson .='"type":"'.$dr1[4].'",' ;
				$eljson .='"desc":"'.$dr1[5].'",' ;
				$eljson .='"status":"'.$dr1[6].'",' ;
				$eljson .='"checked":'.$dr1[7].'},' ;
				$eljson .='"geometry":{"type":"Point",' ;
				$eljson .='"coordinates":['.$dr1[8].','.$dr1[9].']}}' ;
				$eljson .=',' ;
				
				
				
				


	}
	$eljson= rtrim($eljson,',');
	$eljson .=']}' ;


	echo $eljson;



}






switch ($id) {


    

		case 44:

	emergencia();

	
break;	
	
	case 45;
		$dia=$_REQUEST['di'];
	$hora=$_REQUEST['h'];
	$locacion=$_REQUEST['l'];
	$tipo=$_REQUEST['t'];
	$des=$_REQUEST['d'];
	$status=$_REQUEST['s'];
	$check=$_REQUEST['ch'];
	$lat=$_REQUEST['lat'];
	$long=$_REQUEST['lon'];


	
		
//http://practisis.net/apiEmergencia.php?id=45&di=2016-01-01&h=20:00:00&l=Quito&t=terremoto&d=TerremotoFuerte&s=Activo&ch=1.0&lat=-79.4323&lon=-1.029
	emergenciaingreso($dia,$hora,$locacion,$tipo,$des,$status,$check,$lat,$long);

	
break;
	
	







} //End Switch



?>
