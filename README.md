# PHP_People_list
An stude case for a web crawler in php, which return the list o users on the site https://people.php.net/

Utilizing Curl and REGEX the code lists 2 arrays, one containing the username and the other the full name,
the results are combined in one array and printed out.


Using this REGEX we are able to locate and find all the matches. 
```
 private const REGEX = [
        'FIND_NAME' => '#\<td .*?="name".(.*?)<#',
        'FIND_USERNAME' => '#\<td\s.*href.*?>(.*?)<#',
    ];
```

Using pregmatch_all() we are able store it in its respective variables and prit the combined arrays.
```
    public function fetch_data(): void
    {

        $data = $this->set_curl_opt();
        preg_match_all(self::REGEX['FIND_NAME'], $data, $names);
        preg_match_all(self::REGEX['FIND_USERNAME'], $data, $usernames);

        $result_array = array_combine($usernames[1], $names[1]);
        print_r($result_array);

    }
```
