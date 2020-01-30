<?php

//flush();
ob_flush();

$pagename="R€\$V|_T\$";

// Requirements
require_once 'functions.php';
require_once 'template.php';



// Variabili per la formula
$pw = $_POST['pw'];
$L = strlen($pw); //lunghezza della pw
$alfa = 0; // Alfabeto: numero di simboi che contiene la pw
$K = 0; // spazio delle chiavi --> pow($alfa,$L); (<-- formula)
//$K = pow(96,12); // prova

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
//$E = ceil($E); // arrotondo per eccesso (come da convenzione)


echo "PW: ".$pw;
echo "<br>Lunghezza PW: ".$L;
echo "<br>Lunghezza Alfabeto: ".$alfa;
echo "<br>Spazio delle chiavi: ".$K;
echo "<br>Entropia: ".$E;

// TODO
/*
 * Formattare meglio
 * Aggiungere calcolo del Brute force
 * Inserire una landing page che spiega come funziona ed eventualmente dove reperire il sorgente
 * 
 */ 



?>
<br><br><br><br><br>
<a style="color:blue" href="index.php">Torna Indietro </a>