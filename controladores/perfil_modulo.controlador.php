<?php

class PerfilModuloControlador{


    static public function ctrRegistrarPerfilModulo($array_idModulos, $idPerfil, $id_modulo_inicio){

        $registroPerfilModulo = PerfilModuloModelo::mdlRegistrarPerfilModulo($array_idModulos, $idPerfil, $id_modulo_inicio);

        return $registroPerfilModulo;
    }


    static public function ctrListarPerfiles(){
        
        $Perfiles = PerfilModuloModelo::mdlListarPerfiles();

        return $Perfiles;
  
    }

    static public function ctrGuardarPerfiles($accion, $id_perfiles, $descripcion, $estado){

        $guardarPerfiles = PerfilModuloModelo::mdlGuardarPerfiles($accion, $id_perfiles, $descripcion, $estado);

        return $guardarPerfiles;
    }

    static public function ctrEliminarPerfiles($table, $id, $nameId){

        $EliminarPerfiles = PerfilModuloModelo::mdlEliminarPerfiles($table, $id, $nameId);

        return $EliminarPerfiles;
    }
}