<?php
include_once('./src/functions/config.php');

/*

  Call local Blockchain API web service running

*/
function call_blockchain_api ($url, $params = [])
{
    $params["api_code"] = bc_config("api_code");
    $url_base = "http://127.0.0.1:".bc_config("api_port")."/". $url ."?". http_build_query($params);

    $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url_base);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
        $html_response = curl_exec($ch);
    curl_close($ch);

    return json_decode( $html_response, true );
}

function create_wallet ($password)
{

    return call_blockchain_api("api/v2/create", ["password" => $password]);

}

function create_wrapper_wallet ()
{

  $callback_url = "http://$_SERVER[HTTP_HOST]/webhook.php&secret=".$secret;
  $root_url = 'https://api.blockchain.info/v2/receive';

  $params = [
              "xpub"     =>  bc_config ("base_bitcoin"),
              "secret"   =>  bc_config ("callback_secret"),
              "key"      =>  bc_config ("api_code"),
              "callback" =>  urlencode( bc_config ("callback_url")."?secret=".bc_config("callback_secret") )
            ];

 $response = file_get_contents( "https://api.blockchain.info/v2/receive?". http_build_query($params) );


}


function send_bitcoin($address, $amount)
{

    $params = [
              "to"      => $address,
              "amount"  => ($amount * 100000000), // BTC to Satoshi
              ];

    $response = call_bitcoin_api("/merchant/".bc_config('wallet_guid')."/payment", $params);
    return $response;
}


function update_bc_config ($find, $replace){

  $file = "../../config/blockchain.php";

}



?>
