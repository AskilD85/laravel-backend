<?php
/**
 * Carbon helper
 *
 * @param $time
 * @param $tz
 *
 * @return Carbon\Carbon
 */
function carbon($time)
{
	$array = json_decode($time);
	$key = array_rand($array,1);
	$result = json_encode($array[$key]);
    return $result;
}

