//Kanoume visible auta pou prepei na dei o user kai auta pou den prepei
//analoga me to an einai loged in 'h oxi
window.onload = function() {
  var cook = "0";
  cook = getCookie("sweet-cookie");
  if(cook==null) {
    document.getElementById("logout").style.display = "none";
    document.getElementById("housereg").style.display = "none";
    document.getElementById("login").style.visibility = "visible";
    document.getElementById("my_profile").style.display = "none";
  } else {
    document.getElementById("login").style.display = "none";
    document.getElementById("signup").style.display = "none";
  }
}

//Pairnoume to value tou cookie
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

function foo(obj){
  var popUpWindow;
  test1 = "http://localhost:8080/test/document.html?"+obj.innerHTML;
  popUpWindow.document.write('<iframe height="450" allowTransparency="true" frameborder="0" scrolling="yes" style="width:100%;" src="'+test1+'" type= "text/javascript"></iframe>');
}

function popup(n) {
   popUpWindow = window.open(n);
}
