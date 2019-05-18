<?php

require 'src/IMDb.php';

use IMDb\IMDb;

$imdb = new IMDb("dilan");
$result = $imdb->exec();

if(is_array(@count($result)) === 0) {
    print("Not found\n");
}

var_dump($result);