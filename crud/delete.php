<?php

if(isset($_GET["idUsuario"])){
    $idUsuario = $_GET["idUsuario"];

    $host = "127.0.0.1:33065";
    $user = "root";
    $pass = "root";
    $db = "usuarios";

    //Crear conexion
    $con = new mysqli($host,$user,$pass,$db);

    $sql = "DELETE FROM usuario WHERE idUsuario=$idUsuario";
    $con->query($sql);
}

header("location: /crud/admin.php");
exit;

?>