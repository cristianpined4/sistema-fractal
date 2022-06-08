<?php
//activamos almacenamiento en el buffer
ob_start();
session_start();
if (!isset($_SESSION['nombre'])) {
  header("Location: login.php");
} else {


  require 'header.php';

  if ($_SESSION['consultac'] == 1) {

?>
<div class="content-wrapper">
  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h1 class="box-title">Reporte de Compras</h1>
            <div class="box-tools pull-right">

            </div>
          </div>
          <!--box-header-->
          <!--centro-->
          <div class="panel-body table-responsive" id="listadoregistros">
            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <label>Fecha Inicio</label>
              <input type="date" class="form-control" name="fecha_inicio" id="fecha_inicio"
                value="<?php echo date("Y-m-d"); ?>">
            </div>
            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <label>Fecha Fin</label>
              <input type="date" class="form-control" name="fecha_fin" id="fecha_fin"
                value="<?php echo date("Y-m-d"); ?>">
            </div>
            <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
              <thead>
                <th>Fecha</th>
                <th>Proveedor</th>
                <th>Total Compra</th>
              </thead>
              <tbody>
              </tbody>
              <tfoot>
                <th>Fecha</th>
                <th>Proveedor</th>
                <th>Total Compra</th>
              </tfoot>
            </table>
            <h4 class="text-center total" style="margin-top: 2rem; margin-bottom:1rem">
              <b>Total de compras </b><span>$0.00</span>
            </h4>
          </div>

          <!--fin centro-->
        </div>
      </div>
    </div>
    <!-- /.box -->

  </section>
  <!-- /.content -->
</div>
<?php
  } else {
    require 'noacceso.php';
  }

  require 'footer.php';
  ?>
<script src="scripts/reporte-compras.js"></script>
<?php
}

ob_end_flush();
?>