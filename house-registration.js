function sizeCheck() {
    var input, file,elm,form;
    input = document.getElementById('file');
    form=document.getElementById("mainform")
    file = input.files[0];

    if(file.size>16777215) {
        input.value=null;
        elm = document.createElement("p");
        elm.innerHTML = "File " + file.name +" "+file.size+ " bytes is too big. Max acceptable size is 16777215 bytes." ;
        form.appendChild(elm);
      }

}
