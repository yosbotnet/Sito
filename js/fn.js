class preOrder{
  constructor(id,qty,nome,prezzo){
      this.id = id;
      this.qty = qty;
      this.nome = nome;
      this.prezzo = prezzo;
  }
}
function getRndInteger(min, max) {
    return Math.floor(Math.random() * (max - min) ) + min;
}
function delete_cookie( name, path, domain ) {
    if( get_cookie( name ) ) {
      document.cookie = name + "=" +
        ((path) ? ";path="+path:"")+
        ((domain)?";domain="+domain:"") +
        ";expires=Thu, 01 Jan 1970 00:00:01 GMT";
    }
  }
function get_cookie(name){
    return document.cookie.split(';').some(c => {
        return c.trim().startsWith(name + '=');
    });
}
function getCookie(name) {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) return parts.pop().split(';').shift();
}
function addCookie(name, path, domain,value){
  delete_cookie(name,path,domain);
  const d = new Date();
  d.setTime(d.getTime() + (365*24*60*60*1000));
  let expires = "expires="+ d.toUTCString();
  document.cookie = name + "=" + value + ";" + expires + ";path=/";
}
function deleteUser(cod){
  $.ajax({
      url: "/backend/product.php",
      data: {
        REQTYPE:"deleteUser",
        VICTIM:cod,
        COOK: getCookie("COOK"),
      },
      success: function( result ) {
        console.log(result);
        window.location.href = window.location.href;
      }
    });
}
function changePerms(cod){   
  $.ajax({
      url: "/backend/product.php",
      data: {
        REQTYPE:"changeUser",
        VICTIM:cod,
        COOK: getCookie("COOK"),
      },
      success: function( result ) {
        console.log(result);
        window.location.href = window.location.href;
      }
    });
}
function on(nome,img,testo,prezzo){
  document.getElementById("overlay").style.display = "flex";
  document.getElementById("nomeEsp").innerText=nome;
  document.getElementById("testoEsp").innerText=testo;
  document.getElementById("imgEsp").src=img;
  document.getElementById("prezzoEsp").innerText=prezzo+"€";
}
function off(){
  document.getElementById("overlay").style.display = "none";
}
function changeLang(){
  if(getCookie("lang")=="it"){
    addCookie("lang","/","localhost","en");
    $('[lang="en"]').show();
    $('[lang="it"]').hide();
    return;
  }
  if(getCookie("lang")=="en"){
    addCookie("lang","/","localhost","it");
    $('[lang="it"]').show();
    $('[lang="en"]').hide();
    return;
  }
}