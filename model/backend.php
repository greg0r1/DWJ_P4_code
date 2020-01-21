<?php
function authAdmin()
{
    // algo password: PASSWORD_BCRYPT
    if (isset($_POST['inputLogin']) && isset($_POST['inputPassword'])) {
        $nameAuth = 'Jean' || 'greg';
        if ($_POST['inputLogin'] == $nameAuth || $_COOKIE['nameAdminConnected'] == $nameAuth) {
            $db = dbConnect();
            $passwd_bdd = $db->prepare("SELECT `password`,`first_name` FROM `admin_users` WHERE `login` = ?");
            $passwd_bdd->execute(array($_POST['inputLogin']));
            $passwd_result = $passwd_bdd->fetch();
            if (password_verify($_POST['inputPassword'], $passwd_result['password'])) {
                $name = $passwd_result['first_name'];
                setcookie('passwordAdminConnected', $_POST['inputPassword'], time() + 365 * 24 * 3600, null, null, false, true);
                setcookie('nameAdminConnected', $name, time() + 365 * 24 * 3600, null, null, false, true);
                header('location:index.php?action=adminCnx&name=' . $name);
            } else {
                echo 'Le mot de passe est invalide.';
                echo $passwd_result['password'];
            }
        } else {
            echo 'Login invalide.';
        }
    } else {
        echo 'Erreur d\'authentification.';
    }
}

function addNewPost()
{
    $db = dbConnect();
    $sql = "INSERT INTO `posts`(`title`, `content`, `author`, `creation_date`) VALUES (:title,:content,:author,NOW())";
    $newPost = $db->prepare($sql);
    $newPost->execute(array(
        'title' => $_POST['tinymceTitle'],
        'content' => $_POST['tinymceContent'],
        'author' => $_COOKIE['nameAdminConnected']
    ));
    $newPost->closeCursor();
}
