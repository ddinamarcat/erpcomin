<!DOCTYPE html>
<html>
<head>
    <title>Sistema COMIN</title>
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
                <ul id="botones-menu-principal">
                    <li class="no-actual main-menu-element"  mark="1">
                        <a href="#">Ingreso</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</header>
<section id="modal-form">
    <div>
        <form class="basic-form login-form" method="post" submitId="login-boton" onkeyup="validator.activateSubmit(this)" action="lib/LoginManager.php">
            <div>
                <h2>SISTEMA ADMINISTRACI&Oacute;N PROYECTOS COMIN</h2>
            </div>
            <div>
                <img src="img/logo.png" alt="logologin"/>
            </div>
            <div>
                <input name="user" placeholder="Ingrese usuario" type="text" autocomplete="off" validate="text" required/>
            </div>
            <div>
                <input name="pass" placeholder="Ingrese su contraseña" type="password" autocomplete="off" validate="password" required/>
            </div>
            <div class="enviar-form">
                <button id="login-boton" type="submit" name="form-enviar" validate="submit" value="Submit" disabled>Ingresar</button>
            </div>
        </form>
    </div>
</section>
</body>
</html>
