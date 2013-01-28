<?php

putenv('GDFONTPATH=' . realpath('.'));

if(isset($_GET['img'])&&!empty($_GET['img'])){
	header("Content-type: image/png");
	$source = htmlentities($_GET['img']);
	if(isset($_GET['h'])&&!empty($_GET['h'])) $h = (int)htmlentities($_GET['h']);
	else $h=0;
	if(isset($_GET['w'])&&!empty($_GET['w'])) $w = (int)htmlentities($_GET['w']);
	else $w=0;
	if(isset($_GET['l'])&&!empty($_GET['l'])) $l = (int)htmlentities($_GET['l']);
	else $l=0;
	if(isset($_GET['d'])&&!empty($_GET['d'])) $d = (int)htmlentities($_GET['d']);
	else $d=0;

	$img_dest = genImg($source, $h, $w, $l, $d);

	imagepng($img_dest);
	imagedestroy($img_dest);
}

function genImg($source, $h=0, $w=0, $l=0, $d=0){
	$parts = explode('.', $source);
	$ext = strtolower($parts[count($parts)-1]);

	if($ext === 'png'){
		$img_source = imagecreatefrompng('pic/'.$source);
	}else if($ext === 'gif'){
		$img_source = imagecreatefromgif('pic/'.$source);
	}else if($ext === 'bmp'){
		$img_source = imagecreatefromwbmp('pic/'.$source);
	}else{
		$img_source = imagecreatefromjpeg('pic/'.$source);
	}

	if($h==0 && $w==0){
		$h = imagesy($img_source);
		$w = imagesx($img_source);
	}

	$source_ratio = imagesx($img_source)/imagesy($img_source);

	if($d==0){
		if($h!=0 && $w!=0){
			$dest_ratio = $w/$h;
			if($dest_ratio!=$source_ratio){
				if($dest_ratio>$source_ratio){
					$w = $h*$source_ratio;
				}else{
					$h = $w/$source_ratio;
				}
			}
		}else{
			if($w==0) $w = $h*$source_ratio;
			if($h==0) $h = $w/$source_ratio;
		}
	}else{
		if($h==0) $h = imagesy($img_source);
		if($w==0) $w = imagesx($img_source);
	}

	$img_dest = imagecreatetruecolor($w, $h);

	if($ext == 'gif' or $ext == 'png'){
		imagecolortransparent($img_dest, imagecolorallocatealpha($img_dest, 0, 0, 0, 127));
		imagealphablending($img_dest, false);
		imagesavealpha($img_dest, true);
	}

	imagecopyresampled($img_dest, $img_source, 0, 0, 0, 0, $w, $h, imagesx($img_source), imagesy($img_source));

	if($l!=0){
		$orange=imagecolorallocate($img_dest, 221, 119, 0);
		$white=imagecolorallocate($img_dest, 255, 255, 255);
		imagefilledellipse($img_dest, 0, $h, $h*8.5/12, $h*8.5/12, $orange);
		imageellipse($img_dest, 0, $h, ($h*8.5/12), ($h*8.5/12), $white);
		imagettftext($img_dest, $h/5.5, 0, 2, $h-2, $white, '28DaysLater.ttf', sprintf('%02d',$l));
	}

	return $img_dest;
}