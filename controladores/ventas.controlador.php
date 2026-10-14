<?php
class VentasControlador{  
    static public function ctrRegistrarVenta($datos,$cantidad, $iptdestino){        
        $productos = VentasModelo::mdlRegistrarVenta($datos,$cantidad, $iptdestino);
        return $productos;}
    static public function ctrRegistrarUbicacion($datos,$ubicacion, $almacen){        
        $productos = VentasModelo::mdlRegistrarUbicacion($datos,$ubicacion, $almacen);
        return $productos;}
    static public function ctrEliminarSalidad_Warehouse($pkgid){        
        $eliminal = VentasModelo::mdlEliminarSalidad_Warehouse($pkgid);
        return $eliminal;}     
}