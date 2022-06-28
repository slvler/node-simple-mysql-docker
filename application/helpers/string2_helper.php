<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('tr_strtoupper')){
	function tr_strtoupper($text)
	{
		global $CI;
		if($CI->session->userdata('lang') == "tr"){
			$search		= array("ç","i","ı","ğ","ö","ş","ü");
			$replace	= array("Ç","İ","I","Ğ","Ö","Ş","Ü");
			$text		= str_replace($search,$replace,$text);
		}
		return mb_strtoupper($text);
	}
}

if(!function_exists('tr_strtolower')){
	function tr_strtolower($text)
	{
		global $CI;
		if($CI->session->userdata('lang') == "tr"){
			$search		= array("Ç","İ","I","Ğ","Ö","Ş","Ü");
			$replace	= array("ç","i","ı","ğ","ö","ş","ü");
			$text		= str_replace($search,$replace,$text);
		}
		return mb_strtolower($text);
	}
}

if(!function_exists('tr_ucwords')){
	function tr_ucwords($text)
	{
		$result = '';
		$keywords = explode(" ", $text);
		foreach ($keywords as $keyword){
			$keywordlong = strlen($keyword);
			$firstchar = mb_substr($keyword,0,1,'UTF-8');

			if		($firstchar=='Ç' or $firstchar=='ç'){ $firstchar='Ç'; }
			elseif	($firstchar=='Ğ' or $firstchar=='ğ'){ $firstchar='Ğ'; }
			elseif	($firstchar=='I' or $firstchar=='ı'){ $firstchar='I'; }
			elseif	($firstchar=='İ' or $firstchar=='i'){ $firstchar='İ'; }
			elseif	($firstchar=='Ö' or $firstchar=='ö'){ $firstchar='Ö'; }
			elseif	($firstchar=='Ş' or $firstchar=='ş'){ $firstchar='Ş'; }
			elseif	($firstchar=='Ü' or $firstchar=='ü'){ $firstchar='Ü'; }
			else	{ $firstchar=mb_strtoupper($firstchar); }

			$others = mb_substr($keyword,1,$keywordlong,'UTF-8');
			$result .= $firstchar.tr_strtolower($others).' ';

		}
		
		return trim(str_replace('  ', ' ', $result));
	}
}

if(!function_exists('next_element_loop')){
	function next_element_loop($array, $element_id)
	{
		foreach($array as $key => $value){
			if($element_id == $value->id){
				if (array_key_exists($key+1, $array)){
					return $array[$key+1];
				}else{
					return current($array);
				}
			}
		}
	}
}

if(!function_exists('phoneFormat')){
	function phoneFormat($phoneNumber)
	{
		$phoneNumber = preg_replace('/[^0-9]/', '', $phoneNumber);
		//phoneNumber değişkenini tüm karakterlerden arındırıyoruz.
		if (strlen($phoneNumber) > 10) {
			//phoneNumber değişkeni 10 haneden büyükse
			$countryCode = substr($phoneNumber, 0, strlen($phoneNumber) - 10);
			$areaCode = substr($phoneNumber, -10, 3);
			$three = substr($phoneNumber, -7, 3);
			$last = substr($phoneNumber, -4, 4);
			$phoneNumber = $countryCode . ' ' . $areaCode . ' ' . $three . ' ' . $last;
			// Oluşan Sonuç = + 90 (555) 444-3322
		} else if (strlen($phoneNumber) == 10) {
			//phoneNumber değişkeni 10 haneye eşitse
			$areaCode = substr($phoneNumber, 0, 3);
			$three = substr($phoneNumber, 3, 3);
			$last = substr($phoneNumber, 6, 4);
			$phoneNumber = '(' . $areaCode . ') ' . $three . '-' . $last;
			// Oluşan Sonuç = (555) 444-3322
		} else if (strlen($phoneNumber) == 7) {
			//phoneNumber değişkeni 7 haneye eşitse
			$three = substr($phoneNumber, 0, 3);
			$last = substr($phoneNumber, 3, 4);
			$phoneNumber = $three . '-' . $last;
			// Oluşan Sonuç = 444-3322
		}
		return $phoneNumber;
	}
}

if(!function_exists('arrsmash')){
	// ilk parametre olarak array, ikinci parametre olarak kaça bölüneceği geliyor. Gelen array parçalanmış olarak geri döndürülüyor.
	function arrsmash($list, $p)
	{
		$listlen = count($list);
		$partlen = floor($listlen / $p);
		$partrem = $listlen % $p;
		$arrsmash = array();
		$mark = 0;
		for($px = 0; $px < $p; $px++){
			$incr = ($px < $partrem) ? $partlen + 1 : $partlen;
			$arrsmash[$px] = array_slice($list, $mark, $incr);
			$mark += $incr;
		}
		return $arrsmash;
	}
}

if(!function_exists('pre')){
	function pre($array)
	{
		echo "<pre>";
		print_r($array);
		echo "</pre>";
	}
}