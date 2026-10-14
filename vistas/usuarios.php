<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Administrar Usuarios</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                    <li class="breadcrumb-item active">Administrar Usuarios</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>


<!-- Main content -->
<div class="content">

    <div class="container-fluid">


        <!-- row para listado de productos/inventario -->
        <div class="row">
            <div class="col-lg-12">
                <table id="tbl_usuarios" class="table table-striped w-100 shadow">
                    <thead class="bg-info">
                        <tr style="font-size: 15px;">

                            <th>id</th>
                            <th>Nombre Usuarios</th>
                            <th>Apellido Usuarios</th>
                            <th>Usuario</th>
                            <th>Tipo de Perfil</th>
                            <th>Estado</th>
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

<!-- Ventana Modal para ingresar o modificar un Productos -->
<div class="modal fade" id="mdlGestionarUsuario" role="dialog">

    <div class="modal-dialog modal-lg">

        <!-- contenido del modal -->
        <div class="modal-content">

            <!-- cabecera del modal -->
            <div class="modal-header bg-gray py-1">

                <h5 class="modal-title">Agregar Usuarios</h5>

                <button type="button" class="btn btn-outline-primary text-white border-0 fs-5" data-bs-dismiss="modal" id="btnCerrarModal">
                    <i class="far fa-times-circle"></i>
                </button>

            </div>

            <!-- cuerpo del modal -->
            <div class="modal-body">

                <form class="needs-validation" novalidate>
                    <!-- Abrimos una fila -->
                    <div class="row">

                        <!-- Columna para registro del Usuarios -->
                        <div class="col-6 col-lg-12">
                            <div class="form-group mb-2">
                                <label class="" for="iptNombre_Usuario"><i class="fas fa-barcode fs-6"></i>
                                    <span class="small">Nombre del usuario</span><span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control form-control-sm" id="iptNombre_Usuario" name="iptNombre_Usuario" placeholder="Nombre del usuario" required>
                                <div class="invalid-feedback">Nombre del usuario</div>
                            </div>
                        </div>



                        <!-- Columna para registro del apellido del usuario  -->
                        <div class="col-12">
                            <div class="form-group mb-2">
                                <label class="" for="iptApellido_Usuario"><i class="fas fa-file-signature fs-6"></i> <span class="small">apellido del usuario</span><span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="iptApellido_Usuario" placeholder="apellido del usuario" required>
                                <div class="invalid-feedback">Debe ingresar la apellido del usuario</div>
                            </div>
                        </div>

                        <!-- Columna para registro del usuario-->
                        <div class="col-12">
                            <div class="form-group mb-2">
                                <label class="" for="iptUsuario"><i class="fas fa-file-signature fs-6"></i> <span class="small">Usuario</span><span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="iptUsuario" placeholder="Usuario" required>
                                <div class="invalid-feedback">Debe ingresar el Usuario</div>
                            </div>
                        </div>


                        <!-- Columna para registro de la clave-->
                        <div class="col-12  col-lg-12">
                            <div class="form-group mb-2">
                                <label class="" for="iptClave"><i class=""></i> <span class="small">Clave</span><span class="text-danger">*</span></label>
                                <input type="password" class="form-control form-control-sm" id="iptClave" placeholder="Clave" required>
                                <div class="invalid-feedback">Debe ingresarla clave</div>
                            </div>
                        </div>

                        <!-- Columna para registro del tipo de perfil -->
                        <div class="col-12 col-lg-12">
                            <div class="form-group mb-2">
                                <label class="" for="iptPerfil"><i class=""></i> <span class="small">Tipo de Perfil
                                    </span><span class="text-danger">*</span></label>
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example" id="iptPerfil" required>
                                    <option value="1">Administrador</option>
                                    <option value="2">Empleado</option>
                                   
                                </select>
                            </div>
                        </div>
                        <!-- Columna para registro del estado-->
                        <div class="col-12 col-lg-12">
                            <div class="form-group mb-2">
                                <label class="" for="iptEstado"><i class=""></i> <span class="small">Estado
                                    </span><span class="text-danger">*</span></label>
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example" id="iptEstado" required>
                                    <option value="0">Inactivo</option>
                                    <option value="1" selected>Activo</option>
                                </select>
                            </div>
                        </div>


                        <!-- creacion de botones para cancelar y guardar el usuario -->
                        <button type="button" class="btn btn-danger mt-3 mx-2" style="width:170px;" data-bs-dismiss="modal" id="btnCancelarRegistro">Cancelar</button>
                        <button type="button" style="width:170px;" class="btn btn-primary mt-3 mx-2" id="btnGuardarUsuarios">Guardar Usuario</button>
                        <!-- <button class="btn btn-default btn-success" type="submit" name="submit" value="Submit">Save</button> -->

                    </div>
                </form>

            </div>

        </div>
    </div>


</div>

<script>
    var table_usuarios;
    var accion;


    var Toast = Swal.mixin({
        toast: true,
        position: 'top',
        showConfirmButton: false,
        timer: 3000
    });

    $(document).ready(function() {

        var id_usuario = 0;

        table_usuarios = $("#tbl_usuarios").DataTable({

            dom: 'Bfrtip',
            buttons: [{
                    text: 'Agregar usuario',
                    className: 'addNewRecord',
                    action: function(e, dt, node, config) {
                        $("#mdlGestionarUsuario").modal('show');
                        accion = 1; //registrar
                    }
                },
                'copy', 'excel', 'print', 'pageLength'
            ],
            pageLength: [5, 10, 15, 30, 50, 100],
            pageLength: 10,

            ajax: {
                url: "ajax/usuario.ajax.php",
                dataSrc: '',

            },

            columnDefs: [{
                    targets: 5,
                    sortable: false,
                    createdCell: function(td, cellData, rowData, row, col) {

                        if (parseInt(rowData[5]) == 1) {
                            $(td).html("activo")
                        } else {
                            $(td).html("inactivo")
                        }

                    }
                },
                {
                    targets: 6,
                    orderable: true,
                    render: function(data, type, full, meta) {
                        return "<center>" +
                            "<span class='btnEditarUsuario text-primary px-1' style='cursor:pointer;'>" +
                            "<i class='fas fa-pencil-alt fs-5'></i>" +
                            "</span>" +

                            "<span class='btnEliminarUsuario text-danger px-1' style='cursor:pointer;'>" +
                            "<i class='fas fa-trash fs-5'></i>" +
                            "</span>" +
                            "</center>"
                    }
                }

            ],


            language: {
                url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
            }
        });

        $("#btnCancelarRegistro, #btnCerrarModal").on('click', function() {

            $("#validate_Nombre_Usuario").css("display", "none");
            $("#validate_Apellido_Usuario").css("display", "none");
            $("#validate_Usuario").css("display", "none");
            $("#validate_Clave").css("display", "none");
            $("#validate_Estado").css("display", "none");

            id_usuario = 0;
            $("#iptNombre_Usuario").val("");
            $("#iptApellido_Usuario").val("");
            $("#iptUsuario").val("");
            $("#iptClave").val("");
            $("#iptPerfil").val("");
            $("#iptEstado").val("");
        })

        /* ======================================================================================
        EVENTO AL DAR CLICK EN EL BOTON EDITAR USUARIOS
        =========================================================================================*/
        $('#tbl_usuarios tbody').on('click', '.btnEditarUsuario', function() {

            accion = 2; //seteamos la accion para editar
            $("#mdlGestionarUsuario").modal('show');
            var data = table_usuarios.row($(this).parents('tr')).data();

            //console.log("🚀 ~ file: administrar_ventas.php ~ line 97 ~ $ ~ data", data)

            id_usuario = data[0];
            $("#iptNombre_Usuario").val(data[1]);
            $("#iptApellido_Usuario").val(data[2]);
            $("#iptUsuario").val(data[3]);
            $("#iptClave").val(data["clave"]);
            if (data['perfil'] == 'Administrador') {
                $("#iptPerfil").val("1");
            } else {
                $("#iptPerfil").val("2");
            }   
            $("#iptEstado").val(data["estado"]);

        })

        /* ======================================================================================
          EVENTO AL DAR CLICK EN EL BOTON ELIMINAR USUARIO
          =========================================================================================*/
        $('#tbl_usuarios tbody').on('click', '.btnEliminarUsuario', function() {

            accion = 3; //seteamos la accion para editar

            var data = table_usuarios.row($(this).parents('tr')).data();

            var id_usuario = data["id_usuario"];

            Swal.fire({
                title: 'Está seguro de eliminar el usuario?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, deseo eliminarlo!',
                cancelButtonText: 'Cancelar',
            }).then((result) => {

                if (result.isConfirmed) {
                    var datos = new FormData();
                    datos.append("accion", accion);
                    datos.append("id_usuario",id_usuario); //id_usuario               

                    $.ajax({
                        url: "ajax/usuario.ajax.php",
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
                                    title: 'El usuario se eliminó correctamente'
                                });

                                table_usuarios.ajax.reload();

                            } else {
                                Toast.fire({
                                    icon: 'error',
                                    title: 'El usuario no se pudo eliminar'
                                });
                            }

                        }
                    });

                }
            })
        })

        /*===================================================================*/
        //EVENTO QUE GUARDA LOS DATOS DEL USUARIO, PREVIA VALIDACION DEL INGRESO DE LOS DATOS OBLIGATORIOS
        /*===================================================================*/
        document.getElementById("btnGuardarUsuarios").addEventListener("click", function() {

            // Get the forms we want to add validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {

                if (form.checkValidity() === true) {

                    console.log("Listo para registrar el usuario")

                    Swal.fire({
                        title: 'Está seguro de registrar el usuario?',
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
                            datos.append("id_usuario", id_usuario);
                            datos.append("nombre_usuario", $("#iptNombre_Usuario").val()); //nombre del usuario
                            datos.append("apellido_usuario", $("#iptApellido_Usuario").val()); //apellido_usuario
                            datos.append("usuario", $("#iptUsuario").val()); //usuario
                            datos.append("clave", $("#iptClave").val()); //clave
                            datos.append("perfil", $("#iptPerfil").val()); //Perfil
                            datos.append("estado", $("#iptEstado").val()); //estado


                            if (accion == 1) {
                                var titulo_msj = "El usuario se registró correctamente"
                            }

                            if (accion == 2) {
                                var titulo_msj = "El usuario se actualizó correctamente"
                            }

                            $.ajax({
                                url: "ajax/usuario.ajax.php",
                                method: "POST",
                                data: datos,
                                cache: false,
                                contentType: false,
                                processData: false,
                                dataType: 'json',
                                success: function(respuesta) {
                                    console.log("🚀 ~ file: administrar_ventas.php ~ line 97 ~ $ ~ respuesta", respuesta)
                                    if (respuesta == "ok") {

                                        Toast.fire({
                                            icon: 'success',
                                            title: titulo_msj
                                        });

                                        table_usuarios.ajax.reload();

                                        $("#mdlGestionarUsuario").modal('hide');

                                        $("#iptNombre_Usuario").val("");
                                        $("#iptApellido_Usuario").val("");
                                        $("#iptUsuario").val("");
                                        $("#iptClave").val("");
                                        $("#iptPerfil").val("");
                                        $("#iptEstado").val("");

                                    } else {
                                        Toast.fire({
                                            icon: 'error',
                                            title: 'El producto no se pudo registrar'
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
    })
</script>