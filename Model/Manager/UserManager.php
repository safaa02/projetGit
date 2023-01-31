<?php
//Cette fonction permet à la connexion
function connect($identifiant, $mdp, $connexion)
{
    // faire une requete sql
    $sql = $connexion->prepare("SELECT * from UTILISATEUR WHERE mail=:mail");
    $sql->bindValue(':mail', $identifiant);
    $sql->execute();

    $resultat = $sql->fetchAll(PDO::FETCH_ASSOC);


    if (count($resultat) == 1) {

        if ($identifiant == $resultat[0]["mail"] and $mdp == $resultat[0]["mdp"]) {
            $tabUser = $resultat[0];
            $user = new User();
            $user->setId($tabUser["idUtilisateur"]);
            $user->setEmail($tabUser["mail"]);
            $user->setNumeroTel("0606060606");

            return $user;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function getAllUser($connexion)
{
    // faire une requete sql
    $sql = "SELECT * from UTILISATEUR";

    $listeUtilisateurs = array();
    if (!$connexion->query($sql)) {
        return null;
    } else {
        foreach ($connexion->query($sql) as $row) {
            $user = new User();
            $user->setEmail($row['mail']);
            array_push($listeUtilisateurs, $user);
        }

        return $listeUtilisateurs;
    }

}
