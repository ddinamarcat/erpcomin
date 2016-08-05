<section id="control-costos">
    <section id="consulta-tabla">
        <div>
            <h2>CONTROL DE COSTOS</h2>
        </div>
        <div id="botones-consultas">


        </div>
        <div class="tabla1">
            <div>
                <h3>Consulta Conflicto por Materiales</h3>
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
                <div>

                </div>
            </div>
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
                                    <p>TABLA ORIGEN</p>
                                </div>
                            </div>
                            <div class="right-result">
                                <div class="promedio">
                                    <p>TABLA LOCAL</p>
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
    </section>
</section>
