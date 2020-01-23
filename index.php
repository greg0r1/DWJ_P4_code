<?php
require('controller/frontend.php');
require('controller/backend.php');

if (isset($_GET['action'])) {
    if ($_GET['action'] == 'listPosts') {
        listPosts();
    } elseif ($_GET['action'] == 'post') {
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $postId = $_GET['id'];
            post($postId);
        } else {
            echo 'Erreur : aucun identifiant de billet envoyé';
        }
    } elseif ($_GET['action'] == 'addComment') {
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                addComment($_GET['id'], $_POST['author'], $_POST['comment']);
            } else {
                echo 'Erreur : tous les champs ne sont pas remplis !';
            }
        } else {
            echo 'Erreur : aucun identifiant de billet envoyé';
        }
    } elseif ($_GET['action'] == 'loginForm') {
        loginForm();
    } elseif ($_GET['action'] == 'loginCnx') {
        loginCnx();
    } elseif ($_GET['action'] == 'adminCnx') {
        adminCnx();
    } elseif ($_GET['action'] == 'reportedComment') {
        if (isset($_POST['reported'])) {
            $idComment = $_GET['commentId'];
            addReportComment($idComment);
            $postId = isset($_GET['postId']) ? $_GET['postId'] : listPosts();
            post($postId);
        } else {
            $postId = isset($_GET['postId']) ? $_GET['postId'] : listPosts();
            post($postId);
        }
    } elseif ($_GET['action'] == 'createPost') {
        createPost();
    } elseif ($_GET['action'] == 'addPost') {
        addPost();
    } elseif ($_GET['action'] == 'adminListPosts') {
        listPostsCRUD();
    } elseif ($_GET['action'] == 'editPost') {
        if (isset($_GET['id'])) {
            $postId = $_GET['id'];
            editPost($postId);
        } else {
            listPostsCRUD();
        }
    } elseif ($_GET['action'] == 'updatePost') {
        if (!empty($_POST['tinymceTitle']) || !empty($_POST['tinymceContent'])) {
            $idPost = $_GET['idPost'];
            $title = $_POST['tinymceTitle'];
            $content = $_POST['tinymceContent'];
            updatePost($idPost, $title, $content);
        } else {
            echo '<h2>Erreur de contenu. Les données du formulaire sont vides.</h2>';
        }
    } elseif ($_GET['action'] == 'deletePost') {
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $idPost = $_GET['id'];
            deletingPost($idPost);
        } else {
            echo 'Erreur d\'identification du post';
        }
    } elseif ($_GET['action'] == 'commentsList') {
        listCommentsCRUD();
    } elseif ($_GET['action'] == 'reportedCommentsList') {
        reportedCommentsListCRUD();
    } elseif ($_GET['action'] == 'deleteComment') {
        if (isset($_GET['idComment']) && !empty($_GET['idComment'])) {
            $idComment = $_GET['idComment'];
            deletingComment($idComment);
        } else {
            echo 'Erreur d\'identification du commentaire';
        }
    } else {
        listPosts();
    }
} else {
    header('location:index.php?action=listPosts&page=1');
}
