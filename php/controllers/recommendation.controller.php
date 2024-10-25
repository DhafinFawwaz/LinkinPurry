<?php
require_once __DIR__ . "/../lib/controller.php";
require_once __DIR__ . "/../models/recommendation.model.php";

class RecommendationController extends Controller {
    public function validatedHandle(){
        $data = array();
        $data["user"] = $this->getCurrentUser();
        $data["lowonganList"] = (Recommendation::getJobsFor($data["user"]));
        return $this->view("recommendation.php", $data);
    }
}
