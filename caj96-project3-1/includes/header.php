<header>
<nav>

<?php if(!is_user_logged_in()){ ?>
    <ul><li><a href="/log-in">Login</a></li></ul>
<?php } ?>


<ul><li><a href="/">Home</a></li></ul>
<?php if(is_user_logged_in()){ ?>
    <ul><li><a href="/admin-home">Admin Home </a></li></ul>
    <ul><li><a href="<?php echo logout_url(); ?>">Log Out</a></li>
<?php } ?>
<p> Playful Plants</p>

</nav>
</header>
