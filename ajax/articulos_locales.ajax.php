<?php

require_once "../controladores/articulos_locales.controlador.php";
require_once "../modelos/articulos_locales.modelo.php";
require_once "../vendor/autoload.php";

class ajaxLocales{

    public $fileProductos;
   public  $id;
    public $id_reducir;
    public $iten_num;
    public $color;
    public $descripcion;
    public $cantidad;
    public $stock;
    public $ubicacion;
    public $almacen;
    public $cantidad_a_salir;
    public $fileLocales;


    public function ajaxListarLocales(){
    $listar = LocalesControlador::ctrListarLocales();
    echo json_encode($listar);

   }


 public function ajaxRegistrarLocales(){

    $registrar = LocalesControlador::ctrRegistrarLocales($this->iten_num,$this->descripcion,$this->color,$this->cantidad,$this->stock,$this->ubicacion,$this->almacen);

    echo json_encode($registrar);
 }


   /* ======================================================================================
    REDUCIR ARTICULOS LOCALES 
     ======================================================================================*/
      public function ajaxListarNombreLocales(){
          $nombrelocales = LocalesControlador::ctrListarNombreLocales();

          echo json_encode( $nombrelocales);
      }


   /* ======================================================================================
      OBTENER DATOS DE UN PRODUCTO  LOCAL POR  SU CODIGO
     ======================================================================================*/
     public function ajaxDatosLocales(){
        $listarLocales = LocalesControlador::ctrDatosLocales($this-> id_reducir);

        echo json_encode( $listarLocales);
    }


   /* ======================================================================================
      VERIFICAR EL STOCK
     ======================================================================================*/
     public function ajaxVerificarStockLocales(){
        $stockLocales = LocalesControlador::ctrVerificarStockLocales($this-> id_reducir, $this->cantidad_a_salir);

        echo json_encode( $stockLocales);
    }


   /* ======================================================================================
      REGISTRO DE LA REDUCION DE LOS ARTICULOS LOCALES
     ======================================================================================*/
    public function ajaxRegistrarReducion($datos, $iptdestino){

        $registroReducion = LocalesControlador::ctrRegistrarReducion($datos, $iptdestino);

        echo json_encode($registroReducion);

    }

     /* ======================================================================================
      OBTENER EL LISTADO PARA EL DATATABLE DE LOS ARTICULOS LOCALES
     ======================================================================================*/
    public function ajaxListarSalida(){
    $listar = LocalesControlador::ctrListarSalida();

    echo json_encode($listar);
    }

       /* ======================================================================================
      RETORNAR  UN ARTICULO DE LA SALIDA DE LOS  ARTICULOS LOCALES
     ======================================================================================*/
     public function ajaxRetornar_Locales($id_local){
        $retornar = LocalesControlador::ctrRetornar_Locales($id_local);
    
        echo json_encode($retornar);
        }
    /* ======================================================================================
     CARGA MASIVA PARA LOS ARTICULOS LOCALES
     ======================================================================================*/
     public function ajaxCargaMasivaLocales(){

     $respuesta = LocalesControlador::ctrCargaMasivaLocales($this->fileLocales);
    
     echo json_encode($respuesta);
        }
     /*===================================================================
       FUNCION PARA ACTUALIZAR Locales
    ====================================================================*/
    public function  ajaxActualizarLocales($data){
        $table = "articulos_locales";
        $id = $_POST["iten_num"];
        $nameId = "iten_num";

        $respuesta = LocalesControlador::ctrActualizarLocales($table, $data, $id, $nameId);

        echo json_encode($respuesta);
    }



}


if(isset($_POST["accion"]) && $_POST["accion"] == 1 ){ // LISTAR A LOS ARTICULOS LOCALES

    $listar = new ajaxLocales();
    $listar -> ajaxListarLocales();


}else if(isset($_POST["accion"]) && $_POST["accion"] == 2 ){ //REGISTRAR LOS ARTICULOS LOCALES

    $registrarLocales = new ajaxLocales();

 
 $registrarLocales -> iten_num = $_POST["iten_num"];
 $registrarLocales -> descripcion = $_POST["descripcion"];
 $registrarLocales -> color = $_POST["color"];
 $registrarLocales -> cantidad = $_POST["cantidad"];
 $registrarLocales -> stock = $_POST["stock"];
 $registrarLocales -> ubicacion = $_POST["ubicacion"];
 $registrarLocales -> almacen = $_POST["almacen"];
 
 $registrarLocales ->  ajaxRegistrarLocales();

}else if(isset($_POST["accion"]) && $_POST["accion"] == 3 ){ //REDUCIR ARTICULOS  LOCALES
    
$nombreLocales = new ajaxLocales();
$nombreLocales -> ajaxListarNombreLocales();

}else if(isset($_POST["accion"]) && $_POST["accion"] == 4 ){ // OBTENER DATOS DE UN PRODUCTO  LOCAL POR  SU CODIGO

    $listarLocales = new ajaxLocales();
    $listarLocales ->  id_reducir= $_POST["id_reducir"];
    $listarLocales -> ajaxDatosLocales();

 }else if(isset($_POST["accion"]) && $_POST["accion"] == 5 ){ // AUMENTAR LA CANTIDAD DE UN PRODUCTO EN EL DATATABLE

    $verificarStock = new ajaxLocales();
    $verificarStock ->  id_reducir = $_POST["id_reducir"];
    $verificarStock ->  cantidad_a_salir = $_POST["cantidad_a_salir"];
    $verificarStock -> ajaxVerificarStockLocales();

    } else if((isset($_POST["arr"]))){ // DATOS PARA REGISTAR LA REDUCION DEL DATATABLE DE REDUCION
		
		$registrar_reducion = new ajaxLocales();
		$registrar_reducion -> ajaxRegistrarReducion($_POST["arr"], $_POST['iptdestino']);


	}else if(isset($_POST["accion"]) && $_POST["accion"] == 6 ){ //LISTAR LA SALIDA DE LA TABLA DE REDUCION

    $listarSalida = new ajaxLocales();
    $listarSalida -> ajaxListarSalida();

}else if(isset($_POST["accion"]) && $_POST["accion"] == 7 ){ //RETORNAR UN PRODUCTO DE LA SALIDA DE LOS ARTICULOS LOCALES

    $retornar = new ajaxLocales();
    $retornar -> ajaxRetornar_Locales($_POST["id_local"]);
}else if(isset($_POST['accion']) && $_POST['accion'] == 8){ // parametro para actualizar articulos locales
        
    $actualizarLocales = new ajaxLocales();


    $data = array(
        "iten_num" => $_POST["iten_num"],
        "descripcion" => $_POST["descripcion"],
        "color" => $_POST["color"],
        "cantidad" => $_POST["cantidad"],
        "stock" => $_POST["stock"],        
        "ubicacion" => $_POST["ubicacion"],
        "almacen" => $_POST["almacen"],
        
    );

  $actualizarLocales -> ajaxActualizarLocales($data);

}else if(isset($_FILES)){
    $archivo_productos = new ajaxLocales();
    $archivo_productos-> fileLocales = $_FILES['fileLocales'];
    $archivo_productos -> ajaxCargaMasivaLocales();
}