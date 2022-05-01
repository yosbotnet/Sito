<?php
    require("functions.php");
    session_start();
    $TABELLE=array("ordine","prodotto","utente");
    $pdo = new PDO("mysql:host=localhost;port=7777","root","mysql");
    $verifica = $pdo->query("USE eserciziologin");
    $f = fopen("log.txt",'a');
    error_reporting(E_ALL ^ E_NOTICE);
    if(!$verifica){
        $pdo->exec("CREATE DATABASE eserciziologin");
        $pdo->exec("USE eserciziologin");
        createTables($pdo);
    }else{
        $array = $pdo->query("show tables")->fetchAll(PDO::FETCH_COLUMN);
        foreach($TABELLE as $t){
            if(!contains($t,$array)){
               createTables($pdo);
            }
        }
    }
    if(isset($_GET["REQTYPE"])){
        switch($_GET["REQTYPE"]){
            case "Add":
                $productID=$_GET["PRODID"];
                $jwt=$_GET["COOK"];
                if(!verify($jwt)){
                    echo "FAKE COOKIE";
                    break;
                }
                $data = content($jwt);
                $qta=$_GET["QTA"];
                $user=$data->Utente;
                //Costo da implementare
                $sql ="insert into ordine value($productID,'$user',$qta,90)";
                $pdo->exec($sql);
                echo("SUCCESS");
                break;
            case "Get":
                $pro = $pdo->query("select * from prodotto");
                $prodotti= $pro->fetchAll(PDO::FETCH_ASSOC);
                echo json_encode($prodotti);
                break;
            case "JWTV":
                $obj=$_GET["p1"];
                if(verify($obj)){
                    echo "TRUE";
                }else{
                    echo "FALSE";
                }
                break;
            case "deleteUser":
                $jwt=$_GET["COOK"];
                $cod=$_GET["VICTIM"];
                if(!verify($jwt)){
                    echo "FAKE COOKIE";
                    break;
                }
                $pp=content($jwt)->Utente;
                if(!isAdmin($pdo,$pp)){
                    echo "NO PERMS";
                    break;
                }
                $pdo->exec("delete from ordine where ID_UTENTE='$cod'");
                $pdo->exec("delete from utente where codice='$cod'");
                echo "SUCCESS";
                break;
            case "changeUser":
                $jwt=$_GET["COOK"];
                $cod=$_GET["VICTIM"];
                $NewPerm = 1;
                if(!verify($jwt)){
                    echo "FAKE COOKIE";
                    break;
                }
                $pp=content($jwt)->Utente;
                if(!isAdmin($pdo,$pp)){
                    echo "NO PERMS";
                    break;
                }
                if(isAdmin($pdo,$cod)){
                    $NewPerm=0;
                }
                $pdo->exec("update utente set perms=$NewPerm where codice='$cod'");
                echo "SUCCESS";
                break;
            default:
                break;
        }
    }
    if(isset($_POST['REQTYPE'])){
        switch($_POST['REQTYPE']){
            case "Reg":
                $codice=md5(rand());
                $pwd=md5($_POST['pwd']);
                $mail=$_POST['mail'];
                $codUn=false;
                while(!$codUn){
                  $sql = "select * from utente where id='$codice'";
                  $result = $pdo->query($sql);
                  if($result){
                    $codice=md5(rand());
                  }else{
                    $codUn=true;
                  }
                }
                $sql = "select * from utente where mail='$mail'";
                $result = $pdo->query($sql);
                if($result->rowCount()>0){
                  echo "EXISTING";
                  exit();
                }
                $nome=$_POST['fn'];
                $cognome=$_POST['ln'];              
                $sql="INSERT INTO UTENTE VALUES('$codice','$nome','$cognome','$mail','$pwd',0)";  
                $pdo->exec($sql);
                setcookie("COOK",encode($codice,date("d/m/Y")." alle ore ".date("H:i:s")),time()+9999999,'/');
                fwrite($f,"Created account ".$mail."\n");
                echo "SUCCESS";
                break;
            case "Login":
                $pwd=md5($_POST['pwd']);
                $mail=$_POST['mail'];
                $sql = "select * from utente where mail='$mail'";
                $result = $pdo->query($sql);
                $ut = $result->fetchAll(PDO::FETCH_ASSOC);
                if($result){
                    try{
                      if($ut[0]["password"]==$pwd){
                        setcookie("COOK",encode($ut[0]["codice"],date("d/m/Y")." alle ore ".date("H:i:s")),(time() + 31536000) , '/');
                        $_SESSION["USER"]=$ut[0]["codice"];
                        $_SESSION["PERMS"]=$ut[0]["perms"];
                        echo "SUCCESS";
                    }
                    }catch(Exception $e){
                      echo("FAIL");
                    }
                    if($ut==null){
                      echo("FAIL");
                    }                    
                }
                break;
            case "NewProd":
                $nome= $_POST["NOME"];
                $Costo=$_POST["COSTO"];
                $des= $_POST["DESC"];
                $link= $_POST["LINK"];
                $sql="insert into prodotto(nome,prezzo,des,link) values('$nome',$Costo,'$des','$link')";
                $pdo->exec($sql);
                echo "SUCCESS";
                break;
            default:
                break;
        }
    }
    function isAdmin($pdo,$cod){
        $isAdm=$pdo->query("select perms from utente where codice='$cod'");
        $perm=$isAdm->fetchAll(PDO::FETCH_COLUMN);
        if($perm[0]==1){
            return true;
        }
        return false;
    }
    function createTables($pdo){
        $pdo->exec("CREATE TABLE utente(codice varchar(32) primary key, nome text, cognome text, mail text, password text, perms int)");
        $pdo->exec("CREATE TABLE IF NOT EXISTS PRODOTTO(COD INT PRIMARY KEY not null AUTO_INCREMENT,NOME TEXT,ENGNOME TEXT,PREZZO INT,DES text,ENGDESC TEXT,LINK text)");
        $pdo->exec("CREATE TABLE IF NOT EXISTS ORDINE(ID_PROD INT,ID_UTENTE VARCHAR(32),QTA INT,CostoTot int, PRIMARY KEY(ID_PROD,ID_UTENTE),FOREIGN KEY(ID_PROD) REFERENCES PRODOTTO(COD),FOREIGN KEY(ID_UTENTE) REFERENCES UTENTE(CODICE))");
        $pdo->exec("insert into prodotto values(1,'testo ita','testo inglese',70,'>War is le bad',' i dont want that','img/1.webp')");
        $pdo->exec("insert into prodotto values(2,'King','Re',35,'test','nationalist king','img/0.webp')");
        $pdo->exec("insert into utente values('cfcd208495d565ef66e7dff9f98764da','admin','admin','admin@admin.admin','21232f297a57a5a743894a0e4a801fc3',1)");
 
    }
    fclose($f);
    $pdo = null;
    
?>