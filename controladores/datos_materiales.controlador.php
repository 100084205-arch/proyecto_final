<?php

class Datos_materialesControlador{
 static public function ctrDatos(){
$listar = Datos_materialesmdl::mdlDatos();
return $listar;
}

static public function ctrRegistrarDatos($cod_datos,$num_datos,$fecha,$detalleColores){

    $registrar = Datos_materialesmdl::mdlRegistrarDatos($cod_datos,$num_datos,$fecha,$detalleColores);

    return $registrar;
}

 static public function ctrListarDatosMateriales(){
$listar_datos = Datos_materialesmdl::mdlListarDatosMateriales();
return $listar_datos;
}
 static public function ctrFiltrar_Datos_Materiales($cod_datos,$num_datos,$id_piedras,$color_piedras,$tamano_piedra,$estilo_piedra,$fechaDesdeFiltrar,$fechaHastaFiltrar){
$filtrar_datos = Datos_materialesmdl::mdlFiltrar_Datos_Materiales($cod_datos,$num_datos,$id_piedras,$color_piedras,$tamano_piedra,$estilo_piedra,$fechaDesdeFiltrar,$fechaHastaFiltrar);
return $filtrar_datos;
}
//ESTA ACCION ES PARA FILTRAR DESDE LA VENTaNA DE FILTROS LA POSICION DE TIPO DE PIEDRAS
static public function ctrFiltrar_TipoPiedra($cod_datos){
$filtrar_Tipos_piedras = Datos_materialesmdl::mdlFiltrar_TipoPiedra($cod_datos);
return $filtrar_Tipos_piedras;
}
//ESTA ACCION ES PARA LISTAR LOS COLORES PARA LOS INPUTS
static public function ctrListarColoresInputsMateriales(){
$listarColores_Ipunts = Datos_materialesmdl::mdlListarColoresInputsMateriales();
return $listarColores_Ipunts;
}
//ESTA ACCION ES PARA TRAER LOS DATOS PARA EL DATATABLE QUE ES EN EL MODAL
static public function ctrListarDatosMD($cod_datos){
$ListarRespuesta = Datos_materialesmdl::mdlListarDatosMD($cod_datos);
return $ListarRespuesta;
}

}
