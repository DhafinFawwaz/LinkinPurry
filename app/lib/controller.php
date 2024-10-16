<?php
require_once __DIR__ . '/../lib/view.php';

abstract class Controller implements IHandler{
    protected function view(string $path, $data = null){ view($path, $data); }
    function redirect($url, $statusCode = 303)
    {
        header('Location: ' . $url, replace: true);
        exit();
    }
}