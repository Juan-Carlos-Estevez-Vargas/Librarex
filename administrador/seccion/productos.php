<?php include('../template/cabecera.php'); ?>
<?php

    /**
     * Obtención de los datos obtenidos por el formulario de registro
     * de un nuevo libro.
     */
    $txtID = (isset($_POST["txtID"])) ? $_POST["txtID"] : "";
    $txtNombre = (isset($_POST['txtNombre'])) ? $_POST['txtNombre'] : "";
    $txtImagen = (isset($_FILES['txtImagen']['name'])) ? $_FILES['txtImagen']['name'] : "";
    $txtLibro = (isset($_FILES['txtLibro']['name'])) ? $_FILES['txtLibro']['name'] : "";
    $accion = (isset($_POST['accion'])) ? $_POST['accion'] : "";
    $categoria = (isset($_POST['categoria'])) ? $_POST['categoria'] : "";

    include('../config/bd.php');

    /**
     * Validando la acción solicitada por el usuario.
     */
    switch ($accion) {
        case "Agregar":
            $sentenciaSQL = $conexion->prepare("INSERT INTO libros (nombre, imagen, categoria, libro) VALUES (:nombre, :imagen, :categoria, :libro);"); 
            $sentenciaSQL->bindParam(':nombre', $txtNombre);

            /**
             * Generación del nombre de la imagen del libro.
             */
            $fecha = new DateTime();
            $nombreArchivo = ($txtImagen != "") ? $fecha->getTimestamp()."_".$_FILES["txtImagen"]["name"] : "default.jpg";

            $tmpImagen = $_FILES["txtImagen"]["tmp_name"];

            /**
             * Moviendo la imagen a la carpeta imagenes del proyecto.
             */
            if ($tmpImagen != "") {
                move_uploaded_file($tmpImagen, "../../img/".$nombreArchivo);
            }

            $sentenciaSQL->bindParam(':imagen', $nombreArchivo);
            $sentenciaSQL->bindParam(':categoria', $categoria);

            /**
             * Generación del nombre del libro en pdf.
             */
            $fecha = new DateTime();
            $nombreLibro = ($txtLibro != "") ? $fecha->getTimestamp()."_".$_FILES["txtLibro"]["name"] : "default.pdf";

            $tmpLibro = $_FILES["txtLibro"]["tmp_name"];

            /**
             * Moviendo el libro a la carpeta libros del proyecto.
             */
            if ($tmpLibro != "") {
                move_uploaded_file($tmpLibro, "../../libros/".$nombreLibro);
            }

            $sentenciaSQL->bindParam(':libro', $nombreLibro);
            $sentenciaSQL->execute();

            header("Location:productos.php");
            break;

        case "Modificar":

            /**
             * Sentencia SQL para actualizar los libros.
             */
            $sentenciaSQL = $conexion->prepare("UPDATE libros SET nombre = :nombre, categoria = :categoria WHERE id = :id");
            $sentenciaSQL->bindParam(':nombre', $txtNombre);
            $sentenciaSQL->bindParam(':categoria', $categoria);
            $sentenciaSQL->bindParam(':id', $txtID);
            $sentenciaSQL->execute();

            if ($txtImagen != ""){

                /**
                 * Obteniendo la imagen del proyecto.
                 */
                $fecha = new DateTime();
                $nombreArchivo = ($txtImagen != "") ? $fecha->getTimestamp()."_".$_FILES["txtImagen"]["name"] : "default.jpg";
                $tmpImagen = $_FILES["txtImagen"]["tmp_name"];

                /**
                 * Moviendo la nueva imagen a la carpeta imagenes del proyecto.
                 */
                move_uploaded_file($tmpImagen, "../../img/".$nombreArchivo);

                /**
                 * Obteniendo la imagen del libro directamente de la base de datos.
                 */
                $sentenciaSQL = $conexion->prepare("SELECT imagen FROM libros WHERE id = :id");
                $sentenciaSQL->bindParam(':id', $txtID);
                $sentenciaSQL->execute();
                $libro = $sentenciaSQL->fetch(PDO::FETCH_LAZY);
    
                /**
                 * Eliminando la imagen antigua de la carpeta img del proyecto.
                 */
                if ((isset($libro["imagen"])) && ($libro["imagen"] != "default.jpg")) {
                    if (file_exists("../../img/".$libro["imagen"])) {
                        unlink("../../img/".$libro["imagen"]);
                    }
                }

                /**
                 * Actualizando la imagen en la base de datos.
                 */
                $sentenciaSQL = $conexion->prepare("UPDATE libros SET imagen = :imagen WHERE id = :id");
                $sentenciaSQL->bindParam(':imagen', $nombreArchivo);
                $sentenciaSQL->bindParam(':id', $txtID);
                $sentenciaSQL->execute();
            }            

            header("Location:productos.php");
            break;

        case "Cancelar":
            header("Location:productos.php");
            break;

        case "Seleccionar":
            /**
             * Sentencia SQL para obtener un libro en específico.
             */
            $sentenciaSQL = $conexion->prepare("SELECT * FROM libros WHERE id = :id");
            $sentenciaSQL->bindParam(':id', $txtID);
            $sentenciaSQL->execute();
            $libro = $sentenciaSQL->fetch(PDO::FETCH_LAZY);

            $txtNombre = $libro['nombre'];
            $txtImagen = $libro['imagen'];
            break;

        case "Borrar":

            /**
             * Sentencia SQL para obtener la imagen de un libro de la base de datos.
             */
            $sentenciaSQL = $conexion->prepare("SELECT imagen FROM libros WHERE id = :id");
            $sentenciaSQL->bindParam(':id', $txtID);
            $sentenciaSQL->execute();
            $libro = $sentenciaSQL->fetch(PDO::FETCH_LAZY);

            /**
             * Eliminando la imagen encontrada de la carpeta img del proyecto.
             */
            if ((isset($libro["imagen"])) && ($libro["imagen"] != "default.jpg")) {
                if (file_exists("../../img/".$libro["imagen"])) {
                    unlink("../../img/".$libro["imagen"]);
                }
            }

            /**
             * Sentencia SQL para eliminar un libro de la base de datos.
             */
            $sentenciaSQL = $conexion->prepare("DELETE FROM libros WHERE id = :id");
            $sentenciaSQL->bindParam(':id', $txtID);
            $sentenciaSQL->execute();

            header("Location:productos.php");
            break;
    }

    /**
     * Listando los libros existentes en el sistema.
     */
    $sentenciaSQL = $conexion->prepare("SELECT * FROM libros");
    $sentenciaSQL->execute();
    $listaLibros = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="col-md-5">
    <div class="card">
        <div class="card-header">Datos del Libro</div>
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
                <div class = "form-group">
                    <!-- <label for="txtID">ID:</label> -->
                    <input type="hidden" class="form-control" value="<?php echo $txtID; ?>" name="txtID" id="txtID" placeholder="ID">
                </div>

                <div class = "form-group">
                    <label for="txtNombre">Nombre:</label>
                    <input type="text" required class="form-control" value="<?php echo $txtNombre; ?>" name="txtNombre" id="txtNombre" placeholder="Nombre del libro">
                </div>

                <div class = "form-group">
                    <label for="txtImagen">Imagen:</label>
                    <br />
                    <?php if ($txtImagen != "") { ?>
                        <img class="img-thumbnail rounded" src="../../img/<?php echo $txtImagen; ?>" width="35%" alt="" srcset="">
                    <?php } ?>

                    <input type="file" required class="form-control" name="txtImagen" id="txtImagen">
                </div>

                <div class = "form-group">
                    <label for="txtLibro">Libro:</label>
                    <input type="file" required class="form-control" name="txtLibro" id="txtLibro" placeholder="Ingresa el libro en pdf">
                </div>

                <div class = "form-group">
                    <label for="categoria">Categoria:</label>
                    <select name="categoria" id="categoria" required>
                        <option value="Programación">Programación</option>    
                        <option value="Suspenso">Suspenso</option>    
                    </select>
                </div>

                <div class="btn-group" role="group" aria-label="">
                    <button type="submit" name="accion" <?php echo ($accion == "Seleccionar") ? "disabled" : "" ?> value="Agregar" class="btn btn-success">Agregar</button>
                    <button type="submit" name="accion" <?php echo ($accion != "Seleccionar") ? "disabled" : "" ?> value="Modificar" class="btn btn-warning">Modificar</button>
                    <button type="submit" name="accion" <?php echo ($accion != "Seleccionar") ? "disabled" : "" ?> value="Cancelar" class="btn btn-info">Cancelar</button>
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
            <?php foreach($listaLibros as $libro) { ?>
            <tr>
                <td><?php echo $libro['id'] ?></td>
                <td><?php echo $libro['nombre'] ?></td>
                <td>
                    <img class="img-thumbnail rounded" src="../../img/<?php echo $libro['imagen'] ?>" width="100" alt="" srcset="">
                </td>
                <td>
                    <form method="POST">
                        <input type="hidden" name="txtID" id="txtID" value="<?php echo $libro['id'] ?>" />
                        <input type="submit" name="accion" value="Seleccionar" class="btn btn-primary" />
                        <input type="submit" name="accion" value="Borrar" class="btn btn-danger" />
                    </form>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
