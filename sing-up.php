<?php
define('DB_USER', 'adam');
define('DB_PASSWORD', 'root');
define('DB_HOST', 'localhost');
define('DB_NAME', 'airBNB');

$username=$_POST["username"];
$pass=$_POST["password"];
$re_pass=$_POST["confirm_password"];
$fname=$_POST["fname"];
$lname=$_POST["lname"];
$email=$_POST["email"];
$place=$_POST["place"];
$description=$_POST["description"];

$avatar=addslashes($_FILES['avatar']['tmp_name']);
$avatar=file_get_contents($avatar);
$avatar=base64_encode($avatar);

$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if ($conn->connect_error) {
  die('Connect Error (' . $mysqli->connect_errno . ') '
  . $mysqli->connect_error);
}

//Insert twn stoixeiwn tou user sth vash
$sql="INSERT INTO users VALUES ('$username','$pass','$fname','$lname','$avatar','$email','$place','$description')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
    header("Location: index.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
