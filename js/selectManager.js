var selectManager = function(tabla){
    var tablaJson = tabla.serialize();

    var ajaxRequest= $.ajax({
        url: "controllers/admin/Consulta.php",
        type: "post",
        dataType: "json",
        data: tablaJson
    });
    console.log(ajaxRequest)

}
