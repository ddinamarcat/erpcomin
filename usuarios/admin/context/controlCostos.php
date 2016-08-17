<section class="grid-content">
    <h1>CONTROL DE COSTOS</h1>
    <div>
        <div>
            <h2>Consulta Conflicto por Materiales</h2>
        </div>
        <div>
            <div>
                <select name="markquery" id="query-material1" onchange="queryManager.getTable();">
                    <?php

                        $query = new Consulta();
                        $prodServ = $query->mostrarProdServ();
                        $largo = count($prodServ);
                        echo "<li><option value=''>--</option></li>";
                        for($i=0; $i<$largo; $i++){
                            echo "<li><option value='".$prodServ[$i][0]."'> ".$prodServ[$i][0]." -- ".$prodServ[$i][1]."</option></li>";
                        }

                    ?>
                </select>
            </div>
            <div class="boton-cargar">
                <form id="file-form-real" action="controllers/admin/UploadCostoReal.php" method="POST" enctype="multipart/form-data" >
                    <input type="file" class="inputfile" id="carga-excelreal" name="carga-excelreal" accept="application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" />
                    <label for="carga-excelreal">
                        <img src="img/MSExcel_2013_logo.svg" />
                        <span>Carga Tabla Costo Real</span>
                    </label>
                    <button type="submit" class="u-button" id="upload-button" >Actualizar Tabla BD</button>
                </form>
            </div>
            <div class="boton-cargar">
                <form id="file-form-oferta" action="controllers/admin/UploadCostoOferta.php" method="POST" enctype="multipart/form-data" >
                    <input type="file" class="inputfile" id="carga-exceloferta" name="carga-exceloferta" />
                    <label for="carga-exceloferta">
                        <img src="img/MSExcel_2013_logo.svg" />
                        <span>Carga Tabla Costo Oferta</span>
                    </label>
                    <button type="submit" class="u-button" id="upload-button2" >Actualizar Tabla BD</button>
                </form>
            </div>
        </div>
        <div class="tabla1">
            <div id="mensaje-query">
                <div class="ctrl-costo-results">
                    <div class="results">
                        <div class="titulo-resumen">
                            <h3>RESUMEN GENERAL</h3>
                        </div>
                        <div class="resumen">
                            <div class="cantoc" id="cantoc-diff">
                                <p>Diferencia Cantidad OC = <span id="diff-cant-oc"></span></p>
                            </div>
                            <div class="promedio" id="prom-diff">
                                <p>Diferencia Prom. Val. UN Neto = <span id="diff-prom-val"></span></p>
                            </div>
                        </div>
                    </div>
                    <div class="results">
                        <div class="titulo-resumen">
                            <h3>RESUMEN POR TABLA</h3>
                        </div>
                        <div class="resumen">
                            <div class="left-result">
                                <div class="cantoc">
                                    <p>TABLA COSTO REAL</p>
                                </div>
                            </div>
                            <div class="right-result">
                                <div class="promedio">
                                    <p>TABLA COSTO OFERTA</p>
                                </div>
                            </div>
                        </div>
                        <div class="resumen">
                            <div class="left-result">
                                <div class="cantoc">
                                    <p>Val. UN TOTAL Prom = <span id="sumprom-total-real"></span></p>
                                </div>
                            </div>
                            <div class="right-result">
                                <div class="promedio">
                                    <p>Val. UN TOTAL Prom = <span id="sumprom-total-oferta"></span></p>
                                </div>
                            </div>
                        </div>
                        <div class="resumen">
                            <div class="left-result">
                                <div class="cantoc">
                                    <p>Suma Cantidad OC = <span id="cantoc-origen"></span></p>
                                </div>
                                <div class="promedio">
                                    <p>Prom. Val. UN Neto = <span id="prom-origen"></span></p>
                                </div>
                            </div>
                            <div class="right-result">
                                <div class="cantoc">
                                    <p>Suma Cantidad OC = <span id="cantoc-local"></span></p>
                                </div>
                                <div class="promedio">
                                    <p>Prom. Val. UN Neto = <span id="prom-local"></span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="resultado-query">
                <?php include_once("view/selectAll.php");?>
            </div>
        </div>
    </div>
</section>
