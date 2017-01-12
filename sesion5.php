<?php

class File {

	protected $path;
	protected $path_thumbs;
	private $path_apache;
	
	
	function __construct($path) {
		$path_apache = getcwd();
		$this->path = $path_apache . "/" . $path;		
	}

	protected function createDir() {
		if (!is_dir($path_thumbs)) {
    			mkdir($path_thumbs, 0777, true);
		}
	}

	protected function checkIfFileExists() {
		if (file_exists($this->path)) {
			return true;
		}
		else {
        		return false;
    		}
	}

	protected function getFileList() {
	   	$handle = opendir($this->path);
		$files = array();
		while ($file = readdir($handle)) {			
			$files[] = $file; 	
		}
	    	closedir($handle);
		return $files;
	}
} 

class Image extends File {
	const PATH_THUMBS = "/thumbs";
	private $photo = "";

	private function createThumb() {
		if (!is_dir(self::PATH_THUMBS)) {
    			mkdir(PATH_THUMBS, 0777, true);
		}
	}

	private function validatePhoto() {
		if(preg_match("/^.*\.(jpg|jpeg|png|gif)$/i",$this->photo)) {
			return true;
	  	}
	  	return false;	
	}

	public function getImages() {
		$this->path_thumbs = $this->path . self::PATH_THUMBS;
		//echo $this->path_thumbs;
		$this->createThumb();
		$all_files = array();
		$files = array();
		$all_files = $this->getFileList();
		//var_dump($all_files);
		foreach ($all_files as $file) {
			$this->photo = $file;
			//echo $file;
			if($this->validatePhoto()) {
				$files[] = $file;
				System::execCommand($this->path . "/" . $file  ,$this->path_thumbs . "/" . $file);
			}
			
		}
		return $files;		
	}
} 

class System {	
	public static function execCommand($from, $to) {
		//echo "convert -resize 20X20 " . $from . " " . $to;
		exec("convert -resize 20X20 " . $from . " " . $to);
	}
}

?>	

<!DOCTYPE html> <!--- HTML5 --->
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta name="description" content="Sesion4 HTML5">
        <meta name="author" content="Grupo OULS">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Entregable S5</title>
    </head>

    <body dir="ltr">
	<h1>Miniaturas</h1>
	<table>
	<?php
	$path = "fotos";
	$image = new Image($path);
	$image_list = $image->getImages();
	//var_dump($image_list);
	//$image_list = array();  
	//$image_list es un array, que puedes recorrer para mostrar las fotos en el HTML
    	
	$i = 0;
	foreach ($image_list as $file) {
		$i++;
		echo "<tr><td>";
		echo "&nbsp" . $file . "--&nbsp"; //de ser un directorio lo envolvemos entre corchetes
		echo "<a href='$path/$file' target='_blank'><img src='$path/thumbs/$file' alt='Min$i' height='20' width='20'></a>";
		echo "</td></tr>";
	}
	?>	
	</table>		
    </body>
</html>
