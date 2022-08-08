<?php
    include('./config/bd.php');

    // Inicia la sesión del usuario en memoria.
    session_start();

    /**
     * Obtención de los datos enviados en el formulario.
     */
    $txtUsuario = (isset($_POST["usuario"])) ? $_POST["usuario"] : "";
    $txtPassword = (isset($_POST["contrasenia"])) ? $_POST["contrasenia"] : "";

    /**
     * Sentencia SQL para obtener las credenciales de acceso del usuario en 
     * cuestión.
     */
    $sentenciaSQL = $conexion->prepare("SELECT usuario, password FROM usuarios WHERE usuario = :usuario AND password = :password");
    $sentenciaSQL->bindParam(':usuario', $txtUsuario);
    $sentenciaSQL->bindParam(':password', $txtPassword);
    $sentenciaSQL->execute();
    $usuario = $sentenciaSQL->fetch(PDO::FETCH_LAZY);

    /**
     * Validando que los datos se hayan enviado por el método POST.
     * Validando que las credenciales del usuario coincidan con las
     * obtenidas de la base de datos.
     */
    if ($_POST) {
        if (($_POST["usuario"] == $usuario['usuario']) && ($_POST["contrasenia"] == $usuario['password'])) {
            $_SESSION["usuario"] = "ok";
            $_SESSION["nombreUsuario"] = $usuario['usuario'];
            header('Location:inicio.php');
        } else {
            $mensaje = "Error. El usuario y/o contraseña incorrectos";
        }
    }
?>

<!doctype html>
<html lang="en">
  <head>
    <title>Administrador del sitio web</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <br/><br/><br/><br/>
                <div class="card">
                    <div class="card-header">Login</div>
                    <div class="card-body">

                        <?php if (isset($mensaje)) { ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $mensaje; ?>
                            </div>
                        <?php } ?>
                        <form method="POST">
                            <div class = "form-group">
                                <label>Usuario:</label>
                                <input type="text" class="form-control" name="usuario" placeholder="Ingresa tu usuario.">
                            </div>
                            <div class="form-group">
                                <label>Contraseña:</label>
                                <input type="password" class="form-control" name="contrasenia" placeholder="Ingresa tu contraseña.">
                            </div>
                            <button type="submit" class="btn btn-primary">Entrar al administrador</button>
                        </form>           
                    </div>
                </div>
            </div>     
        </div>
    </div>
  </body>   
</html>