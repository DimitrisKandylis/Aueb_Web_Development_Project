<?php
if (isset($_COOKIE["sweet-cookie"])) {
    unset($_COOKIE["sweet-cookie"]);
    setcookie("sweet-cookie", null, -1, '/');
    echo 'Successful Logout.';
    echo '<br>';
    echo 'Cookie Removed!';
} else {
    echo 'No cookie found!';
}
?>
<html>
<head>
  <title>Log Out</title>
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
  <br>
  <a href="index.php">Continue</a>
</body>
</html>
