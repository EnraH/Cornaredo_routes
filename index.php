<!Doctype html>
<?php

// Turn on all error reporting
error_reporting(E_ALL);

?>

<html>
<head>
<link rel="stylesheet" href="style.css">
</head>

<!--<body>
<div id="header">
        <img src="img/img_2780.jpg"  alt="icits">
</div>-->
<div>
<?php
$con = mysqli_connect('localhost','climber','Cornaredo','cornaredo_routes');
if (!$con)
{
  die('Could not connect: ' . mysqli_error($con));
}
# mysqli_select_db($con,"vtiger_cf_640");
$result = mysqli_query($con,"SELECT * FROM routes");

echo '<select name="bcls" id="bcls">';
echo '<option value="">Select a route</option>';

while($row = mysqli_fetch_array($result))
{
  echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
}

echo '</select>';
?>
</div>

</body>
</html>
