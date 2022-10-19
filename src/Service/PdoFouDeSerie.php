<?php
namespace App\Service;

use PDO;

class PdoFouDeSerie {
    private static $monPdo;
    public function __construct($serveur, $bdd, $user, $mdp) {
        PdoFouDeSerie::$monPdo = new PDO($serveur.";".$bdd,$user,$mdp,array(
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
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

    public function setLaSerie($serie)
    {
        $req = "INSERT INTO serie (titre, resume, duree, premiereDiffusion, image) VALUES (:titre, :resume, :duree, :premiereDiffusion, :image)";
        $res = PdoFouDeSerie::$monPdo->prepare($req);
        $res->bindValue(':titre', $serie['titre'], PDO::PARAM_STR);
        $res->bindValue(':resume', $serie['resume'], PDO::PARAM_STR);
        $res->bindValue(':duree', $serie['duree'], PDO::PARAM_STR);
        $res->bindValue(':premiereDiffusion', $serie['premiereDiffusion'], PDO::PARAM_STR);
        $res->bindValue(':image', $serie['image'], PDO::PARAM_STR);
        $res->execute();

        $req1 = "SELECT * FROM serie WHERE titre = :titre";
        $res1 = PdoFouDeSerie::$monPdo->prepare($req1);
        $res1->bindParam(':titre', $serie['titre']);
        $res1->execute();
        $nouvelleSerie = $res1->fetch();
        return $nouvelleSerie;

    }
    public function newSerie($titre,$resume,$duree,$premiereDiffusion,$image) {
        $req = "INSERT INTO serie (titre, resume, duree, premiereDiffusion, image) VALUES (:titre, :resume, :duree, :premiereDiffusion, :image)";
        $res = PdoFouDeSerie::$monPdo->prepare($req);
        $res->bindParam(':titre', $titre);
        $res->bindParam(':resume', $resume);
        $res->bindParam(':duree', $duree);
        $res->bindParam(':premiereDiffusion', $premiereDiffusion);
        $res->bindParam(':image', $image);
        $res->execute();

    }
    public function deleteSerie($id) {
        $req = "DELETE FROM serie WHERE id = :id";
        $res = PdoFouDeSerie::$monPdo->prepare($req);
        $res->bindParam(':id', $id);
        $res->execute();
    }
    public function updateSerie($id,$titre,$resume,$duree,$premiereDiffusion,$image) {
        $req = "UPDATE serie SET titre = :titre, resume = :resume, duree = :duree, premiereDiffusion = :premiereDiffusion, image = :image WHERE id = :id";
        $res = PdoFouDeSerie::$monPdo->prepare($req);
        $res->bindParam(':id', $id);
        $res->bindParam(':titre', $titre);
        $res->bindParam(':resume', $resume);
        $res->bindParam(':duree', $duree);
        $res->bindParam(':premiereDiffusion', $premiereDiffusion);
        $res->bindParam(':image', $image);
        $res->execute();
    }
    public function patchSerie($data, $id) {
        $req = "UPDATE serie SET ";
        $i = 0;
        foreach ($data as $key => $value) {
            $req .= $key . " = :" . $key;
            if ($i < count($data) - 1) {
                $req .= ", ";
            }
            $i++;
        }
        $req .= " WHERE id = :id";
        $res = PdoFouDeSerie::$monPdo->prepare($req);
        $res->bindParam(':id', $id);
        foreach ($data as $key => $value) {
            $res->bindParam(':' . $key, $value,PDO::PARAM_STR);
        }
        $res->execute();
    }
}
?>