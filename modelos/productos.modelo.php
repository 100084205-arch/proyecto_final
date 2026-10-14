<?php
require_once "conexion.php";
use PhpOffice\PhpSpreadsheet\IOFactory;
class ProductosModelo{
 /*===================================================================
    REALIZAR LA CARGA MASIVA DE PRODUCTOS MEDIANTE ARCHIVO EXCEL
    
  ===================================================================*/
    /*===================================================================
    ESTE CODIGO ES PARA USARLO CUANDO SE VAYA A REGISTRAR UN ARCTICULO Y EN EL CAMBO  DIGA ACTIVO O INACTIVO
       $activo = 'activo';
       $stmt -> bindParam(":activo", $activo , PDO::PARAM_STR);
           UPDATE
       venta_cabecera
       SET
       id_usuario = 'inactivo'
       WHERE
       CAST(nro_factura AS CHAR CHARACTER SET utf8) = CAST(p_nro_factura AS CHAR CHARACTER SET utf8);
    
    ====================================================================*/   
    static public function mdlCargaMasivaProductos($fileProductos){
        session_start();
        if (!isset($_SESSION['usuario']->id_usuario) || is_null($_SESSION['usuario']->id_usuario)) {
          return "Error al registrar los acticulos. Fue imposible validar la sesion actual";        
        }
         $id_usuario = $_SESSION['usuario']->id_usuario;
          $nombreArchivo = $fileProductos['tmp_name'];
          $documento = IOFactory::load($nombreArchivo);
          $hojaProductos= $documento->getSheet(0);
          $numeroFilasProductos= $hojaProductos->getHighestDataRow();     
         // var_dump($numeroFilasProductos);
         $ProductosRegistrados = 0;
         $ProductosNoRegistrado = 0; 
       //CICLO FOR PARA REGISTROS DE Productos
        for ($i=5; $i <= $numeroFilasProductos; $i++) {        
          $orden= $hojaProductos->getCellByColumnAndRow(2,$i);
          $vch = $hojaProductos->getCellByColumnAndRow(3,$i);
          $stile= $hojaProductos->getCellByColumnAndRow(4,$i);
          $color= $hojaProductos->getCellByColumnAndRow(5,$i);
          $zize= $hojaProductos->getCellByColumnAndRow(6,$i);
          $qty= $hojaProductos->getCellByColumnAndRow(7,$i);
          //=====================================================
          $color_2= $hojaProductos->getCellByColumnAndRow(8,$i);
          $zize_2= $hojaProductos->getCellByColumnAndRow(9,$i);
          $qty_2= $hojaProductos->getCellByColumnAndRow(10,$i);
          //=====================================================
          $color_3= $hojaProductos->getCellByColumnAndRow(11,$i);
          $zize_3= $hojaProductos->getCellByColumnAndRow(12,$i);
          $qty_3= $hojaProductos->getCellByColumnAndRow(13,$i);
          //=====================================================
           $color_4= $hojaProductos->getCellByColumnAndRow(14,$i);
          $zize_4= $hojaProductos->getCellByColumnAndRow(15,$i);
          $qty_4= $hojaProductos->getCellByColumnAndRow(16,$i);
          
         $Schedule = date('Y-m-d');
         if (!empty($orden)) {
  $pdo = Conexion::conectar();

  $verificar = $pdo->prepare("SELECT COUNT(*) FROM entrada_warehouse WHERE orden = :orden");
  $verificar->bindParam(":orden", $orden, PDO::PARAM_STR);
  $verificar->execute();
  $existe = $verificar->fetchColumn();

  if ($existe == 0) {
    $stmt = $pdo->prepare("INSERT INTO entrada_warehouse(orden,vch,stile,color,zize,qty,color_2,zize_2,qty_2,color_3,zize_3,qty_3,color_4,zize_4,qty_4,creador)
    VALUES(:orden,:vch,:stile,:color,:zize,:qty,:color_2,:zize_2,:qty_2,:color_3,:zize_3,:qty_3,:color_4,:zize_4,:qty_4,:creador);");

    $stmt->bindParam(":orden", $orden, PDO::PARAM_STR);
    $stmt->bindParam(":vch", $vch, PDO::PARAM_STR);
    $stmt->bindParam(":stile", $stile, PDO::PARAM_STR);
    $stmt->bindParam(":color", $color, PDO::PARAM_STR);
    $stmt->bindParam(":zize", $zize, PDO::PARAM_STR);
    $stmt->bindParam(":qty", $qty, PDO::PARAM_STR);
    $stmt->bindParam(":color_2", $color_2, PDO::PARAM_STR);
    $stmt->bindParam(":zize_2", $zize_2, PDO::PARAM_STR);
    $stmt->bindParam(":qty_2", $qty_2, PDO::PARAM_STR);
    $stmt->bindParam(":color_3", $color_3, PDO::PARAM_STR);
    $stmt->bindParam(":zize_3", $zize_3, PDO::PARAM_STR);
    $stmt->bindParam(":qty_3", $qty_3, PDO::PARAM_STR);
    $stmt->bindParam(":color_4", $color_4, PDO::PARAM_STR);
    $stmt->bindParam(":zize_4", $zize_4, PDO::PARAM_STR);
    $stmt->bindParam(":qty_4", $qty_4, PDO::PARAM_STR);
     $stmt->bindParam(":creador", $id_usuario, PDO::PARAM_STR);
    

    if ($stmt->execute()) {
      $ProductosRegistrados++;
    } else {
      $ProductosNoRegistrado++;
    }
  } else {
    $ProductosNoRegistrado++;
  }
}            
      }  
        return "Registrado "."($ProductosRegistrados)". "<> Y No Registrado "."($ProductosNoRegistrado)";
  }    
     /*===================================================================
    OBTENER LISTADO TOTAL DE PRODUCTOS PARA EL DATATABLE
    ====================================================================*/
    static public function mdlListarProductos(){    
        $stmt = Conexion::conectar()->prepare("SELECT ''as detalles, orden, vch, stile, color, zize, qty, color_2,zize_2,qty_2,color_3,zize_3,qty_3,color_4,zize_4,qty_4, (SELECT CONCAT(u.nombre_usuario, ' ', u.apellido_usuario) FROM usuarios u WHERE u.id_usuario = creador) as creador FROM entrada_warehouse      
        ");
    // $stmt -> bindParam(":orden",$orden,PDO::PARAM_INT);
     $stmt->execute();
    return $stmt->fetchAll();
}   
 /*===================================================================
    REGISTRAR PRODUCTOS UNO A UNO DESDE EL FORMULARIO DEL INVENTARIO
    ====================================================================*/
    static public function mdlRegistrarProducto($pkgid, $iten_num,$color,$cantidad,$ubicacion,$almacen){       
        try{
            $fecha = date('Y-m-d');
            $stmt = Conexion::conectar()->prepare("INSERT INTO PRODUCTOS(pkgid,iten_num,color,cantidad,fecha_entrada,ubicacion,almacen)VALUES (:pkgid,:iten_num,:color,:cantidad,:fecha_entrada,:ubicacion,:almacen)");                                
            $stmt -> bindParam(":pkgid", $pkgid , PDO::PARAM_STR);
            $stmt -> bindParam(":iten_num", $iten_num , PDO::PARAM_STR);
            $stmt -> bindParam(":color", $color , PDO::PARAM_STR);
            $stmt -> bindParam(":cantidad", $cantidad ,PDO::PARAM_STR);
            $stmt -> bindParam(":fecha_entrada", $fecha , PDO::PARAM_STR);
            $stmt -> bindParam(":ubicacion", $ubicacion , PDO::PARAM_STR);                                                    
            $stmt -> bindParam(":almacen", $almacen, PDO::PARAM_STR);          
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
    static public function mdlActualizarInformacion($table, $data, $id, $nameId){
        $set = "";
        foreach ($data as $key => $value) {            
            $set .= $key." = :".$key.",";                
        }
        $set = substr($set, 0, -1);
        $stmt = Conexion::conectar()->prepare("UPDATE $table SET $set WHERE $nameId = :$nameId");
        foreach ($data as $key => $value) {            
            $stmt->bindParam(":".$key, $data[$key], PDO::PARAM_STR);            
        }		
        $stmt->bindParam(":".$nameId, $id, PDO::PARAM_INT);
        if($stmt->execute()){
            return "ok";
        }else{
            return Conexion::conectar()->errorInfo();        
        }
    }
     /*===================================================================
    LISTAR NOMBRE DE PRODUCTOS PARA INPUT DE AUTO COMPLETADO
      ====================================================================*/
    static public function mdlListarNombreProductos($pkgid){
        $stmt = Conexion::conectar()->prepare("SELECT Concat(p.pkgid ) 
         as descripcion_producto FROM productos p  ");
         $stmt -> bindParam(":pkgid",$pkgid,PDO::PARAM_INT);
        $stmt -> execute();
        return $stmt->fetchAll();
    }
   /*===================================================================
    BUSCAR PRODUCTO POR SU CODIGO DE BARRAS
    ====================================================================*/
    static public function mdlGetDatosProducto($pkgid){
        $stmt = Conexion::conectar()->prepare("SELECT p.pkgid,p.iten_num,p.color,p.cantidad FROM productos p  WHERE pkgid = :pkgid AND p.cantidad > 0");        
        $stmt -> bindParam(":pkgid",$pkgid,PDO::PARAM_INT);
        $stmt -> execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
     /*===================================================================
    VERIFICAR EL STOCK DE UN PRODUCTO
    ====================================================================*/
    static public function mdlVerificaStockProducto($pkgid, $cantidad_a_salir){
        $stmt = Conexion::conectar()->prepare("SELECT   count(*) as existe FROM productos p WHERE p.pkgid = :pkgid AND p.cantidad >:cantidad_a_salir");    
        $stmt -> bindParam(":pkgid",$pkgid,PDO::PARAM_STR);
        $stmt -> bindParam(":cantidad_a_salir",$cantidad_a_salir,PDO::PARAM_STR);    
        $stmt -> execute();    
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
       /*===================================================================
       OBTENER LISTADO TOTAL DE LA SALIDA  DE WAREHOUSE DEL DATATABLE POR EL FILTRO DEL PKGID
       ====================================================================*/
    static public function mdlBuscarSalida($pkgid){
            $stmt = Conexion::conectar()->prepare("SELECT  c.pkgid,c.iten_num,c.color,c.cantidad,c.iptdestino,(SELECT CONCAT(u.nombre_usuario, ' ', u.apellido_usuario) FROM usuarios u WHERE u.id_usuario = c.creador) as creador,c.fecha_venta  
                                                 FROM venta_detalle c where  c.pkgid = :pkgid                                                       ");
            $stmt -> bindParam(":pkgid",$pkgid,PDO::PARAM_STR);    
            $stmt->execute();    
            return $stmt->fetchAll();
    }
        /*===================================================================
       OBTENER LISTADO TOTAL DE LOS PRODUCTOS ACTIVOS DE LOS ARTICULOS LOCALES  DATATABLE 
       ====================================================================*/
       static public function mdlSinUbicacion(){    
        $stmt = Conexion::conectar()->prepare(" SELECT pkgid,iten_num,color,cantidad,fecha_entrada,ubicacion,almacen,
        (SELECT CONCAT(u.nombre_usuario, ' ', u.apellido_usuario) FROM usuarios u WHERE u.id_usuario = creador) as creador,estado FROM productos WHERE ubicacion='' AND cantidad > 0 order by
    pkgid ");         
        $stmt->execute();    
        return $stmt->fetchAll();
    }

     /*===================================================================
       OBTENER LISTADO TOTAL DE LOS PRODUCTOS ACTIVOS DE LOS ARTICULOS LOCALES EN EL  DATATABLE POR LA FECHA ACTUAL ////
      ====================================================================*/
       static public function mdlListarRangoFecha($fechaDesde,$fechaHasta){    
        $stmt = Conexion::conectar()->prepare("SELECT  c.pkgid,c.iten_num,c.color,c.cantidad,c.iptdestino,(SELECT CONCAT(u.nombre_usuario, ' ', u.apellido_usuario) FROM usuarios u WHERE u.id_usuario = c.creador) as creador,c.fecha_venta                                                              
         FROM venta_detalle c  where DATE(c.fecha_venta) >= date(:fechaDesde) and DATE(c.fecha_venta) <= date(:fechaHasta)
                                                    order by c.fecha_venta desc");

            $stmt -> bindParam(":fechaDesde",$fechaDesde,PDO::PARAM_STR);
            $stmt -> bindParam(":fechaHasta",$fechaHasta,PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll();
    }
     /*===================================================================
       OBTENER LISTADO TOTAL DE LA SALIDA  DE LOS ARTICULOS LOCALES DEL DATATABLE POR EL FILTRO DEL ITEN_NUM
       ====================================================================*/
       static public function mdlFiltrarIten_num($iten_num){    
        $stmt = Conexion::conectar()->prepare("SELECT c.pkgid,c.iten_num,c.color,c.cantidad,c.iptdestino,(SELECT CONCAT(u.nombre_usuario, ' ', u.apellido_usuario) FROM usuarios u WHERE u.id_usuario = c.creador) as creador,c.fecha_venta  
                                                FROM venta_detalle c where c.iten_num = :iten_num");  
        $stmt -> bindParam(":iten_num",$iten_num,PDO::PARAM_STR);   
        $stmt->execute();    
        return $stmt->fetchAll();
    }
     /*===================================================================
       OBTENER LISTADO TOTAL DE LOS PORDUCTOS  DE WAREHOUSE DEL DATATABLE POR EL FILTRO DEL ITEN_NUM
    ====================================================================*/
       static public function mdlFiltrarIten_numProductos($iten_num){
    
        $stmt = Conexion::conectar()->prepare("SELECT ''as detalles,c.pkgid,c.iten_num,c.color,c.fecha_creacion_producto,c.fecha_entrada,c.cantidad,c.ubicacion,c.almacen,
                                                       (SELECT CONCAT(u.nombre_usuario, ' ', u.apellido_usuario) FROM usuarios u WHERE u.id_usuario = c.creador) as creador,c.estado                                                                                                                                                            
                                                        FROM productos c where c.iten_num = :iten_num");  
         $stmt -> bindParam(":iten_num",$iten_num,PDO::PARAM_STR);   
        $stmt->execute();    
        return $stmt->fetchAll();
    }
        /*===================================================================
       OBTENER LISTADO TOTAL DE LOS PORDUCTOS  DE WAREHOUSE DEL DATATABLE POR EL FILTRO DE UBICACION
    ====================================================================*/
    static public function mdlFiltrarUbicacionProductos($ubicacion){    
        $stmt = Conexion::conectar()->prepare("SELECT ''as detalles,c.pkgid,c.iten_num,c.color,c.fecha_creacion_producto,c.fecha_entrada,c.cantidad,c.ubicacion,c.almacen,(SELECT CONCAT(u.nombre_usuario, ' ', u.apellido_usuario) FROM usuarios u WHERE u.id_usuario = c.creador) as creador,c.estado                                                                                                                                            
                                               FROM productos c where c.ubicacion = :ubicacion");  
        $stmt -> bindParam(":ubicacion",$ubicacion,PDO::PARAM_STR);   
        $stmt->execute();    
        return $stmt->fetchAll();
    }
     /*===================================================================
       OBTENER LISTADO TOTAL DE LOS PORDUCTOS  DE WAREHOUSE DEL DATATABLE POR EL FILTRO DE UBICACION
    ====================================================================*/
    static public function mdlFiltrarActivosProductos(){    
        $stmt = Conexion::conectar()->prepare("SELECT ''as detalles,c.pkgid,c.iten_num,c.color,c.fecha_creacion_producto,c.fecha_entrada,c.cantidad,c.ubicacion,c.almacen,(SELECT CONCAT(u.nombre_usuario, ' ', u.apellido_usuario) FROM usuarios u WHERE u.id_usuario = c.creador) as creador,c.estado 
                                               FROM productos c where  c.cantidad > 0");           
        $stmt->execute();    
        return $stmt->fetchAll();
    }
    static public function mdlNuevoInventario($fechaDesde,$fechaHasta){    
        $stmt = Conexion::conectar()->prepare("SELECT '' as detalle,c.pkgid,(SELECT CONCAT(u.nombre_usuario, ' ', u.apellido_usuario) FROM usuarios u WHERE u.id_usuario = c.creador) as creador,c.fecha_entrada,c.fecha
        FROM nuevo_inventario c where DATE(c.fecha_entrada) >= date(:fechaDesde) and DATE(c.fecha_entrada) <= date(:fechaHasta)
                                                    order by c.fecha_entrada desc ");       
         $stmt -> bindParam(":fechaDesde",$fechaDesde,PDO::PARAM_STR);
         $stmt -> bindParam(":fechaHasta",$fechaHasta,PDO::PARAM_STR);    
        $stmt->execute();    
        return $stmt->fetchAll();
    }
    /*===================================================================
    REGISTRAR PRODUCTOS UNO A UNO DESDE EL FORMULARIO DEL INVENTARIO
    ====================================================================*/
    static public function mdlRegistro_Nuevo_Inventario($pkgid){     
        session_start();

        if (!isset($_SESSION['usuario']->id_usuario) || is_null($_SESSION['usuario']->id_usuario)) {
            return "Error al registrar los datos, vuelva a intentarlo primero reiniciando el equipo y si no funciona pongase en contacto con un administrador . Fue imposible validar la sesion actual";
        }
        $id_usuario = $_SESSION['usuario']->id_usuario;

        try{
            $fecha = date('Y-m-d');
            $stmt = Conexion::conectar()->prepare("INSERT INTO  nuevo_inventario(pkgid,creador,fecha_entrada)VALUES (:pkgid,:creador,:fecha_entrada)");                                
            $stmt -> bindParam(":pkgid", $pkgid , PDO::PARAM_STR);
            $stmt -> bindParam(":creador", $id_usuario , PDO::PARAM_STR);
            $stmt -> bindParam(":fecha_entrada", $fecha , PDO::PARAM_STR);
                 
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
         /*===================================================================
       OBTENER LISTADO TOTAL DE LA SALIDA  DE LOS ARTICULOS LOCALES DEL DATATABLE POR EL FILTRO DEL ITEN_NUM
       ====================================================================*/
       static public function mdlFiltrar_Nuevo_Inventario($pkgid){    
        $stmt = Conexion::conectar()->prepare("SELECT '' as detalle,c.pkgid,(SELECT CONCAT(u.nombre_usuario, ' ', u.apellido_usuario) FROM usuarios u WHERE u.id_usuario = c.creador) as creador,c.fecha_entrada,c.fecha
        FROM nuevo_inventario c  where c.pkgid = :pkgid");  
        $stmt -> bindParam(":pkgid",$pkgid,PDO::PARAM_STR);   
        $stmt->execute();    
        return $stmt->fetchAll();
    }
}


 