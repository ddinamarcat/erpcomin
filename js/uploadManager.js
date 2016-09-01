var uploadManager = {
    sendReal: function(){
        var form = document.getElementById("carga-excelreal");
        var nameOr = form.value;
        var splited = nameOr.split("\\");
        var largo = splited.length;
        var name = splited[largo-1];
        var file = form.files;
        var formData = new FormData();
        formData.append('file', file);
        formData.append('name', name);
        //window.alert(name);

        var ajaxRequest= $.ajax({
              url:"controllers/admin/UploadCostoReal.php",
              data: formData, // the formData function is available in almost all new browsers.
              type:"POST",
              contentType:false,
              processData:false,
              cache:false,
              success:function(response){
                  console.log(response);
              }
        });
    }

}
