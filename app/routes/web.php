<?php
require_once __DIR__ . '/../lib/route.php';
require_once __DIR__ . '/../lib/view.php';
require_once __DIR__ . '/../lib/authenticated.php';
require_once __DIR__ . '/../lib/not-authenticated.php';
require_once __DIR__ . '/../controllers/login.controller.php';
require_once __DIR__ . '/../controllers/register/register-jobseeker.controller.php';
require_once __DIR__ . '/../controllers/register/register-company.controller.php';
require_once __DIR__ . '/../controllers/logout.controller.php';



Route::on404(function(){
    return view("404.php");
});

Route::get("/login", [NotAuthenticated::class, function(){
    return view(path: "login.php");
}]);
Route::post("/login", [NotAuthenticated::class, Login::class]);


Route::get("/register/jobseeker", [NotAuthenticated::class, function(){
    return view("register/register-jobseeker.php");
}]);
Route::post("/register/jobseeker", [NotAuthenticated::class, RegisterJobseeker::class]);


Route::get("/register/company", [NotAuthenticated::class, function(){
    return view("register/register-company.php");
}]);
Route::post("/register/company", [NotAuthenticated::class, RegisterCompany::class]);

Route::get("/profile",  [Authenticated::class, function() {
    return view("profile.php");
}]);

Route::post("/logout", [Authenticated::class, Logout::class]);
