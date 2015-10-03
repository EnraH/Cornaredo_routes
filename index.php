<!Doctype html>
<?php

// Turn on all error reporting
error_reporting(E_ALL);

?>

<html lang="en">
<head>
  <title>Bouldering routes</title>
  <meta charset="utf-8">

  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="style.css">
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

  <!-- Latest compiled JavaScript -->
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

  <!-- lightbox -->
  <link href="lightbox/lightbox.css" rel="stylesheet">

<script>
$(document).ready(function(){
    $(document).on("click","#route_table tr",function(){
      alert($(this).attr('id'));
      $.post("drawRoute.php",
        {
          id:$(this).attr('id'),
        },
        function(data,status){
          $("#route_picture").html(data);
        });
      });
    });
</script>

<script>
$(document).ready(function(){
    $("#loc_sel").change(function(){
      alert($(this).val());
      $.post("getBlockImg.php",
        {
          loc:$("#loc_sel").val();
        },
        function(data,status){
          $("#editor").html(data);
        });
      });
    });
</script>
</head>

<body>
<div id="header" class="container-fluid">
        <img src="img/header.png" width="100%" alt="wall">
</div>

<div class="container-fluid">
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

<div id="tableOutput" class="container-fluid">
  <?php
    $con = mysqli_connect('localhost','climber','Cornaredo','cornaredo_routes');
    if (!$con)
    {
      die('Could not connect' .  mysqli_error($con));
    }
    $result_gen = mysqli_query($con, "SELECT * FROM routes" );

    echo '<table id="route_table" class="table table-striped">';
    echo '<thead>';
    echo '<tr id="title"><th>Name</th><th>Location</th><th>Grade</th><th>Creator</th></tr>';
    echo '</thead><tbody>';

    while( $row = mysqli_fetch_array($result_gen))
    {
      $grade = mysqli_fetch_assoc(mysqli_query( $con, "SELECT difficulty FROM grades WHERE grades.d_value = " . $row['difficulty']));
      echo '<tr id="' . $row['id'] . '">';
      echo '<td>' . $row['name'] . '</td>';
      echo '<td>'  . $row['location'] . '</td>';
      echo '<td>'  . $grade['difficulty'] . '</td>';
      echo '<td>' . $row['creator'] . '</td>';
      echo '</tr>';
    }

      echo '</tbody></table>';
  ?>

</div>

<div id="route_picture" class="container-fluid">
</div>

<div class="container-fluid">
Select base picture for
  <?php
    $con = mysqli_connect('localhost','climber','Cornaredo','cornaredo_routes');
    if (!$con)
    {
      die('Could not connect' .  mysqli_error($con));
    }
    $result_gen = mysqli_query($con, "SELECT DISTINCT location FROM routes WHERE location IS NOT NULL" );
    echo '<select id="loc_sel">';
    echo '<option value="" selected="selected">Location</option>';
    
    while( $row = mysqli_fetch_array($result_gen))
    {
      echo '<option value="' . $row['location'] . '">' . $row['location'] . '</option>';
    }
      

  echo '</select>';
  ?>

  or upload new picture.

</div>

<div id="editor">
</div>

<script src="lightbox/lightbox.js"></script>
</body>
</html>
