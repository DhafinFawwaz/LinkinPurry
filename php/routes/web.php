<?php
require_once __DIR__ . '/../lib/route.php';
require_once __DIR__ . '/../lib/view.php';
require_once __DIR__ . '/../auth/authenticated.php';
require_once __DIR__ . '/../auth/company-only.php';
require_once __DIR__ . '/../auth/jobseeker-only.php';
require_once __DIR__ . '/../auth/not-authenticated.php';
require_once __DIR__ . '/../controllers/login.controller.php';
require_once __DIR__ . '/../controllers/profile.controller.php';
require_once __DIR__ . '/../controllers/register.controller.php';
require_once __DIR__ . '/../controllers/logout.controller.php';
require_once __DIR__ . '/../controllers/detail-lamaran.controller.php';
require_once __DIR__ . '/../controllers/lowongan.controller.php';
require_once __DIR__ . '/../controllers/home-company.controller.php';
require_once __DIR__ . '/../controllers/tambah-lowongan-company.controller.php';
require_once __DIR__ . '/../controllers/edit-lowongan-company.controller.php';
require_once __DIR__ . '/../controllers/detail-lowongan-company.controller.php';
require_once __DIR__ . '/../controllers/home-jobseeker.controller.php';
require_once __DIR__ . '/../controllers/detail-lowongan-jobseeker.controller.php';
require_once __DIR__ . '/../controllers/riwayat-lamaran.controller.php';



Route::on404(function(){
    return view("404.php");
});

Route::get("/login", [NotAuthenticated::class, function(){
    return view(path: "login.php");
}]);
Route::post("/login", [NotAuthenticated::class, LoginController::class]);

Route::get("/register", [NotAuthenticated::class, Register::class]);
Route::post("/register", [NotAuthenticated::class, Register::class]);


// Route::get("/register/jobseeker", [NotAuthenticated::class, function(){
//     return view("register/register-jobseeker.php");
// }]);
// Route::post("/register/jobseeker", [NotAuthenticated::class, RegisterJobseeker::class]);


// Route::get("/register/company", [NotAuthenticated::class, function(){
//     return view("register/register-company.php");
// }]);
// Route::post("/register/company", [NotAuthenticated::class, RegisterCompany::class]);

Route::get("/home-company",  [CompanyOnly::class, HomeCompanyController::class]);
Route::post("/home-company",  [CompanyOnly::class, HomeCompanyController::class]);

Route::get("/tambah-lowongan-company",  [CompanyOnly::class, TambahLowonganCompanyController::class]);
Route::post("/tambah-lowongan-company",  [CompanyOnly::class, TambahLowonganCompanyController::class]);

Route::get("/edit-lowongan-company",  [CompanyOnly::class, EditLowonganCompanyController::class]);
Route::post("/edit-lowongan-company",  [CompanyOnly::class, EditLowonganCompanyController::class]);

Route::get("/detail-lowongan-company",  [CompanyOnly::class, DetailLowonganCompanyController::class]);
Route::post("/detail-lowongan-company",  [CompanyOnly::class, DetailLowonganCompanyController::class]);

Route::get("/", [HomeJobseekerController::class]);
Route::post("/home-jobseeker", [JobseekerOnly::class, HomeJobseekerController::class]);

Route::get("/detail-lowongan-jobseeker", [JobseekerOnly::class, DetailLowonganJobseekerController::class]);
Route::post("/detail-lowongan-jobseeker", [JobseekerOnly::class, DetailLowonganJobseekerController::class]);

Route::get("/riwayat-lamaran", [JobseekerOnly::class, RiwayatLamaranController::class]);
Route::post("/riwayat-lamaran", [JobseekerOnly::class, RiwayatLamaranController::class]);

Route::get("/profile",  [Authenticated::class, ProfileController::class]);
Route::post("/profile",  [Authenticated::class, ProfileController::class]);

Route::post("/logout", [Authenticated::class, LogoutController::class]);


// currently only support {int} and {string}

// /lowongan_id
Route::get("/{int}",  [Authenticated::class, LowonganController::class]);

// /lowongan_id/lamaran_id
Route::get("/{int}/{int}",  [Authenticated::class, LamaranController::class]);
Route::post("/{int}/{int}",  [Authenticated::class, LamaranController::class]);

