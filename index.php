<?php

require 'src/IMDb.php';

use IMDb\IMDb;

$imdb = new IMDb();
$imdb->query("dilan 199");
$imdb->exec();