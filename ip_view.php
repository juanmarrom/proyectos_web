<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8" />
        <title>Sesion 8</title>
    </head>
    <body>
	 <form name="formulario" method="post" action="index.php">

		IP: <input type="text" name="ip" value="<?php echo $_POST['ip']?>">

		<input type="submit" value="Search"/>

	</form>

        <?php
		
	foreach ($datos as $dato) {
		echo "city_name: " . $dato["city_name"] . " || country_name: " . $dato["country_name"] . " ||  latitude: " . $dato["latitude"] . " || longitude: " . $dato["longitude"] . " || postal_code: " . $dato["postal_code"]."<br/>";
	}
        ?>
    </body>
</html>
