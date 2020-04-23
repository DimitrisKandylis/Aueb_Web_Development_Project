//Elegxos gia to password
var confPass = function() {
  var pass =document.getElementById("password");
  var conf_pass=document.getElementById("conf_password");
  if (pass.value ==conf_pass.value){
    pass.style.color = "green";
    conf_pass.style.color = "green";
    conf_pass.setCustomValidity("");
     document.getElementById('submit').disabled = false;
  } else{
    document.getElementById('submit').disabled = true;
    conf_pass.setCustomValidity("The passwords do not match!");
    conf_pass.click;
    pass.style.color = "red";
    conf_pass.style.color = "red";
  }
}

function sizeCheck() {
    var input, file,elm,form;
    input = document.getElementById('file');
    form=document.getElementById("form")
    file = input.files[0];

    if(file.size>16777215 ) {
        input.value=null;
        elm = document.createElement("p");
        elm.innerHTML = "File " + file.name +" "+file.size+ " bytes is too big. Max acceptable size is 16777215 bytes." ;
        form.appendChild(elm);
      }

}
