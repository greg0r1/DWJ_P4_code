<?php
require('./model/frontend.php');

function listPosts()
{
    // Pagination
    $page = (!empty(strip_tags($_GET['page']))) ? $_GET['page'] : 1;
    $limit = 3;
    $start = ($page - 1) * $limit;
    $number_total_posts = paging();
    $number_of_pages = ceil($number_total_posts / $limit);


    $posts = getPosts($limit, $start);

    require('./view/frontend/listPostsView.php');
}
function post($postId)
{
    $comments = getComments($postId);
    $post = getPost($postId);

    require('./view/frontend/postView.php');
}

function addComment($postId, $author, $comment)
{
    $insertline = postComment($postId, $author, $comment);

    if ($insertline == false) {
        die('Impossible d\'ajouter le commentaire !');
    } else {
        header('location:index.php?action=post&id=' . $postId);
    }
}

function addReportComment($idComment)
{
    reportComment($idComment);
}
