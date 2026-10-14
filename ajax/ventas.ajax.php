<?php
require_once "../controladores/ventas.controlador.php";
require_once "../modelos/ventas.modelo.php";
class AjaxVentas{   
    public function ajaxRegistrarVenta($datos,$cantidad, $iptdestino){
        $registroVenta = VentasControlador::ctrRegistrarVenta($datos,$cantidad, $iptdestino);
        echo json_encode($registroVenta,JSON_UNESCAPED_UNICODE);}
    public function ajaxRegistrarUbicacion($datos,$ubicacion, $almacen){
        $registroUbicacion = VentasControlador::ctrRegistrarUbicacion($datos,$ubicacion, $almacen);
        echo json_encode($registroUbicacion,JSON_UNESCAPED_UNICODE);}
    public function ajaxEliminarSalidad_Warehouse($pkgid){
        $eliminal = VentasControlador::ctrEliminarSalidad_Warehouse($pkgid);
        echo json_encode($eliminal,JSON_UNESCAPED_UNICODE);
    }
} 
    if((isset($_POST["arr"]))){		
		$registrar = new AjaxVentas();
		$registrar -> ajaxRegistrarVenta($_POST["arr"],$_POST['cantidad'],$_POST['iptdestino']);
	}
    else if((isset($_POST["arrr"]))){		
		$ubicacion = new AjaxVentas();
		$ubicacion -> ajaxRegistrarUbicacion($_POST["arrr"],$_POST['ubicacion'],$_POST['almacen']);      
	}else if(isset($_POST["accion"]) && $_POST["accion"] == 3 ){ //    
        $ventas = new AjaxVentas();
        $ventas -> ajaxEliminarSalidad_Warehouse($_POST["pkgid"] );    
     }
