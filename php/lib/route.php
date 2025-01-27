<?php
require_once __DIR__ . "/handler.php";
class Route {
    private static $baseUnsedUrl = "url-base-route";
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


    private static function arrayOfClassToInstance(array $array) {
        $result = array();
        foreach($array as $a) {
            if(is_string($a))
                $result[] = new $a();
            else
                $result[] = $a;
        }
        return $result;
    }

    private static function registerRoute(string $route, string $httpMethod, $handler) {
        if($route == "/") $route = self::$baseUnsedUrl;
        else if($route == self::$baseUnsedUrl) $route = "not-found";

        if(is_callable($handler)) {
            Route::$routes[$httpMethod][$route] = $handler;
        } else if(is_string($handler)) {
            /** @var IHandler */
            $instance = new $handler();
            Route::$routes[$httpMethod][$route] = $instance;
        } else if(is_array($handler)) {
            Route::$routes[$httpMethod][$route] = Route::arrayOfClassToInstance($handler);
        }
    }
    public static function GET(string $route, $handler) { Route::registerRoute($route, "GET", $handler);}
    public static function POST(string $route, $handler) { Route::registerRoute($route, "POST", $handler); }
    public static function PUT(string $route, $handler) { Route::registerRoute($route, "PUT", $handler);}
    public static function HEAD(string $route, $handler) { Route::registerRoute($route, "HEAD", $handler);}
    public static function DELETE(string $route, $handler) { Route::registerRoute($route, "DELETE", $handler);}
    public static function PATCH(string $route, $handler) { Route::registerRoute($route, "DELETE", $handler);}
    public static function OPTION(string $route, $handler) { Route::registerRoute($route, "OPTION", $handler);}
    public static function CONNECT(string $route, $handler) { Route::registerRoute($route, "CONNECT", $handler);}
    public static function TRACE(string $route, $handler) { Route::registerRoute($route, "TRACE", $handler);}


    public static function clean(string $url) {
        // remove last '/'
        if($url[strlen($url)-1] == "/")
            $url = substr($url, 0, strlen($url)-1);
        return $url;
    }

    public static function isPathArrayMatch(array $pathArr, array $patternArr) {
        if(count($pathArr) != count($patternArr)) return false;

        for($i = 0; $i < count($pathArr); $i++) {
            if($patternArr[$i] == "{int}") {
                if(!is_numeric($pathArr[$i])) {
                    return false;
                }
            } else if($patternArr[$i] == "{string}") {
                if(is_numeric($pathArr[$i])) {
                    return false;
                }
            } else if($patternArr[$i] != $pathArr[$i]) {
                return false;
            }
        }

        return true;
    }

    public static function handle() {
        $route = Route::clean($_SERVER['REQUEST_URI']);
        if($route == "") $route = self::$baseUnsedUrl;
        else if($route == self::$baseUnsedUrl) $route = "not-found";
        $route = explode("?", $route)[0];

        $parts = parse_url($route);
        $route = $parts["path"];

        $httpMethod = $_SERVER['REQUEST_METHOD'];
        if(!array_key_exists($httpMethod, Route::$routes)) {
            // echo "HTTP Method not allowed: " . $httpMethod;
            (Route::$route404["404"])();
            return;
        }
        
        $handler = null;
        
        $routeSplit = explode("/", $route);
        array_shift($routeSplit);
        // echo json_encode($routeSplit) . "\n";
        
        foreach(Route::$routes[$httpMethod] as $key => $value) {
            $pathSplit = explode("/", $key);
            array_shift($pathSplit);

            // echo json_encode($pathSplit) . "\n"; // ["{int}","{int}"]
            if(self::isPathArrayMatch($routeSplit, $pathSplit)) {
                $handler = $value;
            }
        }
        
        if(!$handler) {
            (Route::$route404["404"])();
            return;
        }

        $res = null;
        if(is_callable($handler)) {
            $res = $handler();
        } else if(is_subclass_of($handler, IHandler::class)) {
            /** @var IHandler */
            $con = $handler;
            $res = $con->handle();
        } else if(is_array($handler)) {
            foreach($handler as $h) {
                if(is_callable($h)) {
                    $res = $h();
                } else if(is_subclass_of($h, IHandler::class)) {
                    /** @var IHandler */
                    $con = $h;
                    $res = $con->handle();
                }
            }
        }
        if(is_subclass_of($res, JsonSerializable::class)) {
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($res);
        }
    }
}