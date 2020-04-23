<?php

define('DB_USER', 'adam');
define('DB_PASSWORD', 'root');
define('DB_HOST', 'localhost');
define('DB_NAME', 'airBNB');

$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
// Check connection
if ($conn->connect_error) {
  die('Connect Error (' . $conn->connect_errno . ') '
  . $conn->connect_error);
}

$sql = "SELECT title,image,location FROM airbnb.houses";
$house_pinakas = array();
$houses_images = array();
$house_location = array();

if ($result=mysqli_query($conn,$sql))
  {
  // Fetch one and one row
  while ($row=mysqli_fetch_row($result))
    {
      $house_pinakas[] = $row['0'];
      $houses_images[] = $row['1'];
      $house_location[] = $row['2'];
    }
  // Free result set
  mysqli_free_result($result);
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
  <title>User</title>
  <script src="session-conf.js"></script>

  <style>
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

    ul {
      list-style-type: none;
    }
    #friendsList a {
      text-decoration: none;
      color: #008489;
    }
    #friendsList a:hover {
      text-decoration: underline;
    }
    #friendsList a:visited {
      color: #008489;
    }
    body {
    	font-family:Circular,-apple-system,BlinkMacSystemFont,Roboto,Helvetica Neue,sans-serif;
    	color: #484848;
    }

  </style>

</head>
<body>
  <div id="top-menu">
		<a href="index.php"><img src="/home-icon.png"></img></a>
    <a href="dif-users.php?user=<?php echo $_COOKIE["sweet-cookie"] ;?>"  id="my_profile" class="links"><?php echo $_COOKIE["sweet-cookie"] ;?></a>
		<a href="house-registration.html" id="housereg" class="links">House Registration</a>
		<a href="Login.html" id="login" class="links">Login</a>
    <a href="logout.php" id="logout" class="links">Log Out</a>
		<a href="sign-up.html" id="signup" class="links">Sign-Up</a>
	</div>
  <hr>

  <!-- H dynamikh lista me tis perioxes -->
  <form id="areas">
    <h2>Select a specific area:</h2><br>
    <select id="area_list" onchange="listUpdater();">
        <option value="all" selected>*</option>
    </select>
  </form>

  <!-- Gemisma ths listas me tis perioxes -->
  <script>
    var i;
    var j = <?php echo count($house_location);?>;
    var content = new Array();
    <?php foreach($house_location as $key => $val){ ?>
        content.push('<?php echo $val; ?>');
    <?php } ?>

  	for (var i = 0; i < content.length; i++) {
  		var name = content[i];
  		var sel = document.getElementById("area_list");
      var z = document.createElement("option");
      z.setAttribute("value", content[i]);
      var t = document.createTextNode(content[i]);
      z.appendChild(t);
      sel.appendChild(z);
    }
  </script>

  <!-- H dynamikh lista me ta spitia -->
  <form id="house">
    <h2>Houses from all over the world:</h2>
    <ul id="friendsList"></ul>
  </form>

  <!-- To script gia to gemisma ths listas apo th vash -->
  <script>
    var i;
    var j = <?php echo count($house_pinakas);?>;
    var content = new Array();
    <?php foreach($house_pinakas as $key => $val){ ?>
        content.push('<?php echo $val; ?>');
    <?php } ?>

    var imgcontent = new Array();
    <?php foreach($houses_images as $key => $val){ ?>
        imgcontent.push('<?php echo $val; ?>');
    <?php } ?>

  	for (var i = 0; i < content.length; i++) {
  		var name = content[i];
      var imagelink = imgcontent[i];
  		var ol = document.getElementById("friendsList");

      var list = document.createElement('li');

      var a = document.createElement('a');
      list.appendChild(a);
      var img_link = document.createElement('IMG');
      img_link.src = "data:image;base64,"+imagelink;
      img_link.width = "150";
      img_link.height = "150";
      var linkText = document.createTextNode(content[i]);
      a.appendChild(img_link);
      a.appendChild(linkText);
      var y = "dif-houses.php?user="+content[i];
      a.href = y;
      ol.appendChild(list);
      var br = document.createElement("br");
      ol.appendChild(br);




      function listUpdater() {

        var location = new Array();

        <?php foreach($house_location as $key => $val){ ?>
            location.push('<?php echo $val; ?>');
        <?php } ?>


          var list = document.getElementById("area_list");
          var selectedLocation=list.value;


          var ul = document.getElementById("friendsList");
          var items = ul.getElementsByTagName("li");

          for (var i = 0; i < items.length; ++i) {
              items[i].style.display = "initial";


              if(selectedLocation=="all"){
                items[i].style.display = "initial";
              }
              else if(location[i]!=selectedLocation){
                items[i].style.display = "none";
              }


          }









      }

  	}
  </script>
</body>
</html>
