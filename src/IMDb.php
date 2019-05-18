<?php

namespace IMDb;

use Exception;

final class IMDb {

    /**
     * @var object
     */
    private $out;

    /**
     * @var string
     */
    private $url;
    
    /**
     * @var array
     */
    private $result = [];

    public function __construct()
    {
        echo "works!\n";
    }

    /**
     * @param string
     * @throws Exception
     */
    public function curls($url)
    {
        $ch = curl_init($url);

        $options = [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_URL => $url,
        ];

        curl_setopt_array($ch, $options);

        $this->out = curl_exec($ch);

        $error = curl_error($ch);
        $errno = curl_errno($ch);
        curl_close($ch);

        if($error) {
            goto curl_error;
        }

        return $this->out;

        curl_error: {
            throw new Exception("Failed curl, error: {$errno} : {$error}");
        }
    }

    public function query($query)
    {
        $query = str_replace(" ", "+", $query);
        $this->url = "https://www.imdb.com/find?ref_=nv_sr_fn&q={$query}&s=all";
    }

    private function title()
    {
        $result = [];
        $q = $this->curls($this->url);

        if(!empty($q)) {
            preg_match_all('!<a href="\/title\/tt(.*?)\/?ref_=(.*?)">(.*?)<\/a>!', $q, $match, PREG_PATTERN_ORDER);

            $result = $match[3];
        }

        return $result;
    }

    public function exec()
    {
        var_dump($this->title());
    }

}