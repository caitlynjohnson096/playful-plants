<?php
if(is_user_logged_in()) {

// call database


  // $db1 = init_sqlite_db('db/site.sqlite' , 'db/init.sql');
// define the max size of a file
define('MAX_FILE_SIZE', 1000000);




//post the values of the tags
$sensory = $_POST['sensory'];
$constructive = $_POST['constructive'];
$physical = $_POST['physical'];
$imaginative = $_POST['imaginative'];
$expressive = $_POST['expressive'];
$rules = $_POST['rules'];
$bio = $_POST['bio'];
$restore = $_POST['restore'];
$annual = $_POST['annual'];
$pernnial = ['pernnial'];
$pshade = $_POST['pshade'];
$fshade = $_POST['fshade'];
$sun = $_POST['sun'];
$shrub = $_POST['shrub'];
$vine = $_POST['vine'];
$grass = $_POST['grass'];
$ground_cover = $_POST['ground_cover'];
$tree = $_POST['tree'];
$flower = $_POST['flower'];
$file_upload = $_FILES['photo_name'];



// sql joins clause selects plants / tags you want to show from different tables
$sql= "SELECT plants.id AS 'plants.id',
plants.c_name AS 'plants.c_name',
plants.s_name AS 'plants.s_name',
plants.playful_plant_id AS 'plants.playful_plant_id',
tags.tag AS 'tags.tag',
plants_tags.tag_id AS 'plant_tags.tag_id',
plants_tags.plant_id AS 'plants_tags.plant_id'
FROM
plants_tags
INNER JOIN plants ON plants_tags.plant_id = plants.id
INNER JOIN tags ON plants_tags.tag_id = tags.id GROUP BY plants_tags.plant_id ";

// setting the varaiables to be able to concatinate the filters
$sql_select_part = $sql;
$sql_where_part = '';
$sql_order_part = '';
$sql_filter_expressions = array();

//hiding the plant feedback in case there is not value in that spot
$c_name_feedback = 'hidden';
$s_name_feedback = 'hidden';
$plant_id_feedback = 'hidden';
$play_type_feedback = 'hidden';
$garden_type_feedback = 'hidden';

// initializing variables
$c_name = '';
$s_name = '';
$plant_id = '';
$delete_id = '';

//intializing the sticky from plants
$sticky_c_name= '';
$sticky_s_name= '';
$sticky_plant_id= '';

//initializing sticky tags for form
$sticky_sensory = '';
$sticky_constructive = '';
$sticky_physical = '';
$sticky_imaginative = '';
$sticky_expressive = '';
$sticky_rules = '';
$sticky_bio = '';
$sticky_restore = '';
$sticky_annual = '';
$sticky_pernnial = '';
$sticky_shrub = '';
$sticky_sun = '';
$sticky_ground_cover = '';
$sticky_pshade = '';
$sticky_fshade = '';
$sticky_vine = "";
$sticky_tree ="";
$sticky_flower ="";
$sticky_grass = "";


// intializing stickies for the different filters
$sticky_filter_sensory = "";
$sticky_filter_constructive = '';
$sticky_filter_physical = "";
$sticky_filter_imaginative = '';
$stikcy_filter_expressive ="";
$sticky_filter_rules = "";
$sticky_filter_bio = "";
$sticky_filter_rules = ' ';
$sticky_filter_restore = ' ';


$filter_sensory = (bool)($_GET['f-sensory'] ?? NULL);
$filter_constructive = (bool)($_GET["f-constructive"] ?? NULL);
$filter_physical = (bool)($_GET["f-physical"] ?? NULL);
$filter_imaginative = (bool)($_GET['f-imaginative'] ?? NULL);
$filter_expressive = (bool)($_GET['f-expressive'] ?? NULL);
$filter_bio = (bool)($_GET["f-bio"] ?? NULL);
$filter_rules = (bool)($_GET["f-rules"] ?? NULL);
$filter_restore = (bool)($_GET["f-restore"] ?? NULL);


$sticky_filter_sensory = ($filter_sensory ? 'checked' : '');
$sticky_filter_constructive = ($filter_constructive ? 'checked' : '');
$sticky_filter_physical = ($filter_physical ? 'checked' : '');
$sticky_filter_imaginative = ($filter_imaginative? 'checked' : '');
$sticky_filter_expressive = ($filter_expressive ? 'checked' : '');
$sticky_filter_bio = ($filter_bio ? 'checked' : '' );
$sticky_filter_rules = ($filter_rules ? 'checked' : '');
$sticky_filter_restore = ($filter_restore ? 'checked' : '');

if($filter_sensory){
  array_push($sql_filter_expressions, "tag_id=1");
}

if($filter_constructive){
  array_push($sql_filter_expressions, "tag_id=2");
}


if($filter_physical){
  array_push($sql_filter_expressions, "tag_id=3");
}


if($filter_imaginative){
  array_push($sql_filter_expressions, "tag_id=4");
}


if($filter_expressive){
  array_push($sql_filter_expressions, "tag_id=5");
}


if($filter_bio){
  array_push($sql_filter_expressions, "tag_id=6");
}


if($filter_rules){
  array_push($sql_filter_expressions, "tag_id=7");
}

if($filter_rules){
  array_push($sql_filter_expressions, "tag_id=8");
}

if(count($sql_filter_expressions)>0){
  $sql_where_part = ' WHERE ' .implode(' AND ',
  $sql_filter_expressions);
}

$sql_query = $sql_select_part . $sql_where_part . $sql_order_part;

// isset for adding new plant
if(isset($_POST['add_new_plant'])){
  // trimming the post value / grabbing value
  $playful_plantid = trim($_POST['playful_plant_id']);
  $c_name = trim($_POST['c_name']);
  $s_name = trim($_POST['s_name']);
  $sensory = trim($_POST['sensory'] ?? 0);
  $constructive = trim($_POST['constructive'] ?? 0);
  $physical = trim($_POST['physical'] ?? 0);
  $imaginative = trim($_POST['imaginative'] ?? 0);
  $expressive = trim($_POST['expressive'] ?? 0);
  $rules = trim($_POST['rules'] ?? 0);
  $bio = trim($_POST['bio'] ?? 0);
  $restore = trim($_POST['restore'] ?? 0);
  $annual = trim($_POST['annual'] ?? 0);
  $pernnial = trim($_POST['pernnial'] ?? 0);
  $pshade = trim($_POST['pshade'] ?? 0);
  $fshade = trim($_POST['fshade'] ?? 0);
  $sun = trim($_POST['sun'] ?? 0);
  $shrub = trim($_POST['shrub'] ?? 0);
  $vine = trim($_POST['vine'] ?? 0);
  $grass = trim($_POST['grass'] ?? 0);
  $ground_cover = trim($_POST['ground_cover'] ?? 0);
  $tree = trim($_POST['tree'] ?? 0);
  $flower = trim($_POST['flower'] ?? 0);
  $file_upload = $_FILES['photo_name'];

//intializing the form to valid
  $form_valid =True;

  //checking to make sure the playful plant_id isnt empty
  if(empty($playful_plantid)){
    $form_valid = False;
    $plant_id_feedback = '';
  }

  //checking to make sure that the c name isnt empty
  if(empty($c_name)){
    $form_valid = False;
    $c_name_feedback = '';
  }

  //checking to make sure that s name isnt empty
  if(empty($s_name)){
    $form_valid = False;
    $s_name_feedback = '';
  }

  if(empty($sensory) && empty($constructive) && empty($physical) && empty($imaginative) && empty($expressive)&& empty($rules) && empty($bio) && empty($restore)){
    $form_valid = False;
    $play_type_feedback = '';
  }

  if($form_valid){
    $file_basename = basename($file_upload['name']);
    if($file_basename != ""){
    $extension = strtolower(pathinfo($file_basename, PATHINFO_EXTENSION));
    }else{
      $extension = NULL;
    }
    $insert_plants = exec_sql_query($db, "INSERT INTO plants (playful_plant_id, c_name, s_name, file_extension) VALUES (:playful_plant_id, :c_name, :s_name, :file_extension);" ,
    array(
      ':playful_plant_id' => $playful_plantid,
      ':c_name' => $c_name,
      ':s_name' => $s_name,
      ':file_extension' => $extension

    )
    );

// $newId= exec_sql_query($db, "SELECT MAX (id) FROM plants")->fetchAll();
// $newId = mysqli_insert_id($insert_plants);
$newId = $db->lastInsertId('id');
$newPlantId = $db->lastInsertId('playful_plant_id');

    if(!empty($constructive)){
    $insert_tags = exec_sql_query($db, "INSERT INTO plants_tags(plant_id, tag_id) VALUES (:plant_id, :tag_id);" ,
    array(
      ':plant_id' => $newId,
      ':tag_id' => $constructive
    )
    );
  }

    if(!empty($sensory)){
    $insert_tags2 = exec_sql_query($db, "INSERT INTO plants_tags(plant_id, tag_id) VALUES (:plant_id, :tag_id);" ,
    array(
      ':plant_id' => $newId,
      ':tag_id' => $sensory
    )
    );}

    if(!empty($physical)){
    $insert_tags3 = exec_sql_query($db, "INSERT INTO plants_tags(plant_id, tag_id) VALUES (:plant_id, :tag_id);" ,
    array(
      ':plant_id' => $newId,
      ':tag_id' => $physical
    )
    );
  }

    if(!empty($imaginative)){
    $insert_tags4 = exec_sql_query($db, "INSERT INTO plants_tags(plant_id, tag_id) VALUES (:plant_id, :tag_id);" ,
    array(
      ':plant_id' => $newId,
      ':tag_id' => $imaginative
    )
    );
  }

    if(!empty($restore)){
    $insert_tags5 = exec_sql_query($db, "INSERT INTO plants_tags(plant_id, tag_id) VALUES (:plant_id, :tag_id);" ,
    array(
      ':plant_id' => $newId,
      ':tag_id' => $restore
    )
    );
  }

    if(!empty($expressive)){
    $insert_tags6 = exec_sql_query($db, "INSERT INTO plants_tags(plant_id, tag_id) VALUES (:plant_id, :tag_id);" ,
    array(
      ':plant_id' => $newId,
      ':tag_id' => $expressive
    )
    );
  }

    if(!empty($rules)){
    $insert_tags7 = exec_sql_query($db, "INSERT INTO plants_tags(plant_id, tag_id) VALUES (:plant_id, :tag_id);" ,
    array(
      ':plant_id' => $newId,
      ':tag_id' => $rules
    )
    );
  }

    if(!empty($bio)){
    $insert_tags8 = exec_sql_query($db, "INSERT INTO plants_tags(plant_id, tag_id) VALUES (:plant_id, :tag_id);" ,
    array(
      ':plant_id' => $newId,
      ':tag_id' => $bio,
    )
    );
  }

  if(!empty($annual)){
    $insert_tags8 = exec_sql_query($db, "INSERT INTO plants_tags(plant_id, tag_id) VALUES (:plant_id, :tag_id);" ,
    array(
      ':plant_id' => $newId,
      ':tag_id' => $annual
    )
    );
  }

  if(!empty($pernnial)){
    $insert_tags8 = exec_sql_query($db, "INSERT INTO plants_tags(plant_id, tag_id) VALUES (:plant_id, :tag_id);" ,
    array(
      ':plant_id' => $newId,
      ':tag_id' => $pernnial
    )
    );
  }

  if(!empty($sun)){
    $insert_tags8 = exec_sql_query($db, "INSERT INTO plants_tags(plant_id, tag_id) VALUES (:plant_id, :tag_id);" ,
    array(
      ':plant_id' => $newId,
      ':tag_id' => $sun
    )
    );
  }

  if(!empty($pshade)){
    $insert_tags8 = exec_sql_query($db, "INSERT INTO plants_tags(plant_id, tag_id) VALUES (:plant_id, :tag_id);" ,
    array(
      ':plant_id' => $newId,
      ':tag_id' => $pshade
    )
    );
  }

  if(!empty($fshade)){
    $insert_tags8 = exec_sql_query($db, "INSERT INTO plants_tags(plant_id, tag_id) VALUES (:plant_id, :tag_id);" ,
    array(
      ':plant_id' => $newId,
      ':tag_id' => $fshade
    )
    );
  }

  if(!empty($shrub)){
    $insert_tags8 = exec_sql_query($db, "INSERT INTO plants_tags(plant_id, tag_id) VALUES (:plant_id, :tag_id);" ,
    array(
      ':plant_id' => $newId,
      ':tag_id' => $shrub
    )
    );
  }

  if(!empty($grass)){
    $insert_tags8 = exec_sql_query($db, "INSERT INTO plants_tags(plant_id, tag_id) VALUES (:plant_id, :tag_id);" ,
    array(
      ':plant_id' => $newId,
      ':tag_id' => $grass
    )
    );
  }

  if(!empty($vine)){
    $insert_tags8 = exec_sql_query($db, "INSERT INTO plants_tags(plant_id, tag_id) VALUES (:plant_id, :tag_id);" ,
    array(
      ':plant_id' => $newId,
      ':tag_id' => $vine
    )
    );
  }

  if(!empty($tree)){
    $insert_tags8 = exec_sql_query($db, "INSERT INTO plants_tags(plant_id, tag_id) VALUES (:plant_id, :tag_id);" ,
    array(
      ':plant_id' => $newId,
      ':tag_id' => $tree
    )
    );
  }

  if(!empty($flower)){
    $insert_tags8 = exec_sql_query($db, "INSERT INTO plants_tags(plant_id, tag_id) VALUES (:plant_id, :tag_id);" ,
    array(
      ':plant_id' => $newId,
      ':tag_id' => $flower
    )
    );
  }

  if(!empty($ground_cover)){
    $insert_tags8 = exec_sql_query($db, "INSERT INTO plants_tags(plant_id, tag_id) VALUES (:plant_id, :tag_id);" ,
    array(
      ':plant_id' => $newId,
      ':tag_id' => $ground_cover
    )
    );
  }


    if($insert_plants && ($insert_tags || $insert_tags2 || $insert_tags3  || $insert_tags4 || $insert_tags5 || $insert_tags6 || $insert_tags7 || $insert_tags8)){
      $plant_inserted = True;

      $photo_file_name = 'public/uploads/plants/' . $newId . '.' . $extension;
      move_uploaded_file($file_upload['tmp_name'], $photo_file_name);
    }

  }else{
      $sticky_sensory = (empty($sensory) ? '' : 'checked');
      $sticky_constructive = (empty($constructive) ? '' : 'checked');
      $sticky_physical = (empty($physical) ? '' : 'checked');
      $sticky_restore = (empty($restore) ? '' : 'checked');
      $sticky_expressive = (empty($expressive) ? '' : 'checked');
      $sticky_rules = (empty($rules) ? '' : 'checked');
    $sticky_bio = (empty($bio) ? '' : 'checked');
    $sticky_pernnial = (empty($pernnial) ? '' : 'checked');
    $sticky_annual = (empty($annual) ? '' : 'checked');
    $sticky_sun = (empty($sun) ? '' : 'checked');
    $sticky_pshade = (empty($pshade) ? '' : 'checked');
    $sticky_fshade = (empty($fshade) ? '' : 'checked');
    $sticky_fshade = (empty($fshade) ? '' : 'checked');
    $sticky_shrub = (empty($shrub) ? '' : 'checked');
    $sticky_grass = (empty($grass) ? '' : 'checked');
    $sticky_vine = (empty($vine) ? '' : 'checked');
    $sticky_tree = (empty($tree) ? '' : 'checked');
    $sticky_flower = (empty($flower) ? '' : 'checked');
    $sticky_ground_cover = (empty($ground_cover) ? '' : 'checked');
    $sticky_c_name = $c_name;
    $sticky_s_name = $s_name;
    $sticky_plant_id = $playful_plantid;

  }

}


if(isset($_POST["delete_form"])){
  $delete_id = trim($_POST['deleteid']);

  $delete_plants = exec_sql_query($db, "DELETE FROM plants WHERE (plants.id = $delete_id);");

  $delete_tags = exec_sql_query($db, "DELETE FROM plants_tags WHERE (plants_tags.plant_id = $delete_id);");



}






$records = exec_sql_query($db, $sql_query)->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" type="text/css" href="/public/site.css" media="all" />

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />


  <title>Admin Home</title>
</head>





<body>

<?php include("includes/header.php"); ?>
  <?php if($form_valid){ ?>
<p> You have successfully added a new plant </p>
  <?php } ?>

  <div class= "filter-catal" >
<aside>
<h2> Add New Plant: </h2>
<form action="/admin-home" method="post"  enctype="multipart/form-data" nonvalidate>
<label for="file-input"> Photo Upload </label>
<div><input  type="hidden" name= "MAX_FILE_SIZE" value="1000000"/></div>
  <div> <input id= "file-input"type="file" name="photo_name" />

<div>
<p id="playful_plant_id" class="feedback <?php echo $plant_id_feedback; ?>">Please provide the the plant's ID.</p>
    <label for="plant_id_text"> Plant's ID</label>
    <input id="plant_id_text" class= "feedback" type="text" name="playful_plant_id" value="<?php echo htmlspecialchars($sticky_plant_id); ?>" />
</div>
  <div>
  <p id="name_c" class="feedback <?php echo $c_name_feedback; ?>">Please provide the colequial name.</p>
    <label for="name_c_text"> Plant's Collequial Name</label>
    <input id="name_c_text" type="text" name="c_name" value="<?php echo htmlspecialchars($sticky_c_name); ?>" />
</div>
<div>
<p id="name_c" class="feedback <?php echo $s_name_feedback; ?>">Please provide the Scientific name.</p>
    <label for="name_s_text"> Plant's Scientific Name</label>
    <input id="name_s_text" type="text" name="s_name" value="<?php echo htmlspecialchars($sticky_s_name); ?>"/>
</div>

<p id="label_feedback" class="feedback <?php echo $play_type_feedback; ?>">Please provide a type for your plant</p>
<div class="form-checks" role="group" aria-labelledby="play_head">
          <div id="play_head"> Play Type Tags:</div>
<div>
  <div>
  <input type="checkbox"<?php echo $sticky_constructive?> id="checkbox_constructive" name="constructive" value="1"?>
  <label for="checkbox_constructive"> Exploratory constrtuctive Play</label>
</div>
<div>
  <input type="checkbox" <?php echo $sticky_sensory?> id="checkbox_sensory" name="sensory" value="2"?>
  <label for="checkbox_sensory"> Exploratory Sensory Play</label>
</div>
<div>
  <input type="checkbox"<?php echo $sticky_physical?>  id="checkbox_physical" name="physical" value="3"?>
  <label for="checkbox_physical"> Physcial Play</label>
</div>
<div>
  <input type="checkbox" <?php echo $sticky_imaginative?>  id="checkbox_imaginative" name="imaginitve" value="4"?>
  <label for="checkbox_imaginative"> Imaganative Play</label>
</div>

<div>
  <input type="checkbox" id="checkbox_restore" <?php echo $sticky_restore?> name="restore" value="5"?>
  <label for="checkbox_restore"> Restorative Play</label>
</div>

<div>
  <input type="checkbox" <?php echo $sticky_expressive?> id="checkbox_expressive" name="expressive" value="6"?>
  <label for="checkbox_expressive"> Expressive Play</label>
</div>

<div>
  <input type="checkbox" id="checkbox_rules" <?php echo $sticky_rules?> name="rules" value="7"?>
  <label for="checkbox_rules"> Play with Rules </label>
</div>
<div>
  <input type="checkbox" <?php echo $sticky_bio?>  id="checkbox_bio" name="bio" value="8"?>
  <label for="checkbox_bio"> Bio Play </label>
</div>
<div id= "filter_head">Gardening Info Tags: </div>
<div>
  <input type="checkbox" <?php echo $sticky_pernnial?>  id="checkbox_pernnial" name="pernnial" value="9"?>
  <label for="checkbox_pernnial"> Pernnial </label>
</div>
<div>
  <input type="checkbox" <?php echo $sticky_annual?>  id="checkbox_annual" name="annual" value="10"?>
  <label for="checkbox_annual"> Annual </label>
</div>
<div>
  <input type="checkbox" <?php echo $sticky_sun?>  id="checkbox_sun" name="annual" value="11"?>
  <label for="checkbox_sun"> Full Sun </label>
</div>
<div>
  <input type="checkbox" <?php echo $sticky_pshade?>  id="checkbox_pshade" name="p-shade" value="12"?>
  <label for="checkbox_pshade"> Partial Shade </label>
</div>
<div>
  <input type="checkbox" <?php echo $sticky_fshade?>  id="checkbox_fshade" name="fshade" value="13"?>
  <label for="checkbox_fshade"> Full Shade </label>
</div>
<div id= "filter_head">Plant Type Tags: </div>
<div>
  <input type="checkbox" <?php echo $sticky_shrub?>  id="checkbox_shrub" name="shrub" value="14"?>
  <label for="checkbox_shrub"> Shrub </label>
</div>
<div>
  <input type="checkbox" <?php echo $sticky_grass?>  id="checkbox_grass" name="grass" value="15"?>
  <label for="checkbox_grass"> Grass </label>
</div>
<div>
  <input type="checkbox" <?php echo $sticky_vine?>  id="checkbox_vine" name="vine" value="16"?>
  <label for="checkbox_vine"> Vine </label>
</div>
<div>
  <input type="checkbox" <?php echo $sticky_tree?>  id="checkbox_tree" name="tree" value="17"?>
  <label for="checkbox_tree"> Tree </label>
</div>
<div>
  <input type="checkbox" <?php echo $sticky_flower?>  id="checkbox_flower" name="flower" value="18"?>
  <label for="checkbox_flower"> Flower </label>
</div>
<div>
  <input type="checkbox" <?php echo $sticky_ground_cover?>  id="checkbox_ground_cover" name="ground_cover" value="19"?>
  <label for="checkbox_ground_cover"> Ground Cover </label>
</div>
</div>

<input type="submit"  value="Add New Plant" name="add_new_plant"/>
</form>
  </aside>
<div class="admin-catalog">
<?php foreach($records as $record){

  $playful_plantid = $record['plants.playful_plant_id'];
  $c_name=$record['plants.c_name'];
  $s_name = $record['plants.s_name'];
  $delete_id = $record['plants.id'];
?>

<!-- <img src="public/uploads/plants/<?php echo $record['plants.playful_plant_id'] . ".jpg";?>"/> -->


<p> <?php echo htmlspecialchars($playful_plantid) ?> </p>
<h2> <?php echo htmlspecialchars($c_name) ?> </h2>
<h3> <?php echo htmlspecialchars($s_name) ?> </h3>

<?php $tag_queries = exec_sql_query($db, "SELECT tags.tag AS 'tags.tag' FROM plants_tags INNER JOIN tags ON (plants_tags.tag_id = tags.id) WHERE (plants_tags.plant_id = $delete_id) AND (plants_tags.tag_id < 9)",
)->fetchAll(); ?>
<div class="admin-tags">
  <div class="display-row">
<?php foreach($tag_queries as $tag_query){ ?>
  <div class="tag-row">
 <p> <?php echo htmlspecialchars($tag_query['tags.tag']); ?></p>
</div>
<?php } ?>
</div>
</div>
<div class="admin-buttons">
<button>
<a href="/edit-plant?<?php echo http_build_query(array('id' => $record["plants.id"]))?>">Edit</a>
</button>

<form action="/admin-home" method="post" nonvalidate>

<input type="hidden" name="deleteid" value="<?php echo $record['plants.id'] ?>" />
<input type="submit"  value="delete" name="delete_form"/>

</form>
</div>





<?php } ?>
</div>

</div>

</div>






</body>
<?php }else { ?>
<p> Sorry, you need to login to view this page </p>
<?php } ?>
</html>
