<?php
  $location=$_POST["loc"];
  $con = mysqli_connect('localhost','climber','Cornaredo','cornaredo_routes');
  if (!$con)
  {
    die('Could not connect' .  mysqli_error($con));
  }
  $result_gen = mysqli_query($con, "SELECT (p1,p2,p3,p4,p5,p6,p7,p8,p9,p10) FROM routes WHERE location =" . $location);
  
  $pics = array();
  while( $row = mysqli_fetch_array($result_gen))
  {
    for ($i=1; $i<=10; $i+=1) {
      if ( $row[ 45 + $i ] != NULL ) {
        $pics[] = $row[ 45 + $i ];
      }
    }
  }
  $unique_pics = array_unique( $pics);

  foreach( $unique_pics as $pic ) {
    echo '<a href="img/blocks/' . $pic . '" data-lightbox="roadtrip">Block pic ' . $pic '</a>';
  }
?>

