<?php 
ob_start();
session_start();
if (!isset($_SESSION["name"])){
    header("Location: login.html");
} else {
require 'header.php'; 
?>

<!-- CONTENIDO -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="row">
            <!-- /.col-md12 -->
            <div class="col-md-12">
                <!--fin box-->
                <div class="box">
                    <!--box-header-->
                    <div class="box-header with-border">
                        <h1 class="box-title">Lista de usuarios <button id="btnAdd" class="btn btn-success" onclick="showForm(true);"><i class="fa fa-plus-circle"></i> Agregar</button></h1>
                        <div class="box-tools pull-right"></div>
                    </div>
                    <!--box-header-->
                    <!--centro-->
                    <!--tabla para listar datos-->
                    <div class="panel-body table-responsive" id="list_records">
                        <table id="tb-list" class="table table-striped table-bordered table-condensed table-hover">
                            <thead>
                                <th>Opciones</th>
                                <th>Nombre</th>
                                <th>Apellidos</th>
                                <th>Usuario</th>
                                <th>Correo</th>
                                <th>Imagen</th>
                                <th>Estado</th>
                            </thead>
                            <tbody></tbody>
                            <tfoot>
                                <th>Opciones</th>
                                <th>Nombre</th>
                                <th>Apellidos</th>
                                <th>Usuario</th>
                                <th>Correo</th>
                                <th>Imagen</th>
                                <th>Estado</th>
                            </tfoot>
                        </table>
                    </div>
                    <!--fin tabla para listar datos-->
                    <!--formulatio para datos-->
                    <div class="panel-body" id="form_register_user">
                        <form action="" name="form_user" id="form_user" method="POST">
                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <label for="">Nombre(*):</label>
                                <input class="form-control" type="hidden" name="id_user" id="id_user">
                                <input class="form-control" type="text" name="name_user" id="name" maxlength="100" placeholder="Nombre" required>
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <label for="">Apellidos(*):</label>
                                <input class="form-control" type="text" name="last_name_user" id="last_name" maxlength="100" placeholder="Apellidos" required>
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <label for="">Correo: </label>
                                <input class="form-control" type="email" name="email_user" id="email_user" maxlength="70" placeholder="Correo electronico">
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <label for="">Usuario(*):</label>
                                <input class="form-control" type="text" name="username_user" id="username_user" maxlength="20" placeholder="Nombre de usuario" required>
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <label for="">Contraseña de ingreso(*):</label>
                                <input class="form-control" type="password" name="password_user" id="password_user" maxlength="64" placeholder="Contraseña">
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <label for="">Imagen:</label>
                                <input class="form-control filestyle" data-buttonText="Seleccionar foto" type="file" name="image_user" id="image_user">
                                <input type="hidden" name="current_image" id="current_image">
                                <img src="" alt="" width="150px" height="120" id="image_shows">
                            </div>
                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn btn-primary" type="submit" id="btn_saver_user"><i class="fa fa-save"></i> Guardar</button>
                                <button class="btn btn-danger" onclick="cancelForm()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
                            </div>
                        </form>
                    </div>
                    <!--fin formulatio para datos-->
                    <!--fin centro-->
                </div>
                <!--fin box-->
            </div>
            <!-- /.col-md12 -->
        </div>
        <!-- fin Default-box -->
    </section>
    <!-- /.content -->
</div>
<!-- FIN CONTENIDO -->
<?php 
require 'footer.php'; 
?>
<script src="scripts/user.js"></script>
<?php }
ob_end_flush();
?>