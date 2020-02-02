<?php

//flush();
ob_flush();

$pagename="R€\$V|_T\$";

// Requirements
require_once 'functions.php';
require_once 'template.php';



// Variabili per la formula

// controllo che la pw immessa sia valida (almeno tre lettere)
if(strlen($_POST['pw'])<3){
    $_SESSION['err_pw_short'] = "La password deve essere di almeno 3 caratteri (e sono già pochi)";
    header('Location: index.php');
}
else {
    $pw = $_POST['pw'];
}

$L = strlen($pw); //lunghezza della pw
$alfa = 0; // Alfabeto: numero di simboi che contiene la pw
$K = 0; // spazio delle chiavi --> pow($alfa,$L); (<-- formula)
$stdK = pow(96,12); // spazio delle chiavi standard (include tutto)

/* Nota:
 * Lo spazio delle chiavi è dato dal numero di simboli inclusi nella pw (es. a-z)
 * elevato a lunghezza della stringa (pw)
 * K = S¹¹ (se la pw è lunga 11 caratteri)
 */

// variabili di responso
$E = 0; // Entropia (bit)
$level = ""; // livello di sicurezza (debole, forte, overkill)

// variabili per simulazione Brute Force
$nc = 1; // numero calcolatori (che eseguono il bf --> default 1)
$kps = 500000; // chiavi generate al secondo (default 500000 --> ma potrebbe essere molto di piu)


// Calcolo dell'alfabeto
$alfa = alfacalc($pw);


// Calcolo lo Spazio delle chiavi
$K = pow($alfa,$L);

// Calcolo dell'Entropia
$E = log($K,2);
$E = ceil($E); // arrotondo per eccesso (come da convenzione)

// Occulto parzialmente la PW (non deve vedersi in chiaro totalmente)
$pwocc = passwdOcc($pw);

// STAMPE
echo "PW: <b>".$pwocc."</b>";
echo "<br>Lunghezza PW:  <b>".$L."</b>";
echo "<br>Lunghezza Alfabeto:  <b>".$alfa."</b> (tipi di caratteri)";
echo "<br>Spazio delle chiavi:  <b>".$K."</b>";
echo "<br>Entropia:  <b>".$E."</b> (bit)";
echo "<br><br>";

// valutazione approssimativa del brute force
$bfres = bfEval($L,$K);

for($i=0; $i<count($bfres); $i++){
    echo "Pc ";
    
    switch($i) {
        case 0:
            echo "debole (casalingo -> script kidd): ";
        break;
        case 1:
            echo "normale (performance nella media attuale): ";
        break;
        case 2:
            echo "potente (da professionista del IT): ";
        break;
        case 3:
            echo "molto potente (hacker professionista): ";
        break;
        case 4:
            echo "NASA calculator (potentissimo): ";
        break;
        default:
            echo "(non specificato): ";
        break;
    }
    
    echo "<b>".$bfres[$i]['t']." ".$bfres[$i]['u']." ".$bfres[$i]['t2']." ".$bfres[$i]['u2']."</b><br>";
    
}

// Brute force (bozze)
/*
$a="aaaaaaaa";
$p="azzzzzzz"; // password provvisoria
$Ka = pow(26,8); // spazio delle chiavi di $a
echo "<br><br>";

echo "<br>";

$start = microtime(true);
$n = 0;

for($i=1; $i<=$Ka; $i++) {
    $a++;
    $n++;

    if(levenshtein($a,$p) == 0) {
        echo "<h3>Password $p trovata! all'interazione $i </h3>";
        break;
    }
    //if($i%3333==0) {echo "Sono arrivato all'interazione N° $i : Combinazione $a";}
    //echo "<br>";echo $a;
}

echo $a;echo "<br>";echo "<br>";
$end = microtime(true);
$time = number_format(($end - $start), 2);

echo "L'attacco ha impiegato $time secondi <br>Numero di chiavi generate in totale: $n<br>";
echo "Numero di chiavi generate al secondo: ".$n/$time;
*/

// TODO
/*
 * Formattare meglio
 * Aggiungere livello di sicurezza (debole,forte ...)
 * Aggiungere calcolo del Brute force
 * Inserire una landing page che spiega come funziona ed eventualmente dove reperire il sorgente
 * Tool che esegue un brute force
 * 
 */ 



?>
<br><br><br><br><br>
<a style="color:blue" href="reset.php">Torna Indietro </a>