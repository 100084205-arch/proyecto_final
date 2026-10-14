 <!-- Content Header (Page header) -->
 <div class="content-header">
     <div class="container-fluid">
         <div class="row mb-2">
             <div class="col-sm-6">
                 <h1 class="m-0">Buscar salidas en Warehouse</h1>
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
 <div class="content pb-2">
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

                                 <div class="form-group mb-2">
                                     <button class="bg-purple" id="filtrar">
                                         <i class="fa fa-paper-plane"></i> FILTRAR PKGID
                                     </button>
                                     <input type="number" class="form-control form-control-sm" id="pkgid"
                                         placeholder="Ingrese el nombre el pkgd" autofocus>
                                 </div>
                             </div>
                             <div class="col-2">

                                 <div class="form-group mb-2">
                                     <button class="bg-pink" id="filtrar_iten_num">
                                         <i class="fa fa-paper-plane"></i> FILTRAR ITENNUM
                                     </button>
                                     <input type="text" class="form-control form-control-sm" id="iten_num"
                                         placeholder="Ingrese el nombre el itennum">
                                 </div>
                             </div>
                             <div class="col-2">
                                 <div class="form-group mb-2">
                                     <label class="far fa-calendar-alt">Fecha Desde</label>
                                     <input class="form-control " id="fechaDesde" name="fechaDesde" type="date"
                                         value="<?php echo date('Y-m-d'); ?>" required />

                                 </div>
                             </div>
                             <div class="col-2">
                                 <div class="form-group mb-2">
                                     <label class="far fa-calendar-alt">Fecha Hasta</label>
                                     <input class="form-control " id="fechaHasta" name="fechaHasta" type="date"
                                         value="<?php echo date('Y-m-d'); ?>" required />

                                 </div>
                             </div>
                             <div class="col-md-1 d-flex flex-row align-items-center justify-content-end">
                                 <div class="form-group m-0">
                                     <a class="btn btn-primary" style="width:120px;" id="btnFiltrar">Buscar</a>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
         </div>
         <!-- Main content -->
         <div class="content">
             <div class="container-fluid">
                 <!-- row para listado de productos/inventario -->
                 <div class="row">
                     <div class="col-lg-12">
                         <table id="buscar_salida" class="tbale table-bordered table-striped w-100">
                             <thead class="bg-info">
                                 <tr style="font-size: 15px;">
                                     <th>PKGID</th>
                                     <th>ITEN NUM</th>
                                     <th>COLOR</th>
                                     <th>CANTIDAD</th>
                                     <th>DESTINO</th>
                                     <th>CREADOR</th>
                                     <th>FECHA SALIDA</th>
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
     </div>
     <!-- /.content -->
     <script>
     var Toast = Swal.mixin({
         toast: true,
         position: 'top',
         showConfirmButton: false,
         timer: 3000
     });

     window.addEventListener("keydown", (e) => {
         if (e.keyCode === 13) {
             filtro();
         }
     })
     var table, fechaDesde, fechaHasta;
     $(document).ready(function() {

         fechaDesde = $("#fechaDesde").val();
         fechaHasta = $("#fechaHasta").val();
         /*ENVENTO PARA LISTAR LOS PRODUCTOS DE WAREHOUSE POR FECHA ACTUAL*/
         table = $("#buscar_salida").DataTable({
             "bDestroy": true,
             dom: 'Bfrtip',
             buttons: [
                 'copy', 'pdf', 'excel', 'print', 'pageLength',
             ],
             lengthMenu: [0, 5, 10, 15, 20, 150],
             "pageLength": 150,
             ajax: {
                 url: "ajax/productos.ajax.php",
                 dataSrc: '',
                 type: "POST",
                 data: {
                     'accion': 11,
                     'fechaDesde': fechaDesde,
                     'fechaHasta': fechaHasta

                 }, //1: LISTAR LA BUSQUEADA DE SALIDAD
             },
             columnDefs: [{
                 targets: 7,
                 orderable: false,
                 render: function(datqa, type, full, meta) {
                     return "<center>" +
                         "<span class='btnRegresarSalida text-danger px-1'style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='REGRESAR EL PRODUCTO'> " +
                         "<i class='fas fa-angle-double-left fs-5'> </i> " +
                         "</span>" +
                         "</center>"
                 }
             }],
             language: {
                 url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
             }
         });
         /* ======================================================================================
         EVENTO QUE LIMPIA EL INPUT DE FILTRAR PKGID
         ======================================================================================*/
         $("#filtrar").on('click', function() {
             filtro();
         })
         /* ======================================================================================
         EVENTO QUE LIMPIA EL INPUT DE FILTRAR ITENNUN
         ======================================================================================*/
         $("#filtrar_iten_num").on('click', function() {
             filtrar_iten_num();
         })
         /* ======================================================================================
         EVENTO QUE LIMPIA EL INPUT DE FILTRAR ITENNUN
         ======================================================================================*/
         $("#tnRegresarSalida").on('click', function() {
             filtrar_iten_num();
         })
         /*===================================================================*/
         // EVENTO PARA LIMPIAR INPUTS DE PKGID
         /*===================================================================*/
         $("#filtrar").on('click', function() {
             $("#pkgid").val('')
             table.search('').columns().search('').draw();
         })
         /*===================================================================*/
         // EVENTO PARA LIMPIAR INPUTS DE CRITERIOS ITENNUM
         /*===================================================================*/
         $("#filtrar_iten_num").on('click', function() {
             $("#iten_num").val('')
             table.search('').columns().search('').draw();
         })
         /*ENVENTO PARA DEVOLVER UN PRODUCTO DE LA SALIDA DE WAHEREHOUSE*/
         $('#buscar_salida tbody').on('click', '.btnRegresarSalida', function() {
             var pkgid = $(this).attr("pkgid");
             var data = table.row($(this).parents('tr')).data();
             var pkgid = data["pkgid"];
             Swal.fire({
                 title: 'Está seguro de retornar el articulo ' + pkgid + '?',
                 icon: 'warning',
                 showCancelButton: true,
                 confirmButtonColor: '#3085d6',
                 cancelButtonColor: '#d33',
                 confirmButtonText: 'Si, deseo retornarlo!',
                 cancelButtonText: 'Cancelar!',
             }).then((result) => {
                 if (result.isConfirmed) {
                     $.ajax({
                         url: "ajax/ventas.ajax.php",
                         type: "POST",
                         data: {
                             accion: '3',
                             pkgid: String(pkgid)
                         },
                         dataType: 'json',
                         success: function(respuesta) {
                             //  console.log( "🚀 ~ file: administrar_ventas.php ~ line 134 ~ respuesta",respuesta)
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
     /*===================================================================*/
     //FUNCION PARA BUSCAR LA  SALIDAS POR EL PKGID
     /*===================================================================*/
     function filtro() { // alert("pgid");
         var pkgid = $("#pkgid").val();
         if (pkgid == "") {
             Toast.fire({
                 icon: 'warning',
                 title: 'Ingrese el nombre del pkgid'
             });
         } else {
             table = $("#buscar_salida").DataTable({
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
                                 title: ' El pkgid no existe o no se le a dado salida'
                             });
                         }
                         return respuesta;
                     },
                     data: {
                         'accion': 9,
                         'pkgid': pkgid
                     } //1: LISTAR LA BUSQUEADA DE SALIDAD
                 },
                 columnDefs: [{
                     targets: 7,
                     orderable: false,
                     render: function(datqa, type, full, meta) {
                         return "<center>" +
                             "<span class='btnRegresarSaliaPorElFiltroPKGID text-danger px-1'style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='REGRESAR EL PRODUCTO'> " +
                             "<i class='fas fa-angle-double-left fs-5'> </i> " +
                             "</span>" +
                             "</center>"
                     }
                 }],
                 language: {
                     url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
                 }
             });
         }
         /*ENVENTO PARA ELIMINAR UN PRODUCTO DE LA SALIDA DE WAHEREHOUSE CUANDO BUSCA POR EL FILTRO DEL PKGID  RECORDAR QUE ESTE MISMO BOTON SE VA USAR PARA ELIMINAR CUANDO BUSQUE POR EL FILTRO DEL ITENNUM PERO CON OTRO NOMBRE */
         $('#buscar_salida tbody').on('click', '.btnRegresarSaliaPorElFiltroPKGID ', function() {
             var pkgid = $(this).attr("pkgid");
             var data = table.row($(this).parents('tr')).data();
             var pkgid = data["pkgid"];
             Swal.fire({
                 title: 'Está seguro de retornar el articulo ' + pkgid + '?',
                 icon: 'warning',
                 showCancelButton: true,
                 confirmButtonColor: '#3085d6',
                 cancelButtonColor: '#d33',
                 confirmButtonText: 'Si, deseo retornarlo!',
                 cancelButtonText: 'Cancelar!',
             }).then((result) => {
                 if (result.isConfirmed) {
                     $.ajax({
                         url: "ajax/ventas.ajax.php",
                         type: "POST",
                         data: {
                             accion: '3',
                             pkgid: String(pkgid)
                         },
                         dataType: 'json',
                         success: function(respuesta) {
                             //  console.log( "🚀 ~ file: administrar_ventas.php ~ line 134 ~ respuesta",respuesta)
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
     }
     /*===================================================================*/
     //FUNCION PARA BUSCAR LA  SALIDAS POR EL PKGID
     /*===================================================================*/
     function filtrar_iten_num() {
         // alert("item");
         var iten_num = $("#iten_num").val();
         if (iten_num == "") {
             Toast.fire({
                 icon: 'warning',
                 title: 'Ingrese el nombre del iten_num'
             });
         } else {

             table = $("#buscar_salida").DataTable({
                 "bDestroy": true,
                 dom: 'Bfrtip',
                 buttons: [
                     'copy', 'pdf', 'excel', 'print', 'pageLength',
                 ],
                 lengthMenu: [0, 5, 10, 15, 20, 150],
                 "pageLength": 15,
                 ajax: {
                     url: "ajax/productos.ajax.php",
                     dataSrc: '',
                     type: "POST",
                     data: {
                         'accion': 12,
                         'iten_num': iten_num

                     }, //1: LISTAR LA BUSQUEADA DE SALIDAD
                     dataType: 'json',
                     "dataSrc": function(respuesta) {
                         if (respuesta == 0) {
                             Toast.fire({
                                 icon: 'error',
                                 title: ' El iten_num no existe o no se le a dado salida'
                             });
                         }
                         return respuesta;
                     },
                 },
                 columnDefs: [{
                     targets: 7,
                     orderable: false,
                     render: function(datqa, type, full, meta) {
                         return "<center>" +
                             "<span class='btnRegresarSaliaPorElfiltrar_iten_num  text-danger px-1'style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='REGRESAR EL PRODUCTO'> " +
                             "<i class='fas fa-angle-double-left fs-5'> </i> " +
                             "</span>" +
                             "</center>"
                     }
                 }],
                 language: {
                     url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
                 }
             });
         }
         /*ENVENTO PARA ELIMINAR UN PRODUCTO DE LA SALIDA DE WAHEREHOUSE CUANDO BUSCA POR EL FILTRO DEL PKGID  RECORDAR QUE ESTE MISMO BOTON SE VA USAR PARA ELIMINAR CUANDO BUSQUE POR EL FILTRO DEL ITENNUM PERO CON OTRO NOMBRE */
         $('#buscar_salida tbody').on('click', '.btnRegresarSaliaPorElfiltrar_iten_num ', function() {
             var pkgid = $(this).attr("pkgid");
             var data = table.row($(this).parents('tr')).data();
             var pkgid = data["pkgid"];
             Swal.fire({
                 title: 'Está seguro de retornar el articulo ' + pkgid + '?',
                 icon: 'warning',
                 showCancelButton: true,
                 confirmButtonColor: '#3085d6',
                 cancelButtonColor: '#d33',
                 confirmButtonText: 'Si, deseo retornarlo!',
                 cancelButtonText: 'Cancelar!',
             }).then((result) => {
                 if (result.isConfirmed) {
                     $.ajax({
                         url: "ajax/ventas.ajax.php",
                         type: "POST",
                         data: {
                             accion: '3',
                             pkgid: String(pkgid)
                         },
                         dataType: 'json',
                         success: function(respuesta) {
                             //  console.log( "🚀 ~ file: administrar_ventas.php ~ line 134 ~ respuesta",respuesta)
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
     }
     /*EVENTO PARA FILTAR VENTAS SEGUN EL RANGO DE FECHAS */
     $("#btnFiltrar").on('click', function() {
         table.destroy();
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


         table = $("#buscar_salida").DataTable({
             "bDestroy": true,
             dom: 'Bfrtip',
             buttons: [
                 'copy', 'pdf', 'excel', 'print', 'pageLength',
             ],
             lengthMenu: [0, 5, 10, 15, 20, 150],
             "pageLength": 150,
             ajax: {
                 url: "ajax/productos.ajax.php",
                 dataSrc: '',
                 type: "POST",
                 data: {
                     'accion': 11,
                     'fechaDesde': fechaDesde,
                     'fechaHasta': fechaHasta

                 }, //1: LISTAR LA BUSQUEADA DE SALIDAD
             },
             columnDefs: [{
                 targets: 7,
                 orderable: false,
                 render: function(datqa, type, full, meta) {
                     return "<center>" +
                         "<span class='btnRegresarSalida text-danger px-1'style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='REGRESAR EL PRODUCTO'> " +
                         "<i class='fas fa-angle-double-left fs-5'> </i> " +
                         "</span>" +
                         "</center>"
                 }
             }],
             language: {
                 url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
             }
         });


     })
     </script>