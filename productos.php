<?php 
    include("template/cabecera.php"); 
    include("administrador/config/bd.php");

    /**
     * Sentencia SQL para obtener un listado de libros.
     */
    $sentenciaSQL = $conexion->prepare("SELECT * FROM libros");
    $sentenciaSQL->execute();
    $listaLibros = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- Listado de los libros en formato HTML -->
<?php foreach ($listaLibros as $libro) { ?>
<div class="col-md-3">  
    <div class="card">
        <img class="card-img-top" src="./img/<?php echo $libro["imagen"]; ?>" alt="">
        <div class="card-body">
            <h4 class="card-title"><?php echo $libro["nombre"]; ?></h4>
            <a name="" id="" class="btn btn-primary" download href="./libros/<?php echo $libro['libro'];?>" role="button"> Descargar </a>
        </div>
    </div>
</div>
<?php } ?>

<?php include("template/pie.php"); ?>