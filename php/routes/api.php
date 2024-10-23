<?php
require_once __DIR__ . '/../lib/route.php';
require_once __DIR__ . '/../lib/view.php';
require_once __DIR__ . '/../models/apiresponse.php';
require_once __DIR__ . '/../auth/company-only.php';
require_once __DIR__ . '/../controllers/csv-export.controller.php';
require_once __DIR__ . '/../controllers/delete-lowongan.controller.php';


Route::get("/api/something", [NotAuthenticated::class, function(){
    return new APIResponse(array(
        "a" => "12",
        "b" => 456
    ));
}]);

Route::get("/api/csv/{int}", [CompanyOnly::class, CSVExportController::class]);


Route::post("/api/{int}/delete", [CompanyOnly::class, DeleteLowonganController::class]);