<?php
class Route {
    private static $route404 = array();
    private static $routes = array(
        "GET" => array(),
        "POST" => array(),
        "PUT" => array(),
        "HEAD" => array(),
        "DELETE" => array(),
        "PATCH" => array(),
        "OPTIONS" => array(),
        "CONNECT" => array(),
        "TRACE" => array()
    );



    public static function on404(callable $callback) {
        Route::$route404["404"] = $callback;
    }

    public static function GET(string $route, callable $callback) { Route::$routes["GET"][$route] = $callback;}
    public static function POST(string $route, callable $callback) { Route::$routes["POST"][$route] = $callback;}
    public static function PUT(string $route, callable $callback) { Route::$routes["PUT"][$route] = $callback;}
    public static function HEAD(string $route, callable $callback) { Route::$routes["HEAD"][$route] = $callback;}
    public static function DELETE(string $route, callable $callback) { Route::$routes["DELETE"][$route] = $callback;}
    public static function PATCH(string $route, callable $callback) { Route::$routes["PATCH"][$route] = $callback;}
    public static function OPTIONS(string $route, callable $callback) { Route::$routes["OPTIONS"][$route] = $callback;}
    public static function CONNECT(string $route, callable $callback) { Route::$routes["CONNECT"][$route] = $callback;}
    public static function TRACE(string $route, callable $callback) { Route::$routes["TRACE"][$route] = $callback;}


    public static function clean(string $url) {
        // remove last '/'
        if($url[strlen($url)-1] == "/")
            $url = substr($url, 0, strlen($url)-1);
        return $url;
    }

    public static function handle() {
        $route = Route::clean($_SERVER['REQUEST_URI']);
        $httpMethod = $_SERVER['REQUEST_METHOD'];
        if(!array_key_exists($httpMethod, Route::$routes)) {
            // echo "HTTP Method not allowed: " . $httpMethod;
            (Route::$route404["404"])();
            return;
        }
        if(!array_key_exists($route, Route::$routes[$httpMethod])) {
            // echo "Route not found: " . $route;
            (Route::$route404["404"])();
            return;
        }
        (Route::$routes[$httpMethod][$route])();
    }
}