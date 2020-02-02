<?php

// funzione che calcola l'estensione dell'Alfabeto 
// (varietà approssimativa possibile di simboli nella pw)
// Es. contiene caratteri a-z A-Z 0-9 ...
function alfacalc($pw) {
    //echo $pw."<br>";

    $a=0; // N alfabeto da ritornare

    // Variabili di dominio (per Alfabeto)
    $az = "abcdefghijklmnopqrstuvwxyz";
    $AZ = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $n = "1234567890";
    $mus = "!@#*.$&-?"; // most used symbols
    $ous = "<:,/)+=>(;"; // occasionally used symbols
    $rares = "\\|\"^'_°[]{} ~"; // rare symbols
    $erares = "ÈÒÀÌÙàèéìòù`§Çç£"; // extremely rare symbols

    //echo $az[0]."<br>";
    $Ascii = [$az,$AZ,$n,$mus,$ous,$rares,$erares];

    foreach($Ascii as $str) {

        $l = strlen($str);

        for($i=0; $i<$l; $i++) {

            //echo $str[$i];
            if(strpos($pw,$str[$i])!==false) {
                //echo "trovato simbolo ".$str[$i]." della lista $str <br>";
                $a+=$l;
                break;
            }
        }
        //echo "<br>";
    }
    return $a;
}

// nasconde tutti i caratteri di una pw tranne il primo e l'ultimo
function passwdOcc($pw) {
    
    $pwo = "";
    $l = strlen($pw);

    for($i=0; $i<$l; $i++) {
        // non nasconde la prima lettera (pw < 8 caratteri) o le prime due (pw >= 8 caratteri)
        if($i == 0 || ($i == 1 && $l>7)) {
            $pwo[$i] = $pw[$i]; 
        }
        // non oscura l'ultima lettera (pw < 8 caratteri) o le ultime due (pw >= 8 caratteri)
        elseif($i==($l-1) || ($i == ($l-2) && $l>7)) {
            $pwo[$i] = $pw[$i];
        }
        else {
            if($l>15) {
                // lascia in chiaro una lettera ogni 3 (SOLO pw > 15 caratteri)
                if($i%3==0) {
                    $pwo[$i] = $pw[$i];
                }
                else {
                    $pwo[$i] = "*";
                }
            }
            else {
                $pwo[$i] = "*";
            }            
        }
    }
    return $pwo;
}

// valuta il tempo impiegato da un attacco Brute Force a trovare una pw
// Richiede la lunghezza della password, lo spazio delle chiavi
function bfEval($l,$k) {

    $res = []; // array con i risultati delle stime

    $wpc_kps = 500000; // Chiavi per secondo (pc debole)
    $npc_kps = 6000000; //Chiavi per secondo (pc normale)
    $ppc_kps = 60000000; // Chiavi per secondo (pc potente)
    $vppc_kps = 1000000000; // Chiavi per secondo (Pc potentissimo)
    $nasa_kps = 100000000000; // computer della Nasa
    $count=0;
    $kpsa=[$wpc_kps,$npc_kps,$ppc_kps,$vppc_kps,$nasa_kps]; // array delle chiavi per secondo

    foreach($kpsa as $kps) {
        $bft = ceil($k/$kps); // array con i tempi per il brute force (in secondi)
        $count++;
        // SECONDI
        if($bft<60) {
            //echo "$count ) Entrato in S ($bft)<br>";
            $t=$bft;
            
            if($t == 1) {
                $res[] = ['u' => 'secondo', 't' => $t, 'u2' => '', 't2' => ''];
            }
            else {
                $res[] = ['u' => 'secondi', 't' => $t, 'u2' => '', 't2' => ''];
            }
        }
        // MINUTI
        if($bft >= 60 && $bft < 3600) {
            //echo "$count ) Entrato in M ($bft)<br>";
            $t = ceil($bft/60); // trasformo in minuti
            $r = ceil($bft%60); // secondi restanti
            
            // se è un'unità singola cambio valore all'unità di misura
            if($t == 1) {
                $res[] = ['u' => 'minuto', 't' => $t, 'u2' => 'secondi', 't2' => $r];
            }
            else {
                $res[] = ['u' => 'minuti', 't' => $t, 'u2' => 'secondi', 't2' => $r];
            }

        }
        // ORE
        if($bft >= 3600 && $bft < 86400) {
            //echo "$count ) Entrato in O ($bft)<br>";
            $t = ceil($bft/60/60); // trasformo in ore
            $r = ceil($bft%60%60); // minuti restanti
            // se è un'unità singola cambio valore all'unità di misura
            if($t == 1) {
                $res[] = ['u' => 'ora', 't' => $t, 'u2' => 'minuti', 't2' => $r];
            }
            else {
                $res[] = ['u' => 'ore', 't' => $t, 'u2' => 'minuti', 't2' => $r];
            }
        }
        // GIORNI
        if($bft >= 86400 && $bft < 31536000) {
            //echo "$count ) Entrato in G ($bft)<br>";
            $t = ceil($bft/60/60/24); // trasformo in giorni
            $r = ceil($bft%60%60%24); // ore restanti
            // se è un'unità singola cambio valore all'unità di misura
            if($t == 1) {
                $res[] = ['u' => 'giorno', 't' => $t, 'u2' => 'ore', 't2' => $r];
            }
            else {
                $res[] = ['u' => 'giorni', 't' => $t, 'u2' => 'ore', 't2' => $r];
            }
        }
        // ANNI
        if($bft >= 31536000 && $bft < 3153600000) {
            //echo "$count ) Entrato in A ($bft)<br>";
            $t = ceil($bft/60/60/24/365); // trasformo in anni
            $r = ceil($bft%60%60%24%365); // giorni restanti
            // se è un'unità singola cambio valore all'unità di misura
            if($t == 1) {
                $res[] = ['u' => 'anno', 't' => $t, 'u2' => 'giorni', 't2' => $r];
            }
            else {
                $res[] = ['u' => 'anni', 't' => $t, 'u2' => 'giorni', 't2' => $r];
            }
        }
        // SECOLI
        if($bft >= 3153600000) {
            //echo "$count ) Entrato in Secoli ($bft)<br>";
            $t = ceil($bft/60/60/24/365/100); // trasformo in secoli
            $r = ceil($bft%60%60%24%365%100); // anni restanti
            // se è un'unità singola cambio valore all'unità di misura
            if($t == 1) {
                $res[] = ['u' => 'secolo', 't' => $t, 'u2' => 'anni', 't2' => $r];
            }
            else {
                $res[] = ['u' => 'secoli', 't' => $t, 'u2' => 'anni', 't2' => $r];
            }
        }
    }
    
    
    return $res;
}