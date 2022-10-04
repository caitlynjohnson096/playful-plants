
<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" type="text/css" href="/public/site.css" media="all" />
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <title>TODO: 404</title>
</head>

<body>
<?php include("includes/header.php"); ?>



<div class="log-in-page">
<h2> Log In </h2>
<p> Please Log-In if you are an admin of this site, so that you can access additional materials/pages on this site.</p>

<p><strong>If you are not an admin, please naviagate back to the home page all of the information that you need is there.</strong> </p>
<div class="log-in">
<?php echo_login_form('/admin-home', $session_messages); ?>
</div>
</div>

</body>

</html>
