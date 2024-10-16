<?php
require_once __DIR__ . "/handler.php";
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
        
        // whatever/<int>/<int>
        // /<int>



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


        if(is_callable($handler)) {
            $handler();
        } else if(is_subclass_of($handler, IHandler::class)) {
            /** @var IHandler */
            $con = $handler;
            $con->handle();
        } else if(is_array($handler)) {
            foreach($handler as $h) {
                if(is_callable($h)) {
                    $h();
                } else if(is_subclass_of($h, IHandler::class)) {
                    /** @var IHandler */
                    $con = $h;
                    $con->handle();
                }
            }
        }
    }
}