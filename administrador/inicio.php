<?php include('template/cabecera.php'); ?>

<div class="col-md-12">
    <div class="jumbotron" style="display: flex;">
        <div class="col-md-7">
            <h1 class="display-3">Bienvenido <?php echo $nombreUsuario; ?></h1>
            <p class="lead">Bienvenido seas al portal web Librarex, a continuación te invitamos a administrar todo tipo de libros en Librarex.</p>
            <p class="lead">Esperamos disfrutes tu estadía en nuestro portal. Suerte !!!</p>
            <hr class="my-2">
            <p>Más información</p>
            <p class="lead">
                <a class="btn btn-primary btn-lg" href="seccion/productos.php" role="button">Administrar Libros</a>
            </p>
        </div>
        <div style="margin: -2%; margin-left: 2%;" class="col-md-5">

        <?php 
            include("./config/bd.php");

            /**
             * Sentencia SQL para obtener la imagen del usuario que ha iniciado sesión.
             */
            $sentenciaSQL = $conexion->prepare("SELECT imagen FROM usuarios WHERE usuario = :usuario");
            $sentenciaSQL->bindParam(':usuario', $nombreUsuario);
            $sentenciaSQL->execute();
            $usuario = $sentenciaSQL->fetch(PDO::FETCH_LAZY);
        ?>

        <img width="95%" src="../img/<?php echo $usuario['imagen']; ?>">
        </div>
    </div>   
</div>

<?php include('template/pie.php'); ?>