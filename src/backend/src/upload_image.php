<?php

// Retrieve an image via POST and convert it to grayscale. Then, store the image as a blob in a Postgres table called 'images'.
// The image is stored as a blob in the table so that it can be retrieved as a blob by the frontend.

// Used to convert an image to grayscale
#require_once('grayscale.php');

// Connect to the database
#require_once('database.php');

// Check if the image was passed
if (!isset($_FILES['image'])) {
  echo 'No image was passed';
  exit();
}

// Retrieve the image
$image = $_FILES['image'];
$im = new Imagick();
$im->readimage($image['tmp_name']);
$im->setImageType(Imagick::IMGTYPE_GRAYSCALE);

header('Content-type: image/jpeg');
echo $im;

// // Check if the image is valid
// if ($image['error'] !== 0) {
//   echo 'The image passed was invalid';
//   exit();
// }

// // Get the image's extension
// $extension = pathinfo($image['name'], PATHINFO_EXTENSION);

// // Check if the image's extension is valid
// if ($extension !== 'jpg' && $extension !== 'jpeg' && $extension !== 'png') {
//   echo 'The image passed was invalid';
//   exit();
// }

// // Get the image's contents
// $image_contents = file_get_contents($image['tmp_name']);


// $image_contents = grayscale($image_contents);

// // Store the image in the database as a blob
// $statement = $database->prepare('INSERT INTO images (image) VALUES (:image)');
// $statement->bindValue(':image', $image_contents, PDO::PARAM_LOB);
// $statement->execute();
