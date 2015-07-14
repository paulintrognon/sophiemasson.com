<?php

// Créer une vignette
function vignette($img, $img_dest, $width=0, $height=0) 
{
  // dimensions de l'image
	$size = GetImageSize($img);
  $src_w = $size[0];
  $src_h = $size[1];

  if ($width != 0 OR $height != 0) 
	{
    if ($src_w > $width OR $src_h > $height) 
		{
      if ($src_w > $src_h AND $width != 0) 
			{
        //On retrecit la largeur
        $height = ceil(($src_h / $src_w) * $width);
      } 
			elseif($src_h > $src_w && $height != 0) 
			{
        //On retrecit la hauteur
        $width = ceil(($src_w / $src_h) * $height);
      }
    } 
		else
		{
      $width = $src_w;
      $height = $src_h;
    }    
  } 
	else 
	{
    $width = $src_w;
    $height = $src_h;    
  }

  $ext = explode(".", $img);
  $ext = $ext['1'];
  $dst_im = ImageCreateTrueColor($width,$height);
  $trans_color = imagecolorallocate($dst_im, 255, 0, 0);
    
	if (!$dst_im) 
	{ 
		return 0; 
	}
          
  if ($ext == 'jpg' or $ext == 'jpeg' or $ext == 'JPG' or $ext == 'JPEG') 
	{
    $src_im = ImageCreateFromJpeg($img);
  } 
	elseif ($ext == 'gif') 
	{
    $src_im = imagecolortransparent($dst_im, $trans_color);
  	$src_im = ImageCreateFromGif($img);
  } 
	elseif ($ext == 'png') 
	{
    $src_im = ImageCreateFromPng($img);
  } 
	else 
	{ 
		return 0; 
	}
          
  if (!$src_im) 
	{ 
		return 0;
	}
  
	ImageCopyResampled($dst_im,$src_im,0,0,0,0,$width,$height,$src_w,$src_h);
    
  if ($ext == 'jpg' or $ext == 'jpeg' or $ext == 'JPG' or $ext == 'JPEG') 
	{
    ImageJpeg($dst_im,$img_dest);
  } 
	elseif ($ext == 'gif') 
	{
    ImageGif($dst_im,$img_dest);
  } 
	elseif ($ext == 'png') 
	{
    ImagePng($dst_im,$img_dest);
  } 
	else 
	{ 
		return 0;
	}
          
  ImageDestroy($dst_im);
  return 1;
}



?>