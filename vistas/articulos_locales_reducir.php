<!-- Content Header (Page header) -->
<div class="content-header">

    <div class="container-fluid">

        <div class="row mb-2">

            <div class="col-sm-6">

                <h4 class="m-0">SALIDA DE PRODUCTOS LOCALES</h4>

            </div><!-- /.col -->

            <div class="col-sm-6">

                <ol class="breadcrumb float-sm-right">

                    <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>

                    <li class="breadcrumb-item active">Reducir</li>

                </ol>

            </div><!-- /.col -->

        </div><!-- /.row -->

    </div><!-- /.container-fluid -->





</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">

    <div class="container-fluid">

        <div class="row mb-3">

            <div class="col-md-9">

                <div class="row">

                    <!-- INPUT PARA INGRESO DEL CODIGO DE BARRAS O DESCRIPCION DEL PRODUCTO -->
                    <div class="col-md-6 mb-3">

                        <div class="form-group mb-2">

                            <label class="col-form-label" for="iptCodigoVenta">
                                <i class="fas fa-barcode fs-6"></i>
                                <span class="small">Productos</span>
                            </label>

                            <input type="text" class="form-control form-control-sm" id="iptCodigoVenta"
                                placeholder="Ingrese el código de barras o el nombre del producto">
                        </div>

                    </div>

                    <!-- INPUT PARA INGRESO DEL DESTINO -->

                    <div class="col-md-6 mb-3">
                        <div class="form-group mb-2">

                            <label class="col-form-label" for="iptdestino">
                                <i class=""></i>
                                <span class="small">DESTINO</span>
                            </label>

                            <input type="text" class="form-control form-control-sm" id="iptdestino"
                                placeholder="Ingrese el nombre de la destino">

                        </div>
                    </div>

                    <!-- ETIQUETA QUE MUESTRA LA SUMA TOTAL DE LOS PRODUCTOS AGREGADOS AL LISTADO -->
                    <div class="col-md-6 mb-3 bg-info"
                        style="background-color: gray;color: white;text-align:center;border:1px solid gray;">
                        <h2 class="fw-bold m-0"><span class="fw-bold" id="cantidad"> 0.00</span></h2>
                    </div>

                    <!-- BOTONES PARA VACIAR LISTADO Y COMPLETAR LA VENTA -->
                    <div class="col-md-12  mb-3 text-right">
                        <button class="btn btn-success" id="btnIniciarVenta">
                            <i class="fa fa-paper-plane"></i> Reducir
                        </button>
                        <button class="btn btn-danger" id="btnVaciarListado">
                            <i class="far fa-trash-alt"></i> Vaciar Listado
                        </button>
                    </div>

                    <!-- LISTADO QUE CONTIENE LOS PRODUCTOS QUE SE VAN AGREGANDO PARA REDUCIR -->
                    <div class="col-md-12">

                        <table id="lstProductosVenta" class="display nowrap table-striped w-100 shadow ">
                            <thead class="bg-info text-left fs-6">
                                <tr>
                                    <th>ITEM</th>
                                    <th>id_reducir</th>
                                    <th>ITEN NUM</th>
                                    <th>DESCRIPCION</th>
                                    <th>COLOR</th>
                                    <th>CANTIDAD</th>

                                    <th class="text-center">OPCIONES</th>
                                </tr>

                            </thead>
                            <tbody class="small text-left fs-6">
                            </tbody>
                        </table>
                        <!-- / table -->
                    </div>
                    <!-- /.col -->

                </div>

            </div>



        </div>
    </div>

</div>

<script>
var table;
var items = []; // SE USA PARA EL INPUT DE AUTOCOMPLETE

var itemProducto = 1;

var Toast = Swal.mixin({
    toast: true,
    position: 'top',
    showConfirmButton: false,
    timer: 3000
});


$(document).ready(function() {
    /* ======================================================================================
    INICIALIZAR LA TABLA DE VENTAS
    ======================================================================================*/
    table = $('#lstProductosVenta').DataTable({

        "columns": [{
                "data": "id"
            }, {
                "data": "id_reducir"
            },

            {
                "data": "iten_num"
            },
            {
                "data": "descripcion"
            },

            {
                "data": "color"
            },
            {
                "data": "cantidad"
            },
            {
                "data": "acciones"
            }

        ],
        columnDefs: [],
        "order": [
            [0, 'desc']
        ],
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        }
    });

    /* ======================================================================================
		TRAER LISTADO DE LOS PRODUCTOS LOCALES  PARA INPUT DE AUTOCOMPLETADO
		======================================================================================*/
    $.ajax({

        async: false,
        url: "ajax/articulos_locales.ajax.php",
        method: "POST",
        data: {
            'accion': 3
        },
        dataType: 'json',
        success: function(respuesta) {

            for (let i = 0; i < respuesta.length; i++) {
                items.push(respuesta[i]['iten_num'])
            }

            $("#iptCodigoVenta").autocomplete({

                source: items,
                select: function(event, ui) {



                    CargarProductos(ui.item.value);

                    //$("#iptCodigoVenta").val("");

                    //$("#iptCodigoVenta").focus();

                    return false;
                }
            })



        }
    });

    /* ======================================================================================
         EVENTO QUE REGISTRA EL PRODUCTO EN EL LISTADO CUANDO SE INGRESA EL CODIGO DE BARRAS
          ======================================================================================*/
    $("#iptCodigoVenta").change(function() {
        CargarProductos();
    });

    /* ======================================================================================
        EVENTO PARA ELIMINAR UN PRODUCTO DEL LISTADO
       ======================================================================================*/
    $('#lstProductosVenta tbody').on('click', '.btnEliminarproducto', function() {
        table.row($(this).parents('tr')).remove().draw();
        recalcularTotales();
    });


    /* ======================================================================================
       EVENTO PARA INICIAR EL REGISTRO DE LA SALIDA
       ====================================================================================== */
    $("#btnIniciarVenta").on('click', function() {
        realizarVenta();
    })

    /* ======================================================================================
         EVENTO PARA MODIFICAR LA CANTIDAD A REDUCIR
         ======================================================================================*/
    $('#lstProductosVenta tbody').on('change', '.iptCantidad', function() {

        var data = table.row($(this).parents('tr')).data();

        cantidad = $(this)[0]['value'];
        id_reducir = $(this)[0]['attributes'][2]['value'];

        console.log("cantidad", $(this)[0]['value'])
        console.log("id_reducir", $(this)[0]['attributes'][2]['value'])

        if (!$.isNumeric($(this)[0]['value']) || $(this)[0]['value'] <= 0) {
            Toast.fire({
                icon: 'error',
                title: ' INGRESE UN VALOR NUMERICO Y MAYOR A 0 '
            })

            // mensajeToast('error', 'INGRESE UN VALOR NUMERICO Y MAYOR A 0');

            $(this)[0]['value'] = "1";

            $("#iptCodigoVenta").val("");
            $("#iptCodigoVenta").focus();
            return;
        }

        console.log(cantidad)

        table.rows().eq(0).each(function(index) {

            var row = table.row(index);

            var data = row.data();

            if (data['id_reducir'] == id_reducir) {

                $.ajax({
                    async: false,
                    url: "ajax/articulos_locales.ajax.php",
                    method: "POST",
                    data: {
                        'accion': 5,
                        'id_reducir': data['id_reducir'],
                        'cantidad_a_salir': cantidad
                    },
                    dataType: 'json',
                    success: function(respuesta) {

                        if (parseInt(respuesta['existe']) == 0) {

                            Toast.fire({
                                icon: 'error',
                                title: ' El articulo ' + data[
                                    'id_reducir'] + ' ya no tiene stock'
                            })

                            table.cell(index, 5).data(
                                '<input type="text" style="width:80px;" id_reducir = "' +
                                id_reducir +
                                '" class="form-control text-center iptCantidad m-0 p-0" value="1">'
                                ).draw();

                            $("#iptCodigoVenta").val("");
                            $("#iptCodigoVenta").focus();

                            // ACTUALIZAR EL NUEVO PRECIO DEL ITEM DEL LISTADO DE VENTA


                            // RECALCULAMOS TOTALES
                            recalcularTotales();

                        } else {

                            Toast.fire({
                                icon: 'success',
                                title: ' La cantidad  solicitada al ' +
                                    data['id_reducir'] +
                                    ' se agrego correctamente '
                            })
                            // AUMENTAR EN 1 EL VALOR DE LA CANTIDAD
                            table.cell(index, 5).data(
                                '<input type="text" style="width:80px;" id_reducir = "' +
                                id_reducir +
                                '" class="form-control text-center iptCantidad m-0 p-0" value="' +
                                cantidad + '">').draw();


                            // ACTUALIZAR EL NUEVO PRECIO DEL ITEM DEL LISTADO DE VENTA


                            // RECALCULAMOS TOTALES
                            recalcularTotales();
                        }
                    }
                });



            }


        });

    });
}) //FIN DEL DOCUMENT READY

/*===================================================================*/
//FUNCION PARA LIMPIAR LOS INPUTS DE LA SALIDA Y IPTDESTINO QUE TIENEN DATOS
/*===================================================================*/
function LimpiarInputs() {
    $("#cantidad").html("0");
    $("#iptdestino").val("");
}


/*===================================================================*/
//FUNCION PARA RECARCULAR LOS TOTALES DE LOS ARTICULOS LOCALES  EN EL DATATABLE DE REDUCIR
/*===================================================================*/
function recalcularTotales() {

    var cantidad = 0.00;

    table.rows().eq(0).each(function(index) {

        var row = table.row(index);
        var data = row.data();

        cantidad = parseFloat(cantidad) + parseFloat(data['cantidad']);

    });
    $("#cantidad").html("");
    $("#cantidad").html(cantidad);

    $("#iptCodigoVenta").val("");
    $("#iptCodigoVenta").focus();

}


/*===================================================================*/
//FUNCION PARA CARGAR PRODUCTOS DE LOS ARTICULOS LOCALES  EN EL DATATABLE
/*===================================================================*/
function CargarProductos(producto = "") {

    if (producto != "") {
        var id_reducir = producto;

    } else {
        var id_reducir = $("#iptCodigoVenta").val();
    }

    var producto_repetido = 0;

    /*===================================================================*/
    // AUMENTAMOS LA CANTIDAD SI EL PRODUCTO YA EXISTE EN EL LISTADO DESDE EL INPUT  iptcodigoventa
    /*===================================================================*/
    table.rows().eq(0).each(function(index) {

        var row = table.row(index);
        var data = row.data();

        if (parseInt(id_reducir) == data['id_reducir']) {

            producto_repetido = 1;

            $.ajax({
                async: false,
                url: "ajax/articulos_locales.ajax.php",
                method: "POST",
                data: {
                    'accion': 5,
                    'id_reducir': data['id_reducir'],
                    'cantidad_a_salir': data['cantidad']
                },
                dataType: 'json',
                success: function(respuesta) {

                    if (parseInt(respuesta['existe']) == 0) {

                        Toast.fire({
                            icon: 'error',
                            title: ' El articulo ' + data['id_reducir'] +
                                ' ya no tiene stock'
                        })

                        $("#iptCodigoVenta").val("");
                        $("#iptCodigoVenta").focus();


                    } else {

                        table.cell(index, 5).data(
                            '<input type="text" style="width:80px;" id_reducir = "' +
                            id_reducir +
                            '" class="form-control text-center iptCantidad m-0 p-0" value="' +
                            cantidad + '">').draw();
                        recalcularTotales();
                    }
                }
            });

        }
    });

    if (producto_repetido == 1) {
        return;
    }
    //console.log("🚀 ~ file: administrar_ventas.php ~ line 99 ~ $ ~ id", id)

    $.ajax({
        url: "ajax/articulos_locales.ajax.php",
        method: "POST",
        data: {
            'accion': 4, //BUSCAR PRODUCTOS POR SU CODIGO DE BARRAS
            'id_reducir': id_reducir
        },
        dataType: 'json',
        success: function(respuesta) {
            /*===================================================================*/
            //SI LA RESPUESTA ES VERDADERO, TRAE ALGUN DATO'
            /*===================================================================*/
            if (respuesta) {

                var cantidad = 0.00;

                table.row.add({
                    'id': itemProducto,
                    'id_reducir': respuesta['id_reducir'],
                    'iten_num': respuesta['iten_num'],
                    'descripcion': respuesta['descripcion'],
                    'color': respuesta['color'],
                    'cantidad': '<input type="text" style="width:80px;" id_reducir = "' + respuesta[
                            'id_reducir'] +
                        '" class="form-control text-center iptCantidad p-0 m-0" value="1">',
                    'acciones': "<center>" +

                        "<span class='btnEliminarproducto text-danger px-1'style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Eliminar producto'> " +
                        "<i class='fas fa-trash fs-5'> </i> " +
                        "</span>" +

                        "</center>",


                }).draw();

                itemProducto = itemProducto + 1;


                recalcularTotales();

                /*===================================================================*/
                //SI LA RESPUESTA ES FALSO, NO TRAE ALGUN DATO
                /*===================================================================*/
            } else {
                Toast.fire({
                    icon: 'error',
                    title: ' El articulo no existe o no tiene stock'
                });

                $("#iptCodigoVenta").val("");
                $("#iptCodigoVenta").focus();
            }

        }


    });

} /* FIN CargarProductos */

/*===================================================================*/
//REALIZAR LA SALIDA
/*===================================================================*/
function realizarVenta() {

    var count = 0;

    var iptdestino = $("#iptdestino").val();

    table.rows().eq(0).each(function(index) {
        count = count + 1;
    });

    if (count > 0) {

        var formData = new FormData();
        var arr = [];

        table.rows().eq(0).each(function(index) {

            var row = table.row(index);

            var data = row.data();

            arr[index] = data['id_reducir'] + "," + data['iten_num'] + "," + data['descripcion'] + "," + data[
                'color'] + "," + parseFloat($.parseHTML(data['cantidad'])[0]['value']);

            formData.append('arr[]', arr[index]);

        });



        formData.append('iptdestino', iptdestino);

        $.ajax({
            url: "ajax/articulos_locales.ajax.php",
            method: "POST",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(respuesta) {



                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: respuesta,
                    showConfirmButton: false,
                    timer: 1500
                })

                table.clear().draw();

                LimpiarInputs();
            }
        });






    } else {

        Toast.fire({
            icon: 'warning',
            title: 'No hay productos en el listado.'
        });

    }

    $("#iptCodigoVenta").focus();

} /* FIN realizarVenta */
</script>