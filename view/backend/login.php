<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="../public/css/style_admin.css">
    <!-- Favicons -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,400italic|Roboto+Mono:400,500|Material+Icons" rel="stylesheet">
    <meta name="theme-color" content="#563d7c">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <main role="main" class="col-md-12 ml-sm-auto col-lg-12 px-4">
                <form class="form-signin" action="index.php?action=loginCnx" method="POST">
                    <p>
                        <i id="account_circle" class="material-icons md-48">
                            account_circle
                        </i></p>
                    <h1 class="h3 mb-3 font-weight-normal">Le blog de Forteroche</h1>
                    <label for="inputLogin">Identifiant</label>
                    <input type="text" id="inputLogin" name="inputLogin" class="form-control" placeholder="Identifiant" required autofocus>
                    <label for="inputPassword">Mot de passe</label>
                    <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Mot de passe" required>
                    <button class="btn btn-lg btn-primary btn-block" type="submit">Se connecter</button>
                    <div class="checkbox mb-3">
                        <label>
                            <input type="checkbox" value="remember-me"> Rester connecté
                        </label>
                    </div>

                    <p><a href="index.php?action=listPosts">
                            <- Retour au site</a> </p> </form> </div> </main> </div> </div> </body> </html>