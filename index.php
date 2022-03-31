<!DOCTYPE html>
<html>
    <head>
        <title>Cards</title>
        <script crossorigin src="https://unpkg.com/react@17/umd/react.development.js"></script>
        <script crossorigin src="https://unpkg.com/react-dom@17/umd/react-dom.development.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://unpkg.com/@babel/standalone/babel.min.js"></script> 
        <link rel="stylesheet" href="css/main.css"> 
        <link rel="stylesheet" href="css/test.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="js/fn.js"></script>
    </head>
    <body>       
        <div class="topnav">
            <a class="active" href="#home">Home</a>
            <a href="pages/login.php">Login</a>
            <a href="pages/registrati.php">Registrati</a>
            <a href="pages/mostra_utenti.php">Mostra utenti</a>
            <a href="" onclick='delete_cookie("COOK","/","localhost");'>Sloggati</a>
            <a href="pages/carrello.php">Carrello</a>
            <a href="pages/nuovo_prodotto.php">Prodotto</a>
        </div>
        <div class="big-container" id="main">
            
        </div>
        <footer>           
            <?php
            require "backend/functions.php";
                if(!isset($_COOKIE["COOK"])){
                        echo "<h1>Benvenuto</h1>";
                        echo "<p>Vai a loggarti oh</p>";
                }else{
                    $token=$_COOKIE["COOK"];
                    if(verify($token)){
                        $c = content($token);  
                        echo "<h1>Bentornato</h1>";
                        echo "<p>ultimo accesso il ".$c->LastLogin."</p>";
                    }else{
                        echo "<h1>Biricchino</h1>";
                    }                    
                }
            ?>
        </footer>
    </body>
    <script type="text/babel" src="js/main.jsx"></script>
</html>
