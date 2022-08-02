<?php include('../template/cabecera.php'); ?>

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
                    <label for="txtID">Imagen</label>
                    <input type="file" class="form-control" name="txtID" id="txtID" placeholder="ID">
                </div>
                <div class="btn-group" role="group" aria-label="">
                    <button type="button" class="btn btn-success">Agregar</button>
                    <button type="button" class="btn btn-warning">Modificar</button>
                    <button type="button" class="btn btn-info">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="col-md-7">
    
</div>

<?php include('../template/pie.php'); ?>