<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Execution en cour</title>
</head>
<body>

<?php
    try
    {
        $bd = new PDO("mysql:host=localhost;dbname=projet_git","root", "", array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
    }
    catch (Exception $e)
    {
        die('Erreur :'.$e->GetMessage());
    }
?>

<?php
if(isset($_POST['pseudo']) && isset($_POST['mdp']) && isset($_POST['mdpverif']) && isset($_POST['mail']) && isset($_POST['tel']))
{
    if (($_POST['mdp']) === ($_POST['mdpverif']))
    {
        $trouver="non";
        $pseudo_rechercher= $bd->query("SELECT pseudo,IdUtilisateur FROM utilisateur");
        while($pseudo_re=$pseudo_rechercher->fetch())
        {
            if ($pseudo_re['pseudo']==$_POST['pseudo'])
            {?>
                <script>alert("L'identifiant est déja utilisé par un autre utilisateur")</script> <?php
                $trouver="oui";
            }
        }
        if(isset($trouver) && $trouver!="oui")
        {
            $pseudo=htmlspecialchars($_POST['pseudo']);
            $mdp=htmlspecialchars($_POST['mdp']);
            $mdpverif=htmlspecialchars($_POST['mdpverif']);
            $mail=htmlspecialchars($_POST['mail']);
            $tel=htmlspecialchars($_POST['tel']);
                $verif = $tel;
                $format = 0;
                $liste = "0123456789";

                for ($i = 0; (($i < strlen($verif))); $i++)
                {
                    for ($j = 0; (($j < strlen($liste))); $j++)
                    {
                        if ($verif[$i] == $liste[$j])
                        {
                            $format ++;
                        }
                    }
                }

            if($format == 10)
            {
                $verif = $mdp;
                $nb = 0;
                $caractere = 0;
                $majuscule = 0;
                $liste = "0123456789";
                $listemajuscule = "AZERTYUIOPMLKJHGFDSQWXCVBN";
                $listecaratere = ".+/*,?;§$&";

                for ($i = 0; (($i < strlen($verif))); $i++)
                {
                    for ($j = 0; (($j < strlen($listemajuscule))); $j++)
                    {
                        if ($j <10 && $verif[$i] == $liste[$j])
                        {
                            $nb ++;
                        }
                        if ($j <10 && $verif[$i] == $listecaratere[$j])
                        {
                            $caractere ++;
                        }
                        if ($verif[$i] == $listemajuscule[$j])
                        {
                            $majuscule ++;
                        }
                    }
                }
                if(strlen($mdp) >=8 && $nb >=2 && $caractere >=1 && $majuscule>=1)
                {
                    $verif = $mail;
                    $arobase ="non";
                    $id_arobase = 0;
                    $nbrearobase=0;
                    $point ="non";
                    $id_point = 0;
                    for ($i = 0; (($i < strlen($verif))); $i++)
                    {
                        if ($verif[$i] == "@")
                        {
                            $arobase="oui";
                            $id_arobase =$i;
                            $nbrearobase++;
                        }
                        if ($verif[$i] == ".")
                        {
                            $point="oui";
                            $id_point=$i;
                        }
                    }
                    if($arobase=="oui" && $point=="oui" && $id_point>$id_arobase && $nbrearobase==1 && $id_arobase>0 && ($id_point-1)>$id_arobase && ((strlen($mail)==$id_point+3) || (strlen($mail)==$id_point+4)))
                    {
                        $mdp = crypt( $mdp, 'sha-256');
                        $ajout_utilisateur=$bd->prepare("INSERT INTO `utilisateur`(`pseudo`, `mail`, `mdp`, `numero_tel`) VALUES ('$pseudo','$mail','$mdp','$tel')");
                        $ajout_utilisateur->execute();  ?>
                        <script>alert("Votre compte est créé, rendez-vous sur la page de connexion");
                        </script><?php

                    }else{ ?>
                        <script>alert("Votre adresse mail n'est pas valable");
                            document.location.href="C:/wamp64/www/projetGit/projetGit/Vue/inscription.php";
                        </script>     <?php
                    }
                }else{
                    ?>
                        <script>alert("Votre mot de passe doit contenir au moins 8 caractères avec au minimum une majucule, deux chiffres et un caractère spécial");
                            document.location.href="C:/wamp64/www/projetGit/projetGit/Vue/inscription.php";</script>     <?php
                }
            }else{
                ?>
                        <script>alert("Votre numéro de téléphone n'est pas dans un format valide");
                            document.location.href="C:/wamp64/www/projetGit/projetGit/Vue/inscription.php";</script>     <?php
            }
        }else{?>
        <script>alert("Votre numéro de téléphone n'est pas dans un format valide");
            document.location.href="C:/wamp64/www/projetGit/projetGit/Vue/inscription.php";</script>     <?php

    }
    }else{?>
        <script>alert("Les deux mots de passe sont différents");
            document.location.href="C:/wamp64/www/projetGit/projetGit/Vue/inscription.php";</script>     <?php

    }
}
?>
    <script>
            document.location.href="C:/wamp64/www/projetGit/projetGit/Vue/formulaireDeConnexion";
    </script>
</body>
</html>