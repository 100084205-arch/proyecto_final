<?php

class Conexion{
                                                                                      
    static public function conectar(){
        try {
            $conn = new PDO("mysql:host=localhost;dbname=Approval","root","2350",array(Pdo\Mysql::ATTR_INIT_COMMAND => "SET NAMES utf8"));
            return $conn;
        }
        catch (PDOException $e) {
            echo 'Falló la conexión: ' . $e->getMessage();
        }

    }
}
