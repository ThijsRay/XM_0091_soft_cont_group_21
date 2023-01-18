<?php

// Connect to the Postgres database and get 9 random images from the table 'images'. Then, combine the nine images into a 3x3 grid with ImageMagick and return the final image to the user.

// Connect to the database
$dbconn = pg_connect("host=localhost dbname=images user=postgres password=postgres")
  or die('Could not connect: ' . pg_last_error());

// Get 9 random images from the database
$result = pg_query($dbconn, "SELECT * FROM images ORDER BY random() LIMIT 9")
  or die('Query failed: ' . pg_last_error());

// Create an array to store the image paths
$images = array();

// Loop through the images and add them to the array
while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
  foreach ($line as $col_value) {
    array_push($images, $col_value);
  }
}

// Combine the images into a 3x3 grid
exec("convert -size 600x600 xc:white -page +0+0 $images[0] -page +200+0 $images[1] -page +400+0 $images[2] -page +0+200 $images[3] -page +200+200 $images[4] -page +400+200 $images[5] -page +0+400 $images[6] -page +200+400 $images[7] -page +400+400 $images[8] -layers flatten grid.png");

// Return the image to the user
header('Content-Type: image/png');
readfile('grid.png');

// Free the result from memory
pg_free_result($result);

// Close the database connection
pg_close($dbconn);
