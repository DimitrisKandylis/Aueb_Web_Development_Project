<?php
//Get to id tou reservation
$reservation_id = $_GET['user'];

?>

<!-- Selida sthn opoia 8a ginetai to rating apo ton user -->
<html>
<head>
  <title>Rating</title>
  <link href="rate.css" rel="stylesheet" type="text/css">
</head>
<body>
  <h2>Rate your experience and comment:</h2>
  <form id="rate" action="rate_confirm.php" method="post">
    <span class="rating">
  	  <input id="rating5" type="radio" name="rating" value="5">
  	  <label for="rating5">5</label>
  	  <input id="rating4" type="radio" name="rating" value="4">
  	  <label for="rating4">4</label>
  	  <input id="rating3" type="radio" name="rating" value="3">
  	  <label for="rating3">3</label>
  	  <input id="rating2" type="radio" name="rating" value="2">
  	  <label for="rating2">2</label>
  	  <input id="rating1" type="radio" name="rating" value="1">
  	  <label for="rating1">1</label>
  	</span>
    <br>
    <fieldset id="com">
      <legend>Comment</legend>
      <textarea id="com_text" name="house_comment"></textarea>
    </fieldset>
    <input type="hidden" name="reservationId" value="<?php echo $reservation_id; ?>" />
    <input type="submit" id="btn" value="Submit">
  </form>
</body>
</html>
