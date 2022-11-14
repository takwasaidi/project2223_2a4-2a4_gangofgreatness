<?php
include '../config.php';
include '../Model/panier.php';


class PanierC
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
    public function listpanier()
    {
        $sql = "SELECT * FROM panier";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function addPanier($panier)
    {
        $sql = "INSERT INTO panier
        VALUES (NULL, :np,:pp, :ip)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'np' => $panier->getNomP(),
                'pp' => $panier->getPrixP(),
                'ip' => $panier->getImgP()
                
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


    function deletePanier($id)
    {
        $sql = "DELETE FROM panier WHERE idPlat = :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }
    function selct($id)
    {
        $sql = "SELECT * FROM panier WHERE idPlat = :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }






    function updatepanier($panier, $id)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE panier SET 
                    nomP = :nomP, 
                    prixP= :prixP, 
                    imgP = :imgP
                WHERE idPlat= :idPlat'
            );
            $query->execute([
                'idPlat' => $id,
                'nomP' => $panier->getNomP(),
                'prixP' => $panier->getPrixP(),
                'imgP' => $panier->getImgP()
                
            ]);
            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }

    function showPanier($id)
    {
        $sql = "SELECT * from panier where idPlat = $id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();

            $panier = $query->fetch();
            return $panier;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
}
