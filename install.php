<?php
include_once('./src/include.php');
/*

Install script!

*/


print "Bit Git Installer v0.1";
print "\n-----------------";

// Create a webhook secret string
update_bc_config( "[callback_secret]", md5( date("m-d-Y h:i") ));

print "\n\n1) Checking if your Blockchain API web server is running....";

if( call_blockchain_api("")["error"] ){
    print "\n\033[0;32m[ Running ]\033[0m Blockchain API running on port :3000\n\n";
} else {
    print "\n\033[0;32m[ Not running ]\033[0m Blockchain API is not running on port :3000\n\n";
    $blockchain_api = readline("Blockchain API port: ");
}

if( main_config("repo_name") == "[repo_name]")
{
    $repo_name = readline("Your repo name: ");
    update_main_config("[repo_name]", $repo_name);
    print("Saved sucesfully!\n");
}

if( bc_config("blockchain_api") == "[blockchain_api]")
{
    $blockchain_api = readline("Your BlockChain API key: ");
    update_bc_config("[blockchain_api]", $blockchain_api);
    print("Saved sucesfully!\n");
}

if( main_config("github_token") == "[github_token]")
{
    $github_token = readline("Your GitHub personal token: ");
    update_main_config("[github_token]", $github_token);
    print("Saved sucesfully!\n");
}


print("------------------------------\n");
print("Installation finished!\n");
print("------------------------------\n");
?>
