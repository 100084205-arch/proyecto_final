<?php

class DashboardControlador{

    static public function ctrGetDatosDashboard(){

        $datos = DashboardModelo::mdlGetDatosDashboard();

        return $datos;
    }

    static public function ctrGetVentasMesActual(){

        $ventasMesActual = DashboardModelo::mdlGetVentasMesActual();

        return $ventasMesActual;
    }   


    static public function ctrGetSalida_del_mesLocales(){

        $datos = DashboardModelo::mdlGetSalida_del_mesLocales();

        return $datos;
    }

    

   
} 