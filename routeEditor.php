<!Doctype html>

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
      //alert($(this).attr('id'));
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
$(document).ready(function() {
  $("#block_img").mouseenter(function() {
    $("#change_btn").show(500);
  });
});
</script>

<script>
$(function() {
$("#block").click(function(e) {
  var offset = $(this).offset();
  var relativeX = (e.pageX - offset.left);
  var relativeY = (e.pageY - offset.top);
  $(".position").val("afaf");
  
  $('#coord_table tr:last').after('<tr><td>'+relativeX+'</td><td>'+relativeY+'</td><td><input type="text" class="form-control" id="comment"></td></tr>');
  });
});
</script>

<script>
$(document).ready(function(){
  $("#submit_btn").click( function() {
    var TableData = new Array();
    $('#coord_table tr').each(function(row, tr){
      TableData[row]={
      "X" : $(tr).find('td:eq(0)').text()
      , "Y" :$(tr).find('td:eq(1)').text()
      }
    });
    // Probably one could integrate all variables into the Json table
    var json_txt = JSON.stringify(TableData, null, 2);
    var name = $("#name").val();
    var grade = $("#grade").val();
    var creator = $("#creator").val();
    var loc = $("#loc").val();
    $.ajax({
      type: "POST",
      url: "writeRouteToDB.php",
      data: {pTableData: json_txt, 
             name:  name, 
             grade: grade, 
             creator: creator,
             loc: loc}
    })
    .done(function( html ) {
      $("#results").append(html);
    });
  });  
});
</script>

</head>

<body>
<div id="tableOutput" class="container-fluid">
<div class="">
  <label for="grade">Grade</label>
<?php
$con = mysqli_connect('localhost','climber','Cornaredo','cornaredo_routes');
if (!$con)
{
  die('Could not connect: ' . mysqli_error($con));
}
# mysqli_select_db($con,"vtiger_cf_640");
$result = mysqli_query($con,"SELECT * FROM grades");

echo '<select id="grade">';

while($row = mysqli_fetch_array($result))
{
  echo '<option value="' . $row['d_value'] . '">' . $row['difficulty'] . '</option>';
}

echo '</select>';
?>
</div>
<div class="form-group">
  <label for="name">Name</label>
  <input type="text" class="form-control" id="name">
</div>
<div class="form-group">
  <label for="loc">Location</label>
  <input type="text" class="form-control" id="loc">
</div>

<div class="form-group">
  <label for="creator">Creator</label>
  <input type="text" class="form-control" id="creator">
</div>

<div id="block_img" style="position:relative;">
<img id="block" src="img/blocks/L1110300.jpg">
<button id="change_btn" type="button" class="btn btn-default" style="position:absolute; left:0;display:none;">Change</button>
</div>

<div>

<table id="coord_table" class="table table-striped">
<thead>
<tr id="title">
  <th>X value</th>
  <th>Y value</th>
  <th>Comment</th>
</tr>
</thead>
<tbody>
</tbody>
</table>

</div>

<div>
<button id="submit_btn" type="button" class="btn btn-default">Submit</button>
</div>

<div id="results">

</div>

</div>



</body>

</html>
