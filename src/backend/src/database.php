<?php

$pwd = getenv('POSTGRES_PASSWORD', true);

global $db;
$db = pg_connect("host=database dbname=postgres user=postgres password=$pwd")
  or die('Could not connect: ' . pg_last_error());

$query = "CREATE TABLE IF NOT EXISTS images (
  id        uuid PRIMARY KEY DEFAULT gen_random_uuid(),
  image     text NOT NULL
)";

$result = pg_query($db, $query) or die('Failed to insert table into database: ' . pg_last_error());
