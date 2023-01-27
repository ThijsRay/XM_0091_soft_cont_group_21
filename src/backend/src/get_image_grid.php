<?php

// Connect to the Postgres database and get 9 random images from the table 'images'. Then, combine the nine images into a 3x3 grid with ImageMagick and return the final image to the user.
require('database.php');

function get_9_random_images($db)
{
  // Get 9 random images from the database
  $result = pg_query($db, "SELECT image FROM images ORDER BY random() LIMIT 9")
    or die('Query failed: ' . pg_last_error());

  // Create an array to store the image paths
  $images = array();

  // Placeholder image
  $placeholder = new Imagick('/media/placeholder.png');

  // Loop through the images and add them to the array
  while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
    foreach ($line as $col_value) {
      $value = base64_decode($col_value);
      if (!$value) {
        $image = $placeholder;
      } else {
        $image = new Imagick();
        $image->readimageblob($value);
      }
      array_push($images, $image);
    }
  }
  // Free the result from memory
  pg_free_result($result);
  pg_close($db);

  // Pad the array to 9 images
  for ($x = sizeof($images); $x < 9; $x += 1) {
    array_push($images, $placeholder);
  }

  $combined = new Imagick();
  for ($row = 0; $row < 9; $row += 3) {
    $row_image = new Imagick();
    for ($column = $row; $column < $row + 3; $column += 1) {
      $row_image->addImage($images[$column]);
    }
    $row_image->resetIterator();
    $combined->addImage($row_image->appendImages(false));
  }
  $combined->resetIterator();
  $i = $combined->appendImages(true);
  $i->setImageFormat("png");
  return $i;
}


// Return the image to the user
header('Content-Type: image/png');
echo get_9_random_images($db);
