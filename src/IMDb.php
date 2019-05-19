<?php

namespace IMDb;

use Exception;

/**
 * @author Muhammad Rizkhal Lamaau <lamaaurizkhal@gmail.com>
 * @license MIT
 * @version 0.0.1
 */

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
     * @var string
     */
    private $query;
    
    /**
     * @var array
     */
    private $result = [];

    /**
     * @var string
     */
    private $cookieFile;

    public function __construct($query)
    {
        echo "works!\n";
        $query = str_replace(" ", "+", $query);
        $this->url = "https://www.imdb.com/find?ref_=nv_sr_fn&q={$query}&s=all";
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
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_USERAGENT => "Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:65.0) Gecko/20100101 Firefox/65.0",
            CURLOPT_COOKIEFILE => $this->cookieFile,
            CURLOPT_COOKIEJAR => $this->cookieFile
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

    /**
     * @method get title
     * @return array
     */
    private function title()
    {
        $q = $this->curls($this->url);
        $result = [];
        if(!empty($q)) {
            preg_match_all('!<a href="\/title\/.*?\/\?ref_=fn_al_tt_.*?">(.*?)<\/a>!', $q, $match, PREG_PATTERN_ORDER);
            $result = $match[1];

            $result = array_map(function($v) {
                return trim(strip_tags($v));
            }, $result);
        }

        return $result;
    }

    /**
     * @method get cover
     * @return array
     */
    private function cover()
    {
        $q = $this->curls($this->url);
        $result = [];
        if(!empty($q)) {
            preg_match_all('!<a href="\/title\/.*?\/?ref_=.*?" ><img src="(.*?)" \/><\/a>!', $q, $matches);
            $result = $matches[1];
        }

        return $result;
    }

    /**
     * @method executor
     * @return array
     */
    public function exec()
    {
        $this->result['title'] = $this->title();
        $this->result['cover'] = $this->cover();
        return $this->result;
    }

}