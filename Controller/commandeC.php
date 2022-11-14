<?php
include '../config.php';
include '../Model/panier.php';

class CommandeC
{
    function affichercommande($idPlat){
        try{
            $pdo = config::getConnexion();
            $query = $pdo->prepare(
                'SELECT * FROM commande where panier = :id'
            );
            $query->execute([
                'id'  =>  $idPlat
             ]);
            return $query->fetchAll();
        }catch(PDOException $e){
            $e->getMessage();
        }

    }
   
}
