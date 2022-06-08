var tabla;

//funcion que se ejecuta al inicio
function init() {
  listar();
}

//funcion listar
function listar() {
  var fecha_inicio = $("#fecha_inicio").val();
  var fecha_fin = $("#fecha_fin").val();

  tabla = $("#tbllistado")
    .dataTable({
      aProcessing: true, //activamos el procedimiento del datatable
      aServerSide: true, //paginacion y filrado realizados por el server
      dom: "Bfrtip", //definimos los elementos del control de la tabla
      buttons: ["copyHtml5", "excelHtml5", "csvHtml5", "pdf"],
      ajax: {
        url: "../ajax/consultas.php?op=reporte-ventas",
        data: {
          fecha_inicio: fecha_inicio,
          fecha_fin: fecha_fin,
        },
        type: "get",
        dataType: "json",
        error: function (e) {
          console.log(e.responseText);
        },
      },
      bDestroy: true,
      iDisplayLength: 5, //paginacion
      order: [[0, "asc"]], //ordenar (columna, orden)
    })
    .DataTable();

  $.ajax({
    url: "../ajax/consultas.php?op=reporte-ventas",
    data: {
      fecha_inicio: fecha_inicio,
      fecha_fin: fecha_fin,
    },
    type: "get",
    dataType: "json",
    error: function (e) {
      console.log(e.responseText);
    },
    success(data) {
      let $total = document.querySelector("h4.total span"),
        contador = 0;
      data.aaData.forEach((el) => {
        contador += parseFloat(el[2]);
      });
      $total.innerHTML = "$" + contador.toFixed(2);
    },
  });
}

init();
