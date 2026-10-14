
<?php

class UsuarioControlador{

    /* 
    Validar el acceso del usuario
    */
    public function login(){

        if(isset($_POST["loginUsuario"])){

            $usuario = $_POST["loginUsuario"];
           // $password =  $_POST["loginPassword"];
           $password = $_POST["loginPassword"];

            $respuesta = UsuarioModelo::mdlIniciarSesion($usuario, $password);

            if(count($respuesta) > 0){

                $_SESSION["usuario"] = $respuesta[0];

                echo '
                    <script>
                        window.location = "http://172.30.3.105/Approval/";
                    </script>
                
                ';
            }else{

                echo '
                    <script>
                        fncSweetAlert("error","Usuario y/o password inválido","http://172.30.3.105/Approval/");
                    </script>
                
                ';
            }

        }
    }

    static public function ctrObtenerMenuUsuario($id_usuario){

        $menuUsuario = UsuarioModelo::mdlObtenerMenuUsuario($id_usuario);

        return $menuUsuario;
    }

    static public function ctrObtenerSubMenuUsuario($idMenu,$id_perfil_usuario){

        $subMenuUsuario = UsuarioModelo::mdlObtenerSubMenuUsuario($idMenu, $id_perfil_usuario);
        
        return $subMenuUsuario ;
    
    }
    static public function ctrListarUsuarios(){

        $listar = UsuarioModelo::mdlListarUsuarios();
        
        return $listar;
     }

     static public function ctrRegistrarUsuario($nombre_usuario, $apellido_usuario,$usuario,$clave,
    $id_perfil_usuario, $estado){

        $registrarUsuario= UsuarioModelo::mdlRegistrarUsuario($nombre_usuario, $apellido_usuario,$usuario,$clave,
        $id_perfil_usuario, $estado);
        
        return $registrarUsuario;
     }

     static public function ctrActualizarUsuario($table, $data, $id_usuario){
        
        $respuesta = UsuarioModelo::mdlActualizarInformacion($table, $data, $id_usuario);
        
        return $respuesta;
    }

    static public function ctrEliminarUsuario($table, $id, $nameId){
        
        $respuesta = UsuarioModelo::mdlEliminarInformacion($table, $id, $nameId);
        
        return $respuesta;
    }

}

    

