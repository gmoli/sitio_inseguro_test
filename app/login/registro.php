<?php
$db_host="localhost";
$db_user="usuario_app";
$db_password="password_app";
$db_name="sitio_inseguro";
$db_table_name="personas";
//   $db_connection = mysqli_connect($db_host, $db_user, $db_password,$db_name);
try{
   $db_connection = mysqli_connect($db_host, $db_user, $db_password,$db_name);
}catch (Exception $e) {
 echo $e;    
}

function debug_to_console($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}

   //$db_connection = mysql_connect($db_host, $db_user, $db_password);

if (!$db_connection) {
	echo 'No se ha podido conectar a la base de datos' ;die();
}
$subs_name = utf8_decode($_POST['nombre']);
//$subs_last = utf8_decode($_POST['apellido']);
//$subs_email = utf8_decode($_POST['email']);
$subs_password = utf8_decode($_POST['password']);
try{
$resultado=mysqli_query($db_connection,"SELECT * FROM ".$db_table_name." WHERE Nombre = '".$subs_name."' AND Password = MD5('".$subs_password."');");
}catch (Exception $e) {
 echo $e;    
}
$temp= "SELECT * FROM ".$db_table_name." WHERE Nombre = `".$subs_name."` AND Password = MD5(`".$subs_password."`);";
debug_to_console($temp);
if (mysqli_num_rows($resultado)>0)
{

header('Location: Success.html');

} else {
	header('Location: Fail.html');
	$insert_value = 'INSERT INTO `' . $db_name . '`.`'.$db_table_name.'` (`Nombre` , `Apellido` , `Email`,`password`) VALUES ("' . $subs_name . '", "' . $subs_last . '", "' . $subs_email . '",MD5("' . $subs_password . '") )';

    debug_to_console($insert_value );

//mysqli_select_db($db_name, $db_connection);
//mysqli_select_db($link, "world");
  mysqli_select_db($db_connection, "sitio_inseguro");
try{
$retry_value = mysqli_query($db_connection, $insert_value);
}catch (Exception $e) {
 echo $e;    
}

if (!$retry_value) {
   die('Error: ' . mysqli_error());
}
	
}

mysqli_close($db_connection);
		
?>
