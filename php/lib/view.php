<?

function view(string $path, array $data = null){
    require_once __DIR__ . "/../views/" . $path;
}