<?php
if (empty($_POST["oculto"]) || empty($_POST["txtnombres"]) || empty($_POST["txtApellidos"]) || empty($_POST["txtDNI"]) || empty($_POST["txtOrigen"]) || empty($_POST["txtDestino"]) || empty($_POST["txtcelular"]) || empty($_POST["txtMonto"])) {
    header('Location: index.php?mensaje=falta');
    exit();
}

include_once 'model/conexion.php';
$nombres = $_POST["txtnombres"];
$apellidos = $_POST["txtApellidos"];
$DNI = $_POST["txtDNI"];
$Origen = $_POST["txtOrigen"];
$Destino = $_POST["txtDestino"];
$celular = $_POST["txtcelular"];
$Monto = $_POST["txtMonto"];

$sentencia = $bd->prepare("INSERT INTO pasajeros(nombres, Apellidos, DNI, Origen, Destino, celular, Monto) VALUES (?, ?, ?, ?, ?, ?, ?)");
$resultado = $sentencia->execute([$nombres, $apellidos, $DNI, $Origen, $Destino, $celular, $Monto]);

if ($resultado === TRUE) {
    header('Location: index.php?mensaje=registrado');
} else {
    header('Location: index.php?mensaje=error');
    exit();
}

