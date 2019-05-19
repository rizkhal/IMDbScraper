<?php

require 'src/IMDb.php';

use IMDb\IMDb;

/**
 * @author Muhammad Rizkhal Lamaau <lamaaurizkhal@gmail.com>
 * @license MIT
 * @version 0.0.1
 */

$query  = "dilan";
$imdb   = new IMDb($query);
$result = $imdb->exec();

if(is_array(@count($result)) === 0) {
    print("Not found\n");
}

print(json_encode($result, JSON_PRETTY_PRINT));