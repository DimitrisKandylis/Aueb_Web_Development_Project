<?php
  //Pairnoume ta stoixeia pou symplhrwnei o user
  $arrival = date($_POST["arrival"]);
  $departure = date($_POST["departure"]);
  $visitors = $_POST["visitors"];
  $username = $_COOKIE["sweet-cookie"];
  $house_id = $_POST["house_id"];;

  define('DB_USER', 'adam');
  define('DB_PASSWORD', 'root');
  define('DB_HOST', 'localhost');
  define('DB_NAME', 'airBNB');

  $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  if ($conn->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') '
    . $mysqli->connect_error);
  }

  //Elegxos etsi wste o user na mhn kleisei to spiti otan den ginetai
  $sql="SELECT * FROM airbnb.reservations WHERE arrival='$arrival'";
  $result = mysqli_query($conn,$sql);
  $num_rows = mysqli_num_rows($result);
  if($num_rows!=0) {
    echo "This room is not availabe at that specific time.";
    echo "<br>";
    echo "Try another date.";
    echo "<br>";
  } else {
    $sql="INSERT INTO airbnb.reservations (username,house_id,arrival,departure,visitors)
        VALUES ('$username','$house_id','$arrival','$departure','$visitors')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
        header("Location: index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }

  $conn->close();
?>
<html>
<head>
  <title>Unavailable Date</title>
  <style>
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
  <a href="javascript:history.back()">Go Back</a>
</body>
</html>
