<?php
    require '../modelo/login.modelo.php';
    if($_SESSION['user'] == ""){
    	header('Location: ../');
    }
?>
<!doctype html>
<html lang="es">
  <head>
    <title>Actfast CNE</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="descriptions" content="Sistema para la generación de actas y control de inventario CNE - Delegación Pastaza">
    <meta name="author" content="Angel Miguel Loor Manzano - CODERS">
    <link rel="icon" type="image/png" href="../assets/img/logo.png"/>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <script src="../assets/js/jquery.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <!-- FONTAWESOME -->
    <link rel="stylesheet" href="../assets/css/all.min.css">
    <!-- SWEET ALERT -->
    <link href="../assets/css/dark.css" rel="stylesheet">
    <script src="../assets/js/sweetalert2.min.js"></script>
    <!-- SCRIPTS -->
    <script src="../assets/js/all.min.js"></script>
    <script src="../assets/js/jquery.js"></script>
    <script src="../js/reporteActivo.js"></script>
    <link rel="stylesheet" href="../assets/css/main.css">
  </head>
  <body>
  <!-- HEADER -->
  <?php
      require 'header.php';
  ?>
  <!-- HEADER -->
<!-- BREADCRUMB -->
<div class="container-fluid text-center">
  <div class="row align-items-center">
    <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 mt-2">
        <nav aria-label="breadcrumb bg-light">
      <ol class="breadcrumb bg-transparent">
        <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
        <li class="breadcrumb-item active">Reportes</li>
        <li class="breadcrumb-item active" aria-current="page">Activos</li>
      </ol>
    </nav>
    </div>
  </div>
</div>
<!-- BREADCRUMB -->
<div class="container-fluid">
    <form action="../modelo/report.php" method="POST" target="blank">
        <div class="card">
            <div class="card-header bg-primary text-color-white">
                  <h5>Reporte de Activos</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-8 col-xl-8 mt-2">
                        <div class="btn-group-sm">
                            <button class="btn btn-success" id="consultar"><span class="fa fa-file-pdf"></span>&nbsp&nbspConsultar</button>
                            <button class="btn btn-success" id="generar"><span class="fa fa-file-pdf"></span>&nbsp&nbspPdf</button>
                            <button class="btn btn-success" id="excel"><span class="fa fa-file-pdf"></span>&nbsp&nbspExcel</button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-6 col-lg-6 mt-3">
                        <label for="campo">Campo</label>
                        <select name="campo" class="form-control br" id="campo">
                            <option value="Categoria">Categoria</option>
                            <option value="Marca">Marca</option>
                            <option value="Estado">Estado</option>
                            <option value="Custodio">Custodio</option>
                            <option value="Funcionario">Funcionario</option>
                       </select>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-6 mt-3">
                        <label for="marca">Valor del criterio</label>
                        <select name="marca" class="form-control br" id="marca">
                       </select>
                    </div>
                </div>

            </div>
            <div class="card-footer">
                <table class="table tabled-bordered table-sm" id="tablaUsuario">
                    <thead>
                        <tr>
                            <th>Codigo</th>
                            <th>Nombre</th>
                            <th>Marca</th>
                            <th>Modelo</th>
                            <th>Serie</th>
                            <th>Estado</th>
                            <th>Caracteristica</th>
                            <th>Custodio</th>
                        </tr>
                    </thead>
                    <tbody id="datos">

                    </tbody>
                </table>
            </div>
        </div>
    </form>
    </div>
    <!-- Gestionar  -->
</html>