<?php

require_once("Router.php");





// // logout route
// Router::get('/logout', "postController", "logout");


Router::get("/dash", "viewController", "dash");






// not found 
header("HTTP/1.0 404 Not Found");
$response = array(
    'status' => 'success',
    'message' => 'this route is not found on this server'
);

echo json_encode($response);
exit();