<?php

namespace peoplelistphp\Include;
class crawler
{
    private $url = "https://people.php.net/";
    private $agent = "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/105.0.0.0 Safari/537.36";


    private const REGEX = [
        'FIND_NAME' => '#\<td .*?="name".(.*?)<#',
        'FIND_USERNAME' => '#\<td\s.*href.*?>(.*?)<#',
    ];

    public function set_curl_opt()
    {

        $curl = curl_init();
        $curl_setopt = $this->curloptdefault_opt();
        curl_setopt_array($curl,$curl_setopt);
        $response = curl_exec($curl);
        libxml_use_internal_errors(true);
        return $response;
    }

    public function curloptdefault_opt(): array{
        return[
            CURLOPT_URL => $this->url,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            ];
    }

    public function fetch_data(): void
    {

        $data = $this->set_curl_opt();
        preg_match_all(self::REGEX['FIND_NAME'], $data, $names);
        preg_match_all(self::REGEX['FIND_USERNAME'], $data, $usernames);

        $result_array = array_combine($usernames[1], $names[1]);
        print_r($result_array);

    }

}