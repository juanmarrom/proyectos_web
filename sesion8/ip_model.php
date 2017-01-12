<?php
class ip_model{
    private $db;
    private $datos;
 
    public function __construct(){
        $this->db=Conectar::conexion();
        $this->datos=array();
    }
    public function get_datos($ip){
        $consulta=$this->db->query("select cl.city_name,cl.country_name,cb.latitude,cb.longitude, cb.postal_code  from cities_locations cl, cities_blocks_ip4 cb where cb.geoname_id = cl.geoname_id and network like '$ip%' limit 10;");
        while($filas=$consulta->fetch_assoc()){
            $this->datos[]=$filas;
        }
        return $this->datos;
    }
}
?>
