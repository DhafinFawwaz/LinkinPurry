<?php
require_once __DIR__ . '/../lib/route.php';
require_once __DIR__ . '/../lib/view.php';
require_once __DIR__ . '/../auth/authenticated.php';
require_once __DIR__ . '/../auth/not-authenticated.php';
require_once __DIR__ . '/../controllers/login.controller.php';
require_once __DIR__ . '/../controllers/profile.controller.php';
require_once __DIR__ . '/../controllers/register/register-jobseeker.controller.php';
require_once __DIR__ . '/../controllers/register/register-company.controller.php';
require_once __DIR__ . '/../controllers/logout.controller.php';
require_once __DIR__ . '/../controllers/lamaran.controller.php';
require_once __DIR__ . '/../controllers/lowongan.controller.php';



Route::on404(function(){
    return view("404.php");
});

Route::get("/login", [NotAuthenticated::class, function(){
    return view(path: "login.php");
}]);
Route::post("/login", [NotAuthenticated::class, LoginController::class]);


Route::get("/register/jobseeker", [NotAuthenticated::class, function(){
    return view("register/register-jobseeker.php");
}]);
Route::post("/register/jobseeker", [NotAuthenticated::class, RegisterJobseeker::class]);


Route::get("/register/company", [NotAuthenticated::class, function(){
    return view("register/register-company.php");
}]);
Route::post("/register/company", [NotAuthenticated::class, RegisterCompany::class]);

Route::get("/profile",  [Authenticated::class, ProfileController::class]);
Route::post("/profile",  [Authenticated::class, ProfileController::class]);

Route::post("/logout", [Authenticated::class, LogoutController::class]);


// currently only support {int} and {string}

// /lowongan_id
Route::get("/{int}",  [Authenticated::class, LowonganController::class]);

// /lowongan_id/lamaran_id
Route::get("/{int}/{int}",  [Authenticated::class, LamaranController::class]);

