<?php
error_reporting(E_ALL);
ini_set("display_errors",1);
session_start();
include_once('../config.php');
include_once("BddMySql.php");
class LoginManager{

    function __construct() {
        if(!isset($_SESSION["user"])){
            $_SESSION["user"] = "invitado";
            $_SESSION["tipo"] = 0;
        }
        if(isset($_POST["user"]) && isset($_POST["pass"])){
            include_once('Usuario.php');
            $usuario = new Usuario();
            if(!$usuario -> ingresar($_POST["user"],$_POST["pass"])){
                $_SESSION["user"] = "invitado";
                $_SESSION["tipo"] = 0;
            }

            header("location:../");
        }
    }
}
$loginManager = new LoginManager();
?>
