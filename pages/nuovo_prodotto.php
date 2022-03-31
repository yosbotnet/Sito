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
                nome=document.getElementById("nome").value
                costo=document.getElementById("costo").value
                desc=document.getElementById("descrizione").value
                link=document.getElementById("link").value
                $.ajax({
                  type: "POST",
                  url: "/backend/product.php",
                  dataType: "text",
                  data: {REQTYPE:"NewProd",NOME:nome,COSTO:costo,DESC:desc,LINK:link},
                  success: function( result ){
                    console.log(result)
                    if(result=="SUCCESS"){
                        alert("OK");
                        window.location.href='/';
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
        <title>Registra prodotto</title>
    </head>
    <body>
        <form id="registrati"  onsubmit="return false" method="post">
            <div class="row">
              <div class="col-25">
                <label for="nome">Nome</label>
              </div>
              <div class="col-75">
                <input type="text" id="nome" name="nome" placeholder="inserisci il nome" required>
              </div>
            </div>
            <div class="row">
              <div class="col-25">
                <label for="costo">Costo</label>
              </div>
              <div class="col-75">
                <input type="number" id="costo" name="costo" placeholder="3" required>
              </div>
            </div>
            <div class="row">
              <div class="col-25">
                <label for="descrizione">descrizione</label>
              </div>
              <div class="col-75">
                <input type="text" id="descrizione" name="descrizione" placeholder="ciao" required>
              </div>
            </div>
            <div class="row">
              <div class="col-25">
                <label for="link">Link</label>
              </div>
              <div class="col-75">
                <input id="link" type="text" name="link" placeholder="12345" required>
              </div>
            </div>
            <br>
            <div class="row">
              <input type="submit" value="Submit" onclick="register()">
            </div>
            </form>
    </body>
    
</html>