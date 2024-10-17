<?php
require_once __DIR__ . "/../lib/controller.php";
require_once __DIR__ . "/../models/lamaran.model.php";
class LamaranController extends Controller {
    public function handle(){
        echo "Lamaran<br>";

        $pathArr = $this->getUrlPath();
        $lowongan_id = $pathArr[0];
        $lamaran_id = $pathArr[1];

        echo "Lowongan ID: $lowongan_id <br>";
        echo "Lamaran ID: $lamaran_id <br>";

        $lamaran = Lamaran::getLamaranById($lamaran_id);
    }

}