<?php
namespace classes;

class Upload {
	
	const PICTURE_WIDTH		= 220;
	const PICTURE_HEIGHT	= 150;
	
    static function createDir($upload_dir) {
    	// Créé le dossier si il n'existe pas
		if( file_exists($upload_dir) === false ) {
			mkdir($upload_dir, 0777);
			chmod($upload_dir, 0777);
		}
    }
    
    function uploadFile($monId, $file, $uploadfile){
		try {
			$filename = self::nettoyer_chaine(self::my_basename( utf8_decode($file['name']) ));
			$uploadfile .= $monId;
			
			// Créé le dossier si il n'existe pas
			if( file_exists($uploadfile) === false ) {
				mkdir($uploadfile, 0777);
				chmod($uploadfile, 0777);
			}
			
			//echo $uploadfile.'/'.$filename;
			return (move_uploaded_file($file['tmp_name'], $uploadfile.'/'.$filename))? $filename:'';
		} catch(Exception $e) {
			new MyException($e->handle);
		}
    }
    
    static function my_basename($filename) {
		return preg_replace( '/^.+[\\\\\\/]/', '', $filename );
	}

	static function nettoyer_chaine($string) {
		$string	= preg_replace('`\s+`', '_', trim($string));
		$string	= str_replace("'", "_", $string);
		$string	= preg_replace('`_+`', '_', trim($string));
		$string	= str_replace("é", "_", $string);
		$string	= strtr($string, "ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ", "aaaaaaaaaaaaooooooooooooeeeeeeeecciiiiiiiiuuuuuuuuynn");
		return $string;
	}
	
	public static function createMiniature($image) {
		$dir		= dirname($image);
		$filename	= basename($image);
		$ext		= substr($image, -4);

		switch($ext) {
			case '.gif':
				$image_src		= imagecreatefromgif($dir.'/'.$filename);
				break;
			case '.jpg':
			case 'jpeg':
				$image_src		= imagecreatefromjpeg($dir.'/'.$filename);
				break;
			case '.png':
				$image_src		= imagecreatefrompng($dir.'/'.$filename);
				break;
		}
		$width		= imagesx($image_src);
		$height		= imagesy($image_src);
		
		// Si l'image de départ est plus grande que celle que l'on veut créer
		if($width >= self::PICTURE_WIDTH && $height >= self::PICTURE_HEIGHT)
		{
			// Récupère le plus petit ratio
			$ratio_w	= round($width / self::PICTURE_WIDTH);
			$ratio_h	= round($height / self::PICTURE_HEIGHT);
			$ratio		= $ratio_w<$ratio_h? $ratio_w:$ratio_h;
			
			
			// Coordonnées du point source.
			$src_x	= ($width - (220*$ratio)) / 2;
			$src_y	= ($height - (150*$ratio)) / 2;
			
			// copi le centre de l'image
			$image_temp	= imagecreatetruecolor((self::PICTURE_WIDTH*$ratio), (self::PICTURE_HEIGHT*$ratio));
			imagecopy($image_temp, $image_src, 0, 0, $src_x, $src_y, $width, $height);
			
			// Retaille l'image
			$image_dest	= imagecreatetruecolor(self::PICTURE_WIDTH, self::PICTURE_HEIGHT);
			imagecopyresampled($image_dest, $image_temp, 0, 0, 0, 0, self::PICTURE_WIDTH, self::PICTURE_HEIGHT, (220*$ratio), (150*$ratio));
			
			// enregistre l'image
			$filename = str_replace('mini-', '', $filename);
			self::saveImage($image_dest, $dir.'/mini-'.$filename);
		}
		else
		{
			// Récupère le plus petit ratio
			$ratio_w	= round(self::PICTURE_WIDTH / $width);
			$ratio_h	= round(self::PICTURE_HEIGHT / $height);
			$ratio		= $ratio_w<$ratio_h? $ratio_h:$ratio_w;
			
			// Retaille l'image
			$new_width = $width*$ratio;
			$new_height = $height*$ratio;
			$image_dest	= imagecreatetruecolor($new_width, $new_height);
			imagecopyresampled($image_dest, $image_src, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
			
			// enregistre l'image
			self::saveImage($image_dest, $dir.'/mini-'.$filename);
			
			//self::createMiniature($dir.'/mini-'.$filename);
		}
		
	}
	
	public static function saveImage($image_dest, $file_dest)
	{
		$ext = substr($file_dest, -4);
		
		switch( $ext ) {
			case '.gif':
				imagegif($image_dest, $file_dest, 100);
				break;
			case '.jpg':
			case 'jpeg':
				imagejpeg($image_dest, $file_dest, 100);
				break;
			case '.png':
				imagepng($image_dest, $file_dest, 9);
				break;
		}
		imagedestroy($image_dest);
	}
		
}