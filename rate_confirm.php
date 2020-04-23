<?php
//Selida pou 8a vazei sth vash to comment kai to va8mo
define('DB_USER', 'adam');
define('DB_PASSWORD', 'root');
define('DB_HOST', 'localhost');
define('DB_NAME', 'airBNB');

$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if (mysqli_connect_errno())
{
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$spiti = $_GET['user'];
$user = $_COOKIE["sweet-cookie"];

$reserv_Id = $_POST["reservationId"];

$comment = $_POST["house_comment"];

$stars = $_POST["rating"];

$sql="UPDATE airbnb.reservations SET rating='$stars',comment='$comment' WHERE reservations.id='$reserv_Id';";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully!";
    echo "<br>";
    echo "Thank you for rating.";
    echo "<br>";
    //header("Location: index.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

<html>
<head>
  <title>Rating</title>
  <style>
    body {
      font-family:Circular,-apple-system,BlinkMacSystemFont,Roboto,Helvetica Neue,sans-serif;
      color: #484848;
    }

    a {
      text-decoration: none;
      color: #008489;
    }

    a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <a href="index.php">Continue</a>
</body>
</html>
