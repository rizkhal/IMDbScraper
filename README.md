# IMDb Scraper
Scrape https://www.imdb.com

## Contoh penggunaan
```php
<?php

require 'src/IMDb.php';

use IMDb\IMDb;

$query  = "dilan";
$imdb   = new IMDb($query);
$result = $imdb->exec();

if(is_array(@count($result)) === 0) {
    print("Not found\n");
}

print(json_encode($result, JSON_PRETTY_PRINT));
```

## Hasil
```json
{
    "title": [
        "Dilan",
        "Dilan",
        "Dilan 1991",
        "Dilan 1990"
    ],
    "cover": [
        "https:\/\/m.media-amazon.com\/images\/M\/MV5BOTNiNGFlZTQtNzgwZi00NjAyLThiZGMtMmUzMDEzOTE0MTNlXkEyXkFqcGdeQXVyNzE2MjU3Mzk@._V1_UY44_CR0,0,32,44_AL_.jpg",
        "https:\/\/m.media-amazon.com\/images\/G\/01\/imdb\/images\/nopicture\/32x44\/film-3119741174._CB483525279_.png",
        "https:\/\/m.media-amazon.com\/images\/M\/MV5BNTM1OTMzZTEtYjQ0ZC00ZTZkLWIwYmQtOTU5Mzk1Mzg4NWI0XkEyXkFqcGdeQXVyNjMxNTEyMTM@._V1_UX32_CR0,0,32,44_AL_.jpg",
        "https:\/\/m.media-amazon.com\/images\/M\/MV5BYzM0NmQ2YzgtZWZkNC00N2JhLThjYzUtMDNlZDczMzJiMGY1XkEyXkFqcGdeQXVyNzkzODk2Mzc@._V1_UX32_CR0,0,32,44_AL_.jpg",
        "https:\/\/m.media-amazon.com\/images\/M\/MV5BNDVkMGE4ZDMtZDgwOC00NDQ4LWI1NGMtOGI0NzhkYWE4OTRhXkEyXkFqcGdeQXVyMjQwMDg0Ng@@._V1_UX32_CR0,0,32,44_AL_.jpg"
    ]
}
```