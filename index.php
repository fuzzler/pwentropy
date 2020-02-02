<?php

/* Questa applicazione analizza un indirizzo IP e restituisce le informazioni su di esso
 * come ad esempio il tipo di rete, se è un ip di host, broadcast o di rete ...
 *
 * 
 * App by Fuzz
 */

 // Variabili importanti
$pagename = "Indecks"; // Nome della pagina (richiesto nel template)

// Requirements
require_once 'template.php';


?>
<div class="container-fluid">

<div class="row">
    <div class="col-2"></div>

    <div class="col-8">

        <h1 class="titolo">Pagina Principale dell'App <?php echo NOME_APP?></h1>
    
    </div>

    <div class="col-2"></div>
</div> <!-- fine row1 -->

<div class="row">
    <div class="col-3"></div>

    <div class="col-6">

    <br><br>
        <div class="txtcenter">
            <span class="txtbolder txtcenter">Inserisci la PW di cui vuoi calcolare l'Entropia</span>
        </div>
        <br>
        <div class="form-group">
            <form action="result.php" method="POST">

            <?php
                if(isset($_SESSION['err_pw_short'])) {
                    echo "<div class=\"txtcenter\"><span class=\"err_mess\">";
                    echo $_SESSION['err_pw_short']."</span></div>";
                }

            ?>
                <input class="form-control" type="password" name="pw" placeholder="Inserisci QUI la Pà$5vv0rd" required><br>

                <div style="text-align: center">
                    <input style="margin: 0 auto" type="submit" name="anal" value="CALCOLA" class="pulsante">
                </div>
            </form>
        </div>
        <br>
        </div>
       
        <div class="col-3"></div>
    </div> <!-- fine row2 -->

    <div class="row">
        <div class="col-2">
            <br>
            <br>
            <br>
            <a href="../reset.php">TORNA INDIETRO</a>
        </div>
        <div class="col-8"></div>
        <div class="col-2"></div>
    </div>
  
</div> <!-- fine container -->
