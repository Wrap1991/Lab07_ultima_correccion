<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $campos_requeridos = ['codigo', 'txtnombres', 'txtApellidos', 'txtDNI', 'txtOrigen', 'txtDestino', 'txtcelular', 'txtMonto'];
    $campos_validos = true;
    foreach ($campos_requeridos as $campo) {
        if (empty($_POST[$campo])) {
            $campos_validos = false;
            break;
        }
    }

    if (!$campos_validos) {
        header('Location: index.php?mensaje=error');
        exit();
    }

    include 'model/conexion.php';

    $codigo = $_POST['codigo'];
    $nombres = $_POST['txtnombres'];
    $Apellidos = $_POST['txtApellidos'];
    $DNI = $_POST['txtDNI'];
    $Origen = $_POST['txtOrigen'];
    $Destino = $_POST['txtDestino'];
    $celular = $_POST['txtcelular'];
    $Monto = $_POST['txtMonto'];

    $sentencia = $bd->prepare("UPDATE pasajeros SET nombres = ?, Apellidos = ?, DNI= ?, Origen = ?, Destino = ?,celular= ? ,Monto= ? where id = ?;");
    $resultado = $sentencia->execute([$nombres, $Apellidos, $DNI, $Origen, $Destino, $celular, $Monto, $codigo]);

    if ($resultado) {
        header('Location: index.php?mensaje=editado');
        exit();
    } else {
        header('Location: index.php?mensaje=error');
        exit();
    }
} else {
    header('Location: index.php');
    exit();
}
