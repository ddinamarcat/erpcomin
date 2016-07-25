var queryManager = {
    getTable : function(){
        var tabla = document.getElementById("querytable");
        var nombreTabla = tabla.options[tabla.selectedIndex].text;

        //selectManager(nombreTabla);
        /*
        var r = new XMLHttpRequest();
        r.open("POST", "controllers/admin/Select.php", true);
        r.onreadystatechange = function () {
        	if (r.readyState != 4 || r.status != 200) return;
        	console.log("success!!!");
        };
        r.send(nombreTabla);
        console.log(r);*/

        var ajaxRequest= $.ajax({
            url: "controllers/admin/Select.php",
            type: "post",
            data: nombreTabla,
            success: function(response){
                var consulta = response;
                //window.alert(consulta);
                /*obj = JSON.parse(decodeURI(consulta));
                console.log(obj);*/
            }
        });


        var contenedor = document.getElementById("contenido-query");
        //var query = JSON.parse(decodeURI('ajaxRequest'));
        //console.log(JSON.stringify(ajaxRequest));
    }
}
