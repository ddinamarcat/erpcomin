<?php
include_once('controllers/admin/Consulta.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Sistema Gestion Proyectos COMIN</title>
    <!-- Favicon -->
    <link rel="icon" href="img/favicon.ico" type="image/x-icon"/>
	<!-- jQuery min 2.2.1 -->
	<script src="js/jquery.min.js"></script>
	<!-- Vista para dispositivos moviles -->
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
	<!-- Codificacion usada -->
    <!-- <meta charset="utf-8"/> -->
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<meta http-equiv="Content-Type" content="text/html"/>
	<!-- Script para cargar context Manager -->
	<script type="text/javascript" src="js/contextManager.js"></script>
    <script type="text/javascript" src="js/validator.js"></script>
    <!-- Script para cargar loginmanager y API Rest -->
    <script type="text/javascript" src="js/loginManager.js"></script>
    <script type="text/javascript" src="js/rest.js"></script>
    <!-- Carga la hoja estilo correspondiente al dispositivo -->
    <script type="text/javascript" src="js/responsive.js"></script>
    <!-- Script para cargar mas Managers -->
    <script type="text/javascript" src="js/queryManager.js"></script>
    <script type="text/javascript" src="js/uploadManager.js"></script>
    <script type="text/javascript" src="js/selectManager.js"></script>
    <!-- Script para volver arriba -->
	<script type="text/javascript" src="js/move-top.js"></script>
    <script type="text/javascript" src="js/easing.js"></script>
    <!-- para flecha de vuelta hacia arriba e inicia contextManager -->
    <script type="text/javascript">
    	jQuery(document).ready(function($) {
    			$(".scroll").click(function(event){
    					event.preventDefault();
    					$('html,body').animate({scrollTop:$(this.hash).offset().top},9000);
    			});
                $().UItoTop({ easingType: 'easeOutQuart' });
    			contextManager.start("contenido");

    	});
        function menuHandler(){
            var menucl = document.getElementById("top-menu").classList;
            if (menucl.contains("menum-inactivo")){
                menucl.remove("menum-inactivo");
                menucl.add("menum-activo");
            } else{
                menucl.remove("menum-activo");
                menucl.add("menum-inactivo");
            }
        }
	</script>
</head>
<body>
<header>
    <div id="header-grid">
        <div>
            <img templateId="c-principal" id="logo" src="img/logo.png" alt="COMIN Logo"/>
        </div>
        <div>
            <span class="menu"><img src="img/nav.svg" alt="" onclick="menuHandler()"/></span>
        </div>
        <div>
            <nav id="top-menu" class="menum-inactivo" >
                <div id="botones-menu-principal">
                    <li class="no-actual main-menu-element" templateId="c-principal" mark="1">
                        <a href="#">Resumen</a>
                    </li>
                    <li class="no-actual main-menu-element" templateId="c-consultas" mark="1">
                        <a href="#">Consultas</a>
                        <ul class="no-actual">
                            <li class="no-actual main-menu-element" templateId="c-controlCostos" mark="1"><a href="#">Control de Costos</a>
                            </li>
                            <li class="no-actual main-menu-element" templateId="c-rrhh" mark="1"><a href="#">RRHH</a>
                            </li>
                            <li class="no-actual main-menu-element" templateId="c-bodega" mark="1"><a href="#">Bodega</a>
                            </li>
                        </ul>
                    </li>
                    <li class="no-actual main-menu-element" templateId="c-alertas" mark="1">
                        <a href="#">Alertas</a>
                    </li>
                    <li class="no-actual main-menu-element" templateId="c-graficos" mark="1">
                        <a href="#">Gr&aacute;ficos</a>
                    </li>
                    <li class="no-actual main-menu-element" templateId="c-upload" mark="1">
                        <a href="#">Actualizar BD</a>
                    </li>
                </div>
            </nav>
        </div>
        <div>
            <input id="login-button" type="button" Value="LOGOUT" onclick="loginManager.logout();"/>
        </div>
    </div>
</header>
<div id="contenido" class="c-desactivado">
</div>
<template id="tc-principal">
	<?php include_once("usuarios/admin/context/principal.php"); ?>
</template>
<template id="tc-consultas">
	<?php include_once("usuarios/admin/context/consultas.php"); ?>
</template>
<template id="tc-controlCostos">
	<?php include_once("usuarios/admin/context/controlCostos.php"); ?>
</template>
<template id="tc-rrhh">
	<?php include_once("usuarios/admin/context/rrhh.php"); ?>
</template>
<template id="tc-bodega">
	<?php include_once("usuarios/admin/context/bodega.php"); ?>
</template>
<template id="tc-alertas">
	<?php include_once("usuarios/admin/context/alertas.php"); ?>
</template>
<template id="tc-graficos">
	<?php include_once("usuarios/admin/context/graficos.php"); ?>
</template>
<template id="tc-upload">
	<?php include_once("usuarios/admin/context/upload.php"); ?>
</template>

<section id="modal-section" class="modal-hidden fadeout-modal hidden">
	<div id="modal-div">
        <img src="img/boton-cerrar.png" alt="Cerrar" class="boton-cerrar" onclick="modalManager.hideModal();"/>
		<div id="modal-content">
		</div>
	</div>
</section>

<a href="#to-top" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>
</body>
</html>
