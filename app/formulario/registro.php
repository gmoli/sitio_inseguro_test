

<?php
$db_host="localhost";
$db_user="usuario_app";
$db_password="password_app";
$db_name="sitio_inseguro";
$db_table_name="personas";
   $db_connection = mysqli_connect($db_host, $db_user, $db_password,$db_name);

function debug_to_console($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}

   //$db_connection = mysql_connect($db_host, $db_user, $db_password);

if (!$db_connection) {
	die('No se ha podido conectar a la base de datos');
}
$subs_name = utf8_decode($_POST['nombre']);
$subs_last = utf8_decode($_POST['apellido']);
$subs_email = utf8_decode($_POST['email']);
$subs_password = utf8_decode($_POST['password']);

$resultado=mysqli_query($db_connection,"SELECT * FROM ".$db_table_name." WHERE Email = '".$subs_email."'");

if (mysqli_num_rows($resultado)>0)
{

header('Location: Fail.html');

} else {
	
	$insert_value = 'INSERT INTO `' . $db_name . '`.`'.$db_table_name.'` (`Nombre` , `Apellido` , `Email`,`password`) VALUES ("' . $subs_name . '", "' . $subs_last . '", "' . $subs_email . '",MD5("' . $subs_password . '") )';

    debug_to_console($insert_value );

//mysqli_select_db($db_name, $db_connection);
//mysqli_select_db($link, "world");
  mysqli_select_db($db_connection, "prueba");

$retry_value = mysqli_query($db_connection, $insert_value);

if (!$retry_value) {
   die('Error: ' . mysqli_error());
}
	
header('Location: Success.html');
}

mysqli_close($db_connection);
		




?>
