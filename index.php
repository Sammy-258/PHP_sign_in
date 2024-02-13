<?php


$current_uri = $_SERVER["REQUEST_URI"];
if($current_uri==="/" || isset($_GET["code"])){

    session_start();
    require_once 'vendor/autoload.php';

    // init configuration
    $clientID = '345366249791-5d0ab9cfhph7pm23jmmgems2is85ifn8.apps.googleusercontent.com';
    $clientSecret = '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';
    $redirectUri = 'http://localhost/PHP_sign_in/';

    // create Client Request to access Google API
    $client = new Google_Client();
    $client->setClientId($clientID);
    $client->setClientSecret($clientSecret);
    $client->setRedirectUri($redirectUri);
    $client->addScope("email");
    $client->addScope("profile");

    // authenticate code from Google OAuth Flow
    if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    if (isset($token['access_token'])) {
        $client->setAccessToken($token['access_token']);

        // get profile info
        $google_oauth = new Google_Service_Oauth2($client);
        $google_account_info = $google_oauth->userinfo->get();
        $_SESSION["google_account_info"] = $google_account_info;

        $email =  $google_account_info->email;
        $name =  $google_account_info->name;

        header("location: dash");
        

        // now you can use this profile info to create an account on your website and make the user logged in.
    }else {
        // header("location: cloth.php");
        // Handle the case where access_token is not retrieved
        // echo "Failed to retrieve access token. Please try again.";
        header("location: dash");
        
        
    }

    // now you can use this profile info to create account in your website and make user logged in.
    } else {
    echo "<a href='".$client->createAuthUrl()."'>Google Login</a>";
    }
}else{
    require_once("./app/init.php");
}

// echo "workinf";

?>