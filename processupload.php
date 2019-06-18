<?php
// filename: processupload.php
// This file is accessed when the user submits the upload form
// It creates a new entry in the db for the work, then generates a page for the work

require_once("inc/header.inc.php");
require_once("inc/dbconnect.inc.php");
require_once("inc/functions.inc.php");

$success = false;
$error = false;

if($_SERVER["REQUEST_METHOD"] == "POST"){
    // connect to the db
    $db = db_connection();

    // Check required fields to see if they were filled in
    if (empty($_POST['title']) || empty($_POST['category'])){
        $error = true;
        echo 'error 1';
    }

    // Check if a radio button was selected
    if(isset($_POST['premium'])){
        if($_POST['premium'] == 1) {
            $setpremium = 1;
        } elseif($_POST['premium'] == 0) {
            $setpremium = 0;
        } else {
            $error = true;
            echo 'error 2';
        }
    } else {
        $error = true;
        echo 'error 3';
    }

    // upload the image file to the folder
    $target_dir = "work/upload/";
    $target_file = $target_dir . basename($_FILES["fileupload"]["name"]);
    $filepath = basename($_FILES["fileupload"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileupload"]["tmp_name"]);
        if ($check == false) {
            echo "File is not an image.";
            $error = true;
        }
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $error = true;
        }
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $error = true;
        }
    }


    if ($error) {
        echo '<div class="error">All fields are required.</div>';
    } else {
        // finalizes uploaded file
        if (move_uploaded_file($_FILES["fileupload"]["tmp_name"], $target_file)) {
            echo "Uploaded successful.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }

        $username = $_SESSION['username'];
        $title = test_input($_POST['title']);
        $category = test_input($_POST['category']);
        $premium = $setpremium;
        $sql = "INSERT INTO work (username, work_title, filepath, category, premium) VALUES ('$username','$title','$filepath','$category','$premium')";
            // echo $sql;
        $result = $db->query($sql);

        if($db->error){
            echo '<div class="error">' . $db->error . '</div>';
        } else {
            // find the current work_id of the uploaded file
            $sql2 = "SELECT * FROM work ORDER BY work_id DESC LIMIT 1";
            $result2 = $db->query($sql2);
            $row = $result2->fetch_assoc();
            $workid = $row['work_id'];
            // pass it into the function to create a new page for the uploaded work
            create_work_page($workid);
            echo '<div class="success">Your work <a href="work/' . $workid . '.php">"' . $title . '"</a> is now ready to view!</div>';
            $success = true;
        }
    }
} else {
    echo '<div class="error">Go away, you don\'t belong here! </div>';
}
require_once("inc/footer.inc.php");
?>