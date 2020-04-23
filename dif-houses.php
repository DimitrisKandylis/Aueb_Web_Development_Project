<?php
define('DB_USER', 'adam');
define('DB_PASSWORD', 'root');
define('DB_HOST', 'localhost');
define('DB_NAME', 'airBNB');
$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if (mysqli_connect_errno())
{
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$loged = $_COOKIE["sweet-cookie"];

$q = (string)$_GET['user'];
$sql="SELECT * FROM airbnb.houses WHERE title='$q'";

//Elegxos gia na mhn kanei oti 8elei o user
$result = mysqli_query($conn,$sql);
$num_rows = mysqli_num_rows($result);
if($num_rows==0) {
  header("Location: error_page.html");
}

$housetitle = 0;

if ($result=mysqli_query($conn,$sql))
  {
  // Fetch one and one row
  while ($row=mysqli_fetch_row($result))
    {
      $id = $row['0'];
      $title = $row['1'];
      $picture = $row['2'];
      $location = $row['3'];
      $description = $row['4'];
      $check_in = $row['5'];
      $check_out = $row['6'];
      $type=$row['7'];
      $visitors=$row['8'];
      $houseowner=$row['9'];
      $price_per_night = $row['10'];

    }
  // Free result set
  mysqli_free_result($result);
}

////////////
$rating="Not set yet";

$sql="select avg(rating) from reservations
where house_id= $id
group by house_id";


$result = mysqli_query($conn,$sql);
$num_rows = mysqli_num_rows($result);
if($num_rows==0) {
  $rating="Not set yet.";
}

if ($result=mysqli_query($conn,$sql))
  {
  // Fetch one and one row
  while ($row=mysqli_fetch_row($result))
    {
    $rating=$row[0];

    }

    if($rating==null){
      $rating="Not set yet.";
    }
  // Free result set
  mysqli_free_result($result);
}




///////////

$user_link = "dif-users.php?user=".$houseowner;

$conn->close();
?>


<!DOCTYPE html>
<html>
<head>
  <title>House Page</title>
  <script src="dif-houses.js"></script>

  <style>
    table {
        width: 100%;
        border-collapse: collapse;
    }

    table, td, th {
        border: 1px solid black;
        padding: 5px;
    }

    th {text-align: left;}

    a {text-decoration: none;}

    .links{
      font-family:Circular,-apple-system,BlinkMacSystemFont,Roboto,Helvetica Neue,sans-serif;
      color: #484848;
      text-decoration: none;
      font-size: 120%;
      float: right;
      margin-left: 2%;
      margin-top: 1%;
    }

    .links:hover {
      text-decoration: underline;
    }

    #house_reserve{
      background-color: white;
      opacity: 0.9;

    }


  </style>

  <link href="style_house_page.css"rel="stylesheet" type="text/css">


</head>
<body>
  <div id="top-menu">
		<a href="index.php"><img src="home-icon.png"></img></a>
    <a href="dif-users.php?user=<?php echo $_COOKIE["sweet-cookie"] ;?>"  id="my_profile" class="links"><?php echo $_COOKIE["sweet-cookie"] ;?></a>
		<a href="house-registration.html" id="housereg" class="links">House Registration</a>
		<a href="Login.html" id="login" class="links">Login</a>
    <a href="logout.php" id="logout" class="links">Log Out</a>
		<a href="sign-up.html" id="signup" class="links">Sign-Up</a>

	</div>
  <hr>
  <div>
    <?php  echo ' <img id="house_img" width="100%" height="350"  src="data:image;base64,'.$picture.' ">'   ?>
	<div>
	<h4 id="house_type"><?php echo "Type: ".$type ?></h4>
 	<h1 id="house_title"><?php echo "Title: ".$title ?></h1>
	<h4 id="house_area"><?php echo $location ?></h4>
  <a id="theowner" href="<?php echo $user_link?>"><h5 id="owner"><?php echo $houseowner ?></h5></a>



  <script>
    var x = '<?php echo $loged; ?>';
    if(!x) {
      document.getElementById("theowner").href = "Login.html";
    }
  </script>

	<p id="house_description">
		<b>House Description:</b><br>
    <?php echo $description ?>
	</p>
	<p id="house_rules">
		<b>House Rules:</b><br>
		Check In: <?php echo $check_in ?><br>
    Check Out: <?php echo $check_out ?>
	</p>
  <label id="price-per-night">Price per Night: <?php echo $price_per_night ?></label><br>
	<!-- <label  id="page_critic" > Rating: <?php echo $rating ?> </label><br> -->
  <!-- Rating me asterakia -->
  <label id="asterakia">Stars: </label>
  <!-- Gemisma sta asterakia -->
  <script>
    if(<?php echo $rating ?>>=1) {
      var star = document.getElementById("asterakia");
      var a = document.createElement("SPAN");
      var linkText = document.createTextNode('☆');
      a.appendChild(linkText);
      star.appendChild(a);
    }
    if(<?php echo $rating ?>>=2) {
      var star = document.getElementById("asterakia");
      var a = document.createElement("SPAN");
      var linkText = document.createTextNode('☆');
      a.appendChild(linkText);
      star.appendChild(a);
    }
    if(<?php echo $rating ?>>=3) {
      var star = document.getElementById("asterakia");
      var a = document.createElement("SPAN");
      var linkText = document.createTextNode('☆');
      a.appendChild(linkText);
      star.appendChild(a);
    }
    if(<?php echo $rating ?>>=4) {
      var star = document.getElementById("asterakia");
      var a = document.createElement("SPAN");
      var linkText = document.createTextNode('☆');
      a.appendChild(linkText);
      star.appendChild(a);
    }
    if(<?php echo $rating ?>==5) {
      var star = document.getElementById("asterakia");
      var a = document.createElement("SPAN");
      var linkText = document.createTextNode('☆');
      a.appendChild(linkText);
      star.appendChild(a);
    }
  </script>
	<br>

	<form id="house_reserve" action="reservations.php" method="POST">
		<fieldset>
			<label> </label>
			<br>
			<label>Reserve this house</label>
      <input type="hidden" value="<?php echo $id ?>" name="house_id">
			<hr>
			<label class="reserve_labels">Arrival:</label>
			<br>
			<input type="date" id="arrival" name="arrival" required>
			<br>
			<label> </label>
			<br>
			<label class="reserve_labels">Departure:</label>
			<br>
			<input type="date" id="departure" name="departure" required>
			<br>
			<label> </label>
			<br>
			<label class="reserve_labels">Visitors:</label><br>
			<select id="visitors" name="visitors">
        <option>1 Visitor</option>
        <option>2 Visitors</option>
        <option>3 Visitors</option>
        <option>4 Visitors</option>
        <option>5 Visitors</option>
        <option>6 Visitors</option>
        <option>7 Visitors</option>
        <option>8 Visitors</option>
        <option>9 Visitors</option>
        <option>10 Visitors</option>
        <option>11 Visitors</option>
        <option>12 Visitors</option>
        <option>13 Visitors</option>
        <option>14 Visitors</option>
        <option>15 Visitors</option>
        <option>16 Visitors</option>
			</select>
			<br>
			<label> </label>
			<br>
			<button id="reserve">Submit Reservation</button>

		</fieldset>
	</form>
</body>
</html>
