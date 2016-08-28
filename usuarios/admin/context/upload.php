<section id="upload" class="grid-content">
    <h1>ACTUALIZAR BASE DE DATOS</h1>
    <section class="big-row">
        <div class="left-col">
            <h2>Seleccione un contrato:</h2>
            <select name="markcontrato" id="bdcontrato" onchange="queryManager.getContrato();">
                <?php
                    $query1 = new Consulta();
                    $contrato = $query1->mostrarContratos();
                    $largo1 = count($contrato);
                    echo "<li><option value=''>--</option></li>";
                    for($i=0; $i<$largo1; $i++){
                        echo "<li><option value='".$contrato[$i][0]."'> ".$contrato[$i][0]." --".$contrato[$i][1]."</option></li>";
                    }
                ?>
            </select>
        </div>
        <div class="right-col">
            <div>
                <h3>Ingresar Contrato</h3>
                <form action="controllers/admin/IngresarContrato.php" method="POST">
                    <div>
                        <label>C&oacute;digo: </label><input type="text" name="codigo" required/>
                    </div>
                    <div>
                        <label>Nombre: </label><input type="text"  name="nombre" required/>
                    </div>
                    <div>
                        <button type="submit">Ingresar en BD</button>
                    </div>
                </form>
            </div>
            <div>
                <h3>Remover Contrato</h3>
                <form action="controllers/admin/RemoverContrato.php" method="POST">
                    <div>
                        <label>C&oacute;digo: </label><input type="text" name="codigo" required/>
                    </div>
                    <div>
                        <label>Nombre: </label><input type="text" name="nombre" required/>
                    </div>
                    <div>
                        <button type="submit">Remover de BD</button>
                    </div>
                </form>
            </div>
        </div>
    <section>
    <section class="big-row">
        <div class="left-col boton-cargar">
            <form id="file-form-real" action="controllers/admin/toTable1608.php" method="POST" enctype="multipart/form-data" >
                    <input type="file" class="inputfile" id="report1608-toexcel" name="report1608-toexcel" accept="application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" />
                    <label for="report1608-toexcel">
                        <img src="img/MSExcel_2013_logo.svg" />
                        <span>Carga Archivo</span>
                    </label>
                    <button type="submit" class="u-button" id="rep1608" >Generar Excel</button>
            </form>
        </div>
    </section>
</section>
