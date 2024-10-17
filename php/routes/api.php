<?php
require_once __DIR__ . '/../lib/route.php';
require_once __DIR__ . '/../lib/view.php';
require_once __DIR__ . '/../models/apiresponse.php';


Route::get("/api/something", [NotAuthenticated::class, function(){
    return new APIResponse(array(
        "a" => "12",
        "b" => 456
    ));
}]);