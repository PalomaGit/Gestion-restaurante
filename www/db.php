<?php
$conexion = mysqli_connect("db", "root", "test");
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

$crearBd = mysqli_query($conexion, "CREATE DATABASE IF NOT EXISTS restaurante");
$usarBd = mysqli_select_db($conexion, "restaurante");

$crearTabla = mysqli_query($conexion, "CREATE TABLE IF NOT EXISTS reservas (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre_cliente VARCHAR(255) NOT NULL,
  telefono VARCHAR(50),
  fecha DATE NOT NULL,
  hora TIME NOT NULL,
  num_personas INT NOT NULL,
  notas TEXT,
  UNIQUE KEY uq_reserva (fecha, hora, nombre_cliente)
);");

$accion = $_POST["accion"] ?? "";
$id = $_POST["id"] ?? "";
$nombre = $_POST["nombre_cliente"] ?? "";
$telefono = $_POST["telefono"] ?? "";
$fecha = $_POST["fecha"] ?? "";
$hora = $_POST["hora"] ?? "";
$num_personas = $_POST["num_personas"] ?? "";
$notas = $_POST["notas"] ?? "";
$idAntiguo = $_POST["idAntiguo"] ?? "";
?>
