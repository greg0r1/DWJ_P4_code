<?php
function getPosts($limit, $start)
{
    $db = dbConnect();

    $sql_posts = ("SELECT *, DATE_FORMAT(creation_date, 'Message du : %d/%m/%Y à %hh%m') AS formatted_date FROM posts  ORDER BY creation_date DESC LIMIT :limit OFFSET :start");
    $request_posts = $db->prepare($sql_posts) or die(print_r($db->errorInfo()));

    $request_posts->bindValue('limit', $limit, PDO::PARAM_INT);
    $request_posts->bindValue('start', $start, PDO::PARAM_INT);

    $request_posts->execute();


    return $request_posts;
}

function getPost($postId)
{
    $db = dbConnect();
    $req = $db->prepare("SELECT *, DATE_FORMAT(creation_date, 'Message du : %d/%m/%Y à %hh%m') AS formatted_date FROM posts WHERE id = ?") or die(print_r($db->errorInfo()));;

    $req->execute(array($postId));
    $post = $req->fetch();

    return $post;
}

function paging()
{
    $db = dbConnect();

    $sql_paging = "SELECT COUNT(*) AS number_total_posts FROM `posts`";
    $total_posts = $db->query($sql_paging);
    $req_total_posts = $total_posts->fetch();
    $number_total_posts = $req_total_posts['number_total_posts'];

    return $number_total_posts;
}

function getComments($postId)
{
    $db = dbConnect();
    $comments = $db->prepare("SELECT comments.id, comments.author, comments.comment, comments.comment_date, DATE_FORMAT(comment_date, ', le %d/%m/%Y à %Hh%imin') AS comment_date_formatted FROM `comments` INNER JOIN `posts` ON `post_id` = posts.id WHERE posts.id = ?");
    $comments->execute(array($postId));

    return $comments;
}

function postComment($postId, $author, $comment)
{
    $db = dbConnect();
    $comments = $db->prepare("INSERT INTO `comments`(`post_id`, `author`, `comment`, `comment_date`) VALUES (?,?,?,NOW())");
    $insertline = $comments->execute(array($postId, $author, $comment));

    return $insertline;
}

function reportComment($idComment)
{
    $db = dbConnect();
    $addReportComment = $db->prepare("UPDATE `comments` SET `reported` = '1' WHERE `comments`.`id` = ?");
    $addReportComment->execute(array($idComment));

    $alertMessReq = $db->prepare("SELECT `author` FROM `comments` WHERE `id` = ?");
    $alertMessReq->execute(array($idComment));
    $alertMess = $alertMessReq->fetch();

    echo '<script>alert("Le commentaire de ' . $alertMess['author'] . ' a bien été signalé")</script>';
    $alertMessReq->closeCursor();
    $addReportComment->closeCursor();
}

function dbConnect()
{
    try {
        $db = new PDO('mysql:host=localhost:8889;dbname=oc_forteroche; charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        return $db;
    } catch (Exception $e) {
        die('Erreur' . $e->getMessage());
    }
}
