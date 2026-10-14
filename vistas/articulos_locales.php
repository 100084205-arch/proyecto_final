<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">ARTICULOS LOCALES</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                    <li class="breadcrumb-item active">Acriculos locales</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">

    <div class="container-fluid">


        <!-- row para listado de productos/inventario -->
        <div class="row">
            <div class="col-lg-12">
                <table id="tbl_articulos_locales" class="table table-striped w-100 shadow">
                    <thead class="bg-info">
                        <tr style="font-size: 15px;">
                            <th>CODIGO_RE</th>
                            <th>ITNBR</th>
                            <th>DESCRIPCION
                            <th>COLOR</th>
                            <th>CANTIDAD</th>
                            <th>STOCK</th>
                            <th>UBICACION</th>
                            <th>ALMACEN</th>
                            <th>FECHA ACTUALIZACION</th>
                            <th>FECHA RESIBIDO</th>
                            <th>CREADOR</TH>
                            <th>ESTADO</th>
                            <th class="text-cetner">OPCIONES</th>

                        </tr>
                    </thead>
                    <tbody class="text-small">
                    </tbody>
                </table>
            </div>
        </div>

    </div><!-- /.container-fluid -->

</div>
<!-- /.content -->
<!-- Ventana Modal para ingresar o modificar un Productos -->
<div class="modal fade" id="mdlGestionararticulos_locales" role="dialog">

    <div class="modal-dialog modal-lg">

        <!-- contenido del modal -->
        <div class="modal-content">

            <!-- cabecera del modal -->
            <div class="modal-header bg-gray py-1">

                <h5 class="modal-title">Agregar /Articulos_locales </h5>

                <button type="button" class="btn btn-outline-primary text-white border-0 fs-5" data-bs-dismiss="modal"
                    id="btnCerrarModal">
                    <i class="far fa-times-circle"></i>
                </button>

            </div>

            <!-- cuerpo del modal -->
            <div class="modal-body">

                <form class="needs-validation" novalidate>
                    <!-- Abrimos una fila -->
                    <div class="row">



                        <!-- Columna para registro de la descripción del iten_num -->
                        <div class="col-12 col-lg-12">
                            <div class="form-group mb-2">
                                <label class="fa fa-barcode" for="iptitennumReg"><i class=""></i>
                                    <span class="small">Iten num</span><span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control form-control-sm" id="iptitennumReg"
                                    name="iptitennumReg" placeholder="Iten num" required>
                                <div class="invalid-feedback">Debe ingresar el iten num</div>
                            </div>
                        </div>

                        <!-- Columna para registro de la descripción del articulo -->
                        <div class="col-12 col-lg-6">
                            <div class="form-group mb-2">
                                <label class="fa fa-barcode" for="iptdescripcionReg"><i class=""></i>
                                    <span class="small">Descripcion</span><span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control form-control-sm" id="iptdescripcionReg"
                                    name="iptdescripcionReg" placeholder="Descripcion" required>
                                <div class="invalid-feedback">Debe ingresar la Descripcion</div>
                            </div>
                        </div>

                        <div class="col-12 col-lg-6">
                            <div class="form-group mb-2">
                                <label class="fa fa-paint-brush" for="iptcolorReg"><i class="fa fa-paint-brush"></i>
                                    <span class="small">Color</span><span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control form-control-sm" id="iptcolorReg"
                                    name="iptcolorReg" placeholder="Color" required>
                                <div class="invalid-feedback">Debe ingresar el color</div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="form-group mb-2">
                                <label class="fas fa-plus-circle fs-6" for="iptcantidadReg"><i class=""></i>
                                    <span class="small">Cantidad</span><span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control form-control-sm" id="iptcantidadReg"
                                    name="iptcantidadReg" placeholder="Cantidad" required>
                                <div class="invalid-feedback">Debe ingresar cantidad</div>
                            </div>
                        </div>


                        <!-- Columna para registro de la descripción del stock-->

                        <div class="col-12 col-lg-6">
                            <div class="form-group mb-2">
                                <label class="fas fa-minus-circle fs-6" for="iptstockReg"><i class=""></i>
                                    <span class="small">Mini_Stock</span><span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control form-control-sm" id="iptstockReg"
                                    name="iptstockReg" placeholder="Stock" required>
                                <div class="invalid-feedback">Debe ingresar minimo stock</div>
                            </div>
                        </div>


                        <!-- Columna para registro de la descripción de la UBICACION-->


                        <div class="col-12 col-lg-6">
                            <div class="form-group mb-2">
                                <label class="fa fa-address-card" for="iptubicacionReg"><i class=""></i>
                                    <span class="small">Ubicacion</span><span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control form-control-sm" id="iptubicacionReg"
                                    name="iptubicacionReg" placeholder="Ubicacion" required>
                                <div class="invalid-feedback">Debe ingresar el ubicacion</div>
                            </div>
                        </div>

                        <!-- Columna para registro del ALMACEN -->
                        <div class="col-12 col-lg-6">
                            <div class="form-group mb-2">
                                <label class="fa fa-archive" for="iptalmacenReg"><i class=""></i>
                                    <span class="small">Almacen</span><span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control form-control-sm" id="iptalmacenReg"
                                    name="iptalmacenReg" placeholder="Almacen" required>
                                <div class="invalid-feedback">Debe ingresar el almacen</div>
                            </div>
                        </div>



                        <!-- creacion de botones para cancelar y guardar el producto -->
                        <button type="button" class="btn btn-danger mt-3 mx-2" style="width:170px;"
                            data-bs-dismiss="modal" id="btnCancelarRegistro">Cancelar</button>
                        <button type="button" style="width:170px;" class="btn btn-primary mt-3 mx-2"
                            id="btnGuardarmiscellaneous"> Guardar </button>
                        <!-- <button class="btn btn-default btn-success" type="submit" name="submit" value="Submit">Save</button> -->

                    </div>
                </form>

            </div>

        </div>
    </div>


</div>




<script>
var accion;
var table;
/*===================================================================*/
//INICIALIZAMOS EL MENSAJE DE TIPO TOAST (EMERGENTE EN LA PARTE SUPERIOR)
/*===================================================================*/
var Toast = Swal.mixin({
    toast: true,
    position: 'top',
    showConfirmButton: false,
    timer: 3000
});



$(document).ready(function() {



    $.ajax({
        url: "ajax/articulos_locales.ajax.php",
        type: "POST",
        data: {
            'accion': 1
        }, //LISTAR A /articulos_locales
        dataType: 'json',
        success: function(respuesta) {
            console.log("respuesta", respuesta);
        }

    });


    table = $("#tbl_articulos_locales").DataTable({
        dom: 'Bfrtip',
        buttons: [{
                text: 'Agregar',
                classname: 'addNewRecord',
                action: function(e, dt, node, config) {
                    $("#mdlGestionararticulos_locales").modal('show');
                    accion = 2;
                }
            },

            'copy', 'excel', 'print', 'pageLength'
        ],
        pageLength: [20, 30, 50, 100],
        pageLength: 30,

        columnDefs: [{
                targets: 0,
                visible: true,
            },



            {
                targets: 11,
                createdCell: function(td, cellData, rowData, row, col) {
                    if (parseFloat(rowData[4]) <= parseFloat(rowData[5])) {
                        $(td).parent().css('background', '#FF5733')
                        $(td).parent().css('color', '#ffffff')
                    }
                    if (parseInt(rowData[4]) >= 1) {
                        $(td).html("Activo")
                    } else {
                        $(td).html("Inactivo")

                    }

                },
            },
            {
                targets: 12,
                orderable: false,
                render: function(datqa, type, full, meta) {
                    return "<center>" +

                        "<span class='btnEditarLocales text-primary px-1' style='cursor:pointer;'>" +
                        "<i class='fas fa-pencil-alt fs-5'></i>" +
                        "</span>"
                    "</center>"
                }
            }
        ],




        ajax: {
            url: "ajax/articulos_locales.ajax.php",
            dataSrc: '',
            type: "POST",
            data: {
                'accion': 1
            },
        },

        language: {
            url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        }
    });

    $("#btnLimpiarBusqueda").on('click', function() {


        $("#iptiten_num").val('')
        $("#iptubicacion").val('')

        table.search('').columns().search('').draw();
    })
    $("#btnCancelarRegistro, #btnCerrarModal").on('click', function() {


        $("#validate_itennum").css("display", "none");
        $("#validate_descripcion").css("display", "none");
        $("#validate_color").css("display", "none");
        $("#validate_cantidad").css("display", "none");
        $("#validate_stock").css("display", "none");
        $("#validate_ubicacion").css("display", "none");
        $("#validate_almacen").css("display", "none");

        ;
        $("#iptitennumReg").val('');
        $("#iptdescripcionReg").val('');
        $("#iptcolorReg").val('');
        $("#iptcantidadReg").val('');
        $("#iptstockReg").val('');
        $("#iptubicacionReg").val('');
        $("#iptalmacenReg").val('');

        table.search('').columns().search('').draw();
    })
})
/* ======================================================================================
        EVENTO AL DAR CLICK EN EL BOTON EDITAR LOCALES
 =========================================================================================*/
$('#tbl_articulos_locales').on('click', '.btnEditarLocales', function() {

    accion = 8; //seteamos la accion para editar
    $("#mdlGestionararticulos_locales").modal('show');
    var data = table.row($(this).parents('tr')).data();
    $("#iptitennumReg").val(data['iten_num']);
    $("#iptdescripcionReg").val(data['2']);
    $("#iptcolorReg").val(data['3']);
    $("#iptcantidadReg").val(data['4']);
    $("#iptstockReg").val(data['5']);    
    $("#iptubicacionReg").val(data['6']);
    $("#iptalmacenReg").val(data['7']);
})
/*===================================================================*/
//EVENTO QUE GUARDA LOS DATOS DEL PRODUCTO, PREVIA VALIDACION DEL INGRESO DE LOS DATOS OBLIGATORIOS
/*===================================================================*/
document.getElementById("btnGuardarmiscellaneous").addEventListener("click", function() {
    var forms = document.getElementsByClassName('needs-validation');
    var validation = Array.prototype.filter.call(forms, function(form) {
        if (form.checkValidity() === true) {
            console.log("Listo para registrar el producto")
            Swal.fire({
                title: 'Está seguro de registrar el articulo local?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, deseo registrarlo!',
                cancelButtonText: 'Cancelar',
            }).then((result) => {

                if (result.isConfirmed) {

                    var datos = new FormData();

                    datos.append("accion", accion);

                    datos.append("iten_num", $("#iptitennumReg").val()); //iten_num
                    datos.append("descripcion", $("#iptdescripcionReg")
                .val()); //iptdescripcionReg
                    datos.append("color", $("#iptcolorReg").val()); //color
                    datos.append("cantidad", $("#iptcantidadReg").val()); //CANTIDAD
                    datos.append("stock", $("#iptstockReg").val()); //CANTIDAD
                    datos.append("ubicacion", $("#iptubicacionReg").val()); //UBICACION
                    datos.append("almacen", $("#iptalmacenReg").val()); //almacen

                    if (accion == 2) {
                        var titulo_msj = " Se registró correctamente"
                    }

                    if (accion == 8) {
                        var titulo_msj = "El articulo se actualizó correctamente"
                    }

                    $.ajax({
                        url: "ajax/articulos_locales.ajax.php",
                        method: "POST",
                        data: datos,
                        cache: false,
                        contentType: false,
                        processData: false,
                        dataType: 'json',
                        success: function(respuesta) {

                            if (respuesta == "ok") {

                                Toast.fire({
                                    icon: 'success',
                                    title: titulo_msj
                                });

                                table.ajax.reload();

                                $("#mdlGestionararticulos_locales").modal('hide');


                                $("#iptitennumReg").val('');
                                $("#iptcolorReg").val('');
                                $("#iptcantidadReg").val('');
                                $("#iptstockReg").val('');
                                $("#iptubicacionReg").val('');
                                $("#iptalmacenReg").val('');

                            } else {
                                Toast.fire({
                                    icon: 'error',
                                    title: 'El producto no se pudo registrar o ya existe'
                                });
                            }

                        }
                    });

                }
            })
        } else {
            console.log("No paso la validacion")
        }

        form.classList.add('was-validated');

    });
});

/*===================================================================*/
//EVENTO QUE LIMPIA LOS MENSAJES DE ALERTA DE INGRESO DE DATOS DE CADA INPUT AL CANCELAR LA VENTANA MODAL
/*===================================================================*/
document.getElementById("btnCancelarRegistro").addEventListener("click", function() {
    $(".needs-validation").removeClass("was-validated");
})
</script>