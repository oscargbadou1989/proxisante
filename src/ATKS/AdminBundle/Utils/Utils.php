<?php

namespace ATKS\AdminBundle\Utils;

class Utils {
  static function jsonRemoveUnicodeSequences($struct) {
    if(substr(phpversion(), 0,1) != 7){
      return preg_replace("/\\\\u([a-f0-9]{4})/e", "iconv('UCS-4LE','UTF-8',pack('V', hexdec('U$1')))", $struct);
    }else{
      return $struct;
    }
    //return preg_replace("/\\\\u([a-f0-9]{4})/e", "iconv('UCS-4LE','UTF-8',pack('V', hexdec('U$1')))", $struct);
  }

  static function getDistance($lat1, $lon1, $lat2, $lon2) {
    $earthRadius = 6378137;
    $lat1ToRad = deg2rad($lat1);
    $lon1ToRad = deg2rad($lon1);
    $lat2ToRad = deg2rad($lat2);
    $lon2ToRad = deg2rad($lon2);
    $dlo = ($lon2ToRad - $lon1ToRad) / 2;
    $dla = ($lat2ToRad - $lat1ToRad) / 2;
    $a = (sin($dla) * sin($dla)) + cos($lat1ToRad) * cos($lat2ToRad) * (sin($dlo) * sin($dlo));
    $d = 2 * atan2(sqrt($a), sqrt(1 - $a));
    return($earthRadius * $d);
  }
}
