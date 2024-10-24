<?php
require_once __DIR__ . '/../lib/route.php';
require_once __DIR__ . '/../lib/view.php';
require_once __DIR__ . '/../models/apiresponse.php';
require_once __DIR__ . '/../auth/company-only.php';
require_once __DIR__ . '/../auth/authenticated.php';
require_once __DIR__ . '/../controllers/csv-export.controller.php';
require_once __DIR__ . '/../controllers/delete-lowongan.controller.php';
require_once __DIR__ . '/../controllers/download-file.controller.php';
require_once __DIR__ . '/../controllers/search.controller.php';


Route::get("/api/something", [NotAuthenticated::class, function(){
    return new APIResponse(array(
        "a" => "12",
        "b" => 456
    ));
}]);

Route::get("/api/csv/{int}", [CompanyOnly::class, CSVExportController::class]);
Route::get("/api/search", [SearchController::class]);


Route::post("/api/{int}/delete", [CompanyOnly::class, DeleteLowonganController::class]);

Route::get("/uploads/cv/{string}", [Authenticated::class, DownloadFileController::class]);
Route::get("/uploads/videos/{string}", [Authenticated::class, DownloadFileController::class]);