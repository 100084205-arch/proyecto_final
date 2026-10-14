<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Buscar Salidas Locales</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                    <li class="breadcrumb-item active">Buscar salidas</li>
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
                <table id="buscar_salida_locales" class="table table-striped w-100 shadow">
                    <thead class="bg-info">

                        <tr style="font-size: 15px;">
                            <th>ID</th>
                            <th>ITEN NUM</th>
                            <th>DESCRIPCION</th>
                            <th>COLOR</th>
                            <th>CANTIDAD</th>
                            <th>DESTINO</th>
                            <th>FECHA SALIDA</th>
                            <th>CREADOR</th>
                            <th class="text-cetner">Opciones</th>
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



<script>
$(document).ready(function() {

    var table;

    table = $("#buscar_salida_locales").DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'pdf', 'excel', 'print', 'pageLength',

        ],
        lengthMenu: [0, 5, 10, 15, 20, 150],
        "pageLength": 15,
        ajax: {
            url: "ajax/articulos_locales.ajax.php",
            dataSrc: '',
            type: "POST",
            data: {
                'accion': 6
            }, // LISTAR LA BUSQUEDA DE SALIDA DE ARTICULOS LOCALES
        },

        columnDefs: [{
                    targets: 0,
                    visible: false
                },{
                targets: 8,
                orderable: false,
                render: function(datqa, type, full, meta) {
                    return "<center>" +

                        "<span class='btnRegresarSalida text-danger px-1'style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='REGRESAR EL PRODUCTO'> " +
                        "<i class='fas fa-angle-double-left fs-5'> </i> " +
                        "</span>" +

                        "</center>"
                }
            }

        ],

        language: {
            url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        }
    });

    /*ENVENTO PARA ELIMINAR UN PRODUCTO DE LA SALIDA DE ARTICULOS LOCALES*/

    $('#buscar_salida_locales tbody').on('click', '.btnRegresarSalida', function() {
        var id_local = $(this).attr("id_local");

        var data = table.row($(this).parents('tr')).data();

        var id_local = data["id_local"];
        var iten_num = data["iten_num"];

        Swal.fire({
            title: 'Está seguro de regresar el articulo ' + iten_num + '?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, deseo regresarlo!',
            cancelButtonText: 'Cancelar!',
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    url: "ajax/articulos_locales.ajax.php",
                    type: "POST",
                    data: {
                        accion: '7',
                        id_local: String(id_local)
                    },
                    dataType: 'json',
                    success: function(respuesta) {

                        // console.log( "🚀 ~ file: administrar_ventas.php ~ line 134 ~ respuesta",respuesta)

                        swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: respuesta[0],
                            showConfirmButton: false,
                            timer: 1500
                        })

                        table.ajax.reload();

                    }
                });
            }
        })





    });

})
</script>