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