function getRndInteger(min, max) {
    return Math.floor(Math.random() * (max - min) ) + min;
}
function getCard(product){
  cardN = product.COD;
  prodName= product.NOME;
  prezzo = product.PREZZO;
  link= product.LINK;
    return "<div class=\"container\" id=\"card-"+ cardN+"\">"+
           "<div class=\"card\">"+
           "<img id=\""+cardN+"\" src=\""+link+"\">"+
           "<p id=\"testo-"+cardN+"\">"+prodName+"</p>"+
           "<div class=\"btn_holder\">"+
           "<input type='text' id='qta"+cardN+"'>"+
           "<button class=\"fill\" id=\"bot\" onclick=\"addProduct("+cardN+","+"document.getElementById('qta"+cardN+"').value"+")\" >CLICK</button>"+
           "</div></div></div>\n"
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