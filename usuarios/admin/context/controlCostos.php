<section id="control-costos">
    <section id="consulta-tabla">
        <div>
            <h2>CONTROL DE COSTOS</h2>
        </div>
        <div id="botones-consultas">


        </div>
        <div class="tabla1">
            <div>
                <h3>Nombre Tablas</h3>
                <div>
                    <select name="markquery" id="querytable">
                        <?php
                            $query = new Consulta();
                            $tablas = $query->mostrarTablas();
                            $largo = count($tablas);
                            for($i=0; $i<$largo; $i++){
                                echo "<option value='".$i."'>".$tablas[$i]."</li>";
                            }
                        ?>
                    </select>
                    <input id="btn-query" type="button" value="Desplegar Tabla" onclick="queryManager.getTable();">
                </div>
                <div>

                </div>
            </div>
            <div id="mensaje-query">
                <!-- <p>Consulta: <span>SELECT * FROM erpcomin.unitario</span></p> -->
            </div>
            <div id="resultado-query">
                <?php include_once("view/selectAll.php");?>
            </div>
        </div>
    </section>
</section>
