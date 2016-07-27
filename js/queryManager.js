var queryManager = {
    getTable : function(){
        var tabla = document.getElementById("querytable");
        var nombreTabla = tabla.options[tabla.selectedIndex].text;

        var ajaxRequest= $.ajax({
            type: "POST",
            data: {'table': nombreTabla},
            url: 'controllers/admin/Select.php',
            success: function(response){
                var jdata = JSON.parse(decodeURI(response));
                //window.alert(jdata);
                var wrap = document.getElementById("contenido-query").firstElementChild;
                wrap.classList.remove("anim-in");
                wrap.classList.add("anim-out");
                window.setTimeout(function(){
                    wrap.innerHTML = jdata;
                    /*
                    for(var i=0; i<jdata[1].length; i++){
                        if(i==0){
                            wrap.appendChild(document.createElement("div"));
                            wrap.firstElementChild.classList.add("table-titles");
                        }else{
                            wrap.appendChild(document.createElement("div"));
                        }
                        for(var j=0; j<jdata[0]; j++){
                            window.alert(j);
                        }
                    }*/

                    wrap.classList.remove("anim-out");
                    wrap.classList.add("anim-in");
                },400);
                /*
                for(var i=0; i<jdata[0].length; i++){
                    contenedor.innerHTML = contenedor.innerHTML + jdata[0][i]+" ";
                }*/

            }
        });


    },
    controlCostoPrimera: function(){
        
    }
}
