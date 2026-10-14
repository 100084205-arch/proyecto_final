<?php
require_once "conexion.php";

class VentasModelo{
    
    public $resultado;
  
    static public function mdlRegistrarVenta($datos,$cantidad, $iptdestino){
        session_start();

        if (!isset($_SESSION['usuario']->id_usuario) || is_null($_SESSION['usuario']->id_usuario)) {
            return "Error al registrar los datos, vuelva a intentarlo primero reiniciando el equipo y si no funciona pongase en contacto con un administrador . Fue imposible validar la sesion actual";
        }

        $id_usuario = $_SESSION['usuario']->id_usuario;



        $stmt = Conexion::conectar()->prepare("INSERT INTO venta_cabecera(cantidad, iptdestino,id_creador)         
                                                VALUES(:cantidad, :iptdestino,:id_creador)");

               $stmt -> bindParam(":cantidad", $cantidad , PDO::PARAM_STR);
               $stmt -> bindParam(":iptdestino", $iptdestino , PDO::PARAM_STR);
               $stmt -> bindParam(":id_creador", $id_usuario , PDO::PARAM_STR);                 
                   
        
            if($stmt -> execute()){
                $listaProductos = [];
                for ($i = 0; $i < count($datos); ++$i){                    
                    $listaProductos = explode(",",$datos[$i]);        
                    $stmt = Conexion::conectar()->prepare("INSERT INTO venta_detalle(pkgid, iten_num, color, cantidad, iptdestino, creador) 
                                                        VALUES(:pkgid, :iten_num, :color, :cantidad, :iptdestino, :creador )");        
                    $stmt -> bindParam(":pkgid", $listaProductos[0] , PDO::PARAM_STR);
                    $stmt -> bindParam(":iten_num", $listaProductos[1] , PDO::PARAM_STR);
                    $stmt -> bindParam(":color", $listaProductos[2] , PDO::PARAM_STR);
                    $stmt -> bindParam(":cantidad", $listaProductos[3] , PDO::PARAM_STR);
                    $stmt -> bindParam(":iptdestino", $iptdestino , PDO::PARAM_STR);
                    $stmt -> bindParam(":creador", $id_usuario , PDO::PARAM_STR);                
                    
                    if($stmt -> execute()){
                        $stmt = null;        
                        $stmt = Conexion::conectar()->prepare("UPDATE PRODUCTOS SET cantidad= cantidad- :cantidad WHERE pkgid = :pkgid" );        
                        $stmt -> bindParam(":pkgid", $listaProductos[0] , PDO::PARAM_STR);
                        $stmt -> bindParam(":cantidad", $listaProductos[3] , PDO::PARAM_STR);                                 
                        
                        if($stmt -> execute()){
                            $resultado = "Se registró correctamente.";
                        }else{
                            $resultado = "Error al actualizar el stock";
                        }                        
                    }else{
                        $resultado = "Error al registrar ";
                    }                
                }               
                 return $resultado;        
                 $stmt = null;                       
        }       
    }
    static public function mdlRegistrarUbicacion($datos,$ubicacion, $almacen){                              
                $listaProductos = [];
                for ($i = 0; $i < count($datos); ++$i){                    
                    $listaProductos = explode(",",$datos[$i]);        
                    $stmt = Conexion::conectar()->prepare("UPDATE PRODUCTOS SET ubicacion = :ubicacion, almacen = :almacen WHERE pkgid = :pkgid");        
                    $stmt -> bindParam(":pkgid", $listaProductos[0] , PDO::PARAM_STR);                    
                    $stmt -> bindParam(":ubicacion", $ubicacion , PDO::PARAM_STR);
                    $stmt -> bindParam(":almacen", $almacen , PDO::PARAM_STR);                          
                                                                                                       
                        if($stmt -> execute()){
                            $resultado = "Se actualizo";
                        }else{
                            $resultado = "Error al actualizar ";
                        }                      
                            
                }       
                return $resultado;        
                 $stmt = null;         
                }
    static public function mdlEliminarSalidad_Warehouse($pkgid){
        $stmt = Conexion::conectar()->prepare("call prc_regresar_salidad_warehouse(:pkgid)");
        $stmt -> bindParam(":pkgid", $pkgid , PDO::PARAM_STR);

        $stmt -> execute();

        return $stmt->fetch();
    }

   
}