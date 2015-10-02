<!Doctype html>
<?php

// Turn on all error reporting
error_reporting(E_ALL);

?>

<html>
<head>
<link rel="stylesheet" href="style.css">
</head>

<body>
<div id="header">
        <img src="img/header.jpg" width="100%" alt="wall">
</div>
<div>
<?php
$con = mysqli_connect('localhost','climber','Cornaredo','cornaredo_routes');
if (!$con)
{
  die('Could not connect: ' . mysqli_error($con));
}
# mysqli_select_db($con,"vtiger_cf_640");
$result = mysqli_query($con,"SELECT * FROM grades");

echo '<select name="bcls" id="bcls">';
echo '<option value="">Grade</option>';

while($row = mysqli_fetch_array($result))
{
  echo '<option value="' . $row['id'] . '">' . $row['difficulty'] . '</option>';
}

echo '</select>';
?>
</div>
<div id="tableOutput">
  <?php
    $con = mysqli_connect('localhost','climber','Cornaredo','cornaredo_routes');
    if (!$con)
    {
      die('Could not connect' .  mysqli_error($con));
    }
    $result_gen = mysqli_query($con, "SELECT * FROM routes" );

    echo '<table id="output">';
    echo '<tr id="title"><td>Route Name</td><td>Grade</td><td>Creator</td></tr>';

    while( $row = mysqli_fetch_array($result_gen))
    {
      $grade = mysqli_fetch_assoc(mysqli_query( $con, "SELECT difficulty FROM grades WHERE grades.d_value = " . $row['difficulty']));
      echo '<tr id="' . $row['id'] . '" class="row"><td>';
      echo $row['name'] . '</td><td>'  . $grade['difficulty'] . '</td><td>' . $row['creator'] . '</td></tr>';
    }

        echo '</table>';
  ?>

</div>
<div id="route_picture">
  <?php
    $con = mysqli_connect('localhost','climber','Cornaredo','cornaredo_routes');
    if (!$con)
    {
      die('Could not connect' .  mysqli_error($con));
    }
    $result_gen = mysqli_query($con, "SELECT * FROM routes" );
    
    while( $row = mysqli_fetch_array($result_gen))
    {
      $img_size = getimagesize( 'img/'.$row['p1']);
      echo '<svg height="'. $img_size[1].'" width="'. $img_size[0] .'">';
      echo '<image id="testimg1" xlink:href="img/' . $row['p1']. '" width="' . $img_size[0] . '" height="' . $img_size[1] . '" x="0" y="0"/>';
      echo '<g stroke="red" stroke-width="3" fill="red">';
      for ( $i=1; $i <= 20; $i +=1) {
        //echo $i . '  ';
        //echo $row[4+$i] . '  ';
        //echo $row[24+$i] . '  ';
        if ( $row[ 4 + $i ] != NULL AND $row[24 + $i] != NULL ) {
          echo '<circle id="p' . $i . '" cx="' . $row[4+$i] . '" cy="' . $row[24+$i] . '" r="3" />';
          echo '<text x="' . $row[4+$i] . '" y="' . $row[24+$i] . '" dy="+20">' . $i . '</text>';
        } 
      }
      echo '</g>';
      echo '</svg>';
    }
  ?>
</div>
</body>
</html>
