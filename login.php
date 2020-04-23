<?php

$email=$_POST["email"];
$pass=$_POST["password"];

define('DB_USER', 'adam');
define('DB_PASSWORD', 'root');
define('DB_HOST', 'localhost');
define('DB_NAME', 'airBNB');

$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if ($conn->connect_error) {
  die('Connect Error (' . $mysqli->connect_errno . ') '
  . $mysqli->connect_error);
}

//Tsekaroume th vash gia to input pou mas edwse o user, kai an yparxei kanei login kai ftiaxnoume cookie
$sql="SELECT username FROM users WHERE pass='$pass' AND email='$email'";
$result = $conn->query($sql);

if (mysqli_num_rows($result)==1) {
  while($row = $result->fetch_assoc()) {
        $username=$row["username"];
    }

  echo "Successfull Login of User ";
  echo $username;
  $cookie_name = "sweet-cookie";
  $cookie_value = $username;
  setcookie($cookie_name,$cookie_value,time()+3600);
  header("Location: index.php");

} else {
  echo "Error: Unsuccessfull login!";
}

$conn->close();
?>

<html>
<head>
  <title>Error</title>
</head>
<body>
  <br>
  <img src="http://bhcourier.com/wp-content/uploads/2012/07/Ian-McKellen-as-Gandalf-The-Grey.jpeg"></img><br>
  <h3><a href = "Login.html" style="text-decoration: none;">Continue</a></h3>
</body>
</html>
