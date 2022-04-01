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
            <?php
                session_start();
                if(isset($_SESSION["USER"])){
                    echo '<a href="pages/logout.php" onclick=\'delete_cookie("COOK","/","localhost");\'>Logout</a>';
                    if(isset($_SESSION["PERMS"])&&$_SESSION["PERMS"]==1){
                        echo '<a href="pages/nuovo_prodotto.php">Prodotto</a><a href="pages/mostra_utenti.php">Mostra utenti</a>';
                    }
                }else{
                    echo '<a href="pages/login.php">Login</a><a href="pages/registrati.php">Registrati</a>';
                    
                }
            ?>
            <a href="pages/carrello.php">Carrello</a>
            <div id="carrello"></div>
            <!--
            <div class="cart-box">
                <table>
                    <tr><td>Numero</td><td>:</td><td>1</td></tr>
                    <tr><td>Costo</td><td>:</td><td>30</td></tr>
                </table>
                <div class="shop">
                    <img class="cart-img" src="img/cart.png"></img>
                    <div class="cart-preview">
                        <div class="cart-row">
                            <img src="img/based.jpg"></img>
                            <div class="info">
                                <p>Bimba</p>
                                <b>120€</b>
                            </div>
                            <div class="total">
                                <p>3n</p>
                                <p>69€<p>
                            </div>
                            <a>x</a>
                        </div>
                    </div>
                </div>
            -->
            </div>
        </div>
        <h1>BARO'S COPIUM</h1>
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
