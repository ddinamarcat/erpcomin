<? $markquery="markquery"; ?>
<section id="consultas">
    <section id="consulta-tabla">
        <div>
            <h2>CONSULTAS</h2>
        </div>
        <div id="botones-consultas">


        </div>
        <div class="tabla1">
            <div>
                <h3>Nombre Tablas</h3>
                <div>
                    <select name="markquery" id="querytable">
                        <?php
                            include("config.php");
                            $tableList = array();
                            $conn = mysqli_connect($hostdb, $userdb, $passdb, $namedb);
                            $sql = "SHOW FULL TABLES FROM ".$namedb;
                            $res = mysqli_query($conn,$sql);
                            while ($fila = mysqli_fetch_row($res)) {
                                //echo "<li>{$fila[0]}</li>\n";
                                array_push($tableList, $fila[0]);
                            }
                            $largo = count($tableList);
                            for($i=0; $i<$largo; $i++){
                                echo "<option value='".$i."'>".$tableList[$i]."</li>";
                            }
                            mysqli_close($conn);
                        ?>
                    </select>
                    <input type="button" value="Desplegar Tabla" onclick="queryManager.getTable();">
                </div>
                <div>

                </div>
            </div>
            <div>
                <p>Consulta: <span>SELECT * FROM erpcomin.unitario</span></p>
            </div>
            <div id="contenido-query">

            </div>
        </div>
    </section>
</section>
