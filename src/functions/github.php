<?php
include_once('./src/functions/config.php');

/*

Call GitHub and gather contributors along with their Bitcoin addresses

@return array
*/
function get_contributors (){

  $bitcoin_txt_url = "https://raw.githubusercontent.com/". main_config("repo_name") ."/master/BITCOIN.txt";
  $html_response = file_get_contents($bitcoin_txt_url);
  $contributors = explode(PHP_EOL, $html_response);

  $final = array();

  foreach ($contributors as $contributor)
  {
    $ex = explode(":", $contributor);
    $final[ $ex[0] ] = $ex[1];
  }

  return $final;
}



?>
