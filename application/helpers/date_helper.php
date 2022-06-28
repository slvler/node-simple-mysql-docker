<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function date_between($start_date,$end_date)
{
	$result=array();
	$date_from=mktime(1,0,0,substr($start_date,5,2),     substr($start_date,8,2),substr($start_date,0,4));
	$date_to=mktime(1,0,0,substr($end_date,5,2),     substr($end_date,8,2),substr($end_date,0,4));
	if ($date_to>=$date_from)
	{
		array_push($result,date('Y-m-d',$date_from));
		while ($date_from<$date_to)
		{
			$date_from+=86400;
			array_push($result,date('Y-m-d',$date_from));
		}
	}
	array_splice($result, count($result) - 1);
	return $result;
}

function date_between_admin($start_date,$end_date)
{
	$result=array();
	$date_from=mktime(1,0,0,substr($start_date,5,2),     substr($start_date,8,2),substr($start_date,0,4));
	$date_to=mktime(1,0,0,substr($end_date,5,2),     substr($end_date,8,2),substr($end_date,0,4));
	if ($date_to>=$date_from)
	{
		array_push($result,date('Y-m-d',$date_from));
		while ($date_from<$date_to)
		{
			$date_from+=86400;
			array_push($result,date('Y-m-d',$date_from));
		}
	}
	return $result;
}

function month_lang($data)
{
	$months = array("Oca", "Şub", "Mar", "Nis", "May", "Haz", "Tem", "Ağu", "Eyl", "Eki", "Kas", "Ara");
	$result = $months[$data-1];
	return $result;
}