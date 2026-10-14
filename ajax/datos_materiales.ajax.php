<?php
require_once "../controladores/datos_materiales.controlador.php";
require_once "../modelos/datos_materiales.modelo.php";
class ajaxDatos_materiales{
    
    
    public $cod_datos;
    public $num_datos;
    public $id_piedras;
    public $color_piedras;
    public $tamano_piedra;
    public $cant_piedra;
    public $cantidad_prendas;
    public $estilo_piedra;  
    public $fecha;

    //esta funcion es para traer el listado de datos desde la base de datos para los inputs del formulario de  datos_materiales
    public function ajaxDatos(){
    $listar = Datos_materialesControlador::ctrDatos();
    echo json_encode($listar);
    }

    //esta funcion es para registrar los datos desde los inputs del formulario de  datos_materiales
    public function ajaxRegistrarDatos($cod_datos,$num_datos,$fecha,$detalleColores){
    $registrar = Datos_materialesControlador::ctrRegistrarDatos($cod_datos,$num_datos,$fecha,$detalleColores);

    echo json_encode($registrar);
 }
   //esta funcion es para traer el listado de datos desde la base de datos para la tabla de datos_materiales
    public function ajaxListarDatosMateriales(){
    $listar_datos = Datos_materialesControlador::ctrListarDatosMateriales();
    echo json_encode($listar_datos);
    }
       public function ajaxFiltrar_Datos_Materiales($cod_datos,$num_datos,$id_piedras,$color_piedras,$tamano_piedra,$estilo_piedra,$fechaDesdeFiltrar,$fechaHastaFiltrar){
        $inventario_nuevo_filtrar = Datos_materialesControlador::ctrFiltrar_Datos_Materiales($cod_datos,$num_datos,$id_piedras,$color_piedras,$tamano_piedra,$estilo_piedra,$fechaDesdeFiltrar,$fechaHastaFiltrar);
        echo json_encode($inventario_nuevo_filtrar);
      }

      //ESTA ACCION ES PARA FILTRAR DESDE LA VENTaNA DE FILTROS LA POSICION DE TIPO DE PIEDRAS
      public function ajaxFiltrar_TipoPiedra($cod_datos){
        $inventario_nuevo_filtrar = Datos_materialesControlador::ctrFiltrar_TipoPiedra($cod_datos);
        echo json_encode($inventario_nuevo_filtrar);
      }
      //ESTA ACCION ES PARA LISTAR LOS COLORES PARA LOS INPUTS
      public function ajaxListarColoresInputsMateriales(){
        $coloresInputs = Datos_materialesControlador::ctrListarColoresInputsMateriales();
        echo json_encode($coloresInputs);
      }
      //ESTA ACCION ES PARA TRAER LOS DATOS PARA EL DATATABLE QUE ES EN EL MODAL
      public function ajaxListarDatosMD($cod_datos){
        $ListarRespuesta = Datos_materialesControlador::ctrListarDatosMD($cod_datos);
        echo json_encode($ListarRespuesta);
      }
}if(isset($_POST["accion"]) && $_POST["accion"] == 1 ){ // LISTAR A LOS datos_materiales
    $listar = new ajaxDatos_materiales();
    $listar -> ajaxDatos();

}else if(isset($_POST["accion"]) && $_POST["accion"] == 2 ){ //REGISTRAR LOS DATOS

    $registrarDatos = new ajaxDatos_materiales();
 $registrarDatos ->  ajaxRegistrarDatos($_POST["cod_datos"],$_POST["num_datos"],$_POST["fecha"],$_POST["detalleColores"]);

}else if(isset($_POST["accion"]) && $_POST["accion"] == 3 ){ // LISTAR A LOS PARA LA TABLA DE datos_materiales
    $listar = new ajaxDatos_materiales();
    $listar -> ajaxListarDatosMateriales();

}
 else if(isset($_POST["accion"]) && $_POST["accion"] == 4){//ESTA ACCION ES PARA FILTRAR DESDE LA VENTaNA DE FILTROS

        $Filtrar_Datos_Materiales = new ajaxDatos_materiales();  
        $Filtrar_Datos_Materiales  -> ajaxFiltrar_Datos_Materiales($_POST["cod_datos"],$_POST["num_datos"],$_POST["id_piedras"],$_POST["color_piedras"],$_POST["tamano_piedra"],$_POST["estilo_piedra"],$_POST["fechaDesdeFiltrar"],$_POST["fechaHastaFiltrar"]);
       
    }
     else if(isset($_POST["accion"]) && $_POST["accion"] == 5){//ESTA ACCION ES PARA FILTRAR DESDE LA VENTaNA DE FILTROS LA POSICION DE TIPO DE PIEDRAS

        $Filtrar_TipoPiedra = new ajaxDatos_materiales();  
        $Filtrar_TipoPiedra   -> ajaxFiltrar_TipoPiedra ($_POST["cod_datos"]);
       
    }
    else if(isset($_POST["accion"]) && $_POST["accion"] == 6){ // LISTAR LOS COLORES PARA LOS INPUTS
    $listarInputs_materiales = new ajaxDatos_materiales();
    $listarInputs_materiales -> ajaxListarColoresInputsMateriales();

}else if(isset($_POST["accion"]) && $_POST["accion"] == 7){//ESTA ACCION 7 ES PARA TRAER LOS DATOS PARA EL DATATABLE QUE ES EN EL MODAL

        $listarDatosMD = new ajaxDatos_materiales();  
        $listarDatosMD   -> ajaxListarDatosMD($_POST["cod_datos"]);
       
    }