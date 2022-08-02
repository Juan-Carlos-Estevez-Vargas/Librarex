<?php include('../template/cabecera.php'); ?>
<?php
    $txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
    $txtNombre = (isset($_POST['txtNombre'])) ? $_POST['txtNombre'] : "";
    $txtImagen = (isset($_FILES['txtImagen']['name'])) ? $_FILES['txtImagen']['name'] : "";
    $accion = (isset($_POST['accion'])) ? $_POST['accion'] : "";

    // Conexión a la base de datos
    $host = "localhost";
    $bd = "website-administracion-libros-programacion";
    $usuario = "root";
    $contrasenia = "";

    try {
        $conexion = new PDO("mysql:host=$host;dbname=$bd", $usuario, $contrasenia);
        if ($conexion) { echo "Conectado... a sistema"; }
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }

    switch ($accion) {
        case "Agregar":
            $sentenciaSQL = $conexion->prepare("INSERT INTO `libros` (`id`, `nombre`, `imagen`) VALUES (NULL, 'perro', 'perro.jpg');"); 
            $sentenciaSQL->execute();
            echo "presionado agregar";
            break;
        case "Modificar":
            echo "presionado modificar";
            break;
        case "Cancelar":
            echo "presionado cancelar";
            break;
    }
?>

<div class="col-md-5">
    <div class="card">
        <div class="card-header">Datos del Libro</div>
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
                <div class = "form-group">
                    <label for="txtID">ID:</label>
                    <input type="text" class="form-control" name="txtID" id="txtID" placeholder="ID">
                </div>
                <div class = "form-group">
                    <label for="txtNombre">Nombre:</label>
                    <input type="text" class="form-control" name="txtNombre" id="txtNombre" placeholder="Nombre del libro">
                </div>
                <div class = "form-group">
                    <label for="txtImagen">Imagen</label>
                    <input type="file" class="form-control" name="txtImagen" id="txtImagen" placeholder="ID">
                </div>
                <div class="btn-group" role="group" aria-label="">
                    <button type="button" name="accion" value="Agregar" class="btn btn-success">Agregar</button>
                    <button type="button" name="accion" value="Modificar" class="btn btn-warning">Modificar</button>
                    <button type="button" name="accion" value="Cancelar" class="btn btn-info">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="col-md-7">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Imagen</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>2</td>
                <td>Libro</td>
                <td>Imagen</td>
                <td>Seleccionar | Borrar</td>
            </tr>
        </tbody>
    </table>
</div>

<?php include('../template/pie.php'); ?>