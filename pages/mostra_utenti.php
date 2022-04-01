<html>
    <head>
    <link rel="stylesheet" href="../css/mostra.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
                <th>CODICE</th>
                <th>nome</th>
                <th>cognome</th>
                <th>email</th>
                <th>pwd</th>
                <th>Perms</th>
            </tr>
            <?php
            session_start();
            if(!isset($_SESSION["PERMS"])||$_SESSION["PERMS"]!=1){
                echo "<script>alert('ACCESSO NON PERMESSO');window.location.href='../index.php'</script>";
            }
            $pdo = new PDO("mysql:host=localhost;port=7777","root","mysql");
            $pdo->exec("use eserciziologin");
            $utenti = $pdo->query("select * from utente");
            if(!$utenti){
                echo "<!-- Nessun utente -->";
            }else{
                foreach($utenti->fetchAll(PDO::FETCH_ASSOC) as $u){
                    echo "<tr>";
                    foreach ($u as $v){
                        echo "<td>$v</td>";
                    }
                    $cod=$u["codice"];
                    echo "<td><button onclick='deleteUser(\"$cod\")'>cancella</button><button onclick='changePerms(\"$cod\")'>Cambia Permessi</button></td>";
                    echo "</tr>";
                }
            }
            
            $pdo=null;
            ?>
        </table>
        </div>
        
    </body>
    
</html>