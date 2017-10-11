<?php
$pictureName = $_FILES['picture']['name'];
$directory = 'images/';
$targetFile = $directory . $pictureName;
$fileType = pathinfo($pictureName, PATHINFO_EXTENSION);
$check = getimagesize($_FILES['picture']['tmp_name']);
if ($check) {
    if (!file_exists($targetFile)) {
        if ($fileType == 'jpg' || $fileType == 'png') {
            if ($_FILES['picture']['size'] < 1000000) {
                move_uploaded_file($_FILES['picture']['tmp_name'], $targetFile);
                echo 'Success';
            } else {
                die('Your file size is too large. Thanks !!!');
            }
        } else {
            die('Please use jpg or png image file. Thanks !!!');
        }
    } else {
        die('File already exist. Thanks !!!');
    }
} else {
    echo ('Please use an image file. Thanks !!!');
}
?>
<form action="" method="POST" enctype="multipart/form-data">
    <input type="file" name="picture" accept="image/*"/>
    <input type="submit" name="btn" value="SubmiT"/>
</form>