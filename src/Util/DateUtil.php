<?php 

namespace App\Util;
use Cake\I18n\Time;
use Cake\I18n\Date;
use Cake\I18n\FrozenDate;
use Cake\I18n\FrozenTime;

class DateUtil
{
    /*
    *  Formata data para ir para o banco
    */
    public static function dateTimeToDB ($sDateTime, $format = 'Y-m-d H:i', $after = ':00') 
    {        
        if (!$sDateTime)
            return '';

        $sDateTime = date($format, strtotime($sDateTime)) . $after;
        $sDateTime = new Time($sDateTime);
        return $sDateTime;
    }

    /*
    *  Adiciona tempo à data passada
    *  $date->modify('+2 hours');
    *  $date->modify('-2 hours');
    */
    public static function addTime($DateTime, $format, $add)
    {
        $date = new Date($DateTime);
        $date->modify($add);
        return $date->format($format);
    }
}
?>
