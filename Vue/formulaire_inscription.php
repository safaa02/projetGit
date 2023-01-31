<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

</head>
<body>
<div class="container h-80">
    <div class="row align-items-center h-100">
        <div class="col-3 mx-auto">
            <div class="text-center">
                <img id="profile-img" class="rounded-circle profile-img-card" />
                <p id="profile-name" class="profile-name-card"></p>
                <form  class="form-signin" action="http://localhost/projetGit/projetGit/Controller/inscription.php" method="post">
                    <h3>Créer votre compte</h3>
                    <input type="text" name="pseudo" id="inputPassword" class="form-control form-group" placeholder="Pseudo" required>
                    <input type="password" name="mdp" id="inputPassword" class="form-control form-group" placeholder="Mot de passe" required>
                    <input type="password" name="mdpverif" id="inputPassword" class="form-control form-group" placeholder="Mot de passe" required>
                    <input type="text" name="mail" id="inputPassword" class="form-control form-group" placeholder="Mail" required>
                    <input type="text" name="tel" id="inputPassword" class="form-control form-group" placeholder="Numéro de téléphone" required>
                    <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Créer</button>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>