//Elegxos gia ton an enas user einai loged in
window.onload = function() {
  var cook = "0";
  cook = getCookie("sweet-cookie");
  if(cook==null) {
    document.getElementById("logout").style.display = "none";
    document.getElementById("housereg").style.display = "none";
    document.getElementById("login").style.visibility = "visible";
    document.getElementById("house_reserve").style.display = "none";
    document.getElementById("my_profile").style.display = "none";


  } else {
    document.getElementById("login").style.display = "none";
    document.getElementById("signup").style.display = "none";
  }
}

function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}
