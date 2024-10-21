<?php
require_once __DIR__ . "/../lib/controller.php";
require_once __DIR__ . "/../models/lamaran.model.php";

class RiwayatLamaranController extends Controller {

    public function handle() {
        $user = $_SESSION['user'];
        $user_id = $user->id;

        $riwayatLamaran = Lamaran::getRiwayatLamaranByUserId($user_id);

        return $this->view("riwayat-lamaran.php", [
            "riwayatLamaran" => $riwayatLamaran
        ]);
    }
}
