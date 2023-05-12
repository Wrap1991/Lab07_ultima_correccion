<?php include 'template/header.php' ?>

<?php
    include_once "model/conexion.php";
    $sentencia = $bd -> query("select * from pasajeros");
    $pasajeros = $sentencia->fetchAll(PDO::FETCH_OBJ);
?>

<div class="container mt-2">
    <div class="row">
        <div class="col-sm-4">
                <div class="card text-white bg-dark mb-3">
                    <div class="card-header">
                        Ingresar datos:
                    </div>
                    <form class="p-4" method="POST" action="registrar.php">
                        <div class="mb-3">
                            <label class="form-label">Nombres: </label>
                            <input type="text" class="form-control" name="txtnombres" autofocus required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Apellidos: </label>
                            <input type="text" class="form-control" name="txtApellidos" autofocus required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">DNI: </label>
                            <input type="number" class="form-control" name="txtDNI" autofocus required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">ORIGEN: </label>
                            <input type="varchar" class="form-control" name="txtOrigen" autofocus required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Destino: </label>
                            <input type="varchar" class="form-control" name="txtDestino" autofocus required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Celular: </label>
                            <input type="number" class="form-control" name="txtcelular" autofocus required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Monto: </label>
                            <input type="number" class="form-control" name="txtMonto" autofocus required>
                        </div>
                        <div class="d-grid">
                            <input type="hidden" name="oculto" value="1">
                            <input type="submit" class="btn btn-primary" value="Registrar">
                        </div>
                    </form>
                </div>
            </div>
        <div class="col-sm-8">
                <?php 
                    if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'falta'){
                ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> Rellena todos los campos.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php 
                    }
                ?>


                <?php 
                    if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'registrado'){
                ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Se ha programado el vuelo :D!</strong> Se ha agendado.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php 
                    }
                ?>   
                
                

                <?php 
                    if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'error'){
                ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Algo salio mal :c</strong> Vuelve a intentar.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php 
                    }
                ?>   



                <?php 
                    if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'editado'){
                ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Editado :D!</strong> Los datos fueron actualizados.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php 
                    }
                ?> 


                <?php 
                    if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'eliminado'){
                ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Se ha Eliminado!</strong> Los datos fueron borrados.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php 
                    }
                ?> 

        <div class="card border-primary mb-3">
            <div class="card-header">
                        Lista de pasajeros
            </div>
                <div class="table-responsive">
                    <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nombres</th>
                                    <th scope="col">Apellidos</th>
                                    <th scope="col">DNI</th>
                                    <th scope="col">Origen</th>
                                    <th scope="col">Destino</th>
                                    <th scope="col">Celular</th>
                                    <th scope="col">Monto</th>
                                    <th scope="col" colspan="2">Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                <?php 
                                    foreach($pasajeros as $dato){ 
                                ?>

                                <tr>
                                    <td scope="row"><?php echo $dato->id; ?></td>
                                    <td><?php echo $dato->nombres; ?></td>
                                    <td><?php echo $dato->Apellidos; ?></td>
                                    <td><?php echo $dato->DNI; ?></td>
                                    <td><?php echo $dato->Origen; ?></td>
                                    <td><?php echo $dato->Destino; ?></td>
                                    <td><?php echo $dato->celular; ?></td>
                                    <td><?php echo $dato->Monto; ?></td>
                                    <td><a class="text-success" href="editar.php?codigo=<?php echo $dato->id; ?>"><i class="bi bi-pencil-square"></i></a></td>
                                    <td><a class="text-success" href="agregarPromocion.php?codigo=<?php echo $dato->id; ?>"><i class="bi bi-cart3"></i></a></td>
                                    <td><a onclick="return confirm('Estas seguro de eliminar?');" class="text-danger" href="eliminar.php?codigo=<?php echo $dato->id; ?>"><i class="bi bi-trash"></i></a></td>
                                </tr>

                                <?php 
                                    }
                                ?>

                            </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
