<?php



class LocalesControlador{


 static public function ctrListarLocales(){

$listar = LocalesModelo::mdlListarLocales();

return $listar;

}

static public function ctrRegistrarLocales( $iten_num,$descripcion, $color, $cantidad, $stock, $ubicacion, $almacen){

    $registrar = LocalesModelo::mdlRegistrarLocales( $iten_num,$descripcion, $color, $cantidad, $stock, $ubicacion, $almacen);

    return $registrar;
}

static public function ctrListarNombreLocales(){

    $listar =  LocalesModelo::mdlListarNombreLocales();

    return $listar;
}

static public function ctrDatosLocales($id_reducir){

    $listar =  LocalesModelo::mdlDatosLocales($id_reducir);

    return $listar;
}

static public function ctrVerificarStockLocales( $id_reducir, $cantidad_a_salir){

    $respuesta =  LocalesModelo::mdlVerificarStockLocales($id_reducir, $cantidad_a_salir);

    return $respuesta;
}



 static public function ctrRegistrarReducion($datos, $iptdestino){

    $registroReducion = LocalesModelo::mdlRegistrarReducion($datos, $iptdestino);

   return $registroReducion;
}


/* ======================================================================================
      OBTENER EL LISTADO PARA EL DATATABLE DE LOS ARTICULOS LOCALES
     ======================================================================================*/
     static public function ctrListarSalida(){

        $listarSalida = LocalesModelo::mdlListarSalida();
    
       return $listarSalida;
    }

    /* ======================================================================================
     REGRESAR  UN ARTICULO DE LA SALID  DE LOS ARTICULOS LOCALES
     ======================================================================================*/
     static public function ctrRetornar_Locales($id_local){

        $regresar = LocalesModelo::mdlRetornar_Locales($id_local);
    
       return $regresar;
    }
      /* ======================================================================================
       CARGA MASIVA PARA LOS ARTICULOS LOCALES
     ======================================================================================*/
    static public function ctrCargaMasivaLocales($fileLocales){
        
        $respuesta = LocalesModelo::mdlCargaMasivaLocales($fileLocales);
        
        return $respuesta;
    }
   /*===================================================================
       FUNCION PARA ACTUALIZAR UN PRODUCTO
    ====================================================================*/

 static public function ctrActualizarLocales($table, $data, $id, $nameId){

    $respuesta = LocalesModelo::mdlActualizarinformacion($table, $data, $id, $nameId);

    return $respuesta;
 }
}





