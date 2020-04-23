window.onload = function() {
  var selectedFile = document.getElementById('input').files[0];
  document.getElementById("user_avatar").src = selectedFile;
}
