<?php

// funzione che calcola l'estensione dell'Alfabeto 
// (varietà approssimativa possibile di simboli nella pw)
// Es. contiene caratteri a-z A-Z 0-9 ...
function alfacalc($pw) {

    $a=0; // N alfabeto da ritornare

    // Variabili di dominio (per Alfabeto)
    $az = "abcdefghijklmnopqrstuvz";
    $AZ = "ABCDEFGHIJKLMNOPQRSTUVZ";
    $n = "1234567890";
    $mu_sym = "!@#?$&*."; // most used
    $sym = "<>\|\"£%/()=^Ì'È+ÒÀÙ,-_:;§°Ç`[]{}àèéìòù";

    $Ascii = [$az,$AZ,$n,$mu_sym,$sym];

    foreach($Ascii as $str) {

        $l = strlen($str);

        for($i=0; $i<$l; $i++) {

            if(strpos($pw,$str[$i])) {
                $a+=$l;
                break;
            }
        }
    }

    

    return $a;

}