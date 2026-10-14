<?php

require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

require_once "../vendor/autoload.php";

class ajaxProductos{
    public $fileProductos;
public $orden;
    public $pkgid;
    public  $iten_num;
    public $color;
    public $cantidad;
    public $ubicacion;
    public $almacen;
    public $cantidad_a_salir;

    

    public function ajaxCargaMasivaProductos(){

        $respuesta = ProductosControlador::ctrCargaMasivaProductos($this->fileProductos);

        echo json_encode($respuesta);
    }

    public function ajaxListarProductos(){
    
        $productos = ProductosControlador::ctrListarProductos();
    
        echo json_encode($productos);
    
    }

    public function ajaxRegistrarProducto(){ 

      $producto = ProductosControlador::ctrRegistrarProducto($this->pkgid, $this->iten_num,$this->color,
                                                $this->cantidad,$this->ubicacion,$this->almacen);

        echo json_encode($producto);
    }
	
    public function ajaxActualizarStock($data){

        $table = "productos";
        $id = $_POST["pkgid"];
        $nameId = "pkgid";

        $respuesta = ProductosControlador::ctrActualizarStock($table, $data, $id, $nameId);

        echo json_encode($respuesta);
    }


         /*===================================================================
       FUNCION PARA ACTUALIZAR
    ====================================================================*/
    public function  ajaxActualizarProducto($data){
        $table = "productos";
        $id = $_POST["pkgid"];
        $nameId = "pkgid";

        $respuesta = ProductosControlador::ctrActualizarProducto($table, $data, $id, $nameId);

        echo json_encode($respuesta);
    }

        /*===================================================================
       LISTAR NOMBRE DE PRODUCTOS PARA INPUT DE AUTO COMPLETADO
    ====================================================================*/
    public function ajaxListarNombreProductos($pkgid){

        $NombreProductos = ProductosControlador::ctrListarNombreProductos($pkgid);

        echo json_encode($NombreProductos);
    }

     /*===================================================================
    BUSCAR PRODUCTO POR SU CODIGO DE BARRAS
    ====================================================================*/
    public function ajaxGetDatosProducto(){
        
        $producto = ProductosControlador::ctrGetDatosProducto($this->pkgid);

        echo json_encode($producto);
    }

    /*===================================================================
    VERIFICAR EL STOCK DEL PRODUCTO
    ====================================================================*/
    public function ajaxVerificaStockProducto(){

        $respuesta = ProductosControlador::ctrVerificaStockProducto($this->pkgid,$this->cantidad_a_salir);
   
       echo json_encode($respuesta);
   }

      /*===================================================================
    BUSCAR LA SALIDA POR FILTRACION DEL PKGID
    ====================================================================*/

    public function ajaxBuscarSalida($pkgid){

        $buscar = ProductosControlador::ctrBuscarSalida($pkgid);
        echo json_encode($buscar);
      }

           /*===================================================================
    LISTAR PRODUCTO ACTIVO
    ====================================================================*/

    public function ajaxSinUbicacion(){

        $sinubicacion = ProductosControlador::ctrSinUbicacion();
        echo json_encode($sinubicacion);
      }
    /*===================================================================
    LISTAR PRODUCTO DEL DIA
    ====================================================================*/

    public function  ajaxListarRangoFecha($fechaDesde,$fechaHasta){

        $filtrar = ProductosControlador::ctrListarRangoFecha($fechaDesde,$fechaHasta);
        echo json_encode($filtrar);
      }

    /*===================================================================
    BUSCAR LA SALIDA POR FILTRACION DEL ITEN_NUM
    ====================================================================*/

    public function ajaxFiltrarIten_num($iten_num){

        $buscar = ProductosControlador::ctrFiltrarIten_num($iten_num);
        echo json_encode($buscar);
      }
   /*===================================================================
       OBTENER LISTADO TOTAL DE LOS PORDUCTOS  DE WAREHOUSE DEL DATATABLE POR EL FILTRO DEL ITEN_NUM
    ====================================================================*/
    public function ajaxFiltrarIten_numProductos($iten_num){

        $filtrarProductos = ProductosControlador::ctrFiltrarIten_numProductos($iten_num);
        echo json_encode($filtrarProductos );
      }
    /*===================================================================
       OBTENER LISTADO TOTAL DE LOS PORDUCTOS  DE WAREHOUSE DEL DATATABLE POR EL FILTRO DEL UBICACION
    ====================================================================*/
    public function ajaxFiltrarUbicacionProductos($ubicacion){

        $filtrarProductos = ProductosControlador::ctrFiltrarUbicacionProductos($ubicacion);
        echo json_encode($filtrarProductos );
      }
     /*===================================================================
       OBTENER LISTADO TOTAL DE LOS PORDUCTOS  DE WAREHOUSE DEL DATATABLE POR EL FILTRO DEL UBICACION
    ====================================================================*/
    public function ajaxFiltrarActivosProductos(){

        $filtrarActivos = ProductosControlador::ctrFiltrarActivosProductos();
        echo json_encode($filtrarActivos);
      }
      public function ajaxNuevoInventario($fechaDesde,$fechaHasta){

        $inventario_nuevo = ProductosControlador::ctrNuevoInventario($fechaDesde,$fechaHasta);
        echo json_encode($inventario_nuevo);
      }
      public function ajaxRegistro_Nuevo_Inventario(){

        $inventario_nuevo_registro = ProductosControlador::ctrRegistro_Nuevo_Inventario($this->pkgid);
        echo json_encode($inventario_nuevo_registro);
      }
      public function ajaxFiltrar_Nuevo_Inventario($pkgid){

        $inventario_nuevo_filtrar = ProductosControlador::ctrFiltrar_Nuevo_Inventario($pkgid);
        echo json_encode($inventario_nuevo_filtrar);
      }
}

if(isset($_POST["accion"]) && $_POST["accion"] == 1){ 

    $productos = new ajaxProductos();
    $productos -> ajaxListarProductos();

 } else if(isset($_POST['accion']) && $_POST['accion'] == 2){ // parametro para registrar productos

        $registrarProducto = new AjaxProductos();
        $registrarProducto -> pkgid = $_POST["pkgid"];
        $registrarProducto -> iten_num = $_POST["iten_num"];
        $registrarProducto -> color = $_POST["color"];
        $registrarProducto -> cantidad = $_POST["cantidad"];
       
        $registrarProducto ->ubicacion= $_POST["ubicacion"];
        $registrarProducto ->almacen = $_POST["almacen"];
        $registrarProducto -> ajaxRegistrarProducto();
    }

    else if(isset($_POST['accion']) && $_POST['accion'] == 4){ // parametro para actualizar productos
        
        $actualizarProducto = new ajaxProductos();


        $data = array(
            "pkgid" => $_POST["pkgid"],
            "iten_num" => $_POST["iten_num"],
            "color" => $_POST["color"],
            "cantidad" => $_POST["cantidad"],
            
            "ubicacion" => $_POST["ubicacion"],
            "almacen" => $_POST["almacen"],
            
        );

      $actualizarProducto -> ajaxActualizarProducto($data);

    }

    else if(isset($_POST['accion']) && $_POST['accion'] == 6){

        $nombreProductos = new ajaxProductos();
        $nombreProductos -> ajaxListarNombreProductos($_POST["pkgid"] );

    }else if(isset($_POST["accion"]) && $_POST["accion"] == 7){ // OBTENER DATOS DE UN PRODUCTO POR SU CODIGO

        $listaProducto = new AjaxProductos();
    
        $listaProducto -> pkgid = $_POST["pkgid"];
        
        $listaProducto -> ajaxGetDatosProducto();
        
    }else if(isset($_POST["accion"]) && $_POST["accion"] == 8){ // VERIFICAR STOCK DEL PRODUCTO

        $verificaStock = new AjaxProductos();
    
        $verificaStock -> pkgid = $_POST["pkgid"];
        $verificaStock -> cantidad_a_salir = $_POST["cantidad_a_salir"];
        
        $verificaStock -> ajaxVerificaStockProducto();
    
    }else if(isset($_POST["accion"]) && $_POST["accion"] == 9){//LISTAR LA SALIDAD DE WAREHOUSE POR FILTRAL Y POR RANGO DE FECHA

        $buscar = new ajaxProductos();      
          
        $buscar -> ajaxBuscarSalida($_POST["pkgid"]);
    
    }else if(isset($_POST["accion"]) && $_POST["accion"] == 10 ){ // BUSCAR 

        $ubicacion= new ajaxProductos();
       
        $ubicacion-> ajaxSinUbicacion(); 
        
    }else if(isset($_POST["accion"]) && $_POST["accion"] == 11 ){ // BUSCAR 

        $listar = new ajaxProductos();
       
        $listar -> ajaxListarRangoFecha($_POST["fechaDesde"],$_POST["fechaHasta"]); 
        
    }else if(isset($_POST["accion"]) && $_POST["accion"] == 12){//LISTAR LA SALIDAD DE WAREHOUSE POR FILTRAL DEL ITEN_NUM

        $filtrar = new ajaxProductos();      
          
        $filtrar -> ajaxFiltrarIten_num($_POST["iten_num"]);
    
    }else if(isset($_POST["accion"]) && $_POST["accion"] == 13){//LISTAR LOS PRODUCTOS DE WAREHOUSE POR FILTRAL DEL ITEN_NUM

        $filtrarProductos = new ajaxProductos();      
          
        $filtrarProductos  -> ajaxFiltrarIten_numProductos($_POST["iten_num"]);
    
    }else if(isset($_POST["accion"]) && $_POST["accion"] == 14){//LISTAR LOS PRODUCTOS DE WAREHOUSE POR FILTRAL DE UBICACION

        $filtrarProductos = new ajaxProductos();      
          
        $filtrarProductos  -> ajaxFiltrarUbicacionProductos($_POST["ubicacion"]);
    
    }else if(isset($_POST["accion"]) && $_POST["accion"] == 15){//LISTAR LOS PRODUCTOS DE WAREHOUSE POR FILTRAL DE ACTIVOS

        $filtrarActivos = new ajaxProductos();      
          
        $filtrarActivos  -> ajaxFiltrarActivosProductos();
    
    }else if(isset($_POST["accion"]) && $_POST["accion"] == 16){//LISTAR LOS PRODUCTOS DE WAREHOUSE POR FILTRAL DE ACTIVOS

        $nuevo_inventario = new ajaxProductos();      
          
        $nuevo_inventario  -> ajaxNuevoInventario($_POST["fechaDesde"],$_POST["fechaHasta"]);
    }else if(isset($_POST["accion"]) && $_POST["accion"] == 17){//LISTAR LOS PRODUCTOS DE WAREHOUSE POR FILTRAL DE ACTIVOS

        $registro_nuevo_inventario = new ajaxProductos();   
        $registro_nuevo_inventario -> pkgid = $_POST["pkgid"];   
          
        $registro_nuevo_inventario  -> ajaxRegistro_Nuevo_Inventario();
       
    }
    else if(isset($_POST["accion"]) && $_POST["accion"] == 18){//LISTAR LOS PRODUCTOS DE WAREHOUSE POR FILTRAL DE ACTIVOS

        $filtrar_nuevo_inventario = new ajaxProductos();  
               
        $filtrar_nuevo_inventario  -> ajaxFiltrar_Nuevo_Inventario($_POST["pkgid"]);
       
    }else if(isset($_FILES)){
    $archivo_productos = new ajaxProductos();
    $archivo_productos-> fileProductos = $_FILES['fileProductos'];
    $archivo_productos -> ajaxCargaMasivaProductos();
}