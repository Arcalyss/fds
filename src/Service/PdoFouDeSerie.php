<?php
namespace App\Service;

use PDO;

class PdoFouDeSerie {
    private static $monPdo;
    public function __construct($serveur, $bdd, $user, $mdp) {
        PdoFouDeSerie::$monPdo = new PDO($serveur.";".$bdd,$user,$mdp);
    }
    public function getUneSerie($id) {
        $req = "SELECT * FROM serie WHERE id = :id";
        $res = PdoFouDeSerie::$monPdo->prepare($req);
        $res->bindParam(':id', $id);
        $res->execute();
        $serie = $res->fetch();
        return $serie;
    }
    
    public function getLesSeries() {
        $req = "SELECT * FROM serie";
        $res = PdoFouDeSerie::$monPdo->prepare($req);
        $res->execute();
        $lesSeries = $res->fetchAll();
        return $lesSeries;
    }

    public function countLesSeries() {
        $req = "SELECT count(*) FROM serie";
        $res = PdoFouDeSerie::$monPdo->prepare($req);
        $res->execute();
        $nbSeries = $res->fetch();
        return $nbSeries[0];
    }
}
?>