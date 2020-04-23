<?php
define('DB_USER', 'adam');
define('DB_PASSWORD', 'root');
define('DB_HOST', 'localhost');
define('DB_NAME', 'airBNB');




    $title=$_POST["title"];
    $location=$_POST["location"];
    $description=$_POST["description"];
    $check_in=$_POST["checkin"];
    $check_out=$_POST["checkout"];
    $type=$_POST["type"];
    $visitors=$_POST["visitors"];
    $price=$_POST["price_per_night"];

    $picture=addslashes($_FILES['picture']['tmp_name']);
    $picture = mysql_real_escape_string($_FILES['picture']['tmp_name']);
    $picture=file_get_contents($picture);
    $picture=base64_encode($picture);

    $owner=$_COOKIE["sweet-cookie"];



  $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  if ($conn->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') '
    . $mysqli->connect_error);
  }


  $sql="INSERT INTO airbnb.houses (title,image,location,description,check_in,check_out,type,visitors,owner_name,price)
   VALUES ('$title','$picture','$location','$description','$check_in','$check_out','$type','$visitors','$owner','$price')";

// TODO: connect it with the user

  $username = 0;
  $sql3 = "SELECT username FROM airbnb.users WHERE username='$owner'";
  if ($result=mysqli_query($conn,$sql3))
    {
    // Fetch one and one row
    while ($row=mysqli_fetch_row($result))
      {
        $username = $row['0'];
      }
    // Free result set
    mysqli_free_result($result);
  }

  $sql2="INSERT INTO airbnb.users_houses VALUES ('$username','$title')";


if ($conn->query($sql)) {
      echo "New record created successfully";
      header("Location: index.php");
  } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
  }
  $conn->close();


?>
