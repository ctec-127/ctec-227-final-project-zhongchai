<?php
// login page with login and register form goes here

require_once("inc/header.inc.php");
?>

<div class="grid-container">
    <div class="grid-x grid-padding-x">
        <h2>Returning users log in</h2>
    </div>
    <div class="grid-x grid-padding-x">
        <form action="processlogin.php" method="POST">
            <label for="email">Email</label>
            <br>
            <input type="email" name="email" id="email" required>
            <br>
            <label for="password">Password</label>
            <br>
            <input type="password" name="password" id="password" required>
            <br>
            <input class="button" type="submit" value="Login">
            <br>
        </form>
    </div>
    <div class="grid-x grid-padding-x">
        <h2>New users register here</h2>
    </div>
    <div class="grid-x grid-padding-x"> 
        <form action="processregister.php" method="POST">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
            <br>
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required>
            <br>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
            <br>
            <label for="role">Are you a creator? </label>
            <input type="radio" name="role" value="admin"> Yes <br>
            <input type="radio" name="role" value="user" checked="checked"> No <br>
            <br>
            <input class="button" type="submit" value="Register">
            <br>
        </form>
    </div>
</div>
<?php 

require_once("inc/footer.inc.php");

?>