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

function listPostsCRUD()
{
    // Pagination
    $page = (!empty(strip_tags($_GET['page']))) ? $_GET['page'] : 1;
    $limit = 10;
    $start = ($page - 1) * $limit;
    $number_total_posts = pagingAdmin();
    $number_of_pages = ceil($number_total_posts / $limit);


    $posts = getPostsCRUD($limit, $start);

    require('./view/backend/listPosts.php');
}

function editPost($postId)
{
    $post = modifyPostCRUD($postId);
    require('./view/backend/editPost.php');
}

function updatePost($idPost, $title, $content)
{
    updatingPost($idPost, $title, $content);
    require('./view/backend/updatedPost.php');
}

function deletingPost($idPost)
{
    deletePost($idPost);
    require('./view/backend/deletedPost.php');
}

function listCommentsCRUD()
{
    // Pagination
    $page = (!empty(strip_tags($_GET['page']))) ? $_GET['page'] : 1;
    $limit = 10;
    $start = ($page - 1) * $limit;
    $number_total_comments = pagingCommentsList();
    $number_of_pages = ceil($number_total_comments / $limit);


    $comments = getCommentsCRUD($limit, $start);
    if ($comments == false) {
        throw new Exception("Erreur: Les commentaires n'ont pas été récupérés.", 1);
    } else {
        require('./view/backend/listComments.php');
    }
}

function reportedCommentsListCRUD()
{
    // Pagination
    $page = (!empty(strip_tags($_GET['page']))) ? $_GET['page'] : 1;
    $limit = 10;
    $start = ($page - 1) * $limit;
    $number_total_comments = pagingReportedCommentsList();
    $number_of_pages = ceil($number_total_comments / $limit);


    $comments = getReportedCommentsCRUD($limit, $start);
    if ($comments == false) {
        throw new Exception("Erreur: Les commentaires signalés n'ont pas été récupérés.", 1);
    } else {
        require('./view/backend/reportedCommentsList.php');
    }
}

function deletingComment($idComment)
{
    $deleteComment = deleteComment($idComment);
    if ($deleteComment == false) {
        throw new Exception("Erreur: le commentaire n'a pas été supprimé.", 1);
    } else {
        require('./view/backend/deletedComment.php');
        $deleteComment->closeCursor();
    }
}
