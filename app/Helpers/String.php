<?php

/**
 * param string $date
 * return string indonesia format date date fullMonth year
*/
function dateToIndonesia(string $date):string
{
    $date       = strtotime($date);
    $getDate    = date('d', $date);
    $getMonth   = intval(date('m', $date));
    $getYear    = date('Y', $date);
    $months     = [
                'Januari', 'Februari', 'Maret',
                'April', 'Mei', 'Juni', 'Juli',
                'Agustus', 'September', 'Oktober',
                'November', 'Desember'
                ];


    return "$getDate $months[$getMonth] $getYear";
}

?>
