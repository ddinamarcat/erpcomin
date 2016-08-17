<?php
    error_reporting(E_ALL);
    ini_set('display_errors',1);
    ini_set('memory_limit', '-1');
    ini_set('max_execution_time', 300);
    header('Content-Type: text/html; charset=utf-8');
    include_once('config.php');
    include_once('lib/BddMySql.php');
    include_once("lib/Usuario.php");
    include_once("lib/SanearString.php");
    include_once("controllers/admin/Consulta.php");
    include_once("controllers/admin/MostrarTabla.php");
    include_once("controllers/admin/ComparaMaterial.php");
    include_once("controllers/admin/CheckSerialize.php");
    include_once('SessionManager.php');
    $sessionManager = new SessionManager();
?>
