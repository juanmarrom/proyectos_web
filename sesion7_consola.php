<?php


class Database {
		
	function __construct() {
	}

	function __destruct() {
	}

	public function getData($ip) {
		$result_text = "";
		$conn = new mysqli("localhost", "root", "2306Jely", "GeoIP");
		$sql = "select cl.city_name,cl.country_name,cb.latitude,cb.longitude, cb.postal_code  from cities_locations cl, cities_blocks_ip4 cb where cb.geoname_id = cl.geoname_id and network like '$ip%' limit 10;
";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$result_text = $result_text . "city_name: " . $row["city_name"] . " || country_name: " . $row["country_name"] . " ||  latitude: " . $row["latitude"] . " || longitude: " . $row["longitude"] . " || postal_code: " . $row["postal_code"] . "\n";
			}
		} 
		else {
			return "0 results";
		}
		return $result_text;

	}
} 

class GeoIP {
			
	function __construct() {
	}

	public function getCities($ip) {
		$database = new Database();
		return $database->getData($ip);
	}
} 

$ip_arg = $argv[1];
echo "Parametro: $ip_arg\n";
$geoIP = new GeoIP();
//$data = $geoIP->getCities("2.136.57.0/24");
$data = $geoIP->getCities("$ip_arg");
echo "$data\n";

?>	


