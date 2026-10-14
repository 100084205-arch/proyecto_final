<?php

require_once "../controladores/dashboard.controlador.php";
require_once "../modelos/dashboard.modelo.php";

class AjaxDashboard{

    public function getDatosDashboard(){

        $datos = DashboardControlador::ctrGetDatosDashboard();

        echo json_encode($datos);
    }

    public function getVentasMesActual(){
        $ventasMesActual = DashboardControlador::ctrGetVentasMesActual();
        echo json_encode($ventasMesActual);
    }   
  

    public function  getSalida_del_mesLocales(){

        $datos = DashboardControlador::ctrgetSalida_del_mesLocales();

        echo json_encode($datos);
    }
  
    
  
}


if(isset($_POST['accion']) && $_POST['accion'] == 1){ //Ejecutar function ventas del mes (Grafico de Barras)

    $ventasMesActual = new AjaxDashboard();
    $ventasMesActual -> getVentasMesActual();

}else if(isset($_POST['accion']) && $_POST['accion'] == 3){
    $salida_del_mes = new AjaxDashboard();
    $salida_del_mes ->  getSalida_del_mesLocales();
   
   }

else{
    $datos = new AjaxDashboard();
    $datos -> getDatosDashboard();
}