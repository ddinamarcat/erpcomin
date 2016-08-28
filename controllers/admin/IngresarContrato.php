<?php
include_once("Consulta.php");

if (isset($_POST['codigo']) && isset($_POST['nombre'])){
    $codigo = $_POST["codigo"];
    $nombre = $_POST["nombre"];

    $consulta = new Consulta();
    $consulta->IngresarContrato($codigo,$nombre);

}


?>
