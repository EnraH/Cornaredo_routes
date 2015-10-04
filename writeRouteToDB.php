<?php
ini_set('display_errors', 1);
error_reporting(~0);
echo (integer)ini_get('display_errors');
// Unescape the string values in the JSON array
$coords = stripcslashes($_POST['pTableData']);
$name = $_POST['name'];
$location = $_POST['loc'];
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


$query = "INSERT INTO routes (name, creator, location, difficulty) VALUES ('$name', '$creator', '$location', '$grade')";
//echo $query . '<br>';

$mysqli->query($query);

//echo $mysqli->insert_id;

$i = 1;
foreach ($coords as $row) {
  if ( $i <= 20 && $row['X'] != NULL && $row['Y'] != NULL ) {
    $query = "UPDATE routes SET x{$i}='{$row['X']}', y{$i}='{$row['Y']}' WHERE id = '{$mysqli->insert_id}')";
    //echo $query;
    $mysqli->query($query);
    $i++;
  }
}
?>
