 <?php
  include_once "../config/global.php";
  if (strlen(session_id()) < 1)
    session_start();

  $pathName = explode("/", $_SERVER["REQUEST_URI"])[PATH_INDEX];
  ?>
 <!DOCTYPE html>
 <html>

 <head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <title><?php echo ucfirst(strtolower(str_replace("%20", " ", $pathName))); ?> | <?php echo PRO_NOMBRE ?></title>
   <!-- Tell the browser to be responsive to screen width -->
   <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
   <!-- Bootstrap 3.3.7 -->
   <link rel="stylesheet" href="../public/css/bootstrap.min.css">
   <!-- Font Awesome -->

   <link rel="stylesheet" href="../public/css/font-awesome.min.css">

   <link rel="stylesheet" href="../public/css/AdminLTE.min.css">
   <link rel="stylesheet" href="../public/css/_all-skins.min.css">
   <!-- Morris chart -->
   <!-- Daterange picker -->
   <link rel="stylesheet" href="img/apple-touch-ico.png">
   <link rel="stylesheet" href="img/favicon.ico">
   <!-- DATATABLES-->
   <link rel="stylesheet" href="../public/datatables/jquery.dataTables.min.css">
   <link rel="stylesheet" href="../public/datatables/buttons.dataTables.min.css">
   <link rel="stylesheet" href="../public/datatables/responsive.dataTables.min.css">
   <link rel="stylesheet" href="../public/css/bootstrap-select.min.css">

 </head>

 <body class="hold-transition skin-blue sidebar-mini">
   <div class="wrapper">

     <header class="main-header">
       <!-- Logo -->
       <a href="escritorio" class="logo">
         <!-- mini logo for sidebar mini 50x50 pixels -->
         <span class="logo-mini text-uppercase"><b><?php echo PRO_NOMBRE ?></b></span>
         <!-- logo for regular state and mobile devices -->
         <span class="logo-lg text-uppercase"><?php echo PRO_NOMBRE ?></span>
       </a>
       <!-- Header Navbar: style can be found in header.less -->
       <nav class="navbar navbar-static-top">
         <!-- Sidebar toggle button-->
         <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
           <span class="sr-only">NAVEGACIÓM</span>
         </a>

         <div class="navbar-custom-menu">
           <ul class="nav navbar-nav">

             <li class="dropdown user user-menu">
               <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                 <img src="../files/usuarios/<?php echo $_SESSION['imagen']; ?>" class="user-image" alt="User Image">
                 <span class="hidden-xs"><?php echo $_SESSION['nombre']; ?></span>
               </a>
               <ul class="dropdown-menu">
                 <!-- User image -->
                 <li class="user-header">
                   <img src="../files/usuarios/<?php echo $_SESSION['imagen']; ?>" class="img-circle" alt="User Image">

                   <p>
                     <?php echo $_SESSION['nombre']; ?>
                     <small><?php echo $_SESSION['cargo']; ?></small>
                   </p>
                 </li>
                 <!-- Menu Footer-->
                 <li class="user-footer">
                   <div class="pull-left">

                   </div>
                   <div class="pull-right">
                     <a href="../ajax/usuario?op=salir" class="btn btn-default btn-flat">Salir</a>
                   </div>
                 </li>
               </ul>
             </li>
             <!-- Control Sidebar Toggle Button -->

           </ul>
         </div>
       </nav>
     </header>
     <!-- Left side column. contains the logo and sidebar -->
     <aside class="main-sidebar">
       <!-- sidebar: style can be found in sidebar.less -->
       <section class="sidebar">
         <!-- Sidebar user panel -->

         <!-- /.search form -->
         <!-- sidebar menu: : style can be found in sidebar.less -->
         <ul class="sidebar-menu" data-widget="tree">

           <br>
           <?php
            if ($_SESSION['escritorio'] == 1) {
              echo ' <li><a href="escritorio"><i class="fa  fa-dashboard (alias)"></i> <span>Escritorio</span></a>
        </li>';
            }
            ?>
           <?php
            if ($_SESSION['almacen'] == 1) {
              echo ' <li class="treeview">
          <a href="#">
            <i class="fa fa-laptop"></i> <span>Inventario</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="articulo"><i class="fa fa-circle-o"></i> Articulos</a></li>
            <li><a href="categoria"><i class="fa fa-circle-o"></i> Categorias</a></li>
          </ul>
        </li>';
            }
            ?>
           <?php
            if ($_SESSION['compras'] == 1) {
              echo ' <li class="treeview">
          <a href="#">
            <i class="fa fa-th"></i> <span>Compras</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="ingreso"><i class="fa fa-circle-o"></i> Ingresos</a></li>
            <li><a href="proveedor"><i class="fa fa-circle-o"></i> Proveedores</a></li>
          </ul>
        </li>';
            }
            ?>

           <?php
            if ($_SESSION['ventas'] == 1) {
              echo '<li class="treeview">
          <a href="#">
            <i class="fa fa-shopping-cart"></i> <span>Ventas</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="venta"><i class="fa fa-circle-o"></i> Ventas</a></li>
            <li><a href="cliente"><i class="fa fa-circle-o"></i> Clientes</a></li>
          </ul>
        </li>';
            }
            ?>

           <?php
            if ($_SESSION['acceso'] == 1) {
              echo '  <li class="treeview">
          <a href="#">
            <i class="fa fa-folder"></i> <span>Acceso</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="usuario"><i class="fa fa-circle-o"></i> Usuarios</a></li>
            <li><a href="permiso"><i class="fa fa-circle-o"></i> Permisos</a></li>
          </ul>
        </li>';
            }
            ?>
           <?php
            if ($_SESSION['consultac'] == 1) {
              echo '     <li class="treeview">
          <a href="#">
            <i class="fa fa-bar-chart"></i> <span>Consulta Compras</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="Compras por fechas"><i class="fa fa-circle-o"></i>Compras por fechas</a></li>
          </ul>
        </li>';
            }
            ?>

           <?php
            if ($_SESSION['consultav'] == 1) {
              echo '<li class="treeview">
          <a href="#">
            <i class="fa fa-bar-chart"></i> <span>Consulta Ventas</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="Consulta Ventas"><i class="fa fa-circle-o"></i>Consulta Ventas</a></li>

          </ul>
        </li>';
            }
            ?>

           <?php
            if ($_SESSION['consultav'] == 1) {
              echo '<li class="treeview">
          <a href="#">
            <i class="fa fa-file"></i> <span>Reportes</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          <li><a href="reporte compras"><i class="fa fa-circle-o"></i>Reporte de compras</a></li>
          <li><a href="reporte ventas"><i class="fa fa-circle-o"></i>Reporte de ventas</a></li>
          </ul>
        </li>';
            }
            ?>
         </ul>
       </section>
       <!-- /.sidebar -->
     </aside>