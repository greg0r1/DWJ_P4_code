<?php
require_once('./model/frontend/PostManager.php');
require_once('./model/frontend/CommentManager.php');

function listPosts()
{
    $postManager = new OC\DWJ_P4\model\frontend\PostManager();
    // Pagination
    $page = (!empty(strip_tags($_GET['page']))) ? $_GET['page'] : 1;
    $limit = 3;
    $start = ($page - 1) * $limit;
    $number_total_posts = $postManager->paging();
    $number_of_pages = ceil($number_total_posts / $limit);


    $posts = $postManager->getPosts($limit, $start);

    require('./view/frontend/listPostsView.php');
}

function post($postId)
{
    $postManager = new OC\DWJ_P4\model\frontend\PostManager();
    $commentManager = new OC\DWJ_P4\model\frontend\CommentManager();

    $comments = $commentManager->getComments($postId);
    $post = $postManager->getPost($postId);
    if ($comments == false) {
        throw new Exception("Error de récupération des commentaires.", 1);
    } elseif ($post == false) {
        throw new Exception("Error de récupération du post.", 1);
    } else {
        require('./view/frontend/postView.php');
    }
}

function addComment($postId, $author, $comment)
{
    $commentManager = new OC\DWJ_P4\model\frontend\CommentManager();

    $insertline = $commentManager->postComment($postId, $author, $comment);

    if ($insertline == false) {
        throw new Exception("Impossible d\'ajouter le commentaire !", 1);
    } else {
        header('location:index.php?action=post&id=' . $postId);
    }
}

function addReportComment($idComment)
{
    $commentManager = new OC\DWJ_P4\model\frontend\CommentManager();

    $commentManager->reportComment($idComment);
}
