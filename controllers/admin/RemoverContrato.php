<?php
include_once("Consulta.php");


if (isset($_POST['codigo'])){
    $codigo = $_POST["codigo"];

    $consulta = new Consulta();
    $consulta->RemoverContrato($codigo);

}




?>
