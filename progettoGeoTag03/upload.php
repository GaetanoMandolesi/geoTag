<?php
$uploadDir = __DIR__.'/img';

foreach ($_FILES as $file) {
    if (UPLOAD_ERR_OK === $file['error']) {
        $fileName = basename($file['name']);
        move_uploaded_file($file['tmp_name'], $uploadDir.DIRECTORY_SEPARATOR.$fileName);
    }
}
header("location: ./geoTag.php");
//open  "./geoTag.php";
?>
