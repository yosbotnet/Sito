<html>
    <!-- TODO: spostare la backend in product.php -->
    <head>
    <link rel="stylesheet" href="../css/mostra.css">
    <script src="../js/fn.js"></script>
    <title>Utenti</title>
    </head>
    <body>
    <nav>
            <a href="../index.php" class="active">Home</a>
        </nav>
        <div class="STFU">
        <table>
            <tr>
                <th>ID PROD</th>
                <th>QTA</th>
                <th>PREZZO</th>
                <th>NOME</th>
            </tr>
            <?php
            require '../backend/functions.php';
            $pdo = new PDO("mysql:host=localhost;port=7777","root","mysql");
            $pdo->exec("use eserciziologin");
            if(isset($_COOKIE['COOK'])){
                if(!verify($_COOKIE['COOK'])){
                    exit();
                }
                $c=content($_COOKIE['COOK']);
                $utente=$c->Utente;
                $carrello = $pdo->query("select ID_PROD,QTA,PREZZO,prodotto.NOME from ordine inner join prodotto on ordine.id_prod = prodotto.cod inner join utente on ordine.id_utente = utente.codice and utente.codice = '$utente'");
                $tab = $carrello->fetchAll(PDO::FETCH_ASSOC);
                //var_dump($tab);
                
                foreach($tab as $t){
                    echo "<tr>";
                    foreach($t as $l){
                        echo "<td>".$l."</td>";
                    }
                    echo "</tr>";
                }
            }
            
            ?>
        </table>
        </div>
    </body>
</html>