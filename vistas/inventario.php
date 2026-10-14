<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Nuevo Inventario </h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                    <li class="breadcrumb-item active">Nuevo /Inventario </li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Criterios de Busqueda</h3>
                        <div class="card-tools"><button class="btn btn-tool" type="button"
                                data-card-widget="collapse"><i class="fas fa-minus"></i></button></div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-2">

                                <div class="form-group mb-3">
                                    <button class="bg-purple" id="filtrar">
                                        <i class="fa fa-paper-plane"></i> FILTRAR PKGID
                                    </button>
                                    <input type="number" class="form-control form-control-sm" id="FiltrarNuevoPkgidIventario"
                                        placeholder="Ingrese el nombre el pkgd" autofocus>
                                </div>
                            </div>

                            <div class="col-2">
                                <div class="form-group mb-3">
                                    <label class="far fa-calendar-alt">Fecha Desde</label>
                                    <input class="form-control " id="fechaDesde" name="fechaDesde" type="date"
                                        value="<?php echo date('Y-m-d'); ?>" required />

                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group mb-3">
                                    <label class="far fa-calendar-alt">Fecha Hasta</label>
                                    <input class="form-control " id="fechaHasta" name="fechaHasta" type="date"
                                        value="<?php echo date('Y-m-d'); ?>" required />

                                </div>
                            </div>
                            <div class="col-md-1 d-flex flex-row align-items-center justify-content-end">
                                <div class="form-group m-0">
                                    <a class="btn btn-primary" style="width:120px;"
                                        id="btnFiltrarNuevoInventario">Buscar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-9">
                <div class="row">
                    <!-- INPUT PARA INGRESO DEL CODIGO DE BARRAS O DESCRIPCION DEL PRODUCTO -->
                    <div class="col-md-6 mb-3">
                        <div class="form-group mb-2">
                            <label class="col-form-label" for="pkgid">
                                <i class="fas fa-barcode fs-6"></i>
                                <span class="small">Nuevo Inventario</span>
                            </label>

                            <input type="text" class="form-control form-control-sm" id="pkgid"
                                placeholder="Ingrese el código de barras para el nuevo inventario">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <table id="tbl_Inventario" class="tbale table-bordered table-striped w-100">
                                <thead class="bg-info">
                                    <tr style="font-size: 15px;">
                                        <th></th>
                                        <th>PKGID</th>
                                        <th>CREADOR</th>
                                        <th>FECHA INGRESO</th>
                                        <th>FECHA ACTUALIZACION</th>
                                        <th class="text-cetner">OPCIONES</th>
                                    </tr>
                                </thead>
                                <tbody class="text-small">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
var inventario_table;
var accion;
/*===================================================================*/
//INICIALIZAMOS EL MENSAJE DE TIPO TOAST (EMERGENTE EN LA PARTE SUPERIOR)
/*===================================================================*/
var Toast = Swal.mixin({
    toast: true,
    position: 'top',
    showConfirmButton: false,
    timer: 3000
});
var fechaDesde, fechaHasta;

$(document).ready(function() {
    fechaDesde = $("#fechaDesde").val();
    fechaHasta = $("#fechaHasta").val();
     inventario_table = $("#tbl_Inventario").DataTable({
        "bDestroy": true,
        dom: 'Bfrtip',
        buttons: ['copy', 'pdf', 'excel', 'print', 'pageLength'],
        pageLength: [150, 200, 250, 300],
        pageLength: 150,
        responsive: {
            details: {
                type: 'column'
            }
        },
        columnDefs: [{
                        targets: 0,
                        orderable: false,
                        className: 'control'
                    },{
            targets: 5,
            orderable: false,
            render: function(datqa, type, full, meta) {
                return "<center>" +

                    "<span class='btnEditarProducto text-primary px-1' style='cursor:pointer;'>" +
                    "<i class='fas fa-pencil-alt fs-5'></i>" +
                    "</span>"
                "</center>"
            }
        }],
        ajax: {  
            url: "ajax/productos.ajax.php",
            dataSrc: '',
            type: "POST",
            data: {
                'accion': 16,
                'fechaDesde': fechaDesde,
                'fechaHasta': fechaHasta

            }, //1: LISTAR LA BUSQUEADA DE SALIDAD

        },
    });
})

/* ======================================================================================
  EVENTO QUE REGISTRA EL ARTICULO EN EL LISTADO CUANDO SE INGRESA EL CODIGO DE BARRAS
  ======================================================================================*/
$('#pkgid').change(function() {
    accion = 17;
    var datos = new FormData();
    datos.append("accion", accion);
    datos.append("pkgid", $("#pkgid").val());
    $.ajax({
        url: "ajax/productos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(respuesta) {
            if (respuesta == "ok") {
                inventario_table.ajax.reload();
                $("#pkgid").val('');

            } else {
                $("#pkgid").val('');
                Toast.fire({
                    icon: 'error',
                    title: 'El articulo no se pudo registrar o ya existe'
                });
            }
        }
    });
})

$('#FiltrarNuevoPkgidIventario').change(function() { // alert("pgid");
    var pkgid = $("#FiltrarNuevoPkgidIventario").val();
    if (pkgid == "") {
        Toast.fire({
            icon: 'warning',
            title: 'Ingrese la orden del pkgid'
        });
    } else {
        table = $("#tbl_Inventario").DataTable({
            "bDestroy": true,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'pdf', 'excel', 'print', 'pageLength',

            ],
            lengthMenu: [0, 5, 10, 15, 20, 150],
            "pageLength": 15,
            ajax: {
                url: "ajax/productos.ajax.php",
                type: 'POST',
                dataType: 'json',
                "dataSrc": function(respuesta) {
                    if (respuesta == 0) {
                        Toast.fire({
                            icon: 'error',
                            title: ' El pkgid no existe o no se le a dado entrada'
                        });
                    }
                    $("#FiltrarNuevoPkgidIventario").val('');
                    return respuesta;
                },
                data: {
                    'accion': 18,
                    'pkgid': pkgid
                } //1: LISTAR LA BUSQUEADA DE SALIDAD
            },
            responsive: {
            details: {
                type: 'column'
            }
        },
        columnDefs: [{
                        targets: 0,
                        orderable: false,
                        className: 'control'
                    },{
                targets: 5,
                orderable: false,
                render: function(datqa, type, full, meta) {
                    return "<center>" +
                    "<span class='btnEditarProducto text-primary px-1' style='cursor:pointer;'>" +
                    "<i class='fas fa-pencil-alt fs-5'></i>" +
                    "</span>"
                "</center>"
                }
            }],
            // language: {
            //     url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
            // }
        });
    }

})
/*EVENTO PARA FILTAR VENTAS SEGUN EL RANGO DE FECHAS */
$("#btnFiltrarNuevoInventario").on('click', function() {
    //  inventario_table.destroy();
    if ($("#fechaDesde").val() == '') {
        fechaDesde = '01/10/2021';

    } else {
        fechaDesde = $("#fechaDesde").val();
    }

    if ($("#fechaHasta").val() == '') {
        fechaHasta = '01/12/3000';

    } else {
        fechaHasta = $("#fechaHasta").val();
    }


    var inventario_table = $("#tbl_Inventario").DataTable({
        "bDestroy": true,
        dom: 'Bfrtip',
        buttons: ['copy', 'pdf', 'excel', 'print', 'pageLength'],
        pageLength: [150, 200, 250, 300],
        pageLength: 150,
        responsive: {
            details: {
                type: 'column'
            }
        },
        columnDefs: [{
                        targets: 0,
                        orderable: false,
                        className: 'control'
                    },{
            targets: 5,
            orderable: false,
            render: function(datqa, type, full, meta) {
                return "<center>" +

                    "<span class='btnEditarProducto text-primary px-1' style='cursor:pointer;'>" +
                    "<i class='fas fa-pencil-alt fs-5'></i>" +
                    "</span>"
                "</center>"
            }
        }],
        ajax: {
            url: "ajax/productos.ajax.php",
            dataSrc: '',
            type: "POST",
            data: {
                'accion': 16,
                'fechaDesde': fechaDesde,
                'fechaHasta': fechaHasta

            }, //1: LISTAR LA BUSQUEADA DE INVENTARIO NUEVO

        },
    });


})
</script>