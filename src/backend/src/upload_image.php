<?php

// Connect to the database
require_once('database.php');

header("Location: /");

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
$im->adaptiveResizeImage(200, 200);

$encoded = base64_encode($im->getImageBlob());

$query = pg_prepare($db, "insert_image", "INSERT INTO images (image) VALUES ($1)") or die('Failed to prepare image insertion: ' . pg_last_error($db));
$result = pg_execute($db, "insert_image", array($encoded)) or die('Failed to insert image: ' . pg_last_error($db));
