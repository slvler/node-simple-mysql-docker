<?php
if(! file_exists("_cache")){ mkdir("_cache", 0777); }

if(!function_exists('minify_assets')){
    function minify_assets($ext = "", $assets = array()){
		// İstenilen dosya yok ise oluşturuyor
		if (! file_exists("_cache/all.min.".$ext)){
			// Gelen tüm dosya yollarını art arda ekleyerek string olarak txt değişkenine tanımlıyor
			$txt = "";
			foreach($assets as $asset){
				// dirname kullanarak dosya dizinlerini ayarlıyor
				$txt .= str_replace("../","../".dirname(dirname($asset))."/",file_get_contents($asset));
			}
			// dosya oluşturup txt değişkenini içine yazıyor
			$fp = fopen("_cache/all.min.".$ext,"wb");
			fwrite($fp,minify_from($txt, $ext));
			fclose($fp);
		}
		return "_cache/all.min.".$ext;
    }
}

if(!function_exists('minify_from')){
	function minify_from($txt, $ext){
		if(trim($txt) === "") return $txt;
		
		if($ext == "css"){
			// Kaynak: https://gist.github.com/webgefrickel/3339063
			// some of the following functions to minimize the css-output are directly taken
			// from the awesome CSS JS Booster: https://github.com/Schepp/CSS-JS-Booster
			// all credits to Christian Schaefer: http://twitter.com/derSchepp
			// remove comments
			$txt = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $txt);
			// backup values within single or double quotes
			preg_match_all('/(\'[^\']*?\'|"[^"]*?")/ims', $txt, $hit, PREG_PATTERN_ORDER);
			for ($i=0; $i < count($hit[1]); $i++) {
				$txt = str_replace($hit[1][$i], '##########' . $i . '##########', $txt);
			}
			// remove traling semicolon of selector's last property
			$txt = preg_replace('/;[\s\r\n\t]*?}[\s\r\n\t]*/ims', "}\r\n", $txt);
			// remove any whitespace between semicolon and property-name
			$txt = preg_replace('/;[\s\r\n\t]*?([\r\n]?[^\s\r\n\t])/ims', ';$1', $txt);
			// remove any whitespace surrounding property-colon
			$txt = preg_replace('/[\s\r\n\t]*:[\s\r\n\t]*?([^\s\r\n\t])/ims', ':$1', $txt);
			// remove any whitespace surrounding selector-comma
			$txt = preg_replace('/[\s\r\n\t]*,[\s\r\n\t]*?([^\s\r\n\t])/ims', ',$1', $txt);
			// remove any whitespace surrounding opening parenthesis
			$txt = preg_replace('/[\s\r\n\t]*{[\s\r\n\t]*?([^\s\r\n\t])/ims', '{$1', $txt);
			// remove any whitespace between numbers and units
			$txt = preg_replace('/([\d\.]+)[\s\r\n\t]+(px|em|pt|%)/ims', '$1$2', $txt);
			// shorten zero-values
			$txt = preg_replace('/([^\d\.]0)(px|em|pt|%)/ims', '$1', $txt);
			// constrain multiple whitespaces
			$txt = preg_replace('/\p{Zs}+/ims',' ', $txt);
			// remove newlines
			$txt = str_replace(array("\r\n", "\r", "\n"), '', $txt);
			// Restore backupped values within single or double quotes
			for ($i=0; $i < count($hit[1]); $i++) {
				$txt = str_replace('##########' . $i . '##########', $hit[1][$i], $txt);
			}
			return $txt;
		}elseif($ext == "js"){
			require_once(APPPATH.'third_party/jsmin'.EXT);
			return JSMin::minify($txt);
		}
	}
}