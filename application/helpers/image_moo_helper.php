<?php
$this->load->library('Image_moo');

if(! file_exists("_cache")){ mkdir("_cache", 0777); }
if(! file_exists("_cache/croped")){ mkdir("_cache/croped", 0777); }

if(!function_exists('image_moo')){
    function image_moo($img = "", $width = "", $height = "", $bgcolor = "", $quality = 75){
        if($img != ""){
			if(substr($img,0,4) == "http"){
				$getimg = $img;
				$getimg_path_parts = pathinfo($getimg);
				$img = "_cache/croped/".str_replace(array("/",":","."),"",$getimg_path_parts['dirname']).$getimg_path_parts['basename'];
				if (! file_exists($img)){ file_put_contents($img, fopen($getimg, 'r')); }
			}
			
			$org_width = @getimagesize($img)[0];
			$org_height = @getimagesize($img)[1];
			
			if($height != "" && $width == ""){ $width = ($height * $org_width) / $org_height; }
			if($height == "" && $width != ""){ $height = ($width * $org_height) / $org_width; }
			if($height == "" && $width == ""){ $width = $org_width; $height = $org_height; }
			
            $path_parts = pathinfo($img);
			if($bgcolor != ""){
				$newname = '_cache/croped/'.$path_parts['filename'].'-'.$width.'x'.$height.'-'.str_replace("#","",$bgcolor).'.'.$path_parts['extension'];
			}else{
				$newname = '_cache/croped/'.$path_parts['filename'].'-'.$width.'x'.$height.'.'.$path_parts['extension'];
			}

            if (file_exists($newname)){
               return $newname;
            }else{
				if($bgcolor != ""){
					get_instance()->image_moo
					->load($img)
					->set_background_colour($bgcolor)
					->resize($width,$height,TRUE)
					->set_jpeg_quality($quality)
					->save($newname, TRUE);
				}else{
					get_instance()->image_moo
					->load($img)
					->resize_crop($width,$height)
					->set_jpeg_quality($quality)
					->save($newname, TRUE);
				}
				return $newname;
            }
        }elseif($img == "" && ($width != "" || $height != "")){
			if($width == ""){ $width = $height; }
			if($height == ""){ $height = $width; }
			return 'http://via.placeholder.com/'.$width.'x'.$height.'/';
        }else{
			return false;
		}
    }
}