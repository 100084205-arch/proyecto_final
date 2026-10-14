<?php

require_once "../controladores/perfil_modulo.controlador.php";
require_once "../modelos/perfil_modulo.modelo.php";

class AjaxPerfilModulo{
    public $id_Perfiles;
   public  $perfil;
   public $estado;

    public function ajaxRegistrarPerfilModulo($array_idModulos, $idPerfil, $id_modulo_inicio){

        $registroPerfilModulo = PerfilModuloControlador::ctrRegistrarPerfilModulo($array_idModulos, $idPerfil, $id_modulo_inicio);

        echo json_encode($registroPerfilModulo);
    }

    public function ajaxListarPerfiles(){

        $Perfiles = PerfilModuloControlador::ctrListarPerfiles();

        echo json_encode($Perfiles, JSON_UNESCAPED_UNICODE);
    }
 
    public function ajaxGuardarPerfiles($accion){

        $guardarPerfiles = PerfilModuloControlador::ctrGuardarPerfiles($accion, $this->id_perfiles, $this->descripcion, $this->estado);

        echo json_encode($guardarPerfiles, JSON_UNESCAPED_UNICODE);
   }

   public function ajaxEliminarPerfiles(){

    $table = "perfiles"; 
    $id = $_POST["id_perfil"]; 
    $nameId = "id_perfil";

    $respuesta = PerfilModuloControlador::ctrEliminarPerfiles($table, $id, $nameId);

    echo json_encode($respuesta);
}

}

if(isset($_POST['id_perfiles']) && $_POST['id_perfiles'] > 0){ //EDITAR

    $editarPerfiles = new AjaxPerfilModulo();
    $editarPerfiles->id_perfiles = $_POST['id_perfiles'];
    $editarPerfiles->descripcion = $_POST['descripcion'];
    $editarPerfiles->estado = $_POST['estado'];
    $editarPerfiles->ajaxGuardarPerfiles(0);

}else if(isset($_POST['id_perfiles']) && $_POST['id_perfiles'] == 0){ //REGISTRAR

    $registrarPerfiles = new AjaxPerfilModulo();
    $registrarPerfiles->id_perfiles = $_POST['id_perfiles'];
    $registrarPerfiles->descripcion = $_POST['descripcion'];
    $registrarPerfiles->estado = $_POST['estado'];
    $registrarPerfiles->ajaxGuardarPerfiles(1);

}else if(isset($_POST['accion']) && $_POST['accion'] == 1){ //

    $registroPerfilModulo = new AjaxPerfilModulo;    
    $registroPerfilModulo->ajaxRegistrarPerfilModulo($_POST['id_modulosSeleccionados'],$_POST['id_Perfil'], $_POST['id_modulo_inicio']);

}else if(isset($_POST['accion']) && $_POST['accion'] == 2){ //PARA ELIMAR UN PERFIL

    $eliminarperfiles = new ajaxPerfilModulo();
    $eliminarperfiles -> ajaxEliminarPerfiles();

}else{

    $listaPerfiles = new  AjaxPerfilModulo();
    $listaPerfiles -> ajaxListarPerfiles();
}