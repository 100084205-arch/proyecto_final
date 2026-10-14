<?php
  session_start();
require_once "conexion.php";
use PhpOffice\PhpSpreadsheet\IOFactory;
class Datos_materialesmdl{
/*===================================================================
     LISTAR LOS DATOS PARA LOS INPUTS DEL FORMULARIO Y PARA LOS FILTROS
      ====================================================================*/
    static public function mdlDatos(){
    $stmt = Conexion::conectar() -> prepare("SELECT dtp.id_piedras, dtp.tipo_piedras FROM  datos_tipo_piedras dtp");

    $stmt ->execute();
    
    return $stmt->fetchAll();

}


 /*===================================================================
    FUNCION PARA REGISTRAR LOS PRODUCTOS DE LOS ARTICULOS LOCALES
  ====================================================================*/
 static function mdlRegistrarDatos( $cod_datos,$num_datos,$fecha,$detalleColores){     
     if (!isset($_SESSION['usuario']->id_usuario) || is_null($_SESSION['usuario']->id_usuario)) {
            return "Error al registrar los datos, vuelva a intentarlo primero reiniciando el equipo y si no funciona pongase en contacto con un administrador . Fue imposible validar la sesion actual";
        }
        $id_usuario = $_SESSION['usuario']->id_usuario;
        $fecha_creado = date('Y-m-d');
         $cn = Conexion::conectar();

    try {

        // Iniciar transacción
        $cn->beginTransaction();

        // INSERT CABECERA
        $stmt = $cn->prepare("INSERT INTO datos_materiales(cod_datos,num_datos,creador,fecha,fecha_creado) 
                                                                    VALUES (:cod_datos,:num_datos,:creador,:fecha,:fecha_creado)");

        $stmt -> bindParam(":cod_datos",$cod_datos, PDO::PARAM_STR);
        $stmt -> bindParam(":num_datos",$num_datos, PDO::PARAM_STR);
        $stmt -> bindParam(":creador",$id_usuario , PDO::PARAM_STR);
        $stmt -> bindParam(":fecha",$fecha, PDO::PARAM_STR);
        $stmt -> bindParam(":fecha_creado",$fecha_creado, PDO::PARAM_STR);

        if (!$stmt->execute()) {
            throw new Exception("Error al registrar la cabecera");
        }

        // Obtener el id generado
        $id_datos_materiales = $cn->lastInsertId();

        // Convertir JSON
        $detalleColores = json_decode($detalleColores, true);

        // Recorrer detalles
        foreach ($detalleColores as $detalle) {

            $stmtDetalle = $cn->prepare("INSERT INTO datos_materiales_detalle(cod_datos,id_datos_materiales,id_piedras,color_piedras,tamano_piedra,cant_piedra,cantidad_prendas,estilo_piedra) VALUES (:cod_datos,:id_datos_materiales,:id_piedras,:color_piedras,:tamano_piedra,:cant_piedra,:cantidad_prendas,:estilo_piedra)");
                $stmtDetalle -> bindParam(":cod_datos",$cod_datos, PDO::PARAM_STR);
                $stmtDetalle -> bindParam(":id_datos_materiales",$id_datos_materiales, PDO::PARAM_STR);
                $stmtDetalle -> bindParam(":id_piedras",$detalle["id_piedras"], PDO::PARAM_STR);
                $stmtDetalle -> bindParam(":color_piedras",$detalle["color_piedras"], PDO::PARAM_STR);
                $stmtDetalle -> bindParam(":tamano_piedra",$detalle["tamano_piedra"], PDO::PARAM_STR);
                $stmtDetalle -> bindParam(":cant_piedra",$detalle["cant_piedra"], PDO::PARAM_STR);
                $stmtDetalle -> bindParam(":cantidad_prendas",$detalle["cantidad_prendas"], PDO::PARAM_STR);
                 $stmtDetalle -> bindParam(":estilo_piedra",$detalle["estilo_piedra"], PDO::PARAM_STR);

            if (!$stmtDetalle->execute()) {
                throw new Exception("Error al registrar el detalle");
            }

        }

        // Si todo salió bien
        $cn->commit();

        return "ok";

    } catch (Exception $e) {

        // Si hubo algún error, deshacer todo
        $cn->rollBack();

        return $e->getMessage();

    }


            
 }
 /*===================================================================
     LISTAR LOS DATOS PARA LA TABLA DE DATOS MATERIALES
      ====================================================================*/
    static public function mdlListarDatosMateriales(){
    $stmt = Conexion::conectar() -> prepare("SELECT dm.cod_datos, dm.num_datos, dtp.tipo_piedras, dmd.color_piedras, dmd.tamano_piedra, dmd.cant_piedra, dmd.cantidad_prendas, (dmd.cant_piedra * dmd.cantidad_prendas) AS total_piedra, dmd.estilo_piedra, ( SELECT CONCAT(u.nombre_usuario, ' ', u.apellido_usuario) FROM usuarios u WHERE u.id_usuario = dm.creador ) AS creador, DATE_FORMAT(dm.fecha, '%m-%d-%Y') AS fecha, dm.fecha_creado FROM datos_materiales dm JOIN datos_materiales_detalle dmd ON dm.id = dmd.id_datos_materiales JOIN datos_tipo_piedras dtp ON dtp.id_piedras = dmd.id_piedras");
    $stmt ->execute();    
    return $stmt->fetchAll();
}
/*===================================================================
FILTRAR LOS DATOS PARA LA VENTANA DE FILTRADO
====================================================================*/
static public function mdlFiltrar_Datos_Materiales(
    $cod_datos,
    $num_datos,
    $id_piedras,
    $color_piedras,
    $tamano_piedra,
    $estilo_piedra,
    $fechaDesdeFiltrar,
    $fechaHastaFiltrar
) {

    $sql = "SELECT
        dm.cod_datos,
        dm.num_datos,
        dtp.tipo_piedras,
        dmd.color_piedras,
        dmd.tamano_piedra,
        dmd.cant_piedra,
        dmd.cantidad_prendas,
        (dmd.cant_piedra * dmd.cantidad_prendas) AS total_piedra,
        dmd.estilo_piedra,
        CONCAT(u.nombre_usuario, ' ', u.apellido_usuario) AS creador,
        DATE_FORMAT(dm.fecha, '%m-%d-%Y') AS fecha,
        dm.fecha_creado

    FROM datos_materiales dm

    INNER JOIN datos_materiales_detalle dmd
        ON dm.id = dmd.id_datos_materiales

    INNER JOIN datos_tipo_piedras dtp
        ON dtp.id_piedras = dmd.id_piedras

    INNER JOIN usuarios u
        ON u.id_usuario = dm.creador

    WHERE 1=1 ";

    $params = [];

    if ($cod_datos !== null && $cod_datos !== '') {
        $sql .= " AND dm.cod_datos = :cod_datos";
        $params[':cod_datos'] = $cod_datos;
    }

    if ($num_datos !== null && $num_datos !== '') {
        $sql .= " AND dm.num_datos = :num_datos";
        $params[':num_datos'] = $num_datos;
    }

    if ($id_piedras !== null && $id_piedras !== '') {
        $sql .= " AND dtp.id_piedras = :id_piedras";
        $params[':id_piedras'] = $id_piedras;
    }

    if ($color_piedras !== null && $color_piedras !== '') {
        $sql .= " AND dmd.color_piedras = :color_piedras";
        $params[':color_piedras'] = $color_piedras;
    }

    if ($tamano_piedra !== null && $tamano_piedra !== '') {
        $sql .= " AND dmd.tamano_piedra = :tamano_piedra";
        $params[':tamano_piedra'] = $tamano_piedra;
    }

    if ($estilo_piedra !== null && $estilo_piedra !== '') {
        $sql .= " AND dmd.estilo_piedra = :estilo_piedra";
        $params[':estilo_piedra'] = $estilo_piedra;
    }

    /* FILTRO POR RANGO DE FECHA */
    if (
        $fechaDesdeFiltrar !== null &&
        $fechaDesdeFiltrar !== '' &&
        $fechaHastaFiltrar !== null &&
        $fechaHastaFiltrar !== ''
    ) {
        $sql .= " AND DATE(dm.fecha) BETWEEN :fechaDesde AND :fechaHasta";

        $params[':fechaDesde'] = $fechaDesdeFiltrar;
        $params[':fechaHasta'] = $fechaHastaFiltrar;
    }

    $stmt = Conexion::conectar()->prepare($sql);
    $stmt->execute($params);

    return $stmt->fetchAll(PDO::FETCH_NUM);
}
/*===================================================================
     LISTAR LOS DATOS PARA LOS INPUTS DEL FORMULARIO Y PARA LOS FILTROS
      ====================================================================*/
    static public function mdlFiltrar_TipoPiedra($cod_datos){
    $stmt = Conexion::conectar() -> prepare("SELECT tamano_piedras FROM datos_tamano_piedra dtp WHERE id_piedras = :cod_datos");
     $stmt -> bindParam(":cod_datos",$cod_datos, PDO::PARAM_STR);

    $stmt ->execute();
    
    return $stmt->fetchAll();

}
/*===================================================================
     //ESTA ACCION ES PARA LISTAR LOS COLORES PARA LOS INPUTS
      ====================================================================*/
    static public function mdlListarColoresInputsMateriales(){
    $stmt = Conexion::conectar() -> prepare("SELECT colores FROM colores_piedras");   

    $stmt ->execute();    
    return $stmt->fetchAll();

}
/*===================================================================
    ESTA ACCION ES PARA TRAER LOS DATOS PARA EL DATATABLE QUE ES EN EL MODAL
      ====================================================================*/
    static public function mdlListarDatosMD($cod_datos){
    $stmt = Conexion::conectar() -> prepare("SELECT id_piedras, color_piedras, tamano_piedra, cant_piedra, cantidad_prendas, estilo_piedra FROM datos_materiales_detalle WHERE cod_datos = :cod_datos");
     $stmt -> bindParam(":cod_datos",$cod_datos, PDO::PARAM_STR);

    $stmt ->execute();
    
    return $stmt->fetchAll();

}
}