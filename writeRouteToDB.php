<?php
ini_set('display_errors', 1);
error_reporting(~0);
echo (integer)ini_get('display_errors');
// Unescape the string values in the JSON array
$coords = stripcslashes($_POST['pTableData']);
$name = $_POST['name'];
$location = $_POST['location'];
$creator = $_POST['creator'];
$grade = $_POST['grade'];


// Decode the JSON array
$coords = json_decode($coords,TRUE);

$mysqli = new mysqli("localhost", "climber", "Cornaredo", "cornaredo_routes");

/* check connection */
if (mysqli_connect_errno()) {
  printf("Connect failed: %s\n", mysqli_connect_error());
  exit();
}

$query = "INSERT INTO routes ('name', 'creator', 'location', 'grade') VALUES ('$name', '$creator', '$location', '$grade')";

$mysqli->query($query);

$i = 0;
foreach ($coords as $row) {
  if ( $i <= 20 ) {
    $query = "UPDATE routes SET x{$i}='$row['X']', y{$i}='$row['Y'] ' WHERE id = '{$mysqli->insert_id}')";
    $mysqli->query($query);
  }
  $i++;
}
?>
