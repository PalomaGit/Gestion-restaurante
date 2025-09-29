<?php
require 'db.php';

if ($accion === "alta") {
    $sql = "INSERT INTO reservas (nombre_cliente, telefono, fecha, hora, num_personas, notas)
            VALUES ('$nombre', '$telefono', '$fecha', '$hora', '$num_personas', '$notas')";
    mysqli_query($conexion, $sql);
}
header("Location: index.php");
?>
