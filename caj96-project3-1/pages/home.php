<?php




$sql =  "SELECT
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
INNER JOIN tags ON plants_tags.tag_id = tags.id ";

// $sql = "SELECT tags.tag AS 'tags.tag' FROM plants_tags INNER JOIN tags ON (plants_tags.tag_id = tags.id)";


$filter_garden = '';




$sticky_filter_p = '';
$sticky_filter_a = '';
$sticky_filter_sun = '';
$sticky_filter_f_shade = '';
$sticky_filter_p_shade = '';
$sticky_filter_all = '';

$sql_select_part = $sql;
$sql_where_part = '';
$sql_order_part = '';
$sql_filter_expressions = array();


$filter_garden = $_GET['filter_garden'];

$sticky_filter_a = ($filter_garden == 'filter_an' ? 'checked' : '');
$sticky_filter_p = ($filter_garden == 'filter_per' ? 'checked' : '');
$sticky_filter_f_shade = ($filter_garden == 'filter_f_shade' ? 'checked' : '');
$sticky_filter_p_shade = ($filter_garden == 'filter_p_shade' ? 'checked' : '');
$sticky_filter_sun = ($filter_garden == 'filter_sun' ? 'checked' : '');
$sticky_filter_all = ($filter_garden == 'filter_all' ? 'checked' : '');

if($filter_garden == 'filter_an'){

  // $sql_where_part = " tags.id = 1";
$sql_where_part =  " WHERE (tags.id = 10);";
}

if($filter_garden == 'filter_per'){

  $sql_where_part = " WHERE (tags.id = 9);";

}

if($filter_garden == 'filter_sun'){

  $sql_where_part = " WHERE (tags.id = 11);";

}


if($filter_garden == 'filter_p_shade'){

  $sql_where_part = " WHERE (tags.id = 12);";

}


if($filter_garden == 'filter_f_shade'){

  $sql_where_part = " WHERE (tags.id = 13);";

}

if($filter_gardern == 'filter_all'){

  $sql_where_part = ";";

}




// if(count($sql_filter_expressions)> 0){
//   $sql_where_part = ' WHERE ' .implode(' AND ', $sql_filter_expressions);
// }
// $result = exec_sql_query($db, "SELECT * FROM Plants");

// $result = exec_sql_query($db, $sql);


// $records = $result->fetchAll();


$sql_query = $sql_select_part . $sql_where_part . $sql_order_part ." GROUP BY plants_tags.plant_id" ;

$records = exec_sql_query($db, $sql_query)->fetchAll();


// $records2 = $result2->fetchAll();


?>
<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" type="text/css" href="/public/site.css" media="all" />

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <title>TODO: Home</title>
</head>


<body>
<?php include("includes/header.php"); ?>
  <div class="user-view">
<h1> Playful Plants </h1>
<h2> About US </h2>
<p> We are Playful Plants. Our job is to help support child play in nature. We beleive that kids don't play outdoors enough, and that this kind of play is curcuial to developent. Therefore, we have developed a catalog full of plants that encourage play. </p>

<P> Have fun creating your play spaces </p>
</div>



<div class="form-cat">

<div class="cat">
<!-- generating the catalog -->
 <?php foreach($records as $record){

   //group by ids for tags


  $c_name = $record['plants.c_name'];
  $s_name = $record['plants.s_name'];
  $extension = $record['plants.file_extension'];
  ?>


<div class="borders">
  <div class="plant_images">
    <?php if($extension == NUll){ ?>
      <img src="public/images/no-image.jpeg"  alt="No Plant Image Avaible" />
      <cite><a href="https://stock.adobe.com/search/images?k=no%20image%20availabl">Example-o-Rama</a></cite>
    <?php } ?>
   <?php  if($extension != NUll){ ?>
    <!-- provided by plaful plants-->
      <img src="public/uploads/plants/<?php echo $record['plants.id'] . "."  . $extension;?>"  alt="Picture of Plant"/>
  <?php  } ?>
  </div>



  <h2> <?php echo htmlspecialchars($c_name); ?> </h2>
  <h3> <?php echo htmlspecialchars($s_name); ?> </h3>

  <h4>  Type </h4>
  <!-- <input type="hidden" name="
  <button class="center_flex" type="submit" aria-label= "view" </button>
  <div>

  a href="/details-page -->

<button>
<a href="/details-page?<?php echo http_build_query(array('id' => $record["plants.id"]))?>">View Plant Details </a>
 </button>

<!-- <?php
    foreach($record['plant_tags.plant_id']as $plantTag) {?>

    <?php if(($plantTag['plants_tags.id_tag'] ==1)){

     }; }?> </p> -->

</div>
      <?php } ?>

    </div>



<div class="form">
<form action="/" method="get" nonvalidate>
  <div class="sort_by_garden" role="group"
  aria-labelledby="filter_head">
  <div id="filter_head"> Filter by Gardening Types</div>
<div><div>
  <input type="radio" id="radio_a" name="filter_garden" value="filter_an" <?php echo $sticky_filter_a; ?> /> <label for="radio_a">annual</label>
  </div>
  <div>  <input type="radio" id="radio_p" name="filter_garden" value="filter_per" <?php $sticky_filter_p; ?>  /><label for="radio_p"> Pereneial</label></div>
  <div>  <input type="radio" id="radio_sun" name="filter_garden" value="filter_sun" <?php $sticky_filter_sun; ?>  /><label for="radio_sun">Sun</label></div>
  <div> <input type="radio" id="radio_p_shade" name="filter_garden" value="filter_p_shade" <?php echo $sticky_filter_p_shade; ?> /><label for="radio_p_shade">Partial Shade</label>
  </div>
  <div> <input type="radio" id="radio_f_shade" name="filter_garden" value="filter_f_shade"
  <?php echo $sticky_filter_f_shade ?> /><label for="radio_f_shade">Full Shade</label>
  </div>
  </div>
  <div> <input type="radio" id="radio_all" name="filter_garden" value="filter_all"
  <?php echo $sticky_filter_all ?> /><label for="radio_all">Show All Plants</label>
  </div>

  <input type="submit" value="Filter" ?>

</form>
    </div>
    </div>

<?php if(count($records)==0){ ?>
  <div class="no-plants">
<p>
  Sorry, No Plants of this type are avaibale </p>

<?php }?>
</div>


</body>

</html>
