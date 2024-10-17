<?php
require_once __DIR__ . "/../lib/controller.php";
class LowonganController extends Controller {
    public function handle(){
        echo "Lowongan<br>";

        $pathArr = $this->getUrlPath();
        $lowongan_id = $pathArr[0];

        echo "Lowongan ID: $lowongan_id <br>";
    }

}