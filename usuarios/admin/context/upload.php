<section id="upload" class="grid-content">
    <h1>ACTUALIZAR BASE DE DATOS</h1>
    <section class="big-row">
        <div class="left-col">
            <h2>Seleccione un contrato:</h2>
            <select name="markcontrato" id="bdcontrato" onchange="queryManager.getArea();">
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
    </section>
    <section id="upld-buttons" class="big-row lefty">
    </section>
    <section id="output-upload" class="big-row righty">
        <?php
            echo "<h3>Descarga de planillas de Mapeo de Oferta</h3>";

            if(file_exists("docs/costo_oferta/1557_lista_items.xlsx")){
                echo "<a href='docs/costo_oferta/1557_lista_items.xlsx'>Descarga 1557_lista_items.xlsx</a><br>";
            }elseif(file_exists("docs/costo_oferta/1557_lista_items.xls")){
                echo "<a href='docs/costo_oferta/1557_lista_items.xlsx'>Descarga 1557_lista_items.xls</a><br>";
            }else{
                echo "No existe planilla de oferta del contrato 1557<br>";
            }

            if(file_exists("docs/costo_oferta/1608_lista_items.xlsx")){
                echo "<a href='docs/costo_oferta/1608_lista_items.xlsx'>Descarga 1608_lista_items.xlsx</a><br>";
            }elseif(file_exists("docs/costo_oferta/1608_lista_items.xls")){
                echo "<a href='docs/costo_oferta/1608_lista_items.xls'>Descarga 1608_lista_items.xls</a><br>";
            }else{
                echo "No existe planilla de oferta del contrato 1608<br>";
            }
        ?>
    </section>
</section>
