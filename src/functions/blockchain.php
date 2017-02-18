<?php
include_once('./src/functions/config.php');

/*

  Call local Blockchain API web service running

*/
function call_api ($url, $params)
{
    $params["api_code"] = blockchain_config("api_code");
    $url_base = "http://127.0.0.1:".blockchain_config("api_port")."/". $url ."?". http_build_query($params);

    $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url_base);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
        $html_response = curl_exec($ch);
    curl_close($ch);

    return json_decode( $html_response, true );
}

function create_wallet ()
{

    return call_api("api/v2/create", ["password" => "basic_password"]);

}


function validate_bitcoin () {



}







?>
