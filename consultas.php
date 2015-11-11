<?php
//REVISAR CURL_MULTI_INIT();
//Para acelarar los curls!

///Funcion que exrtae lo recibido por la API de pandora en texto plano.
function CurlApi($url){
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);


		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
		// $output contains the output string 
		$output = curl_exec($curl); 
		echo $output; 
		if ($output=="Error getting module value from all agents. Module name doesn't exists.") {
			echo "No existe modulo con ese nombre";
			curl_close($curl); 
		}
		else{
		echo "<br>";
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

//Funcion que me devuelve el nombre del dispositivo
function imprimeNombre($url){
	$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);


		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
		// $output contains the output string 
		$output = curl_exec($curl); 
		//echo $output; 
		if ($output=="Error getting module value from all agents. Module name doesn't exists.") {
			echo "Error";
			echo "<br>";
			curl_close($curl); 
		}
		else{
		//echo "<br>";
		//hacemos un explode para poder dividir el string en partes por un delimitante
		$partes = explode(";", $output);
		//imprimimos el valor nombre que se encuentra en la segunda posicion del arreglo[1]
		$nombre = $partes[1];
		//imprimimos el NOMBRE
		echo $nombre;
		//Cerramos la consulta CURL
		curl_close($curl); 
	}


}

//Funcion que me impirme el estado de mi dispositivo
function imprimeEstado($url){
	$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);


		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
		curl_setopt($curl, CURLOPT_ENCODING, '');
		// $output contains the output string 
		$output = curl_exec($curl); 
		if ($output=="Error getting module value from all agents. Module name doesn't exists.") {
			echo "Error";
			curl_close($curl); 
		}
		else{
		//hacemos un explode para poder dividir el string en partes por un delimitante
		$partes = explode(";", $output);
		//imprimimos el valor nombre que se encuentra en la segunda posicion del arreglo[1]
		//echo "El nombre del dispositivo es: ". $partes[1];
		//echo "<br>";
		//Partimos el String y lo con vertimos en un arreglo, para manipularlo mas facil
		$arr1 = str_split($output);
		//Medimos el arreglo y determinarmos donde colocarnos para poder sacar el valor booleano 1=prendido 0=apagado
		$long = strlen($output);
		//echo "Estatus: ";
		//Le restamos 5 a la longitud del arreglo para colocarnos en el lugar correcto.
		$pos = $long - 5;
		//Asignamos el valor de esa posicion que debe ser UNO o CERO a status.
		$status = $output[$pos];
		//Evaluamos si es 1 o 0
		if ($status == 1) {
			//Esta prendida
			echo '<strong> <font color="green">Esta prendido </font> </strong>';
		}else{
			//Esta apagada
			echo '<strong> <font color="red">ESTA APAGADO</font></strong>';
		}
		//Cerramos Curl
		curl_close($curl); 
	}
}

//Lista de servidores
$url = "http://localhost/pandora_console/include/api.php?op=get&op2=module_value_all_agents&id=Status&apipass=1234&user=admin&pass=pandora";
$url2 = "http://localhost/pandora_console/include/api.php?op=get&op2=module_value_all_agents&id=estavivo&apipass=1234&user=admin&pass=pandora";
$url3 = "http://localhost/pandora_console/include/api.php?op=get&op2=module_value_all_agents&id=estavvo&apipass=1234&user=admin&pass=pandora";
$url4 = "http://localhost/pandora_console/include/api.php?op=get&op2=module_value_all_agents&id=AP1&apipass=1234&user=admin&pass=pandora";
$url5 = "http://localhost/pandora_console/include/api.php?op=get&op2=module_value_all_agents&id=AP2&apipass=1234&user=admin&pass=pandora";

?>

<!DOCTYPE html>
<html>
<head>
	<title>Nexteer</title>
	<link rel="stylesheet" type="text/css" href="css/materialize.min.css">
	<script type="text/javascript" src="js/materialize.min.js"></script>
</head>
<body>



 <div class="row">
      <center><div class="col s12"><span class="flow-text">Monitoreo de Servidores Nexteer</div></center>
     <center><div class="col s4"><span class="flow-text">

<h5>Apartado uno</h5>

 <table class="striped">
        <thead>
          <tr>
              <th data-field="id">Equipo</th>
              <th data-field="name">Estado</th>
          </tr>
        </thead>

        <tbody>
          <tr>
            <td>
            	<?php
            	imprimeNombre($url);
            	?>
            </td>
            <td>
            	<?php
            		imprimeEstado($url);
            	?>
            </td>           
          </tr>
          <tr>
            <td>
            	<?php
            		imprimeNombre($url2);
            	?>
            </td>
            <td>            	
            	<?php
            		imprimeEstado($url2);
            	?>
            </td>
          </tr>
          <tr>
            <td>
            	<?php
            	imprimeNombre($url4);
            	?>
            </td>
            <td>
            	<?php
            		imprimeEstado($url4);
            	?>
            </td>           
          </tr>
                    <tr>
            <td>
            	<?php
            	imprimeNombre($url5);
            	?>
            </td>
            <td>
            	<?php
            		imprimeEstado($url5);
            	?>
            </td>           
          </tr>
        </tbody>
      </table>



     </div></center>



     <center> <div class="col s4"><span class="flow-text">



<h5>Apartado dos</h5>
 <table class="striped">
        <thead>
          <tr>
              <th data-field="id">Equipo</th>
              <th data-field="name">Estado</th>
          </tr>
        </thead>

        <tbody>
          <tr>
            <td>Alvin</td>
            <td>Eclair</td>           
          </tr>
          <tr>
            <td>Alan</td>
            <td>Jellybean</td>
          </tr>
        </tbody>
      </table>




     </div></center> 
     <center> <div class="col s4"><span class="flow-text">


     <h5>Apartado tres</h5>
 <table class="striped">
        <thead>
          <tr>
              <th data-field="id">Equipo</th>
              <th data-field="name">Estado</th>
          </tr>
        </thead>

        <tbody>
          <tr>
            <td>Alvin</td>
            <td>Eclair</td>           
          </tr>
          <tr>
            <td>Alan</td>
            <td>Jellybean</td>
          </tr>
        </tbody>
      </table>






     </div></center> 

    </div>
</body>
</html>