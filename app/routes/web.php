<?php
require_once __DIR__ . '/../lib/route.php';
require_once __DIR__ . '/../lib/view.php';

Route::on404(function(){
    return view("404.php");
});

Route::get("/login", function(){
    return view("login.php");
});

Route::get("/register", function(){
    return view("register.php");
});