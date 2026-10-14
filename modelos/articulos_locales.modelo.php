<?php

require_once "conexion.php";
use PhpOffice\PhpSpreadsheet\IOFactory;

class LocalesModelo{
    public $resultado;

     
    /*===================================================================
     LISTAR LOS PRODUCTOS DE LOS ARTICULOS LOCALES
      ====================================================================*/
    static public function mdlListarLocales(){
    $stmt = Conexion::conectar() -> prepare("SELECT  id_reducir,
                                                     iten_num,
                                                     descripcion,
                                                     color,
                                                     cantidad,
                                                     stock,
                                                     ubicacion,
                                                     almacen,
                                                     fecha_actualizacion,
                                                     fecha_creacion,
                                                     (SELECT CONCAT(u.nombre_usuario, ' ', u.apellido_usuario) FROM usuarios u WHERE u.id_usuario = creador) as creador,
                                                     estado
                                                     FROM
                                                     articulos_locales order by iten_num asc ");

    $stmt ->execute();
    
    return $stmt->fetchAll();

}


  /*===================================================================
    FUNCION PARA REGISTRAR LOS PRODUCTOS DE LOS ARTICULOS LOCALES
  ====================================================================*/
 static function mdlRegistrarLocales($iten_num,$descripcion, $color, $cantidad, $stock, $ubicacion, $almacen){
     
            try{
                $fecha_actualizacion = date("Y-m-d");
 $stmt = Conexion::conectar()->prepare("INSERT INTO articulos_locales(
                                                                  
                                                                  iten_num,
                                                                  descripcion, 
                                                                  color, 
                                                                  cantidad,
                                                                   stock,
                                                                   ubicacion,
                                                                    almacen,
                                                                    fecha_actualizacion) 
                                                                    VALUES (
                                                                    :iten_num, 
                                                                    :descripcion,
                                                                    :color, 
                                                                    :cantidad, 
                                                                    :stock,
                                                                    :ubicacion,
                                                                    :almacen,
                                                                    :fecha_actualizacion)");


 
 $stmt -> bindParam(":iten_num",$iten_num, PDO::PARAM_STR);
 $stmt -> bindParam(":descripcion",$descripcion, PDO::PARAM_STR);
 $stmt -> bindParam(":color",$color, PDO::PARAM_STR);
 $stmt -> bindParam(":cantidad",$cantidad, PDO::PARAM_STR);
 $stmt -> bindParam(":stock",$stock, PDO::PARAM_STR);
 $stmt -> bindParam(":ubicacion",$ubicacion, PDO::PARAM_STR);
 $stmt -> bindParam(":almacen",$almacen, PDO::PARAM_STR);
 $stmt -> bindParam(":fecha_actualizacion",$fecha_actualizacion, PDO::PARAM_STR);

if($stmt -> execute()){
    $resultado = "ok";

}else{
    $resultado = "error";
} 

}

catch (Exception $e){
    $resultado = 'Excepción capturada: '. $e->getMessage(). "\n";
}

 return $resultado;

$stmt = null;

 }//010754.35

static public function mdlListarNombreLocales(){
    $stmt = Conexion::conectar()->prepare("SELECT Concat(p.id_reducir,'  -    ',p.iten_num) as
         iten_num FROM articulos_locales p ");
          

        $stmt -> execute();

        return $stmt->fetchAll();

}

  /*===================================================================
    BUSCAR PRODUCTO POR SU CODIGO DE BARRAS
    ====================================================================*/
    static public function mdlDatosLocales($id_reducir){

        $stmt = Conexion::conectar()->prepare("SELECT p.id_reducir,
                                                     p.iten_num,
                                                     p.descripcion,
                                                    p.color,
                                                     '1' as cantidad
                                                FROM  articulos_locales p 
                                            WHERE  id_reducir = :id_reducir  AND p.cantidad > 0");
        
        $stmt -> bindParam(":id_reducir",$id_reducir,PDO::PARAM_INT);

        $stmt -> execute();

        return $stmt->fetch(PDO::FETCH_OBJ);
    }


     /*===================================================================
    VERIFICAR EL STOCK DE LOS ARTICULOS LOCALES
    ====================================================================*/

    static public function mdlVerificarStockLocales($id_reducir, $cantidad_a_salir){

        $stmt = Conexion::conectar()->prepare("SELECT count(*) as existe
                                                FROM  articulos_locales p 
                                            WHERE p.id_reducir = :id_reducir
                                            AND p.cantidad > :cantidad_a_salir");
        
        $stmt -> bindParam(":id_reducir",$id_reducir,PDO::PARAM_INT);
        $stmt -> bindParam(":cantidad_a_salir",$cantidad_a_salir,PDO::PARAM_INT);
        
        $stmt -> execute();

        return $stmt->fetch(PDO::FETCH_OBJ);
    }

     /*===================================================================
    LISTAR LOS ARTICULOS LOCAL
    ====================================================================*/

    static public function mdlListarSalida(){
        $stmt = Conexion::conectar() -> prepare("SELECT id_local,
                                                        iten_num,
                                                        descripcion,
                                                        color,
                                                        cantidad,
                                                        iptdestino,
                                                        fecha_reducion,
                                                        (SELECT CONCAT(u.nombre_usuario, ' ', u.apellido_usuario) FROM usuarios u WHERE u.id_usuario = creador) as creador
                                                        FROM
                                                        reducion order by iten_num asc");
    
        $stmt ->execute();
        
        return $stmt->fetchAll();
    
    }

        /*===================================================================
        FUNCION PARA DARLE SALIDAS A LOS PRODUCTOS LOCALES
        ====================================================================*/

    static public function mdlRegistrarReducion($datos, $iptdestino){
        session_start();

    if (!isset($_SESSION['usuario']->id_usuario) || is_null($_SESSION['usuario']->id_usuario)) {
        return "Error al registrar la compra. Fue imposible validar la sesion actual";
        
    }
    $id_usuario = $_SESSION['usuario']->id_usuario;

                $listaProductos = [];

                for ($i = 0; $i < count($datos); ++$i){
                    
                    $listaProductos = explode(",",$datos[$i]);
        
                    $stmt = Conexion::conectar()->prepare("INSERT INTO reducion( id_reducir,iten_num,descripcion, color, cantidad, iptdestino,creador) 
                                                        VALUES( :id_reducir,:iten_num, :descripcion,:color, :cantidad, :iptdestino,:creador)");
        
                    $stmt -> bindParam(":id_reducir", $listaProductos[0] , PDO::PARAM_STR);
                    $stmt -> bindParam(":iten_num", $listaProductos[1] , PDO::PARAM_STR);
                    $stmt -> bindParam(":descripcion", $listaProductos[2] , PDO::PARAM_STR);
                    $stmt -> bindParam(":color", $listaProductos[3] , PDO::PARAM_STR);
                    $stmt -> bindParam(":cantidad", $listaProductos[4] , PDO::PARAM_STR);
                    $stmt -> bindParam(":iptdestino", $iptdestino , PDO::PARAM_STR);
                    $stmt -> bindParam(":creador", $id_usuario , PDO::PARAM_STR);
                   
           

             

                    if($stmt -> execute()){

                        $stmt = null;
        
                        $stmt = Conexion::conectar()->prepare("UPDATE articulos_locales SET cantidad= cantidad- :cantidad
                                                                WHERE id_reducir = :id_reducir" );
        
                        $stmt -> bindParam(":id_reducir", $listaProductos[0] , PDO::PARAM_STR);
                        $stmt -> bindParam(":cantidad", $listaProductos[4] , PDO::PARAM_STR);
                        
                        
    
                             
                        
                        if($stmt -> execute()){
                            $resultado = "Se Registro Correctamente";
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

      

         /*===================================================================
       REGRESAR  UN ARTICULO DE LA SALIDA  DE LOS ARTICULOS LOCALES
        ====================================================================*/
        
        static public function mdlRetornar_Locales($id_local){

            $stmt = Conexion::conectar()->prepare("call prc_retornar_salida_locales(:id_local)");
            $stmt -> bindParam(":id_local", $id_local , PDO::PARAM_STR);
    
            $stmt -> execute();
    
            return $stmt->fetch();
        }
         /*===================================================================
    REALIZAR LA CARGA MASIVA DE PRODUCTOS MEDIANTE ARCHIVO EXCEL
    
  ===================================================================*/
    /*===================================================================
    ESTE CODIGO ES PARA USARLO CUANDO SE VAYA A REGISTRAR UN ARCTICULO Y EN EL CAMPO  DIGA ACTIVO O INACTIVO
       $activo = 'activo';
       $stmt -> bindParam(":activo", $activo , PDO::PARAM_STR);
           UPDATE
       venta_cabecera
       SET
       id_usuario = 'inactivo'
       WHERE
       CAST(nro_factura AS CHAR CHARACTER SET utf8) = CAST(p_nro_factura AS CHAR CHARACTER SET utf8);
    
    ====================================================================*/
   
  static public function mdlCargaMasivaLocales($fileLocales){
    session_start();

    if (!isset($_SESSION['usuario']->id_usuario) || is_null($_SESSION['usuario']->id_usuario)) {
        return "Error al registrar la compra. Fue imposible validar la sesion actual";
    }

    $id_usuario = $_SESSION['usuario']->id_usuario;
   
    $nombreArchivo = $fileLocales['tmp_name'];
    $documento = IOFactory::load($nombreArchivo);

    $hojaProductos= $documento->getSheet(0);
    $numeroFilasProductos= $hojaProductos->getHighestDataRow(); 
    
 // var_dump($numeroFilasProductos);

    $ProductosRegistrados = 0;
    $ProductosNoRegistrado = 0;
   
 

    //CICLO FOR PARA REGISTROS DE Productos
    for ($i=2; $i <= $numeroFilasProductos; $i++) { 
       
       
        $iten_num = $hojaProductos->getCellByColumnAndRow(1,$i);
        $descripcion= $hojaProductos->getCellByColumnAndRow(2,$i);
        $color= $hojaProductos->getCellByColumnAndRow(3,$i);
        $cantidad= $hojaProductos->getCellByColumnAndRow(4,$i);
        $stock= $hojaProductos->getCellByColumnAndRow(5,$i);
        $fecha_creacion = date("Y-m-d");
  
        if(!empty($iten_num)){
          
            $stmt = Conexion::conectar()->prepare("INSERT INTO articulos_locales(iten_num,
                                                                            descripcion,
                                                                            color,
                                                                            cantidad,
                                                                            stock,
                                                                            fecha_creacion,
                                                                            creador
                                                                           )
                                                                values(:iten_num,
                                                                        :descripcion,
                                                                        :color,
                                                                        :cantidad,
                                                                        :stock,
                                                                        :fecha_creacion,
                                                                        :creador
                                                                        );");
            
            $stmt -> bindParam(":iten_num",$iten_num,PDO::PARAM_STR);
            $stmt -> bindParam(":descripcion",$descripcion,PDO::PARAM_STR);
            $stmt -> bindParam(":color",$color,PDO::PARAM_STR);
            $stmt -> bindParam(":cantidad",$cantidad,PDO::PARAM_STR);
            $stmt -> bindParam(":stock",$stock,PDO::PARAM_STR);
            $stmt -> bindParam(":creador", $id_usuario,PDO::PARAM_STR);
            $stmt -> bindParam(":fecha_creacion", $fecha_creacion , PDO::PARAM_STR);
            
            
            

            if($stmt->execute()){
                $ProductosRegistrados = $ProductosRegistrados + 1;
            }else{
                $ProductosNoRegistrado = $ProductosNoRegistrado + 1 ;
            }
               
            
           
        }            
       
    }
   // $respuesta["totalCategorias"] = $ProductosRegistrados;
   // $respuesta["totalProductos"]= $ProductosNoRegistrado;
    

    return "Registrado "."($ProductosRegistrados)". "<> Y No Registrado "."($ProductosNoRegistrado)";
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
    
}

   /*===================================================================
       REGRESAR  UN ARTICULO DE LA SALIDA  DE LOS ARTICULOS LOCALES
DELIMITER $$
CREATE DEFINER=`cpses_wu7x1470q7`@`localhost` PROCEDURE `prc_retornar_salida_locales`(IN `p_id` VARCHAR(8))
BEGIN

DECLARE v_codigo VARCHAR(20);
DECLARE v_stilo  VARCHAR(20);
DECLARE done INT DEFAULT FALSE;
DECLARE cursor_i CURSOR FOR 
SELECT  id
FROM stilo
where CAST( id AS CHAR CHARACTER SET utf8)  = CAST(p_id AS CHAR CHARACTER SET utf8) ;

DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;

OPEN cursor_i;
read_loop: LOOP
FETCH cursor_i INTO v_codigo ;

	IF done THEN
	  LEAVE read_loop;
	END IF;
    
     

  
END LOOP;
CLOSE cursor_i;
 DELETE FROM stilo WHERE CAST( id AS CHAR CHARACTER SET utf8) = CAST(p_id  AS CHAR CHARACTER SET utf8) ;
   

SELECT 'Se retorno correctamente ';
END$$
DELIMITER ;
   ====================================================================*/