<?php 
ob_start();
session_start();
if (!isset($_SESSION["name"])){
    header("Location: login.html");
}else{
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
                        <h1 class="box-title">Lista de empleados <button id="btnAdd" class="btn btn-success" onclick="showForm(true);"><i class="fa fa-plus-circle"></i> Agregar</button></h1>
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
                                <th>Documento</th>
                                <th>Telefono</th>
                                <th>Codigo</th>
                            </thead>
                            <tbody></tbody>
                            <tfoot>
                                <th>Opciones</th>
                                <th>Nombre</th>
                                <th>Apellidos</th>
                                <th>Documento</th>
                                <th>Telefono</th>
                                <th>Codigo</th>
                            </tfoot>
                        </table>
                    </div>
                    <!--fin tabla para listar datos-->
                    <!--formulatio para datos-->
                    <div class="panel-body" id="form_register_employee">
                        <form action="" name="form_employee" id="form_employee" method="POST">
                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <label for="">Nombre(*):</label>
                                <input class="form-control" type="hidden" name="id_employee" id="id_employee">
                                <input class="form-control" type="text" name="name_employee" id="name" maxlength="100" placeholder="Nombre" required>
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <label for="">Apellidos(*):</label>
                                <input class="form-control" type="text" name="last_name_employee" id="last_name" maxlength="100" placeholder="Apellidos" required>
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <label for="">Documento (*): </label>
                                <input class="form-control" type="text" name="document_employee" id="document_employee" maxlength="70" placeholder="Documento" required>
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <label for="">Telefono(*):</label>
                                <input class="form-control" type="text" name="phone_employee" id="phone_employee" maxlength="20" placeholder="Numero de telefono" required>
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <label for="">Codigo de asistencia (*):</label>
                                <input class="form-control" type="text" name="code_employee" id="code_employee" maxlength="64" placeholder="Codigo de asistencia" required>
                            </div>
                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn btn-primary" type="submit" id="btn_saver_employee"><i class="fa fa-save"></i> Guardar</button>
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
<?php require 'footer.php'; ?>
<script src="scripts/employee.js"></script>
<?php }
ob_end_flush();
?>