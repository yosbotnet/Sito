<html>
    <head>
        <link rel="stylesheet" href="../css/form.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="../js/fn.js"></script>
        <script>
          $("#registrati").submit(function(e) {
              e.preventDefault();
          });
          function checkForm(){
            let allAreFilled = true;
            document.getElementById("registrati").querySelectorAll("[required]").forEach(function(i) {
              if (!allAreFilled) return;
              if (!i.value) allAreFilled = false;
              if (i.type === "radio") {
                let radioValueCheck = false;
                document.getElementById("registrati").querySelectorAll(`[name=${i.name}]`).forEach(function(r) {
                  if (r.checked) radioValueCheck = true;
                })
                allAreFilled = radioValueCheck;
              }
            })
            if (!allAreFilled) {
              alert('RIEMPIRE TUTTI I CAMPI');          
            }
            return allAreFilled;
          }
          
          function register(){
            if(checkForm()){
                nome=document.getElementById("fname").value
                cognome=document.getElementById("lname").value
                email=document.getElementById("mail").value
                password=document.getElementById("pwd").value
                $.ajax({
                  type: "POST",
                  url: "/backend/product.php",
                  dataType: "text",
                  data: {REQTYPE:"Reg",fn:nome,ln:cognome,mail:email,pwd:password},
                  success: function( result ){
                    console.log(result)
                    if(result=="EXISTING"){
                      alert("Account gia esistente")
                    }else{
                      alert("Creazione account riuscita")
                      window.location.href="/"
                    }
                    return result;
                  },
                  failure:function(r){
                    alert("Backend is down")
                  }
                });
              
          }
          }
        </script>
        <title>Registrati</title>
    </head>
    <body>
        <form id="registrati"  onsubmit="return false" method="post">
            <div class="row">
              <div class="col-25">
                <label for="fname">Nome</label>
              </div>
              <div class="col-75">
                <input type="text" id="fname" name="firstname" placeholder="inserisci il nome" required>
              </div>
            </div>
            <div class="row">
              <div class="col-25">
                <label for="lname">Cognome</label>
              </div>
              <div class="col-75">
                <input type="text" id="lname" name="lastname" placeholder="Rossi" required>
              </div>
            </div>
            <div class="row">
              <div class="col-25">
                <label for="mail">Mail</label>
              </div>
              <div class="col-75">
                <input type="text" id="mail" name="mail" placeholder="ciao" required>
              </div>
            </div>
            <div class="row">
              <div class="col-25">
                <label for="pwd">Password</label>
              </div>
              <div class="col-75">
                <input id="pwd" type="password" name="pwd" placeholder="12345" required>
              </div>
            </div>
            <br>
            <div class="row">
              <input type="submit" value="Submit" onclick="register()">
            </div>
            </form>
    </body>
    
</html>