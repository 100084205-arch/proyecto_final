<?php

require_once "conexion.php";

class UsuarioModelo{

    static public function mdlIniciarSesion($usuario, $password){

        $logFile = fopen("log.txt", 'a') or die("Error creando archivo");
        fwrite($logFile, date("d/m/Y H:i:s"). '  ' . $usuario.'-'.$password."\n") or die("Error escribiendo en el archivo");
        fclose($logFile);

        $stmt = Conexion::conectar()->prepare("select *
                                                from usuarios u 
                                                inner join perfiles p
                                                on u.id_perfil_usuario = p.id_perfil
                                                inner join perfil_modulo pm
                                                on pm.id_perfil = u.id_perfil_usuario
                                                inner join modulos m
                                                on m.id = pm.id_modulo
                                                where u.usuario = :usuario and u.estado > 0
                                                and u.clave = :password
                                                and vista_inicio = 1");

        $stmt->bindParam(":usuario", $usuario, PDO::PARAM_STR);
        $stmt->bindParam(":password", $password, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt-> fetchAll(PDO::FETCH_CLASS);

    }

    static public function mdlObtenerMenuUsuario($id_usuario){

        $stmt = Conexion::conectar()->prepare("SELECT m.id,m.modulo,m.icon_menu,m.vista,pm.vista_inicio
                                                from usuarios u inner join perfiles p on u.id_perfil_usuario = p.id_perfil
                                                inner join perfil_modulo pm on pm.id_perfil = p.id_perfil
                                                inner join modulos m on m.id = pm.id_modulo
                                                where u.id_usuario = :id_usuario
                                                and (m.padre_id is null or m.padre_id = 0)
                                                order by m.orden");

        $stmt->bindParam(":id_usuario", $id_usuario, PDO::PARAM_STR);

        $stmt->execute();

	    return $stmt-> fetchAll(PDO::FETCH_CLASS);

    }

    static public function mdlObtenerSubMenuUsuario($idMenu,$id_usuario){

        $stmt = Conexion::conectar()->prepare("SELECT m.id,m.modulo,m.icon_menu,m.vista,pm.vista_inicio
                                                from usuarios u inner join perfiles p on u.id_perfil_usuario = p.id_perfil
                                                inner join perfil_modulo pm on pm.id_perfil = p.id_perfil
                                                inner join modulos m on m.id = pm.id_modulo
                                                where u.id_usuario = :id_usuario
                                                and m.padre_id = :idMenu
                                                order by m.id");
    
        $stmt->bindParam(":idMenu", $idMenu, PDO::PARAM_STR);
        $stmt->bindParam(":id_usuario", $id_usuario, PDO::PARAM_STR);
    
        $stmt->execute();
    
        return $stmt-> fetchAll(PDO::FETCH_CLASS);
        
    }

    static public function mdlListarUsuarios(){

        $stmt = Conexion::conectar()->prepare("SELECT id_usuario,
                                                       nombre_usuario,
                                                       apellido_usuario,
                                                       usuario,
                                                       p.descripcion as perfil,
                                                       u.estado,
                                                         ''opciones
                                                       FROM usuarios u LEFT JOIN perfiles p ON p.id_perfil = u.id_perfil_usuario order by id_usuario");

        $stmt -> execute();

        return $stmt -> fetChAll();

    }

        /*===================================================================
    REGISTRAR PRODUCTOS UNO A UNO DESDE EL FORMULARIO DEL USUARIO
    ====================================================================*/
    static public function mdlRegistrarUsuario($nombre_usuario, $apellido_usuario,$usuario,$clave,
    $id_perfil_usuario, $estado){        

        try{

            $fecha = date('Y-m-d');

            $stmt = Conexion::conectar()->prepare("INSERT INTO usuarios(nombre_usuario,
                                                                        apellido_usuario, 
                                                                        usuario, 
                                                                        clave,
                                                                        id_perfil_usuario, 
                                                                        estado
                                                                       ) 
                                                VALUES (:nombre_usuario, 
                                                        :apellido_usuario, 
                                                        :usuario, 
                                                        :clave, 
                                                        :id_perfil_usuario, 
                                                        :estado 
                                                        )");      
                                                        
            $stmt -> bindParam(":nombre_usuario", $nombre_usuario , PDO::PARAM_STR);
            $stmt -> bindParam(":apellido_usuario", $apellido_usuario , PDO::PARAM_STR);
            $stmt -> bindParam(":usuario", $usuario , PDO::PARAM_STR);
            $stmt -> bindParam(":clave", $clave , PDO::PARAM_STR);
            $stmt -> bindParam(":id_perfil_usuario", $estado , PDO::PARAM_STR);
            $stmt -> bindParam(":estado", $estado , PDO::PARAM_STR);
            
        
            if($stmt -> execute()){
                $resultado = "ok";
            }else{
                $resultado = "error";
            }  
        }catch (Exception $e) {
            $resultado = 'Excepción capturada: '.  $e->getMessage(). "\n";
        }
        
        return $resultado;

        $stmt = null;

    }

    
    /*=============================================
    FUNCION GENERICA PARA ACTUALIZAR INFORMACION
    =============================================*/
    static public function mdlActualizarInformacion($table, $data, $id_usuario){

        $set = "";

        foreach ($data as $key => $value) {
            
            $set .= $key." = :".$key.",";
                
        }

        $set = substr($set, 0, -1);

        $stmt = Conexion::conectar()->prepare("UPDATE $table SET $set WHERE id_usuario = :id_usuario");

        foreach ($data as $key => $value) {
            
            $stmt->bindParam(":".$key, $data[$key], PDO::PARAM_STR);
            
        }		

        $stmt->bindParam(":id_usuario", $id_usuario, PDO::PARAM_STR);

        if($stmt->execute()){

            return "ok";

        }else{

            return Conexion::conectar()->errorInfo();
        
        }
    }

      /*=============================================
    FUNCION PARA ELIMINAR UNA USUARIOS
    =============================================*/
    static public function mdlEliminarInformacion($table, $id, $nameId){

        $stmt = Conexion::conectar()->prepare("DELETE FROM $table WHERE $nameId = :$nameId");

        $stmt -> bindParam(":".$nameId, $id, PDO::PARAM_INT);

        if($stmt -> execute()){

            return "ok";;
        
        }else{

            return Conexion::conectar()->errorInfo();

        }

    }  

}