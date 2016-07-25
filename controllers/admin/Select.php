<?php
    $conn = mysqli_connect("localhost","cominerp2016","_ERP_COMIN16_","erpcomin");
    //$tablasel = "manoobra";
    $tablasel = $_POST["nombreTabla"];
    $query = "SELECT * FROM ".$tablasel;
    $consulta = mysqli_query($conn,$query);
    $fields = mysqli_fetch_fields($consulta);
    $num_cols = mysqli_num_fields($consulta);
    $num_rows = mysqli_num_rows($consulta);
    $i = 0;
?>
<script>
    window.alert("Estoy en Select.php");
    var ntabla = '<?php echo $tablasel; ?>';
</script>
<?php
    $fieldnames=array();
    $data = array();
    //Se agregan los nombres de las columnas

    while ($fieldinfo=mysqli_fetch_field($consulta)){
        $fieldnames[$i] = $fieldinfo->name;
        $i = $i + 1;
    }

    while($resultados = mysqli_fetch_array($consulta)) {
            $data[] = $resultados;
	};

    $returned = array($fieldnames, $data);

    //Imprime los nombres de las columnas
    for($j=0; $j<$num_cols; $j++){
        echo $returned[0][$j]." ";
    }
    //Imprime data

    echo "</br>";
    for($i=0; $i<$num_rows; $i++){
        for($j=0; $j<$num_cols; $j++){
            echo $returned[1][$i][$j]." ";
        }
        echo "</br>";
    }
    //Fin while $resultados
    return json_encode($returned, JSON_UNESCAPED_UNICODE);
?>
