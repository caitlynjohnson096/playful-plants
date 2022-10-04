<?php




$sql= "SELECT
plants.id AS 'plants.id',
plants.c_name AS 'plants.c_name',
plants.s_name AS 'plants.s_name',
plants.playful_plant_id AS 'plants.playful_plant_id',
tags.tag AS 'tags.tag',
plants_tags.tag_id AS 'plant_tags.tag_id',
plants_tags.plant_id AS 'plants_tags.plant_id'
FROM
plants_tags
INNER JOIN plants ON plants_tags.plant_id = plants.id
INNER JOIN tags ON plants_tags.tag_id = tags.id ";

// $tag_queries = $db, "SELECT tags.tag AS 'tags.tag' FROM plants_tags INNER JOIN tags ON (plants_tags.tag_id = tags.id) WHERE (plants_tags.plant_id = $display_id";

$id = "";
$c_name = "";
$playful_plant_id = "";
$s_name = "";
// $sensory = trim($_POST['sensory'] ?? 0);
// $constructive = trim($_POST['constructive'] ?? 0);
// $physical = trim($_POST['physical'] ?? 0);
// $imaginative = trim($_POST['imaginative'] ?? 0);
// $expressive = trim($_POST['expressive'] ?? 0);
// $rules = trim($_POST['rules'] ?? 0);
// $bio = trim($_POST['bio'] ?? 0);
$restore = "";
// $sensory = "";

$sticky_c_name = '';
$sticky_s_name = '';
$sticky_playful_plant_id = '';
$sticky_sensory = '';
$sticky_constuctive = '';
$sticky_physical = '';
$sticky_bio = '';
$sticky_rules = '';
$sticky_restore = '';
$sticky_imaginatve = '';
$sticky_perrnial = '';
$sticky_annual = "";
$sticky_fshade = "";
$sticky_sun = "";
$sticky_pshade = "";
$sticky_shrub = "";
$sticky_flower = "";
$sticky_grass = '';
$sticky_vine = '';
$sticky_tree = '';
$sticky_ground_cover = '';


$edit_id = $_POST['edit-id'] ?? NULL;
$plant_id = $_GET['id'] ?? NULL;





if($edit_id){
    $records = exec_sql_query($db, $sql . 'WHERE (plants.id = :id);',
    array(
        ':id' => $edit_id
    ))->fetchAll();

    if(count($records) > 0){
        $record = $records[0];

    }}

    else if($plant_id) {
      $records = exec_sql_query($db, $sql . "WHERE (plants.id = :id);",
      array(
        ':id' => $plant_id
        )
        )->fetchAll();

        if(count($records) > 0){
          $record = $records[0];
        }
      }



//ycheck this because its unintialized --- maybe it needs to be inside ()
if ($record){
    $id = $record['plants.id'];
    $c_name = $record['plants.c_name'];
    $s_name = $record['plants.s_name'];
    $playful_plant_id = $record['plants.playful_plant_id'];
    // $constructive = $record['tags.tag WHERE plants_tag.tag_id =1'];

    $sticky_id = $id;
    $sticky_c_name = $c_name;
    $sticky_s_name = $s_name;
    $sticky_playful_plant_id = $playful_plant_id;



  //feedback added here

 $tag_queries =  exec_sql_query($db, "SELECT tags.tag AS 'tags.tag' FROM plants_tags INNER JOIN tags ON (plants_tags.tag_id = tags.id) WHERE (plants_tags.plant_id = $plant_id)"
 )->fetchAll();




 foreach($tag_queries as  $tag_query){

  if($tag_query['tags.tag'] == 'exploratroy constructive play'){
    $sticky_constructive = true;
  }

  if($tag_query['tags.tag'] == 'exploratroy sensory play'){
    $sticky_sensory = true;
  }

  if($tag_query['tags.tag'] == 'physical play'){
    $sticky_physical = true;
  }

  if($tag_query['tags.tag'] =='imaginative play'){
    $sticky_imaginative= true;
  }


  if($tag_query['tags.tag'] == 'restorative play'){
    $sticky_restorative = true;
  }


  if($tag_query['tags.tag'] == 'expressive play'){
    $sticky_restorative = true;
  }

  if($tag_query['tags.tag'] == 'play with rules'){
    $sticky_rules = true;
  }

  if($tag_query['tags.tag'] == 'bio play'){
    $sticky_bio = true;
  }

  if($tag_query['tags.tag'] =='pernnial'){
    $sticky_perrnial = true;
  }
  if($tag_query['tags.tag'] == 'annual'){
    $sticky_annual = true;
  }
  if($tag_query['tags.tag'] ==  'full sun'){
    $sticky_sun = true;
  }
  if($tag_query['tags.tag'] == 'partial shade'){
    $sticky_pshade = true;
  }
  if($tag_query['tags.tag'] ==  'full shade'){
    $sticky_fshade = true;
  }
  if($tag_query['tags.tag'] ==  'shrub'){
    $sticky_shrub = true;
  }
  if($tag_query['tags.tag'] ==  'grass'){
    $sticky_grass = true;
  }
  if($tag_query['tags.tag'] ==  'vine'){
    $sticky_vine = true;
  }
  if($tag_query['tags.tag'] == 'tree'){
    $sticky_tree = true;
  }
  if($tag_query['tags.tag'] ==  'flower'){
    $sticky_flower = true;
  }
  if($tag_query['tags.tag'] == 'ground cover'){
    $sticky_ground_cover = true;
  }

 }



    $c_name_feedback = 'hidden';
    $s_name_feedback = 'hidden';
    $playful_plant_id_feedback ='hidden';



    if($edit_id){
        $c_name = trim($_POST['c_name']);
        $s_name = trim($_POST['s_name']);
        $playful_plant_id = trim($_POST['plant_id']);
        $sensory = trim($_POST['sensory'] ?? 0);
    $constructive = trim($_POST['constructive'] ?? 0);
    $physical = trim($_POST['physical'] ?? 0);
    $imaginative = trim($_POST['imaginative'] ?? 0);
    $expressive = trim($_POST['expressive'] ?? 0);
    $rules = trim($_POST['rules'] ?? 0);
    $bio = trim($_POST['bio'] ?? 0);
    $restore = trim($_POST['restore'] ?? 0);

    $form_valid = True;

    if(empty($c_name)){
        $form_valid =False;
        $c_name_feedback= '';
    }

    if(empty($s_name)){
        $form_valid =False;
        $s_name_feedback= '';
    }
    if(empty($playful_plant_id)){
        $form_valid =False;
        $playful_plant_id_feedback= '';
    }

    if(empty($sensory) && empty($constructive) && empty($physical) && empty($imaginative) && empty($expressive)&& empty($rules) && empty($bio) && empty($restore)){
      $form_valid = False;
      $play_type_feedback = '';
    }



    if ($form_valid){
        $update_the_plant= exec_sql_query($db, "UPDATE plants SET
         playful_plant_id = :playful_plant_id,
         c_name = :c_name,
         s_name = :s_name
         WHERE (id = :id);",
         array(
             ':playful_plant_id' => $playful_plant_id,
             ':c_name' => $c_name,
             ':s_name' => $s_name,
             ':id' => $id
         )
         );

         $tag_queries =  exec_sql_query($db, "SELECT tags.tag AS 'tags.tag' FROM plants_tags INNER JOIN tags ON (plants_tags.tag_id = tags.id) WHERE (plants_tags.plant_id = $id) AND (plants_tags.tag_id > 8);",
         )->fetchAll();

        //  $newId = $db->lastInsertId('id');

         foreach($tag_queries as $tag_query){

          if(!empty($constructive) && $tag_query['tags.tag']!= 'exploratroy constructive play'){
            $insert_tags = exec_sql_query($db, "INSERT INTO plants_tags(plant_id, tag_id) VALUES (:plant_id, :tag_id);" ,
            array(
              ':plant_id' => $id,
              ':tag_id' => $constructive
            )
            );
          }

          if(!empty($sensory) && $tag_query['tags.tag']!= 'exploratroy sensory play'){
            $insert_tags1 = exec_sql_query($db, "INSERT INTO plants_tags(plant_id, tag_id) VALUES (:plant_id, :tag_id);" ,
            array(
              ':plant_id' => $id,
              ':tag_id' => $sensory
            )
            );
          }

          if(!empty($physical) && $tag_query['tags.tag']!= 'physical play'){
            $insert_tags2 = exec_sql_query($db, "INSERT INTO plants_tags(plant_id, tag_id) VALUES (:plant_id, :tag_id);" ,
            array(
              ':plant_id' => $id,
              ':tag_id' => $physical
            )
            );
          }
          if(!empty($restorative) && $tag_query['tags.tag']!= 'restorative play'){
            $insert_tags3 = exec_sql_query($db, "INSERT INTO plants_tags(plant_id, tag_id) VALUES (:plant_id, :tag_id);" ,
            array(
              ':plant_id' => $id,
              ':tag_id' => $restorative
            )
            );
          }
          if(!empty($expressive) && $tag_query['tags.tag']!= 'expressive play'){
            $insert_tags4 = exec_sql_query($db, "INSERT INTO plants_tags(plant_id, tag_id) VALUES (:plant_id, :tag_id);" ,
            array(
              ':plant_id' => $id,
              ':tag_id' => $imaginative
            )
            );
        }

        if(!empty($rules) && $tag_query['tags.tag']!= 'play with rules'){
          $insert_tags5 = exec_sql_query($db, "INSERT INTO plants_tags(plant_id, tag_id) VALUES (:plant_id, :tag_id);" ,
          array(
            ':plant_id' => $id,
            ':tag_id' => $imaginative
          )
          );
      }
      if(!empty($bio) && $tag_query['tags.tag']!= 'bio play'){
        $insert_tags6 = exec_sql_query($db, "INSERT INTO plants_tags(plant_id, tag_id) VALUES (:plant_id, :tag_id);" ,
        array(
          ':plant_id' => $id,
          ':tag_id' => $imaginative
        )
        );
      }
        if(empty($expressive) && $tag_query['tags.tag'] == 'exploratroy constructive play'){
          $delete_tags = exec_sql_query($db, "DELETE FROM plants_tags WHERE (plants_tags.plant_id = $plant_id) AND (plants_tags.tag_id = 1);");
        }

         }



    }
    if($update_the_plant){
        $record_updated = True;
    }
  }else {
    $sticky_playful_plant_id = $playful_plant_id;
    $sticky_c_name = $c_name;
    $sticky_s_name = $s_name;

  }

}


?>
<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" type="text/css" href="/public/site.css" media="all" />
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <title>Edit Page</title>
</head>

<body>
<?php include("includes/header.php"); ?>
<div class="edit-styling">
<h2> Edit Existing Plant: </h2>

<form action="/edit-plant?<?php echo http_build_query(array('id'=> $id)); ?>" method="post" nonvalidate>
<div>
    <label for="plant_id_text"> Plant's ID</label>
    <input id="plant_id_text" type="text" name="plant_id" value="<?php echo htmlspecialchars($sticky_playful_plant_id); ?>"/>
</div>
  <div>
    <label for="name_c_text"> Plant's Collequial Name</label>
    <input id="name_c_text" type="text" name="c_name"  value="<?php echo htmlspecialchars($sticky_c_name); ?>"/>
</div>
<div>
    <label for="name_s_text"> Plant's Scientific Name</label>
    <input id="name_s_text" type="text" name="s_name"value="<?php echo htmlspecialchars($sticky_s_name); ?>" />
</div>

<div>

          <div id="filter_head"> Play Type:</div>
<div>
  <div>
  <input type="checkbox" id="checkbox_constructive" name="constructive" value="1"<?php if($sticky_constructive) {echo "checked";}?> />
  <label for="checkbox_constructive"> Exploratory constrtuctive Play</label>
</div>
<div>
  <input type="checkbox" id="checkbox_sensory" name="sensory" value="2"<?php if($sticky_sensory) {echo "checked";}?> />
  <label for="checkbox_sensory"> Exploratory Sensory Play</label>
</div>
<div>
  <input type="checkbox" id="checkbox_physical" name="physical" value="3"<?php if($sticky_physical) {echo "checked";}?> />
  <label for="checkbox_physical"> Physcial Play</label>
</div>
<div>
  <input type="checkbox" id="checkbox_imaginative" name="imaginitve" value="4"<?php  if($sticky_imaginative) {echo "checked";}?> />
  <label for="checkbox_imaginative"> Imaganative Play</label>
</div>

<div>
  <input type="checkbox" id="checkbox_restore" name="restore" value="5"<?php  if($sticky_restorative) {echo "checked";}?> />
  <label for="checkbox_restore"> Restorative Play</label>
</div>

<div>
  <input type="checkbox" id="checkbox_expressive" name="expressive" value="6"<?php  if($sticky_expressive) {echo "checked";}?> />
  <label for="checkbox_expressive"> Expressive Play</label>
</div>

<div>
  <input type="checkbox" id="checkbox_rules" name="rules" value="7"<?php  if($sticky_rules) {echo "checked";}?>> />
  <label for="checkbox_rules"> Play with RUles </label>
</div>
<div>
  <input type="checkbox" id="checkbox_bio" name="bio" value="8"<?php  if($sticky_bio) {echo "checked";}?>/>
  <label for="checkbox_bio"> Bio Play </label>
</div>
<div id="filter_head"> Plant Growing Season:</div>
<div>
  <input type="checkbox" id="checkbox_pernnial" name="perrnial" value="9"<?php  if($sticky_perrnial) {echo "checked";}?>/>
  <label for="checkbox_pernnial"> Perrnial </label>
</div>
<div>
  <input type="checkbox" id="checkbox_annual" name="annual" value="10"<?php  if($sticky_annual) {echo "checked";}?>/>
  <label for="checkbox_annual"> Annual </label>
</div>
<div id="filter_head"> Light Needs:</div>
<div>
  <input type="checkbox" id="checkbox_sun" name="sun" value="11"<?php  if($sticky_sun) {echo "checked";}?>/>
  <label for="checkbox_sun"> Full Sun  </label>
</div>
<div>
  <input type="checkbox" id="checkbox_pshade" name="pshade" value="12"<?php  if($sticky_pshade) {echo "checked";}?>/>
  <label for="checkbox_pshade"> Partial Shade </label>
</div>
<div>
  <input type="checkbox" id="checkbox_fshade" name="fshade" value="13"<?php  if($sticky_fshade) {echo "checked";}?>/>
  <label for="checkbox_fshade"> Full Shade </label>
</div>
<div id="filter_head"> Plant Type</div>
<div>
  <input type="checkbox" id="checkbox_shrub" name="shrub" value="14"<?php  if($sticky_shrub) {echo "checked";}?>/>
  <label for="checkbox_shrub"> Shrub </label>
</div>
<div>
  <input type="checkbox" id="checkbox_grass" name="grass" value="15"<?php  if($sticky_grass) {echo "checked";}?>/>
  <label for="checkbox_grass"> Grass </label>
</div>
<div>
<input type="checkbox" id="checkbox_vine" name="vine" value="16"<?php  if($sticky_vine) {echo "checked";}?>/>
  <label for="checkbox_vine"> Vine</label>
</div>
<div>
  <input type="checkbox" id="checkbox_tree" name="tree" value="17"<?php  if($sticky_tree) {echo "checked";}?>/>
  <label for="checkbox_tree"> Tree </label>
</div>
<div>
  <input type="checkbox" id="checkbox_flower" name="flower" value="18"<?php  if($sticky_flower) {echo "checked";}?>/>
  <label for="checkbox_flower"> Flower</label>
</div>
<div>
  <input type="checkbox" id="checkbox_ground_cover" name="ground_cover" value="19"<?php  if($sticky_flower) {echo "checked";}?>/>
  <label for="checkbox_ground_cover"> Ground Cover </label>
</div>
</div>
<div>
<input type="hidden" name="edit-id" value="<?php echo htmlspecialchars($id) ?>" />
</div>
</div>
<input type="submit" value="Edit Plant" name="add_new_plant"/>
</form>
</body>
</div>

</html>
