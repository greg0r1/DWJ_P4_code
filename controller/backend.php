<?php
require('./model/backend.php');

function loginForm()
{
    require('./view/backend/login.php');
}

function loginCnx()
{
    authAdmin();
}

function adminCnx()
{
    if (isset($_COOKIE['nameAdminConnected'])) {
        require('./view/backend/home.php');
    } else {
        echo 'Erreur d\'authentification';
    }
}

function createPost()
{
    require('./view/backend/createPost.php');
}

function addPost()
{
    if (isset($_POST['tinymceTitle']) && isset($_POST['tinymceContent'])) {
        addNewPost();
        require('./view/backend/home.php');
        echo '<script>alert(\'Votre billet à bien été ajouté ' . $_COOKIE['nameAdminConnected'] . '\')</script>';
    }
}
