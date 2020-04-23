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

$username = $_GET['user'];
$loged_user = $_COOKIE['sweet-cookie'];

//Elegxos sth vash gia to an yparxei o user
$sql="SELECT * FROM airbnb.users WHERE username='$username'";
$result = mysqli_query($conn,$sql);
$num_rows = mysqli_num_rows($result);
if($num_rows==0) {
  header("Location: error_page.html");
}

//Pairnoume ta stoixeia tou user apo thn vash
if ($result=mysqli_query($conn,$sql)) {
  while ($row=mysqli_fetch_row($result))    {
      $username = $row['0'];
      $fname = $row['2'];
      $lname = $row['3'];
      $avatar = $row['4'];
      $email = $row['5'];
      $place = $row['6'];
      $description = $row['7'];
  }
    mysqli_free_result($result);
}

//gemisma ths listas me ta spitia pou tou anhkoun
$house_pinakas = array();
$sql2="SELECT title FROM airbnb.houses WHERE owner_name='$username'";
if ($result2=mysqli_query($conn,$sql2)) {
  while ($row2=mysqli_fetch_row($result2))
    {
      $house_pinakas[] = $row2['0'];
    }
  mysqli_free_result($result2);
}

//gemisma ths listas me ta spitia pou 8a meinei
$house_pinakas2 = array();
$sql4 = "SELECT title FROM airbnb.houses,airbnb.reservations WHERE reservations.username='$username' AND reservations.house_id=houses.id AND arrival>DATE(NOW())";
if ($result=mysqli_query($conn,$sql4)) {
  while ($row=mysqli_fetch_row($result))
    {
      $house_pinakas2[] = $row['0'];
    }
  mysqli_free_result($result);
}

//gemisma ths listas me ta spitia pou exei meinei
$house_pinakas3 = array();
$house_pinakas4 = array();
$sql5 = "SELECT houses.title,reservations.id FROM airbnb.houses,airbnb.reservations WHERE reservations.username='$username' AND reservations.house_id=houses.id AND arrival<DATE(NOW())";
if ($result=mysqli_query($conn,$sql5)) {
  while ($row=mysqli_fetch_row($result))
    {
      $house_pinakas3[] = $row['0'];
      $house_pinakas4[] = $row['1'];
    }
  mysqli_free_result($result);
}
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
  <title><?php echo $username ?> Profile</title>
  <script src="session-conf.js"></script>
  <style>
    table {
        width: 100%;
        border-collapse: collapse;
    }

    .myhouse {
      text-decoration: none;
      color: #008489;
    }

    .myhouse:hover {
      text-decoration: underline;
      color: #008489;
    }

    .myhouse:visited {
      color: #008489;
    }

    table, td, th {
        border: 1px solid black;
        padding: 5px;
    }

    a {
    	text-decoration: none;
    	color: #008489;
    }

    a:hover {
      text-decoration: underline;
    }

    th {text-align: left;}
  </style>
  <link href="style_user_profile.css" rel="stylesheet" type="text/css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
  <div id="top-menu">
		<a href="index.php"><img src="home-icon.png"></img></a>
		<a href="house-registration.html" id="housereg" class="links">House Registration</a>
		<a href="Login.html" id="login" class="links">Login</a>
    <a href="logout.php" id="logout" class="links">Log Out</a>
		<a href="sign-up.html" id="signup" class="links">Sign-Up</a>
	</div>
	<hr>

  <!--Ta stoixeia tou user-->
  <?php  echo ' <img id="user_avatar" width="300" height="250"  src="data:image;base64,'.$avatar.' ">'   ?>
	<form id="info">
		<fieldset>
			<label>Information about me</label><br>
			<hr>
			<label id="firstname"><?php echo $fname ?></label>
			<label name="lastname"><?php echo $lname ?></label><br>
			<label name="email"><?php echo $email ?></label><br>
      <label name="description"><?php echo $description ?></label><br>
		</fieldset>
	</form>
	<form id="user" action="user-php.php" method="GET">
		<label class="titlos"><b>Hello, my name is </b></label><label class="titlos" name="name"><b><?php echo $username ?></b></label><br>
		<label id="place" name="place"><?php echo $place ?></label><br>
	</form>

  <!--Lista me ta spitia pou tou anhkoun-->
	<div id="myhouse">
		<label><b>My Houses:</b></label><br>
		<ul id="my_houses" name="my_houses">
		</ul><br>
	</div>

  <!--script gia gemisma ths listas me ta spitia pou tou anhkoun-->
  <script>
    var i;
    var j = <?php echo count($house_pinakas);?>;
    var content = new Array();
    <?php foreach($house_pinakas as $key => $val){ ?>
        content.push('<?php echo $val; ?>');
    <?php } ?>

  	for (var i = 0; i < content.length; i++) {
  		var name = content[i];
  		var ul = document.getElementById("my_houses");

      var a = document.createElement('a');
      var linkText = document.createTextNode(content[i]);
      a.appendChild(linkText);
      a.title = "my houses";
      var y = "dif-houses.php?user="+content[i];
      a.href = y;
      ul.appendChild(a);
      var br = document.createElement("br");
      ul.appendChild(br);
  	}
  </script>

  <!--Lista me ta spitia pou 8a meinei-->
	<div id="plans">
		<label><b>Future Plans:</b></label><br>
		<ul id="future_plans" name="future_plans">
		</ul><br>
	</div>

  <!--script gia gemisma ths listas me ta spitia pou 8a meinei-->
  <script>
    var i;
    var j = <?php echo count($house_pinakas2);?>;
    var content = new Array();
    <?php foreach($house_pinakas2 as $key => $val){ ?>
        content.push('<?php echo $val; ?>');
    <?php } ?>

  	for (var i = 0; i < content.length; i++) {
  		var name = content[i];
  		var ul = document.getElementById("future_plans");

      var a = document.createElement('a');
      var linkText = document.createTextNode(content[i]);
      a.appendChild(linkText);
      a.title = "my plans";
      var y = "dif-houses.php?user="+content[i];
      a.href = y;
      ul.appendChild(a);
      var br = document.createElement("br");
      ul.appendChild(br);
  	}
  </script>

  <!--Lista me ta spitia pou exei meinei-->
	<div id="past">
		<label><b>Rental History:</b></label><br>
		<ul id="past_vac" name="past_vac">
		</ul><br>
	</div>

  <!--script gia gemisma ths listas me ta spitia pou emeine sto parel8on-->
  <script>
    var i;
    var j = <?php echo count($house_pinakas3);?>;
    var content = new Array();
    <?php foreach($house_pinakas3 as $key => $val){ ?>
        content.push('<?php echo $val; ?>');
    <?php } ?>

  	for (var i = 0; i < content.length; i++) {
  		var name = content[i];
  		var ul = document.getElementById("past_vac");

      var a = document.createElement('a');
      var linkText = document.createTextNode(content[i]);
      a.appendChild(linkText);
      a.title = "my past reservations";
      var y = "dif-houses.php?user="+content[i];
      a.href = y;
      ul.appendChild(a);
      var br = document.createElement("br");
      ul.appendChild(br);
  	}
  </script>

  <!--button gia na kanei rate ta spitia pou exei episkeu8ei-->
  <button id="rate_button" <?php if(strcmp("$username","$loged_user")!=0) {?> disabled="disabled" <?php } ?>>Rate Houses</button>

  <!-- The Modal -->
  <div id="myModal" class="modal">

    <!-- Modal content -->
    <div class="modal-content">
      <span class="close">&times;</span>
      <p>The houses you have visited:</p>

      <!-- H lista me ta spitia pou exei paei gia na ta kanei rate -->
      <ul id="past_vac2" name="past_vac">
  		</ul><br>

      <!-- Script gia to gemisma ths listas -->
      <script>
      var i;
      var j = <?php echo count($house_pinakas3);?>;
      var content = new Array();
      <?php foreach($house_pinakas3 as $key => $val){ ?>
          content.push('<?php echo $val; ?>');
      <?php } ?>

      var content_id = new Array();
      <?php foreach($house_pinakas4 as $key => $val){ ?>
          content_id.push('<?php echo $val; ?>');
      <?php } ?>

      for (var i = 0; i < content.length; i++) {
        var name = content[i];
        var ul = document.getElementById("past_vac2");

        var a = document.createElement('a');
        var linkText = document.createTextNode(content[i]);
        a.appendChild(linkText);
        a.title = "my past reservations";
        var y = "rate.php?user="+content_id[i];
        a.href = y;
        ul.appendChild(a);
        var br = document.createElement("br");
        ul.appendChild(br);
      }
      </script>
    </div>

  </div>

  <!-- Script gia thn leitourgia tou Modal -->
  <script>
    // Get the modal
    var modal = document.getElementById('myModal');

    // Get the button that opens the modal
    var btn = document.getElementById("rate_button");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks the button, open the modal
    btn.onclick = function() {
        modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
  </script>

</body>
</html>
