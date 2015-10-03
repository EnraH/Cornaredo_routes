<?php
  $location=$_POST["loc"];
  $con = mysqli_connect('localhost','climber','Cornaredo','cornaredo_routes');
  if (!$con)
  {
    die('Could not connect' .  mysqli_error($con));
  }
  $result_gen = mysqli_query($con, "SELECT p1,p2,p3,p4,p5,p6,p7,p8,p9,p10 FROM routes WHERE location='" . $location . "'");
  
  while( $row = mysqli_fetch_array($result_gen))
  {
    foreach ( $row as $p) {
      if ( $p != NULL ) {
        $pics[] = $p;
      }
    }
  }
  $unique_pics = array_unique( $pics);
  foreach ($unique_pics as $p) {
    echo '<img src="img/blocks/' . $p . '" class="img-rounded prev_block" id="' . $p . '" height="220px">';
  }

?>

