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
                echo '<script>alert("Le mot de passe est invalide")</script>';
                echo '<script>document.location.href="index.php?action=loginForm"</script>';
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

function getPostsCRUD($limit, $start)
{
    $db = dbConnect();

    $sql_posts = ("SELECT *, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%i') AS formatted_date, DATE_FORMAT(last_modification, '%d/%m/%Y à %Hh%i') AS last_modification_format FROM posts  ORDER BY creation_date DESC LIMIT :limit OFFSET :start");
    $request_posts = $db->prepare($sql_posts) or die(print_r($db->errorInfo()));

    $request_posts->bindValue('limit', $limit, PDO::PARAM_INT);
    $request_posts->bindValue('start', $start, PDO::PARAM_INT);

    $request_posts->execute();


    return $request_posts;
}

function modifyPostCRUD($postId)
{
    $db = dbConnect();

    $request_post = $db->prepare("SELECT * FROM `posts` WHERE id = ?") or die(print_r($db->errorInfo()));

    $request_post->execute(array($postId));
    $post = $request_post->fetch();
    return $post;
    $request_post->closeCursor();
}

function updatingPost($idPost, $title, $content)
{
    $db = dbConnect();
    $request_post = $db->prepare("UPDATE `posts` SET `title`= :title,`content`= :content, `last_modification`= NOW() WHERE id = :idPost");
    $request_post->execute(array(
        'title' => $title,
        'content' => $content,
        'idPost' => $idPost
    ));
    if ($request_post == false) {
        throw new Exception("Erreur: Le billet n'a pas été modifié.", 1);
    }
    $request_post->closeCursor();
}

function pagingAdmin()
{
    $db = dbConnect();

    $sql_paging = "SELECT COUNT(*) AS number_total_posts FROM `posts`";
    $total_posts = $db->query($sql_paging);
    $req_total_posts = $total_posts->fetch();
    $number_total_posts = $req_total_posts['number_total_posts'];

    return $number_total_posts;
}

function deletePost($idPost)
{
    $db = dbConnect();
    $request_post = $db->prepare("DELETE FROM `posts` WHERE id = :idPost");
    $request_post->execute(array(
        'idPost' => $idPost
    ));
    if ($request_post == false) {
        throw new Exception("Erreur: Le billet n'a pas été supprimé.", 1);
    }
    $request_post->closeCursor();
}

function getCommentsCRUD($limit, $start)
{
    $db = dbConnect();

    $sql_comments = ("SELECT *, DATE_FORMAT(comment_date, '%d/%m/%Y à %Hh%i') AS comment_date_format FROM comments ORDER BY comment_date DESC LIMIT :limit OFFSET :start");
    $request_comments = $db->prepare($sql_comments) or die(print_r($db->errorInfo()));

    $request_comments->bindValue('limit', $limit, PDO::PARAM_INT);
    $request_comments->bindValue('start', $start, PDO::PARAM_INT);

    $request_comments->execute();


    return $request_comments;
}

function pagingCommentsList()
{
    $db = dbConnect();

    $sql_paging = "SELECT COUNT(*) AS number_total_comments FROM `comments`";
    $total_comments = $db->query($sql_paging);
    $req_total_comments = $total_comments->fetch();
    $number_total_comments = $req_total_comments['number_total_comments'];

    return $number_total_comments;
}

function getReportedCommentsCRUD($limit, $start)
{
    $db = dbConnect();

    $sql_comments = ("SELECT *, DATE_FORMAT(comment_date, '%d/%m/%Y à %Hh%i') AS comment_date_format FROM `comments` WHERE `reported` = 1 ORDER BY `comments`.`comment_date` DESC LIMIT :limit OFFSET :start");
    $request_comments = $db->prepare($sql_comments) or die(print_r($db->errorInfo()));

    $request_comments->bindValue('limit', $limit, PDO::PARAM_INT);
    $request_comments->bindValue('start', $start, PDO::PARAM_INT);

    $request_comments->execute();


    return $request_comments;
}

function pagingReportedCommentsList()
{
    $db = dbConnect();

    $sql_paging = "SELECT COUNT(*) AS number_total_comments FROM `comments` WHERE `reported` = 1";
    $total_comments_reported = $db->query($sql_paging);
    $req_total_comments_reported = $total_comments_reported->fetch();
    $number_total_comments_reported = $req_total_comments_reported['number_total_comments'];

    return $number_total_comments_reported;
}

function deleteComment($idComment)
{
    $db = dbConnect();
    $request_delete_comment = $db->prepare("DELETE FROM `comments` WHERE id = :idComment");
    $request_delete_comment->execute(array(
        'idComment' => $idComment
    ));

    return $request_delete_comment;
}
