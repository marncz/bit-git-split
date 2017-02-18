<?php
include_once('./config/blockchain.php');
include_once('./config/main.php');

/*
Returns config variables for the Blockchain settings
*/
function bc_config( $config_name )
{
  global $blockchain_main;
  return $blockchain_main[$config_name];
}

/*
Returns config variables for the Blockchain settings
*/
function main_config( $config_name )
{
  global $config_main;
  return $config_main[$config_name];
}


/*
    Update config/blockchain.php
*/
function update_bc_config ($find, $replace)
{

    global $blockchain_main;
    if ( array_key_exists($find, $blockchain_main) )
      $find = bc_config($find);

    $str = file_get_contents("./config/blockchain.php");
    $str = str_replace($find, $replace, $str);

    file_put_contents("./config/blockchain.php", $str);

}


/*
    Update config/blockchain.php
*/
function update_main_config ($find, $replace)
{

    global $config_main;
    if ( array_key_exists($find, $config_main) )
      $find = bc_config($find);

    $str = file_get_contents("./config/main.php");
    $str = str_replace($find, $replace, $str);

    file_put_contents("./config/main.php", $str);

}


?>
