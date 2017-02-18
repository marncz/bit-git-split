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

?>
