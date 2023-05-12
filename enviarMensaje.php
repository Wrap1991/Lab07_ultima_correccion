<?php
if (!isset($_GET['codigo'])) {
    header('Location: index.php?mensaje=error');
    exit();
}

include 'model/conexion.php';
$codigo = $_GET['codigo'];

$sentencia = $bd->prepare("SELECT pro.promocion, pro.duracion , pro.id_persona, per.nombres, per.celular   
  FROM promociones pro 
  INNER JOIN pasajeros per ON per.id = pro.id_persona 
  WHERE pro.id = ?;");
$sentencia->execute([$codigo]);
$persona = $sentencia->fetch(PDO::FETCH_OBJ);

    $url = 'https://api.green-api.com/waInstance1101818726/SendMessage/393c0cb4136b4f828f8b3ccb164675a2ee4cabf0630448cf85';
    $data = [
        "chatId" => "51".$persona->celular."@c.us",
        "message" =>  'Estimado(a) '.strtoupper($persona->nombres).' No se pierda '.strtoupper($persona->promocion).' valido solo por '.strtoupper($persona->duracion)
    ];
    $options = array(
        'http' => array(
            'method'  => 'POST',
            'content' => json_encode($data),
            'header' =>  "Content-Type: application/json\r\n" .
                "Accept: application/json\r\n"
        )
    );

    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    $response = json_decode($result);
    header('Location: agregarPromocion.php?codigo='.$persona->id_persona);
?> 
