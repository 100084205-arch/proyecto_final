<?php

require_once "conexion.php";

class PerfilModuloModelo{

    static public function mdlRegistrarPerfilModulo($array_idModulos, $idPerfil, $id_modulo_inicio){

        $total_registros = 0;

        if($idPerfil == 1){
            $stmt = Conexion::conectar()->prepare("delete from perfil_modulo where id_perfil = :id_perfil and id_modulo != 13");
        }else{
            $stmt = Conexion::conectar()->prepare("delete from perfil_modulo where id_perfil = :id_perfil");
        }

        $stmt -> bindParam(":id_perfil",$idPerfil,PDO::PARAM_INT);
        $stmt -> execute();

        foreach ($array_idModulos as $value) { 

            if($idPerfil == 1 && $value == 13){
                $total_registros = $total_registros + 0;
            }else{

                if($value == $id_modulo_inicio){
                    $vista_inicio = 1;
                }else{
                    $vista_inicio = 0;
                }

                $stmt = Conexion::conectar()->prepare("INSERT INTO perfil_modulo(id_perfil,
                                                                                id_modulo,
                                                                                vista_inicio,
                                                                                estado)
                                                                    values(:id_perfil,
                                                                            :id_modulo,
                                                                            :vista_inicio,
                                                                            1)");

                $stmt -> bindParam(":id_perfil",$idPerfil,PDO::PARAM_INT);
                $stmt -> bindParam(":id_modulo",$value,PDO::PARAM_INT);
                $stmt -> bindParam(":vista_inicio",$vista_inicio,PDO::PARAM_INT);

                if($stmt->execute()){
                    $total_registros = $total_registros + 1;
                }else{
                    $total_registros = 0;
                }

            }

        }

        return $total_registros;
    }


    static public function mdlListarPerfiles(){

        $stmt = Conexion::conectar()->prepare("SELECT * FROM perfiles");

        $stmt -> execute();

        return $stmt->fetchAll();
    }

    static public function mdlGuardarPerfiles($accion, $id_perfiles, $descripcion, $estado){

        $date = null;

        if($accion > 0){// REGISTRAR

            $date = date("Y-m-d H:i:s");
            
            $stmt = Conexion::conectar()->prepare("INSERT INTO perfiles (descripcion,estado,fecha_actualizacion) 
            VALUES(:descripcion,:estado,:fecha_actualizacion)");

            $stmt -> bindParam(":descripcion", $descripcion , PDO::PARAM_STR);
            $stmt -> bindParam(":estado", $estado , PDO::PARAM_STR);
            $stmt -> bindParam(":fecha_actualizacion",  $date , PDO::PARAM_STR);

            if($stmt -> execute()){
                $resultado = "Se registró el usuario correctamente.";
            }else{
                $resultado = "Error al registrar el usuario";
            }

        }else{// EDITAR

            $date = date("Y-m-d H:i:s");

            $stmt = Conexion::conectar()->prepare("UPDATE perfiles 
                                                      SET descripcion = :descripcion,
                                                          estado = :estado,
                                                          fecha_actualizacion = :fecha_actualizacion
                                                    WHERE id_perfil = :id_perfiles") ;

             $stmt -> bindParam(":id_perfiles", $id_perfiles , PDO::PARAM_STR);

            $stmt -> bindParam(":descripcion", $descripcion , PDO::PARAM_STR);
            $stmt -> bindParam(":estado", $estado, PDO::PARAM_STR);
            $stmt -> bindParam(":fecha_actualizacion",  $date , PDO::PARAM_STR);

            if($stmt -> execute()){
                $resultado = "Se actualizó el usuario correctamente.";
            }else{
                $resultado = "Error al actualizar el usuario";
            }
        }

        return $resultado;
        
        $stmt = null;

    }
       /*=============================================
    FUNCION PARA ELIMINAR UNA PERFIL
    =============================================*/
    static public function mdlEliminarPerfiles($table, $id, $nameId){

        $stmt = Conexion::conectar()->prepare("DELETE FROM $table WHERE $nameId = :$nameId");

        $stmt -> bindParam(":".$nameId, $id, PDO::PARAM_INT);

        if($stmt -> execute()){

            return "ok";;
        
        }else{

            return Conexion::conectar()->errorInfo();

        }

    } 
}