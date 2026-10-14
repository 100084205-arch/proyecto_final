<?php

require_once "../controladores/usuario.controlador.php";
require_once "../modelos/usuario.modelo.php";

class AjaxUsuario{
  
public $nombre_usuario;
public $apellido_usuario;
public $usuario;
public $clave;
public $id_perfil_usuario;
public $estado;
public $id_usuario;

    public function ajaxListarUsuarios(){

        $listar = UsuarioControlador::ctrListarUsuarios();

        echo json_encode($listar,JSON_UNESCAPED_UNICODE);
    }
    
    public function ajaxRegistrarUsuario(){

        $registrar = UsuarioControlador:: ctrRegistrarUsuario($this->nombre_usuario, $this->apellido_usuario,$this->usuario,$this->clave,
        $this->id_perfil_usuario, $this->estado);

        echo json_encode($registrar,JSON_UNESCAPED_UNICODE);
    }
    
    public function ajaxActualizarUsuario($data, $id_usuario){
        $respuesta = UsuarioControlador::ctrActualizarUsuario("usuarios", $data, $id_usuario);

        echo json_encode($respuesta);
    }
    public function ajaxEliminarUsuario(){
        $table = "usuarios"; 
        $id = $_POST["id_usuario"]; 
        $nameId = "id_usuario";

        $respuesta = UsuarioControlador::ctrEliminarUsuario($table, $id, $nameId);

        echo json_encode($respuesta);
    }
}


 if(isset($_POST['accion']) && $_POST['accion'] == 1){ // parametro para registrar usuarios

    $registrarUsuario = new AjaxUsuario();
    $registrarUsuario -> nombre_usuario = $_POST["nombre_usuario"];
    $registrarUsuario -> apellido_usuario = $_POST["apellido_usuario"];
    $registrarUsuario -> usuario = $_POST["usuario"];
    $registrarUsuario -> clave = $_POST["clave"];// hash('sha512',
    $registrarUsuario -> estado = $_POST["estado"];
   
    $registrarUsuario -> ajaxRegistrarUsuario();
    
}
else if(isset($_POST['accion']) && $_POST['accion'] == 2){ // accion para editar  usuarios
    $actualizarUsuario = new ajaxUsuario();
    $data = array(
        "nombre_usuario" => $_POST["nombre_usuario"],
        "apellido_usuario" => $_POST["apellido_usuario"],
        "usuario" => $_POST["usuario"],
        "clave" => $_POST["clave"],// hash('sha512',
        "id_perfil_usuario" => $_POST["perfil"],
        "estado" => $_POST["estado"],
    );

    $actualizarUsuario -> ajaxActualizarUsuario($data, $_POST["id_usuario"]);
    
}else if(isset($_POST['accion']) && $_POST['accion'] == 3){ // accion para eliminar  usuarios
    $eliminarUsuario = new ajaxUsuario();
    $eliminarUsuario -> ajaxEliminarUsuario();
    
}
else{
    $usuario = new AjaxUsuario();    //accion para listar el usuario
    $usuario -> ajaxListarUsuarios();
}

