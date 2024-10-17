<?php
require_once __DIR__ . "/../lib/controller.php";
class RiwayatLamaranController extends Controller {
    public function handle(){
        return $this->view("riwayat-lamaran.php");
    }
}