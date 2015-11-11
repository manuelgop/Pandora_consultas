<?php

///Funcion que exrtae lo recibido por la API de pandora en texto plano.
function CurlApi($url){
	$curl = curl_init();
//Curl para servidor en nexteer
//curl_setopt($curl, CURLOPT_URL, 'http://10.222.65.76/pandora_console/include/api.php?op=get&op2=module_value_all_agents&id=estavivo&apipass=1234&user=admin&pass=pandora');
///--------------------------/////
///Curl para el servidor local en mi computadora
curl_setopt($curl, CURLOPT_URL, $url);


		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
		// $output contains the output string 
		$output = curl_exec($curl); 
		//echo $output; 
		if ($output=="Error getting module value from all agents. Module name doesn't exists.") {
			echo "No existe modulo con ese nombre";
			curl_close($curl); 
		}
		else{
		//echo "<br>";
		//hacemos un explode para poder dividir el string en partes por un delimitante
		$partes = explode(";", $output);
		//imprimimos el valor nombre que se encuentra en la segunda posicion del arreglo[1]
		echo "El nombre del dispositivo es: ". $partes[1];
		echo "<br>";
		//Partimos el String y lo con vertimos en un arreglo, para manipularlo mas facil
		$arr1 = str_split($output);
		//Medimos el arreglo y determinarmos donde colocarnos para poder sacar el valor booleano 1=prendido 0=apagado
		$long = strlen($output);
		echo "Estatus: ";
		//Le restamos 5 a la longitud del arreglo para colocarnos en el lugar correcto.
		$pos = $long - 5;
		//Asignamos el valor de esa posicion que debe ser UNO o CERO a status.
		$status = $output[$pos];
		//Evaluamos si es 1 o 0
		if ($status == 1) {
			echo '<strong> <font color="green">Esta prendido </font> </strong>';
		}else{
			echo '<strong> <font color="red">ESTA APAGADO</font></strong>';
		}
		echo "<br>";
		// close curl resource to free up system resources 
		curl_close($curl); 
	}
}

function longdate($timestamp){
	return date("l F jS Y", $timestamp);
 }

$url = "http://localhost/pandora_console/include/api.php?op=get&op2=module_value_all_agents&id=Status&apipass=1234&user=admin&pass=pandora";

	CurlApi($url);
		
//$url2 = "http://localhost/pandora_console/include/api.php?op=get&op2=module_value_all_agents&id=estavivo&apipass=1234&user=admin&pass=pandora";
//CurlApi($url2);
	echo "<br>";
	print("Segundo elemento");
	echo "<br>";


$url2 = "http://localhost/pandora_console/include/api.php?op=get&op2=module_value_all_agents&id=estavivo&apipass=1234&user=admin&pass=pandora";
CurlApi($url2);
	//Caso donde no existe ese modulo
	echo "<br>";
	print("Tercer caso");
	echo "<br>";

$url3 = "http://localhost/pandora_console/include/api.php?op=get&op2=module_value_all_agents&id=estavvo&apipass=1234&user=admin&pass=pandora";
CurlApi($url3);

	echo "<br>";

	echo longdate(time());
?>