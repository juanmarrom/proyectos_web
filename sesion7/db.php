<?php
class Conectar{
    public static function conexion(){
        return new mysqli("localhost", "root", "2306Jely", "GeoIP");
    }
}
?>
