<!DOCTYPE html>
<html>
<head>
	<title>ERP Gestion Proyectos COMIN</title>
    <!-- Favicon -->
    <link rel="icon" href="img/favicon.ico" type="image/x-icon"/>
	<!-- jQuery min 2.2.1 -->
	<script src="js/jquery.min.js"></script>
	<!-- Vista para dispositivos moviles -->
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
	<!-- Codificacion usada -->
    <meta charset="utf-8"/>
	<meta http-equiv="Content-Type" content="text/html"/>
	<!-- Script para cargar context Manager -->
	<script type="text/javascript" src="js/contextManager.js"></script>
    <script type="text/javascript" src="js/validator.js"></script>
    <!-- Script para cargar loginmanager y API Rest -->
    <script type="text/javascript" src="js/loginManager.js"></script>
    <script type="text/javascript" src="js/rest.js"></script>
    <!-- Carga la hoja estilo correspondiente al dispositivo -->
    <script type="text/javascript" src="js/responsive.js"></script>
    <!-- Script para cambiar opcion de carga de la query -->
    <script type="text/javascript" src="js/queryManager.js"></script>
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
            <img id="logo" src="img/logo.png" alt="COMIN Logo"/>
        </div>
        <div>
            <span class="menu"><img src="img/nav.svg" alt="" onclick="menuHandler()"/></span>
        </div>
        <div>
            <nav id="top-menu" class="menum-inactivo" >
                <ul id="botones-menu-principal">
                    <li class="actual main-menu-element" templateId="c-principal" mark="1">
                        <a href="#">Resumen</a>
                    </li>
                    <li class="no-actual main-menu-element" templateId="c-consultas" mark="1">
                        <a href="#">Consultas</a>
                    </li>
                    <li class="no-actual main-menu-element" templateId="c-alertas" mark="1">
                        <a href="#">Alertas</a>
                    </li>
                    <li class="no-actual main-menu-element" templateId="c-graficos" mark="1">
                        <a href="#">Gr&aacute;ficos</a>
                    </li>
                </ul>
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
<template id="tc-alertas">
	<?php include_once("usuarios/admin/context/alertas.php"); ?>
</template>
<template id="tc-graficos">
	<?php include_once("usuarios/admin/context/graficos.php"); ?>
</template>
</body>

<a href="#to-top" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>
</html>
