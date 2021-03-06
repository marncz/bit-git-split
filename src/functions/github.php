<?php
include_once('config.php');
/*
  Simple HTTP GET call to the GitHub API
*/
function call_github_api ($url, $params = array() ) {

  $params['access_token'] = main_config("github_token");
  $params_parsed          = http_build_query($params);

  $url = "https://api.github.com/repos/". $url ."?". $params_parsed;
  ini_set('user_agent','Mozilla/4.0 (compatible; MSIE 6.0)');
  return json_decode( file_get_contents($url), true );


}

/*
    Get repositor's BITCOIN.txt file and parse users along with their Bitcoin addresses
*/
function get_bitcoin_contributors (){

  $bitcoin_txt_url = "https://raw.githubusercontent.com/". main_config("repo_name") ."/master/BITCOIN.txt";
  $html_response = file_get_contents($bitcoin_txt_url);
  $contributors = explode(PHP_EOL, $html_response);

  $final = array();

  foreach ($contributors as $contributor)
  {
    $ex = explode(":", $contributor);
    if( $ex[0] )
        $final[ $ex[0] ] = $ex[1];
  }

  return $final;
}

/*
    Get repository's contributors, sorted by the most nubmer of contributions
*/
function get_repo_contributors ()
{

  $response_json = call_github_api( main_config('repo_name') ."/contributors" );
  $contributors = array();
  $to_divide = 0;

  foreach ($response_json as $user){

      if( is_on_bitcoin_payroll( $user['login'] ) )
      {
        $to_divide += $user['contributions'];
        $contributors[ $user['login'] ] = $user['contributions'];
      }
  }

  return array("to_divide" => $to_divide, "users" => $contributors);

}

/*
    Check if an user from teh contributors is also avaliable in the BITCOIN.txt file
*/
function is_on_bitcoin_payroll ( $username )
{
  $contributors = get_bitcoin_contributors ();
  if ( array_key_exists( $username, $contributors ) ){
    return true;
  } else {
    return false;
  }

}

/*
    Returns an array of $bitcoin_address => $bitcoin_amount, ready to be send!
*/
function divide_et_impera ( $bitcoin_amount )
{

  $result = get_repo_contributors();
  $contributors = $result['users'];
  $bitcoin_addresses = get_bitcoin_contributors();

  $to_divide = $result['to_divide'];

  $single_unit = $bitcoin_amount / $to_divide;
  $final_divide = array();

  foreach ( $contributors as $username => $commits )
  {
      $bitcoin = $bitcoin_addresses[ $username ];
      $final_divide[ $bitcoin ] = number_format( $commits * $single_unit, 8);
  }

  return $final_divide;
}



?>
