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
    <script src="../js/gestionActa.js"></script>
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
        <li class="breadcrumb-item active">Gestión de Actas</li>
        <li class="breadcrumb-item active" aria-current="page">Actas</li>
      </ol>
    </nav>
    </div>
  </div>
</div>
<!-- BREADCRUMB -->
<!-- Gestionar  -->
<div class="container-fluid">
        <div class="card">
            <div class="card-header bg-primary text-color-white">
                  <h5>Gestionar Actas</h5>
            </div>
            <div class="card-body">
            <div class="row">
                    <div class="col-12 col-sm-12 col-md-7 col-xl-7 mt-2">
                        <div class="btn-group-sm">
                            <button class="btn btn-success" id="guardar"  onclick="Guardar();"><span class="fa fa-save"></span>&nbsp&nbspGuardar</button>
                            <button class="btn btn-success" id="modificar" onclick="Modificar();"><span class="fa fa-pencil-alt"></span>&nbsp&nbspModificar</button>
                            <button class="btn btn-primary" id="cancelar" onclick="Cancelar();"><span class="fa fa-pencil-alt"></span>&nbsp&nbspCancelar</button>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-5 col-xl-5">
                        <div class="btn-toolbar pc-flex-end">
                            <div class="btn-group mt-2">
                                <button class="btn btn-success mr-2" type="submit" onclick="mostrarTodo();"><span class="fa fa-search"></span>&nbsp&nbspMostrar Todo</button>
                            </div>
                            <div class="input-group mt-2">
                                <select name="campoBuscar" id="campoBuscar" class="form-control mr-2">
                                    <option>Funcionario</option>
                                    <option>Activo</option>
                                </select>
                                <input class="form-control" id="idGestionActa"  type="search" placeholder="Buscar" aria-label="Buscar" autofocus>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mt-2">
                        <label for="funcionario">Funcionario</label>
                        <select name="idPersona" id="idPersona" class="form-control br">
                       </select>
                    </div>
                    <div class="col-md-6 mt-2">
                        <label for="activo">Activo</label>
                        <datalist id="activo" name="activo">
                        </datalist>
                        <input id="codigoActivo" list="activo" class="form-control br" onkeypress="soloNumeros()">
                    </div>
                    <div class="col-md-6 mt-2">
                        <label for="custodio">Custodio</label>
                        <select name="custodio" id="custodio" class="form-control br">
                       </select>
                    </div>
                    <div class="col-md-6 mt-2">
                        <label for="fecha">Fecha</label>
                        <input type="date" id="fecha" class="form-control">
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <table class="table tabled-bordered table-sm" id="tablaUsuario">
                    <thead>
                        <tr>
                            <th>Funcionario</th>
                            <th>Codigo activo</th>
                            <th>Custodio</th>
                            <th>Fecha</th>
                            <th class="th-text-align-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="datos">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Gestionar  -->
</html>




















