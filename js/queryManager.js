var queryManager = {
    sub: function(obj){
        var file = obj.value;
        var fileName = file.split("\\");
        window.alert(fileName);
    },
    getArea: function(){
        var qm = queryManager;
        qm.limpiaParent("upload-materiales");
        qm.limpiaParent("upld-buttons");

        var contrato = document.getElementById("bdcontrato");
        var nombre = contrato.options[contrato.selectedIndex].innerHTML;
        var codContrato = contrato.options[contrato.selectedIndex].value;

        if(codContrato){
            var wrap = document.getElementById("upload-materiales");

            var cont = document.createElement("div");
            cont.classList.add("left-col");
            cont.classList.add("left-col2");
            wrap.appendChild(cont);

            var h1 = document.createElement("h2");
            h1.innerHTML = "Seleccione un &aacute;rea (Materiales y Servicios, o Remuneraciones): ";
            cont.appendChild(h1);

            var sp = document.createElement("span");
            sp.innerHTML = nombre;
            h1.appendChild(sp);

            var sel = document.createElement("select");
            sel.setAttribute("name","markarea");
            sel.id = "bdarea";
            sel.setAttribute("onchange","queryManager.getMateriales("+codContrato+");");
            cont.appendChild(sel);

            var optDef = document.createElement("option");
            optDef.value = "";
            optDef.innerHTML = "--";
            sel.appendChild(optDef);

            var opt1 = document.createElement("option");
            opt1.value = "1";
            opt1.innerHTML = "1 --Materiales y Servicios";
            sel.appendChild(opt1);

            var opt2 = document.createElement("option");
            opt2.value = "2";
            opt2.innerHTML = "2 --Remuneraciones";
            sel.appendChild(opt2);

            cont.classList.remove("anim-in");
            cont.classList.add("anim-out");
            window.setTimeout(function(){
                cont.classList.remove("anim-out");
                cont.classList.add("anim-in");
            },400)

        }

    },
    getMateriales: function(codigo){
        var qm = queryManager;
        qm.limpiaParent("upld-buttons");

        var bdarea = document.getElementById("bdarea");
        var areaVal = bdarea.options[bdarea.selectedIndex].value;

        if(areaVal!=false){
            var wrap = document.getElementById("upld-buttons");
            //Boton carga excel costo real
            var cont1 = document.createElement("div");
            cont1.classList.add("left-col");
            cont1.classList.add("boton-cargar");
            wrap.appendChild(cont1);

            var form1 = document.createElement("form");
            form1.id = "file-form-real";
            form1.method = "POST";
            form1.enctype = "multipart/form-data";
            cont1.appendChild(form1);

            var inp1 = document.createElement("input");
            inp1.type = "file";
            inp1.classList.add("inputfile");
            inp1.id = "carga-excelreal";
            inp1.name = "carga-excelreal";
            inp1.accept = "application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet";
            form1.appendChild(inp1);

            var lbl1 = document.createElement("label");
            lbl1.htmlFor = "carga-excelreal";
            form1.appendChild(lbl1);

            var img1 = document.createElement("img");
            img1.src = "img/MSExcel_2013_logo.svg";
            lbl1.appendChild(img1);

            var txbtn1 = document.createElement("span");
            txbtn1.innerHTML = "Carga Archivo Costo Real";
            lbl1.appendChild(txbtn1);

            var sbBtn = document.createElement("button");
            sbBtn.type = "submit";
            sbBtn.classList = "u-button";
            sbBtn.id = "ubutton-real";
            sbBtn.setAttribute("onClick","uploadManager.sendReal();");
            sbBtn.innerHTML = "Actualizar BD";
            form1.appendChild(sbBtn);
            //Boton upload excel tabla costo oferta
            var cont2 = document.createElement("div");
            cont2.classList.add("right-col");
            cont2.classList.add("boton-cargar");
            wrap.appendChild(cont2);

            var form2 = document.createElement("form");
            form2.id = "file-form-oferta";
            form2.action = "controllers/admin/UploadCostoOferta.php";
            form2.method = "POST";
            form2.enctype = "multipart/form-data";
            cont2.appendChild(form2);

            var inp2 = document.createElement("input");
            inp2.type = "file";
            inp2.classList.add("inputfile");
            inp2.id = "carga-exceloferta";
            inp2.name = "carga-exceloferta";
            inp2.accept = "application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet";
            form2.appendChild(inp2);

            var lbl2 = document.createElement("label");
            lbl2.htmlFor = "carga-exceloferta";
            form2.appendChild(lbl2);

            var img2 = document.createElement("img");
            img2.src = "img/MSExcel_2013_logo.svg";
            lbl2.appendChild(img2);

            var txbtn2 = document.createElement("span");
            txbtn2.innerHTML = "Carga Archivo Costo Oferta";
            lbl2.appendChild(txbtn2);

            var sbBtn2 = document.createElement("button");
            sbBtn2.type = "submit";
            sbBtn2.classList = "u-button";
            sbBtn2.id = "ubutton-oferta";
            sbBtn2.innerHTML = "Actualizar BD";
            form2.appendChild(sbBtn2);

            wrap.classList.remove("anim-in");
            wrap.classList.add("anim-out");
            window.setTimeout(function(){
                wrap.classList.remove("anim-out");
                wrap.classList.add("anim-in");
            },400);

        }


    },
    getTable : function(){
        var material = document.getElementById("query-material1");
        var codigoMaterial = material.options[material.selectedIndex].value;

        if(codigoMaterial!=''){ //Para que no haga nada con la primera opcion
            var ajaxRequest= $.ajax({
                type: "POST",
                data: {'codigomat': codigoMaterial},
                url: 'controllers/admin/ComparaMaterial.php',
                success: function(response){
                    var jdata = JSON.parse(response);
                    //window.alert(jdata);
                    //Remueve elementos antes de ejecutar la consulta
                    var node = document.getElementById("contenido-query");
                    while (document.getElementById("contenido-query").hasChildNodes()){              // selected elem has children
                        if (node.hasChildNodes()){                // current node has children
                            node = node.lastChild;                 // set current node to child
                        }
                        else{                                     // last child found
                            //console.log(node.nodeName);
                            node = node.parentNode;                // set node to parent
                            node.removeChild(node.lastChild);      // remove last node
                        }
                    }
                    var warnOCRemove = document.getElementById("cantoc-diff");
                    warnOCRemove.classList.remove("warning");

                    var warnPromRemove = document.getElementById("prom-diff");
                    warnPromRemove.classList.remove("warning");
                    //Fin remueve elementos
                    var result = document.getElementById("mensaje-query");
                    var wrap = document.getElementById("contenido-query");
                    result.classList.remove("anim-in");
                    result.classList.add("anim-out");
                    wrap.classList.remove("anim-in");
                    wrap.classList.add("anim-out");
                    window.setTimeout(function(){
                        var wraptOrigen = document.createElement("div");
                        wraptOrigen.classList.add("wrap-table");
                        wrap.appendChild(wraptOrigen);

                        var tiTablaOrigen = document.createElement("h3");
                        tiTablaOrigen.innerHTML = "TABLA COSTO REAL";
                        wraptOrigen.appendChild(tiTablaOrigen);

                        var rTable1 = document.createElement("div");
                        rTable1.classList.add("rTable");
                        wraptOrigen.appendChild(rTable1);

                        var headTabla1 = document.createElement("div");
                        headTabla1.classList.add("rTableRow");
                        headTabla1.classList.add("rTableHeading");
                        rTable1.appendChild(headTabla1);

                        var h1col1 = document.createElement("div");
                        h1col1.classList.add("rTableHead");
                        h1col1.innerHTML = "\u00A0";
                        headTabla1.appendChild(h1col1);

                        var h1col2 = document.createElement("div");
                        h1col2.classList.add("rTableHead");
                        h1col2.innerHTML = "C\u00F3digo";
                        headTabla1.appendChild(h1col2);

                        var h1col3 = document.createElement("div");
                        h1col3.classList.add("rTableHead");
                        h1col3.innerHTML = "Descripci\u00F3n";
                        headTabla1.appendChild(h1col3);

                        var h1col4 = document.createElement("div");
                        h1col4.classList.add("rTableHead");
                        h1col4.innerHTML = "Cantidad OC";
                        headTabla1.appendChild(h1col4);

                        var h1col5 = document.createElement("div");
                        h1col5.classList.add("rTableHead");
                        h1col5.innerHTML = "Valor UN";
                        headTabla1.appendChild(h1col5);

                        var cantoc1 = 0;
                        var suma1 = 0;
                        var cantoc2 = 0;
                        var suma2 = 0;
                        var promedio1 = 0;
                        var promedio2 = 0;
                        var difCantoc = 0;
                        var difPromedio = 0;
                        var sumPromReal = 0;
                        var sumPromOferta = 0;

                        for(var i=0; i<jdata[1].length; i++){
                            var filas1 = document.createElement("div");
                            filas1.classList.add("rTableRow");
                            rTable1.appendChild(filas1);

                            var index = document.createElement("div");
                            index.classList.add("rTableCell");
                            index.innerHTML = i + 1;
                            filas1.appendChild(index);

                            for(var j=0; j<4; j++){
                                var cols1 = document.createElement("div");
                                cols1.classList.add("rTableCell");
                                if(j==3){
                                    cols1.innerHTML = queryManager.formatNumber(jdata[1][i][j]);
                                }else{
                                    cols1.innerHTML = jdata[1][i][j];
                                }
                                filas1.appendChild(cols1);
                            }
                            cantoc1 = parseInt(cantoc1) + parseInt(jdata[1][i][2]);
                            suma1 = parseInt(suma1) + parseInt(jdata[1][i][3]);
                        }
                        promedio1 = parseInt(suma1/(parseInt(jdata[1].length)));

                        //Empieza generación de tabla local
                        var wraptLocal = document.createElement("div");
                        wraptLocal.classList.add("wrap-table");
                        wrap.appendChild(wraptLocal);

                        var tiTablaLocal = document.createElement("h3");
                        tiTablaLocal.innerHTML = "TABLA COSTO OFERTA";
                        wraptLocal.appendChild(tiTablaLocal);

                        var rTable2 = document.createElement("div");
                        rTable2.classList.add("rTable");
                        wraptLocal.appendChild(rTable2);

                        var headTabla2 = document.createElement("div");
                        headTabla2.classList.add("rTableRow");
                        headTabla2.classList.add("rTableHeading");
                        rTable2.appendChild(headTabla2);

                        var h2col1 = document.createElement("div");
                        h2col1.classList.add("rTableHead");
                        h2col1.innerHTML = "\u00A0";
                        headTabla2.appendChild(h2col1);

                        var h2col2 = document.createElement("div");
                        h2col2.classList.add("rTableHead");
                        h2col2.innerHTML = "C\u00F3digo";
                        headTabla2.appendChild(h2col2);

                        var h2col3 = document.createElement("div");
                        h2col3.classList.add("rTableHead");
                        h2col3.innerHTML = "Descripci\u00F3n";
                        headTabla2.appendChild(h2col3);

                        var h2col4 = document.createElement("div");
                        h2col4.classList.add("rTableHead");
                        h2col4.innerHTML = "Cantidad OC";
                        headTabla2.appendChild(h2col4);

                        var h2col5 = document.createElement("div");
                        h2col5.classList.add("rTableHead");
                        h2col5.innerHTML = "Valor UN";
                        headTabla2.appendChild(h2col5);

                        for(var i=0; i<jdata[2].length; i++){
                            var filas2 = document.createElement("div");
                            filas2.classList.add("rTableRow");
                            rTable2.appendChild(filas2);

                            var index2 = document.createElement("div");
                            index2.classList.add("rTableCell");
                            index2.innerHTML = i + 1;
                            filas2.appendChild(index2);

                            for(var j=0; j<4; j++){
                                var cols2 = document.createElement("div");
                                cols2.classList.add("rTableCell");
                                if(j==3){
                                    cols2.innerHTML = queryManager.formatNumber(jdata[2][i][j]);
                                }else{
                                    cols2.innerHTML = jdata[2][i][j];
                                }
                                filas2.appendChild(cols2);
                            }
                            cantoc2 = parseInt(cantoc2) + parseInt(jdata[2][i][2]);
                            suma2 = parseInt(suma2) + parseInt(jdata[2][i][3]);
                        }
                        promedio2 = parseInt(suma2/(parseInt(jdata[2].length)));
                        //Condiciones para marcar
                        difCantoc = parseInt(cantoc2 - cantoc1);
                        difPromedio = parseInt(promedio2 - promedio1);
                        sumPromReal = parseInt(promedio1 * cantoc1);
                        sumPromOferta = parseInt(promedio2 * cantoc2);

                        var contCantocOrigen = document.getElementById("cantoc-origen");
                        contCantocOrigen.innerHTML = queryManager.formatNumber(cantoc1);

                        var contPromOrigen = document.getElementById("prom-origen");
                        contPromOrigen.innerHTML = queryManager.formatNumber(promedio1);

                        var contCantocLocal = document.getElementById("cantoc-local");
                        contCantocLocal.innerHTML = queryManager.formatNumber(cantoc2);

                        var contPromLocal = document.getElementById("prom-local");
                        contPromLocal.innerHTML = queryManager.formatNumber(promedio2);

                        var contDiffOC = document.getElementById("diff-cant-oc");
                        contDiffOC.innerHTML = queryManager.formatNumber(difCantoc);

                        var contDiffProm = document.getElementById("diff-prom-val");
                        contDiffProm.innerHTML = queryManager.formatNumber(difPromedio);

                        var contSumPromReal = document.getElementById("sumprom-total-real");
                        contSumPromReal.innerHTML = queryManager.formatNumber(sumPromReal);

                        var contSumPromOferta = document.getElementById("sumprom-total-oferta");
                        contSumPromOferta.innerHTML = queryManager.formatNumber(sumPromOferta);

                        if(difCantoc < 0 && cantoc2!=0){
                            var cantocWarn = document.getElementById("cantoc-diff");
                            cantocWarn.classList.add("warning");
                        }else{
                        }
                        if(difPromedio < 0 && promedio2!=0){
                            var promWarn = document.getElementById("prom-diff");
                            promWarn.classList.add("warning");
                        }else{

                        }

                        result.classList.remove("anim-out");
                        result.classList.add("anim-in");
                        wrap.classList.remove("anim-out");
                        wrap.classList.add("anim-in");
                    },400);
                }
            });
        }

    },
    formatNumber: function(numero){
        // Variable que contendra el resultado final
       var resultado = "";

       // Si el numero empieza por el valor "-" (numero negativo)
       if(numero.toString().substring(0,1)=="-"){
           // Cogemos el numero eliminando los posibles puntos que tenga, y sin
           // el signo negativo
           nuevoNumero=numero.toString().replace(/\./g,'').substring(1);
       }else{
           // Cogemos el numero eliminando los posibles puntos que tenga
           nuevoNumero=numero.toString().replace(/\./g,'');
       }

       // Si tiene decimales, se los quitamos al numero
        if(numero.toString().indexOf(",")>=0) nuevoNumero=nuevoNumero.substring(0,nuevoNumero.indexOf(","));

        // Ponemos un punto cada 3 caracteres
        for (var j, i = nuevoNumero.length - 1, j = 0; i >= 0; i--, j++) resultado = nuevoNumero.charAt(i) + ((j > 0) && (j % 3 == 0)? ".": "") + resultado;

        // Si tiene decimales, se lo añadimos al numero una vez forateado con
        // los separadores de miles
        if(numero.toString().indexOf(",")>=0) resultado+=numero.toString().substring(numero.indexOf(","));

        if(numero.toString().substring(0,1)=="-"){

            return "-"+resultado;
        }
        else{
            return resultado;
        }
    },
    limpiaParent: function(contenedor){
        var node = document.getElementById(contenedor);
        while (document.getElementById(contenedor).hasChildNodes()){              // selected elem has children
            if (node.hasChildNodes()){                // current node has children
                node = node.lastChild;                 // set current node to child
            }
            else{                                     // last child found
                //console.log(node.nodeName);
                node = node.parentNode;                // set node to parent
                node.removeChild(node.lastChild);      // remove last node
            }
        }
    }

}
