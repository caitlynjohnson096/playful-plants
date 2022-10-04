<?php



$sql = "SELECT
plants.id AS 'plants.id',
plants.c_name AS 'plants.c_name',
plants.s_name AS 'plants.s_name',
plants.playful_plant_id AS 'plants.playful_plant_id',
tags.tag AS 'tags.tag',
plants_tags.tag_id AS 'plant_tags.tag_id',
plants_tags.plant_id AS 'plants_tags.plant_id',
plants.file_extension AS 'plants.file_extension'
FROM
plants_tags
INNER JOIN plants ON plants_tags.plant_id = plants.id
INNER JOIN tags ON plants_tags.tag_id = tags.id";

$record = NULL;
$c_name= NULL;
$s_name = NULL;
$playful_plant_id = NULL;


$display_id = $_GET['id'] ?? NULL;

$result = exec_sql_query($db, $sql . " WHERE (plants.id = :id)",
array(
  ':id' => $display_id
))->fetchAll();

if(count($result) >0){
  $record = $result[0];
}


  $c_name= $record['plants.c_name'];
  $s_name = $record['plants.s_name'];
  $playful_plant_id = $record['plants.playful_plant_id'];
  $record_id = $record['plants.id'];




?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
<!--
  <link rel="stylesheet" type="text/css" href="/public/site.css" media="all" /> -->
  <link rel="stylesheet" type="text/css" href="/public/site.css" media="all" />
</head>

<body>
<?php include("includes/header.php"); ?>
</h1> <?php echo htmlspecialchars($c_name) ?> 's details</h1>
<div class="details-page">
<img src="public/uploads/plants/<?php echo $record['plants.id'] . "." . $record['plants.file_extension'];?>" alt="Plant Picture"/>
</div>

<h2> <?php echo htmlspecialchars($c_name); ?> </h2>

<h3> <?php echo htmlspecialchars($s_name); ?> </h2>
<!-- <p> Type: </p> -->
<?php $tag_queries =  exec_sql_query($db, "SELECT tags.tag AS 'tags.tag' FROM plants_tags INNER JOIN tags ON (plants_tags.tag_id = tags.id) WHERE (plants_tags.plant_id = $display_id) AND (plants_tags.tag_id >= 9)",
)->fetchAll(); ?>
<div class="admin-tags">
  <div class="display-row">
<?php foreach($tag_queries as  $tag_query){ ?>
  <div class="tag-row">
<p><?php echo htmlspecialchars($tag_query['tags.tag']) ?></p>
</div>
<?php } ?>
</div>
</div>
</body>


</html>
