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
            <div class="boton-carga">
                <button>Cargar Tabla Costo Real</button>
            </div>
            <div class="boton-carga">
                <button>Cargar Tabla Costo Real</button>
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
