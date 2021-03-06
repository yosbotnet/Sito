<!DOCTYPE html>
<html style="overflow-x:hidden;">
    <head>
        <title>Cards</title>
        <script crossorigin src="https://unpkg.com/react@17/umd/react.development.js"></script>
        <script crossorigin src="https://unpkg.com/react-dom@17/umd/react-dom.development.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://unpkg.com/@babel/standalone/babel.min.js"></script> 
        <link rel="stylesheet" href="css/main.css"> 
        <link rel="stylesheet" href="css/test.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.tailwindcss.com"></script>
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
                    setcookie("lang","it",time()+3600000,"/");
                }else{
                    echo '<a href="pages/login.php">Login</a><a href="pages/registrati.php">Registrati</a>';
                    
                }
            ?>
            <div class="dropdown">
                <button class="dropbtn">Lingua
                <i class="fa fa-caret-down"></i>
                </button>
                <div class="dropdown-content">
                  <a onclick="changeLang()">Ita</a>
                  <a onclick="changeLang()">Eng</a>
                </div>
              </div>
            <div id="carrello"></div>
            </div>
        </div>
        <h1>BARO'S COPIUM</h1>
        <div id="overlay" onclick="off()">
            <h1 id="nomeEsp"></h1>
            <p id="testoEsp"></p>
            <img id="imgEsp" src="" alt="">
            <p id="prezzoEsp"></p>
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
