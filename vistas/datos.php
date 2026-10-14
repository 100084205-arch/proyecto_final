<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Gestor avanzado de materiales por orden</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                    <li class="breadcrumb-item active">Inventario Activo</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
   <!--ESTA CAJA CONTIENE LOS DOS INPUT PARA EL FILTRADO DE LOS PRODUCTOS EN WAREHOUSE-->
 
   <div class="container-fluid">
    <div class="row">
       
    
    <div class="col-md-8" >

        <div class="card shadow bg-dark text-white p-3">
            <!-- INPUT PARA LA BUSCA POR FILTRO DEL PKGD-->
          <div class="row">
                        <!-- Columna para registro de la descripción de numero de The order -->
                        <div class="col-12 col-lg-2">
                            <div class="form-group mb-2">
                                <label  for="cod_datosFiltrar"><i class="fa fa-barcode"></i>
                                    <span class="small">The order</span><span class="text-danger">*</span>
                                </label>
                                <input type="number" class="form-control form-control-sm" id="cod_datosFiltrar"
                                    name="cod_datosFiltrar" placeholder="The order" required>
                                <div class="invalid-feedback">The order</div>
                            </div>
                        </div>
                              <!-- Columna para registro de la descripción de numero de The order -->
                        <div class="col-12 col-lg-2">
                            <div class="form-group mb-2">
                                <label  for="num_datosFiltrar"><i class="fa fa-barcode"></i>
                                    <span class="small">Voucher</span><span class="text-danger">*</span>
                                </label>
                                <input type="number" class="form-control form-control-sm" id="num_datosFiltrar"
                                    name="num_datosFiltrar" placeholder="Voucher" required>
                                <div class="invalid-feedback">Debe ingresar el Numero de Orden</div>
                            </div>
                        </div>
                   
                           <!-- Columna para registro del tipo de piedras -->
                            <div class="col-12  col-lg-2">
                            <div class="form-group mb-2">
                                <label for="id_piedrasFiltrar"><i class="fas fa-dumpster fs-6"></i>
                                    <span class="small">Type of stone</span><span class="text-danger">*</span>
                                </label>
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                    id="id_piedrasFiltrar" required>
                                </select>
                                <div class="invalid-feedback">Seleccione el tipo de piedras</div>
                            </div>
                        </div>

                         <!-- Columna para registro de la descripción del Estilo de la piedra-->
                        <div class="col-12 col-lg-2">
                            <div class="form-group mb-2">
                                <label for="color_piedrasFiltrar"><i class="fa fa-address-card"></i>
                                    <span class="small">Color</span><span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control form-control-sm" id="color_piedrasFiltrar"
                                    name="color_piedrasFiltrar" placeholder="Color" required>
                                <div class="invalid-feedback">Debe ingresar el color de piedras</div>
                            </div>
                        </div>    
                        
                         <!-- Columna para registro del Tamaño (puedes seleccionar varios) -->
                            <div class="col-12  col-lg-2">
                            <div class="form-group mb-2">
                                <label class="" for="tamano_piedraFiltrar"><i class="fas fa-dumpster fs-6"></i>
                                    <span class="small">Quantity of stones</span><span class="text-danger">*</span>
                                </label>
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                    id="tamano_piedraFiltrar" required>
                                </select>
                                <div class="invalid-feedback">Seleccione el tamaño de piedras</div>
                            </div>
                        </div>                              

                        <!-- Columna para registro de la descripción del Estilo de la piedra-->
                        <div class="col-12 col-lg-2">
                            <div class="form-group mb-2">
                                <label for="estilo_piedraFiltrar"><i class="fa fa-address-card"></i>
                                    <span class="small">Style Num</span><span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control form-control-sm" id="estilo_piedraFiltrar"
                                    name="estilo_piedraFiltrar" placeholder="Style Num" required>
                                <div class="invalid-feedback">Debe ingresar el Style Num</div>
                            </div>
                        </div>  
                       
                                    <!-- Columna para registro de la fecha -->
                       <div class="col-12 col-lg-2">
                            <div class="form-group mb-2">
                                <label  for="fechaDesdeFiltrar"><i class=""></i>
                                    <span class="small">Date since scheduled</span><span class="text-danger">*</span>
                                </label>
                                <input class="form-control " id="fechaDesdeFiltrar" name="fecha" type="date"
                                    value="<?php echo date('Y-m-d'); ?>" required />
                            </div>
                        </div>            
                             <!-- Columna para registro de la fecha -->
                       <div class="col-12 col-lg-2">
                            <div class="form-group mb-2">
                                <label  for="fechaHastaFiltrar"><i class=""></i>
                                    <span class="small">Scheduled Until Date</span><span class="text-danger">*</span>
                                </label>
                                <input class="form-control " id="fechaHastaFiltrar" name="fecha" type="date"
                                    value="<?php echo date('Y-m-d'); ?>" required />
                            </div>
                        </div>   
                        <!-- creacion de botones para cancelar y guardar el producto -->
                        <button type="button" class="btn btn-danger mt-3 mx-2" style="width:170px;"
                           id="btnLimpiar">Clean</button>
                        <button type="button" style="width:170px;" class="btn btn-primary mt-3 mx-2"
                            id="btnFiltrar"> Filter </button>
                        <!-- <button class="btn btn-default btn-success" type="submit" name="submit" value="Submit">Save</button> -->
                    </div>

        </div><!-- ./ CARD -->

    </div>

   <div class="col-md-4">
            <div class="card shadow p-3">

                <div class="row text-center">

                <!-- KPI 1 -->
                <div class="col-4">
                    <div class="kpi-box bg-light">
                    <i class="fa fa-gem kpi-icon text-primary"></i>
                    <small class="d-block">Piedras por piezas</small>
                    <span id="kpi_piedras_pieza" class="kpi-value">0</span>
                    </div>
                </div>

                <!-- KPI 2 -->
                <div class="col-4">
                    <div class="kpi-box bg-light">
                    <i class="fa fa-cubes kpi-icon text-success"></i>
                    <small class="d-block">Cantidad de prendas</small>
                    <span id="kpi_cantidad_piedras" class="kpi-value">0</span>
                    </div>
                </div>

                <!-- KPI 3 -->
                <div class="col-4">
                    <div class="kpi-box bg-light">
                    <i class="fa fa-box kpi-icon text-warning"></i>
                    <small class="d-block">Total piedras</small>
                    <span id="kpi_total_piezas" class="kpi-value">0</span>
                    </div>
                </div>

                </div>

            </div>
            </div>

            </div>
            </div>
<!-- /.content-header -->
<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <!-- row para listado de productos/inventario -->
        <div class="row">
            <div class="col-lg-12">
                <table id="tabla_Datos" class="table table-bordered table-striped w-100 ">
                    <thead class="bg-info">
                        <tr style="font-size: 15px;">
                              <th>Orden</th>   
                              <th>Voucher</th>   
                              <th>Type of stone</th>
                              <th>Color</th>
                               <th>Zize of stones</th>
                              <th>Quantity of stones</th>    
                              <th>Quantity of garments</th>   
                              <th>Total Piedra</th>     
                             <th>Style Num</th>                            
                              <th>Creador</th>
                              <th>Fecha voucher</th>
                              <th>Fecha creado</th>                               
                        </tr>
                    </thead>
                    <tbody class="text-small">
                    </tbody>
                </table>
            </div>
        </div>

    </div><!-- /.container-fluid -->
</div>
<div class="modal fade" id="mdlGestionar_Datos" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- contenido del modal -->
        <div class="modal-content">
            <!-- cabecera del modal -->
            <div class="modal-header bg-gray py-1">
                <h5 class="modal-title">Add / Data </h5>
                <button type="button" class="btn btn-outline-primary text-white border-0 fs-5" data-bs-dismiss="modal"
                    id="btnCerrarModal">
                    <i class="far fa-times-circle"></i>
                </button>
            </div>
            <!-- cuerpo del modal -->
            <div class="modal-body">
                <form class="needs-validation" novalidate>
                    <!-- Abrimos una fila -->
                    <div class="row bg-dark">
                        <!-- Columna para registro de la descripción de numero de la The order -->
                        <div class="col-12 col-lg-12">
                            <div class="form-group mb-2">
                                <label class="fa fa-barcode" for="cod_datos"><i class=""></i>
                                    <span class="small">The order</span><span class="text-danger">*</span>
                                </label>
                                <input type="number" class="form-control form-control-sm" id="cod_datos"
                                    name="cod_datos" placeholder="The order" required>
                                <div class="invalid-feedback">Debe ingresar The order</div>
                            </div>
                        </div>
                         <!-- Columna para registro de la descripción de numero de la orden -->
                        <div class="col-12 col-lg-3">
                            <div class="form-group mb-2">
                                <label class="fa fa-barcode" for="num_datos"><i class=""></i>
                                    <span class="small">Voucher</span><span class="text-danger">*</span>
                                </label>
                                <input type="number" class="form-control form-control-sm" id="num_datos"
                                    name="num_datos" placeholder="Voucher" required>
                                <div class="invalid-feedback">Debe ingresar el Numero de Orden</div>
                            </div>
                        </div>
                        <!-- Columna para registro de la fecha -->
                       <div class="col-12 col-lg-3">
                            <div class="form-group mb-2">
                                <label for="fecha"><i class=""></i>
                                    <span class="small">Scheduled Date</span><span class="text-danger">*</span>
                                </label>
                                <input class="form-control " id="fecha" name="fecha" type="date"
                                    value="<?php echo date('Y-m-d'); ?>" required />
                            </div>
                        </div>
              


                           <!-- Columna para registro del tipo de piedras -->
                            <div class="col-12  col-lg-2">
                            <div class="form-group mb-2">
                                <label for="id_piedras"><i class="fas fa-dumpster fs-6"></i>
                                    <span class="small">Type of stone</span><span class="text-danger">*</span>
                                </label>
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                    id="id_piedras">
                                </select>
                                <div class="invalid-feedback">Seleccione el tipo de piedras</div>
                            </div>
                        </div>



                         <div class="col-12 col-lg-3">
                            <div class="form-group mb-2">
                                <label for="color_piedras"><i class="fa fa-address-card"></i>
                                    <span class="small">Color</span><span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control form-control-sm" id="color_piedras"
                                    name="color_piedras" placeholder="Color" >
                                
                            </div>
                        </div>    
                        
                         <!-- Columna para registro del Tamaño (puedes seleccionar varios) -->
                            <div class="col-12  col-lg-3">
                            <div class="form-group mb-2">
                                <label class="" for="tamano_piedra"><i class="fas fa-dumpster fs-6"></i>
                                    <span class="small">Size of stones</span><span class="text-danger">*</span>
                                </label>
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                    id="tamano_piedra">
                                </select>
                                <div class="invalid-feedback">Seleccione The Size of stones</div>
                            </div>
                        </div>
                         <!-- Columna para registro de la Quantity of stones por pieza -->
                        <div class="col-12 col-lg-3">
                            <div class="form-group mb-2">
                                <label class="fas fa-plus-circle fs-6" for="cant_piedra"><i class=""></i>
                                    <span class="small">Quantity of stones</span><span class="text-danger">*</span>
                                </label>
                                <input type="number" class="form-control form-control-sm" id="cant_piedra"
                                    name="cant_piedra" placeholder="Quantity">
                                <div class="invalid-feedback">Debe ingresar Quantity of stones</div>
                            </div>
                        </div>

                        <!-- Columna para registro de la Quantity of garments-->
                        <div class="col-12 col-lg-3">
                            <div class="form-group mb-2">
                                <label class="fas fa-plus-circle fs-6" for="cantidad_prendas"><i class=""></i>
                                    <span class="small">Quantity of garments</span><span class="text-danger">*</span>
                                </label>
                                <input type="number" class="form-control form-control-sm" id="cantidad_prendas"
                                    name="cantidad_prendas" placeholder="Quantity of garments">
                                <div class="invalid-feedback">Debe ingresar Quantity of garments</div>
                            </div>
                        </div>

                        <!-- Columna para registro de la descripción del Estilo de la piedra-->
                        <div class="col-12 col-lg-3">
                            <div class="form-group mb-2">
                                <label class="fa fa-address-card" for="estilo_piedra"><i class=""></i>
                                    <span class="small">Style Num</span><span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control form-control-sm" id="estilo_piedra"
                                    name="estilo_piedra" placeholder="Style Num">
                                <div class="invalid-feedback">Debe ingresar The Style Num</div>
                            </div>
                        </div>           
                          <div class="row mt-2">

                        <div class="col-md-12 text-end">

                            <button type="button"
                                id="btnAgregarColor"
                                class="btn btn-success btn-sm">

                                <i class="fa fa-plus"></i> Add Color

                            </button>

                        </div>

                    </div>


                        <div class="row mt-3">

                            <div class="col-md-12">

                               <div class="table-responsive tabla-scroll">
                                    <table class="table table-bordered table-hover" id="tblColores">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>Type of stoneColor</th>
                                                <th>Color</th>
                                                <th>Stone Size</th>
                                                <th>Qty Stones</th>
                                                <th>Qty Garments</th>
                                                <th>Style Num</th>
                                                <th>Accion</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>

                            </div>

                        </div>     
                        <!-- creacion de botones para cancelar y guardar el producto -->
                        <button type="button" class="btn btn-danger mt-3 mx-2" style="width:170px;"
                            data-bs-dismiss="modal" id="btnCancelarRegistro">Cancel</button>
                        <button type="button" style="width:170px;" class="btn btn-primary mt-3 mx-2"
                            id="btnGuardarDatos"> Save </button>
                        <!-- <button class="btn btn-default btn-success" type="submit" name="submit" value="Submit">Save</button> -->
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
   <!-- Factura Preview Modal -->
   <div id="FacturaPreview" class="modal fade" tabindex="-1" role="dialog">
       <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
           <div class="modal-content">
               <div class="modal-header">
                   <h5 class="modal-title"></h5>
                   <button type="button"class="bg-danger" class="close" onclick="$('#FacturaPreview').modal('hide');" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                   </button>
               </div>
      

               <div class="modal-body">
                   <div class="table-responsive">
                       <table class="display nowrap table-striped w-100 shadow" id="lstDatos">
                           <thead>
                               <tr>
                                 <th>Type of stoneColor</th>
                                 <th>Color</th>
                                 <th>Stone Size</th>
                                 <th>Qty Stones</th>
                                 <th>Qty Garments</th>
                                 <th>Style Num</th>
                                 <th>Accion</th>
                               </tr>
                           </thead>
                       </table>
                   </div>
               </div>
               <div class="modal-footer">
                   <button type="button" class="btn btn-secondary"
                       onclick="$('#FacturaPreview').modal('hide');">Cerrar</button>
               </div>
           </div>
       </div>
   </div>
   <!-- / Factura Preview Modal -->
<style>
.ui-autocomplete {
    position: absolute !important;
    z-index: 2000 !important;
}
</style>
<!-- /.content -->
<script>
    var tablaColores;
    var accion;
    var table;  
   
    var items = [];// SE USA PARA EL INPUT DE AUTOCOMPLETE
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
    function actualizarKPI(id, valor) {
  let el = document.getElementById(id);
  let num = parseFloat(valor);

  el.classList.remove("kpi-animate");
  void el.offsetWidth; // reinicia animación
  el.classList.add("kpi-animate");

  el.innerHTML = num;

  // colores dinámicos
  if (num == 0) {
    el.style.color = "#dc3545"; // rojo
  } else if (num < 50) {
    el.style.color = "#ffc107"; // amarillo
  } else {
    el.style.color = "#198754"; // verde
  }
}
  /*===================================================================*/
 //ESTE BLOQUE DE CODIGO ES PARA FILTRAR LOS TYPE OF STONE  Y QUANTITY OF STONES
 /*===================================================================*/
$("#id_piedras, #id_piedrasFiltrar").on("change", function () {
       var cod_datos = $(this).val();

      //alert(cod_datos);
        //$(this).val();
         $.ajax({
            url: "ajax/datos_materiales.ajax.php",
            type: "POST",
            data: {
                'accion': 5,
                cod_datos : cod_datos
                 //1: LISTAR EL NOMBRE EN EL INPUT DE LA PANTALLA MODAL
            },
            dataType: 'json',
            success: function(respuesta) {
                console.log("respuesta", respuesta);              
               let optTamano = '<option value="">Seleccione tamaño</option>';

               for (let i = 0; i < respuesta.length; i++) {          
               optTamano += `<option value="${respuesta[i][0]}">${respuesta[i][0]}</option>`;
               }
               
                $("#tamano_piedra").html(optTamano);
                $("#tamano_piedraFiltrar").html(optTamano);

              
            }            
        });
    
    });
        /*===================================================================*/
        //ESTE BLOQUE DE CODIGO ES PARA PARA TRAER LOS DATOS DE LOS COLORES
        /*===================================================================*/
    $.ajax({
            url: "ajax/datos_materiales.ajax.php",
            type: "POST",
            data: {
                'accion': 6 //1: LISTAR EL NOMBRE EN EL INPUT DE LA PANTALLA MODAL
            },
            dataType: 'json',
            success: function(respuesta) {
                console.log(respuesta);
                 for (let i = 0; i < respuesta.length; i++) {
                items.push(respuesta[i]['colores'])
            }

              $("#color_piedrasFiltrar,#color_piedras").autocomplete({

                source: items,
                select: function(event, ui) {

                   // CargarProductos(ui.item.value);

                    $("#color_piedrasFiltrar").val(ui.item.value);
                    $("#color_piedras").val(ui.item.value);

                   /// $("#color_piedrasFiltrar").focus();

                    return false;
                }
            })
            }            
        });
    
        /*===================================================================*/
        //ESTE BLOQUE DE CODIGO ES PARA REALIZAR TODO EL FILTRADO 
        /*===================================================================*/

    $('#btnFiltrar').on('click', function() { 
     // alert("hola");
    var cod_datos = $("#cod_datosFiltrar").val().trim();
    var num_datos = $("#num_datosFiltrar").val().trim();
    var id_piedras = $("#id_piedrasFiltrar option:selected").val().trim();     
    var color_piedras = $("#color_piedrasFiltrar").val().trim();
    var tamano_piedra = $("#tamano_piedraFiltrar").val();
    var estilo_piedra = $("#estilo_piedraFiltrar").val().trim();
    var fechaDesdeFiltrar = $("#fechaDesdeFiltrar").val();
     var fechaHastaFiltrar = $("#fechaHastaFiltrar").val();
      // VALIDAR SI TODOS ESTÁN VACÍO
    if(!cod_datos && !num_datos && !id_piedras && !color_piedras && !tamano_piedra && !estilo_piedra && !fechaDesdeFiltrar && !fechaHastaFiltrar){

        Toast.fire({
            icon: 'warning',
            title: 'Debe ingresar al menos un dato para filtrar'
        });

        return;
    }
        // Inicialización por primera vez
        $('#tabla_Datos').DataTable({
            "bDestroy": true,
            dom: 'Bfrtip',
            buttons: [{
                text: 'Add order',
                className: 'addNewRecord',
                action: function(e, dt, node, config) {
                    $("#mdlGestionar_Datos").modal('show');
                    accion = 2; //registrar
                }
            },

            'copy', 'pdf', 'excel', 'print', 'pageLength'
        ],
        pageLength: [150, 200, 250, 300],
        pageLength: 150,
            ajax: {
                url: "ajax/datos_materiales.ajax.php",
                
                type: "POST",
                dataType: 'json',
               dataSrc: function (respuesta) {
                  if (!respuesta || respuesta.length === 0) {
                                Toast.fire({
                                    icon: 'error',
                                    title: 'Los datos no existen o esta mal digitado'
                                });
                                 //table.ajax.reload();
                                     // Reiniciar KPI
        actualizarKPI("kpi_piedras_pieza", 0);
        actualizarKPI("kpi_cantidad_piedras", 0);
        actualizarKPI("kpi_total_piezas", 0);
                      return[];         
                }       
                        
        var kpi_piedras_pieza = 0.00;
        var kpi_cantidad_piedras = 0;
        var kpi_total_piezas = 0;
                for (let i = 0; i < respuesta.length; i++) {                                       
                              kpi_piedras_pieza = parseFloat(respuesta[i][5]) + parseFloat(kpi_piedras_pieza);
                             kpi_cantidad_piedras = parseFloat(respuesta[i][6]) + parseFloat(kpi_cantidad_piedras);
                             kpi_total_piezas = parseFloat(respuesta[i][7]) + parseFloat(kpi_total_piezas);                           
                }
               
            //ACTUALIZAR KPI
            actualizarKPI("kpi_piedras_pieza", kpi_piedras_pieza);
            actualizarKPI("kpi_cantidad_piedras", kpi_cantidad_piedras);
            actualizarKPI("kpi_total_piezas", kpi_total_piezas);

            // devolver data al DataTable
                     $("#cod_datosFiltrar").val('');
                      $("#num_datosFiltrar").val('');
                        $("#id_piedrasFiltrar").val('');
                        $("#color_piedrasFiltrar").val('');
                        $("#tamano_piedraFiltrar").val('');
                        $("#estilo_piedraFiltrar").val('');
                        $("#fechaDesdeFiltrar").val('');
                        $("#fechaHastaFiltrar").val('');
        return respuesta; // OBLIGATORIO para DataTables
             

    },

                data: {
                    'accion': 4,
                    'cod_datos': cod_datos,
                    'num_datos': num_datos,
                    'id_piedras': id_piedras,
                    'color_piedras': color_piedras,
                    'tamano_piedra': tamano_piedra,
                    'estilo_piedra': estilo_piedra,
                    'fechaDesdeFiltrar': fechaDesdeFiltrar,
                    'fechaHastaFiltrar': fechaHastaFiltrar,
                },
             //  $("#resumenFiltros").html(data[0]['id_piedras']);
            },
            language: {
                url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
            }
        });
    
     });
           /*===================================================================*/
        //ESTE BLOQUE DE CODIGO ES PARA LIMPIAR LOS INPUTS DEL FILTRADO
        /*===================================================================*/
            $('#btnLimpiar').on('click', function() {
                        $("#cod_datosFiltrar").val('');
                         $("#num_datosFiltrar").val('');
                        $("#id_piedrasFiltrar").val('');
                        $("#color_piedrasFiltrar").val('');
                        $("#tamano_piedraFiltrar").val('');
                        $("#estilo_piedraFiltrar").val('');
                        $("#fechaFiltrar").val('');

            });



        /*===================================================================*/
        //este bloque de codigo trae los datos desde la base de datos para los inputs del formulario de gestor de materiales
        /*===================================================================*/
        $.ajax({
            url: "ajax/datos_materiales.ajax.php",
            type: "POST",
            data: {
                'accion': 1 //1: LISTAR EL NOMBRE EN EL INPUT DE LA PANTALLA MODAL
            },
            dataType: 'json',
            success: function(respuesta) {
                console.log("respuesta", respuesta);
               let optTipo   = '<option value="">Type of stone</option>';
               let optColor  = '<option value="">Seleccione color</option>';
               let optTamano = '<option value="">Seleccione tamaño</option>';

               for (let i = 0; i < respuesta.length; i++) {
               optTipo   += `<option value="${respuesta[i][0]}">${respuesta[i][1]}</option>`;            
               }
                $("#id_piedras").html(optTipo);             
               $("#id_piedrasFiltrar").html(optTipo);
              
            }            
        });
    
        table = $("#tabla_Datos").DataTable({
       bDestroy: true,
        dom: 'Bfrtip',
         buttons: [
           {
            text: 'Add order',
            className: 'addNewRecord',
            action: function () {
                $("#mdlGestionar_Datos").modal('show');
                accion = 2;
            }
          },
            'copy', 'pdf', 'excel', 'print', 'pageLength'
        ],
        pageLength: 150,

        ajax: {
        url: "ajax/datos_materiales.ajax.php",
        type: "POST",
        data: { accion: 3 },

        dataSrc: function (respuesta) {
         
            return respuesta;
        }
    },

    language: {
        url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
    }
});

})
 $("#btnCancelarRegistro, #btnCerrarModal").on('click', function() {
        $("#validate_cod_datos").css("display", "none");
        $("#validate_num_datos").css("display", "none");
        $("#validate_fecha").css("display", "none");
        $("#validate_id_piedras").css("display", "none");
        $("#validate_color_piedras").css("display", "none");
        $("#validate_tamano_piedra").css("display", "none");
        $("#validate_cant_piedra").css("display", "none");
        $("#validate_cantidad_prendas").css("display", "none");
        $("#validate_estilo_piedra").css("display", "none");
    
        $("#cod_datos").val('');
         $("#num_datos").val('');
        $("#fecha").val('');
        $("#id_piedras").val('');
        $("#color_piedras").val('');
        $("#tamano_piedra").val('');
        $("#cant_piedra").val('');
        $("#cantidad_prendas").val('');
        $("#estilo_piedra").val('');      

        table.search('').columns().search('').draw();
    })

    /*======================================================================*/
    //ESTE BLOQUE DE CODIGO ES PARA LIMPIAR  LA TABLA QUE ESTA EN EL FOMULARIO DE REGISTRO DE LOS DATOS
    /*======================================================================*/
        function limpiarDetalle(){

            $("#id_piedras").val("").trigger("change");
            $("#color_piedras").val("");
            $("#tamano_piedra").html('<option value="">Seleccione tamaño</option>');
            $("#cant_piedra").val("");
          //  $("#cantidad_prendas").val("");
            //$("#estilo_piedra").val("");

            $("#id_piedras").focus();

        }
        /*======================================================================*/
        //ESTE BLOQUE DE CODIGO ES PARA LLENAR LA TABLA QUE ESTA EN EL FOMULARIO DE REGISTRO DE LOS DATOS
        /*======================================================================*/
        tablaColores = $("#tblColores").DataTable({

    paging: false,
    searching: false,
    info: false,
    ordering: false,

    columns: [
        {
            data: "nombre_piedra",
            render: function(data){
                return '<span style="color:black;">'+data+'</span>';
            }
        },
        {
            data: "color_piedras",
            render: function(data){
                return '<span style="color:black;">'+data+'</span>';
            }
        },
        {
            data: "tamano_piedra",
            render: function(data){
                return '<span style="color:black;">'+data+'</span>';
            }
        },
        {
            data: "cant_piedra",
            render: function(data){
                return '<span style="color:black;">'+data+'</span>';
            }
        },
        {
            data: "cantidad_prendas",
            render: function(data){
                return '<span style="color:black;">'+data+'</span>';
            }
        },
        {
            data: "estilo_piedra",
            render: function(data){
                return '<span style="color:black;">'+data+'</span>';
            }
        },
        {
            data: null,
            defaultContent: '<button type="button" class="btn btn-danger btn-sm btnEliminar"><i class="fa fa-trash"></i></button>'
        }
    ]

});

     $("#btnAgregarColor").click(function () {
     let id_piedras      = $("#id_piedras").val();
    let nombrePiedra = $("#id_piedras option:selected").text();
    let color_piedras = $("#color_piedras").val().trim();
    let tamano_piedra = $("#tamano_piedra").val();
    let cant_piedra  = $("#cant_piedra").val();
    let cantidad_prendas  = $("#cantidad_prendas").val();
    let estilo_piedra      = $("#estilo_piedra").val().trim();

    if (!id_piedras) {
        Toast.fire({
        icon: "warning",
        title: "Seleccione el tipo de piedra"
        });
        return $("#id_piedras").focus();
    }

    if (!color_piedras) {
        Toast.fire({
        icon: "warning",
        title: "Ingrese el color"
         });
        return $("#color_piedras").focus();
    }

    if (!tamano_piedra) {
          Toast.fire({
        icon: "warning",
        title: "Seleccione el tamaño"
         });
       return $("#tamano_piedra").focus();
    }

    if (!cant_piedra) {
         Toast.fire({
        icon: "warning",
        title: "Ingrese la cantidad de piedras"
        });
       return $("#cant_piedra").focus();
    }

    if (!cantidad_prendas) {
          Toast.fire({
        icon: "warning",
        title: "Ingrese la cantidad de prendas"
         });
         return $("#cantidad_prendas").focus();
    }

    if (!estilo_piedra) {
           Toast.fire({
        icon: "warning",
        title: "Ingrese el Style Num"
         });
       return $("#estilo_piedra").focus();
    }

    tablaColores.row.add({
            id_piedras: id_piedras,                 // <-- NO SE MUESTRA
            nombre_piedra: nombrePiedra,        // <-- ESTE ES EL QUE VE EL USUARIO
            color_piedras: color_piedras,
            tamano_piedra: tamano_piedra,
            cant_piedra: cant_piedra,
            cantidad_prendas: cantidad_prendas,
            estilo_piedra: estilo_piedra
         }).draw(false);
    

    limpiarDetalle();

});
    /*======================================================================*/
    //ESTE BLOQUE DE CODIGO ES PARA ELIMINAR LOS DATOS DE  LA TABLA QUE ESTA EN EL FOMULARIO DE REGISTRO DE LOS DATOS
    /*======================================================================*/
 
$("#tblColores tbody").on("click", ".btnEliminar", function () {

    let fila = $(this).closest("tr");

    Swal.fire({
        title: "¿Eliminar color?",
        text: "Este color será eliminado de la lista.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#6c757d",
        confirmButtonText: "Sí, eliminar",
        cancelButtonText: "Cancelar"
    }).then((result) => {

        if (result.isConfirmed) {

            tablaColores
                .row(fila)
                .remove()
                .draw(false);

            Toast.fire({
                icon: "success",
                title: "Color eliminado correctamente"
            });

        }

    });

});



/*===================================================================*/
// EVENTO QUE GUARDA LOS DATOS DEL PRODUCTO,
// PREVIA VALIDACION DEL INGRESO DE LOS DATOS OBLIGATORIOS
/*===================================================================*/

document.getElementById("btnGuardarDatos").addEventListener("click", function() {

    var btnGuardar = this;

    var forms = document.getElementsByClassName('needs-validation');

    var validation = Array.prototype.filter.call(forms, function(form) {

        if (form.checkValidity() === true) {

            Swal.fire({
                title: 'Está seguro de registrar los datos?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, deseo registrarlo!',
                cancelButtonText: 'Cancelar',
            }).then((result) => {

                if (result.isConfirmed) {

                    // =========================================================
                    // DESACTIVAR BOTÓN PARA EVITAR DOBLE CLIC
                    // =========================================================

                    btnGuardar.disabled = true;


                    // =========================================================
                    // OBTENER LOS DETALLES DE LA TABLA
                    // =========================================================

                    let detalleColores = [];

                    tablaColores.rows().every(function() {

                        let detalle = this.data();

                        detalleColores.push(detalle);

                    });


                    // =========================================================
                    // MOSTRAR EN CONSOLA CUÁNTOS DETALLES SE VAN A ENVIAR
                    // =========================================================

                    console.log(
                        "Cantidad de filas encontradas en tablaColores:",
                        detalleColores.length
                    );

                    console.table(detalleColores);


                    // =========================================================
                    // VALIDAR QUE HAYA POR LO MENOS UN DETALLE
                    // =========================================================

                    if (detalleColores.length == 0) {

                        btnGuardar.disabled = false;

                        Toast.fire({
                            icon: 'warning',
                            title: 'Debe agregar al menos un color'
                        });

                        return;
                    }


                    // =========================================================
                    // ELIMINAR DETALLES EXACTAMENTE REPETIDOS
                    // =========================================================

                    let detallesUnicos = [];
                    let claves = new Set();

                    detalleColores.forEach(function(detalle) {

                        let clave = [
                            detalle.id_piedras,
                            detalle.color_piedras,
                            detalle.tamano_piedra,
                            detalle.cant_piedra,
                            detalle.cantidad_prendas,
                            detalle.estilo_piedra
                        ].join('|');


                        // Si todavía no existe, lo agregamos
                        if (!claves.has(clave)) {

                            claves.add(clave);

                            detallesUnicos.push(detalle);

                        }

                    });


                    // =========================================================
                    // MOSTRAR INFORMACIÓN PARA SABER SI HABÍA DUPLICADOS
                    // =========================================================

                    console.log(
                        "Cantidad original:",
                        detalleColores.length
                    );

                    console.log(
                        "Cantidad después de quitar duplicados:",
                        detallesUnicos.length
                    );

                    console.table(detallesUnicos);


                    // =========================================================
                    // FORM DATA
                    // =========================================================

                    var datos = new FormData();

                    datos.append("accion", accion);

                    datos.append(
                        "cod_datos",
                        $("#cod_datos").val()
                    );

                    datos.append(
                        "num_datos",
                        $("#num_datos").val()
                    );

                    datos.append(
                        "fecha",
                        $("#fecha").val()
                    );

                    datos.append(
                        "detalleColores",
                        JSON.stringify(detallesUnicos)
                    );


                    // =========================================================
                    // MENSAJE
                    // =========================================================

                    var titulo_msj = "";

                    if (accion == 2) {

                        titulo_msj = "Se registró correctamente";

                    }

                    if (accion == 8) {

                        titulo_msj = "El artículo se actualizó correctamente";

                    }


                    // =========================================================
                    // AJAX
                    // =========================================================

                    $.ajax({

                        url: "ajax/datos_materiales.ajax.php",

                        method: "POST",

                        data: datos,

                        cache: false,

                        contentType: false,

                        processData: false,

                        dataType: 'json',


                        // =====================================================
                        // SUCCESS
                        // =====================================================

                        success: function(respuesta) {

                            console.log(
                                "Respuesta del servidor:",
                                respuesta
                            );


                            // Volver a activar botón
                            btnGuardar.disabled = false;


                            if (respuesta == "ok") {

                                Toast.fire({
                                    icon: 'success',
                                    title: titulo_msj
                                });


                                table.ajax.reload();


                                $("#mdlGestionar_Datos").modal('hide');


                                // =================================================
                                // LIMPIAR FORMULARIO
                                // =================================================

                                $("#cod_datos").val('');

                                $("#id_piedras").val('');

                                $("#color_piedras").val('');

                                $("#tamano_piedra").val('');

                                $("#cant_piedra").val('');

                                $("#cantidad_prendas").val('');

                                $("#estilo_piedra").val('');

                                $("#fecha").val('');


                                // =================================================
                                // LIMPIAR TABLA DE COLORES
                                // =================================================

                                tablaColores.clear().draw();


                            } else {

                                Toast.fire({
                                    icon: 'error',
                                    title: 'Los datos no se pudieron registrar o ya existen'
                                });

                            }

                        },


                        // =====================================================
                        // ERROR
                        // =====================================================

                        error: function(xhr, status, error) {

                            console.error(
                                "Error AJAX:",
                                error
                            );

                            console.error(
                                "Respuesta del servidor:",
                                xhr.responseText
                            );


                            // Volver a activar botón
                            btnGuardar.disabled = false;


                            Toast.fire({
                                icon: 'error',
                                title: 'Ocurrió un error al registrar los datos'
                            });

                        }

                    });

                }

            });

        } else {

            console.log("No pasó la validación");

        }

        form.classList.add('was-validated');

    });

});
    /*EVENTO PARA PREVISUALIZAR CONTENIDO DE FACTURA EN MODAL - RAMON */
    $("#tabla_Datos tbody").on('click', 't', function() {
        var cod_datos = $(this).children().html();
     
        $("#FacturaPreview .modal-title").html('Vouche: ' + cod_datos);
if ($.fn.DataTable.isDataTable('#lstDatos')) {
    $('#lstDatos').DataTable().clear().destroy();
}

            
        $("#FacturaPreview").modal('show');
        facturas = $('#lstDatos').DataTable({
            columns: [
                        { data: "id_piedras" },
                        { data: "color_piedras" },
                        { data: "tamano_piedra" },
                        { data: "cant_piedra" },
                        { data: "cantidad_prendas" },
                        { data: "estilo_piedra" }
                    ],
            dom: 'Bfrtip',
            lengthMenu: [0, 5, 10, 15, 20, 50],
            "pageLength": 15,

            ajax: {
                url: 'ajax/datos_materiales.ajax.php',
                type: 'POST',
                dataType: 'json',
                "dataSrc": function(respuesta) {
                    // $("#factura").html(respuesta[0]['factura']);
                    // $("#proveedor").html(respuesta[0]['proveedor']);
                    // $("#razon_soc").html(respuesta[0]['razon_soc']);

                    return respuesta;

                },
                data: {
                    'accion': 7,
                    'cod_datos': cod_datos,
                },

            },

            language: {
                "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
            }
        });
    })

$('body').on('hidden.bs.modal', '#FacturaPreview', function () {

    if ($.fn.DataTable.isDataTable('#lstDatos')) {
        facturas.clear().destroy();
    }

});

/*===================================================================*/
//EVENTO QUE LIMPIA LOS MENSAJES DE ALERTA DE INGRESO DE DATOS DE CADA INPUT AL CANCELAR LA VENTANA MODAL
/*===================================================================*/
document.getElementById("btnCancelarRegistro").addEventListener("click", function() {
    $(".needs-validation").removeClass("was-validated");
})
</script>