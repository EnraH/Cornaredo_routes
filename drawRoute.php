  <?php
    $id=$_POST["id"];
    $con = mysqli_connect('localhost','climber','Cornaredo','cornaredo_routes');
    if (!$con)
    {
      die('Could not connect' .  mysqli_error($con));
    }
    $result_gen = mysqli_query($con, "SELECT * FROM routes WHERE id =" . $id );
    
    while( $row = mysqli_fetch_array($result_gen))
    {
      $img_size = getimagesize( 'img/blocks/'.$row['p1']);
      echo '<svg height="'. $img_size[1].'" width="'. $img_size[0] .'">';
      echo '<image id="testimg1" xlink:href="img/blocks/' . $row['p1']. '" width="' . $img_size[0] . '" height="' . $img_size[1] . '" x="0" y="0"/>';
      echo '<g stroke="red" stroke-width="3" fill="red">';
      for ( $i=1; $i <= 20; $i +=1) {
        if ( $row[ 4 + $i ] != NULL AND $row[24 + $i] != NULL ) {
          echo '<circle id="p' . $i . '" cx="' . $row[4+$i] . '" cy="' . $row[24+$i] . '" r="3" />';
          echo '<text x="' . $row[4+$i] . '" y="' . $row[24+$i] . '" dy="+20">' . $i . '</text>';
        } 
      }
      echo '</g>';
      echo '</svg>';
    }
  ?>

