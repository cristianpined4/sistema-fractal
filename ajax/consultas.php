<?php
require_once "../modelos/Consultas.php";

$consulta = new Consultas();

switch ($_GET["op"]) {


  case 'comprasfecha':
    $fecha_inicio = $_REQUEST["fecha_inicio"];
    $fecha_fin = $_REQUEST["fecha_fin"];

    $rspta = $consulta->comprasfecha($fecha_inicio, $fecha_fin);
    $data = array();

    while ($reg = $rspta->fetch_object()) {
      $data[] = array(
        "0" => $reg->fecha,
        "1" => $reg->usuario,
        "2" => $reg->proveedor,
        "3" => $reg->tipo_comprobante,
        "4" => $reg->serie_comprobante . ' ' . $reg->num_comprobante,
        "5" => $reg->total_compra,
        "6" => $reg->impuesto,
        "7" => ($reg->estado == 'Aceptado') ? '<span class="label bg-green">Aceptado</span>' : '<span class="label bg-red">Anulado</span>'
      );
    }
    $results = array(
      "sEcho" => 1, //info para datatables
      "iTotalRecords" => count($data), //enviamos el total de registros al datatable
      "iTotalDisplayRecords" => count($data), //enviamos el total de registros a visualizar
      "aaData" => $data
    );
    echo json_encode($results);
    break;

  case 'reporte-compras':
    $fecha_inicio = $_REQUEST["fecha_inicio"];
    $fecha_fin = $_REQUEST["fecha_fin"];

    $rspta = $consulta->comprasfecha($fecha_inicio, $fecha_fin);
    $data = array();

    $dataOrden = array();

    $rows = array();
    while ($row = mysqli_fetch_array($rspta)) {
      $contador = 0;
      $rows[] = $row;
      $nombre = $row["proveedor"];
      foreach ($rows as $item) {
        if ($nombre == $item["proveedor"]) {
          if ($row["fecha"] == $item["fecha"]) {
            $contador = $contador + $item["total_compra"];
          }
        }
      }
      $dataOrden[] = array(
        "fecha" => $row["fecha"],
        "proveedor" => $nombre,
        "total_compra" => $contador,
      );
    }

    $dataOrden = unique_multidim_array($dataOrden, "proveedor");

    foreach ($dataOrden as $el) {
      $data[] = array(
        "0" => $el['fecha'],
        "1" => $el['proveedor'],
        "2" => $el['total_compra']
      );
    }
    $results = array(
      "sEcho" => 1, //info para datatables
      "iTotalRecords" => count($data), //enviamos el total de registros al datatable
      "iTotalDisplayRecords" => count($data), //enviamos el total de registros a visualizar
      "aaData" => $data
    );
    echo json_encode($results);
    break;

  case 'ventasfechacliente':
    $fecha_inicio = $_REQUEST["fecha_inicio"];
    $fecha_fin = $_REQUEST["fecha_fin"];
    $idcliente = $_REQUEST["idcliente"];

    $rspta = $consulta->ventasfechacliente($fecha_inicio, $fecha_fin, $idcliente);
    $data = array();

    while ($reg = $rspta->fetch_object()) {
      $data[] = array(
        "0" => $reg->fecha,
        "1" => $reg->usuario,
        "2" => $reg->cliente,
        "3" => $reg->tipo_comprobante,
        "4" => $reg->serie_comprobante . ' ' . $reg->num_comprobante,
        "5" => $reg->total_venta,
        "6" => $reg->impuesto,
        "7" => ($reg->estado == 'Aceptado') ? '<span class="label bg-green">Aceptado</span>' : '<span class="label bg-red">Anulado</span>'
      );
    }
    $results = array(
      "sEcho" => 1, //info para datatables
      "iTotalRecords" => count($data), //enviamos el total de registros al datatable
      "iTotalDisplayRecords" => count($data), //enviamos el total de registros a visualizar
      "aaData" => $data
    );
    echo json_encode($results);
    break;

  case 'reporte-ventas':
    $fecha_inicio = $_REQUEST["fecha_inicio"];
    $fecha_fin = $_REQUEST["fecha_fin"];

    $rspta = $consulta->ReporteVentas($fecha_inicio, $fecha_fin);
    $data = array();
    $dataOrden = array();

    $rows = array();
    while ($row = mysqli_fetch_array($rspta)) {
      $contador = 0;
      $rows[] = $row;
      $nombre = $row["cliente"];
      foreach ($rows as $item) {
        if ($nombre == $item["cliente"]) {
          if ($row["fecha"] == $item["fecha"]) {
            $contador = $contador + $item["total_venta"];
          }
        }
      }
      $dataOrden[] = array(
        "fecha" => $row["fecha"],
        "cliente" => $nombre,
        "total_venta" => $contador,
      );
    }

    $dataOrden = unique_multidim_array($dataOrden, "cliente", "venta");

    foreach ($dataOrden as $el) {
      $data[] = array(
        "0" => $el['fecha'],
        "1" => $el['cliente'],
        "2" => $el['total_venta']
      );
    }

    $results = array(
      "sEcho" => 1, //info para datatables
      "iTotalRecords" => count($data), //enviamos el total de registros al datatable
      "iTotalDisplayRecords" => count($data), //enviamos el total de registros a visualizar
      "aaData" => $data
    );
    echo json_encode($results);
    break;
}

function unique_multidim_array($array, $key, $key2 = "compra")
{
  $newData = array();
  foreach ($array as $val) {
    $contador = 0;
    foreach ($array as $el) {
      if ($val[$key] == $el[$key]) {
        if ($val["fecha"] == $el["fecha"]) {
          $contador += $el["total_$key2"];
        }
      }
    }
    $newData[] = array('fecha' => $val["fecha"], "$key" => $val[$key], "total_$key2" => $contador);
  }
  $temp_array = array();
  $i = 0;
  $key_array = array();

  foreach ($newData as $val) {
    if (!in_array($val["total_$key2"], $key_array)) {
      $key_array[$i] = $val["total_$key2"];
      $temp_array[$i] = $val;
    }
    $i++;
  }
  return $temp_array;
}