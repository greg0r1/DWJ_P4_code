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
    } else {
        listPosts();
    }
} else {
    listPosts();
}
