<?php
include_once('./src/include.php');
/*

Install script!

*/


//change_config("/config/blockchain.php", "[your-api-key]", "");

print "Git Bit Installer v0.1";
print "\n-----------------";


print "\n\n1) Checking if your Blockchain API web server is running....";

if( call_api("")["error"] ){
    print "\n\033[0;32m[ Running ]\033[0m Blockchain API running on port :3000\n\n";
} else {
    print "\n\033[0;32m[ Not running ]\033[0m Blockchain API is not running on port :3000\n\n";
    $blockchain_api = readline("Blockchain API port: ");
}


?>
