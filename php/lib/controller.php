<?php
require_once __DIR__ . '/../lib/view.php';

abstract class Controller implements IHandler{
    function requiredPostParams() {
        return [];
    }

    function handle() {
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $errorParams = [];
            $requiredParams = $this->requiredPostParams();
            foreach($requiredParams as $param) {
                if(!isset($_POST[$param])) {
                    $errorParams[] = $param;
                }
            }
            if(count($errorParams) > 0) {
                $this->errorHandle($errorParams);
                return;
            }
        }
        $this->validatedHandle();
    }

    function prettify($str) {
        return ucwords(str_replace("_", " ", $str));
    }

    function errorHandle($errorParams) {
        
        for($i = 0; $i < count($errorParams); $i++) {
            $errorParams[$i] = $this->prettify($errorParams[$i]);
        }
        $error_str = join(", ", $errorParams);

        Message::Error("Error", "Missing parameters: $error_str");
        $this->refreshPage();
    }
    abstract function validatedHandle();

    protected function view(string $path, $data = null){ 
        view($path, $data); 
        $_SESSION["message"] = null;
    }
    function redirect($url, $statusCode = 303)
    {
        header('Location: ' . $url, true, $statusCode);
        exit();
    }

    function refreshPage() {
        $this->redirect($_SERVER["REQUEST_URI"]); // refresh page
    }


    function getUrlPath() {
        $route = Route::clean($_SERVER['REQUEST_URI']);
        $parts = parse_url($route);
        $routeArr = $parts["path"];
        $partsArr = explode("/", $routeArr);
        array_shift($partsArr);
        return $partsArr;
    }

    function getCurrentUser() {
        /** @var User */
        $user = $_SESSION["user"];
        return $user;
    }

   
    function detectFileType($file) {
        
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($finfo, $file);
        finfo_close($finfo);
    
        if (strpos($mimeType, 'image/') === 0) {
            return 'Image';
        } else if ($mimeType === 'application/pdf') {
            return 'PDF';
        } else if (strpos($mimeType, 'video/') === 0) {
            return 'Video';
        }
    
        return '';
    }
}