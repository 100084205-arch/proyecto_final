<?php


class ProductosControlador{

    static public function ctrCargaMasivaProductos($fileProductos){
        
        $respuesta = ProductosModelo::mdlCargaMasivaProductos($fileProductos);
        
        return $respuesta;
    }

    static public function ctrListarProductos(){
    
        $productos = ProductosModelo::mdlListarProductos();
    
        return $productos;
    
    }

    /*===================================================================
    REGISTRAR PRODUCTOS UNO A UNO DESDE EL FORMULARIO DEL INVENTARIO
    ====================================================================*/
    
    static public function ctrRegistrarProducto($pkgid, $iten_num,$color,$cantidad,$ubicacion,$almacen){

    $registroProducto = ProductosModelo::mdlRegistrarProducto($pkgid, $iten_num,$color, $cantidad,$ubicacion,$almacen);

    return $registroProducto;

     }

    static public function ctrActualizarStock($table, $data, $id, $nameId){
        
    $respuesta = ProductosModelo::mdlActualizarInformacion($table, $data, $id, $nameId);
    
    return $respuesta;
}

     /*===================================================================
       FUNCION PARA ACTUALIZAR UN PRODUCTO
    ====================================================================*/

 static public function ctrActualizarProducto($table, $data, $id, $nameId){

    $respuesta = ProductosModelo::mdlActualizarinformacion($table, $data, $id, $nameId);

    return $respuesta;
 }
 
   /*===================================================================
    LISTAR NOMBRE DE PRODUCTOS PARA INPUT DE AUTO COMPLETADO
    ====================================================================*/
    static public function ctrListarNombreProductos($pkgid){

        $producto = ProductosModelo::mdlListarNombreProductos($pkgid);

        return $producto;
    }

     /*===================================================================
    BUSCAR PRODUCTO POR SU CODIGO DE BARRAS
    ====================================================================*/
    static public function ctrGetDatosProducto($orden){
            
        $producto = ProductosModelo::mdlGetDatosProducto($orden);

        return $producto;

    }

    static public function ctrVerificaStockProducto($pkgid, $cantidad_a_salir){

        $respuesta = ProductosModelo::mdlVerificaStockProducto($pkgid, $cantidad_a_salir);
    
        return $respuesta;
    }
     /*===================================================================
    BUSCAR LA SALIDA POR FILTRACION DEL PKGID
    ====================================================================*/
    static public function ctrBuscarSalida($pkgid){

        $respuesta = ProductosModelo::mdlBuscarSalida($pkgid);
    
        return $respuesta;
    }

    static public function ctrSinUbicacion(){
    
        $productos = ProductosModelo::mdlSinUbicacion();
    
        return $productos;
    
    }
    static public function ctrListarRangoFecha($fechaDesde,$fechaHasta){
    
        $productos = ProductosModelo::mdlListarRangoFecha($fechaDesde,$fechaHasta);
    
        return $productos;
    
    }
    /*===================================================================
    BUSCAR LA SALIDA POR FILTRACION DEL ITEN_NUM
    ====================================================================*/
    static public function ctrFiltrarIten_num($iten_num){

        $respuesta = ProductosModelo::mdlFiltrarIten_num($iten_num);
    
        return $respuesta;
    } 
       /*===================================================================
       OBTENER LISTADO TOTAL DE LOS PORDUCTOS  DE WAREHOUSE DEL DATATABLE POR EL FILTRO DEL ITEN_NUM
    ====================================================================*/
    
    static public function ctrFiltrarIten_numProductos($iten_num){

        $respuesta = ProductosModelo::mdlFiltrarIten_numProductos($iten_num);
    
        return $respuesta;
    } 
     /*===================================================================
       OBTENER LISTADO TOTAL DE LOS PORDUCTOS  DE WAREHOUSE DEL DATATABLE POR EL FILTRO DEL ITEN_NUM
    ====================================================================*/
    
    static public function ctrFiltrarUbicacionProductos($ubicacion){

        $respuesta = ProductosModelo::mdlFiltrarUbicacionProductos($ubicacion);
    
        return $respuesta;
    } 
    /*===================================================================
       OBTENER LISTADO TOTAL DE LOS PORDUCTOS  DE WAREHOUSE DEL DATATABLE POR EL FILTRO DEL ITEN_NUM
    ====================================================================*/
    
    static public function ctrFiltrarActivosProductos(){

        $respuesta = ProductosModelo::mdlFiltrarActivosProductos();
    
        return $respuesta;
    } 
     /*===================================================================
       OBTENER LISTADO TOTAL DEL NUEVO INVENTARIO
    ====================================================================*/
    
    static public function ctrNuevoInventario($fechaDesde,$fechaHasta){

        $respuesta = ProductosModelo::mdlNuevoInventario($fechaDesde,$fechaHasta);
    
        return $respuesta;
    } 
       /*===================================================================
       REGISTR0 DE NUEVO INVENTARIO JUANCARLOS
    ====================================================================*/
    
    static public function ctrRegistro_Nuevo_Inventario($pkgid){

        $respuesta = ProductosModelo::mdlRegistro_Nuevo_Inventario($pkgid);
    
        return $respuesta;
    } 
         /*===================================================================
       FILTRADO POR RANGO DE FECHA DE NUEVO INVENTARIO JUANCARLOS
    ====================================================================*/
    
    static public function ctrFiltrar_Nuevo_Inventario($pkgid){

        $respuesta = ProductosModelo::mdlFiltrar_Nuevo_Inventario($pkgid);
    
        return $respuesta;
    } 



}