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
                        <button type="submit">Remover de BD</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <section id="upload-materiales" class="big-row lefty">
        <div class="left-col left-col2">
            <h2>Seleccione un &aacute;rea (Materiales y Servicios, o Remuneraciones):</h2>
            <select name="markarea" id="bdarea" onchange="queryManager.getArea();">
                <li><option value>--</option></li>
                <li><option value='1'>1 --Materiales y Servicios</option></li>
                <li><option value='2'>2 --Remuneraciones</option></li>
            </select>
        </div>
    </section>
    <section id="upld-buttons" class="big-row lefty">
        <div class="left-col boton-cargar">
            <form id="file-form-real" action="controllers/admin/UploadCostoReal.php" method="POST" enctype="multipart/form-data" >
                    <input type="file" class="inputfile" id="carga-excelreal" name="carga-excelreal" accept="application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" />
                    <label for="carga-excelreal">
                        <img src="img/MSExcel_2013_logo.svg" />
                        <span>Carga Archivo Costo Real</span>
                    </label>
                    <button type="submit" class="u-button" id="ubutton-real" >Actualizar BD</button>
            </form>
        </div>
        <div class="right-col boton-cargar">
            <form id="file-form-oferta" action="controllers/admin/UploadCostoOferta.php" method="POST" enctype="multipart/form-data" >
                    <input type="file" class="inputfile" id="carga-exceloferta" name="carga-exceloferta" accept="application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" />
                    <label for="carga-exceloferta">
                        <img src="img/MSExcel_2013_logo.svg" />
                        <span>Carga Archivo Costo Oferta</span>
                    </label>
                    <button type="submit" class="u-button" id="ubutton-oferta" >Actualizar BD</button>
            </form>
        </div>
    </section>
</section>
