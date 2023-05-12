<?php include 'template/header.php' ?>

<?php
    if(!isset($_GET['codigo'])){
        header('Location: index.php?mensaje=error');
        exit();
    }

    include_once 'model/conexion.php';
    $codigo = $_GET['codigo'];

    $sentencia = $bd->prepare("select * from pasajeros where id = ?;");
    $sentencia->execute([$codigo]);
    $pasajeros = $sentencia->fetch(PDO::FETCH_OBJ);
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Editar datos:
                </div>
                <form class="p-4" method="POST" action="editarProceso.php">
                    <div class="mb-3">
                        <label class="form-label">nombres: </label>
                        <input type="text" class="form-control" name="txtnombres" required 
                        value="<?php echo $pasajeros->nombres; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Apellidos: </label>
                        <input type="text" class="form-control" name="txtApellidos" autofocus required
                        value="<?php echo $pasajeros->Apellidos; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">DNI: </label>
                        <input type="text" class="form-control" name="txtDNI" autofocus required
                        value="<?php echo $pasajeros->DNI; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Origen: </label>
                        <input type="text" class="form-control" name="txtOrigen" autofocus required
                        value="<?php echo $pasajeros->Origen; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Destino: </label>
                        <input type="varchar" class="form-control" name="txtDestino" autofocus required
                        value="<?php echo $pasajeros->Destino; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">celular: </label>
                        <input type="number" class="form-control" name="txtcelular" autofocus required
                        value="<?php echo $pasajeros->celular; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Monto: </label>
                        <input type="number" class="form-control" name="txtMonto" autofocus required
                        value="<?php echo $pasajeros->Monto; ?>">
                    </div>
                    <div class="d-grid">
                        <input type="hidden" name="codigo" value="<?php echo $pasajeros->id; ?>">
                        <input type="submit" class="btn btn-primary" value="Editar">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

