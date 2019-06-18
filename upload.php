<?php
// filename: upload.php
// only accessible if user type is admin

require_once("inc/header.inc.php");
require_once("inc/dbconnect.inc.php");

if(!isset($_SESSION['loggedin']) || $_SESSION['role'] != 1) {
    echo "<div class='error'>Error! You do not have permission to view this page. </div>";
} else {
?>

<div class="grid-container">
    <div class="grid-x grid-padding-x">
        <h2>Upload New Work</h2>
    </div>
    <div class="grid-x grid-padding-x">
        <form action="processupload.php" method="POST" enctype="multipart/form-data">
            <label for="title">Title</label>
            <input type="title" id="title" name="title" required>
            <br>
            <label for="category">Category</label>
            <select id="category" name="category">
                <option value="other">None/Other</option>
                <option value="drawing">Drawing</option>
                <option value="painting">Painting</option>
                <option value="sketch">Sketch</option>
                <option value="photo">Photography</option>
                <option value="3d">3D Art</option>
            </select>
            <br>
            <label for="premium">Set as Premium? </label>
            <input type="radio" name="premium" value="1"> Yes <br>
            <input type="radio" name="premium" value="0" checked="checked"> No <br>
            <br>
            Select image to upload:
            <input type="file" name="fileupload" id="fileupload" accept="image/*">
            <br>
            <input class="button" type="submit" value="Upload">
        </form>
    </div>
</div>

<?php 
}

require_once("inc/footer.inc.php");

?>