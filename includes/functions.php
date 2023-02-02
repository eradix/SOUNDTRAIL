<?php
//function for downloading mp3
//in the api
function getMp3($url)
{
    $encoded_url = urlencode($url);
    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => "https://t-one-youtube-converter.p.rapidapi.com/api/v1/createProcess?url=$encoded_url&format=mp3&responseFormat=json&lang=en",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
            "X-RapidAPI-Host: t-one-youtube-converter.p.rapidapi.com",
            "X-RapidAPI-Key: ecd7e05e40mshe583e4592994f5fp177822jsne2494177cf00"
        ],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        return "cURL Error #:" . $err;
    } else {
        return json_decode($response);
    }
}

//function for redirecting to a specific url and in a new tab
function redirect_to($url)
{
    echo '<script> window.open("' . $url . '", \'_blank\'); </script>';
}

//for debugging-> print_r
function dd($var)
{
    echo "<pre>";
    print_r($var);
    echo "</pre>";
}

//sort multidimensional array by value
function array_sort_by_column(&$arr, $col, $dir = SORT_ASC)
{
    $sort_col = array();
    foreach ($arr as $key => $row) {
        $sort_col[$key] = $row[$col];
    }

    array_multisort($sort_col, $dir, $arr);
}

function clean_data($input)
{
    $input = trim($input);
    $input = stripslashes($input);
    $input = addslashes($input);
    return $input;
}
